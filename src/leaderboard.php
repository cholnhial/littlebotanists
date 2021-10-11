<?php
require_once ("config.php");
require_once ("services/UserService.php");

$userService = new UserService();

// Get all the user scores
$users = $userService->getUsers();
?>

<h2 class="text-center text-patrick-hand">Quiz Leaderboard</h2>

<div class="mt-5">
<?php foreach($users as $position=>$user){ ?>
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-2">
                <span class="text-patrick-hand leaderboard-position"><?= $position ?></span>
            </div>
            <div class="col-6">
                <span class="text-patrick-hand leaderboard-name"><?= $user['name']?></span>
            </div>
            <div class="col-4 text-right">
                <span class="text-patrick-hand leaderboard-score"><?= $user['score']?></span>
            </div>
        </div>
    </div>
</div>
<?php } ?>
</div>
