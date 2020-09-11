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
    $people_id = $_GET['people_id'];
    require 'connection.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . "\n");
    }

    $sql_q1 = "SELECT * FROM people WHERE people_id = '$people_id'";
    $result1 = $conn->query($sql_q1);
    $result1 = $result1->fetch_assoc();
    $sql_q2 = "SELECT name FROM departments WHERE dept_id IN (SELECT dept_id FROM belongs_to WHERE people_id = '$people_id')";
    $result2 = $conn->query($sql_q2);
    $sql_q3 = "SELECT name FROM organisations WHERE organisation_id IN (SELECT organisation_id FROM affilliated_to WHERE people_id = '$people_id')";
    $result3 = $conn->query($sql_q3);
    $sql_q4 = "SELECT tag FROM hashtags WHERE tag_id IN (SELECT tag_id from has_tags_pub WHERE publication_id IN (SELECT publication_id FROM written_by WHERE people_id = '$people_id') UNION SELECT tag_id from has_tags_proj WHERE project_id IN (SELECT project_id FROM done_by WHERE people_id = '$people_id'))";
    $result4 = $conn->query($sql_q4);
    ?>
    <div class="container">
        <div class="row my-2">
            <div class="col-lg-15 order-lg-2">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#publications" data-toggle="tab" class="nav-link">Publications</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#projects" data-toggle="tab" class="nav-link">Projects</a>
                    </li>
                </ul>


                <div class="tab-content py-4">

                    <?php

                    ?>
                    <!-- Main Profile -->
                    <div class="tab-pane active" id="profile">
                        <h4 class="mb-3"><b><?php echo $result1['name']; ?></b></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <h6><b>Departments:</b></h6>
                                <p><?php
                                    while ($row = $result2->fetch_assoc()) {
                                        echo $row["name"];
                                        echo " ";
                                    }
                                    ?></p>
                                <h6><b>Organisations:</b></h6>
                                <p><?php
                                    while ($row = $result3->fetch_assoc()) {
                                        echo $row["name"];
                                        echo " ";
                                    }
                                    ?></p>
                            </div>
                            <div class="col-md-6">
                                <h6>Tags</h6>
                                <?php
                                while ($row = $result4->fetch_assoc()) {
                                    $tag = $row['tag'];
                                    echo "<a href=\"#\" class=\"badge badge-dark badge-pill\">$tag</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>


                    <!-- Publications -->
                    <div class="tab-pane" id="publications">
                        <div class="container">

                            <!-- Publications -->
                            <div class="tab-pane" id="publications">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 col-sm-8 col-lg-10">
                                            <h6 class="text-muted">Conference Publications:</h6>
                                            <?php

                                            $sql_r = "SELECT * FROM publications WHERE publication_id IN (SELECT publication_id from written_by WHERE people_id = '$people_id')";
                                            $result = $conn->query($sql_r);
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
                                                //echo "</b><i>Proceedings of the Thirty-second Conference on Neural Informatio Processing Systems (NeurIPS-18), Montreal, QC (2018), pp. 9971-9981</i></p>";
                                                //echo "<span class = \"badge badge-info badge-pill\">";
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
                                            $result = $conn->query($sql_r);
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
                    </div>
                    <!-- Projects -->
                    <div class="tab-pane" id="projects">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Project Title</th>
                                    <th scope="col">People</th>
                                    <th scope="col">Cost(IN LAKHS)</th>
                                    <th scope="col">Sponsor</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tags</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM projects WHERE project_id IN (SELECT project_id FROM done_by WHERE people_id = '$people_id')";
                                $result = $conn->query($sql);
                                $num = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $num++;
                                    $name = $row['name'];
                                    $date = $row['start_date'];
                                    $id = $row['project_id'];
                                    $cost = $row['cost'];
                                    $status = $row['status'];
                                    $sql_d = "SELECT name FROM people WHERE people_id IN (SELECT people_id FROM done_by WHERE project_id = $id)";
                                    $result_d = $conn->query($sql_d);
                                    $sql_e = "SELECT name FROM organisations WHERE organisation_id IN (SELECT organisation_id FROM sponsored_by WHERE project_id = $id)";
                                    $result_e = $conn->query($sql_e);
                                    $sql_t = "SELECT tag FROM hashtags WHERE tag_id IN (SELECT tag_id FROM has_tags_proj WHERE project_id = $id)";
                                    $result_t = $conn->query($sql_t);
                                    echo "<tr><th scope=\"row\">$num</th>";
                                    echo "<td>$name</td>";
                                    echo "<td>";
                                    while ($row1 = $result_d->fetch_assoc()) {
                                        $name = $row1['name'];
                                        echo $name;
                                        echo ", ";
                                    }
                                    echo "<td>$cost</td>";
                                    echo "</td>";
                                    echo "<td>";
                                    while ($row2 = $result_e->fetch_assoc()) {
                                        $name = $row2['name'];
                                        echo $name;
                                        echo ", ";
                                    }
                                    echo "</td>";
                                    echo "<td>$date</td>";
                                    if ($status == 1) {
                                        echo "<td>Completed</td>";
                                    } else {
                                        echo "<td>Ongoing</td>";
                                    }
                                    echo "<td><span class = \"badge badge-info badge-pill\">";
                                    while ($row3 = $result_t->fetch_assoc()) {
                                        echo $row3['tag'];
                                        echo ", ";
                                    }
                                    echo "</span></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</body>