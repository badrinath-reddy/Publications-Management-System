<?php

require 'lib/connection.php';
$p_id = $_GET['pub_del'];

$sql2 = "delete from written_by where publication_id=$p_id;";
$sql3 = "delete from has_tags_pub where publication_id=$p_id;";
$sql4 = "delete from journal where publication_id=$p_id;";
$sql5 = "delete from conference where publication_id=$p_id;";
$sql1 = "delete from publications where publication_id=$p_id;";

$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
$result4 = $conn->query($sql4);
$result5 = $conn->query($sql5);
$result1 = $conn->query($sql1);

if ($result1 && $result2 && $result3 && $result4 && $result4) {
?>
    <script>
        alert("deleted publication");

        window.location = "profile.php";
    </script>
<?php
}
?>