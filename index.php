<!DOCTYPE html>

<link rel="stylesheet" href="styles.css">

<body>
<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="addprofile.php">Add your profile</a></li>
    <li><a href="leaderboard.php">Leaderboard</a></li>
</ul>

<center><br>

<?php


$conn = new mysqli("localhost", "root", "", "ranker");



if (isset($_POST['sm']) && array_key_exists('selection', $_POST)) {

    $sel = $_POST['selection'];
    $conn->query("UPDATE rankings SET score = score + 1 WHERE id = $sel");

    $res = $conn->query("SELECT * FROM rankings WHERE id = $sel");

    $data = $res->fetch_assoc();
    
    echo '<table><tr><th>Selected</th></tr><tr><td>'. htmlspecialchars($data['dataname']) . '<br>' . htmlspecialchars($data['datadesc']) . '<br><a href="' . htmlspecialchars($data['link']) . '">' . htmlspecialchars($data['link']) . '</a>' .'</td></tr></table><BR>';

    die('<a href="index.php"><button>next</button></a>');
    
}

$sql = "SELECT * FROM rankings ORDER BY RAND() LIMIT 1";
$results = $conn->query($sql);
$results2 = $conn->query($sql);

$personA = $results->fetch_assoc();
$personB = $results2->fetch_assoc();

while ($personA === $personB || $personA['ip'] == $_SERVER["REMOTE_ADDR"] || $personB['ip'] == $_SERVER["REMOTE_ADDR"]) {
    $personA = $conn->query($sql)->fetch_assoc();
    $personB = $conn->query($sql)->fetch_assoc();
}

// while($row = $results->fetch_assoc()) {
//     echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
// }

// var_dump($personA);
// var_dump($personB);
?>








<table>

<tr>
<th>Person A</th>
<th>Person B</th>
</tr>

<tr>
<td class="withpadding"> <?php echo $personA["datadesc"] ?> </td>
<td class="withpadding"> <?php echo $personB["datadesc"] ?> </td>

</tr>

</table>

<form action="" method="post">
<input type="radio" name="selection" value=<?php echo $personA['id'] ?>>A
<input type="radio" name="selection" value=<?php echo $personB['id'] ?>>B <br>
<input type="submit" name="sm" value="Next">
</form>

</center>

</body>