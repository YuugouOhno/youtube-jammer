<x-app-layout>
    <x-slot name="header">
        <style type="text/css">
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                
            }
            h2{
                text-align: center;
            }
            .body {
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .card {
                position: relative;
                width: 50vmin;
                height: 50vmin;
                -webkit-perspective: 1000px;
                perspective: 1000px;
                float: left;

            }
            .card .front, .card .back {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
                transition: transform 1s;
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
                justify-content: center;
            }
            .card .front {
                color: white;
                background: #2a2113;
                border: solid;
                border-color: white;
            }
            .card .back {
                background: #b5a176;
                position: relative;
                transform: rotateY(-180deg);
                border: solid;
                border-color: black;
            }
            .flipped .front {
                transform: rotateY(180deg);
            }
            .flipped .back {
                transform: rotateY(0);
            }
           
            .button_content{
                position: fixed;
                bottom:5px;
                left:5px;
                height: 1.5em;
            }
            .video_play {
                position: absolute;
                display: inline-block;
                width: 1em;
                height: 1em;
                border: 0.05em solid currentColor;
                border-radius: 50%;
                color: #000;
                font-size: 22.5px;
            }
            .video_play::before {
                position: absolute;
                top: 50%;
                left: 30%;
                transform: translateY(-50%);
                width: 0px;
                height: 0px;
                border: 0.3em solid transparent;
                border-left: 0.5em solid currentColor;
                box-sizing: border-box;
                content: "";
            }
            p{
                text-align: center;
                font-size: 15px;
            }
            .word{
                font-size:27.5px;
            }
            .back .id{
                color: red;
            }
            .back .word{
                font-size:27.5px;
                color: red;
            }
            .description{
                font-size:12.5px;
            }
            
        </style>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('単語帳') }}
        </h2>
    </x-slot>
    
    <body>
        @foreach ($words as $word)
            
        <div class="card" id="card_{{$word->id}}">

            <div class="front">
                <p>{{$word->id}}</p>
                <p class="word">{{$word->ja_word}}</p>
            </div>
            <div class="back">
                <p class="id">{{$word->id}}</p>
                <!-- //単語の番号 -->
                <p id="text_{{$word->id}}" class="word">{{$word->en_word}}</p>
                <p>例:{{$word->en_sentence}}</p>
                <p class="description">説明:{{$word->description}}</p>
                <div class="button_content"><button onclick="readAloud({{$word->id}})" class="video_play"></button></div>
            </div>
        </div>
        @endforeach
        
            

        <script>
            const words=@json($words);
            let is_flipped=new Array(words.length).fill(false)
            console.log(is_flipped)
            for(let i = 0; i < words.length; i++){
                const card=document.getElementById(`card_${i+1}`)
                card.addEventListener('click',(event)=>{
                    let target=event.target
                    console.log(target)
                    if(!target.matches('button')){
                        console.log(card)
                        if(is_flipped[i]){
                            console.log(is_flipped[i])
                            card.classList.remove('flipped')
                            is_flipped[i]=false
                        }else{
                            console.log(is_flipped[i])
                            card.classList.add('flipped')
                            is_flipped[i]=true
                        }
                    }
                    
                    
                })
            }
            
        

            function readAloud(id) {
            // テキストを取得
            
                let text=new Array(words.length).fill(false)
                // ブラウザにWeb Speech API Speech Synthesis機能があるか判定
                if ('speechSynthesis' in window) {
                    // 発言を設定
                    const text = document.getElementById(`text_${id}`)
                    console.log(text)
                    const uttr = new SpeechSynthesisUtterance()
                    uttr.text = text.textContent
                    uttr.lang = "en-GB"
                    
                    const voices = speechSynthesis.getVoices()
                    for (let i = 0; i < voices.length; i++) {
                        if (voices[i].lang === 'en-GB') {
                            uttr.voice = voices[i]
                        }
                    }
                    // 発言を再生
                    window.speechSynthesis.speak(uttr)
                    

                } else {
                    alert('大変申し訳ありません。このブラウザは音声合成に対応していません。')
                }
                
            }
            </script>
    </body>
</x-app-layout>