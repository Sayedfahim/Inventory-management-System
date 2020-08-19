var count = 0;

//variables
var quiz = [];
quiz[0] = new Question(
  "What is correct value of this sum, 2+5= ?",
  "6",
  "9",
  "7"
);
quiz[1] = new Question(
  "What is correct value of this sum, 19+4= ?",
  "23",
  "21",
  "24"
);
quiz[2] = new Question(
  "What is the correct multiply, 55 * 2= ?",
  "120",
  "110",
  "115"
);
quiz[3] = new Question(
  "What is the correct multiply, 111 * 2= ?",
  "222",
  "211",
  "232"
);
quiz[4] = new Question(
  "What is the capital city in Bangladesh?",
  "Dhaka",
  "Rangpur",
  "Khulna"
);
quiz[5] = new Question(
  "What is our national fruit?",
  "Jackfruit",
  "Mango",
  "Banana"
);

quiz[6] = new Question(
  "What is our national flower?",
  "water lily",
  "Lotus",
  "jui"
);
quiz[7] = new Question(
  "What is name of our currency?",
  "taka",
  "rupi",
  "dollar"
);
quiz[8] = new Question(
  "What is the correct one?",
  "7*7=59",
  "55-13=44",
  "88/4=22"
);
quiz[9] = new Question(
  "What is our national Bird?",
  "magpie",
  "peacock",
  "hen"
);

var randomQuestion;
var answers = [];
var currentScore = 0;

document.addEventListener("DOMContentLoaded", function (event) {
  btnProvideQuestion();
});

function Question(question, rightAnswer, wrongAnswer1, wrongAnswer2) {
  this.question = question;
  this.rightAnswer = rightAnswer;
  this.wrongAnswer1 = wrongAnswer1;
  this.wrongAnswer2 = wrongAnswer2;
}

function shuffle(o) {
  for (
    var j, x, i = o.length;
    i;
    j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x
  );
  return o;
}

function btnProvideQuestion() {
  if (count != 5) {
    var randomNumber = Math.floor(Math.random() * quiz.length);
    randomQuestion = quiz[randomNumber]; //getQuestion
    answers = [
      randomQuestion.rightAnswer,
      randomQuestion.wrongAnswer1,
      randomQuestion.wrongAnswer2,
    ];
    shuffle(answers);

    document.getElementById("question").innerHTML = randomQuestion.question;
    document.getElementById("answerA").value = answers[0];
    document.getElementById("answerA").innerHTML = answers[0];
    document.getElementById("answerB").value = answers[1];
    document.getElementById("answerB").innerHTML = answers[1];
    document.getElementById("answerC").value = answers[2];
    document.getElementById("answerC").innerHTML = answers[2];
  } else {
    alert("Quiz Finish");
    document.getElementById("question").innerHTML = "";
    document.getElementById("answerA").innerHTML = "";
    document.getElementById("answerB").innerHTML = "";
    document.getElementById("answerC").innerHTML = "";
  }
  count++;
}

function answerA_clicked() {
  var answerA = document.getElementById("answerA").value;
  checkAnswer(answerA);
}

function answerB_clicked() {
  var answerB = document.getElementById("answerB").value;
  checkAnswer(answerB);
}
function answerC_clicked() {
  var answerC = document.getElementById("answerC").value;

  checkAnswer(answerC);
}

function adjustScore(isCorrect) {
  debugger;
  if (isCorrect) {
    currentScore++;
  }

  document.getElementById("score").innerHTML = currentScore;
}

function checkAnswer(answer) {
  if (answer == randomQuestion.rightAnswer) {
    btnProvideQuestion();
    adjustScore(true);
  } else {
    alert(
      `You Enter a Wrong Answer!! Correct Answer is:  ${randomQuestion.rightAnswer}`
    );

    btnProvideQuestion();
  }
}