<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);  
    }
    
    public function show(Post $post)
    {
        return view('posts/show')->with(['post' => $post]);
    }
    
    public function create(Category $category)
    {
        return view('posts/create')->with(['categories' => $category->get()]);
    }
    
    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
    return view('posts/edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        ddd($input_post);
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function cat(Request $request)
    {
        
        $photo = $request->file('photo');

        $response = Http::withBasicAuth('maru0819', 'haru0801')
            ->attach('image', file_get_contents($photo), $photo->getClientOriginalName())
            ->post('http://whatcat.ap.mextractr.net/api_query',);

       
        $cat = $response->json();
        
        return view('posts/cat')->with(['cats' => $cat]);
    }
    
}
?>