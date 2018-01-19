<main class="row">
    <section class="column col-8" id="main-content">
        <article>
            <?php
                $file = strtolower($pageId).".php";
                include($file);
            ?>
        </article>
    </section>
    <aside class="column col-4">
        <?php
            include("shoppingcart.php");
        ?>
    </aside>
</main>
