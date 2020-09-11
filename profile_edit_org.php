<?php

session_start();
$p_id = $_SESSION['login_user'];
require 'lib/connection.php';
$org = $_GET['orga'];
$sql = "delete from affilliated_to where people_id='$p_id';";
$result = $conn->query($sql);
foreach ($org as $or) {
    $sql7 = "insert into affilliated_to values('$p_id',$or);";
    $result7 = $conn->query($sql7);
}

if ($result7 && $result) {
?>
    <script>
        alert("edited your organisation");
        window.location = "profile.php";
    </script>
<?php
}
?>