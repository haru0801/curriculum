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
    
    public function map()
    {
        $apiKey = env('GOOGLE_PLACES_API_KEY');  // あなたのGoogle Places APIキーを設定
        $lat = 35.730132;  // 緯度を設定
        $lon = 139.708302;  // 経度を設定
        $search = "ラーメン";  // 検索ワードを設定
        
        // Google Places APIのURLを構築
        $url = sprintf(
            "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=%s,%s&radius=1500&type=restaurant&keyword=%s&language=ja&key=%s",
            $lat,
            $lon,
            urlencode($search),
            $apiKey
        );
        
        // cURLを使用してAPIリクエストを送信
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        // JSONレスポンスを配列にデコード
        $places = json_decode($response, true)['results'];
        
        $details = [];
        foreach($places as $place)
        {
            $placeId = $place['place_id'];  // 特定の場所のplace_idを設定
            
            // Google Places APIのURLを構築
            $url = sprintf(
                "https://maps.googleapis.com/maps/api/place/details/json?place_id=%s&language=ja&key=%s",
                 //"https://maps.googleapis.com/maps/api/place/details/json?place_id=%25s&fields=geometry/location&key=%25s", //座標
                $placeId,
                $apiKey
            );
            
            // cURLを使用してAPIリクエストを送信
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            
            // JSONレスポンスを配列にデコード
            $detail = json_decode($response, true)['result'];
            $details[] = $detail;
        }
        
            dd($details);
    }
    
    
}
?>