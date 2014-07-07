<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="/css/screen.css" />
    <link rel="stylesheet" href="/css/rate.css" />

    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script>window.html5 || document.write('<script src="/js/vendor/html5shiv.js"><\/script>')</script>
    <![endif]-->

    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.rate.js"></script>

</head>
<body>
<div id="wrapper">
    <header>
        <?php
            // PHPStorm does not like dynamic includes
            include (! file_exists("$route/header.php"))
                ? APP_PATH . '/src/view/generic/header.php'
                : "$route/header.php";
        ?>
    </header>


    <div id="main">


        <div id="rate1" data-id="OID-1" class="rating">&nbsp;</div>
    </div>


    <footer>
        <?php
        // PHPStorm does not like dynamic includes
        include (! file_exists("$route/footer.php"))
            ? APP_PATH . '/src/view/generic/footer.php'
            : "$route/footer.php";
        ?>
    </footer>

</div>
<script src="/js/main.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#rate1').rate('/handler',{max:5, inc:.5});
    });
</script>

</body>
</html>
