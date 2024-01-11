@include('common-components.header')
@include('common-components.top-nav')
@include('common-components.admin-side-nav')

<!-- Page Container START -->
    <div class="page-container">
<!-- Content Wrapper START -->
        <div class="main-content">
            @yield('contents')
        </div>
<!-- Content Wrapper END -->
    </div>
<!-- Page Container END -->
@include('common-components.footer')