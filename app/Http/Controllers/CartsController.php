<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartsController extends Controller
{
    public function index(){
        $user = auth()->user();
        $cart = $user->cart;

        //se o usuario não tiver carrinho, cria um carrinho vazio
        if($cart == null)
            $cart = $cart = Cart::updateOrCreate(['user_id' => $user->id]);

        return view('carts.index')->with('products', $cart->products);
    }

    public function store(Product $product){
        $user = auth()->user();
        $cart = Cart::updateOrCreate(['user_id' => $user->id]);

        //O produto já está no carrinho
        if($cart->products()->where('product_id', $product->id)->count()){
            session()->flash('error', 'O produto ('.$product->name.') já está no carrinho, não pode ser adicionado novamente.');
        }else{
            $cart->products()->saveMany([$product]);
            session()->flash('success', 'O produto ('.$product->name.') foi adicionado no carrinho.');
        }
        return redirect()->back();
    }

    public function destroy(Product $product){
        $user = auth()->user();
        $cart = $user->cart;

        DB::table('cart_product')->where([['cart_id', $cart->id],['product_id',$product->id]])->delete();
        session()->flash('success', 'O produto ('.$product->name.') foi removido do carrinho.');
        return redirect()->back();
    }
}
