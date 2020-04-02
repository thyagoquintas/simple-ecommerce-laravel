<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;

class CategoriesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
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
