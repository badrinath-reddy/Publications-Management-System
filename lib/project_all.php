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

    if (sizeof($tag) != 0) {
        $sql_q = "SELECT * FROM projects WHERE project_id IN (SELECT project_id FROM has_tags_proj WHERE tag_id IN ($tag))";
        if ($dept != 0) {
            $sql_q .= "AND project_id IN (SELECT project_id FROM done_by WHERE people_id IN (SELECT people_id FROM belongs_to WHERE dept_id IN ($dept)))";
        }
        if ($start_date != NULL) {
            $sql_q .= "AND start_date >= '$start_date'";
        }
        if ($end_date != NULL) {
            $sql_q .= "AND start_date <= '$end_date'";
        }
    } else {
        echo "NO RESULTS";
        return;
    }
    $result = $conn->query($sql_q);
    ?>
    <div class="container">
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
</body>