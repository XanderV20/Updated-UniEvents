<!DOCTYPE html>
<html>

<head>
        <title>UniEvents</title>
        <meta charset="UTF-8">
        <meta name="description" content="Page for registered users to add events">
        <link rel="stylesheet" href="styles.css">
        <script src="functions.js" defer></script>
</head>

<body>

        <div class="navbar">
                <img src="New Logo.png" alt="UniEvents Logo" height="50" width="150" onclick="home()"></img>
                <button class="navbtn" id="SignIn" onclick="home()">Home</button>
        </div>

        <form method="POST" action="Events.php">
          <h3>Event Info</h3>
        <table>
          <tr><td>Name: </td><td><input type="text" name="eventName" autofocus required></td></tr>
          <tr><td>Date: </td><td><input type="date" name="eventDate" required></td></tr>
          <tr><td>Time: </td><td><input type="time" name="eventTime" required></td></tr>
          <tr><td>Location: </td><td><input type="text" name="eventLocation" required></td></tr>
          <tr><td>Description: </td><td><input type="text" name="eventDesc" required></td></tr>
        </table>
        <input type="submit" value="Add Event">
        </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!isset($_COOKIE["loggedIn"])) {
                header("Location: UniEvents.php");
                die;
        }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_COOKIE["loggedIn"];
    $name = $_POST["eventName"];
    $date = $_POST["eventDate"];
    $time = $_POST["eventTime"];
    $location = $_POST["eventLocation"];
    $desc = $_POST["eventDesc"];

    $mysqli = new mysqli("spring-2023.cs.utexas.edu", "cs329e_bulko_xander", "canyon-Milan5lung", "cs329e_bulko_xander");

    $name = $mysqli->real_escape_string($name);
    $location = $mysqli->real_escape_string($location);
    $desc = $mysqli->real_escape_string($desc);

    $insert = $mysqli->query("INSERT INTO events VALUES ('$user', '$name', '$date', '$time', '$location', '$desc')") or die($mysqli->error);

    header("Location: Events.php");
    echo "<p>Event Created</p>";
    die;
}
?>

</body>
</html>