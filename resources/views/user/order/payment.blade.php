<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
                    <div class="btn btn-success btn-paid" style="display: none">Paid</div>
                    <div class="btn btn-danger btn-unpaid text-right">Unpaid</div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>Elf Cafe</strong>
                        <br>
                        2135 Sunset Blvd
                        <br>
                        Los Angeles, CA 90026
                        <br>
                        <abbr title="Phone">P:</abbr> (213) 484-6829
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: 1st November, 2013</em>
                    </p>
                    <p>
                        <em>Receipt #: 34522677W</em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Receipt</h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Quantity</th>
                            <th class="text-center">Price (RM)</th>
                            <th class="text-center">Total (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $item)
                        <tr>
                            <td class="col-md-6"><em>{{ $item['food'] }}</em></h4></td>
                            <td class="col-md-2 text-center">{{ $item['qty'] }}</td>

                            <td class="col-md-2" style="text-align: center"> {{ $item['per_serving'] }} </td>
                            <td class="col-md-2 text-center price">{{ $item['price'] }}</td>
                        </tr>
                        @endforeach

                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right">
                            <p>
                                <strong>Subtotal: </strong>
                            </p>
                            <p>
                                <strong>Tax: </strong>
                            </p></td>
                            <td class="text-center">
                            <p class="price-sub-total">
                            </p>
                            <p class="price-tax">
                            </p></td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total: </strong></h4></td>
                            <td class="text-center text-danger price-total"><h4><strong></strong></h4></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <button type="button" class="btn btn-warning btn-lg btn-block save-template">
                            Save Order as Template
                        </button></td>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <button type="button" class="btn btn-success btn-lg btn-block btn-pay-now">
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
            $('.btn-pay-now').click(function() {
                Swal.fire({
                    title: 'Payment Success',
                    text: 'Thank you for your payment',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // window.location.href = "{{ route('order.index') }}";
                    }
                });

                // Change button to paid
                $('.btn-unpaid').hide();
                $('.btn-paid').show();

            });

            // Button to save template with sweet alert input text to save all the order into database
            $('.save-template').click(function() {
                Swal.fire({
                    title: 'Save Template',
                    input: 'text',
                    inputLabel: 'Template Name',
                    inputPlaceholder: 'Enter template name',
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    showLoaderOnConfirm: true,
                    preConfirm: (templateName) => {
                        return fetch(`/order/save-template`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                body: JSON.stringify({
                                    templateName: templateName,
                                    order: {!! json_encode($order) !!}
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText)
                                }
                                return response.json()
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                )
                            })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: `Template saved as: ${result.value.templateName}`,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    }
                });
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

            // Calculate total
            var total = price + tax;
            $('.price-total').html(`<h4><strong>${total.toFixed(2)}</strong></h4>`);



            
            
        });
    </script>
