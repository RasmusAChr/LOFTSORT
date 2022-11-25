<?php
    include_once 'header.php';
?>
    <h1>Add box</h1>
    <form action="includes/addbox.inc.php" method="post">
        <input id="namefield" type="text" name="name" placeholder="Name">
        <input id="section" type="text" name="section" placeholder="Section">
        <input type="text" name="note" placeholder="Note">
        <input type="submit" name="submit">
    </form>
    <a href="index.php"><button>back</button></a>

    <?php
    include_once 'footer.php';
?>