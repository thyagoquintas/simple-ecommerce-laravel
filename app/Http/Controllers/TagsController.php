<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\EditTagRequest;

class TagsController extends Controller
{
    public function index()
    {
        return view('tags.index')->with('tags',Tag::all());
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(CreateTagRequest $request)
    {
        Tag::create($request->all());
        session()->flash('success', 'Tag criada com sucesso!');
        return redirect(route('tags.index'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit')->with('tag', $tag);
    }

    public function update(EditTagRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name
        ]);

        session()->flash('success', 'Tag alterada com sucesso!');
        return redirect(route('tags.index'));
    }

    public function destroy($id)
    {
        $tag = Tag::withTrashed()->where('id', $id)->firstOrFail();
        if($tag->trashed()){
            $tag->forceDelete();
            session()->flash('success', 'Tag removida com sucesso!');
        }else{
            $tag->delete();
            session()->flash('success', 'Tag movida para lixeira com sucesso!');
        }
        return redirect()->back();
    }

    public function trashed(){
        return view('tags.index')->with('tags',Tag::onlyTrashed()->get());
    }

    public function restore($id){
        $tag = Tag::withTrashed()->where('id', $id)->firstOrFail();
        $tag->restore();
        session()->flash('success', 'Tag ativada com sucesso!');
        return redirect()->back();
    }
}
