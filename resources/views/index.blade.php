<!doctype html>
<html lang="en">
<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cortejando Front</title>
    <!-- styles -->
    <link rel="stylesheet" href="/assets/css/app.css"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body ng-app="cortejando">

<div ng-include="'templates/partials/nav.html'"></div>

<div class="container">
    <div ui-view></div>
</div>

</body>
<!-- scripts -->
<script src="/assets/js/vendor/vendor.min.js"></script>
<script src="/assets/js/vendor/angular.min.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/config.js"></script>
<script src="/translations/nl_NL.js"></script>
<script src="/translations/es_ES.js"></script>
<script src="/assets/js/routes.js"></script>
<script src="/assets/js/controllers/MainController.js"></script>
<script src="/assets/js/controllers/UserController.js"></script>
<script src="/assets/js/controllers/AboutUsController.js"></script>
<script src="/assets/js/services/AuthInterceptor.js"></script>
<script src="/assets/js/services/AuthService.js"></script>
<script src="/assets/js/services/UserService.js"></script>
</html>