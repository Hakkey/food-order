@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Page refresh in: <span id="countdown">2:00</span></p>
    <div class="row">
        @foreach ($orders as $order)
            <div class="col-lg-4 col-6">
                <div class="small-box {{ $order->status == 'pending' ? 'bg-secondary' : 'bg-primary' }}">
                    <input type="hidden" class="order-id" value="{{ $order->id }}">
                    <div class="inner">
                        <div class="row">
                            <div class="col">
                                <h3>{{ $order->table }}</h3>
                            </div>
                            <div class="col">
                                <h3 class="order-total">{{ $order->total ?? 'N/A' }}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>{{ $order->order_type }}</p>

                            </div>
                            <div class="col">
                                <select name="status" id="status" class="form-control status">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>
                                        Preparing</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>
                            </div>
                        </div>

                        <div class="row text-bold text-center">
                            <div class="col">Menu</div>
                            <div class="col">Quantity</div>
                            {{-- <div class="col">Total</div> --}}
                        </div>

                        <hr>

                        <div class="items">

                            @foreach (json_decode($order->items, true) as $item)
                                <div class="row">
                                    <div class="col food">{{ array_key_exists('food', $item) ? $item['food'] : 'N/A' }}</div>
                                    <input type="hidden" class="per_serving" style="display: none;"
                                        value="{{ $item['per_serving'] }}">
                                    <div class="col text-center">
                                        @if (array_key_exists('qty', $item))
                                            {{ $item['qty'] }}
                                            <input type="hidden" class="qty" style="display: none;"
                                                value="{{ $item['qty'] }}">
                                        @else
                                            @if ($order->status == 'preparing')
                                                Menu: {{ $item['cook'] }}
                                            @else
                                                <input type="text" class="qty" name="qty"
                                                    placeholder="Enter weight" class="form-control">
                                                    
                                                <input type="hidden" class="cook" style="display: none;" value="{{ $item['cook'] }}">
                                            @endif
                                        @endif
                                    </div>
                                    {{-- <div class="col">{{ array_key_exists('price', $item) ? $item['price'] : 'N/A' }}</div> --}}

                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <div href="#" class="small-box-footer">
                        {{-- <button class="btn btn-sm btn-primary">Edit</button>
                        <button class="btn btn-sm btn-primary">Save</button> --}}
                    </div>
                </div>
            </div>
        @endforeach
    @stop

    @section('css')
        {{-- Add here extra stylesheets --}}
        {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    @stop

    @section('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            // Refresh the page every 2 minutes (120000 milliseconds)
            setTimeout(function() {
                location.reload();
            }, 120000);

            // Display a countdown
            var countdown = 120; // 2 minutes in seconds
            var countdownDisplay = document.getElementById('countdown');

            setInterval(function() {
                countdown--;
                var minutes = Math.floor(countdown / 60);
                var seconds = countdown % 60;
                countdownDisplay.textContent = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;

                if (countdown <= 0) {
                    countdown = 120; // reset the countdown after reaching 0
                }
            }, 1000);
            $(document).ready(function() {
                // Make a function to calculate the total price of the order items on the specific box on status change
                $('.status').change(function() {
                    var box = $(this).closest('.small-box');
                    calculateTotalPrice(box);
                    var total = box.find('.order-total').text();

                    // Make an AJAX request to update the status of the order
                    var status = $(this).val();
                    var orderId = box.find('.order-id').val();

                    // get every item in the box to save into database
                    var items = [];
                    box.find('.items .row').each(function() {
                        var food = $(this).find('.food').text();
                        var per_serving = $(this).find('.per_serving').val();
                        var qty = $(this).find('.qty').val();
                        var cook = $(this).find('.cook').val();
                        items.push({
                            food: food,
                            per_serving: per_serving,
                            qty: qty,
                            cook: cook
                        });
                    });

                    $.ajax({
                        url: 'orders/update-status',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: status,
                            orderId: orderId,
                            total: total,
                            items: items
                        },
                        success: function(response) {
                            console.log(response);
                            // refresh page
                            location.reload();
                        }
                    });
                });

                function calculateTotalPrice(box) {
                    var totalPrice = 0;
                    box.find('.items .row').each(function() {
                        var per_serving = $(this).find('.per_serving').val();
                        console.log(per_serving);
                        var qty = $(this).find('.qty').val();
                        console.log(qty);
                        totalPrice += parseFloat(per_serving) * parseFloat(qty);
                    });
                    box.find('.order-total').text('RM ' + totalPrice.toFixed(2));
                }

            });
        </script>
    @stop
