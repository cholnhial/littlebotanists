<div class="position-relative" id="name-card-wrapper">
    <div class="position-absolute name-card-top start-50 translate-middle">
        <div class="card text-end" style="width: 25rem;">
            <div class="card-header text-center">
                Provide your username
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">Almost there!</h5>
                <p class="card-text text-center">In order personalise the experience for you please provide us with your username.</p>

                <form id="name-form">
                    <div class="mb-3">
                        <label class="form-label" for="name">Your Nickname</label>
                        <input id="name" class="form-control form-control-lg" type="text" placeholder="Alex101">
                        <div id="validateNameInValidFeedback" class="d-none invalid-feedback">
                        </div>
                        <div id="validateNameValidFeedback" class="d-none valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <button type="submit" id="submit-btn" disabled class="btn btn-outline-primary friendly-btn">START</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var nameLengthValid = false;
    var isNameValid = false;

    $(document).ready(function() {

        function disableOrEnableButton() {
            /* Enable the button */
            if (!isNameValid) {
                $('#submit-btn').attr("disabled", true);
            } else {
                $('#submit-btn').removeAttr("disabled");
            }
        }

        $('#name-form').submit(function(e) {
            e.preventDefault();

            $.post("ajax.php",
                {
                    action: 'submit_name',
                    name: $('#name').val()
                },
                function (resp, status, xhr) {

                    if (resp.code == 200) {
                        console.log(resp);
                        window.location = "/index.php";
                    } else {
                        $('#validateNameValidFeedback').addClass("d-none");
                        $('#validateNameInValidFeedback').html("An error occured, try again.");
                        $('#validateNameInValidFeedback').removeClass("d-none");
                        restartAnimation('#name-card-wrapper',"animate__animated animate__shakeX");
                    }
                }
            ).fail(function (xhr, status, error) {
                alert("Something went wrong: " + error);
            });

        })
        $( "#name" ).keyup(function() {

            /* Is name not using valid characters */
            if (!/(.*[a-z|0-9]){3}/i.test($('#name').val())) {
                $('#name').addClass("is-invalid");
                $('#validateNameValidFeedback').addClass("d-none");
                $('#validateNameInValidFeedback').html("Name is too short");
                $('#validateNameInValidFeedback').removeClass("d-none");
                nameLengthValid = false;
                isNameValid = false;
                disableOrEnableButton();
                restartAnimation('#name-card-wrapper', "animate__animated animate__shakeX");
            } else {
                $('#validateNameInValidFeedback').addClass("d-none");
                $('#name').removeClass("is-invalid");
                nameLengthValid = true;
            }

            if(nameLengthValid) {
                $.post("ajax.php",
                    {
                        action: 'validate_name',
                        name: $('#name').val()
                    },
                    function (resp, status, xhr) {

                      /* Testing if the name is available */
                        if (resp.code == 200 && resp.data == false) {
                            $('#validateNameValidFeedback').removeClass("d-none");
                            $('#validateNameInValidFeedback').addClass("d-none");
                            $('#name').removeClass("is-invalid");
                            $('#name').addClass('is-valid');
                            isNameValid = true;
                            disableOrEnableButton();
                        }
                    }
                ).fail(function (xhr, status, error) { /* The name is not available */
                    $('#validateNameValidFeedback').addClass("d-none");
                    $('#validateNameInValidFeedback').html("This name is already taken");
                    $('#validateNameInValidFeedback').removeClass("d-none");
                    $('#name').removeClass('is-valid');
                    $('#name').addClass("is-invalid");
                    restartAnimation('#name-card-wrapper',"animate__animated animate__shakeX");
                    isNameValid = false;
                    disableOrEnableButton();
                });

            }


        });
    });

</script>
