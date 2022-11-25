<?php
    include_once 'header.php';
?>
    <h1>Add item</h1>
    <form action="includes/additem.inc.php" method="post">
        <input id="namefield" type="text" name="name" placeholder="Name">
        <input id="section" type="text" name="section" placeholder="Section">
        <select id="box" name="box" onChange="selectChanged()">
            <option value="0"></option>
            <?php
                include 'includes/db.inc.php';
                $sql = "SELECT * FROM box ORDER BY name ASC";
                $result = $conn->query($sql);
                if ($result !== false && $result->num_rows > 0){
                    
                    while ($row = $result->fetch_assoc()) { // Laver resultatet med rækker om til en array man kan håndtere og kører loopet indtil der ikke er flere elementer i array.
                        echo "  
                        <option value=".$row["id"].">".$row["name"]."</option>
                        ";
                        }
                    }
            ?>
        </select>
        <input type="text" name="note" placeholder="Note">
        <input type="submit" name="submit">
    </form>
    <a href="index.php"><button>back</button></a>
    
    <script>
        function selectChanged() {
            var x = document.getElementById("box").value;
            
            if (x != 0) {
                document.getElementById("section").setAttribute("readonly", "readonly");
                document.getElementById("section").value = "";
            } else {
                document.getElementById("section").removeAttribute("readonly");
                document.getElementById("section").value = "";
            }
        }
        selectChanged();
    </script>

<?php
    include_once 'footer.php';
?>