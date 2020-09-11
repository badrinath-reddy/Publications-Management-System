<?php

require 'lib/connection.php';
$org_name = $_POST['org_name2'];

$address = $_POST['address'];
$p = $_POST['p_g'];
$h = $_POST['has_people'];

$ins = "update  organisations set address='$address',p_g='$p',has_people='$h' where organisation_id='$org_name' ;";

$result = $conn->query($ins);
if ($result) {
?>

    <script>
        alert("edited organisation");
        window.location = "admin.php";
    </script>

<?php
}
?>