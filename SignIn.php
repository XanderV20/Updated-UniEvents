<!DOCTYPE html>
<html lang="en">
  <head>
    <title>UniEvents</title>
    <meta charset="UTF-8">
    <meta name="description" content="Sign in page to access more features of the UNIEvents website">
    <link rel="stylesheet" href="styles.css">
    <script src="functions.js" defer></script>
  </head>

  <body>
    <div class="navbar">
      <img src="New Logo.png" alt ="UniEvents Logo" height="50" width="150" onclick="home()"></img>
      <button class="navbtn" id="Sign Up" onclick="signup()">Sign Up</button>
    </div>
    <div>
    <form method="POST" action="SignIn.php">
      <h3>Sign in</h3>
    <table>
      <tr><td>Username: </td><td><input type="text" name="username" autofocus required></td></tr>
      <tr><td>Password: </td><td><input type="password" name="password" required></td></tr>
    </table>
    <input type="submit" value="Login">
    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        if (isset($_COOKIE["loggedIn"])) {
            header("Location: UniEvents.php");
            die;
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $mysqli = new mysqli("spring-2023.cs.utexas.edu", "cs329e_bulko_xander", "canyon-Milan5lung", "cs329e_bulko_xander");

        if ($mysqli->connect_errno) {
            die("Connect error: ".$mysqli->connect_errno.":".$mysqli->connect_errno);
        }

        $username = $mysqli->real_escape_string($username);
        $password = $mysqli->real_escape_string($password);

        $result = $mysqli->query("SELECT * FROM passwords");

        if ($result->num_rows == 0) {
            echo "<p style='color:red;text-align:center'>Invalid username or password</p>";
        } else {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_row();
                if ($row[0] == $username) {
                    if ($row[1] == $password) {
                        setcookie("loggedIn", $username, time() + 3600, "/");
                        header("Location: UniEvents.php");
                        die;
                    }
                }
            }
            echo "<p style='color:red;text-align:center'>Invalid username or password</p>";
        }
    }
    ?>

    </div>
  </body>
</html>
