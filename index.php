<?php

    require_once("autoloader.php");
    if (!DB::create('localhost', 'root', 'project!2018)Web', 'terraemare')) {
        die("Unable to connect to database [".DB::getInstance()->connect_error."]");
    }
    require("functions.php");
?>
<!doctype html>
<html lang="de-CH">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/layout.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="assets/js/confirmation.js"></script>
        <script src="assets/js/login.js"></script>
        <script src="assets/js/options.js"></script>
        <script src="assets/js/totalcalculation.js"></script>

        <title>Webshop | <?php echo $pageId?> </title>
	</head>
	<body>
        <div id="page">
		    <?php
                include("header.php");
                include("navigation.php");
                if ($pageId == "Home")
                    include("slider.php");
                include("main.php");
                include("footer.php")
		    ?>
        </div>
    </body>
</html>
