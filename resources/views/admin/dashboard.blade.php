@extends('admin.layouts.layout')
@section('contents')
<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="card bg-primary br-10">
            <div class="card-body">
                <p class="m-b-0 text-white">Total Donations Collected</p>
                <div class="d-flex   align-items-center">
                    <h2 class="m-b-0 text-white">
                        <span>${{$totalAmount}}</span>
                    </h2>
                    <p class="text-white pt-3 ml-1"> Updated {{substr($donationtimeElapsed, 0, 6) }} ago</p>
                </div>    
                <p class="text-white">+{{$thisweektotalAmount}} $ this week</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card bg-primary br-10">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="m-b-0 text-white">Total Pickups</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="m-b-0 text-white mr-2">
                            <span>{{$totalRequests}}</span>
                        </h2>
                        <p class="text-white pt-3"> Updated {{substr($pickupstimeElapsed, 0, 6) }} ago</p>
                    </div>    
                        
                        <p class="text-white">{{$thisweektotalPickups}} this week</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card bg-primary br-10">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="m-b-0 text-white">Total Shredded</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="m-b-0 text-white mr-2">
                            <span>139</span>
                        </h2>
                        <p class="text-white pt-3"> Items Shredded</p>
                    </div>    
                        
                        <p class="text-white">5 items this week</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Latest Pickups and donations -->
@include('common-components.latest-pickup-donations')

@endsection 