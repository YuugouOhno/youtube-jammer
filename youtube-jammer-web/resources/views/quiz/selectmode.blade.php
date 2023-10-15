<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('クイズ画面') }}
      </h2>
  </x-slot>

  <body>
      <div id="quizcontainer">
          @if (session('mode') && session('rank'))
          <div class="alert alert-success">
                  <h2 class="text-8xl font-sans">ランキング</h2>
                  <p>{{ session('mode') }}</p>
                  <p>{{ session('rank') }}位</p>
              </div>
          @endif
          <div class="flex justify-center items-center text-center mt-8">
            <div class="columns-1">
                <p class="text-6xl">挑戦</p>
                <p class="text-2xl">モード選択</p>
                <div class="mb-10">
                    <a href="{{ route('quiz.index', ['mode' => 1]) }}">問題数1</a>
                    <a href="{{ route('quiz.index', ['mode' => 2]) }}">問題数2</a>
                    <a href="{{ route('quiz.index', ['mode' => 3]) }}">問題数3</a>
                </div>
                <p class="text-6xl">レベル上げ</p>
                <a href="{{ route('card')}}">単語帳へ</a>
            </div>
          </div>
      </div>
  </body>
</x-app-layout>