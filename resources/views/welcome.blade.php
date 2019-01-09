<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        

        <!-- Styles -->
        <style>
            html, body {
                background-color: #ffc;
                color: #636b6f;              
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 42px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;            
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('items') }}">主页</a>
                    @else
                        <a href="{{ route('login') }}">登录</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">注册</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md links">
                    <h1>XX交通集团</h1>
                    <a href="{{url('login')}}"><h5>{{ config('app.name', 'Laravel') }}</h5></a>
                </div>                
            </div>
        </div>
    </body>
</html>
