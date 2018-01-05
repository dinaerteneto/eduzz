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
                        <h1>
                            <div class="row">
                                <div class="col-lg-6">
                                    <i class="fa fa-users" aria-hidden="true"></i> Candidatos
                                </div>

                                <div class="col-lg-6 pull-right">
                                    <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Pesquisar por nome...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                            </div>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">

                <div class="row">
                    @foreach (range('A', 'Z') as $letter)
                        <a href="#" class="btn btn-primary btn-xs">{{ $letter }}</a>
                    @endforeach
                </div>

                <div class="row">
                    @yield('content')
                </div>

            </div>

        </div>
    </div>

    <script src="js/scripts.js"></script>
  </body>
</html>
