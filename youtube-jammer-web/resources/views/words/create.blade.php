<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('単語追加') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <a href="{{ route('word.index') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">一覧に戻る</a>
        <form action="{{ route('word.store') }}" method="POST">
        @csrf
            <p>単語</p>
            <input type="text" name="word[en_word]" placeholder="apple"/>
            <input type="text" name="word[ja_word]" placeholder="りんご"/>
            <p>例文</p>
            <input type="text" name="word[en_sentence]" placeholder="I have a pen."/>
            <input type="text" name="word[ja_sentence]" placeholder="私はペンを持っています。"/>
            <p>その他</p>
            <input type="text" name="word[description]" placeholder="品詞やその他の情報"/>
            <input type="submit" value="追加する"/>
        </form>
    </div>
</x-app-layout>
