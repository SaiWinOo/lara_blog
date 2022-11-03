<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(request('keyword'),function($q){
            $keyword = request('keyword');
            $q->orWhere("title","like","%$keyword%")->
            orWhere("description","like","%$keyword%");
        })->latest("id")->with(['user','category'])->paginate(10)->withQueryString();
        return view('index',compact('posts'));
    }

    public function detail($slug){
        $post = Post::where("slug",$slug)->first();
        $photos = $post->photos;
        return view('detail',compact('post','photos'));
    }

    /**
     * @param Category $category
     * @return Category|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function postByCategory($slug){
        $category = Category::where("slug",$slug)->first();
        $posts = Post::where(function ($q){
            $q->when(request('keyword'),function($q){
                $keyword = request('keyword');
                $q->orWhere("title","like","%$keyword%")->
                orWhere("description","like","%$keyword%");
        });
        })  ->where("category_id", $category->id)
            ->latest("id")
            ->with(['user','category'])
            ->paginate(10)
            ->withQueryString();
        return view('index',compact('posts','category'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
