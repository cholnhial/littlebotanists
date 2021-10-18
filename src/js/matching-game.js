/*******
 *
 * We use this code for the matching game and is modified to suite our needs.
 *
 * It was obtained from https://github.com/sandraisrael/Memory-Game-fend
 *
 * We've modified it so that instead of using FontAwesome icons it uses images and text.
 * We've also
 *
 * @type {null}
 */
// cards array holds all cards
let card = null;
let cards = null;

let gameFinishCallBack = null;

// deck of all cards in game
let deck = null;

// declaring move variable
let moves = 0;
let counter = null;

// declare variables for star icons
let stars = null;

// declaring variable of matchedCards
let matchedCard = null;

// stars list
let starsList = null;

// close icon in modal
let closeicon = null;

// declare modal
let modal = null;

// array for opened cards
var openedCards = [];

var totalCards = 0;


// @description shuffles cards
// @param {array}
// @returns shuffledarray
function shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex;

    while (currentIndex !== 0) {
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
};


// @description shuffles cards when page is refreshed / loads
//document.body.onload = startGame();


// @description function to start a new play
function startGame(finishCallBack){

     card = document.getElementsByClassName("card");
     cards = [...card];

// deck of all cards in game
    deck = document.getElementById("card-deck");

// declaring move variable
    counter = document.querySelector(".moves");

// declare variables for star icons
    stars = document.querySelectorAll(".fa-star");

// declaring variable of matchedCards
    matchedCard = document.getElementsByClassName("match");

// stars list
    starsList = document.querySelectorAll(".stars li");

// close icon in modal
    closeicon = document.querySelector(".close");

// declare modal
    modal = new bootstrap.Modal(document.getElementById('congratsModal'), {})

    // empty the openCards array
    openedCards = [];

    // shuffle deck
    cards = shuffle(cards);
    // remove all exisiting classes from each card
    for (var i = 0; i < cards.length; i++){
        deck.innerHTML = "";
        [].forEach.call(cards, function(item) {
            deck.appendChild(item);
        });
        cards[i].classList.remove("show", "open", "match", "disabled");
    }
    // reset moves
    moves = 0;
    counter.innerHTML = moves;
    // reset rating
    for (var i= 0; i < stars.length; i++){
        stars[i].style.color = "#FFD700";
        stars[i].style.visibility = "visible";
    }
    //reset timer
    second = 0;
    minute = 0;
    hour = 0;
    var timer = document.querySelector(".timer");
    timer.innerHTML = "0 mins 0 secs";
    clearInterval(interval);
    gameFinishCallBack = finishCallBack;
}


// @description toggles open and show class to display cards
var displayCard = function (){
    this.classList.toggle("open");
    this.classList.toggle("show");
    this.classList.toggle("disabled");
    $(this).find('.card-content').removeClass('d-none');
};


// @description add opened cards to OpenedCards list and check if cards are match or not
function cardOpen() {
    openedCards.push(this);
    var len = openedCards.length;
    if(len === 2){
        moveCounter();
        if(openedCards[0].type === openedCards[1].type){
            matched();
        } else {
            unmatched();
        }
    }
};


// @description when cards match
function matched(){
    openedCards[0].classList.add("match", "disabled");
    openedCards[1].classList.add("match", "disabled");
    openedCards[0].classList.remove("show", "open", "no-event");
    openedCards[1].classList.remove("show", "open", "no-event");
    var audio = new Audio('/data/correct.wav');
    audio.play();
    openedCards = [];
}


// description when cards don't match
function unmatched(){
    openedCards[0].classList.add("unmatched");
    openedCards[1].classList.add("unmatched");
    disable();
    setTimeout(function(){
        openedCards[0].classList.remove("show", "open", "no-event","unmatched");
        openedCards[1].classList.remove("show", "open", "no-event","unmatched");
        $(openedCards[1]).find('.card-content').addClass('d-none');
        $(openedCards[0]).find('.card-content').addClass('d-none');
        enable();
        openedCards = [];
    },1100);
}


// @description disable cards temporarily
function disable(){
    Array.prototype.filter.call(cards, function(card){
        card.classList.add('disabled');
    });
}


// @description enable cards and disable matched cards
function enable(){
    Array.prototype.filter.call(cards, function(card){
        card.classList.remove('disabled');
        for(var i = 0; i < matchedCard.length; i++){
            matchedCard[i].classList.add("disabled");
        }
    });
}


// @description count player's moves
function moveCounter(){
    moves++;
    counter.innerHTML = moves;
    //start timer on first click
    if(moves == 1){
        second = 0;
        minute = 0;
        hour = 0;
        startTimer();
    }
    // setting rates based on moves
    if (moves > 8 && moves < 12){
        for( i= 0; i < 3; i++){
            if(i > 1){
                stars[i].style.visibility = "collapse";
            }
        }
    }
    else if (moves > 13){
        for( i= 0; i < 3; i++){
            if(i > 0){
                stars[i].style.visibility = "collapse";
            }
        }
    }
}


// @description game timer
var second = 0, minute = 0; hour = 0;
var timer = document.querySelector(".timer");
var interval;
function startTimer(){
    interval = setInterval(function(){
        timer.innerHTML = minute+"mins "+second+"secs";
        second++;
        if(second == 60){
            minute++;
            second=0;
        }
        if(minute == 60){
            hour++;
            minute = 0;
        }
    },1000);
}


// @description congratulations when all cards match, show modal and moves, time and rating
function congratulations(){
    if (matchedCard.length == totalCards){
        clearInterval(interval);
        finalTime = timer.innerHTML;

        // show congratulations modal
        modal.show();

        // declare star rating variable
        var starRating = document.querySelector(".stars").innerHTML;

        //showing move, rating, time on modal
        document.getElementById("finalMove").innerHTML = moves;
        document.getElementById("starRating").innerHTML = starRating;
        document.getElementById("totalTime").innerHTML = finalTime;
        var audio = new Audio('/data/winner.flac');
        audio.play();
        gameFinishCallBack();
    };
}



// @desciption for user to play Again
function playAgain(){
    modal.hide();
    initMatchingGame();
}


function connectEvents() {
    // loop to add event listeners to each card
    for (var i = 0; i < cards.length; i++){
        card = cards[i];
        card.addEventListener("click", displayCard);
        card.addEventListener("click", cardOpen);
        card.addEventListener("click",congratulations);
    };
}
