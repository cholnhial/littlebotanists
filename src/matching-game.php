<?php
?>

<style>

    .text-color-dark {
        color: var(--lbsecondary);
    }

    body {
        background: url(img/match.png) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }



    * {
        font-family: 'Patrick Hand', cursive;
    }

    .text-color {
        color: var(--lbsecondary);
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


<h2 class="text-patrick-hand my-2 text-center text-color">Matching Game</h2
<div class="matching-game-container container">

    <section class="score-panel mt-2 text-color">
        <ul class="stars">
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
        </ul>

        <span class="moves text-color">0</span> Move(s)

        <div class="timer text-color">
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
                    <div class="d-flex justify-content-center">
                        <button class="btn-outline-primary btn me-2" id="play-again"onclick="playAgain()">
                            Play again
                        </button>
                        <a class="btn btn-outline-secondary" href="/index.php?cat=leaderboard&active=matching-game">Leaderboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade"  id="tipModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-color-dark text-center"><span id="guideName"></span> Says...</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <img style="23rem" id="guide" src="" />
                    </div>
                    <div class="col-6 ms-5">
                        <div class="text-center">
                            <i class="fas fa-4x fa-lightbulb help-button-icon"></i>
                        </div>
                        <p class="fs-5 text-color-dark">Welcome to the matching game! The game begins with all of the cards face down. Click on a card and it will flip over, showing you a name and image of a plant. Then select another card which is face down. If you see the same card, its a match!</p>
                        <p class="fs-5 text-color-dark">To complete the game you must match the correct cards together. Please refer to the help tutorial for more information!</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

        var $img = $('img'),
            totalImg = $img.length;

        var waitImgDone = function() {
            totalImg--;
            if (totalImg === 3 || !totalImg) {
                $.LoadingOverlay("hide");
                let tipModal = new bootstrap.Modal(document.getElementById('tipModal'), {});
                setTimeout(function() {
                    let guide = guides.random();
                    $('#guide').attr("src",  "img/" + guide.img);
                    $('#guideName').html(guide.name);
                    tipModal.show();
                }, 1000);
            }
        };

        $('img').each(function() {
            $(this).on('load', waitImgDone);
            $(this).on('error', waitImgDone);
        });

        totalCards = matchingGameCards.length;
        startGame(() => {
            updateUserTimeOnServer((minute * 60)+(hour*60*60)+(second));
        });
        connectEvents();



    }

    $(document).ready(async function() {
        initLoadingOverlay();
        $.LoadingOverlay("show");
       initMatchingGame();


    });


   </script>