<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('単語一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <a href="{{ route('word.create') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">単語を登録する</a>
        @foreach($words as $word)
        <div class="flex justify-center text-center items-center p-6 m-6 border">
            <div class="columns-1">
                <p>{{$word->en_word}}</p>
                <p>{{$word->ja_word}}</p>
                <a href="{{ route('word.show', ['word' => $word->id]) }}">詳細</a>
                <form action="{{ route('word.destroy', ['word' => $word->id]) }}" id="form_{{ $word->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deleteWord({{ $word->id }})">delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <script>
        function deleteWord(id) {
            'use strict'

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>