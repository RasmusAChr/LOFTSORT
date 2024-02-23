<?php
include_once 'header.php';
?>
<div id="logininnerwrap">

    <h1 id="loginTitle">Loft Sorter</h1>

    <div class="main" id="login-box" class="col-md-12">

        <h2 style="margin-bottom:15px;">Login</h2>

        <section>
            <form class="login-form" action="includes/login.inc.php" method="post">
                <input class="form-control" type="text" name="username" placeholder="Brugernavn...">
                <input class="form-control" type="password" name="password" placeholder="Kodeord...">
                <button class="btn btn-dark" type="submit" name="submit">Login</button>
            </form>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p>Udfyld alle felter.</p>";
                } else if ($_GET["error"] == "wronglogin") {
                    echo "<p>Ugyldig login oplsyninger.</p>";
                }
            }
            ?>
        </section>
    </div>
</div>
<?php
include_once 'footer.php';
?>