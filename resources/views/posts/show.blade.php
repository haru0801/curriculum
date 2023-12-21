<x-app-layout>
    <body>
        <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
        <h1 class = 'title'>
            {{ $post->title }}
        </h1>
        <div class='content'>
            <div class='content_post'>
                <h3>本文</h3>   
                <p class='body'>{{ $post->body }}</p>
                <div>
                <video src="{{ $post->image }}" alt="画像が読み込めません。"/>
            </div>
            </div>   
        </div>
        <div class="edit">
            <a href="/posts/{{ $post->id }}/edit">edit</a>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</x-app-layout>