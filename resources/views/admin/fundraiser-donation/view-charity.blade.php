@extends('admin.layouts.layout')
@php
    $role = Auth::user()->role;
@endphp
@section('contents')
@include('common-components.fundraiser-details')
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-12 order-sm-1 order-1 col-12">
        <h4>Charity Donations</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="tab-content m-t-15" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

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
                                <?php
                                      $pickup = $donate->pickup;
                                      $total_donated_items = 0;
                                      $total_donated_amount = 0;
                                      foreach ($pickup->items as $pickupItem) {
                                          $donated_items_quantity = 0;
                                          $donated_amount = 0;
                                          foreach ($pickupItem->itemDetails as $item) {
                                            
                                              $donated_items_quantity += $item->item_quantity; 
                                              $donated_amount += $item->item_amount;
                                          }

                                          $total_donated_items += $donated_items_quantity;
                                          $total_donated_amount +=$donated_amount;
                                      }
                                    
                                 ?>
                                <td>{{$total_donated_items}}</td>
                                <td>{{$donate->charity_type}}</td>
                                <td>{{$donate->charity->company_name}}</td>
                                <td>{{$total_donated_amount}}</td>
                                <td>
                                @if($donate->status == 'Completed')
                                <span class="badge badge-pill badge-success mr-3">Completed</span>
                                @else
                                <span class="badge badge-pill badge-pending mr-3">Pending</span>
                                @endif
                                @if($role == 'admin')
                                <a href='{{route("$role.donations.donor.view",["id"=>$donate->donor->user->id])}}' class="badge badge-pill badge-green"><i class="fas fa-external-link-alt    br-100"></i></a>
                                @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                                <tr><td>No Record Found</td> </tr>
                            @endif
                        </tbody>
                    </table>

            </div>
            <div class="">
                    @if(count($donations) > 0)
                    @foreach($donations as $donate)
                    <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
                         <div class="d-flex justify-content-between" >
                             <p class="text-black"><b>ID:</b> {{$donate->id}}</p>
                             <p class="text-black"><i class="far fa-calendar-alt"></i> {{$donate->created_at}}</p>
                         </div>
                         <div class="d-flex justify-content-between" >
                             <h3 class="text-primary">{{$donate->donor->user->name}}</h3>
                             <?php
                                      $pickup = $donate->pickup;
                                      $total_donated_items = 0;
                                      $total_donated_amount = 0;
                                      foreach ($pickup->items as $pickupItem) {
                                          $donated_items_quantity = 0;
                                          $donated_amount = 0;
                                          foreach ($pickupItem->itemDetails as $item) {
                                            
                                              $donated_items_quantity += $item->item_quantity; 
                                              $donated_amount += $item->item_amount;
                                          }

                                          $total_donated_items += $donated_items_quantity;
                                          $total_donated_amount +=$donated_amount;
                                      }
                                    
                                 ?>
                             <h3 class="text-primary">${{$total_donated_amount}}</h3>
                         </div>
                         <div class="d-flex justify-content-between" >
                             <p class="text-black"><b>Charity Type:</b> {{$donate->charity_type}}</p>
                             <p class="text-black"><b>Charity Name:</b> {{$donate->charity->company_name}}</p>
                         </div>
                         <div class="" >
                                @if($donate->status == 'Completed')
                                <span class="badge badge-pill badge-success mr-3">Completed</span>
                                @else
                                <span class="badge badge-pill badge-pending mr-3">Pending</span>
                                @endif
                              @if($role == 'admin')
                              <a href='{{route("$role.donations.donor.view",["id"=>$donate->donor->user->id])}}' class="badge badge-pill badge-green"><i class="fas fa-external-link-alt    br-100"></i>
                              @endif
                              </a>
                        </div>
                    </div>
                    @endforeach
                    {{ $donations->links('vendor.pagination.default') }}
                    @endif
                </div>
        </div>
    </div>
    </div>
    
</div>
@endsection