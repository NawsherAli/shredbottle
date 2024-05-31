@php
    $role = Auth::user()->role;
@endphp
<div class="row mb-3 bg-primary pt-2 br-5 " style="border-bottom: 2px solid #219653">
    <div class="col-md-6 order-sm-1 order-1 col-7">
        <h1 class="text-white">Fundraisers</h1>
    </div>
    <div class="col-md-4 order-sm-2 order-3 ">
        <form id="searchForm" method="GET" action='{{ route("$role.fundraiser.search") }}'>
            <div class="input-affix  ">
            <input type="text" class="form-control" placeholder="Search" name="search">
                <i class="suffix-icon anticon anticon-search" id="searchIcon"></i>
            </div>
            <!-- <button type="submit" class="btn btn-primary">Search</button> -->
        </form>
    </div>
    <div class="col-md-2 order-sm-3 order-2 col-5 ">
        <div class="dropdown dropdown-animated scale-left">
            <button type="button" class="btn btn-default" data-toggle="dropdown">
                <i class="fas fa-sliders-h"></i>
            <!-- <img src="assets/icons/filter-icon.png"> -->
            <span>Filter</span>
            </button>
            <div class="dropdown-menu">
                <button class="dropdown-item" type="button">Sort By Lates Funds</button>
                <button class="dropdown-item" type="button">Sort By Higest Funds</button>
            </div>
        </div>
    </div>
</div>
<div class="row " id="card-view">
    @foreach($fundraisers as $fundraiser)
    <div class="col-md-4 col-12">
        <div class="card bg-primary-light">
            <div class="card-body">
                <div class="m-t-20 text-center">
                    <div class="avatar avatar-image bg-primary-light" style="height: 100px; width: 100px;">
                        <img src="{{asset('assets/icons/personal-trainer.png')}}" alt="">
                    </div>
                    <h4 class="m-t-30">{{$fundraiser->fundraiser->company_name}}</h4>
                    <p>Charity Goal: ${{$fundraiser->fundraiser->goal}} <br>
                       Charity Type: {{$fundraiser->fundraiser->charity_type}}</p>
                </div>
                <div class="text-center m-t-30">
                    <a href='{{ route("$role.fundraiser.view", ["id" => $fundraiser->id]) }}' class="btn btn-primary">
                        <span class="m-l-5">View Charity</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the search form and search icon elements
        var searchForm = document.getElementById('searchForm');
        var searchIcon = document.getElementById('searchIcon');

        // Add a click event listener to the search icon
        searchIcon.addEventListener('click', function() {
            // Submit the search form when the search icon is clicked
            searchForm.submit();
        });
    });
</script>