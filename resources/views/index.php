<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Project Manager</title>
        <link rel="stylesheet" href="/assets/css/app.css">
    </head>
    <body ng-app="projectManager">

        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Project Manager</a>
            </div>
          </div><!-- /.container-fluid -->
        </nav>

        <div class="container">
            <div ui-view></div>
        </div>        

    </body>

    <!-- Application Dependencies -->
    <script src="/assets/js/vendor.js"></script>

    <!-- Application Scripts -->
    <script src="/assets/js/application.js"></script>
</html>