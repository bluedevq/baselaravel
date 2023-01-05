<!DOCTYPE html>
<html lang="ja">
<head>
    @include('backend.layouts.structures.head')
</head>
<body class="{{ getBodyClass() }}">
<div id="wrapper" class="wrapper">
    <div id="page-wrapper" class="wrap-content backend main">
        @include('backend.layouts.structures.navbar')
        <div class="container">
            <div class="mt-2">
                {{ Breadcrumbs::render() }}
            </div>
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    @include('backend.layouts.structures.footer')
</div>
@stack('scripts')
</body>
</html>
