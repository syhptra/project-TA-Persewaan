<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class IndexController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('pages.index', compact('barang'));
    }
}
