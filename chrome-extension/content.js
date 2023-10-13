const url = window.location.href;
const keywords = ["twitter", "youtube", "github"];
let now_keyword
for(let i=0;i<keywords.length;i++){
    if (url.includes(keywords[i])) {
        now_keyword = keywords[i];
    }
}


document.body.innerHTML += `
    <div id="modal" class="modal">
        <div id="container">
        <button id="startButton" class="start">試練に挑む</button>
        </div>
    </div>`;

const modal = document.getElementById("modal");
const container = document.getElementById('container');
let start
let answer
let q_list
let current_q_num

const CheckStart = () => {
    start = document.getElementById("startButton");
    start.addEventListener('click', () => {
        CreateQuizContainer()
        GetQuizList()
        CreateNewQuiz(current_q_num)
        CheckAnswer(current_q_num)
    });
}

const CreateQuizContainer = () => {
    const newParagraph = `
    <div id="quiz_container">
        <p id="quiz"></p>
        <input id="answer" />
    </div>`
    container.innerHTML = newParagraph
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
    const quiz = document.getElementById("quiz");
    quiz.textContent = q_list[num]["ja"]
}

const CheckAnswer = (current_q_num) => {
    answer = document.getElementById("answer")
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
        <button id="startButton" class="start">試練に挑む</button>
        <button id="finishButton" class="finish">${now_keyword}を見る</button>
    </div>`
    container.innerHTML = newParagraph
    CheckStart()
    CheckFinish()
}

const CheckFinish = () => {
    const finish = document.getElementById("finishButton")
    finish.addEventListener("click", () => {
        modal.style.display = "none";
    })
}

CheckStart()