<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('単語編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <a href="{{ route('word.index') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">一覧に戻る</a>
        <form action="{{ route('word.update', ['word' => $word->id]) }}" method="POST">
        @csrf
        @method('PUT')
            <p>単語</p>
            <input type="text" name="word[en_word]" placeholder="apple" value="{{ $word->en_word }}"/>
            <input type="text" name="word[ja_word]" placeholder="りんご" value="{{ $word->ja_word }}"/>
            <p>例文</p>
            <input type="text" name="word[en_sentence]" placeholder="I have a pen." value="{{ $word->en_sentence }}"/>
            <input type="text" name="word[ja_sentence]" placeholder="私はペンを持っています。" value="{{ $word->ja_sentence }}"/>
            <p>その他</p>
            <input type="text" name="word[description]" placeholder="品詞やその他の情報" value="{{ $word->description }}"/>
            <input type="submit" value="編集する"/>
        </form>
    </div>
</x-app-layout>
