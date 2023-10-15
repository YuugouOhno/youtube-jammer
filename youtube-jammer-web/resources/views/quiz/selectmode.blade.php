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
                <br><br>
                  <h2 class="text-4xl font-sans text-center text-gray-100">
                    Ranking(問題数別)
                  </h2>
                  <!-- <p>{{ session('mode') }}</p> -->
                  <p class="text-center">
                    <span class="text-2xl font-sans text-gray-100">
                        あなたの順位は… 
                    </span>
                    <span class="text-5xl font-sans text-gray-100 underline">
                        {{ session('rank') }}位
                    </span>
                  </p>
              </div>
          @endif
          <div class="flex justify-center items-center text-center mt-8">
            <div class="columns-1">
                <br>
                <p class="text-3xl text-gray-100 underline font-bold">単語和訳クイズに挑戦！</p>
                <br>
                <br>
                <p class="text-2xl text-gray-100">問題数の選択</p>
                <br>
                <div class="mb-10 text-gray-100">
                    <a href="{{ route('quiz.index', ['mode' => 1]) }}">
                        <button class="bg-gradient-to-b from-red-300 to-red-800 hover:bg-gradient-to-l text-white rounded px-4 py-4 text-2xl font-bold">問題数<br>10</button>
                    </a>
                    <a href="{{ route('quiz.index', ['mode' => 2]) }}">
                        <button class="bg-gradient-to-b from-green-300 to-green-800 hover:bg-gradient-to-l text-white rounded px-4 py-4 text-2xl font-bold">問題数<br>50</button>
                    </a>
                    <a href="{{ route('quiz.index', ['mode' => 3]) }}">
                        <button class="bg-gradient-to-b from-blue-300 to-blue-800 hover:bg-gradient-to-l text-white rounded px-4 py-4 text-2xl font-bold">問題数<br>100</button>
                    </a>
                </div>
                <br>
                <p class="text-2xl text-gray-100">※単語帳で勉強したい方はコチラ</p>
                <br>
                <a href="{{ route('card')}}">
                    <button class="bg-gradient-to-r from-yellow-100 to-yellow-400 hover:bg-gradient-to-l text-black rounded px-4 py-2 text-2xl font-bold">単語帳</button>
                </a>
            </div>
          </div>
      </div>
  </body>
</x-app-layout>