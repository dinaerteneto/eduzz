<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/app.css">

    <title>Eduzz</title>
  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 page-header">

                <div class="row">
                    <div class="col-lg-12">
                        @foreach (range('A', 'Z') as $letter)
                            <a href="#" class="btn btn-primary btn-xs">{{ $letter }}</a>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>

        <div class="row">
            @yield('content')
        </div>
    </div>

    <script src="js/scripts.js"></script>
  </body>
</html>
