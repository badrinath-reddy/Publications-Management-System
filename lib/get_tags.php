<!DOCTYPE html>
<html>

<body>

    <?php

    $dept = $_POST['dept'];
    require 'connection.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . "\n");
    }
    $sql_tag = "SELECT * FROM hashtags WHERE tag_id IN (SELECT tag_id FROM has_tags_pub WHERE publication_id IN (SELECT publication_id FROM written_by WHERE people_id IN (SELECT people_id FROM belongs_to WHERE dept_id IN ($dept)))) UNION SELECT * FROM hashtags WHERE tag_id IN (SELECT tag_id FROM has_tags_proj WHERE project_id IN (SELECT project_id FROM done_by WHERE people_id IN (SELECT people_id FROM belongs_to WHERE dept_id IN ($dept))))";
    $result_tag = $conn->query($sql_tag);

    if ($result_tag) {
        while ($row = $result_tag->fetch_assoc()) {
            $id = $row["tag_id"];
            $name = $row["tag"];
            echo "<option value = $id>$name</option>";
        }
    }
    $conn->close();
    ?>

</body>

</html>