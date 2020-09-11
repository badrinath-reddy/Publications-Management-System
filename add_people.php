<?php
$name = $_POST['p_name'];
$pass = $_POST['pass'];
$new_pass = $_POST['new_pass'];
$org = $_POST['org'];
$dep = $_POST['dept'];
$p_id = $_POST['p_id'];
$is_a = $_POST['is_a'];
$is_f = $_POST['is_f'];

if ($pass != $new_pass) {
?>

    <script>
        alert("both the password fields doenst match");
    </script>
    <?php
} else {
    require 'lib/connection.php';
    $sql = "SELECT * FROM people WHERE people_id='$p_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    ?>

        <script>
            alert("person already present");
            window.location = "admin.php";
        </script>
        <?php

        $result->free();
    } else {
        if ($is_a != 1) {
            $is_a = 0;
        }
        if ($is_f != 1) {
            $is_f = 0;
        }

        $sql1 = "insert into people values('$p_id','$name','$pass',$is_a,$is_f);";
        $result1 = $conn->query($sql1);
        foreach ($org as $o) {
            $sql2 = "insert into affilliated_to values('$p_id',$o);";
            $result2 = $conn->query($sql2);
        }
        foreach ($dep as $d) {
            $sql3 = "insert into belongs_to values('$p_id',$d);";
            $result3 = $conn->query($sql3);
        }
        if ($result1 && $result2 && $result3) {
        ?>

            <script>
                alert("inserted people");
                window.location = "admin.php";
            </script>
<?php
        }
    }
}
?>