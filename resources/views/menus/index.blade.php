@extends('adminlte::page')

@section('content')
    @component('adminlte::page', ['title' => 'Menus'])
        @section('content_header')
            <div class="card">
                <div class="card-header">
                    <h1 class="float-left">Menus</h1> <a href="{{ route('menus.create') }}" class="btn btn-primary float-right"
                        data-toggle="modal" data-target="#addMenuModal">Add
                        Menu</a>

                </div>
            </div>
        @stop

        @section('content')
            <div class="card">
                <div class="card-body">
                    <table id="tableMenu" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Name</th>
                                <th scope="col" class="text-center">Description</th>
                                <th scope="col" class="text-center">Category</th>
                                <th scope="col" class="text-center">Price(RM)</th>
                                <th scope="col" class="text-center">Image</th>
                                <th scope="col" class="text-center">Updated At</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->description }}</td>
                                    <td>{{ $menu->category->name }}</td>
                                    <td>{{ $menu->price }}</td>
                                    <td>
                                        {{-- <img src="{{ asset($menu->image) }}" alt="Menu Image" style="width: 100px; height: 100px;"> --}}
                                        <img src="{{ asset('storage/images/menus/' . $menu->image) }}" alt="Menu Image"
                                            style="width: 100px; height: 100px;">
                                    </td>
                                    <td class="text-center">{{ $menu->updated_at->format('d/m/Y') }} <br>
                                        {{ $menu->updated_at->format('H:i a') }}</td>
                                    <td>
                                        <a href="{{ route('menus.show', $menu->id) }}" class="btn btn-primary btn-sm"><i
                                                class="fas fa-eye"></i></a>
                                        <button type="button" class="btn btn-warning btn-sm editButton" data-toggle="modal"
                                            data-target="#addMenuModal" data-action="edit" data-name="{{ $menu->name }}"
                                            data-description="{{ $menu->description }}" data-category="{{ $menu->category->id }}"
                                            data-price="{{ $menu->price }}"
                                            data-image="{{ asset('storage/images/menus/' . $menu->image) }}"><i
                                                class="fas fa-edit"></i></button>
                                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addMenuModalLabel">Add Menu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="0">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image" required>
                                    <br>
                                    <center>
                                        <img id="imagePreview" src="#" alt="Preview"
                                            style="display: none; width: 100px; height: 100px;">
                                    </center>

                                </div>
                                <button type="button" class="btn btn-primary float-right" id="addMenuButton">Save</button>
                                <button type="button" class="btn btn-warning float-right" id="editMenuButton" style="display: none;">Save</button>
                            </form>
                        </div>
                    </div>
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
                    $('.editButton').on('click', function(event) {
                        var button = $(this); // Button that triggered the modal
                        var name = button.data('name'); // Extract info from data-* attributes
                        var description = button.data('description');
                        var category = button.data('category');
                        var price = button.data('price');
                        var image = button.data('image');

                        var modal = $('#addMenuModal');
                        modal.find('.modal-body #name').val(name);
                        modal.find('.modal-body #description').val(description);
                        modal.find('.modal-body #category').val(category);
                        modal.find('.modal-body #price').val(price);
                        modal.find('.modal-body #imagePreview').attr('src', image);
                        $('#imagePreview').css('display', 'block');
                        $('#editMenuButton').show();
                        $('#addMenuButton').hide();
                    });

                    $('#tableMenu').DataTable({
                        paging: true,
                        searching: true,
                        order: [
                            [5, "desc"]
                        ]
                    });

                    $('#image').change(function() {
                        readURL(this);
                    });

                    $('#addMenuButton').click(function() {

                        var modal = $('#addMenuModal');
                        modal.find('.modal-body #name').val('');
                        modal.find('.modal-body #description').val('');
                        modal.find('.modal-body #category').val('0');
                        modal.find('.modal-body #price').val('');
                        modal.find('.modal-body #imagePreview').hide();

                        var name = $('#name').val();
                        var description = $('#description').val();
                        var category = $('#category').val();
                        var price = $('#price').val();
                        var image = $('#image').prop('files')[0];

                        var formData = new FormData();
                        formData.append('name', name);
                        formData.append('description', description);
                        formData.append('category', category);
                        formData.append('price', price);
                        formData.append('image', image);

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
                                // Hide the modal
                                $('#addMenuModal').hide();
                                // Refresh data table
                                $('#tableMenu').DataTable().ajax.reload();
                            },
                            error: function(error) {
                                console.log(error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while adding the menu!',
                                    icon: 'error',
                                    confirmButtonText: 'Okay'
                                });
                            }
                        });
                    });

                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('#imagePreview').attr('src', e.target.result);
                                $('#imagePreview').css('display', 'block');
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    function clearForm() {
                        $('#name').val('');
                        $('#description').val('');
                        $('#category').val('0');
                        $('#price').val('');
                        $('#image').val('');
                        $('#imagePreview').css('display', 'none');
                    }
                });
            </script>
        @stop


    @endsection