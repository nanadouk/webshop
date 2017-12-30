<?php require("functions.php");?>
<!doctype html>
<html lang="de-CH">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/layout.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <title>Webshop</title>
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
