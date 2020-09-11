<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "pms");
if ($_SESSION['login_admin'] == null) {
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
    <style>
        body {
            padding: 5rem 0rem;
        }

        .hell {
            margin: 0.5rem;
        }
    </style>
</head>

<?php

$admin = $_SESSION['login_admin'];
?><h2>Welcome : <?php echo "$admin"; ?></h2>

<body>
    <?php
    require 'lib/connection.php';
    ?>

    <div class="container">
        <div class="row my-2">
            <div class="col-lg-15 order-lg-2">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#add_people" data-toggle="tab" class="nav-link active">Add People</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#delete_people" data-toggle="tab" class="nav-link">Remove People</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#add_tags" data-toggle="tab" class="nav-link">Add Tags</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#add_organisation" data-toggle="tab" class="nav-link">Add Organisations</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#edit_organisation" data-toggle="tab" class="nav-link">Edit Organisation</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#add_department" data-toggle="tab" class="nav-link">Add Department</a>
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


                    <!-- Add People -->
                    <div class="tab-pane active" id="add_people">
                        <form role="form" action="add_people.php" method="post">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Enter New Faculty ID: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="p_id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Enter Password: </label>
                                <div class="col-lg-9">
                                    <input class="form-control password" type="password" name="pass">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"> Re Enter Password: </label>
                                <div class="col-lg-9">
                                    <input class="form-control password" type="password" name="new_pass">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Enter Name of Faculty: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="p_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Select Organisations: </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple form-control" name="org[]" multiple="multiple">
                                        <?php
                                        $ins = "select organisation_id,name from organisations";
                                        $result = $conn->query($ins);
                                        ?>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row["organisation_id"];
                                            $name = $row["name"]; ?>
                                            <option value=<?php echo $id; ?>><?php echo $name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label ">Select Departments: </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-multiple form-control" name="dept[]" multiple="multiple">
                                        <?php
                                        $ins = "select dept_id,name from departments";
                                        $result = $conn->query($ins);
                                        ?>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row["dept_id"];
                                            $name = $row["name"]; ?>
                                            <option value=<?php echo $id; ?>><?php echo $name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Is Admin: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="radio" id="contactChoice3" name="is_a" value="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Is Faculty: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="radio" id="contactChoice3" name="is_f" value="1">
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
                    </div>



                    <!-- Delete People -->
                    <div class="tab-pane" id="delete_people">
                        <h5 style="color:red;">Removes faculty status</h5><br>
                        <form role="form" action="remove_people.php" method="post">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Enter People ID: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="people_id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="Reset">
                                    <input type="submit" class="btn btn-primary" value="Delete">
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- Add Tags -->
                    <div class="tab-pane" id="add_tags">
                        <p>**please see below tags before filling for avoiding duplicacy</p><br><br>
                        <form role="form" method="post" action="add_tags.php">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Enter Tag to add(<b style="color:red;">Should be unique</b>): </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="tag_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="Reset">
                                    <input type="submit" class="btn btn-primary" value="Add" name="add_tag">
                                </div>
                            </div>
                        </form>
                        <div>
                            <h5>Current tags:</h5>
                        </div>
                    </div>



                    <!-- Add Organisation -->
                    <div class="tab-pane" id="add_organisation">
                        <p>**please see below organisations before filling for avoiding duplicacy</p><br><br>
                        <form role="form" action="add_org.php" method="post">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Enter Name of Organisation: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="org_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Enter Address of Organisation: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="contactChoice3">Is Private: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="radio" id="contactChoice3" name="p_g" value="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="contactChoice3">Is Govt: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="radio" id="contactChoice3" name="p_g" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="contactChoice3">has people: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="radio" id="contactChoice3" name="has_people" value="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="Reset">
                                    <input type="submit" class="btn btn-primary" value="Add" name="add_organisation">
                                </div>
                            </div>
                        </form>
                        <div>
                            <h5>Current Organisations:</h5>
                        </div>
                    </div>


                    <!-- Edit Organisation -->
                    <div class="tab-pane" id="edit_organisation">
                        <form role="form" action="edit_org.php" method="post">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label ">Select Name of Organisation to edit: </label>
                                <div class="col-md-9">
                                    <select class="js-example-basic-single form-control" name="org_name2" style="width:100%;">
                                        <?php
                                        $ins = "select organisation_id,name from organisations";
                                        $result = $conn->query($ins);
                                        ?>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row["organisation_id"];
                                            $name = $row["name"]; ?>
                                            <option value=<?php echo $id; ?>><?php echo $name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Enter Address of Organisation: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="contactChoice3">Is Private: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="radio" id="contactChoice3" name="p_g" value="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="contactChoice3">Is Govt: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="radio" id="contactChoice3" name="p_g" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="contactChoice3">has people: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="radio" id="contactChoice3" name="has_people" value="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="Reset">
                                    <input type="submit" class="btn btn-primary" value="Save Changes">
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- Add Departments -->
                    <div class="tab-pane" id="add_department">
                        <p>**please see below departments before filling for avoiding duplicacy</p><br><br>
                        <form role="form" action="add_dept.php" method="post">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Enter Name of Department: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="dept_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Department Code(<b style="color:red;">Should be unique</b>): </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="dept_code">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="Reset">
                                    <input type="submit" class="btn btn-primary" value="Add">
                                </div>
                            </div>
                        </form>
                        <div>
                            <h5>Current Departments:</h5>
                        </div>
                    </div>

                    <!-- delete Publication -->
                    <div class="tab-pane" id="delete_publication">
                        <form role="form" action="admin_delete_pub.php" method="get" id="delete_publicatio">
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
                        <form role="form" action="admin_delete_pro.php" method="get" id="delet_projec">
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
    </script>
</body>