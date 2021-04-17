<!DOCTYPE html>

<link rel="stylesheet" href="styles.css">

<body>

<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="addprofile.php">Add your profile</a></li>
    <li><a href="leaderboard.php">Leaderboard</a></li>
</ul>

<center>
<h1>Your profile will be removed if it is found to be fake, spammy or anything stupid</h1>

<?php
$conn = new mysqli("localhost", "root", "", "ranker");

if (isset($_POST['sm']) && array_key_exists('name', $_POST) && array_key_exists('description', $_POST) && array_key_exists('link', $_POST)) {

    $idNumber = round(rand(1, 1000000));
    $name = $_POST['name'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $ip = $_SERVER['REMOTE_ADDR'];

    if (strpos($name, "'") || strpos($description, "'") || strpos($link, "'") || strpos($ip, "'")) {
        die('no');
    }

    $res = $conn->query("SELECT * FROM rankings WHERE ip = '$ip'")->fetch_assoc();
    if ($res) {
        die('already registered');
    }

    echo $idNumber.' '.$name.' '.$description.' '.$link.' ';

    $conn->query("INSERT INTO rankings (id, dataname, datadesc, score, link, ip) VALUES ($idNumber, '$name', '$description', 0, '$link', '$ip')");

    die('submitted');
    
}
?>

<form action="" method="post">
Name <Br>
<input name="name" type="text"> <br>
Description <br>
<input name="description" type="text"> <br>
Any social media link you own <br>
<input name="link" type="text"> <br><br>

<input name="sm" type="submit" value="submit">
</form>

</center>

</body>