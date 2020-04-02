<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        return view('products.index')->with('products',Product::all());
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(CreateProductRequest $request)
    {
        Product::create($request->all());
        session()->flash('success', 'Produto criado com sucesso!');
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        return view('products.edit')->with('product', $product);
    }

    public function update(EditProductRequest $request, Product $product)
    {
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock
        ]);

        session()->flash('success', 'Produto alterado com sucesso!');
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
