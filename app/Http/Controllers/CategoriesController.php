<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;

class CategoriesController extends Controller
{
    public function __construct(){
    }
    
    public function index()
    {
        return view('categories.index')->with('categories',Category::all());
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create($request->all());
        session()->flash('success', 'Categoria criada com sucesso!');
        return redirect(route('categories.index'));
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

    public function edit(Category $category)
    {
        return view('categories.edit')->with('category', $category);
    }

    public function update(EditCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name
        ]);

        session()->flash('success', 'Categoria alterada com sucesso!');
        return redirect(route('categories.index'));
    }

    public function destroy($id)
    {
        $category = Category::withTrashed()->where('id', $id)->firstOrFail();

        $product_count = $category->products()->count();
        if($category->products()->count() > 0){
            session()->flash('error', 'Não pode ser apagada pois temos ('.$product_count.') produto(s) com essa categoria');
            return redirect()->back();
        }

        if($category->trashed()){
            $category->forceDelete();
            session()->flash('success', 'Categoria removida com sucesso!');
        }else{
            $category->delete();
            session()->flash('success', 'Categoria movida para lixeira com sucesso!');
        }
        return redirect()->back();
    }

    public function trashed(){
        return view('categories.index')->with('categories',Category::onlyTrashed()->get());
    }

    public function restore($id){
        $category = Category::withTrashed()->where('id', $id)->firstOrFail();
        $category->restore();
        session()->flash('success', 'Categoria ativada com sucesso!');
        return redirect()->back();
    }

}
