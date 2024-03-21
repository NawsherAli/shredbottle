@extends('admin.layouts.layout')
@section('contents')
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-6 order-sm-1 order-1 col-8">
        <h1>Customers Accounts Details</h1>
    </div>
    <div class="col-md-4 order-sm-2 order-3 ">
        <form id="searchForm" method="GET" action="{{ route('accounts.customer.search') }}">
            <div class="input-affix  ">
            <input type="text" class="form-control" placeholder="Search by name" name="search">
                <i class="suffix-icon anticon anticon-search" id="searchIcon"></i>
            </div>
            <!-- <button type="submit" class="btn btn-primary">Search</button> -->
        </form>
    </div>
    <div class="col-md-2 order-sm-3 order-2 col-4 ">
        <div class="dropdown dropdown-animated scale-left">
            <button type="button" class="btn btn-primary" data-toggle="dropdown">
                <i class="fas fa-sliders-h"></i>
            <!-- <img src="assets/icons/filter-icon.png"> -->
            <span>Filter</span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href='{{ route("accounts.customer.sort.higestbalance") }}'>Sort By Higest Balance</a>
                <a class="dropdown-item" href='{{ route("accounts.customer.sort.lowestbalance") }}'>Sort By Lowest Balance</a>
            </div>
        </div>
    </div>
</div>
<div class="row flex-column d-none d-sm-block">
    <div class="table-responsive">
        <table class="table table-sm text-center">
                    <thead>
                        <tr class="bg-primary">
                            <th scope="col" class="text-white">ID</th>
                            <th scope="col" class="text-white">Customer Name</th>
                            <th scope="col" class="text-white">Phone Number</th>
                            <th scope="col" class="text-white">Email</th>
                            <th scope="col" class="text-white">E Transfer No</th>
                            <th scope="col" class="text-white">Current Balance</th> 
                            <th scope="col" class="text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($customers) > 0)
                        @foreach($customers as $customer)

                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$customer->name}}</td>
                            <td>+{{$customer->contact}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->e_transfer_no}}</td>
                            <td>{{$customer->customer->current_balance}}</td>
                            <td>
                                <!-- <a href="{{ route('customer.edit', ['id' => $customer->id]) }}" class="badge badge-pill badge-blue"><i class="fas fa-edit    br-100"></i></a>
                                <a href="#" onclick="customerClaimBalance({{ $customer->id }})" class="badge badge-pill badge-red"><i class="fas fa-trash-alt   br-100"></i></a> -->
                                @if($customer->customer->current_balance > 0)
                                <a href="#" onclick="customerClaimBalance({{ $customer->customer->id }})"  class="badge badge-pill badge-green"> Claim Balance</a>
                                @endif
                            </td>
                            @if(isset($customer->id))
                            <form id="claim-balace-form-{{ $customer->customer->id }}" action="{{ route('admin.claim.balance.request', ['id' => $customer->customer->id]) }}" method="post" style="display: none;">
                                @csrf
                                @method('POST')
                                <input type="text" hidden name="user_id" value="{{$customer->id}}">
                            </form>
                            @endif
                        </tr>
                        @endforeach
                        @else
                           <td>No record found</td>
                        @endif
                    </tbody>
        </table>
    </div>

</div>
<div class="">
    @foreach($customers as $customer)
        <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
         <div class="d-flex justify-content-between" >
             <p class="text-black"><b>ID:</b> {{$customer->id}}</p>
             
         </div>
         <div class="d-flex justify-content-between" >
             <h3 class="text-primary">{{$customer->name}}</h3>
         </div>
         <div class="d-flex justify-content-between" >
             <p class="text-black"><i class="m-r-10 text-primary anticon anticon-phone"></i>  +123 456 789</p>
             <p class="text-black"><b>Email:</b>{{$customer->email}}</p>
         </div>
         <div class="d-flex justify-content-end align-items-center" >
            @if($customer->status == 'active')
             <span class="badge badge-pill badge-success mr-3">{{$customer->status}}</span>
            @endif
            @if($customer->status == 'in-active')
             <span class="badge badge-pill badge-pending mr-3">{{$customer->status}}</span>
            @endif
               @if($customer->customer->current_balance > 0)
                <a href="#" onclick="customerClaimBalance({{ $customer->id }})"  class="badge badge-pill badge-green"> Claim Balance</a>
               @endif
               @if(isset($customer->id))
                    <form id="claim-balace-form-{{ $customer->id }}" action="{{ route('admin.claim.balance.request', ['id' => $customer->id]) }}" method="post" style="display: none;">
                        @csrf
                        @method('POST')
                    </form>
                @endif
         </div>
        </div>
    @endforeach
</div>
{{ $customers->links('vendor.pagination.default') }}


<script>
    function customerClaimBalance(customerId) {
        if (confirm('Are you sure to submit claim balance request for the specified customer')) {
            document.getElementById('claim-balace-form-' + customerId).submit();
        }
    }
</script>
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
@endsection