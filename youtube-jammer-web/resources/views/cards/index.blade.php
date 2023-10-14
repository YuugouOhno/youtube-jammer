<x-app-layout>
    <x-slot name="header">
        <style type="text/css">
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                font-size: 1.5em;
            }
            .card {
                position: relative;
                width: 200px;
                height: 200px;
                -webkit-perspective: 1000px;
                perspective: 1000px;
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
            }
            .card .front {
                color: #2d1e60;
                background: #ff4f6f;
            }
            .card .back {
                color: #ff4f6f;
                background: #2d1e60;
                transform: rotateY(-180deg);
            }
            .flipped .front {
                transform: rotateY(180deg);
            }
            .flipped .back {
                transform: rotateY(0);
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
                <p>{{$word->ja_word}}</p>
            </div>
            <div class="back">
                <p>{{$word->id}}</p>
                <!-- //単語の番号 -->
                <button onclick="readAloud({{$word->id}})">再生</button>
                <p id="text_{{$word->id}}">{{$word->en_word}}</p>
                <!-- //英語 -->
                <p>例文:{{$word->en_sentence}}</p>
                <p>説明:{{$word->description}}</p>
                
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