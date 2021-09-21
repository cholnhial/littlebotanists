/***
 *  An idea from https://www.charistheo.io/blog/2021/02/restart-a-css-animation-with-javascript/
 *
 *
 * @param element
 */
function restartAnimation(element, animateClasses) {
    $(element).removeClass(animateClasses);
// trigger a DOM reflow
    $(element).width();
    $(element).addClass(animateClasses);
}

function initLoadingOverlay() {
    $.LoadingOverlaySetup({
        image: '/svgs/LoadingFlower.svg',
        imageColor: '',
        size: 60,
        imageResizeFactor: 3,
        text: 'Loading...'
    });
}

function initMenuCardHover() {
    $( ".menu-card" ).hover(
        function() {
            $(this).addClass('shadow-lg').css('cursor', 'pointer');
        }, function() {
            $(this).removeClass('shadow-lg');
        }
    );
}


function loadPlants(successCallback) {
    var data = {
        resource_id: "959bc00e-9913-48c6-8f1c-e1036ff7742c"
    }

    $.ajax({
        url: "https://www.data.brisbane.qld.gov.au/data/api/3/action/datastore_search",
        data: data,
        dataType: "jsonp", // We use "jsonp" to ensure AJAX works correctly locally (otherwise XSS).
        cache: true,
        success: function(data) {
            successCallback(data);
        }
    });
}

function loadPlantData(species, successCallback) {
    var offset = 0;
    var occurrences = [];
    var totalRecordsRead = 0;
    var images = [];

    function getNextPage() {
        $.ajax({
            url: `https://api.gbif.org/v1/occurrence/search?q=${species}&publishingCountry=AU&country=AU&basisOfRecord=HUMAN_OBSERVATION&hasCoordinate=true&MediaType=StillImage&limit=300&offset=${totalRecordsRead}&KingdomKey=6`,
            dataType: "json",
            cache: true,
            success: function (data) {
                extractData(data);
                totalRecordsRead += data.results.length;
                if (!data.endOfRecords) {
                    getNextPage();
                } else {
                    successCallback(images, occurrences);
                }
            }
        });
    }

    function extractData(data) {
        /*
             Find the locations which the plant occurs in terms of latitude and longitude
          */
        for (i = 0; i < data.results.length; i++) {
            occurrences.push({
                decimalLongitude: data.results[i].decimalLongitude,
                decimalLatitude: data.results[i].decimalLatitude,
                name: data.results[i].stateProvince,
                image: data.results[i].media[0].identifier
            });
        }

        /*
            Extract the plant images
         */
        if (images.length < 10) {
            for (i = 0; i < data.results.length; i++) {
                for(j = 0; j < data.results[i].media.length; j++) {
                    if(images.length < 10) {
                        images.push(data.results[i].media[j].identifier);
                    }
                }
            }
        }
    }

    $.ajax({
        url: `https://api.gbif.org/v1/occurrence/search?q=${species}&publishingCountry=AU&country=AU&basisOfRecord=HUMAN_OBSERVATION&hasCoordinate=true&MediaType=StillImage&limit=300&KingdomKey=6`,
        dataType: "json",
        cache: true,
        success: function(data) {
            extractData(data);
            totalRecordsRead += data.results.length;

            if(!data.endOfRecords) {
                getNextPage();
            } else {
                successCallback(images, occurrences);
            }
        }
    });
}