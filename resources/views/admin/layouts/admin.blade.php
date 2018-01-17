<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="//fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

        <link href="/css/admin.css" rel="stylesheet">

        @yield('css')

    </head>

    <body id="app-layout">

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="/admin">
                    {{ config('app.name') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                @if( Auth::check() )

                    <!--
                    <ul class="nav navbar-nav">
                        <li><a href="/admin">Admin</a></li>
                        <li><a href="/admin/games">Games</a></li>
                    </ul>
                    -->

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/admin/users/{{ Auth::user()->id }}/edit"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                                <li><a href="/admin/logout"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    </ul>

                @endif

            </div>
        </div>
    </nav>

    <div class="container">

        @if( isset($fatalError) )
            @include('partials.fatal')
        @endif

        <div class="row">
            <div class="col-sm-6">
                <h1 style="font-size: 18px; line-height: 18px; margin: 0 0 20px 0; padding: 0;">
                </h1>
            </div>
            <div class="col-sm-6">
                @yield('moduleNav')
            </div>
        </div>

        <div class="row">

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Navigation</div>
                    <ul id="appNav" class="nav nav-pills nav-stacked">
                        <li @if( Request::segment(2) == 'dashboard' ) class="active" @endif><a href="/admin/dashboard"><i class="fa fa-tachometer fa-fw"></i> Dashboard</a></li>
                        <li @if( Request::segment(2) == 'users' ) class="active" @endif><a href="/admin/users"><i class="fa fa-users fa-fw"></i> Users</a></li>
                        <li @if( Request::segment(2) == 'texts' ) class="active" @endif><a href="/admin/texts"><i class="fa fa-book fa-fw"></i> Texts</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                @yield('content')
            </div>

        </div>

    </div>

    <script type="text/javascript">

        var token = "{{ csrf_token() }}";

    </script>

    <!-- JavaScripts -->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea.tinyMce',
            plugins: ['advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table contextmenu paste code textcolor'],
            toolbar1: 'undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | table | code | thunderbitebutton',
            menubar: false,
            allow_script_urls: true,
            cleanup: false,
            setup: function(editor) {
                editor.addButton('thunderbitebutton', {
                    type: 'menubutton',
                    text: 'Thunderbite',
                    icon: false,
                    menu: [{
                        text: 'Bonus code',
                        onclick: function() {
                            editor.insertContent('[thunderbite_bonus_code]');
                        }
                    }]
                });
            },
        })
    </script>

    <script src="/js/admin.js"></script>

    @yield('js')

    @if( Session::has('error') )
        <script type="text/javascript">
            swal({
                title: "Whoops!",
                text: "{{ Session::get('error') }}",
                timer: 1500,
                showConfirmButton: false,
                type: 'error'
            });
        </script>
    @endif

    @if( Session::has('success') )
        <script type="text/javascript">
            swal({
                title: "Well done!",
                text: "{{ Session::get('success') }}",
                timer: 1500,
                showConfirmButton: false,
                type: 'success'
            });
        </script>
    @endif

</body>
</html>
