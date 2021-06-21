<!DOCTYPE html>
<html>

<head>
    <title>Laravel || Stripe || Email</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style type="text/css">
        .panel-title {
            display: inline;
            font-weight: bold;
        }

        .display-table {
            display: table;
        }

        .display-tr {
            display: table-row;
        }

        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }

    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">LearnWithAnik</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card mx-auto" style="width: 28rem;">
                    <img src="{{ asset('public/img/ss.png') }}" class="card-img-top p-2" alt="...">
                    <div class="card-body">
                        <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                            data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                            @csrf
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" id="amount" aria-describedby="emailHelp"
                                    name='amount' placeholder="USD DOLAR">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                    name='email'>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Card Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Card Number</label>
                                <input type="text" class="form-control card-number" id="exampleInputPassword1"
                                    autocomplete='off'>
                            </div>

                            <div class="form-group">
                                <label for="cvc">CVC</label>
                                <input type="text" class="form-control card-cvc" id="cvc" autocomplete='off'
                                    placeholder='ex. 311' size='4'>
                            </div>

                            <div class="form-group">
                                <label for="month">Expiration Month</label>
                                <input type="text" class="form-control card-expiry-month" id="month" autocomplete='off'
                                    placeholder='MM' size='2'>
                            </div>

                            <div class="form-group">
                                <label for="month">Expiration Year</label>
                                <input type="text" class="form-control card-expiry-year" id="month" autocomplete='off'
                                    placeholder='YYYY' size='4'>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });
            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
</script>

<script>
    @if (Session::has('Message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
        case 'info':
        toastr.info("{{ Session::get('Message') }}");
        break;
    
        case 'warning':
        toastr.warning("{{ Session::get('Message') }}");
        break;
    
        case 'success':
        toastr.success("{{ Session::get('Message') }}");
        break;
    
        case 'error':
        toastr.error("{{ Session::get('Message') }}");
        break;
        }
    @endif
</script>

</html>
