<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::paginate(5);
        return view('product', compact('products'));
    }

    public function searchproduct(Request $request)
    {
        $search = $request->input('product_search');
        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')->orWhere('description', 'like', '%' . $search . '%');
        })->paginate(5);
        return view('product',compact('products'));
    }

    public function addproduct(Request $request)
    {
        Product::create($request->all());
        return redirect('product')->with('success', 'Data berhasil ditambahkan');
    }

    public function editproduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return redirect('product')->with('success', 'Data berhasil diubah');
    }

    public function deleteproduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('product')->with('success', 'Data berhasil dihapus');
    }
}
