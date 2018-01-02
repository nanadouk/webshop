<header class="row">
    <div class="column col-4" id="logo">
        <p><img src="assets/img/logo.png" alt="logo" /></p>
    </div>
    <div class="column col-4" id="loggedin">
        <p id="loggedin-user"></p>
        <a href="javascript:loginForm()">Logout</a>
    </div>
    <div class="column col-4" id="lang">
            <!--<img src="assets/img/order_button.png" alt="order button" />-->
        <ul>
            <?php languages($language, $pageId);?>
        </ul>
    </div>


</header>
