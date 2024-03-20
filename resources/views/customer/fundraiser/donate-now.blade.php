@extends('customer.layouts.layout')
@section('contents')
<div class="row mb-3 bg-primary pt-2 br-5 " style="border-bottom: 2px solid #219653">
    <div class="col-md-10 order-sm-1 order-1 col-10">
        <h1 class="text-white title-responsive"><i class="fas fa-arrow-alt-circle-left mr-3"></i>School Charity</h1>
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
        <select id="charity_type" class="form-control" name="charity_type">
            <option value="Abc">Abc</option>
            <option value="Xyz">Xyz</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="charity_name" class="text-primary">Organization Name</label>
        <select id="charity_name" class="form-control" name="charity_name">
            @foreach($fundraisers as $fundraiser)
            <option value="{{$fundraiser->id}}">{{$fundraiser->company_name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6  ">
        <label for="amount" class="text-primary">Enter Amount</label>
        <input type="number" class="form-control" id="amount" placeholder="$10.00" name="amount" required="required">
    </div>
    <div class="form-group col-md-3 col-6  d-flex align-items-end justify-content-end">
        <button class="btn  border-primary1" style="width: 200px">Cancel</button>
    </div>
    <div class="form-group col-md-3 col-6  d-flex align-items-end justify-content-end">
        <button type="submit" class="btn  btn-primary"  style="width: 200px">Send</button>
    </div>
</div>
</form>

@endsection