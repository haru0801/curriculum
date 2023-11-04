<x-app-layout>
    <body>
        <h1>この猫なに猫api</h1>
        <div class='cats'>
            @foreach ($cats as $cat)
                <div class='cat'>
                    <h2 class='namee'>{{ $cat[0] }}</h2>
                    <p class='probability'>{{ $cat[1] }}％</p>
            @endforeach
        </div>
        <form action="{{ route('cat') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="photo" accept="image/*">
            <button type="submit">写真をアップロード</button>
        </form>
    </body>
</x-app-layout>