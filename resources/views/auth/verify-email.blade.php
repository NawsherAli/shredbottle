<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ShredTheBottle - Verify Email</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/logo/logo.png')}}">

    <!-- page css -->

    <!-- Core css -->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <div class="app">
        <div class="container-fluid p-0 h-100">
            <div class="row no-gutters h-100 full-height">
                <div class="col-lg-8 d-none d-lg-flex bg-primary-light" >
                    <div class="d-flex h-100 p-h-40 p-v-15   justify-content-between align-items-center">
                        <div>
                            <img src="assets/images/others/login-img.png" alt="">
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4 bg-white ">
                    <div class="container h-100">
                        <div class="row no-gutters h-100 align-items-center">
                            <div class="col-md-12 col-lg-12 col-xl-12 mx-auto">
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                     <img src="assets/images/logo/logo.png" alt="">
                                 </div>
                                 <div class="d-flex align-items-center justify-content-center mb-3">
                                     <h1>Verify Email</h1>
                                 </div>
                                 <div class="mb-4 text-sm text-gray-600">
                                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                </div>
                                @if (session('status') == 'verification-link-sent')
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                    </div>
                                @endif
                                 <div class="mt-4 flex items-center justify-between">
                                    <form method="POST" action="{{ route('verification.send') }}">
                                        @csrf

                                        <div>
                                            <x-primary-button class="btn btn-primary">
                                                {{ __('Resend Verification Email') }}
                                            </x-primary-button>
                                        </div>
                                    </form>
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-center">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <button type="submit" class="btn text-primary">
                                                {{ __('Log Out') }}
                                            </button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Core Vendors JS -->
    <script src="assets/js/vendors.min.js"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="assets/js/app.min.js"></script>

</body>
</html>