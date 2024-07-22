@extends('adminlte::page')

@section('content')
    @component('adminlte::page', ['title' => 'Orders'])
        @section('content_header')
            <div class="card">
                <div class="card-header">
                    <h1 class="float-left">All Orders</h1>
                </div>
            </div>
        @stop

        @section('content')
            <div class="card">
                <div class="card-body">
                    <table id="tableMenu" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Table</th>
                                <th scope="col" class="text-center">Order Type</th>
                                <th scope="col" class="text-center">Items</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">Date</th>
                                <th scope="col" class="text-center">Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">{{ $order->table }}</td>
                                    <td class="text-center">{{ $order->order_type }}</td>
                                    <td class="text-center">
                                        @foreach (json_decode($order->items, true) as $item)
                                            <div class="row">
                                                <div class="col">{{ array_key_exists('food', $item) ? $item['food'] : 'N/A' }}</div>
                                                <div class="col text-center">
                                                    @if (array_key_exists('qty', $item))
                                                        {{ $item['qty'] }}
                                                    @else
                                                        1
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{ $order->status }}</td>
                                    <td class="text-center">{{ $order->total }}</td>
                                    <td class="text-center">{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ $order->phone_number }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        @stop

        @section('css')
            <style>
                .dataTables_filter {
                    float: right;
                }

                .dataTables_paginate {
                    float: right;
                }
            </style>
        @stop

        @section('js')
            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


            <!-- DataTables -->
            <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

            <!-- Initialize DataTables -->
            <script>
                $(document).ready(function() {

                    // clear form when modal is closed
                    $('.clear-form').on('click', function() {
                        clearForm();
                    });

                    $('#addMenuButton').click(function() {
                        // console.log('Add menu button clicked');

                        // var modal = $('#addMenuModal');
                        // modal.find('.modal-body #name').val('');
                        // modal.find('.modal-body #description').val('');
                        // modal.find('.modal-body #category').val('0');
                        // modal.find('.modal-body #price').val('');
                        // modal.find('.modal-body #imagePreview').hide();

                        var name = $('#name').val();
                        var description = $('#description').val();
                        var category = $('#category').val();
                        var price = $('#price').val();

                        var formData = new FormData();
                        formData.append('name', name);
                        formData.append('description', description);
                        formData.append('category', category);
                        formData.append('price', price);

                        Swal.fire({
                            title: 'Please be patient!',
                            allowOutsideClick: false,
                            title: "Your request is being processed...",
                            icon: "info",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Okay!",
                            onload: () => {
                                Swal.showLoading();
                            },
                        });

                        $.ajax({
                            url: "{{ route('menus.store') }}",
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.close();
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Menu added successfully!',
                                    icon: 'success',
                                    confirmButtonText: 'Okay'
                                });

                                clearForm();

                                location.reload();
                            },
                            error: function(error) {
                                console.log(error);
                                // Swal.fire({
                                //     title: 'Error!',
                                //     text: 'An error occurred while adding the menu!',
                                //     icon: 'error',
                                //     confirmButtonText: 'Okay'
                                // });
                            }
                        });
                    });

                    $('.editButton').on('click', function(event) {
                        var button = $(this); // Button that triggered the modal
                        var name = button.data('name'); // Extract info from data-* attributes
                        var description = button.data('description');
                        var category = button.data('category');
                        var price = button.data('price');
                        // var image = button.data('image');

                        var modal = $('#addMenuModal');
                        modal.find('.modal-body #name').val(name);
                        modal.find('.modal-body #description').val(description);
                        modal.find('.modal-body #category').val(category);
                        modal.find('.modal-body #price').val(price);
                        // modal.find('.modal-body #imagePreview').attr('src', image);
                        // $('#imagePreview').css('display', 'block');
                        $('#editMenuButton').show();
                        $('#addMenuButton').hide();
                    });



                    $('.viewButton').on('click', function(event) {
                        var button = $(this); // Button that triggered the modal
                        var name = button.data('name'); // Extract info from data-* attributes
                        var description = button.data('description');
                        var category = button.data('category');
                        var price = button.data('price');
                        // var image = button.data('image');

                        var modal = $('#addMenuModal');
                        modal.find('.modal-body #name').val(name);
                        modal.find('.modal-body #description').val(description);
                        modal.find('.modal-body #category').val(category);
                        modal.find('.modal-body #price').val(price);
                        // modal.find('.modal-body #imagePreview').attr('src', image);
                        // $('#imagePreview').css('display', 'block');
                        $('#editMenuButton').hide();
                        $('#addMenuButton').hide();
                    });

                    $('#tableMenu').DataTable({
                        paging: true,
                        searching: true,
                        order: [
                            [5, "desc"]
                        ]
                    });


                    function clearForm() {
                        $('#addMenuModal').find('input[type="text"], textarea, select').val('');
                    }
                });
            </script>
        @stop


    @endsection
