<?php
?>

<style>

    body {
        background-image: url("/img/quizstudy.png");
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }



    * {
        font-family: 'Patrick Hand', cursive;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    /*
     * Styles for the deck of cards
     */


    .deck {
        width: 85%;
        background: #716F71;
        padding: 1rem;
        border-radius: 4px;
        box-shadow: 8px 9px 26px 0 rgba(46, 61, 73, 0.5);
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: center;
        margin: 0 0 3em;
    }

    .deck .card {
        height: 3.7rem;
        width: 3.7rem;
        margin: 0.2rem 0.2rem;
        background: #141214;;
        font-size: 0;
        color: #ffffff;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 5px 2px 20px 0 rgba(46, 61, 73, 0.5);
    }

    .deck .card.open {
        transform: rotateY(0);
        background: #02b3e4;
        cursor: default;
        animation-name: flipInY;
        -webkit-backface-visibility: visible !important;
        backface-visibility: visible !important;
        animation-duration: .75s;
    }

    .deck .card.show {
        font-size: 33px;
    }

    .deck .card.match {
        cursor: default;
        background: #E5F720;
        font-size: 33px;
        animation-name: rubberBand;
        -webkit-backface-visibility: visible !important;
        backface-visibility: visible !important;
        animation-duration: .75s;
    }

    .deck .card.unmatched {
        animation-name: pulse;
        -webkit-backface-visibility: visible !important;
        backface-visibility: visible !important;
        animation-duration: .75s;
        background: #e2043b;
    }

    .deck .card.disabled {
        pointer-events: none;
        opacity: 0.9;
    }


    /*
     * Styles for the Score Panel
     */


    .score-panel {
        text-align: left;
        margin-bottom: 10px;
    }

    .score-panel .stars {
        margin: 0;
        padding: 0;
        display: inline-block;
        margin: 0 5px 0 0;
    }

    .score-panel .stars li {
        list-style: none;
        display: inline-block;
    }

    .score-panel .restart {
        float: right;
        cursor: pointer;
    }

    .fa-star {
        color: #FFD700;
    }

    .timer {
        display: inline-block;
        margin: 0 1rem;
    }


    /*
     * Styles for congratulations modal
     */


    #starRating li {
        display: inline-block;
    }

    #play-again {
        background-color: #141214;
        padding: 0.7rem 1rem;
        font-size: 1.1rem;
        display: block;
        margin: 0 auto;
        width: 50%;
        color: #ffffff;
        border-radius: 5px;
    }

    /* animations */
    @keyframes flipInY {
        from {
            transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
            animation-timing-function: ease-in;
            opacity: 0;
        }

        40% {
            transform: perspective(400px) rotate3d(0, 1, 0, -20deg);
            animation-timing-function: ease-in;
        }

        60% {
            transform: perspective(400px) rotate3d(0, 1, 0, 10deg);
            opacity: 1;
        }

        80% {
            transform: perspective(400px) rotate3d(0, 1, 0, -5deg);
        }

        to {
            transform: perspective(400px);
        }
    }

    @keyframes rubberBand {
        from {
            transform: scale3d(1, 1, 1);
        }

        30% {
            transform: scale3d(1.25, 0.75, 1);
        }

        40% {
            transform: scale3d(0.75, 1.25, 1);
        }

        50% {
            transform: scale3d(1.15, 0.85, 1);
        }

        65% {
            transform: scale3d(.95, 1.05, 1);
        }

        75% {
            transform: scale3d(1.05, .95, 1);
        }

        to {
            transform: scale3d(1, 1, 1);
        }
    }

    @keyframes pulse {
        from {
            transform: scale3d(1, 1, 1);
        }

        50% {
            transform: scale3d(1.2, 1.2, 1.2);
        }

        to {
            transform: scale3d(1, 1, 1);
        }
    }


    /****** Media queries
    ***************************/


    @media (max-width: 320px) {
        .deck {
            width: 85%;
        }

        .deck .card {
            height: 4.7rem;
            width: 4.7rem;
        }
    }


    /* For Tablets and larger screens
    ****************/

    @media (min-width: 768px) {
        .container {
            font-size: 22px;
        }

        .deck {
            width: 800px;
            height: 680px;
        }

        .deck .card {
            height: 154px;
            width: 154px;
        }

        .popup {
            width: 60%;
        }
    }

    .card-img {
        height: 84px;
        width: 84px;
    }
</style>


<h2 class="text-patrick-hand my-2 text-center">Matching Game</h2
<div class="matching-game-container container">

    <section class="score-panel mt-2">
        <ul class="stars">
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
        </ul>

        <span class="moves">0</span> Move(s)

        <div class="timer">
        </div>

        <div class="restart" onclick=startGame()>
            <i class="fa fa-repeat"></i>
        </div>
    </section>

    <ul class="deck overflow-scroll" id="card-deck" style="height: 33rem !important;">
    </ul>

    <div class="modal" id="congratsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Congratulations 🎉</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        Congratulations you're a winner 🎉🎉
                    </div>
                    <div class="text-center">
                        <p>You made <span id=finalMove> </span> moves </p>
                        <p>in <span id=totalTime> </span> </p>
                        <p>Rating:  <span id=starRating></span></p>
                    </div>
                    <button id="play-again"onclick="playAgain()">
                        Play again 😄</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- End Score -->

<script src="js/matching-game.js"></script>
<script>
    var matchingGameCards = null;

    async function getMatchingGameData() {
        return fetch('/data/module-quiz.json')
            .then(async function(resp) {
                let gameData = await resp.json();
                return gameData['matchingGame'].questions;
            });
    }

    function updateUserTimeOnServer(time) {
        $.ajax({
            url: '/ajax.php',
            contentType: 'application/json',
            data: JSON.stringify({'action': 'update_best_matching_game_time', "name": "<?= $_COOKIE['username'] ?>", "time": time }),
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

    async function initMatchingGame() {
        matchingGameCards = await getMatchingGameData();
        matchingGameCards = generateRandomItemsArray(matchingGameCards.length, matchingGameCards);
        matchingGameCards = matchingGameCards.splice(0, 6);
        matchingGameCards = [...matchingGameCards, ...matchingGameCards];
        matchingGameCards = generateRandomItemsArray(matchingGameCards.length, matchingGameCards);
        $('#card-deck').html('');
        matchingGameCards.forEach(c => {
            $('#card-deck').append(`
                <li class="card" type="${c.commonPlantName}">
                    <div class="d-none mx-auto card-content">
                    <img class="card-img" src="${c.image}" />
                    <h6 class="mt-3 text-center">${c.commonPlantName}</h6>
                    </div>
             </li>

  `);});

        totalCards = matchingGameCards.length;
        startGame(() => {
            updateUserTimeOnServer((minute * 60)+(hour*60*60)+(second));
        });
        connectEvents();



    }

    $(document).ready(async function() {
       initMatchingGame();


    });


   </script>