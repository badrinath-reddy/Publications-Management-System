<?php
$people = $_GET['select_people'];
$start_date = $_GET['start_date'];
$status = $_GET['status'];
$link = $_GET['link'];
$duration = $_GET['duration'];
$cost = $_GET['cost'];
$title = $_GET['title'];
$tag = $_GET['tag'];
$organisation = $_GET['organisation'];
$org = $_GET['org'];
require 'lib/connection.php';
str_replace('/', '-', $start_date);
if ($status != 1) {
    $status = 0;
}
$sql1 = "INSERT INTO projects (name,`duration`,start_date,`status`,`cost`,link) VALUES('$title','$duration','$start_date','$status','$cost','$link');";
$result1 = $conn->query($sql1);
$sql4 = "select project_id from projects where name= '$title'";
$result4 = $conn->query($sql4);
$row = $result4->fetch_assoc();
$p_id = $row['project_id'];
foreach ($org as $or) {
    $sql7 = "insert into consortina_partners values($p_id,$or);";
    $result7 = $conn->query($sql7);
}
$level = 1;
foreach ($people as $p) {
    $sql3 = "insert into done_by values($p_id,'$p',$level);";
    $result3 = $conn->query($sql3);
}
$amount = $cost / sizeof($organisation);
foreach ($organisation as $o) {
    $sql6 = "insert into sponsored_by values($p_id,$o,$amount);";
    $result6 = $conn->query($sql6);
}
foreach ($tag as $t) {
    $sql5 = "insert into has_tags_proj values($t,$p_id);";
    $result5 = $conn->query($sql5);
}
if ($result1 && $result3 && $result5 && $result6 && $result7) {
?>

    <script>
        alert("inserted project");
        window.location = "profile.php";
    </script>
<?php
}
?>