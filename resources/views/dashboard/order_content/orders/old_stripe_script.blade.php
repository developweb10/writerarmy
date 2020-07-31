{{--<script type="text/javascript">
    window.ParsleyConfig = {
        errorsWrapper: '<div></div>',
        errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
        errorClass: 'has-error',
        successClass: 'has-success'
    };
</script>

<script type="text/javascript" src="http://parsleyjs.org/dist/parsley.js"></script>

<script type="text/javascript" type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    Stripe.setPublishableKey("<?php echo env('pk_live_Pkx2Ecv0QldMQlF9745f8txU') ?>");
    jQuery(function($) {
        $('#payment-form').submit(function(event) {
            var $form = $(this);
            $form.parsley().subscribe('parsley:form:validate', function(formInstance) {
                formInstance.submitEvent.preventDefault();
                alert();
                return false;
            });
            $form.find('#submitBtn').prop('disabled', true);
            Stripe.card.createToken($form, stripeResponseHandler);
            return false;
        });
    });
    function stripeResponseHandler(status, response) {
        var $form = $('#payment-form');
        if (response.error) {
            $form.find('.payment-errors').text(response.error.message);
            $form.find('.payment-errors').addClass('alert alert-danger');
            $form.find('#submitBtn').prop('disabled', false);
            $('#submitBtn').button('reset');
        } else {
            var token = response.id;
            $form.append($('<input type="hidden" name="stripeToken" />').val(token));
            $form.get(0).submit();
        }
    };
</script>--}}


{{--<script type="text/javascript" src="//code.jquery.com/jquery-2.0.2.min.js"></script>--}}
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    (function() {
        Stripe.setPublishableKey('pk_live_Pkx2Ecv0QldMQlF9745f8txU');
    })();


    // Event Listeners
    $('#payment-form').on('submit', generateToken);

    var generateToken = function(e) {
        var form = $(this);

        // No pressing the buy now button more than once
        form.find('button').prop('disabled', true);

        // Create the token, based on the form object
        Stripe.create(form, stripeResponseHandler);

        // Prevent the form from submitting
        e.preventDefault();
    };


    var stripeResponseHandler = function(status, response) {
        var form = $('#payment-form');

        // Any validation errors?
        if (response.error) {
            // Show the user what they did wrong
            form.find('.payment-errors').text(response.error.message);

            form.find('.payment-errors').addClass('alert alert-danger');

            // Make the submit clickable again
            form.find('#submitBtn').prop('disabled', false);
            $('#submitBtn').button('reset');
        } else {
            // Otherwise, we're good to go! Submit the form.

            // Insert the unique token into the form
            $('<input>', {
                'type': 'hidden',
                'name': 'stripeToken',
                'value': response.id
            }).appendTo(form);

            // Call the native submit method on the form
            // to keep the submission from being canceled
            form.get(0).submit();
        }
    };
</script>
