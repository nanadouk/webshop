<header class="row">
    <div class="column col-3" id="logo">
            <p><img src="assets/img/logo.png" alt="logo" /></p>
        </div>
        <div class="column col-5" id="contact-info">
            <i class="fa fa-phone"></i>
            <p>032 321 61 11</p>
            <p>call us</p>
        </div>
        <div class="column col-4" id="lang">
            <!--<img src="assets/img/order_button.png" alt="order button" />-->
            <ul>
                <?php languages($language, $pageId);?>
            </ul>
        </div>

    </header>
