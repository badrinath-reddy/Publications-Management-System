<?php

require 'lib/connection.php';
echo "<div>";
$tag_name = $_POST['tag_name'];
echo "</div>";

$ins = "insert into hashtags(tag) values ('$tag_name'); ";

$result = $conn->query($ins);
if ($result) {
?>
    <script>
        alert("inserted tag");

        window.location = "admin.php";
    </script>
<?php
}
?>