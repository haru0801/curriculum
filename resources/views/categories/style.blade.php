<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <h1>{{ $category->name }}</h1>
        <h1>{{ $style->name }}</h1>
        <a href="/posts/create">create</a>
         <a href="/categories/{{ $category->id }}/1">family</a>
         <a href="/categories/{{ $category->id }}/2">solo</a>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <p class='body'>{{ $post->body }}</p>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
                    </form>
                </div>
            @endforeach
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <script>
             function deletePost(id) {
                'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    
                     document.getElementById(`form_${id}`).submit();
                
                }
             }
        </script>
    </body>
</html>