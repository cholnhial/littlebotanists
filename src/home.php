<div class="text-center" style="margin-top: 12%">
    <img class="lblogo" src="img/Logo.png" alt="logo"/>
    <h3 class="text-center">Welcome to LittleBotanists <?= $_COOKIE['username'] ?></h3>
    <h6 class="text-center text-muted">What would you like to do today?</h6>
</div>

<div class="mt-4">
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col">
            <div class="card menu-card">
                <div class="card-body text-center">
                    <h2>Study</h2>
                    <i class="fas fa-3x fa-graduation-cap"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card menu-card">
                <div class="card-body text-center">
                    <h2>Quiz</h2>
                    <i class="far fa-3x fa-file-alt"></i>
                </div>
            </div>
        </div>
        <div class="col-3">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
        </div>
        <div class="col">
            <div class="card menu-card">
                <div class="card-body text-center">
                    <h2>Matching Game</h2>
                    <i class="fas fa-3x fa-gamepad"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card menu-card">
                <div class="card-body text-center">
                    <h2>Leadership Board</h2>
                    <i class="fas fa-3x fa-chart-line"></i>
                </div>
            </div>
        </div>
        <div class="col-3">
        </div>
    </div>
</div>

<script>
    $( ".menu-card" ).hover(
        function() {
            $(this).addClass('shadow-lg').css('cursor', 'pointer');
        }, function() {
            $(this).removeClass('shadow-lg');
        }
    );
</script>