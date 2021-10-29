<style>
    h1,h2,h3,h4,h5,h6,p {
     color: var(--lbsecondary);
    }

    .transparent-panel {
        border: 7px solid var(--lbfouthary);
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 8px;
    }

    body {
        background: url(img/home1.png) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .avatar {
        width: 64px;
        height: 64px;
    }
</style>

<div class="mb-3">
    <div class="row mt-3">
        <div class="col">
            <div class="transparent-panel">
                <h3 class="text-center">About LittleBotanists</h3>
                <p>Little Botanists aims to excite, inform, and educate  Australian primary school students aged 10 to 12 about common native flora. Little Botanists is an existing alternative to teach what could be otherwise stale content to a younger demographic.</p>
                <p>Seeking knowledge to understand concepts has been deeply  integrated into the web-based application through the creation of a fun and  engaging environment. Interactive learning is encouraged through various  features, entailing quizzes and matching games where students can compete against one another for the highest score!</p>

                <p><strong>Disclaimer:</strong>Care has been taken to ensure that the images of plants returned by GBIF API are appropriate for the target audience.</p>
                <p><strong>Assumptions and standpoints:</strong> For the spelling game we assume the student is able to hear sounds to play. Other interactive features such as the Matching Game, Drag & Drop and Quiz should be suitable for all students.</p>
                <h4>References</h4>
                <p>[1] Brisbane City Council, 2015, “Free Native Plants,” Source. [Online]. Available: https://data.gov.au/dataset/ds-brisbane-93fd3ab9-04e4-46a2-8de0-a86cf60877fb/details?q=plants</p>
                <p>[2] "Tux Avatars", Store.kde.org, 2015. [Online]. Available: https://store.kde.org/p/1102372/. [Accessed: 25- Oct- 2021].</p>
                <p>[3]"correct by ertfelda", Freesound, 2015. [Online]. Available: https://freesound.org/people/ertfelda/sounds/243701/. [Accessed: 25- Oct- 2021].</p>
                <p>[4]"Tada Fanfare A by plasterbrain", Freesound, 2017. [Online]. Available: https://freesound.org/people/plasterbrain/sounds/397355/. [Accessed: 25- Oct- 2021].</p>
            </div>
        </div>
        <div class="col">
            <div class="transparent-panel">
                <h3 class="text-center">Datasets, APIs & Technologies used</h3>
                <h4>Datasets & APIs</h4>
                <a href="https://data.gov.au/dataset/ds-brisbane-93fd3ab9-04e4-46a2-8de0-a86cf60877fb/details?q=plants"><h5>Free Native Plants</h5></a>
                <p>This is an API by Brisbane City Council which can be found at <a href="https://data.gov.au">data.gov.au</a>.
                    This dataset features various native plants in Australia.</p>
                <a href="https://www.gbif.org/developer/summary"><h5>Global Biodiversity Information Facility</h5></a>
                <p>This API is used to retrieve plant images based on their scientific name retrieved from the data.gov.au dataset.
                   We also use it to retrieve locations on the map where the plant might be found.</p>
                <h4>Technologies used</h4>
                <h5>Frontend</h5>
                <ul>
                    <li>Boostrap 5</li>
                    <li>JQuery</li>
                    <li>JVectorMap</li>
                    <li>FontAwesome 5</li>
                    <li>Lightbox</li>
                    <li>LoadingOverlay.js</li>

                </ul>
                <h5>Backend</h5>
                <ul>
                    <li>MySQL</li>
                    <li>PHP</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="transparent-panel mt-3">
        <h3 class="text-center">Meet The Team</h3>
        <div class="row">
            <div class="col text-center">
                <img src="img/team/chol.png" class="rounded-circle avatar mx-auto d-block">
                <h6>3rd Year</h6>
                <h4 class="fw-bolder">Chol Nhial</h4>
                <h6 class="fw-bold">BEng (Honours) switching to BInfTech (Software Design & Software Information Systems)</h6>
                <p>Worked on Backend and Frontend</p>
            </div>
            <div class="col text-center">
                <img src="img/team/zi.png" class="rounded-circle avatar mx-auto d-block">
                <h6>1st Year</h6>
                <h4 class="fw-bolder">Ziaden Thomson</h4>
                <h6 class="fw-bold">BCom & BInfTech (Undeclared)</h6>
                <p>Worked on Frontend</p>
            </div>
            <div class="col text-center">
                <img src="img/team/suhas.png" class="rounded-circle avatar mx-auto d-block">
                <h6>1st Year</h6>
                <h4 class="fw-bolder">Suhas Devadasan</h4>
                <h6 class="fw-bold">BusMan (Undeclared)</h6>
                <p>Worked on Backend and Frontend</p>
            </div>
            <div class="col text-center">
                <img src="img/team/tayla.png" class="rounded-circle avatar mx-auto d-block">
                <h6>3rd Year</h6>
                <h4 class="fw-bolder">Tayla Ward</h4>
                <h6 class="fw-bold">BInfTech (Software Design)</h6>
                <p>Worked on Backend</p>
            </div>
            <div class="col text-center">
                <img src="img/team/sam.png" class="rounded-circle avatar mx-auto d-block">
                <h6>2nd Year</h6>
                <h4 class="fw-bolder">Samantha Smart</h4>
                <h6 class="fw-bold">BBus/BA (Undeclared)</h6>
                <p>Worked on Frontend</p>
            </div>
        </div>
        <p class="text-center"><i>Linux Tux Penguin Avatars obtained from <a href="https://store.kde.org/p/1102372/">KDE Store [2]</a></i></p>
    </div>
</div>
