@php
    $image = Auth::user()->profile_image;
    $role = Auth::user()->role;

    $border = ($role == 'admin' ? 'header-border' : '');
@endphp

<!-- TOP NAVIGATION -->
<div class="header {{$border}}">
    <div class="logo logo-dark">
        <!-- <a href="index.html">
            <img src="assets/images/logo/logo.png" alt="Logo">
            <img class="logo-fold" src="assets/images/logo/logo-fold.png" alt="Logo">
        </a> -->
    </div>
    <div class="logo logo-white">
        <!-- <a href="index.html">
            <img src="assets/images/logo/logo-white.png" alt="Logo">
            <img class="logo-fold" src="assets/images/logo/logo-fold-white.png" alt="Logo">
        </a> -->
    </div>
    <div class="nav-wrap">
        <ul class="nav-left">
            <li class="desktop-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon text-primary"></i>
                </a>
            </li>
            <li class="mobile-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
        </ul>
        <ul class="nav-right">
            <li class="dropdown dropdown-animated scale-left">
                <a href="{{url('/chatify')}}"  >
                    <i class="anticon anticon-message"></i>
                </a>
            </li>
            <!-- <li class="dropdown dropdown-animated scale-left">
                <a href="javascript:void(0);" data-toggle="dropdown">
                    <i class="anticon anticon-bell notification-badge"></i>
                </a>
                <div class="dropdown-menu pop-notification">
                    <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                        <p class="text-dark font-weight-semibold m-b-0">
                            <i class="anticon anticon-bell"></i>
                            <span class="m-l-10">Notification</span>
                        </p>
                        <a class="btn-sm btn-default btn" href="javascript:void(0);">
                            <small>View All</small>
                        </a>
                    </div>
                    <div class="relative">
                        <div class="overflow-y-auto relative scrollable" style="max-height: 300px">
                            <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                <div class="d-flex">
                                    <div class="avatar avatar-blue avatar-icon">
                                        <i class="anticon anticon-mail"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <p class="m-b-0 text-dark">You received a new message</p>
                                        <p class="m-b-0"><small>8 min ago</small></p>
                                    </div>
                                </div>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                <div class="d-flex">
                                    <div class="avatar avatar-cyan avatar-icon">
                                        <i class="anticon anticon-user-add"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <p class="m-b-0 text-dark">New user registered</p>
                                        <p class="m-b-0"><small>7 hours ago</small></p>
                                    </div>
                                </div>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                <div class="d-flex">
                                    <div class="avatar avatar-red avatar-icon">
                                        <i class="anticon anticon-user-add"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <p class="m-b-0 text-dark">System Alert</p>
                                        <p class="m-b-0"><small>8 hours ago</small></p>
                                    </div>
                                </div>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item d-block p-15 ">
                                <div class="d-flex">
                                    <div class="avatar avatar-gold avatar-icon">
                                        <i class="anticon anticon-user-add"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <p class="m-b-0 text-dark">You have a new update</p>
                                        <p class="m-b-0"><small>2 days ago</small></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </li> -->
           <li class="dropdown dropdown-animated scale-left">
    <a href="javascript:void(0);" data-toggle="dropdown">
        <div class="avatar avatar-text avatar-badge  pickuprequest-css" style="background-color: white; ">
           <i class="anticon anticon-bell text-dark" style="font-size: 20px; "></i>
           @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="badge badge-indicator badge-danger" style="">{{ auth()->user()->unreadNotifications->count() }}</span>
           @endif
        </div>
    </a>
    <!-- <a href="javascript:void(0);" data-toggle="dropdown">
        <i class="anticon anticon-bell notification-badge avatar avatar-text avatar-badge">
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="badge badge-indicator badge-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
        @endif
        </i>
    </a> -->    
    <div class="dropdown-menu pop-notification">
        <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
            <p class="text-dark font-weight-semibold m-b-0">
                <i class="anticon anticon-bell"></i>
                <span class="m-l-10">Notifications</span>
            </p>
           <!--  <a class="btn-sm btn-default btn" href="javascript:void(0);">
                <small>View All</small>
            </a> -->
        </div>
        <div class="relative">
            <div class="overflow-y-auto relative scrollable" style="max-height: 300px; ">
                @forelse(auth()->user()->unreadNotifications as $notification)
                    <div class="dropdown-item d-block p-15 border-bottom">
                        <div class="d-flex " style=" ">
                            <div class="avatar avatar-blue avatar-icon" style="  ">
                                <i class="anticon anticon-bell"></i>
                            </div>
                            <div class="m-l-15">
                                <p class="m-b-0 text-dark" style="font-size: 12px">{{ $notification->data['message'] }}</p>
                                <p class="m-b-0"><small>{{ $notification->created_at->diffForHumans() }}</small>
                                 <button class="badge badge-pill badge-green  mark-as-read" data-notification-id="{{ $notification->id }}">Mark as Read</button>   
                                </p>
                            </div>
                        </div>
                            <!-- <div class="ml-auto">
                                
                            </div> -->
                        
                    </div>
                @empty
                    <div class="dropdown-item d-block p-15 border-bottom">
                        <div class="d-flex " style=" ">
                            <div class="avatar avatar-blue avatar-icon" style="  ">
                                <i class="anticon anticon-bell"></i>
                            </div>
                            <div class="m-l-15">
                                <p class="m-b-0 text-dark" >No new notifications </p>
                                <p class="m-b-0">
                            </div>
                        </div>
                @endforelse
            </div>
        </div>
    </div>
</li>


            <li class="scale-left admin-name" >
                <div class="m-l-10">
                    <p class="m-b-0 text-dark font-weight-semibold">{{ Auth::user()->name }}</p>
                    <p class="m-b-0 opacity-07">{{ Auth::user()->role }}</p>
                </div>
            </li>
            <li class="dropdown dropdown-animated scale-left">
                <div class="pointer" data-toggle="dropdown">
                    <div class="avatar avatar-image  m-h-10 m-r-15">
                        <img src='{{asset("assets/images/avatars/$image")}}'  alt="">
                    </div>
                    <i class="fas fa-ellipsis-v" style="font-size: 25px"></i>
                </div>

                <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                    <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                        <div class="d-flex m-r-50">
                            <div class="avatar avatar-lg avatar-image">
                                <img src='{{asset("assets/images/avatars/$image")}}' alt="">
                            </div>
                            <div class="m-l-10">
                                <p class="m-b-0 text-dark font-weight-semibold">{{ Auth::user()->name }}</p>
                                <p class="m-b-0 opacity-07">{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                    </div>
                    <a href='{{route("$role.profile.edit")}}' class="dropdown-item d-block p-h-15 p-v-10">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                                <span class="m-l-10">Edit Profile</span>
                            </div>
                            <i class="anticon font-size-10 anticon-right"></i>
                        </div>
                    </a>
                     <form method="POST" action="{{ route('logout') }}">
                      @csrf
                    <a href="{{route('logout')}}" class="dropdown-item d-block p-h-15 p-v-10"  onclick="event.preventDefault();this.closest('form').submit();">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                <span class="m-l-10">Logout</span>
                            </div>
                            <i class="anticon font-size-10 anticon-right"></i>
                        </div>
                    </a>
                    </form>
                </div>
            </li>
            <!-- <li>
                <a href="javascript:void(0);" >
                    <i class="fas fa-ellipsis-v"></i>
                </a>
            </li> -->
        </ul>
    </div>
</div>    
<!-- TOP NAVIGATION -->