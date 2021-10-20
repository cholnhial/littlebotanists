<?php
$categoryType = $_GET['plantCategoryType'];
$module = $_GET['module'];
?>

<style>

    a:hover,
    a:visited,
    a:focus
    {text-decoration: none !important;}

    /**

    Obtained from, and slightly modified
     https://codepen.io/dromo77/pen/ZEQWyaZ

      Used to present multi-choice questions
    */
    :root {
        --card-line-height: 1.2em;
        --card-padding: 1em;
        --card-radius: 0.5em;
        --color-green: #558309;
        --color-gray: #e2ebf6;
        --color-dark-gray: #c4d1e1;
        --radio-border-width: 2px;
        --radio-size: 1.5em;
    }

    .grid {
        display: grid;
        grid-gap: var(--card-padding);
        margin: 0 auto;
        max-width: 60em;
        padding: 0;
    }
    @media (min-width: 42em) {
        .grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    .quiz-card {
        background-color: #fff;
        border-radius: var(--card-radius);
        position: relative;
        border: 0;
    }

    .radio {
        font-size: inherit;
        margin: 0;
        position: absolute;
        right: calc(var(--card-padding) + var(--radio-border-width));
        top: calc(var(--card-padding) + var(--radio-border-width));
    }
    @supports (-webkit-appearance: none) or (-moz-appearance: none) {
        .radio {
            -webkit-appearance: none;
            -moz-appearance: none;
            background: #fff;
            border: var(--radio-border-width) solid var(--color-gray);
            border-radius: 50%;
            cursor: pointer;
            height: var(--radio-size);
            outline: none;
            transition: background 0.2s ease-out, border-color 0.2s ease-out;
            width: var(--radio-size);
        }
        .radio::after {
            border: var(--radio-border-width) solid #fff;
            border-top: 0;
            border-left: 0;
            content: '';
            display: block;
            height: 0.75rem;
            left: 25%;
            position: absolute;
            top: 50%;
            transform: rotate(45deg) translate(-50%, -50%);
            width: 0.375rem;
        }
        .radio:checked {
            background: var(--color-green);
            border-color: var(--color-green);
        }
        .quiz-card:hover .radio {
            border-color: var(--color-dark-gray);
        }
        .quiz-card:hover .radio:checked {
            border-color: var(--color-green);
        }
    }
    .choice-details {
        border: var(--radio-border-width) solid var(--color-gray);
        border-radius: var(--card-radius);
        cursor: pointer;
        display: flex;
        flex-direction: column;
        padding: var(--card-padding);
        transition: border-color 0.2s ease-out;
    }
    .quiz-card:hover .choice-details {
        border-color: var(--color-dark-gray);
    }
    .radio:checked ~ .choice-details {
        border-color: var(--color-green);
    }
    .radio:focus ~ .choice-details {
        box-shadow: 0 0 0 2px var(--color-dark-gray);
    }
    .radio:disabled ~ .choice-details {
        color: var(--color-dark-gray);
        cursor: default;
    }
    .radio:disabled ~ .choice-details .choice-letter {
        color: var(--color-dark-gray);
    }
    .quiz-card:hover .radio:disabled ~ .choice-details {
        border-color: var(--color-gray);
        box-shadow: none;
    }
    .quiz-card:hover .radio:disabled {
        border-color: var(--color-gray);
    }
    .choice-letter {
        color: var(--color-green);
        font-size: 1.5rem;
        font-weight: bold;
        line-height: 1em;
    }
    .choice-description {
        font-size: 2.5rem;
        font-weight: bold;
        padding: 0.5rem 0;
    }
    .slash {
        font-weight: normal;
    }
    .plan-cycle {
        font-size: 2rem;
        font-variant: none;
        border-bottom: none;
        cursor: inherit;
        text-decoration: none;
    }
    .hidden-visually {
        border: 0;
        clip: rect(0, 0, 0, 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        white-space: nowrap;
        width: 1px;
    }
/* END MCQ */


/*
 Start Dragable

 Obtained from https://codepen.io/PortSpasy/pen/MWwaooJ, slightly modified
 Used to present dragable questions in quiz
 */

    .score {
        font-family: monospace;
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        letter-spacing: 0.25rem;
        margin: 1rem;
        position: relative;
        transition: opacity 0.2s;
    }
    .draggable-items {
        display: flex;
        justify-content: center;
        margin: 1rem 1rem 1.5rem 1rem;
        transition: opacity 0.5s;
    }
    .draggable {
        height: 5rem;
        width: 5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        font-weight: bold;
        margin: 0rem 0.5rem;
        cursor: move;
        transition: opacity 0.2s;
    }
    .draggable:hover {
        opacity: 0.5;
    }
    .matching-pairs {
        transition: opacity 0.5s;
    }
    .matching-pair {
        height: 6rem;
        width: 22rem;
        margin: 1rem auto;
        display: flex;
        justify-content: space-between;
    }
    .matching-pair span {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        user-select: none;
    }
    .label {
        width: 15rem;
        font-size: 2rem;
    }
    .droppable {
        width: 6rem;
        font-size: 4rem;
        background-color: #fff;
        border: 3px dashed #111;
        transition: 0.2s;
    }
    .droppable-hover {
        background-color: #bee3f0;
        transform: scale(1.1);
    }
    .dropped {
        border-style: solid;
    }
    .dragged {
        user-select: none;
        opacity: 0.1;
        cursor: default;
    }
    .draggable.dragged:hover {
        opacity: 0.1;
    }

    @media (max-width: 600px) {
        html { font-size: 14px; }
    }
/* End Draggable */
</style>

<h3 id="global-score" class="float-end text-patrick-hand mt-3">Score: <span id="user-score"></span></h3>
<!-- Start Area for MCQ -->
<div class="mcq-container">
    <h3 id="mcq-question" class="my-4 text-center">Loading...</h3>
    <div class="mx-auto text-center my-5">
        <div id="mcq-answer-correct" style="width: 15rem" class="mx-auto d-none">
            <div class="card shadow-sm p-3" >
                <h5>Correct!</h5>
                <i class="far fa-2x text-success fa-check-circle"></i>
                <h6>Well Done <?= $_COOKIE['username'] ?></h6>
            </div>
        </div>
        <div id="mcq-answer-wrong" style="width: 15rem" class="mx-auto d-none">
            <div class="card shadow-sm p-3" >
                <h5>Almost got it!</h5>
                <i class="far fa-2x text-danger fa-times-circle"></i>
                <h6>Sorry that was wrong, good luck for the next one.</h6>
            </div>
        </div>
    </div>
    <div class="row row-cols-sm-2" id="mcq-choices">
    </div>
    <div class="btn-group float-end">
        <button id="submit-mcq-question" class="btn btn-outline-success">Submit</button>
        <button id="skip-mcq-question" class="btn btn-outline-danger">Skip</button>
    </div>

</div>
<!-- End Area for MCQ -->

<!-- Drag & Drop -->
<div class="dnd-match-pic-to-name-container d-none">
    <section class="score">
        <span class="correct">0</span>/<span class="total">0</span>
    </section>
    <section class="draggable-items">

    </section>
    <section class="matching-pairs">

    </section>
</div>
<!-- End Drag & Drop -->

<div class="spelling-container mx-auto d-none">

    <div class="mx-auto">
        <div class="mx-auto" style="width: 30rem">
            <h2 class="text-center text-patrick-hand mb-4">Spelling Game</h2>
            <h6 class="text-center text-patrick-hand">Spell the word that you hear</h6>
            <div onclick="spellingGamePlayAudio()" class="card menu-card mx-auto mb-5" style="width: 12rem">
                <div class="card-body text-center">
                    <h6 class="text-patrick-hand">Click to play sound</h6>
                    <i class="fas fa-3x fa-volume-up"></i>
                </div>
            </div>
        </div>
        <div class="mx-auto text-center" style="width: 30rem">
            <div id="spelling-correct" class="d-none">
                <i class="far fa-2x text-success fa-check-circle"></i>
                <h6>Well Done <?= $_COOKIE['username'] ?></h6>
            </div>
            <div id="spelling-wrong" class="d-none">
                <i class="far fa-2x text-danger fa-times-circle"></i>
                <h6>Sorry that was wrong, try again.</h6>
            </div>
        </div>
        <div class="mx-auto" style="width: 30rem">
            <input id="spelling-input" class="form-control w-100 form-control-lg" />
        </div>
        <div class="mx-auto mt-4 d-flex justify-content-end" style="width: 30rem">
            <div class="btn-group float-right">
                <button id="spelling-game-submit" class="btn rounded btn-outline-primary">Submit</button>
                <button id="spelling-game-next" class="btn rounded btn-outline-success d-none">Next</button>
                <button id="spelling-game-finish" class="btn rounded btn-outline-success d-none">Finish</button>
            </div>
        </div>

    </div>

</div>

<!-- Score -->
<div class="score-container d-none text-center">
    <div class="text-center" style="margin-top: 12%">
        <img class="lblogo" src="img/Logo.png" alt="logo"/>
        <h3 class="text-center">Well done <?= $_COOKIE['username'] ?> your score is <span id="end-user-score"></span></h3>
        <h6 class="text-center text-muted">What would you like to do next?</h6>
    </div>
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col">
            <a class="text-decoration-none" href="index.php?cat=study_categories&plantCategoryType=<?= $categoryType?>&module=<?=$module?>">
                <div class="card menu-card">
                    <div class="card-body text-center">
                        <h2>Study Again</h2>
                        <i class="fas fa-3x fa-graduation-cap"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a class="text-decoration-none" href="index.php?cat=leaderboard">
            <div class="card menu-card">
                <div class="card-body text-center">
                    <h2>Leadership Board</h2>
                    <i class="fas fa-3x fa-chart-line"></i>
                </div>
            </div>
            </a>
        </div>
        <div class="col-3">
        </div>
    </div>
</div>


<!-- End Score -->


<script>
    var userGameScore = 0;
    var questionsMCQ = null;
    var nextQuestionMCQ = 0;
    var nextQuestionSpellingGame = 0;
    var questionsSpellingGame = null;
    var MCQDone = false;
    var spellingGameDone = false;

   async function getGameTypeQuestions(type) {
        return fetch('/data/module-quiz.json')
            .then(async function(resp) {
                let gameData = await resp.json();
                let questions =  gameData['<?= $categoryType?>'].filter(questionGroup => questionGroup.type === type);

                return questions[0].questions;
            });
    }

    function updateScore() {
       $('#user-score').html(userGameScore);
    }

    function displayQuestionMCQ(question) {

       setTimeout(function() {
           // Hide feedbacks
           $('#mcq-answer-correct').addClass('d-none');
           $('#mcq-answer-wrong').addClass('d-none');

           $('#mcq-question').html(question.question);
           $('#mcq-choices').html('');
           question.answers.forEach((c,i) => {
               $('#mcq-choices').append(`
                 <label class="quiz-card mb-2">
                    <input value=${i}  name="choice" class="radio" type="radio">

                    <span class="choice-details">
                    <span class="choice-letter">${c.letter}</span>
                    <span class="choice-description">${c.text}</span>
                 </span>
                 </label>
               `)
           });

           restartAnimation('.mcq-container', 'animate__animated animate__slideInLeft')
       }, 2500);

    }

    async function initMCQ() {
        questionsMCQ  = await getGameTypeQuestions("mcq");
        displayQuestionMCQ(questionsMCQ[0], 0);
    }

    async function initSpellingGame() {
       questionsSpellingGame = await getGameTypeQuestions("spelling-game");
       questionsSpellingGame = generateRandomItemsArray(questionsSpellingGame.length, questionsSpellingGame);
    }

    function showSpellingGameFeedback() {
           let userSpelling = $('#spelling-input').val();

           let isCorrect = userSpelling.toLocaleLowerCase() ===
               questionsSpellingGame[nextQuestionSpellingGame].word.toLocaleLowerCase();

           if(isCorrect) {
                $('#spelling-correct').removeClass('d-none');
                restartAnimation('#spelling-correct', 'animate__animated animate__flash');
                $('#spelling-wrong').addClass('d-none')
               $('#spelling-game-submit').addClass('d-none');
               $('#spelling-game-next').removeClass('d-none');
                userGameScore += 10;

           } else {
               $('#spelling-wrong').removeClass('d-none');
               restartAnimation('#spelling-wrong', 'animate__animated animate__flash');
               $('#spelling-correct').addClass('d-none');
           }
    }

    function spellingGamePlayAudio() {
        responsiveVoice.speak(questionsSpellingGame[nextQuestionSpellingGame].word);
    }




    function goToNextMCQQuestion() {
        nextQuestionMCQ++;
        if(nextQuestionMCQ == questionsMCQ.length) {
            MCQDone = true;
            $('.mcq-container').addClass('d-none');
            $('.dnd-match-pic-to-name-container').removeClass('d-none');
        } else {
            displayQuestionMCQ(questionsMCQ[nextQuestionMCQ]);
        }

    }

    function beginGame() {
        initMCQ();
    }

    function updateUserScoreOnServer() {
        $.ajax({
            url: '/ajax.php',
            contentType: 'application/json',
            data: JSON.stringify({'action': 'update_score', "name": "<?= $_COOKIE['username'] ?>", "score": userGameScore }),
            dataType: 'json',
            success: function(data){

            },
            error: function(){
                //TODO handle error
            },
            processData: false,
            type: 'POST',

        });
    }

    function endQuiz() {
       $('.spelling-container').addClass('d-none');
       $('.score-container').removeClass('d-none');
       $('#end-user-score').html(userGameScore);
       $('#global-score').addClass('d-none');
       updateUserScoreOnServer();
    }

    $(document).ready(function() {

        beginGame();

        $('#skip-mcq-question').click(function () {
            goToNextMCQQuestion();
        });

        $('#spelling-game-next').click(function () {
            $('#spelling-correct').addClass('d-none');
            $('#spelling-game-submit').removeClass('d-none');
            $('#spelling-input').val("");
            if (nextQuestionSpellingGame < questionsSpellingGame.length) {
                nextQuestionSpellingGame++;
                $('#spelling-game-next').addClass('d-none');

                // On last question
                if (nextQuestionSpellingGame + 1 === questionsSpellingGame.length) {
                    spellingGameDone = true;
                }
            } else {
                // do nothing
            }
        });

        $('#spelling-game-submit').click(function () {
            showSpellingGameFeedback();
            if (spellingGameDone) {
                $('#spelling-input').val("");
                $('#spelling-game-next').addClass('d-none');
                $('#spelling-game-submit').addClass('d-none');
                $('#spelling-game-finish').removeClass('d-none');
            }
        });

        $('#spelling-game-finish').click(function () {
            endQuiz();
        });


        $('#submit-mcq-question').click(function () {
            let answerIndex = $('input[type="radio"][name="choice"]:checked').val();
            if (questionsMCQ[nextQuestionMCQ].answers[answerIndex].isCorrectAnswer) {
                $('#mcq-answer-correct').removeClass('d-none');
                restartAnimation('#mcq-answer-correct', 'animate__animated animate__flash');
                $('#mcq-answer-wrong').addClass('d-none');
                userGameScore += 10;
                updateScore();
            } else {
                $('#mcq-answer-wrong').removeClass('d-none');
                restartAnimation('#mcq-answer-wrong', 'animate__animated animate__flash');
                $('#mcq-answer-correct').addClass('d-none');

            }

            goToNextMCQQuestion();
        });
    });

    
    /**
     *  Obtained from https://codepen.io/PortSpasy/pen/MWwaooJ
     *  Slightly modified 
     *
     *  Used for Drag & Drop logic 
     */
    let correct = 0;
    let total = 0;
    const totalDraggableItems = 3;
    const totalMatchingPairs = 3; // Should be <= totalDraggableItems

    const scoreSection = document.querySelector(".score");
    const correctSpan = scoreSection.querySelector(".correct");
    const totalSpan = scoreSection.querySelector(".total");
    const playAgainBtn = scoreSection.querySelector("#play-again-btn");

    const draggableItems = document.querySelector(".draggable-items");
    const matchingPairs = document.querySelector(".matching-pairs");
    let draggableElements;
    let droppableElements;

    initiateGame();

   async function initiateGame() {
        let questions = await getGameTypeQuestions('dnd-match-pic-to-name');
        var questionsArr = [];
        questions.forEach((o) => {
            questionsArr.push(o);
        });
        const randomDraggablePlants = generateRandomItemsArray(totalDraggableItems, questionsArr);
        const randomDroppablePlants = totalMatchingPairs<totalDraggableItems ? generateRandomItemsArray(totalMatchingPairs, randomDraggablePlants) : randomDraggablePlants;
        const alphabeticallySortedRandomDroppableBrands = [...randomDroppablePlants].sort((a,b) => a.name.toLowerCase().localeCompare(b.name.toLowerCase()));

        // Create "draggable-items" and append to DOM
        for(let i=0; i<randomDraggablePlants.length; i++) {
            draggableItems.insertAdjacentHTML("beforeend", `
     <img class="img-thumbnail draggable" draggable="true" src="${randomDraggablePlants[i].image}" id="${randomDraggablePlants[i].name}" />
    `);
        }

        // Create "matching-pairs" and append to DOM
        for(let i=0; i<alphabeticallySortedRandomDroppableBrands.length; i++) {
            matchingPairs.insertAdjacentHTML("beforeend", `
      <div class="matching-pair">
        <span class="label">${alphabeticallySortedRandomDroppableBrands[i].name}</span>
       <img class="droppable" data-src="${alphabeticallySortedRandomDroppableBrands[i].image}" data-brand="${alphabeticallySortedRandomDroppableBrands[i].name}" />
      </div>
    `);
        }

        draggableElements = document.querySelectorAll(".draggable");
        droppableElements = document.querySelectorAll(".droppable");

        draggableElements.forEach(elem => {
            elem.addEventListener("dragstart", dragStart);
            // elem.addEventListener("drag", drag);
            // elem.addEventListener("dragend", dragEnd);
        });

        droppableElements.forEach(elem => {
            elem.addEventListener("dragenter", dragEnter);
            elem.addEventListener("dragover", dragOver);
            elem.addEventListener("dragleave", dragLeave);
            elem.addEventListener("drop", drop);
        });
    }

    // Drag and Drop Functions

    //Events fired on the drag target

    function dragStart(event) {
        event.dataTransfer.setData("text", event.target.id); // or "text/plain"
    }

    //Events fired on the drop target

    function dragEnter(event) {
        if(event.target.classList && event.target.classList.contains("droppable") && !event.target.classList.contains("dropped")) {
            event.target.classList.add("droppable-hover");
        }
    }

    function dragOver(event) {
        if(event.target.classList && event.target.classList.contains("droppable") && !event.target.classList.contains("dropped")) {
            event.preventDefault();
        }
    }

    function dragLeave(event) {
        if(event.target.classList && event.target.classList.contains("droppable") && !event.target.classList.contains("dropped")) {
            event.target.classList.remove("droppable-hover");
        }
    }

    function drop(event) {
        event.preventDefault();
        event.target.classList.remove("droppable-hover");
        const draggableElementBrand = event.dataTransfer.getData("text");
        const droppableElementBrand = event.target.getAttribute("data-brand");
        const isCorrectMatching = draggableElementBrand===droppableElementBrand;
        total++;
        if(isCorrectMatching) {
            const draggableElement = document.getElementById(draggableElementBrand);
            event.target.classList.add("dropped");
            draggableElement.classList.add("dragged");
            draggableElement.setAttribute("draggable", "false");
            console.log(event.target);
            $(event.target).attr("src", $(event.target).data('src'));
            correct++;
            userGameScore += 10;
            updateScore();
        }
        scoreSection.style.opacity = 0;
        setTimeout(() => {
            correctSpan.textContent = correct;
            totalSpan.textContent = total;
            scoreSection.style.opacity = 1;
        }, 200);
        if(correct===Math.min(totalMatchingPairs, totalDraggableItems)) {
            // Go bring up spelling game
            $(".dnd-match-pic-to-name-container").addClass('d-none');
            $('.spelling-container').removeClass('d-none');
            initSpellingGame();
        }
    }

    // Auxiliary functions
</script>