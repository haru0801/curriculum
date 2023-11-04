<x-app-layout>
    
    <body>
       
        <h1>Blog Name</h1>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    
                    </h2>
                    <p class='body'>{{ $post->body }}</p>
                   <a href="/chat/{{ $post->user->id }}">{{ $post->user->name }}とチャットする</a>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                    </form>
                </div>
            @endforeach
        </div>
        
        <form action="{{ route('cat') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="photo" accept="image/*">
            <button type="submit">写真をアップロード</button>
        </form>
        <a href='/posts/create'>create</a>
        <div class='paginate'>
            {{ $posts->links() }}
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
</x-app-layout>