<?php
require_once ("config.php");
require_once ("services/UserService.php");

$userService = new UserService();

// Get all the user scores
$usersWithQuizScore = $userService->getUsersWithScores();
$usersWithMatchingGameTime = $userService->getUsersWithMatchingGameTime();



?>

<style>
    body {
        background-image: url("/img/leaderboard.png");
        height: 100%;
        background-position-y: 3rem;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .nav-link {
        color: var(--lbsecondary);
    }
</style>

<h2 class="text-center text-patrick-hand">Quiz Leaderboard</h2>
<div class="mt-5 mx-auto" style="width: 45rem">
        <nav>
            <div class="nav nav-tabs  navbar-light bg-light nav-fill" id="nav-tab" role="tablist">
                <button class="normal-font-size nav-link active" id="nav-quiz-tab" data-bs-toggle="tab" data-bs-target="#nav-quiz" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Quiz</button>
                <button class="nav-link normal-font-size" id="nav-matching-game-tab" data-bs-toggle="tab" data-bs-target="#nav-matching-game" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Matching Game</button>
            </div>
        </nav>
        <div class="tab-content">
            <div class="tab-pane transparent-panel fade show active" id="nav-quiz" role="tabpanel" aria-labelledby="nav-home-tab">
                <?php foreach($usersWithQuizScore as $position=> $user){ ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <span class="text-patrick-hand leaderboard-position">#<?= $position ?></span>
                                </div>
                                <div class="col-6">
                                    <span class="text-patrick-hand leaderboard-name"><?= $user['name']?></span>
                                </div>
                                <div class="col-4 text-right">
                                    <span class="text-patrick-hand leaderboard-score"><?= $user['score']?> points</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="tab-pane fade transparent-panel" id="nav-matching-game" role="tabpanel" aria-labelledby="nav-profile-tab">
                <h3 class="my-2 text-patrick-hand text-center">Best Times</h3>
                <?php foreach($usersWithMatchingGameTime as $position=> $user){ ?>
                    <div class="card mb-3">
                        <div class="card-body rounded-2">
                            <div class="row">
                                <div class="col-2">
                                    <span class="text-patrick-hand leaderboard-position">#<?= $position ?></span>
                                </div>
                                <div class="col-6">
                                    <span class="text-patrick-hand leaderboard-name"><?= $user['name']?></span>
                                </div>
                                <div class="col-4 text-right">
                                    <span class="text-patrick-hand leaderboard-score"><?= $user['best_matching_game_time']?> secs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<div class="d-flex justify-content-center">
    <div class="row w-100 mt-5">
        <div class="col-4"></div>
        <div class="col-2">
            <a class="text-decoration-none" href="index.php?cat=module_quiz&module=Groundcovers&plantCategoryType=Groundcovers">
                <div class="card home-menu-card opacity-75">
                    <div class="card-body text-center">
                        <h4>Quiz</h4>
                        <i class="far fa-3x fa-file-alt"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-2">
            <a class="text-decoration-none normal-font-size" href="index.php?cat=study">
                <div class="card home-menu-card opacity-75">
                    <div class="card-body text-center">
                        <h4>Study</h4>
                        <i class="fas fa-3x fa-graduation-cap"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-4"></div>
    </div>

</div>

