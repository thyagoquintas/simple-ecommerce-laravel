<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Tag;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('VerifyCategoriesCount')->only(['create','store']);
    }

    public function index()
    {
        return view('products.index')->with('products',Product::all());
    }

    public function create()
    {
        return view('products.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    public function store(CreateProductRequest $request)
    {
        //cria a imagem;
        $image = $request->image->store('products');
        $product = Product::create($request->all());

        //atualiza o endereço da imagem no banco
        $product->image = $image;
        $product->save();

        //salva os dados das tags
        if($request->tags){
            $product->tags()->attach($request->tags);
        }

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
        return view('products.edit')->with('product', $product)->with('categories', Category::all())->with('tags', Tag::all());
    }

    public function update(EditProductRequest $request, Product $product)
    {
        
        
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'category_id' => $request->category_id
        ]);

        $product->tags()->sync($request->tags);

        if($request->image){
            //apaga imagem anterior
            Storage::delete($product->image);

            //cria a imagem;
            $image = $request->image->store('products');

            //atualiza o endereço da imagem no banco
            $product->image = $image;
            $product->save();
        }

        session()->flash('success', 'Produto alterado com sucesso!');
        return redirect(route('products.index'));
    }

    public function destroy($id)
    {
        $product = Product::withTrashed()->where('id', $id)->firstOrFail();

        if($product->trashed()){
            Storage::delete($product->image);
            $product->forceDelete();
            session()->flash('success', 'Produto removido com sucesso!');
        }else{
            $product->delete();
            session()->flash('success', 'Produto movido para lixeira com sucesso!');
        }
        return redirect()->back();
    }

    public function trashed(){
        return view('products.index')->with('products',Product::onlyTrashed()->get());
    }

    public function restore($id){
        $product = Product::withTrashed()->where('id', $id)->firstOrFail();
        $product->restore();
        session()->flash('success', 'Produto ativado com sucesso!');
        return redirect()->back();
    }

}
