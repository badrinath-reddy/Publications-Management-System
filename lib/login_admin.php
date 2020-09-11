<?php
include('login_a.php'); // Includes Login Script
if (isset($_SESSION['login_admin'])) {
    header("location: ../admin.php"); // Redirecting To Profile Page
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Form in PHP with Session</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="login">
        <h2>Admin Login Form</h2>
        <form action="" method="post">
            <label>UserName :</label>
            <input id="name" name="username" placeholder="username" type="text">
            <label>Password :</label>
            <input id="password" name="password" placeholder="**********" type="password"><br><br>
            <input name="submit" type="submit" value=" Login ">

            <span><?php echo $error; ?></span>
        </form>
    </div>
</body>

</html>