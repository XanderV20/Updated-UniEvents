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
        </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!isset($_COOKIE["loggedIn"])) {
                header("Location: UniEvents.php");
                die;
        }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {

}
?>

</body>
</html>