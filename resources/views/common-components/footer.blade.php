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
    <script>
        $(document).ready(function () {
            // Hide the success message after 5 seconds (5000 milliseconds)
            setTimeout(function () {
                $('#errorMessage').fadeOut('slow');
            }, 4000);
        });
    </script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

<script>
    $(document).ready(function () {
        // Get the current URL
        var currentUrl = window.location.href;

        // Loop through each anchor tag in the side navigation
        $('.side-nav-menu a').each(function () {
            // Check if the anchor's href matches the current URL
            if (currentUrl.indexOf($(this).attr('href')) !== -1) {
                // Add the 'active' class to the parent <li> element
                $(this).closest('li').addClass('active');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.mark-as-read').click(function() {

            var notificationId = $(this).data('notification-id');
             // alert(notificationId);
            $.ajax({
                url: '/mark-as-read/' + notificationId,
                method: 'POST',
                // dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // alert(response);
                    // Refresh the page or update the UI as needed
                    location.reload(); // Example: Reload the page to reflect changes
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        // Get the current URL
        var currentUrl = window.location.href;

        // Loop through each anchor tag in the side navigation
        $('.side-nav-menu a').each(function () {
            var menuItemUrl = $(this).attr('href');

            // Check if the anchor's href matches the current URL
            if (currentUrl.indexOf(menuItemUrl) !== -1) {
                // Add the 'active' class to the parent <li> element
                $(this).closest('li').addClass('active');

                // If it's a dropdown, also add 'active' class to the parent dropdown item
                if ($(this).closest('.dropdown').length) {
                    $(this).closest('.dropdown').addClass('active');
                }
            }
        });
    });
</script> -->
<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>

 
</html>