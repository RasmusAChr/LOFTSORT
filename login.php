<?php
    include_once 'header.php';
?>
    <div id="title">
        <h1>Login</h1>
    <div id="main" class="col-md-12" style="background-color:red;">

    <section class="login-form">
                <form action="includes/login.inc.php" method="post">
                    <input type="text" name="username" placeholder="Brugernavn...">
                    <input type="password" name="password" placeholder="Kodeord...">
                    <button type="submit" name="submit">Login</button>
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
<?php
    include_once 'footer.php';
?>