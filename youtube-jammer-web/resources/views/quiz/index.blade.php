<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('クイズ画面') }}
        </h2> --}}
    </x-slot>

    <body>
            <div id="quizcontainer" class="flex justify-center items-center text-center mt-52 z-10 relative">
                <div class="columns-1">
                    <h2 class="text-8xl text-gray-100">よ～い</h2>
                    <p id="time" class="text-9xl mt-8 text-gray-100"></p>
                </div>
            </div>
            
        
        <script>
            const words = @json($words);
            console.log(words);
            const times = @json($times);
            const mode = @json($mode);
            const container = document.getElementById('quizcontainer');
            const time = document.getElementById('time');
            let quiz,answer,start;
            let count = 4;
            let current_quiz_n = 0;
            const countDown = ()=>{
                if(count > 0) {
                    //countが0より大きい場合はcountを1ずつ減らす
                    count -= 1;
                    //タイマー表示要素にcountの数値を表示
                    time.textContent = count;
                } else {
                    //countが0以下になったら0を表示
                    container.innerHTML =`
                    <div class="mt-24">
                        <p class="text-3xl text-gray-100">日本語に合う英単語を入力しなさい</p>
                        <p id="quiz" class="mt-6 mb-2 text-xl text-gray-100"></p>
                        <input id="answer" autofocus>
                    </div>` 
                    clearInterval(countDownTimer); 
                    quiz = document.getElementById('quiz');
                    answer = document.getElementById('answer');
                    CheckAnswer();
                    start = performance.now();
                    NewQuiz(current_quiz_n);
                };
            };
            
            
            const NewQuiz = (n)=>{
                quiz.textContent = words[n]['ja_word'];
            };
            
            const CheckAnswer = ()=>{
                answer.addEventListener('input', ()=>{
                    // console.log(answer.value);           入力の文字確認
                    if (answer.value == words[current_quiz_n]['en_word']) {
                        current_quiz_n += 1;
                        answer.value = "";
                        // 終了画面
                        if (current_quiz_n >= words.length) {
                            const end = performance.now();
                            container.innerHTML =`
                            <div>
                                <p class="text-7xl text-gray-100"> クリア!</p>
                                <form action="/quiz/store" method="POST">
                                    @csrf
                                    <p id="result" class="text-7xl mt-40 mb-20 text-gray-100"></p>
                                    <div class="flex space-x-20">
                                        <a href="{{ route('quiz.index', ['mode' => $mode]) }}" class="text-3xl bg-gray-100 text-black p-1 rounded-md">もう一度</a>
                                        <input type="submit" value="登録" class="text-3xl bg-gray-100 text-black p-1 rounded-md cursor-pointer">
                                    </div>
                                        <input type="hidden" id="sub_result"  name="times[time]">
                                        <input type="hidden"  name="times[mode]" value="${mode}">
                                    </form>
                            </div>`;
                            const result = document.getElementById('result');
                            result.textContent = (Math.floor(end - start))/1000;
                            const sub_result = document.getElementById('sub_result');
                            sub_result.value = (Math.floor(end - start))/1000;
                        } else {
                            NewQuiz(current_quiz_n); 
                        };
                    };
                });
            };
            //1000ミリ秒（1秒）ごとに、countDown関数を実行
            const countDownTimer = setInterval(countDown,1000);
        </script>
    </body>
</x-app-layout>