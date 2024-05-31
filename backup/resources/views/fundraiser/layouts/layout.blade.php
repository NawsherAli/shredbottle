@include('common-components.header')
@include('common-components.top-nav')
@include('common-components.fundraiser-side-nav')
<link rel="stylesheet" href="{{ asset('assets/css/customer-style.css') }}">
<!-- Page Container START -->
    <div class="page-container">
<!-- Content Wrapper START -->
        <div class="main-content">
        	<div class="container">
			@if(session('error'))
			    <div class="alert alert-danger rounded-lg">
			        <p class="text-red-700">{{ session('error') }}</p>
			    </div>
			@endif
			@if(session('success'))
			    <div id="successMessage" class="alert alert-success">
			        {{ session('success') }}
			    </div>
			@endif
			@if($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
            @yield('contents')
        </div>
<!-- Content Wrapper END -->
    </div>
<!-- Page Container END -->
@include('common-components.footer')