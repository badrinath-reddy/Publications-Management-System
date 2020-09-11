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
    $dept = $_GET['dept'];
    $tag = $_GET['tags'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    $dept = implode(',', $dept);
    $tag = implode(',', $tag);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . "\n");
    }

    $sql_q = "SELECT * FROM publications WHERE publication_id IN (";
    if (sizeof($tag) != 0) {

        $sql_q .= "SELECT publication_id FROM has_tags_pub WHERE tag_id IN ($tag)";
        if (sizeof($dept) != 0) {
            $sql_q .= "AND publication_id IN (SELECT publication_id FROM written_by WHERE people_id IN (SELECT people_id FROM belongs_to WHERE dept_id IN ($dept)))";
        }
        if ($start_date != NULL) {
            $sql_q .= "AND p_year >= year('$start_date')";
        }
        if ($end_date != NULL) {
            $sql_q .= "AND p_year <= year('$end_date')";
        }
    } else {
        echo "No Results";
    }
    $sql_q .= ")";
    $result = $conn->query($sql_q);
    ?>
    <div class="container">

        <!-- Publications -->
        <div class="tab-pane" id="publications">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-8 col-lg-10">
                        <h6 class="text-muted">Conference Publications:</h6>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $name = $row['name'];
                            $id = $row['publication_id'];
                            $sql_c = "SELECT * FROM conference WHERE publication_id = $id";
                            $result_c = $conn->query($sql_c);
                            if ($result_c->num_rows == 0) {
                                continue;
                            }
                            $result_c = $result_c->fetch_assoc();
                            $sql_t = "SELECT tag FROM hashtags WHERE tag_id IN (SELECT tag_id FROM has_tags_pub WHERE publication_id = $id)";
                            $result_t = $conn->query($sql_t);
                            $sql_a = "SELECT name FROM people WHERE people_id IN (SELECT people_id FROM written_by WHERE publication_id = $id)";
                            $result_a = $conn->query($sql_a);
                            echo "<ul class=\"list-group hell\">";
                            echo "<a href=\"#\" class=\"list-group-item list-group-item-action d-flex justify-content-between align-items-center\">";
                            echo "<div class=\"flex-column\">";
                            echo  "<h5><b>$name</b></h5>";
                            echo  "<p><b>";
                            while ($row1 = $result_a->fetch_assoc()) {
                                echo $row1['name'];
                                echo ", ";
                            }
                            echo "</b><i>";
                            echo $result_c['name'];
                            echo ", ";
                            echo $result_c['place'];
                            echo ", ";
                            echo $row['p_year'];
                            echo ", pp. ";
                            echo $row['page_range'];
                            echo "</i></p>";
                            echo "<span class = \"badge badge-info badge-pill\">";
                            while ($row = $result_t->fetch_assoc()) {
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
                <br><br>
            </div>
        </div>
        <div class="tab-pane" id="publications">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-8 col-lg-10">
                        <h6 class="text-muted">Journal Publications:</h6>
                        <?php
                        $result = $conn->query($sql_q);
                        while ($row = $result->fetch_assoc()) {
                            $name = $row['name'];
                            $id = $row['publication_id'];
                            $sql_j = "SELECT * FROM journal WHERE publication_id = $id";
                            $result_j = $conn->query($sql_j);
                            if ($result_j->num_rows == 0) {
                                continue;
                            }
                            $result_j = $result_j->fetch_assoc();
                            $sql_t = "SELECT tag FROM hashtags WHERE tag_id IN (SELECT tag_id FROM has_tags_pub WHERE publication_id = $id)";
                            $result_t = $conn->query($sql_t);
                            $sql_a = "SELECT name FROM people WHERE people_id IN (SELECT people_id FROM written_by WHERE publication_id = $id)";
                            $result_a = $conn->query($sql_a);
                            echo "<ul class=\"list-group hell\">";
                            echo "<a href=\"#\" class=\"list-group-item list-group-item-action d-flex justify-content-between align-items-center\">";
                            echo "<div class=\"flex-column\">";
                            echo  "<h5><b>$name</b></h5>";
                            echo  "<p><b>";
                            while ($row1 = $result_a->fetch_assoc()) {
                                echo $row1['name'];
                                echo ", ";
                            }
                            echo "</b><i>";
                            echo $result_j['name'];
                            echo ", issue: ";
                            echo $result_j['issue_no'];
                            echo ", vol: ";
                            echo $result_j['volume'];
                            echo ", ";
                            echo $row['p_year'];
                            echo ", pp. ";
                            echo $row['page_range'];
                            echo "</i></p>";
                            echo "<span class = \"badge badge-info badge-pill\">";
                            while ($row = $result_t->fetch_assoc()) {
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
                <br><br>
            </div>
        </div>
    </div>
</body>