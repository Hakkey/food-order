<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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

                <div class="row">
                    <div class="col-md-12">
                        <a href="#why-us" class="book-a-table-btn btn-sm float-end bag-order"><i class="bi bi-bag"></i>
                            0</a>
                    </div>
                </div>

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
            $('.add-to-order').click(function() {
                $(this).hide();
                var foodId = $(this).data('id');
                $('#added-' + foodId).show();

                var category = $(this).data('category');
                var food = $(this).parent().parent().find('.menu-content a').text();
                var price = $(this).parent().parent().find('.menu-content span').text();

                if (category == 12) {
                    // Make a list with the quantity and the plus minus button to change to text box to input kilogram
                    var order = '<div class="item mt-2"><div class="row"><div class="col-md-3 food-name">' +
                        food + '</div><div class="col-md-3 food-price" data-price="' + price + '">' +
                        price +
                        '</div><div class="col-md-3 quantity"><input type="text" class="form-control data-seafood-price text-center" value="1"></div><div class="col-md-3 qty-price" data-price="' +
                        price + '">' + price +
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

            // Calculate price for seafood on input
            $(document).on('input', '.data-seafood-price', function() {
                var priceElement = $(this).parent().next();
                var price = parseFloat(priceElement.data('price').replace('RM ', ''));
                var quantity = parseFloat($(this).val());

                var total = quantity * price;
                priceElement.text('RM ' + total.toFixed(2));

                // Update total price
                calculateTotal();
                calculateQuantity();
            });

            // data-seafood-price on focus out to prevent user from inputting negative value
            $(document).on('focusout', '.data-seafood-price', function() {
                var quantity = parseFloat($(this).val());
                if (quantity < 1) {
                    $(this).val(1);
                    quantity = 1;
                }
            });

            // submit order to next page for payment with all the data to
            $('.submit-order').click(function() {
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
                        price: price
                    });
                });

                $('.show-seafood-order .item').each(function() {
                    var food = $(this).find('.row .food-name').text();
                    var qty = $(this).find('.row .quantity .data-seafood-price').val();
                    var price = $(this).find('.row .qty-price').text().replace('RM ', '');
                    var per_serving = parseFloat($(this).find('.row .food-price').data('price')
                        .replace('RM ', ''));
                    order.push({
                        food: food,
                        per_serving: per_serving,
                        qty: qty,
                        price: price
                    });
                });

                $.ajax({
                    url: '/order/save',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        order: JSON.stringify(order)
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });



                window.location.href = '/order/payment?order=' + JSON.stringify(order);
            });

            function calculateTotal() {
                var total = 0;
                $('.show-order .item').each(function() {
                    var price = $(this).find('.row .qty-price').text();
                    total += parseFloat(price.replace('RM ', ''));
                });

                $('.show-seafood-order .item').each(function() {
                    var price = $(this).find('.row .qty-price').text();
                    total += parseFloat(price.replace('RM ', ''));
                });
                total = total.toFixed(2); // Round to 2 decimal places after all additions
                $('.total-price').text('RM ' + total);
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
                $('.total-quantity').html('<strong>' + quantity + '</strong>');
                $('.bag-order').html('<i class="bi bi-bag"></i> <strong>' + quantity + '</strong>');
            }


        });
    </script>


    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
