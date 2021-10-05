<?php
require_once ("config.php");
require_once ("services/UserService.php");

$userService = new UserService();

// Get all the user scores
$users = $userService->getUsers();
?>

<h2 class="text-center">Quiz Leaderboard</h2>

<div class="mt-5">
<?php foreach($users as $position=>$user){ ?>
<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-2">
                <?= $position ?>
            </div>
            <div class="col-6">
                <?= $user['name']?>
            </div>
            <div class="col-4 text-right">
                <?= $user['score']?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
</div>
