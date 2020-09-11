<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "pms");
if ($_SESSION['login_user'] == null) {
    header('Location: index.php');
    exit();
}

?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <style type="text/css">
        body {
            padding: 5rem 0rem;
        }

        .hell {
            margin: 0.5rem;
        }

        form {
            display: none;
        }
    </style>
</head>
<?php

$people_id = $_SESSION['login_user'];
require 'lib/connection.php';
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

<body>
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
                    <li class="nav-item">
                        <a href="" data-target="#add_publication" data-toggle="tab" class="nav-link">Add Publication</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#add_project" data-toggle="tab" class="nav-link">Add Project</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#edit_organisation" data-toggle="tab" class="nav-link" onclick="edit_org()">Edit Organisation</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#delete_publication" data-toggle="tab" class="nav-link" onclick="delete_pub()">Delete Publication</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#delete_project" data-toggle="tab" class="nav-link" onclick="delete_proj()">Delete Project</a>
                    </li>
                    <li class="nav-item">
                        <a href="lib/logout.php" class="nav-link">Logout</a>
                    </li>
                </ul>


                <div class="tab-content py-4">


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
                                    while ($row1 = $result3->fetch_assoc()) {
                                        echo $row1["name"];
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


                    <!-- Add Publication -->
                    <div class="tab-pane" id="add_publication">
                        <!-- <form role="form"  method="get" > -->
                        <p>If you select the people then the publications(both journal and conference) related to them is displayed,if the desired publication is not present in the list then add the corresponding journal or conference by clicking the button bellow</p>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label ">Select People: </label>
                            <div class="col-md-9">
                                <select class="js-example-basic-multiple form-control" name="people[]" style="width: 100% ;" multiple="multiple" onChange="getpub();" id="people-select" multiple>
                                    <?php
                                    $sql_people = "SELECT people_id,name FROM people";
                                    $result_people = $conn->query($sql_people);

                                    if ($result_people) {
                                        while ($row = $result_people->fetch_assoc()) {
                                            $id = $row["people_id"];
                                            $name = $row["name"];
                                            echo "<option value = $id>$name</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <!-- <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label ">Publications invloving the selected faculty</label>
                        <div class="col-md-9"> 
                            <select class="js-example-basic-multiple form-control" name = "pub[]" style="width: 100% ;" multiple="multiple" id = "pub-list">
                            </select>
                        </div>
                    </div> -->


                        <div id="pub-list">

                        </div>

                        <button class="btn btn-info " type="submit" onclick="add_jour()">Click here to add the Journal</button>
                        <button class="btn btn-info " type="submit" onclick="add_con()">Click here to add the Conference</button>
                        <!-- <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label" for="contactChoice3">Journal</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="radio"  name="show" value="publication">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label" for="contactChoice3">conference </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="radio" name="show" value="project">
                        </div>
                    </div> -->

                        <!-- <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-9">
                            <input type="submit" class="btn btn-primary" value="Search!">
                        </div>
                    </div>  -->
                        <!-- </form> -->
                        <!-- form to insert the journal  
-------------------------------------------------- form to insert the journal  
-------------------------------------------------- form to insert the journal  
-------------------------------------------------- form to insert the journal  
-------------------------------------------------- form to insert the journal  
-->
                        <form role="form" action="add_journal.php" method="get" id="add_journal" display=>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label ">Select People : </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple form-control" name="select_people[]" style="width: 100% ;" multiple="multiple">
                                        <?php
                                        // $conn=mysqli_connect("localhost", "root", "", "pms");
                                        $ins = "select people_id,name from people";
                                        $result = $conn->query($ins);
                                        ?>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row["people_id"];
                                            $name = $row["name"]; ?>
                                            <option value=<?php echo $id; ?>><?php echo $name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">title </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="title" id="start_dateid" placeholder="Title" title="enter your paper's title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">journal name </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="j_name" id="start_dateid" placeholder="JournalName" title="enter your paper's journalName">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Year(xxxx) </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="p_year" id="start_dateid" placeholder="YYYY" title="enter your paper's year">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">month(xx) </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="p_month" id="start_dateid" placeholder="MM" title="enter your papers month">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">page range </label>
                                <div class="col-lg-9">
                                    <input class="form-control " type="text" name="p_range">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">DOI</label>
                                <div class="col-lg-9">
                                    <input class="form-control " type="text" name="doi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Link to the journal paper</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="link">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Volume </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="number" name="volume">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">issue no </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="number" name="issue">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label ">Select tags: </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple form-control" style="width: 100% ;" name="tag[]" multiple="multiple" id="tag-select" multiple>
                                        <?php
                                        $sql_dept = "SELECT * FROM hashtags";
                                        $result_dept = $conn->query($sql_dept);

                                        if ($result_dept) {
                                            while ($row = $result_dept->fetch_assoc()) {
                                                $id = $row["tag_id"];
                                                $name = $row["tag"];
                                                echo "<option value = $id>$name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="Reset">
                                    <input type="submit" class="btn btn-primary" value="Create">
                                </div>
                            </div>
                        </form>
                        <!-- 
Journal form finish-------------------------------
Journal form finish-------------------------------
Journal form finish-------------------------------
 -->


                        <!-- form to insert the conference  
-------------------------------------------------- form to insert the conferedcnc  
-------------------------------------------------- form to insert the con  
-------------------------------------------------- form to insert the con  
-------------------------------------------------- form to insert the con  
-->
                        <form role="form" action="add_conference.php" method="get" id="add_conference">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label ">Select People : </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple form-control" name="select_people[]" style="width: 100% ;" multiple="multiple">
                                        <?php
                                        // $conn=mysqli_connect("localhost", "root", "", "pms");
                                        $ins = "select people_id,name from people";
                                        $result = $conn->query($ins);
                                        ?>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row["people_id"];
                                            $name = $row["name"]; ?>
                                            <option value=<?php echo $id; ?>><?php echo $name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">title </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="title" id="start_dateid" placeholder="title" title="enter the title ">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">conference name </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="c_name" id="start_dateid" placeholder="conference name" title="enter your conference name ">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Year(xxxx) </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="p_year" id="start_dateid" placeholder="YYYY" title="enter the year">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">month(xx) </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="p_month" id="start_dateid" placeholder="MM" title="enter the month">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">page range </label>
                                <div class="col-lg-9">
                                    <input class="form-control " type="text" name="p_range">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">DOI</label>
                                <div class="col-lg-9">
                                    <input class="form-control " type="text" name="doi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Link to the conference paper</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="link">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">place </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="place">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label ">Select tags: </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple form-control" style="width: 100% ;" name="tag[]" multiple="multiple" id="tag-select-conf" multiple>
                                        <?php
                                        $sql_dept = "SELECT * FROM hashtags";
                                        $result_dept = $conn->query($sql_dept);

                                        if ($result_dept) {
                                            while ($row = $result_dept->fetch_assoc()) {
                                                $id = $row["tag_id"];
                                                $name = $row["tag"];
                                                echo "<option value = $id>$name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="Reset">
                                    <input type="submit" class="btn btn-primary" value="Create">
                                </div>
                            </div>
                        </form>
                        <!-- 
conefrenc form finish-------------------------------
conference form finish-------------------------------
conference form finish-------------------------------
 -->


                    </div>


                    <!-- Add Project -->
                    <div class="tab-pane" id="add_project">

                        <p>If you select the people then the projects related to them is displayed,if the desired project is not present in the list then add the project by clicking the button bellow</p>
                        <!-- <form role="form" action="add_project.php" method="get" > -->
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label ">Select People: </label>
                            <div class="col-md-9">
                                <select class="js-example-basic-multiple form-control" name="people_pro[]" style="width: 100% ;" multiple="multiple" onChange="getpro();" id="people-select-pro" multiple>
                                    <?php
                                    $sql_people = "SELECT people_id,name FROM people";
                                    $result_people = $conn->query($sql_people);

                                    if ($result_people) {
                                        while ($row = $result_people->fetch_assoc()) {
                                            $id = $row["people_id"];
                                            $name = $row["name"];
                                            echo "<option value = $id>$name</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="pro-list">

                        </div>

                        <button class="btn btn-info " type="submit" onclick="add_pro()"> click here to add the project</button>
                        <!-- <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label ">Publications invloving the selected faculty</label>
                        <div class="col-md-9"> 
                            <select class="js-example-basic-multiple form-control" name = "pro[]" style="width: 100% ;" multiple="multiple" id = "pro-list">
                            </select>
                        </div>
                    </div> -->


                        <!-- <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label" for="contactChoice3">Journal</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="radio"  name="show" value="publication">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label" for="contactChoice3">conference </label>
                        <div class="col-lg-9">
                            <input class="form-control" type="radio" name="show" value="project">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-9">
                            <input type="submit" class="btn btn-primary" value="Search!">
                        </div>
                    </div>  -->
                        <!-- </form> -->
                        <!-- form to insert the journal  
-------------------------------------------------- form to insert the journal  
-------------------------------------------------- form to insert the journal  
-------------------------------------------------- form to insert the journal  
-------------------------------------------------- form to insert the journal  
-->
                        <form role="form" action="add_project.php" method="get" id="add_projec">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label ">Select People : </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple form-control" name="select_people[]" style="width: 100% ;" multiple="multiple">
                                        <?php



                                        // $conn=mysqli_connect("localhost", "root", "", "pms");
                                        $ins = "select people_id,name from people";
                                        $result = $conn->query($ins);
                                        ?>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row["people_id"];
                                            $name = $row["name"]; ?>
                                            <option value=<?php echo $id; ?>><?php echo $name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">title </label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="title" id="start_dateid" placeholder="Title" title="enter your project's title">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Start_date </label>
                                <div class="col-lg-9">
                                    <input type="date" class="form-control" name="start_date" id="start_dateid" title="enter your project's start date">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Link to the journal paper</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="link">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Duration </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="number" step="0.01" name="duration">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Cost </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="number" step="0.01" name="cost">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label ">Select tags : </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple form-control" style="width: 100% ;" name="tag[]" multiple="multiple" id="tag-select-pro" multiple>
                                        <?php
                                        $sql_dept = "SELECT * FROM hashtags";
                                        $result_dept = $conn->query($sql_dept);

                                        if ($result_dept) {
                                            while ($row = $result_dept->fetch_assoc()) {
                                                $id = $row["tag_id"];
                                                $name = $row["tag"];
                                                echo "<option value = $id>$name</option>";
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label ">sponsored by : </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple form-control" style="width: 100% ;" name="organisation[]" multiple="multiple" id="organisation-select" multiple>
                                        <?php
                                        $sql_dept = "SELECT * FROM organisations";
                                        $result_dept = $conn->query($sql_dept);

                                        if ($result_dept) {
                                            while ($row = $result_dept->fetch_assoc()) {
                                                $id = $row["organisation_id"];
                                                $name = $row["name"];
                                                echo "<option value = $id>$name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label "> Consortina Partners: </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple form-control" style="width: 100% ;" name="org[]" multiple="multiple" id="organisation-se" multiple>
                                        <?php
                                        $sql_dept = "SELECT * FROM organisations";
                                        $result_dept = $conn->query($sql_dept);

                                        if ($result_dept) {
                                            while ($row = $result_dept->fetch_assoc()) {
                                                $id = $row["organisation_id"];
                                                $name = $row["name"];
                                                echo "<option value = $id>$name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Status(is completed) </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="radio" id="contactChoice3" name="status" value="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="Reset">
                                    <input type="submit" class="btn btn-primary" value="Create">
                                </div>
                            </div>
                        </form>
                        <!-- 
Journal form finish-------------------------------
Journal form finish-------------------------------
Journal form finish-------------------------------
 -->

                    </div>


                    <!-- add Organisation -->
                    <div class="tab-pane" id="edit_organisation">
                        <form role="form" action="profile_edit_org.php" method="get" id="edit_or">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label ">Select Organisation to Add: </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple form-control" style="width: 100% ;" name="orga[]" multiple="multiple" id="organisation-edit-select" multiple>
                                        <?php
                                        $sql_dept = "SELECT * FROM organisations";
                                        $result_dept = $conn->query($sql_dept);

                                        if ($result_dept) {
                                            while ($row = $result_dept->fetch_assoc()) {
                                                $id = $row["organisation_id"];
                                                $name = $row["name"];
                                                echo "<option value = $id>$name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="submit" class="btn btn-primary" value="Save Changes">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- delete Publication -->
                    <div class="tab-pane" id="delete_publication">
                        <form role="form" action="profile_delete_pub.php" method="get" id="delete_publicatio">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label ">Select Publication to Delete: </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple form-control" style="width: 100% ;" name="pub_del" id="pub-select">
                                        <?php
                                        $sql_dept = "SELECT * FROM publications";
                                        $result_dept = $conn->query($sql_dept);

                                        if ($result_dept) {
                                            while ($row = $result_dept->fetch_assoc()) {
                                                $id = $row["publication_id"];
                                                $name = $row["name"];
                                                echo "<option value = $id>$name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="submit" class="btn btn-primary" value="delete publication">
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- delete Project -->
                    <div class="tab-pane" id="delete_project">
                        <form role="form" action="profile_delete_pro.php" method="get" id="delet_projec">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label ">Select Project to Delete: </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple form-control" style="width: 100% ;" name="pro_del" id="project-select">
                                        <?php
                                        $sql_dept = "SELECT * FROM projects";
                                        $result_dept = $conn->query($sql_dept);

                                        if ($result_dept) {
                                            while ($row = $result_dept->fetch_assoc()) {
                                                $id = $row["project_id"];
                                                $name = $row["name"];
                                                echo "<option value = $id>$name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="submit" class="btn btn-primary" value="delete project">
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        function getpub() {
            var str = '';
            var val = document.getElementById('people-select');
            for (i = 0; i < val.length; i++) {
                if (val[i].selected) {
                    str += '\'' + val[i].value + '\'' + ',';
                }
            }
            var str = str.slice(0, str.length - 1);

            $.ajax({
                type: "POST",
                url: "lib/get_pubs.php",
                data: 'people=' + str,
                success: function(data) {
                    $("#pub-list").html(data);
                }
            });
        }

        function getpro() {
            var str = '';
            var val = document.getElementById('people-select-pro');
            for (i = 0; i < val.length; i++) {
                if (val[i].selected) {
                    str += '\'' + val[i].value + '\'' + ',';
                }
            }
            var str = str.slice(0, str.length - 1);

            $.ajax({
                type: "POST",
                url: "lib/get_pros.php",
                data: 'people_pro=' + str,
                success: function(data) {
                    $("#pro-list").html(data);
                }
            });
        }

        function add_pro() {
            var x = document.getElementById("add_projec");

            if (x.style.display == "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }



        }

        function edit_org() {
            var x = document.getElementById("edit_or");

            // if(x.style.display=="block"){
            //     x.style.display="none";
            // }else {
            x.style.display = "block";
            // }

        }

        function delete_pub() {
            var x = document.getElementById("delete_publicatio");

            // if(x.style.display=="block"){
            //     x.style.display="none";
            // }else {
            x.style.display = "block";
            // }

        }

        function delete_proj() {
            var x = document.getElementById("delet_projec");

            // if(x.style.display=="block"){
            //     x.style.display="none";
            // }else {
            x.style.display = "block";
            // }

        }

        function add_con() {
            var x = document.getElementById("add_conference");
            if (x.style.display == "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
                document.getElementById("add_journal").style.display = "none";
            }
        }
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        function add_jour() {
            var x = document.getElementById("add_journal");
            if (x.style.display == "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
                document.getElementById("add_conference").style.display = "none";
                // document.getElementById("projectform").style.display="none";

            }
        }
    </script>
</body>