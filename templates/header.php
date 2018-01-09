<header class="row">
    <div class="column col-4" id="logo">
        <a href="index.php"><img src="assets/img/logo.png" alt="logo" /></a>
    </div>

    <div class="column col-8">
        <div id="lang">
            <ul>
                <?php
                    languages($language, $pageId);
                ?>
            </ul>
        </div>
        <div id="login-info">
            <?php
                login_info();
            ?>
        </div>
    </div>
</header>
