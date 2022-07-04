<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
    @yield('styles')
    <style>
        @import url("https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
        @import url(https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);
        .loader {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: none;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            z-index: 9999;
            background-color: rgba(0,0,0,0.5);
        }

        .loader img {
            width: 300px;
            height: 300px;
        }

        .loader .triple-spinner {
            display: block;
            position: relative;
            width: 125px;
            height: 125px;
            border-radius: 50%;
            border: 5px solid transparent;
            border-top: 5px solid #0E485F;
            -webkit-animation: spin 1s linear infinite;
            animation: spin 1s linear infinite;
        }

        .loader .triple-spinner::before,
        .loader .triple-spinner::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            border: 5px solid transparent;
        }

        .loader .triple-spinner::before {
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border-top-color: #98B748;
            -webkit-animation: spin 3s linear infinite;
            animation: spin 3.5s linear infinite;
        }

        .loader .triple-spinner::after {
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border-top-color: #E08A33;
            -webkit-animation: spin 1.5s linear infinite;
            animation: spin 1.75s linear infinite;
        }

        @-webkit-keyframes spin {
            from {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            to {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spin {
            from {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            to {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page">
<div class="loader">
    <div class="triple-spinner"></div>
</div>
@yield('content')
@yield('scripts')
<script>
    $( document ).ready(function() {
        $('li').each(function(){

            var op = $(this)

            $(this).removeClass('active')
            $('ul').removeClass('show')

            var href = $(this).find('a').attr('href')
            var my = window.location.href;
            if (href == my){

                var TagA = op.closest('ul').attr('id')

                $('a').each(function() {
                    if ($(this).attr('href') == '#'+TagA ){
                        $(this).click()
                    }
                });
                $(this).addClass('active')
            }
        });
    });

</script>

<script>

</script>
</body>

</html>
