<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content=""> 
    <meta name="userEmail" content=""> 
    @yield('style')
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar/style.css') }}">
   
    
  
    <link rel="stylesheet" href="{{ asset('boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jstree/dist/themes/default/style.min.css') }}" />
  
    <title>Dashboard Sidebar Menu</title>
  </head>
  
  <body >
  
    @include('sections.sidebar')
  
    <section class="home">
        
        @yield('body')
        
        
    </section>
  
    <script type="text/javascript" src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sidebar/script.js') }}"></script>
  
    <script src="{{ asset('boxicons/boxicons.js') }}"></script>
    <script src="{{ asset('jstree/dist/jstree.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("button[data-dismiss=modal]").click(function()
        {
          $(".modal").modal('hide');
        });
    </script>
    @include('sweetalert::alert')
    @yield('script')
  </body>