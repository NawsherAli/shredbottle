@php
    $role = Auth::user()->role;
@endphp
<div class="row mb-3 bg-primary pt-2 br-5 " style="border-bottom: 2px solid #219653">
    <div class="col-md-6 order-sm-1 order-1 col-7">
        <h1 class="text-white">Donations</h1>
    </div>
    <div class="col-md-4 order-sm-2 order-3 ">
       <form id="searchForm" method="GET" action='{{ route("$role.donation.search") }}'>
            <div class="input-affix m-b-10">
                <input type="text" class="form-control" placeholder="Search by {{ $role== 'customer' ? 'Charity Name ' : 'Donar Name' }}" name="search">
                <i class="suffix-icon anticon anticon-search" id="searchIcon"></i>
            </div>
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
                <a class="dropdown-item" href='{{ route("$role.donations.sort.latest") }}'>Sort By Latest Funds</a>
                <a class="dropdown-item" href='{{ route("$role.donations.sort.highest") }}'>Sort By Highest Funds</a>
            </div>
        </div>
    </div>
</div>


 <div class="row flex-column d-none d-sm-block">
    <div class="table-responsive d-none d-sm-block">
        <table class="table table-sm text-center">
            <thead>
                <tr class="bg-primary">
                    <th scope="col" class="text-white">ID</th>
                    <th scope="col" class="text-white">Donor Name</th>
                    <th scope="col" class="text-white">Donation Amount</th>
                    <th scope="col" class="text-white">Charity Type</th>
                    <th scope="col" class="text-white">Charity Name</th>
                    <th scope="col" class="text-white">Number of Items Donated</th>
                    <th scope="col" class="text-white">Status</th>
                </tr>
            </thead>
            <tbody>
                @if(count($donations) > 0)
                @foreach($donations as $donate)
                <tr>
                    <th scope="row"> {{$loop->iteration}}</th>
                    <td>{{$donate->donor->user->name}}</td>
                    <td>{{$donate->amount}}</td>
                    <td>{{$donate->charity_type}}</td>
                    <td>{{$donate->charity->company_name}}</td>
                    <td>{{$donate->no_of_items}}</td>
                    <td>
                    @if($donate->status == 'Completed')
                    <span class="badge badge-pill badge-success mr-3">Completed</span>
                    @else
                    <span class="badge badge-pill badge-pending mr-3">Pending</span>
                    @endif
                    @if($role == 'admin')
                    <a href='{{route("$role.donations.donor.view",["id"=>$donate->donor->user->id])}}' class="badge badge-pill badge-green"><i class="fas fa-external-link-alt    br-100"></i></a></td>
                    @endif
                </tr>
                @endforeach
                @else
                    <tr>
                        <td>No Record Found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
<div class="">
    @if(count($donations) > 0)
    @foreach($donations as $donate)
    <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
         <div class="d-flex justify-content-between" >
             <p class="text-black"><b>ID:</b> {{$loop->iteration}}</p>
             <p class="text-black"><b>No of Items</b>
             <!-- <i class="far fa-calendar-alt"></i>  -->{{$donate->no_of_items}}
             </p>
         </div>
         <div class="d-flex justify-content-between" >
             <h3 class="text-primary">{{$donate->donor->user->name}}</h3>
             <h3 class="text-primary">${{$donate->amount}}</h3>
         </div>
         <div class="d-flex justify-content-between" >
             <p class="text-black"><b>Charity Type:</b> {{$donate->charity_type}}</p>
             <p class="text-black"><b>Charity Name:</b> {{$donate->charity->company_name}}</p>
         </div>
         <div class="d-flex justify-content-end" >
                @if($donate->status == 'Completed')
                <span class="badge badge-pill badge-success mr-3">Completed</span>
                @else
                <span class="badge badge-pill badge-pending mr-3">Pending</span>
                @endif
                @if($role == 'admin')
                <a href='{{route("$role.donations.donor.view",["id"=>$donate->donor->user->id])}}' class="badge badge-pill badge-green"><i class="fas fa-external-link-alt    br-100"></i></a>
              @endif
        </div>
    </div>
    @endforeach
    {{ $donations->links('vendor.pagination.default') }}
    @else
        <tr>
            <td>No Record Found</td>
        </tr>
    @endif 
                     
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