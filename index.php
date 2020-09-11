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
require 'lib/connection.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "\n");
}
?>

<body>
    <h1 style="text-align:center">Publications Management System</h1></br>
    <a href="lib/login_admin.php">
        <p style="text-align:right"> admin login</p>
    </a>
    <a href="lib/login_people.php">
        <p style="text-align:right"> faculty login</p>
    </a>
    <div class="container">

        <!-- Search -->
        <div class="tab-pane" id="add_organisation">
            <form role="form" action="lib/search_result.php" method="get">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label" for="contactChoice3">People: </label>
                    <div class="col-lg-9">
                        <input class="form-control" type="radio" name="show" value="people">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label" for="contactChoice3">Publications: </label>
                    <div class="col-lg-9">
                        <input class="form-control" type="radio" name="show" value="publication">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label" for="contactChoice3">Projects: </label>
                    <div class="col-lg-9">
                        <input class="form-control" type="radio" name="show" value="project">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label ">Select Department: </label>
                    <div class="col-md-9">
                        <select class="js-example-basic-multiple form-control" name="dept[]" multiple="multiple" onChange="getTags();" id="dept-select" multiple>
                            <?php
                            $sql_dept = "SELECT * FROM departments";
                            $result_dept = $conn->query($sql_dept);

                            if ($result_dept) {
                                while ($row = $result_dept->fetch_assoc()) {
                                    $id = $row["dept_id"];
                                    $name = $row["name"];
                                    echo "<option value = $id>$name</option>";
                                }
                            }
                            ?>
                        </select>
                        <input type="checkbox" id="dept-list-select-all">Select All
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label ">Select Tags: </label>
                    <div class="col-md-9">
                        <select class="js-example-basic-multiple form-control" name="tags[]" multiple="multiple" id="tag-list">
                        </select>
                        <input type="checkbox" id="tag-list-select-all">Select All
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Enter Start Date: </label>
                    <div class="col-lg-9">
                        <input class="form-control" type="date" name="start_date">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label">Enter End Date: </label>
                    <div class="col-lg-9">
                        <input class="form-control" type="date" name="end_date">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label form-control-label"></label>
                    <div class="col-lg-9">
                        <input type="submit" class="btn btn-primary" value="Search!">
                    </div>
                </div>
            </form>
        </div>

        <p>
            <b style="color:red;">This is Tag based search!</b><br>
            <b>start date and end date is used for showing project starting date range and publication publishing date range</b><br>
            For seeing all publications from a department select publications option, select your department, select all tags option and search <br>
            For seeing all the projects from IIT Patna select all departments and select all tags and search<br>
        </p>
    </div>

    <script>
        $("#tag-list-select-all").click(function() {
            if ($("#tag-list-select-all").is(':checked')) {
                $("#tag-list > option").prop("selected", "selected");
                $("#tag-list").trigger("change");
            } else {
                $("#tag-list > option").removeAttr("selected");
                $("#tag-list").trigger("change");
            }
        });

        $("#dept-list-select-all").click(function() {
            if ($("#dept-list-select-all").is(':checked')) {
                $("#dept-select > option").prop("selected", "selected");
                $("#dept-select").trigger("change");
            } else {
                $("#dept-select > option").removeAttr("selected");
                $("#dept-select").trigger("change");
            }
        });

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        function getTags() {
            var str = '';
            var val = document.getElementById('dept-select');
            for (i = 0; i < val.length; i++) {
                if (val[i].selected) {
                    str += val[i].value + ',';
                }
            }
            var str = str.slice(0, str.length - 1);

            $.ajax({
                type: "POST",
                url: "lib/get_tags.php",
                data: 'dept=' + str,
                success: function(data) {
                    $("#tag-list").html(data);
                }
            });
        }
    </script>
</body>