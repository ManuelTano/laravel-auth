<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();

        return view ('admin.posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate ([
            'title' => 'required|string|min:5|max:50|unique:posts',
            'content' => 'required|string',
            'image' => 'nullable|url',
            ], [
                'title.required' => 'Il titolo è obbligatorio',
                'title.min' => 'Il titolo deve avere almeno :min caratteri',
                'title.max' => 'Il titolo deve avere almeno :max caratteri',
                'title.unique' => "Esiste già un post dal titolo $request->title",
                'image.url' => 'Url dell\'immagine non valido'
            ]);

        $data = $request->all();
	
        $post = new Post();
    
        $data['slug'] = Str::slug($request->title, '-');
    
        $post->fill($data);
        
        $post->slug = Str::slug($post->title, '-');
    
        $post->save();
    
        return redirect()->route('admin.posts.show', $post)
        ->with('message', "Post creato con successo")
        ->with('type', 'success');//
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view ('admin.posts.show', compact ('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        

        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');
        $post->update($data);
        return redirect()->route('admin.posts.show', $post)->with('message', "Post modificato con successo")->with('type', "success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')
        ->with('message', 'Il post è stato eliminato correttamente')
        ->with('type', 'success');
    }
}
