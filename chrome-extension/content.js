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
    <div id="jammer_modal" class="modal">
        <div id="jammer_container">
            <button id="jammer_startButton" class="start">試練に挑む</button>
        </div>
    </div>`;

const modal = document.getElementById("jammer_modal");
const container = document.getElementById('jammer_container');

let q_list
let current_q_num

const CheckStart = () => {
    const start = document.getElementById("jammer_startButton");
    start.addEventListener('click', () => {
        console.log("試練に挑む、がクリックされました")
        CreateQuizContainer()
        GetQuizList()
        CreateNewQuiz(current_q_num)
        CheckAnswer(current_q_num)
    });
}

const CreateQuizContainer = () => {
    container.innerHTML = `
    <div id="quiz_container">
        <p id="jammer_quiz"></p>
        <input id="jammer_answer" />
    </div>`;
    console.log("quiz_containerを生成",container)
}

const GetQuizList = () => {
    q_list = [
        {"en":"apple","ja":"りんご"},
        {"en":"banana","ja":"バナナ"},
        {"en":"orange","ja":"みかん"}
    ]
    current_q_num = 0
}

const CreateNewQuiz = (num) => {
    const quiz = document.getElementById("jammer_quiz");
    quiz.textContent = q_list[num]["ja"]
}

const CheckAnswer = (current_q_num) => {
    const answer = document.getElementById("jammer_answer")
    answer.addEventListener('input', () => {
        if (answer.value == q_list[current_q_num]["en"]) {
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
    <div id="last_container">
        <button id="jammer_startButton" class="start">試練に挑む</button>
        <button id="jammer_finishButton" class="finish">${now_keyword}を見る</button>
    </div>`
    container.innerHTML = newParagraph
    CheckStart()
    CheckFinish()
}

const CheckFinish = () => {
    const finish = document.getElementById("jammer_finishButton")
    finish.addEventListener("click", () => {
        modal.style.display = "none";
        window.location.replace('https://atcoder.jp');
    })
}

CheckStart()