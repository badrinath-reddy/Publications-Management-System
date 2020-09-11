<?php
require 'lib/connection.php';

$id = $_POST['people_id'];
$ins = "update people set is_faculty=0  where people_id='$id' ;";
$result = $conn->query($ins);
if ($result) {
?>
    <script>
        alert("deleted people");

        window.location = "admin.php";
    </script>
<?php
}
?>