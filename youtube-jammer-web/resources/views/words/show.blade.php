<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('単語一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <a href="{{ route('word.index') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">一覧に戻る</a>
        <div class="flex justify-center text-center items-center p-6 m-6 border">
            <div class="columns-1">
                <p>{{$word->en_word}}</p>
                <p>{{$word->ja_word}}</p>
                <p>{{$word->en_sentence}}</p>
                <p>{{$word->ja_sentence}}</p>
                <p>{{$word->description}}</p>
                
            </div>
        </div>
    </div>
</x-app-layout>