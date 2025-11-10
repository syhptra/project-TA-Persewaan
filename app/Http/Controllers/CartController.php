<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // penting!

class CartController extends Controller
{
    // Constructor untuk middleware auth
    public function __construct()
    {
        // pastikan middleware 'auth' dikenali
        $this->middleware('auth');
    }

    // Tampilkan cart user
    public function index()
    {
        // pakai Auth::id() supaya aman
        $carts = Cart::with('barang')
            ->where('user_id', Auth::id())
            ->get();

        // total harga
        $totalHarga = $carts->sum(function($c){
            return $c->barang->harga * $c->qty * $c->hari;
        });

        return view('pages.cart.index', compact('carts', 'totalHarga'));
    }

    // Tambah ke cart
    public function store(Request $request, $barangId)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
            'hari' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($barangId);

        Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'barang_id' => $barang->id,
            ],
            [
                'qty' => $request->qty,
                'hari' => $request->hari,
            ]
        );

        return redirect()->route('cart.index')->with('success', 'Barang berhasil ditambahkan ke cart!');
    }

    // Hapus dari cart
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);

        if ($cart->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $cart->delete();

        return redirect()->route('pages.cart.index')->with('success', 'Barang dihapus dari cart!');
    }
}
