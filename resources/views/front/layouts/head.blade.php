  <!-- Favicons -->
  <link href="{{ asset('assets/front/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/front/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/vendor/aos/aos.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/front/css/main.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  @yield('css')
  <style>
      @import url('https://fonts.googleapis.com/css2?family=Palanquin+Dark&display=swap');
     .breadcrumbs .page-header h2{
        font-family: 'Palanquin Dark', sans-serif;
    }
    .logout-btn{
      color: var(--color-secondary);
    }
    .header {
    background: rgba(14, 29, 52, 0.9);
    padding: 15px 0;
    box-shadow: 0px 2px 20px rgb(14 29 52 / 10%);
}
    @media (max-width: 1279px){
.navbar button:hover, .navbar .active, .navbar .active:focus, .navbar li:hover>button , .logout-btn{
    color: #fff;
}
}
  </style>
