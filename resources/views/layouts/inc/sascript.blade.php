<script src="{{ asset('superadmin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('superadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('superadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('superadmin/js/ruang-admin.min.js') }}"></script>
<script src="{{ asset('superadmin/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('superadmin/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('superadmin/js/sweetalert2.all.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('superadmin/vendor/select2/dist/js/select2.min.js') }}"></script>
<!-- Bootstrap Datepicker -->
<script src="{{ asset('superadmin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap Touchspin -->
<script src="{{ asset('superadmin/vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js') }}"></script>
<!-- ClockPicker -->
<script src="{{ asset('superadmin/vendor/clock-picker/clockpicker.js') }}"></script>
<script>
    $(document).ready(function () {


      $('.select').select2();

      // Select2 Single  with Placeholder
      $('.select-placeholder').select2({
        placeholder: "Select a Province",
        allowClear: true
      });      

      // Select2 Multiple
      $('.select2-multiple').select2();

      // Bootstrap Date Picker
      $('#departureDate .input-group.date').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true, 
        startDate: 'today'       
      });

      $('#arrivalDate .input-group.date').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,      
        startDate: 'today'  
      });

      $('#departureDateReturn .input-group.date').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true, 
        startDate: 'today'       
      });

      $('#arrivalDateReturn .input-group.date').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,      
        startDate: 'today'  
      });

      $('#departureTime, #arrivalTime, #departureTimeReturn,  #arrivalTimeReturn').clockpicker({
        autoclose: true,
        twelvehour: true, // Display in 12-hour format with AM/PM
      });

    });
  </script>


<!-- Page level plugins -->
<script src="{{ asset('superadmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('superadmin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script>
  $(document).ready(function () {
    $('#dataTable').DataTable(); // ID From dataTable 
    $('#dataTableHover').DataTable(); // ID From dataTable with Hover
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const fileInput = document.getElementById('formFile');
      const fileLabel = document.getElementById('file-label');

      fileInput.addEventListener('change', function () {
          if (fileInput.files.length > 0) {
              fileLabel.textContent = fileInput.files[0].name;
          } else {
              fileLabel.textContent = 'Choose a file';
          }
      });
  });
</script>
<script>
  document.getElementById('originSelect').addEventListener('change', function() {
      var selectedOrigin = this.value;
      var destinationSelect = document.getElementById('destinationSelect');
      var destinationOptions = destinationSelect.options;

      for (var i = 0; i < destinationOptions.length; i++) {
          if (destinationOptions[i].value == selectedOrigin) {
              destinationOptions[i].style.display = 'none';
          } else {
              destinationOptions[i].style.display = 'block';
          }
      }
  });
</script>
@if (session('success'))
<script>
  Swal.fire(
    '',
    '{{ session('success') }}',
    'success'
  )
</script>
@endif
@if (session('error'))
<script>
  Swal.fire({
  icon: 'error',
  text: '{{ session('error') }}',
})
</script>
 @endif
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

