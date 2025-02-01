<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Checkout;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

class HomeController extends Controller
{
    public function landing()
    {
        $data = [
            'title' => 'BelanjaRia | Belanja Ceria, Semua Ada di Sini!',
            'categories' => Category::all(),
            'products' => Product::limit(12)->get(),
        ];
        if (Auth::check()) {
            $data ['carts'] = Cart::with(['product'])->where('user_id', request()->user()->id)->latest()->limit(10)->get();
        }
        return view('landing', $data);
    }

    public function products(Request $request)
    {
        $products = Product::query();
        if ($request->has('search') && $request->search !== '') {
            $products->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->has('categories') && is_array($request->categories)) {
            $products->whereHas('category', function ($q) use ($request) {
                $q->whereIn('slug', $request->categories);
            });
        }
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'newest':
                    $products->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $products->orderBy('created_at', 'asc');
                    break;
                case 'cheapest':
                    $products->orderBy('price', 'asc');
                    break;
                case 'expensive':
                    $products->orderBy('price', 'desc');
                    break;
            }
        } else {
            // Default sorting
            $products->orderBy('created_at', 'desc');
        }

        $data = [
            'title' => 'BelanjaRia | Produk Terbaik yang Kami Tawarkan',
            'products' => $products->get(),
            'categories' => Category::all(),
        ];
        if (Auth::check()) {
            $data ['carts'] = Cart::with(['product'])->where('user_id', request()->user()->id)->latest()->limit(10)->get();
        }
        return view('products.index', $data);
    }

    public function showProduct(Product $product)
    {
        $data = [
            'title' => 'BelanjaRia | Produk Terbaik yang Kami Tawarkan',
            'product' => $product,
            'products' => Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get()
        ];
        if (Auth::check()) {
            $data ['carts'] = Cart::with(['product'])->where('user_id', request()->user()->id)->latest()->limit(10)->get();
        }
        return view('products.show', $data);
    }

    public function carts()
    {
        $data = [
            'title' => 'BelanjaRia | Produk di Keranjang Anda',
            'carts' => Cart::with(['product'])->where('user_id', request()->user()->id)->latest()->limit(10)->get(),
            'myCarts' => Cart::with(['product'])->where('user_id', request()->user()->id)->latest()->get()
        ];
        return view('carts.index', $data);
    }

    public function addToCart(Request $request, Product $product)
    {
        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id
        ]);
        return redirect()->back()->with('status', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function deleteCart(Request $request, Cart $cart)
    {
        Cart::find($cart->id)->delete();
        return redirect()->back()->with('status', 'Produk berhasil dihapus dari keranjang');
    }

    public function buyFormCart(Request $request)
    {
        $products = Product::whereIn('slug', $request->products)
            ->orderByRaw("FIELD(slug, '" . implode("','", $request->products) . "')")
            ->get();
        $quantities = $request->quantities;

        // hitung hitungan
        $emailPart = explode('@', Auth::user()->email)[0];
        $externalId = 'invoice-' . $emailPart . '-' . Str::uuid() . '-' . time();
        $admin = 2000;
        $amount = $admin;
        $qtyAmount = 0;
        $indexQty = 0;
        $items = [];
        $orders = [];

        foreach ($products as $product)
        {
            $amount += $product->price * $quantities[$indexQty];
            $qtyAmount += $quantities[$indexQty];

            $items[] = [
                "name" => $product->name,
                "quantity" => $quantities[$indexQty],
                "price" => $product->price,
                "category" => $product->category->name,
                "url" => env('APP_URL') . "/products/$product->slug"
            ];

            $orders[] = [
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => $quantities[$indexQty],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            $indexQty++;
        }

        // buat xendit invoice
        Configuration::setXenditKey(env('XENDIT_API_KEY'));
        $invoiceApi = new InvoiceApi();

        $invoiceRequest = new CreateInvoiceRequest([
            'external_id' => $externalId,
            'description' => 'Pembelian produk sebanyak ' . $qtyAmount . 'porsi dengan total harga Rp ' . number_format($amount, 0, ',', '.'),
            'amount' => $amount,
            'currency' => 'IDR',
            "customer" => [
                "given_names" => Auth::user()->name,
                "email" => Auth::user()->email,
            ],
            "success_redirect_url" => env('APP_URL') . "/success/$externalId",
            "failure_redirect_url" => env('APP_URL') . "/failure/$externalId",
            "items" => $items,
            "fees" => [
                [
                    "type" => "ADMIN",
                    "value" => $admin
                ]
            ]
        ]);

        try {
            $result = $invoiceApi->createInvoice($invoiceRequest);
            // store data checkout + tarik id

            $checkout = Checkout::create([
                'user_id' => Auth::user()->id,
                'service' => $admin,
                'price_total' => $amount,
                'checkout_link' => $result['invoice_url'],
                'external_id' => $externalId,
                'status' => $result['status']
            ]);

            // store data orders + ambil id checkout
            foreach( $orders as $order){
                $order['checkout_id'] = $checkout->id;
                Order::create($order);
            }

            return redirect($result['invoice_url']);

        } catch (\Xendit\XenditSdkException $e) {
            echo 'Exception when calling InvoiceApi->createInvoice: ', $e->getMessage(), PHP_EOL;
            echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
        }

        // redirect ke checkout invoice xendit
        return redirect($result['invoice_url']);
    }

    public function success(Checkout $checkout)
    {
        Configuration::setXenditKey(env('XENDIT_API_KEY'));
        $invoiceApi = new InvoiceApi();
        $result = $invoiceApi->getInvoices(null, $checkout->externalId);

        $checkout->status = $result[0]['status'];
        $checkout->save();

        foreach( $checkout->orders as $order ){
            // delete cart by product_id from orders
            Cart::where('product_id', $order->product_id)->where('user_id', Auth::user()->id)->delete();
        }

        return view('payments.success', [
            'title' => 'Berhasil Melakukan Pembayaran'
        ]);
    }
    public function failure(Checkout $checkout)
    {
        return view('payments.failure', [
            'title' => 'Gagal Melakukan Pembayaran'
        ]);
    }

    public function checkouts()
    {
        $data = [
            'title' => 'BelanjaRia | Produk di Keranjang Anda',
            'carts' => Cart::with(['product'])->where('user_id', request()->user()->id)->latest()->limit(10)->get(),
            'checkouts' => Checkout::with('orders.product')->where('user_id', request()->user()->id)->latest()->get()
        ];
        return view('checkouts.index', $data);
    }


    public function login()
    {
        return view('login', [
            'title' => 'BelanjaRia | Masuk ke Akun Anda'
        ]);
    }

    public function actionLogin( Request $request ) : RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials['role'] = 'user';

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->with('status', 'Login Gagal!. Harap periksa kembali email dan password');
    }

    public function register()
    {
        return view('register', [
            'title' => 'BelanjaRia | Daftar Akun BelanjaRia'
        ]);
    }

    public function actionRegister(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|max:255',
            'password_confirm' => 'required|min:8|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function actionLogout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }





}
