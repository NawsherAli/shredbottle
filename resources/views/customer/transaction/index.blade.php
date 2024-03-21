@extends('customer.layouts.layout')
@section('contents')
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-6 order-sm-1 order-1 col-8">
        <h1>Transactions</h1>
    </div>
    <div class="col-md-4 order-sm-2 order-3 ">
        <form id="searchForm" method="GET" action="{{ route('customer.transaction.search') }}">
            <div class="input-affix  ">
            <input type="text" class="form-control" placeholder="Search by TRX No or Req No" name="search">
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
                  <a class="dropdown-item" href="{{ route('customer.transaction.filter', ['sort' => 'latest']) }}">Latest Transactions</a>
                  <a class="dropdown-item" href="{{ route('customer.transaction.filter', ['sort' => 'completed']) }}">Completed Transactions</a>
                  <a class="dropdown-item" href="{{ route('customer.transaction.filter', ['sort' => 'pending']) }}">Pending Transactions</a> 
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
                            <th scope="col" class="text-white">Request ID</th>
                            <th scope="col" class="text-white">Request Date</th>
                            <th scope="col" class="text-white">Name</th>
                            <th scope="col" class="text-white">Amount</th>
                            <th scope="col" class="text-white">TRX No</th>
                            <th scope="col" class="text-white">TRX Date</th>
                            <th scope="col" class="text-white">Status</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($transactions) > 0)
                        @foreach($transactions as $transaction)

                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$transaction->request_id}}</td>
                            <td>{{$transaction->request_date}}</td>
                            <td>{{$transaction->customer->user->name}}</td>
                            <td>{{$transaction->amount}}</td>
                            <td>{{$transaction->transaction_no}}</td>
                            <td>{{$transaction->transaction_date}}</td>
                            <td>
                               @if($transaction->status == 'Completed')
                                 <span class="badge badge-pill badge-success mr-3">{{$transaction->status}}</span>
                                @endif
                                @if($transaction->status == 'Pending')
                                 <span class="badge badge-pill badge-pending mr-3">{{$transaction->status}}</span>
                                @endif
                            </td>
                            
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
    @foreach($transactions as $transaction)
        <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
         <div class="d-flex justify-content-between" >
             <p class="text-black"><b>ID:</b> {{$transaction->id}}</p>
             
         </div>
         <div class="d-flex justify-content-between" >
              <h3 class="text-primary">{{$transaction->customer->user->name}}</h3>
         </div>
         <div class="d-flex justify-content-between" >
             <p class="text-black"><i class="m-r-10 text-primary anticon anticon-phone"></i>  {{$transaction->request_id}}</p>
             <p class="text-black"><b>Email:</b>{{$transaction->email}}</p>
         </div>
         <div class="d-flex justify-content-end align-items-center" >
            @if($transaction->status == 'Completed')
             <span class="badge badge-pill badge-success mr-3">{{$transaction->status}}</span>
            @endif
            @if($transaction->status == 'Pending')
             <span class="badge badge-pill badge-pending mr-3">{{$transaction->status}}</span>
            @endif
               
         </div>
        </div>
    @endforeach
</div>
{{ $transactions->links('vendor.pagination.default') }}



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