<header class="row">
    <div class="column col-4" id="logo">
        <a href="index.php"><img src="assets/img/logo.png" alt="logo" /></a>
    </div>
    <div class="column col-4">
    </div>
    <div class="column col-4">
            <!--<img src="assets/img/order_button.png" alt="order button" />-->
        <div id="lang">
            <ul>
                <?php languages($language, $pageId);?>
            </ul>
        </div>
        <div>
            <?php
                login_info();
            ?>
        </div>

    </div>
</header>
