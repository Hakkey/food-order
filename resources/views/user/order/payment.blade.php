<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    body {
        margin-top: 20px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col text-right" style="margin-right: 10px">
                    {{-- <div class="btn btn-success btn-paid" style="display: none">Paid</div> --}}
                    <div class="btn btn-danger btn-unpaid text-right">Unpaid</div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <h3>Table {{ $order->table }}</h3>
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        {{-- <em>Date: 1st November, 2013</em> --}}
                        <em>Date: {{ $order->created_at->format('jS F, Y') }}</em>
                    </p>
                    <p class="table-id">
                        <em>Receipt #: {{ $order->id }} </em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Payment</h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Quantity/ KG</th>
                            <th class="text-center">Price (RM)</th>
                            <th class="text-center">Total (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $items = json_decode($order->items, true);
                        @endphp

                        @foreach ($items as $item)
                            <tr>
                                <td class="col-md-6"><em>{{ $item['food'] }}
                                        @if (isset($item['cook']))
                                            (Menu: {{ $item['cook'] }})
                                        @endif
                                    </em>

                                </td>
                                <td class="col-md-2 text-center qty">{{ $item['qty'] }}</td>
                                <td class="col-md-2 per_serving" style="text-align: center"> {{ $item['per_serving'] }}
                                </td>
                                <td class="col-md-2 text-center subtotal"></td>
                            </tr>
                        @endforeach

                        {{-- <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right">
                                <p>
                                    <strong>Subtotal: </strong>
                                </p>
                                <p>
                                    <strong>Tax: </strong>
                                </p>
                            </td>
                            <td class="text-center">
                                <p class="price-sub-total">
                                </p>
                                <p class="price-tax">
                                </p>
                            </td>
                        </tr> --}}
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right">
                                <h4><strong>Total: </strong></h4>
                            </td>
                            <td class="text-center text-danger price-total">
                                <h4><strong></strong></h4>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="button" class="btn btn-success btn-lg btn-block btn-home">
                            Pay Now
                        </button></td>
                    </div>

                </div>

                {{-- <button type="button" class="btn btn-success btn-lg btn-block">
                    Pay Now   <span class="glyphicon glyphicon-chevron-right"></span>
                </button> --}}
                </td>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {

            // Get phone number from url
            const urlParams = new URLSearchParams(window.location.search);
            const phone = urlParams.get('phone');
            const table = urlParams.get('table');
            const order_type = urlParams.get('order_type');



            // get id from URL
            const url = window.location.href;

            const id = url.split('/').pop();

            $('.btn-home').click(function() {
                Swal.fire({
                    title: 'Payment Success',
                    text: 'Thank you for your payment',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/order/receipt/" + id;
                    }
                });

                // Change button to paid
                $('.btn-unpaid').hide();
                $('.btn-paid').show();

            });

            // Calculate all items in table and update subtotal
            var price = 0;
            $('.price').each(function() {
                price += parseFloat($(this).text());
            });
            $('.price-sub-total').text(price);

            // Calculate tax with 2 decimal places
            var tax = price * 0.06;
            $('.price-tax').text(tax.toFixed(2));

            // Calculate subtotal qty * per serving for each row
            $('.subtotal').each(function() {
                var qty = $(this).closest('tr').find('.qty').text();
                // console.log(qty);
                var per_serving = $(this).closest('tr').find('.per_serving').text();
                // console.log(per_serving);

                var subtotal = qty * per_serving;
                $(this).text(subtotal.toFixed(2));
            });


            // Calculate total
            var total = 0;
            $('.subtotal').each(function() {
                total += parseFloat($(this).text());
            });
            $('.price-total').html(`<h4><strong>${total.toFixed(2)}</strong></h4>`);





        });
    </script>
