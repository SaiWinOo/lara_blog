<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(request('keyword'),function ($q){
            $keyword = request('keyword');
            $q->orWhere('name','like',"%$keyword%")->
                orWhere('description','like',"%$keyword%");
        })->when(Auth::user()->isAuthor(),fn($q)=>$q->where('user_id', Auth::id()))
        ->with(['category','user'])->latest('id')->paginate(10)->withQueryString();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        $post->excerpt  = Str::words($request->description, 50);
        if($request->hasFile('featured_image')){
            $newName = uniqid()."_featured_image_".$request->file('featured_image')->extension();
            $request->file('featured_image')->storeAs('public',$newName);
            $post->featured_image = $newName;
        }
        $post->save();

        foreach ($request->photos as $photo){
            $newName = uniqid()."_post_photo.".$photo->extension();
            $photo->storeAs('public',$newName);

            $image = new Photo();
            $image->post_id = $post->id;
            $image->name = $newName;
            $image->save();
        }

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
//        return $post;
        Gate::authorize('view',$post);
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)

    {
        Gate::authorize('update',$post);
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if( Gate::denies('update',$post)){
            return abort(404,"You are not allowed to update");
        }
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->category_id = $request->category;
        $post->excerpt  = Str::words($request->description, 50);
        if($request->hasFile('featured_image')){

            Storage::delete("public/".$post->featured_image);

            $newName = uniqid()."_featured_image_".$request->file('featured_image')->extension();
            $request->file('featured_image')->storeAs('public',$newName);
            $post->featured_image = $newName;
        }
        if($request->photos){
            foreach ($request->photos as $photo){
                $newName = uniqid()."_post_photo.".$photo->extension();
                $photo->storeAs('public',$newName);

                $image = new Photo();
                $image->post_id = $post->id;
                $image->name = $newName;
                $image->save();
            }
        }
        $post->update();
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Gate::denies('delete',$post)){
            return abort(403, "You are not allowed to delete");
        }
        if(isset($post->featured_image)){
            Storage::delete("public/".$post->featured_image);
        }
        foreach($post->photos as $photo){
            Storage::delete("public/".$photo->name);
            $photo->delete();
        }
        $post->delete();
        return redirect()->route('post.index');
    }
}
