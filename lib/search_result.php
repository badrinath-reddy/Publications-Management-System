<!DOCTYPE html>
<html>

<body>

    <?php
    $show = $_GET['show'];
    $dept = $_GET['dept'];
    $tag = $_GET['tags'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    $url = 'Location: ';
    if ($show == 'people') {
        $url .= 'faculty_all.php';
    } else if ($show == 'publication') {
        $url .= 'publications_all.php';
    } else {
        $url .= 'project_all.php';
    }

    $url .= '?';
    foreach ($dept as $d) {
        $url .= 'dept[]=';
        $url .= $d;
        $url .= '&';
    }
    foreach ($tag as $t) {
        $url .= 'tags[]=';
        $url .= $t;
        $url .= '&';
    }
    $url .= 'start_date=';
    $url .= $start_date;
    $url .= '&';
    $url .= 'end_date=';
    $url .= $end_date;

    redirect($url);
    function redirect($url)
    {
        header($url);
        exit();
    }
    ?>
</body>

</html>