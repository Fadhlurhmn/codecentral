<!-- script -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ asset('js/scripts.js') }}"></script>

{{-- AOS --}}
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<!-- end script -->
@stack('js')
<script>
    document.getElementById('closeButton').addEventListener('click', function() {
        document.getElementById('successMessage').style.display = 'none';
    });
    document.getElementById('closeButton').addEventListener('click', function() {
        document.getElementById('errorMessage').style.display = 'none';
    });
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>
</body>
</html>