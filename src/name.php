<div class="position-relative">
    <div class="position-absolute name-card-top start-50 translate-middle">
        <div class="card text-end" style="width: 25rem;">
            <div class="card-header text-center">
                Provide your username
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">Almost there!</h5>
                <p class="card-text text-center">In order personalise the experience for you please provide us with your username.</p>
                <form>
                    <div class="mb-3">
                        <label class="form-label" for="name">Your Nickname</label>
                        <input id="name" class="form-control form-control-lg" type="text" placeholder="Alex101">
                        <div id="validateNameInValidFeedback" class="d-none invalid-feedback">
                        </div>
                        <div id="validateNameValidFeedback" class="d-none valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary friendly-btn">START</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $( "#name" ).keyup(function() {
            $.post("ajax.php",
                {
                    action: 'validate_name',
                    name: $(this).val()
                },
                function (resp, status, xhr) {
                    console.log(resp);
                }
            ).fail(function (xhr, status, error) {
                alert("Something went wrong: " + error);
            });
        }.bind(this));
    });

</script>
