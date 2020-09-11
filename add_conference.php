<?php
$people = $_GET['select_people'];
$p_year = $_GET['p_year'];
$p_month = $_GET['p_month'];
$dep = $_GET['dept'];
$p_range = $_GET['p_range'];
$doi = $_GET['doi'];
$link = $_GET['link'];
$place = $_GET['place'];
$c_name = $_GET['c_name'];
$title = $_GET['title'];
$tag = $_GET['tag'];

require 'lib/connection.php';

$sql1 = "INSERT INTO publications (name,p_year,`p_month`,page_range,doi,link) VALUES('$title','$p_year','$p_month','$p_range','$doi','$link');";
$result1 = $conn->query($sql1);
$sql4 = "select publication_id from publications where name= '$title'";
$result4 = $conn->query($sql4);
$row = $result4->fetch_assoc();
$p_id = $row['publication_id'];
$sql2 = "INSERT INTO conference VALUES($p_id,'$c_name','$place');";
$result2 = $conn->query($sql2);

$level = 1;
foreach ($people as $p) {
    $sql3 = "insert into written_by values($p_id,'$p',$level);";
    $result3 = $conn->query($sql3);
}
foreach ($tag as $t) {
    $sql5 = "insert into has_tags_pub values($t,$p_id);";
    $result5 = $conn->query($sql5);
}
if ($result1 && $result2 && $result3 && $result5) {
?>
    <script>
        alert("inserted conference");
        window.location = "profile.php";
    </script>
<?php
}
?>