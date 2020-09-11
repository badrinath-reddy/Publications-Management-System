<?php
require 'lib/connection.php';
$org_name = $_POST['org_name'];

$address = $_POST['address'];
$p = $_POST['p_g'];
$h = $_POST['has_people'];

$ins = "insert into organisations(name,`p_g`,address,`has_people`) values ('$org_name','$p','$address','$h');";

$result = $conn->query($ins);
if ($result) {
?>

    <script>
        alert("inserted organisation");
        window.location = "admin.php";
    </script>
<?php
}
?>