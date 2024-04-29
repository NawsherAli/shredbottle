@php
   $role = Auth::user()->role;
@endphp  
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between" style="padding: 0px">
               <ul class="nav nav-tabs" id="myTab" role="tablist" >
                    <li class="nav-item" style="margin-right: 10px">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" style="padding: 0px">Latest Pickups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" style="padding: 0px;">Latest Donations</a>
                    </li>
                </ul>
            <a href='{{route("$role.donations")}}' class="btn btn-primary ">View All Donations</a> 
            </div>
               
        <div class="tab-content m-t-15" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
               <div class="table-responsive d-none d-sm-block">
                    <table class="table table-sm text-center">
                        <thead>
                            <tr class="bg-primary">
                                <th scope="col" class="text-white">ID</th>
                                <th scope="col" class="text-white">Customer Name</th>
                                <th scope="col" class="text-white">Phone Number</th>
                                <th scope="col" class="text-white">Pickup Quantity</th>
                                <th scope="col" class="text-white">Pickup Date</th>
                                <th scope="col" class="text-white">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($pickups) > 0)
                            @foreach($pickups as $pickup)
                            <tr>
                                <th scope="row"> {{$loop->iteration}}</th>
                                <td>{{$pickup->customer->user->name}}</td>
                                <td>{{$pickup->pickup_contact}}</td>
                                <td>{{$pickup->total_items}}</td>
                                <td>{{$pickup->pickup_date}}</td>
                                <td>
                                @if($pickup->status == 'Completed')
                                <span class="badge badge-pill badge-success mr-3">Completed</span>
                                @else
                                <span class="badge badge-pill badge-pending mr-3">Pending</span>
                                @endif
                                <a href='{{route("$role.pickup.view",["id"=>$pickup->id])}}' class="badge badge-pill badge-green"><i class="fas fa-external-link-alt    br-100"></i></a></td>
                            </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td>No Record</td>
                                </tr>
                            @endif
                         </tbody>
                    </table>
                </div>
                <div class="">
                    @if(count($pickups) > 0)
                    @foreach($pickups as $pickup)
                    <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
                         <div class="d-flex justify-content-between" >
                             <p class="text-black"><b>ID: </b>{{$loop->iteration}}</p>
                             <p class="text-black"><i class="far fa-calendar-alt"></i> {{$pickup->pickup_date}}</p>
                         </div>
                         <div class="d-flex justify-content-between" >
                             <h5 class="text-primary">{{$pickup->customer->user->name}}</h5>
                             <h5 class="text-primary">{{$pickup->total_items}}</h5>
                         </div>
                         <div class="d-flex justify-content-between" >
                             <p class="text-black"><i class="anticon anticon-phone text-primary"></i>{{$pickup->pickup_contact}}</p>
                             <div class="" >
                                @if($pickup->status == 'Completed')
                                <span class="badge badge-pill badge-success mr-3">Completed</span>
                                @else
                                <span class="badge badge-pill badge-pending mr-3">Pending</span>
                                @endif
                              <a href='{{route("$role.pickup.view",["id"=>$pickup->id])}}' class="badge badge-pill badge-green"><i class="fas fa-external-link-alt    br-100"></i></a>
                             </div>
                         </div>
                    </div>
                    @endforeach
                    {{ $pickups->links('vendor.pagination.default') }}
                    @endif                    
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                <td>{{$donate->no_of_items}} </td>
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
                             <p class="text-black"><b>ID:</b> {{$loop->iteration}}</p>
                             <p class="text-black"><b>No of Items:</b> {{$donate->no_of_items}}</p>
                         </div>
                         <div class="d-flex justify-content-between" >
                             <h3 class="text-primary">{{$donate->donor->user->name}}</h3>
                             
                             <h3 class="text-primary">${{$donate->amount}}</h3>
                         </div>
                         <div class="d-column justify-content-between" >
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