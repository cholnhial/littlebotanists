<?php
$categoryType = $_GET['plantCategoryType'];
$module = $_GET['module'];
?>

<style>
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
    #play-again-btn {
        position: absolute;
        top: -0.5rem;
        left: 50%;
        margin-left: -50px;
        font-size: 1rem;
        font-weight: bold;
        color: #fff;
        background-color: #111;
        border: 5px double #fff;
        border-radius: 14px;
        padding: 8px 10px;
        outline: none;
        letter-spacing: .05em;
        cursor: pointer;
        display: none;
        opacity: 0;
        transition: opacity 0.5s, transform 0.5s, background-color 0.2s;
    }
    #play-again-btn:hover {
        background-color: #333;
    }
    #play-again-btn:active {
        background-color: #555;
    }
    #play-again-btn.play-again-btn-entrance {
        opacity: 1;
        transform: translateX(6rem);
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
        #play-again-btn { top: -0.4rem; }
        #play-again-btn.play-again-btn-entrance { transform: translateX(7rem); }
    }
/* End Draggable */
</style>

<h3 id="global-score" class="float-end">Score: <span id="user-score"></span></h3>
<!-- Start Area for MCQ -->
<div class="mcq-container">
    <h3 id="mcq-question" class="my-4 text-center">Who was the last one to die in Star Wars?</h3>
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
        <button id="play-again-btn">Play Again</button>
    </section>
    <section class="draggable-items">

    </section>
    <section class="matching-pairs">

    </section>
</div>
<!-- End Drag & Drop -->

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
            <div class="card menu-card">
                <div class="card-body text-center">
                    <h2>Leadership Board</h2>
                    <i class="far fa-3x fa-chart-line"></i>
                </div>
            </div>
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
    var MCQDone = false;

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
    }

    async function initMCQ() {
        questionsMCQ  = await getGameTypeQuestions("mcq");
        displayQuestionMCQ(questionsMCQ[0], 0);
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

    $(document).ready(function(){

        beginGame();

        $('#skip-mcq-question').click(function(){
            goToNextMCQQuestion();
        });

        $('#submit-mcq-question').click(function() {
            let answerIndex = $('input[type="radio"][name="choice"]:checked').val();
            if(questionsMCQ[nextQuestionMCQ].answers[answerIndex].isCorrectAnswer) {
                alert("Well done " + '<?= $_COOKIE['username'] ?>');
                userGameScore += 10;
                updateScore();
            } else {
                alert("Wrong, you'll do better next time");

            }

            goToNextMCQQuestion();
        });

        /*fetch('/data/module-quiz.json')
        .then(async function(resp) {
            let gameData = await resp.json();
            console.log(gameData);
           mcqQuestions =  gameData['<?= $categoryType?>'].map(questionGroup => {
               if (questionGroup.type === 'mcq') {
                   return questionGroup;
               }
           })[0].questions;

           console.log(mcqQuestions);

           mcqQuestions.forEach(q => {
               $('#mcq-question').html(q.question);
               q.answers.forEach(c => {
                   $('#mcq-choices').append(`
                 <label class="card mb-2">
                    <input name="choice" class="radio" type="radio" checked>

                    <span class="choice-details">
                    <span class="choice-letter">${c.letter}</span>
                    <span class="choice-description">${c.text}</span>
                 </span>
                 </label>
               `)
               });
           });

        });*/
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

   async function initiateGame() {
        let questions = await getGameTypeQuestions('dnd-match-pic-to-name');
        var questionsArr = [];
        questions.forEach((o) => {
            questionsArr.push(o);
        });
        console.log("Questions: " + questionsArr);
        const randomDraggableBrands = generateRandomItemsArray(totalDraggableItems, questionsArr);
        const randomDroppableBrands = totalMatchingPairs<totalDraggableItems ? generateRandomItemsArray(totalMatchingPairs, randomDraggableBrands) : randomDraggableBrands;
        const alphabeticallySortedRandomDroppableBrands = [...randomDroppableBrands].sort((a,b) => a.name.toLowerCase().localeCompare(b.name.toLowerCase()));

        // Create "draggable-items" and append to DOM
        for(let i=0; i<randomDraggableBrands.length; i++) {
            draggableItems.insertAdjacentHTML("beforeend", `
     <img class="img-thumbnail draggable" draggable="true" src="${randomDraggableBrands[i].image}" id="${randomDraggableBrands[i].name}" />
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
        if(correct===Math.min(totalMatchingPairs, totalDraggableItems)) { // Game Over!!

            $(".dnd-match-pic-to-name-container").addClass('d-none');
            $('.score-container').removeClass('d-none');
            $('#end-user-score').html(userGameScore);
            $('#global-score').addClass('d-none');

            updateUserScoreOnServer();
            /*playAgainBtn.style.display = "block";
            setTimeout(() => {
                playAgainBtn.classList.add("play-again-btn-entrance");
            }, 200)*/;
        }
    }

    // Other Event Listeners
    playAgainBtn.addEventListener("click", playAgainBtnClick);
    function playAgainBtnClick() {
        playAgainBtn.classList.remove("play-again-btn-entrance");
        correct = 0;
        total = 0;
        draggableItems.style.opacity = 0;
        matchingPairs.style.opacity = 0;
        setTimeout(() => {
            scoreSection.style.opacity = 0;
        }, 100);
        setTimeout(() => {
            playAgainBtn.style.display = "none";
            while (draggableItems.firstChild) draggableItems.removeChild(draggableItems.firstChild);
            while (matchingPairs.firstChild) matchingPairs.removeChild(matchingPairs.firstChild);
            initiateGame();
            correctSpan.textContent = correct;
            totalSpan.textContent = total;
            draggableItems.style.opacity = 1;
            matchingPairs.style.opacity = 1;
            scoreSection.style.opacity = 1;
        }, 500);
    }

    // Auxiliary functions
    function generateRandomItemsArray(n, originalArray) {
        let res = [];
        let clonedArray = [...originalArray];
        if(n>clonedArray.length) n=clonedArray.length;
        for(let i=1; i<=n; i++) {
            const randomIndex = Math.floor(Math.random()*clonedArray.length);
            res.push(clonedArray[randomIndex]);
            clonedArray.splice(randomIndex, 1);
        }
        return res;
    }
</script>