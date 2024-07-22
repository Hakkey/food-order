<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="user-status" content="{{ Auth::check() ? 'Logged In' : 'Logged Out' }}">

    <title>Delicious Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">

    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Delicious
  * Template URL: https://bootstrapmade.com/delicious-free-restaurant-bootstrap-theme/
  * Updated: May 16 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<style>
    .add-to-order {
        padding-top: 1px;
        padding-bottom: 1px;
        padding-right: 10px;
        padding-left: 10px;
        float: right;
    }

    .add-to-order-text {
        padding-top: 1px;
        padding-bottom: 1px;
        padding-right: 10px;
        padding-left: 10px;
        float: right;
    }
</style>

<body>

    <main id="main">
        <div class="toast-container top-0 end-0 p-3"></div>

        <!-- ======= Menu Section ======= -->
        <section id="menu" class="menu">
            <div class="container">


                <div class="section-title">
                    <h2>Check our tasty <span>Menu</span></h2>
                </div>

                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="menu-flters">
                            <li data-filter="*" class="filter-active">Show All</li>
                            @foreach ($categories as $index => $category)
                                <li data-filter=".filter-{{ $category->name }}">{{ $category->name }}</li>
                            @endforeach
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-md-12">
                        <a href="#why-us" class="book-a-table-btn btn-sm float-end bag-order"><i class="bi bi-bag"></i>
                            0</a>
                    </div>
                </div> --}}

                <div class="row menu-container">
                    {{-- @foreach ($categories as $category)
                        @foreach ($category->foods as $food)
                            <div class="col-lg-6 menu-item filter-*">
                                <div class="menu-content">
                                    <a href="#">{{ $food->name }}</a><span>RM {{ $food->price }}</span>
                                </div>
                                <div class="menu-ingredients">
                                    {{ $food->description }}
                                    <a href="#book-a-table" class="book-a-table-btn btn-sm add-to-order">Add to
                                        order</a>
                                </div>
                            </div>
                        @endforeach
                    @endforeach --}}
                    @foreach ($categories as $category)
                        @foreach ($category->foods as $food)
                            <div class="col-lg-6 menu-item filter-{{ $category->name }}">
                                <div class="menu-content">
                                    <a href="#">{{ $food->name }}</a><span>RM {{ $food->price }}</span>
                                </div>
                                <div class="menu-ingredients">
                                    {{ $food->description }}
                                    <a type="button" id="add-order-{{ $food->id }}"
                                        class="book-a-table-btn btn-sm add-to-order" data-id="{{ $food->id }}"
                                        data-category="{{ $food->category_id }}">Add
                                        to
                                        order</a>
                                    <p class="text-success add-to-order-text" id="added-{{ $food->id }}"
                                        style="display: none;">Items has been added</p>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>

            </div>
        </section><!-- End Menu Section -->

        <div class="row">
            <div class="col-lg-12">

                <div class="templates-show"></div>

            </div>
        </div>

        <!-- ======= Whu Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container">

                <div class="section-title">
                    <h2>Order <span>List</span></h2><br>

                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3"><strong>Item</strong></div>
                                        <div class="col-md-3"><strong>Per Serving/ Kilo</strong></div>
                                        <div class="col-md-3"><strong>Quantity/ Kilo</strong></div>
                                        <div class="col-md-3"><strong>Price</strong></div>
                                    </div>
                                    <hr>
                                    <div class="show-order">
                                        <!-- Order list will be shown here -->
                                    </div>
                                    <div class="show-seafood-order">
                                        <!-- Order list will be shown here -->
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3"><strong>Total</strong></div>
                                        <div class="col-md-3"><strong></strong></div>
                                        <div class="col-md-3 total-quantity"><strong></strong></div>
                                        <div class="col-md-3 total-price"><strong></strong></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center pt-3">
                        <div class="col-lg-8">
                            <a type="button" id="add-order-{{ $food->id }}" class="book-a-table-btn submit-order"
                                data-id="{{ $food->id }}">Submit Order</a>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Whu Us Section -->

    </main><!-- End #main -->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Please fill in the fields</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    {{-- // input text for user to input their phone number, table number and order type --}}
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="table" class="form-label">Table Number</label>
                        <input type="text" class="form-control" id="table" name="table">
                    </div>
                    <div class="mb-3">
                        <label for="order_type" class="form-label">Order Type</label>
                        <select class="form-select" id="order_type" name="order_type">
                            <option value="Dine In">Dine In</option>
                            <option value="Take Away">Take Away</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-warning proceed-btn">Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <h3>Delicious</h3>
            <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi
                placeat.</p>
            <div class="social-links">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
            <div class="copyright">
                &copy; Copyright <strong><span>Delicious</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/delicious-free-restaurant-bootstrap-theme/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // Control phone number to be just numbers
            $('#phone').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });


            var phone;
            var table;
            var order_type;

            // Check if user is logged in
            var userStatus = $('meta[name="user-status"]').attr('content');

            if (userStatus === 'Logged Out') {
                // Show the modal
                $('#staticBackdrop').modal('show');
            }

            // Proceed button
            $('.proceed-btn').click(function() {
                phone = $('#phone').val();
                table = $('#table').val();
                order_type = $('#order_type').val();

                if (phone === '' || table === '') {
                    alert('Please fill in the fields');
                } else {
                    // using ajax to check in template database for the phone number, if exist then load all the templates under the phone number to template-show
                    $.ajax({
                        url: '/check-template',
                        type: 'GET',
                        data: {
                            _token: '{{ csrf_token() }}',
                            phone: phone
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.status === 'found') {
                                // Close the modal
                                $('#staticBackdrop').modal('hide');

                                // loop through response.templates data into a list of templates
                                var templates = response.templates;
                                var templateList = '<div class="row">';
                                templates.forEach(function(template) {
                                    // template.items is already an array
                                    var itemsArray = JSON.parse(template.items);

                                    console.log(typeof itemsArray);

                                    // Create a <ul> list of items
                                    var itemsList = '<ul>';
                                    itemsArray.forEach(function(item) {
                                        itemsList += '<li>Quantity: ' + item
                                            .qty + ', Food: ' + item.food +
                                            ', Per Serving: ' + item
                                            .per_serving + '</li>';
                                    });
                                    itemsList += '</ul>';

                                    templateList +=
                                        '<div class="col-md-4"><div class="card"><div class="card-body"><h5 class="card-title">' +
                                        template.name + '</h5><p class="card-text">' +
                                        itemsList +
                                        '</p><button type="button" class="btn btn-primary order-template" data-id="' + template.id + '">Order</button></div></div></div>';
                                });
                                templateList += '</div>';

                                $('.templates-show').html(templateList);
                            } else {
                                alert('Phone number not found');
                            }
                        }
                    });

                    // Close the modal
                    $('#staticBackdrop').modal('hide');
                }
            });

            // make a function to add the template to the order list
            $(document).on('click', '.order-template', function() {
                // get the id of the template
                var templateId = $(this).data('id');

                // make an ajax request to send the template id to the server
                $.ajax({
                    url: '/order/order-template',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        template_id: templateId
                    },
                    success: function(response) {
                        window.location.href = '/order/loading/' + response.order_id;

                        // console.log(response);
                        // // loop through response.data and append to the order list
                        // var orderList = '';
                        // response.data.forEach(function(item) {
                        //     orderList += '<div class="item mt-2"><div class="row"><div class="col-md-3 food-name">' +
                        //         item.food + '</div><div class="col-md-3 food-price" data-price="' + item
                        //         .per_serving + '">' +
                        //         item.per_serving +
                        //         '</div><div class="col-md-3 quantity"><button class="btn btn-sm btn-minus" data-id="' +
                        //         item.id +
                        //         '">-</button> <span class="qty">1</span> <button class="btn btn-sm btn-plus">+</button></div><div class="col-md-3 qty-price" data-price="' +
                        //         item.per_serving + '">' + item.per_serving +
                        //         '</div><div class="col-md-3"></div></div></div>';
                        // });

                        // $('.show-order').append(orderList);

                        // calculateOrder();
                        // calculateTotal();
                        // calculateQuantity();
                    }
                });

            });

            $('.add-to-order').click(function() {
                $(this).hide();
                var foodId = $(this).data('id');
                $('#added-' + foodId).show();

                var category = $(this).data('category');
                if (category == '12') {
                    $('.show-seafood-order').show();
                    $('#added-' + foodId).hide();

                    $(this).show();
                }

                var food = $(this).parent().parent().find('.menu-content a').text();
                var price = $(this).parent().parent().find('.menu-content span').text();

                if (category == 12) {
                    // Make a select dropdown for seafood menu
                    var order = '<div class="item mt-2"><div class="row"><div class="col-md-3 food-name">' +
                        food + '</div><div class="col-md-3 food-price" data-price="' + price + '">' +
                        price +
                        '</div><div class="col-md-3 quantity"><select class="form-select cook" id="cook" name="cook"><option value="3 Rasa" class="text-center">3 Rasa</option><option value="Stim Limau" class="text-center">Stim Limau</option></select></div><div class="col-md-3 qty-price" data-price="' +
                        price + '">' + "TBC" +
                        '</div><div class="col-md-3"></div></div></div>';

                    $('.show-seafood-order').append(order);
                } else {
                    var order = '<div class="item mt-2"><div class="row"><div class="col-md-3 food-name">' +
                        food + '</div><div class="col-md-3 food-price" data-price="' + price + '">' +
                        price +
                        '</div><div class="col-md-3 quantity"><button class="btn btn-sm btn-minus" data-id="' +
                        foodId +
                        '">-</button> <span class="qty">1</span> <button class="btn btn-sm btn-plus">+</button></div><div class="col-md-3 qty-price" data-price="' +
                        price + '">' + price +
                        '</div><div class="col-md-3"></div></div></div>';
                    $('.show-order').append(order);
                }

                calculateOrder();
                calculateTotal();
                calculateQuantity();
            });

            // Increase quantity
            $(document).on('click', '.btn-plus', function() {
                var quantityElement = $(this).siblings('.qty');
                var quantity = parseInt(quantityElement.text());
                quantity++;
                quantityElement.text(quantity);

                var priceElement = $(this).parent().next();
                var price = parseFloat(priceElement.data('price').replace('RM ', ''));
                var total = quantity * price;
                priceElement.text('RM ' + total.toFixed(2));

                // Update total price
                // calculateOrder();
                calculateTotal();
                calculateQuantity();
            });

            // Decrease quantity
            $(document).on('click', '.btn-minus', function() {
                var quantityElement = $(this).siblings('.qty');
                var quantity = parseInt(quantityElement.text());
                if (quantity > 1) {
                    quantity--;
                    quantityElement.text(quantity);

                    var priceElement = $(this).parent().next();
                    var price = parseFloat(priceElement.data('price').replace('RM ', ''));
                    var total = quantity * price;
                    priceElement.text('RM ' + total.toFixed(2));

                    // calculateOrder();
                    calculateTotal();
                    calculateQuantity();
                } else if (quantity === 1) {
                    $(this).closest('.item').remove();

                    // Show the add to order button
                    var foodId = $(this).data('id');
                    console.log(foodId); // Check the value of foodId

                    $('#add-order-' + foodId).show();
                    $('#added-' + foodId).hide();

                    // calculateOrder();
                    calculateTotal();
                    calculateQuantity();
                }
            });


            // submit order to next page for payment with all the data to
            $('.submit-order').click(function() {
                console.log(phone);
                var order = [];
                $('.show-order .item').each(function() {
                    var food = $(this).find('.row .food-name').text();
                    var qty = $(this).find('.row .quantity .qty').text();
                    var price = $(this).find('.row .qty-price').text().replace('RM ', '');
                    var per_serving = parseFloat($(this).find('.row .food-price').data('price')
                        .replace('RM ', ''));
                    order.push({
                        food: food,
                        per_serving: per_serving,
                        qty: qty,
                        price: price,
                    });
                });

                $('.show-seafood-order .item').each(function() {
                    var food = $(this).find('.row .food-name').text();
                    var qty = $(this).find('.row .quantity .data-seafood-price').val();
                    var type = 'seafood';
                    var price = $(this).find('.row .qty-price').text().replace('RM ', '');
                    var per_serving = parseFloat($(this).find('.row .food-price').data('price')
                        .replace('RM ', ''));
                    var cook = $(this).find('.row .quantity .cook').val();
                    order.push({
                        food: food,
                        per_serving: per_serving,
                        qty: qty,
                        price: price,
                        type: type,
                        cook: cook
                    });
                });


                $.ajax({
                    url: '/order/save',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        phone: phone,
                        table: table,
                        order_type: order_type,
                        order: JSON.stringify(order)
                    },
                    success: function(response) {
                        console.log(response);
                        // redirect to loading page along with json order data
                        // window.location.href = '/order/loading/'+ response.order_id +'?order=' + JSON.stringify(order) + '&phone=' + phone +
                        //     '&table=' + table + '&order_type=' + order_type;

                        window.location.href = '/order/loading/' + response.order_id;


                    }
                });



                // window.location.href = '/order/payment?order=' + JSON.stringify(order) + '&phone=' + phone +
                //     '&table=' + table + '&order_type=' + order_type;
            });

            function calculateTotal() {
                var total = 0;
                var seafood_exist = false;
                $('.show-order .item').each(function() {
                    var price = $(this).find('.row .qty-price').text();
                    total += parseFloat(price.replace('RM ', ''));
                });

                // Check if there is any seafood order
                $('.show-seafood-order .item').each(function() {
                    seafood_exist = true;
                });

                if (!seafood_exist) {
                    total = total.toFixed(2); // Round to 2 decimal places after all additions

                    $('.total-price').text('RM ' + total);
                } else {
                    $('.total-price').text('TBC');
                }
            }

            function calculateOrder() {
                var count = $('.show-order .item').length;
                $('.bag-order').html('<i class="bi bi-bag"></i> <strong>' + count + '</strong>');
            }

            function calculateQuantity() {
                var quantity = 0;

                $('.show-order .item').each(function() {
                    var qty = $(this).find('.row .quantity .qty').text();
                    quantity += parseInt(qty);
                });

                $('.show-seafood-order .item').each(function() {
                    var qty = $(this).find('.row').val();
                    quantity += parseInt(qty);
                });

                // $('.total-quantity').html('<strong>' + quantity + '</strong>');
                $('.bag-order').html('<i class="bi bi-bag"></i> <strong>' + quantity + '</strong>');
            }


        });
    </script>


    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
