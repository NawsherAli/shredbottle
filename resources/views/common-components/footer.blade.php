</div>
    </div>

    
    <!-- Core Vendors JS -->
    <script src="{{asset('assets/js/vendors.min.js')}}"></script>

    <!-- page js -->
    <script src="{{asset('assets/vendors/chartjs/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard-default.js')}}"></script>

    <!-- Core JS -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            // Hide the success message after 5 seconds (5000 milliseconds)
            setTimeout(function () {
                $('#successMessage').fadeOut('slow');
            }, 4000);
        });
    </script>
</body>

 
</html>