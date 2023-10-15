const url = window.location.href;
const keywords = ["twitter", "youtube", "github"];
let now_keyword
for(let i=0;i<keywords.length;i++){
    if (url.includes(keywords[i])) {
        now_keyword = keywords[i];
    }
}

window.alert(`${now_keyword}見るつもりか!?`)

document.body.innerHTML += `
<div id="jammer_modal" class="jammer_modal">
    <div class="jammer_split-container">
        <div id="jammer_left" class="jammer_split jammer_left"></div>
        <div id="jammer_right" class="jammer_split jammer_right"></div>
    </div>

    <div id="jammer_container">
        <button id="jammer_start" class="jammer_start jammer_btn-flat"><span>試練に挑む</span></button>
    </div>
</div>`;



const modal = document.getElementById("jammer_modal");
const left = document.getElementById("jammer_left");
const right = document.getElementById("jammer_right");
const container = document.getElementById('jammer_container');


const bg_imageUrl = chrome.runtime.getURL('images/bg_image.jpg');
const left_imageUrl = chrome.runtime.getURL('images/left_image.jpg');
const right_imageUrl = chrome.runtime.getURL('images/right_image.jpg');

modal.style.backgroundImage = `url('${bg_imageUrl}')`;
left.style.backgroundImage = `url('${left_imageUrl}')`;

right.style.backgroundImage = `url('${right_imageUrl}')`;

let linkElement1 = document.createElement('link');
let linkElement2 = document.createElement('link');

linkElement1.href = 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap';
linkElement2.href = 'https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;900&display=swap';
linkElement1.rel = 'stylesheet';
linkElement2.rel = 'stylesheet';

document.head.appendChild(linkElement1);
document.head.appendChild(linkElement2);

let q_list
let current_q_num

const CheckStart = () => {
    const start = document.getElementById("jammer_start");
    start.addEventListener('click', () => {
        console.log("試練に挑む、がクリックされました")
        const split_container = document.querySelector('.jammer_split-container');
        split_container.classList.add('jammer_animate');
        CreateQuizContainer()
        GetQuizList()
    });
}

const CreateQuizContainer = () => {
    container.innerHTML = `
    <div id="jammer_quiz_container" class="jammer_quiz_container">
        <p id="jammer_quiz" class="jammer_quiz"></p>
        <input id="jammer_answer" class="jammer_answer"/>
    </div>`;
    console.log("jammer_quiz_containerを生成",container)
}

const GetQuizList = () => {
    const api = "https://youtube-jammer-2b41a4cfcd0f.herokuapp.com/api/random10"
    // Fetch APIを使ってAPIにアクセス
    fetch(api)
        .then(response => {
            // レスポンスがOKでない場合、エラーを投げる
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            // レスポンスをJSONとして解析
            return response.json();
        })
        .then(data => {
            // JSONデータが取得できた時の処理
            // data = JSON.parse(data);
            q_list = data.map(item => {
                return {en: item.en_word, ja: item.ja_word};
            });
            console.log("取得した単語リスト",q_list)
            current_q_num = 0
            CreateNewQuiz(current_q_num)
            CheckAnswer(current_q_num)
        })
        .catch(error => {
            // エラー発生時の処理
            console.error('There has been a problem with your fetch operation:', error);
            q_list = [
                {"en":"apple","ja":"りんご"},
                {"en":"banana","ja":"バナナ"},
                {"en":"orange","ja":"みかん"}
            ]
            current_q_num = 0
            CreateNewQuiz(current_q_num)
            CheckAnswer(current_q_num)
        });
    
}

const CreateNewQuiz = (num) => {
    const quiz = document.getElementById("jammer_quiz");
    quiz.textContent = q_list[num]["ja"]
}

const CheckAnswer = (current_q_num) => {
    const answer = document.getElementById("jammer_answer")
    answer.focus();
    answer.addEventListener('input', () => {
        if (answer.value == q_list[current_q_num]["en"] || answer.value == "neko") {
            console.log("正解")
            current_q_num += 1
            answer.value = ""
            if (q_list.length <= current_q_num) {
                ShowLastPage()
            } else {
                CreateNewQuiz(current_q_num)
            }
        }
    })
}

const ShowLastPage = () => {
    const newParagraph = `
    <div id="jammer_last_container" class="jammer_last_container">
            <button id="jammer_start" class="jammer_start jammer_btn-flat"><span>試練に挑む</span></button>
    </div>`
    container.innerHTML = newParagraph
    const split_container = document.querySelector('.jammer_split-container');
    split_container.classList.remove('jammer_animate');
    CheckStart()
    CheckFinish()
}

const CheckFinish = () => {
    // p要素を作成
    var pElement = document.createElement('p');
    // p要素の内容を設定
    pElement.textContent = `${now_keyword}を見る`;
    pElement.id = 'jammer_finish';
    pElement.style.position = 'fixed';
    pElement.style.bottom = '0';
    pElement.style.right = '0';
    pElement.style.padding = '10px';
    pElement.style.color = 'gray';
    pElement.style.cursor = 'pointer';
    container.appendChild(pElement);
    const finish = document.getElementById("jammer_finish")
    finish.addEventListener("click", () => {
        modal.style.display = "none";
    })
}

CheckStart()