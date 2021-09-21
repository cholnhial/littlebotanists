<?php
if (isset($_GET['cat'])) {
    $activePage = $_GET['cat'];
} else {
    $activePage = "index";
}
?>
<header>
    <!-- Fixed navbar -->
    <!--<nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Fixed navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>-->
<?php if(isset($activePage) && $activePage != 'name'): ?>
    <div class="button_container" id="toggle"><span class="top"></span><span class="middle"></span><span class="bottom"></span></div>
    <div class="overlay" id="overlay">
        <nav class="overlay-menu d-flex justify-content-center">
            <ul class="text-start">
                <li><a href="index.php?cat=study"><i class="fas fa-graduation-cap"></i> Study</a></li>
                <li><a href="#"><i class="far fa-file-alt"></i> Quiz</a></li>
                <li><a href="#"><i class="fas fa-gamepad"></i> Matching Game</a></li>
                <li><a href="#"><i class="fas fa-chart-line"></i> Leadership</a></li>
                <li><a href="#"><i class="fas fa-info-circle"></i> About</a></li>
            </ul>
        </nav>
    </div>
<?php endif; ?>
</header>