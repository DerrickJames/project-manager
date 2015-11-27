<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="/">
        <title>Project Manager</title>
        <link rel="stylesheet" href="/assets/css/app.css">
    </head>
    <body ng-app="projectManager">
        
        <div data-ng-include="'views/navBar.html'"></div>

        <div class="container">
            <div ui-view></div>
        </div>        

    </body>

    <!-- Application Dependencies -->
    <script src="/assets/js/vendor.js"></script>

    <!-- Application Scripts -->
    <script src="/assets/js/application.js"></script>
</html>
