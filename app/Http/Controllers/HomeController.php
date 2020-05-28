<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Tag;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function show(){
        return view('welcome')->with('products', Product::all()->sortByDesc('price')->take(4));
    }

    public function searchCategory(Category $category){
        return view('store.search')->with('products', $category->products()->paginate(2))->with('title', $category->name);
    }

    public function searchTag(Tag $tag){
        return view('store.search')->with('products', $tag->products()->paginate(1))->with('title', $tag->name);
    }

    public function searchProduct(Request $request){
        $search = $request->query('s');

        if($search){
            $products = Product::where('name','LIKE',"%{$search}%");
            return view('store.search')->with('products', $products->paginate(1))->with('title', $search);
        }else{
            session()->flash('error', 'Você precisa digitar o nome de algum produto.');
            return redirect()->back();
        }        
    }

    public function showProduct(Product $product){
        return view('store.product')->with('product',$product);
    }
}
