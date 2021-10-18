<?php
require_once ("config.php");
require_once ("services/UserService.php");

$userService = new UserService();

// Get all the user scores
$usersWithQuizScore = $userService->getUsersWithScores();
$usersWithMatchingGameTime = $userService->getUsersWithMatchingGameTime();



?>

<h2 class="text-center text-patrick-hand">Quiz Leaderboard</h2>

<div class="mt-5 mx-auto" style="width: 45rem">
    <nav>
        <div class="nav nav-tabs  nav-fill" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-quiz-tab" data-bs-toggle="tab" data-bs-target="#nav-quiz" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Quiz</button>
            <button class="nav-link" id="nav-matching-game-tab" data-bs-toggle="tab" data-bs-target="#nav-matching-game" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Matching Game</button>
        </div>
    </nav>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="nav-quiz" role="tabpanel" aria-labelledby="nav-home-tab">
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
        <div class="tab-pane fade" id="nav-matching-game" role="tabpanel" aria-labelledby="nav-profile-tab">
            <h3 class="my-2 text-patrick-hand text-center">Best Times</h3>
            <?php foreach($usersWithMatchingGameTime as $position=> $user){ ?>
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
                                <span class="text-patrick-hand leaderboard-score"><?= $user['best_matching_game_time']?> secs</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
