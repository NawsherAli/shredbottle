<!-- Side Nav START -->
<div class="side-nav">
     <div class="logo logo-dark">
        <a href="{{route('customer.dashboard')}}" class="d-flex justify-content-center">
            <img src="{{asset('assets/images/logo/logo.png')}}" alt="Logo" width="70%" height="75%">
            <!-- <img class="logo-fold" src="assets/images/logo/logo-fold.png" alt="Logo"> -->
        </a>
    </div>
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item  ">
                <a class="dropdown-toggle" href="{{route('customer.dashboard')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-appstore"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a class="dropdown-toggle" href="{{route('pickup.create')}}">
                    <span class="icon-holder">
                        <i class="fas fa-taxi"></i>
                    </span>
                    <span class="title">Pickup request</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="dropdown-toggle" href="{{route('customer.donations')}}">
                    <span class="icon-holder">
                        <i class="fas fa-hand-holding-usd"></i>
                    </span>
                    <span class="title">Donations</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a class="dropdown-toggle" href="{{url('/chatify')}}">
                    <span class="icon-holder">
                        <i class="far fa-comment-alt"></i>
                    </span>
                    <span class="title">Chats</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="{{route('customer.fundraiser.index')}}">
                    <span class="icon-holder">
                        <i class="fab fa-keycdn"></i>
                    </span>
                    <span class="title">Fundraising</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="{{route('customer.transactions.index')}}">
                    <span class="icon-holder">
                        <i class="far fa-money-bill-alt"></i>
                    </span>
                    <span class="title">Transactions</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a class="dropdown-toggle" href="{{route('customer.profile.edit')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title">Settings</span></a> 
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- Side Nav END -->