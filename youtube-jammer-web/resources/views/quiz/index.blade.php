<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('クイズ画面') }}
        </h2>
    </x-slot>

    <body class="bg-cover bg-center bg-fixed bg-no-repeat bg-gradient-to-t" style="background-image: url('background.png')">
        <img src="" alt="">
        <div id="quizcontainer" class="flex justify-center items-center text-center mt-8">
            <div class="columns-1">
                <h2 class="text-8xl">よ～い</h2>
                <p id="time" class="text-9xl mt-8"></p>
            </div>
        </div>
        
        <script>
            const words = @json($words);
            const times = @json($times);
            const mode = @json($mode);
            console.log(mode);
            const container = document.getElementById('quizcontainer');
            console.log(words);
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
                    <div>
                        <p class="text-3xl">日本語に合う英単語を入力しなさい</p>
                        <p id="quiz"></p>
                        <input id="answer" autofocus>
                    </div>` 
                    console.log("finish");
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
                    console.log(answer.value);          // 入力の文字確認
                    if (answer.value == words[current_quiz_n]['en_word'] || answer.value == "test") {
                        current_quiz_n += 1;
                        answer.value = "";
                        // 終了画面
                        if (current_quiz_n >= words.length) {
                            const end = performance.now();
                            container.innerHTML =`
                            <div>
                                <p>クリア</p>
                                <form action="/quiz/store" method="POST">
                                    @csrf
                                    <p id="result"></p>
                                    <input type="hidden" id="sub_result"  name="times[time]">
                                    <input type="hidden"  name="times[mode]" value="${mode}">
                                    <input type="submit" value="登録">
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