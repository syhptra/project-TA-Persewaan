<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Pastikan user login dulu
        $this->middleware('auth');
    }

    /**
     * Halaman checkout: tampilkan semua cart user
     */
    public function index()
    {
        $carts = Cart::with('barang')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        // Total harga tiap cart
        $totalHarga = $carts->sum(fn($c) => $c->qty * $c->hari * $c->barang->harga);

        return view('pages.checkout.index', compact('carts', 'totalHarga'));
    }

    /**
     * Proses checkout: simpan order dan order_items
     */
    public function process(Request $request)
    {
        $carts = Cart::with('barang')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        // Hitung total harga + kode unik
        $totalHarga = $carts->sum(fn($c) => $c->qty * $c->hari * $c->barang->harga);
        $kodeUnik = 'ORD' . Str::upper(Str::random(6));

        // Simpan ke table orders
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_harga' => $totalHarga,
            'kode_unik' => $kodeUnik,
            'status' => 'NOT PAID',
        ]);

        // Simpan tiap item ke table order_items
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'barang_id' => $cart->barang_id,
                'qty' => $cart->qty,
                'hari' => $cart->hari,
                'harga' => $cart->barang->harga,
            ]);
        }

        // Kosongkan cart user
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('checkout.pay', $order->id);
    }

    /**
     * Halaman pembayaran
     */
    public function pay($orderId)
    {
        $order = Order::with('items.barang')->findOrFail($orderId);

        return view('pages.checkout.pay', compact('order'));
    }

    /**
     * Upload bukti transfer
     */
    public function uploadPayment(Request $request, $orderId)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $order = Order::findOrFail($orderId);

        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        $order->bukti_transfer = $path;
        $order->status = 'PAID';
        $order->save();

        return redirect()->route('index')->with('success', 'Pembayaran berhasil diupload!');
    }
}
