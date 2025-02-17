<!-- Vendor JS Files -->
<script src="{{ asset('assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/front/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/front/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/front/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/front/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/front/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/front/js/main.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/libs/jquery/jquery.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    @if (Session::has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "preventDuplicates": true,
            'closeDuration'   : 2000,
        }
        toastr.success("{{ session('message') }}");
    @endif

    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "preventDuplicates": true,
            'closeDuration'   : 2000,

        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "preventDuplicates": true,
            'closeDuration'   : 6000,

        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "preventDuplicates": true,
            'closeDuration'   : 2000,

        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>
@yield('js')
