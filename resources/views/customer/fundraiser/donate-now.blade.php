@extends('customer.layouts.layout')
@section('contents')
<div class="row mb-3 bg-primary pt-2 br-5 " style="border-bottom: 2px solid #219653">
    <div class="col-md-10 order-sm-1 order-1 col-10">
        <h1 class="text-white title-responsive"><a href="#" onclick="goBack()"> <i class="fas fa-arrow-alt-circle-left mr-3"></i> </a>Donate Now</h1>
    </div>
</div>

<!-- Row 3 -->
<div class="row">
    <div class="col-md-12">
        <h3 class="title-with-line title-responsive">Select Charity &nbsp;</h3>
   </div>
</div>
<form method="post" action="{{ route('donate.money') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('post')
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="charity_type" class="text-primary">Charity Type</label>
        <input type="text" name="charity_type" class="form-control" value="{{$fundraiser->charity_type}}" readonly>
   </div>
    <div class="form-group col-md-6">
        <label for="charity_name" class="text-primary">Organization Name</label>
        <input type="text" name="charity_name" class="form-control" value="{{$fundraiser->id}}" readonly >
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6  ">
        <label for="amount" class="text-primary">Enter Amount</label>
        <!-- <input type="number" class="form-control" id="amount" placeholder="$10.00" name="amount" required="required" max="{{Auth::user()->customer->current_balance;}}" value=""> -->
        <div class="input-group  form-control " style="padding: 0px">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="number" class="form-control" id="amount" placeholder="$10.00" name="amount" required="required" max="{{Auth::user()->customer->current_balance;}}" value="" aria-label="Amount (to the nearest dollar)" style="border: none;" min="1">
            <!-- <div class="input-group-append">
                <span class="input-group-text">.00</span>
            </div> -->
        </div>
    </div>
    <div class="form-group col-md-3 col-6  d-flex align-items-end justify-content-end">
        <button class="btn  border-primary1" style="width: 200px">Cancel</button>
    </div>
    <div class="form-group col-md-3 col-6  d-flex align-items-end justify-content-end">
        <button type="submit" class="btn  btn-primary"  style="width: 200px">Send</button>
    </div>
</div>
<span class="text-primary">Your current balance is {{Auth::user()->customer->current_balance;}}$</span>
</form>

@endsection