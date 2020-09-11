<?php

require 'lib/connection.php';
$p_id = $_GET['pro_del'];
$sql1 = "delete from projects where project_id=$p_id;";
$sql2 = "delete from consortina_partners where project_id=$p_id;";
$sql3 = "delete from sponsored_by where project_id=$p_id;";
$sql4 = "delete from has_tags_proj where project_id=$p_id;";
$sql5 = "delete from done_by where project_id=$p_id;";


$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
$result4 = $conn->query($sql4);
$result5 = $conn->query($sql5);
$result1 = $conn->query($sql1);
if ($result1 && $result2 && $result3 && $result4 && $result5) {
?>
    <script>
        alert("deleted project");

        window.location = "admin.php";
    </script>
<?php


}
?>