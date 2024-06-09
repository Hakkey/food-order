<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<nav class="navbar navbar-expand-lg bg-body-tertiary text-center">
    <div class="container-fluid text-center">
        <a class="navbar-brand" href="#">Order Foods</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container">
    <div class="row pt-3">
        <div class="col-md-3"></div>
        <div class="col-md-9">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All</button>
                  </li>
                @foreach ($categories as $category)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-{{ $category->name }}-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-{{ $category->name }}" type="button" role="tab"
                            aria-controls="pills-{{ $category->name }}"
                            aria-selected="true">{{ $category->name }}</button>
                    </li>
                @endforeach
                {{-- <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" disabled>Disabled</button>
                </li> --}}
            </ul>

            
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
                    <div class="row">
                        @foreach ($foods as $food)
                            <div class="col-md-4 p-2">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ asset('storage/images/menus/' . $food->image) }}"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title
                                            ">{{ $food->name }}</h5>
                                        <p class="card-text">{{ $food->description }}</p>
                                        <p class="card-text">Price: {{ $food->price }}</p>
                                        {{-- <a href="{{ route('order.create', $food->id) }}"
                                            class="btn btn-primary">Order</a> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                @foreach ($categories as $category)
                    <div class="tab-pane fade" id="pills-{{ $category->name }}" role="tabpanel"
                        aria-labelledby="pills-{{ $category->name }}-tab" tabindex="0">
                        <div class="row">
                            @foreach ($category->foods as $food)
                                <div class="col-md-4">
                                    <div class="card" style="width: 18rem;">
                                        <img src="{{ asset('storage/images/menus/' . $food->image) }}"
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title
                                                ">{{ $food->name }}</h5>
                                            <p class="card-text">{{ $food->description }}</p>
                                            <p class="card-text">Price: {{ $food->price }}</p>
                                            {{-- <a href="{{ route('order.create', $food->id) }}"
                                                class="btn btn-primary">Order</a> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                {{-- <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">...</div> --}}
            </div>
            <br>
            <div class="row">
                {{-- @foreach ($categories as $category)
                    <div class="col-md-12">
                        <h3>{{ $category->name }}</h3>
                        <div class="row">
                            @foreach ($category->foods as $food)
                                <div class="col-md-4">
                                    <div class="card" style="width: 18rem;">
                                        <img src="{{ asset('storage/images/menus/' . $food->image) }}"
                                            class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title
                                                ">
                                                {{ $food->name }}</h5>
                                            <p class="card-text">{{ $food->description }}</p>
                                            <p class="card-text">Price: {{ $food->price }}</p>
                                            <a href="{{ route('order.create', $food->id) }}"
                                                class="btn btn-primary">Order</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>
                @endforeach --}}





                {{-- @foreach ($foods as $food)
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('storage/images/menus/' . $food->image) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $food->name }}</h5>
                                <p class="card-text">{{ $food->description }}</p>
                                <p class="card-text">Price: {{ $food->price }}</p>
                                <a href="{{ route('order.create', $food->id) }}" class="btn btn-primary">Order</a>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
            </div>
        </div>
    </div>
</div>
