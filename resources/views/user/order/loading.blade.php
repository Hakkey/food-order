<!DOCTYPE html>
<html>

<head>
    <title>Loading Page</title>
    <style>
        /* Add your custom styles here */
        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        .spinner {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid #ffb03b;
            border-radius: 50%;
            width: 100px;
            height: 100px;
            animation: spin 2s linear infinite;
        }

        .message {
            margin-top: 30px;
            font-size: 18px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="loading-container">
        <div class="spinner">
        </div>
        <div class="message">
            Please wait while your food is being prepared...
        </div>
        <br><br>
        <div class="payment-button">
            {{-- <a href="{{ route('order.payment', ['id' => $id]) }}">Click here to go to your order</a> --}}
        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        // get id from URL
        const url = window.location.href;

        const id = url.split('/').pop();


        //call function every 5 seconds
        let intervalId = setInterval(function() {
            checkOrderStatus(id);
        }, 5000);

        // make a function to call ajax request to check the order status
        function checkOrderStatus(id) {
            console.log('Checking order status...');
            $.ajax({
                url: '/check-order-status',
                type: 'GET',
                data: {
                    order_id: id
                },
                success: function(response) {
                    if (response.status === 'preparing') {
                        clearInterval(intervalId);

                        // add a link to the payment page
                        $('.payment-button').html('<a href="/order/payment/' + id +
                            '" class="btn btn-primary">Click here to pay</a>');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });
</script>

</html>
