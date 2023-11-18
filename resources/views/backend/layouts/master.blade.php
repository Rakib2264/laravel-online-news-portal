<!DOCTYPE html>
<html lang="en">
    <head>
        @include('backend.includes.header')
    </head>
    <body class="sb-nav-fixed">
        @include('backend.includes.nav')
        <div id="layoutSidenav">
            @include('backend.includes.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">@yield('page_title')</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">@yield('page_sub_title')</li>
                        </ol>

                        @yield('content')

                    </div>
                </main>
         @include('backend.includes.footer')
            </div>
        </div>
        @include('backend.includes.js')
        </body>
</html>
