<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('クイズ画面') }}
      </h2>
  </x-slot>

  <body>
      <div id="quizcontainer">
              <h2 class="text-8xl font-sans">ランキング</h2>
              <p>モード選択</p>
              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif
      </div>
  </body>
</x-app-layout>