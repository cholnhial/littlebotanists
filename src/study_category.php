<?php
 $categoryType = $_GET['plantCategoryType'];
$module = $_GET['module'];
?>
<style>
    .button_container {
        top: 2% !important;
    }

    body {
        background-image: url("/img/module.png");
        height: 100%;
        background-position-y: 3rem;
        background-repeat: no-repeat;
        background-size: cover;

    }
    a:hover,
    a:visited,
    a:focus
    {text-decoration: none !important;}

    .transparent-panel {
        border: 7px solid white;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 8px;
    }

    .spinner-color {
        color: var(--lbfouthary);
    }

    .nav-link {
        color: var(--lbsecondary);
    }

    .start-quiz-button:hover {
        background-color: var(--lbfouthary);
        color: var(--lbfithary);
    }

</style>


<nav id="plants" style="margin-top: 3.5rem" class="navbar nav d-inline-flex nav-fill nav-tabs fixed-top bg-light">
</nav>

<div class="row" style="margin-top: 5%">
    <div class="col">
        <div class="transparent-panel">
            <input type="hidden"id="nameScientific" value="" />
            <input type="hidden"id="nameCommon" value="" />

            <h1 id="plant-name"></h1> <span class="btn-group-sm">
                <button id="sayNameScientific" class="btn btn-sm btn-outline-success">SCIENTIFIC NAME <i class="fas fa-play fa-1x"></i></button>
                <button id="sayNameCommon" class="btn btn-sm btn-outline-warning">COMMON NAME <i class="fas fa-play fa-1x"></i></button>
            </span>

            <h5 class="fw-bold mt-3">Description <span>
                <button id="tts-play" class="btn btn-sm btn-outline-success"> <i class="fas fa-play fa-1x"></i></button>
            <button id="tts-stop" class="btn btn-sm btn-outline-danger"> <i class="fas fa-stop fa-1x"></i></button>
            </span>
            </h5>
            <p id="plant-description" class="normal-font-size text-wrap"></p>
            <h5 class="my-2 fw-bold">Gallery</h5>
            <div id="images" class="d-flex justify-content-evenly overflow-scroll">
            </div>
            <div id="spinner-gallery" class="d-flex justify-content-center">
                <div  class="spinner-border spinner-color mx-auto" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <?php if($categoryType == 'Groundcovers'): ?>
            <div class="d-flex mt-3 justify-content-center">
                <a href="index.php?cat=module_quiz&module=<?=$module?>&plantCategoryType=<?=$categoryType?>" class="fs-2 btn btn-outline-secondary friendly-btn text-decoration-none start-quiz-button">Start <?= $module ?> Module Quiz</a>
            </div>
            <?php endif ; ?>
        </div>
    </div>
    <div class="col">
        <div class="transparent-panel">
            <h3 class="my-2">Occurrences</h3>
            <div id="map"></div>
            <div id="map-spinner" class="d-flex justify-content-center">
                <div  class="spinner-border spinner-color mx-auto" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <p id="map-help" class="text-muted normal-font-size"><strong>Help:</strong> Click on the dot to view an image taken in that location</p>
        </div>
    </div>
</div>

<!-- Map Photo Modal -->
<div class="modal fade m-auto" id="map-plant-image-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="map-plant-image-modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <img class="rounded img-fluid plant-image" id="map-plant-image" src="" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
<script>
    let plantCategory = '<?=$categoryType?>';
    var  plantsGroupedByType = null;
    var tts = null;

    function showPlant(element) {
        $('#map-spinner').removeClass('d-none');
        $('#spinner-gallery').removeClass('d-none');
        $('#map-help').addClass('d-none');
        $('#images').addClass('d-none');
        $('#map').hide();
        let plant = plantsGroupedByType[plantCategory.toLowerCase()][$(element).data('index')];
        $('#plant-name').html(plant['Species']);
        $('#nameScientific').val(plant['Species'].match(/\(([^)]+)\)/)[1]);
        $('#nameCommon').val(plant['Species'].substring(0, plant['Species'].indexOf(" (")));
        $('#plant-description').html(plant['Description and growing requirements']);

        let species = plant['Species'].match(/\(([^)]+)\)/)[1];
        loadPlantData(species, function(images, occurrences) {
            $('#images').html("");
            images.forEach((i, index) => {
                $('#images').append(`
                <a  data-lightbox="plant-image-${index}" href="${i}">
                          <img alt="plant image"  src="${i}" class="gallery-image img-thumbnail img-fluid" />
                        </a>
              `);
            });


            let markers = occurrences.map(l => {
                return {latLng: [l.decimalLatitude, l.decimalLongitude], name: l.name, image: l.image};
            })

            $(function(){
                var myCustomColors = {
                    'AU-SA': '#544343',
                    'AU-WA': '#544343',
                    'AU-VIC': '#544343',
                    'AU-TAS': '#544343',
                    'AU-QLD': '#544343',
                    'AU-NSW': '#544343',
                    'AU-ACT': '#544343',
                    'AU-NT': '#544343'
                };

                $('#map').replaceWith("<div id='map'></div>");

                map = new jvm.WorldMap({
                    map: 'au_merc',
                    container: $('#map'),
                    backgroundColor: '#eff7ff',
                    series: {
                        regions: [{
                            attribute: 'fill'
                        }]
                    },
                    markers: markers,
                    onMarkerClick: function(event, index) {
                        $.LoadingOverlay("show");
                        $('#map-plant-image-modal-title').html(markers[index].name);
                        $('#map-plant-image').attr("src", markers[index].image);
                        $('#map-plant-image').on('load', function() {
                            console.log("Image is loadeded!");
                            $.LoadingOverlay("hide");
                            $('#map-plant-image-modal').modal('show');
                        });

                    }
                });

                map.series.regions[0].setValues(myCustomColors);
            });

           // $.LoadingOverlay("hide");
            $('#map').show();
            $('#images').removeClass('d-none');
            $('#map-help').removeClass('d-none');
            $('#spinner-gallery').addClass('d-none');
            $('#map-spinner').addClass('d-none');
        });
    }
    $(document).ready(function() {
        $('#tts-play').click(function(){
            let text = $('#plant-description').html();
            responsiveVoice.speak(text);
        });

        $('#tts-stop').click(function() {
            responsiveVoice.cancel();
        });

        $('#sayNameScientific').click(function() {
            responsiveVoice.speak($('#nameScientific').val());
        });

        $('#sayNameCommon').click(function() {
            responsiveVoice.speak($('#nameCommon').val());
        });


        $.LoadingOverlay("show");
        loadPlants((data) => {
            plantsGroupedByType = data.result.records.reduce((r, a) => {
                r[a.Type.toLowerCase()] = [...r[a.Type.toLowerCase()] || [], a];
                return r;
            }, {});

            plantsGroupedByType[plantCategory.toLowerCase()] =  plantsGroupedByType[plantCategory.toLowerCase()].splice(0,4);

           plantsGroupedByType[plantCategory.toLowerCase()].forEach((p, i) => {
               if( i === 0) {
                  $('#plants').append(`<button data-index="${i}" class="nav-link text-decoration-none active friendly-btn fs-5" data-bs-toggle="tab"   type="button" role="tab">${p.Species}</button>`);
               } else {
                   $('#plants').append(`<button data-index="${i}" class="nav-link friendly-btn fs-5" data-bs-toggle="tab"  type="button" role="tab">${p.Species}</button>`);
               }
           });
            // Show first plant
            $.LoadingOverlay("hide");
            showPlant($('#plants').children()[0]);
            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                showPlant(this);
            });
    });
    });
</script>