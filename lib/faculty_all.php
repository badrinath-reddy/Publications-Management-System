<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        body {
            padding: 5rem 0rem;
        }

        .hell {
            margin: 0.5rem;
        }
    </style>
</head>

<body>
    <?php
    require 'connection.php';

    if (isset($_GET['dept'])) {
        $dept = $_GET['dept'];
    } else {
        echo "No Results";
        return;
    }

    $dept = implode(',', $dept);
    $sql_q = "SELECT name, people_id FROM people WHERE is_faculty = 1 AND people_id IN (";
    if (sizeof($dept) != 0) {
        $sql_q .= "SELECT people_id FROM belongs_to WHERE dept_id IN ($dept)";
    }
    $sql_q .= ")";

    if (isset($_GET['tags'])) {
        $tag = $_GET['tags'];
        $tag = implode(',', $tag);
        if (sizeof($tag) != 0) {
            $sql_q .= "AND people_id IN (SELECT people_id FROM written_by WHERE publication_id IN (SELECT publication_id FROM has_tags_pub WHERE tag_id IN ($tag)) UNION SELECT people_id FROM done_by WHERE project_id IN (SELECT project_id FROM has_tags_proj WHERE tag_id IN ($tag)))";
        }
    }

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . "\n");
        return;
    }

    $result = $conn->query($sql_q);
    ?>
    <div class="container">

        <!-- Publications -->
        <div class="tab-pane" id="publications">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-8 col-lg-10">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $name = $row['name'];
                            $url1 = 'profile_all.php?people_id=';
                            $people_id = $row['people_id'];
                            $url1 .= $people_id;
                            echo "<ul class=\"list-group hell\">";
                            echo "<a href=\"$url1\" class=\"list-group-item list-group-item-action d-flex justify-content-between align-items-center\">";
                            echo "<div class=\"flex-column\">";
                            echo "<h5><b>$name</b></h5>";
                            $sql_q2 = "SELECT tag FROM hashtags WHERE tag_id IN (SELECT tag_id from has_tags_pub WHERE publication_id IN (SELECT publication_id FROM written_by WHERE people_id = '$people_id') UNION SELECT tag_id from has_tags_proj WHERE project_id IN (SELECT project_id FROM done_by WHERE people_id = '$people_id'))";
                            $result2 = $conn->query($sql_q2);
                            $sql_q3 = "SELECT name FROM departments WHERE dept_id IN (SELECT dept_id FROM belongs_to WHERE people_id = '$people_id')";
                            $result3 = $conn->query($sql_q3);
                            echo "<p><b>";
                            while ($row = $result3->fetch_assoc()) {
                                echo $row['name'];
                                echo " ";
                            }
                            echo "</p></b>";

                            echo "<span class=\"badge badge-info badge-pill\">";
                            while ($row = $result2->fetch_assoc()) {
                                echo $row['tag'];
                                echo ", ";
                            }
                            echo "</span>";
                            echo "</div>";
                            echo "</a>";
                            echo "</ul>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>