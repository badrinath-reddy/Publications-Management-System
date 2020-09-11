<?php

require 'lib/connection.php';
$dept_name = $_POST['dept_name'];
$dept_code = $_POST['dept_code'];
$ins = "insert into departments(name,dept_code) values ('$dept_name','$dept_code');";

$result = $conn->query($ins);
if ($result) {
?>

    <script>
        alert("inserted department");
        window.location = "admin.php";
    </script>
<?php
}
?>