    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('admin/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('admin/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        // Add event listener to radio buttons
        const roundtripOption = document.getElementById('roundtripOption');
        const roundtripContent = document.getElementById('roundtripContent');
        const onewayOption = document.getElementById('onewayOption');
        const onewayContent = document.getElementById('onewayContent');


        if(onewayOption.checked === true) {
            onewayContent.style.display = 'none';
        } else {
            onewayContent.style.display = 'block';
        }

        roundtripOption.addEventListener('change', () => {
            onewayContent.style.display = 'block';
        });

        onewayOption.addEventListener('change', () => {
            onewayContent.style.display = 'none';
        });
    });
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add event listener to radio buttons
            const roundtripOption = document.getElementById('roundtripOption');
            const roundtripContent = document.getElementById('roundtripContent');
            const onewayOption = document.getElementById('onewayOption');
            const onewayContent = document.getElementById('onewayContent');
    
    
            if(onewayOption.checked === true) {
                onewayContent.style.display = 'none';
            } else {
                onewayContent.style.display = 'block';
            }
    
            roundtripOption.addEventListener('change', () => {
                onewayContent.style.display = 'block';
            });
    
            onewayOption.addEventListener('change', () => {
                onewayContent.style.display = 'none';
            });
          });
    </script>
    
    <script>
      document.addEventListener("DOMContentLoaded", function () {
          var flightTypeSelect = document.getElementById('flight_type');
          var departureDateGroup = document.getElementById('departureDateGroup');
          var returnDateGroup = document.getElementById('returnDateGroup');
          var returnDateInput = document.getElementById('departure_date_return');
    
          flightTypeSelect.addEventListener('change', function () {
              if (this.value === 'round_trip') {
                  departureDateGroup.style.display = 'block';
                  returnDateGroup.style.display = 'block';
                  returnDateInput.disabled = false; // Enable the return date input
              } else if (this.value === 'one_way') {
                  departureDateGroup.style.display = 'block';
                  returnDateGroup.style.display = 'none';
                  returnDateInput.disabled = true; // Disable the return date input
              } else {
                  departureDateGroup.style.display = 'none';
                  returnDateGroup.style.display = 'none';
                  returnDateInput.disabled = false; // Enable the return date input in case it was disabled before
              }
          });
    
          // Initial check for the default value
          if (flightTypeSelect.value === 'round_trip') {
              departureDateGroup.style.display = 'block';
              returnDateGroup.style.display = 'block';
              returnDateInput.disabled = false; // Enable the return date input
          } else if (flightTypeSelect.value === 'one_way') {
              departureDateGroup.style.display = 'block';
              returnDateGroup.style.display = 'none';
              returnDateInput.disabled = true; // Disable the return date input
          } else {
              departureDateGroup.style.display = 'none';
              returnDateGroup.style.display = 'none';
              returnDateInput.disabled = false; // Enable the return date input in case it was disabled before
          }
      });
    
    
    
    </script>
    
    