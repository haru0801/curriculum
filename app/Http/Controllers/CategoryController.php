<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Style;


class CategoryController extends Controller
{
    public function index(Category $category)
    {
        return view('categories.index')->with(['posts' => $category->getByCategory()]);
    }
    
    public function show(Category $category)
    {
        return view('categories.show')->with(['category' => $category]);
    }
    
    public function style(Post $post, Category $category, Style $style)
    {
        $post = Post::where('category_id', $category->id)->where('style_id', $style->id)->get();
        return view('categories.style')->with(['posts' => $post, 'category' => $category, 'style' => $style]);
    }
}
