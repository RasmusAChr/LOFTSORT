<?php
    include_once 'header.php';
?>
    <h1>Edit item</h1>

    <form action="includes/edititem.inc.php" method="post">

    <?php 
        include "includes/db.inc.php";

        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            $sql = "SELECT item.id, item.name, item.section, item.note, box.name as boxname FROM item LEFT JOIN iteminbox ON item.id = iteminbox.item_id LEFT JOIN box ON iteminbox.box_id = box.id WHERE item.id = $id";

        }
        else {
            header("index.php");
            exit();
        }
        
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $currentsection = $row['section'];
                $currentbox = $row['boxname'];
                echo '
                <input id="id" type="text" name="id" value="'.$_GET["id"].'" readonly>
                <input id="namefield" type="text" name="name" placeholder="Name" value="'.$row['name'].'">
                <input id="section" type="text" name="section" placeholder="Section" value="'.$row['section'].'">
                <input type="text" name="note" placeholder="Note" value="'.$row['note'].'">
                <select id="box" name="box" onChange="selectChanged()">
                <option value="0"></option>
                ';
                        include 'includes/db.inc.php';
                        $sql = "SELECT * FROM box ORDER BY name ASC";
                        $result = $conn->query($sql);
                        if ($result !== false && $result->num_rows > 0){
                            
                            while ($row = $result->fetch_assoc()) { // Laver resultatet med rækker om til en array man kan håndtere og kører loopet indtil der ikke er flere elementer i array.
                                echo "  
                                <option id=".$row["name"]." value=".$row["id"].">".$row["name"]."</option>
                                ";
                                }
                            }
                echo '
                </select>
                
                ';
                
                // echo "
                // <input id='id' type='text' name='box_id' value='".$row['id']."' readonly>
                // <input id='namefield' type='text' name='name' placeholder='Name' value='".$row['name']."'>
                // <input id='section' type='text' name='section' placeholder='Section' value='".$row['section']."'>
                // <input id='box' type='text' name='section' placeholder='Section' value='".$row['boxname']."'>
                // <input type='text' name='note' placeholder='Note' value='".$row['note']."'>
                // ";
            }
        }
        else { // Hvis resultatet ($result) så er 0 eller under er brugeren ved en fejl kommet ind, og skal dirigeres tilbage.
            header("index.php");
            exit();
        }
    ?>

    
        <!-- <input id="namefield" type="text" name="name" placeholder="Name">
        <input id="section" type="text" name="section" placeholder="Section">
        <input type="text" name="note" placeholder="Note">
        <input type="submit" name="submit" value="Gem"> -->

        <input type='submit' name='submit' value='Gem'>
    </form>
    <a href="index.php"><button>back</button></a>

    <script>
        function startSelect(){
            document.getElementById("<?php echo"$currentbox"; ?>").selected = true;
            document.getElementById("section").setAttribute("readonly", "readonly");
            document.getElementById("section").value = "";
        }

        function selectChanged() {
            var x = document.getElementById("box").value;
            
            if (x != 0) {
                document.getElementById("section").setAttribute("readonly", "readonly");
                document.getElementById("section").value = "";
            } else {
                document.getElementById("section").removeAttribute("readonly");
                document.getElementById("section").value = '<?php echo"$currentsection"; ?>';
            }
        }
        selectChanged();
        window.onload = startSelect;
    </script>

<?php
    include_once 'footer.php';
?>