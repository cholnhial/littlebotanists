<?php
 $categoryType = $_GET['plantCategoryType'];
$module = $_GET['module'];
?>
<style>
    .button_container {
        top: 2% !important;
    }
</style>

<nav id="plants" style="margin-left: 5rem !important" class="nav d-inline-flex nav-tabs fixed-top">

</nav>

<div class="row">
    <div class="col">
        <h1 id="plant-name"></h1>

        <h5>Description <span>
                <button id="tts-play" class="btn btn-sm btn-outline-success"> <i class="fas fa-play fa-1x"></i></button>
            <button id="tts-stop" class="btn btn-sm btn-outline-danger"> <i class="fas fa-stop fa-1x"></i></button>
            </span>
        </h5>
        <p id="plant-description" class="text-wrap"></p>
        <h3 class="my-2">Gallery</h3>
        <div id="images" class="d-flex justify-content-evenly overflow-scroll">

        </div>
        <div class="d-flex mt-3 justify-content-center">
            <a href="index.php?cat=module_quiz&module=<?=$module?>&plantCategoryType=<?=$categoryType?>" class="btn btn-outline-primary friendly-btn">Start <?= $module ?> Module Quiz</a>
        </div>
    </div>
    <div class="col">
        <h3 class="my-2">Occurrences</h3>
        <div id="map"></div>
        <p class="text-muted"><strong>Help:</strong> Click on the dot to view an image taken in that location</p>
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
        let plant = plantsGroupedByType[plantCategory.toLowerCase()][$(element).data('index')];
        $('#plant-name').html(plant['Species']);
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

            $.LoadingOverlay("hide");
        });
    }
    $(document).ready(function() {

        initLoadingOverlay();

        $('#tts-play').click(function(){
            if (!tts) {
                tts = new SpeechSynthesisUtterance();
            }
            tts.text = $('#plant-description').html();
            window.speechSynthesis.speak(tts);
        });

        $('#tts-stop').click(function() {
            window.speechSynthesis.cancel();
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
                  $('#plants').append(`<button data-index="${i}" class="nav-link active friendly-btn" data-bs-toggle="tab"   type="button" role="tab">${p.Species}</button>`);
               } else {
                   $('#plants').append(`<button data-index="${i}" class="nav-link friendly-btn" data-bs-toggle="tab"  type="button" role="tab">${p.Species}</button>`);
               }
           });
            // Show first plant
            showPlant($('#plants').children()[0]);

            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                $.LoadingOverlay("show");
                showPlant(this);
            });
    });
    });
</script>