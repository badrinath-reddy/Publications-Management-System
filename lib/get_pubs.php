<!DOCTYPE html>
<html>

<body>

    <?php
    $people = $_POST['people'];

    require 'connection.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . "\n");
    }
    $sql_pub = "select * from publications,written_by,has_tags_pub where publications.publication_id=written_by.publication_id and publications.publication_id=has_tags_pub.publication_id and people_id in ($people)";
    $result_pub = $conn->query($sql_pub);
    $output = '';
    if ($result_pub) {
        $output .= '
      <div class="row">
      <div class="col-12 col-sm-8 col-lg-10">
           <h3 class="text-muted"> All Publications(journal and conferences) in which the above people are involved</h3> 
          <ul class="list-group">
     ';
        while ($row = $result_pub->fetch_assoc()) {
            $output .= '
            <a href="' . $row["link"] . '" style="margin: 0.5rem;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div class="flex-column">
                  <h5><b>' . $row["name"] . '</b></h5>
                  <p>
                  
                  ' . $row["p_year"] . ' month ' . $row["p_month"] . '
                  <p>' . $row["link"] . '</p>
                  </p>
                </div>
            </a>
            ';
        }
        $output .= '
        </ul>
        </div>
       </div>
        ';
        echo "$output";
    }
    $conn->close();
    ?>
</body>

</html>