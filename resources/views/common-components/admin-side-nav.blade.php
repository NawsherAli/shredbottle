Side Nav START -->
<div class="side-nav">
     <div class="logo logo-dark">
        <a href="{{route('admin.dashboard')}}" class="d-flex justify-content-center">
            <img src="{{asset('assets/images/logo/logo.png')}}" alt="Logo" width="70%" height="75%">
            <!-- <img class="logo-fold" src="assets/images/logo/logo-fold.png" alt="Logo"> -->
        </a>
    </div>
    <div class="side-nav-inner  "   >
        <ul class="side-nav-menu scrollable"  >
            <li class="nav-item">
                <a class="" href="{{route('admin.dashboard')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-appstore"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="" href="{{route('admin.donations')}}">
                    <span class="icon-holder">
                        <i class="fas fa-hand-holding-usd"></i>
                    </span>
                    <span class="title">Donations</span></a>
            </li>
            <li class="nav-item dropdown"  >
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
						<i class="fab fa-keycdn"></i>
					</span>
                    <span class="title">Fund Raising</span>
                    <span class="arrow">
						<!-- <i class="arrow-icon"></i> -->
                        <i class="anticon anticon-down"></i>
					</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a href="{{route('admin.fundraiser.donations')}}">Fundraising Donation</a>
                    </li>
                    <li>
                        <a href="{{route('admin.fundraiser.index')}}">Charities</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown" >
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-hdd"></i>
                    </span>
                    <span class="title">Profile</span>
                    <span class="arrow">
                        <i class="anticon anticon-down"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('drivers.index')}}">Driver Profiles</a>
                    </li>
                    <li>
                        <a href="{{route('drivers.create')}}">Create Driver Profile</a>
                    </li>
                    <li>
                        <a href="{{route('customer.index')}}">Customers</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a class="dropdown-toggle" href="{{route('admin.pickup')}}">
                    <span class="icon-holder">
                        <i class="fas fa-taxi"></i>
                    </span>
                    <span class="title">Pickup request</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a class="dropdown-toggle" href="{{url('/chatify')}}">
                    <span class="icon-holder">
                        <i class="far fa-comment-alt"></i>
                    </span>
                    <span class="title">Chats</span></a>
            </li>
            <li class="nav-item  ">
                <a class="dropdown-toggle" href="{{route('profile.request.index')}}">
                    <span class="icon-holder">
                        <i class="fas fa-users-cog"></i>
                    </span>
                    <span class="title">Profile Requests</span></a>
            </li>
            <li class="nav-item dropdown"  >
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="fab fa-keycdn"></i>
                    </span>
                    <span class="title">Accounts</span>
                    <span class="arrow">
                        <!-- <i class="arrow-icon"></i> -->
                        <i class="anticon anticon-down"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a href="{{route('admin.accounts.customer.index')}}">Customers</a>
                    </li>
                    <li>
                        <a href="{{route('admin.accounts.fundraiser.index')}}">Fundraisers</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a class="dropdown-toggle" href="{{route('transactions.index')}}">
                    <span class="icon-holder">
                        <i class="far fa-money-bill-alt"></i>
                    </span>
                    <span class="title">Transactions</span></a>
            </li>
            <!-- <li class="nav-item  ">
                <a class="dropdown-toggle" href="{{route('admin.profile.edit')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title">Settings</span></a> 
                </ul>
            </li> -->
            <li class="nav-item dropdown" >
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="fas fa-hand-holding-usd"></i>
                    </span>
                    <span class="title">Charties</span>
                    <span class="arrow">
                        <i class="anticon anticon-down"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('charities.index')}}">Charities</a>
                    </li>
                    <li>
                        <a href="{{route('charities.create')}}">Create New</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown" >
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-ordered-list"></i>
                    </span>
                    <span class="title">Materials</span>
                    <span class="arrow">
                        <i class="anticon anticon-down"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('materials.index')}}">All Materials</a>
                    </li>
                    <li>
                        <a href="{{route('materials.create')}}">Add New</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown" >
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="fab fa-servicestack"></i>
                    </span>
                    <span class="title">Services</span>
                    <span class="arrow">
                        <i class="anticon anticon-down"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('services.index')}}">All Services</a>
                    </li>
                    <li>
                        <a href="{{route('services.create')}}">Add New</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown" >
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="fab fa-blogger-b"></i>
                    </span>
                    <span class="title">Blogs</span>
                    <span class="arrow">
                        <i class="anticon anticon-down"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('blogs.index')}}">All Blogs</a>
                    </li>
                    <li>
                        <a href="{{route('blogs.create')}}">Add New</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- Side Nav END