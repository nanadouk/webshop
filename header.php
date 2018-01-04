<header class="row">
    <div class="column col-4" id="logo">
        <p><img src="assets/img/logo.png" alt="logo" /></p>
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
        <div id="after_login">
            <p><?php
                if (isset($_SESSION['user'])) {
                    $logged_user = $_SESSION['user'];
                    echo "<span>Logged in as, $logged_user!</span>";
                }?>
                <a href="javascript:loginForm()">Logout</a>
            </p>
        </div>
        <div id="before_login">
            <p><a href="javascript:loginForm()">Login</a></p>
        </div>
    </div>
</header>
