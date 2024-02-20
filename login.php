<?php
    include_once 'header.php';
?>
    <div id="logininnerwrap">
        <div id="main" class="col-md-12">

            <h1>Login</h1>

            <section>
                <form class="login-form" action="includes/login.inc.php" method="post">
                    <input class="form-control" type="text" name="username" placeholder="Brugernavn...">
                    <input class="form-control" type="password" name="password" placeholder="Kodeord...">
                    <button class="btn btn-dark" type="submit" name="submit">Login</button>
                </form>

                <?php
                if (isset($_GET["error"])) {
                    if($_GET["error"] == "emptyinput") {
                        echo "<p>Udfyld alle felter.</p>";
                    }
                    else if ($_GET["error"] == "wronglogin") {
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