<!DOCTYPE html>

<html lang="en">

<head id="Starter-Site">

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- CSS -->
        {{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') }}
    <style>
        body {
            margin: 50px 0;
        }
    </style>

</head>

<body>
<!-- Container -->
<div class="container">

    <!-- Content -->
    @yield('content')
    <!-- ./ content -->

</div>


</body>

</html>