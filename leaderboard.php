<!DOCTYPE html>

<link rel="stylesheet" href="styles.css">

<body>
<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="addprofile.php">Add your profile</a></li>
    <li><a href="leaderboard.php">Leaderboard</a></li>
</ul>

<center>
<table>

  <tr>
    <th>#</th>
    <th>Username</th>
    <th>Score</th>
  </tr>

  <?php
    // yes this is uwubot code shut up
    $conn = new mysqli("localhost", "root", "", "ranker");

    if ($conn->connect_error) {
        die('mysql connection failed');
    }



    $sql = "SELECT * FROM rankings ORDER BY score DESC";
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
  $rank = 0;
    while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["userId"]. " - xp: " . $row["xpCount"]. " - level:" . $row["level"]. "<br>";
        ++$rank;
        echo "<tr><td>". $rank . "</td><td>" . htmlspecialchars($row["dataname"]) . "</td><td>" . $row["score"] . "</td></tr>";
    }
}

?>

</body>