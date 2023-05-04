<!DOCTYPE html>
<html lang="en">
  <head>
    <title>UniEvents</title>
    <meta charset="UTF-8">
    <meta name="description" content="Sign up page to create an account with UNIEvents and access more features">
    <link rel="stylesheet" href="styles.css">
    <script src="functions.js" defer></script>
  </head>

  <body>
    <div class="navbar">
      <img src="New Logo.png" alt ="UniEvents Logo" height="50" width="150" onclick="home()"></img>
      <button class="navbtn" id="Sign Up" onclick="signin()">Sign in</button>
    </div>
    <div>
    <form method="POST" action="SignUp.php">
      <h3>Sign up</h3>
    <table>
      <tr><td>Email: </td><td><input type="text" name="email" autofocus required></td></tr>
      <tr><td>Verify Email: </td><td><input type="text" name="verify" requited></td></tr>
      <tr><td>Username: </td><td><input type="text" name="username" required></td></tr>
      <tr><td>Password: </td><td><input type="password" name="password" required></td></tr>
    </table>
    <input type="submit" value="Submit">
    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        if (isset($_COOKIE["loggedIn"])) {
            header("Location: UniEvents.html");
            die;
        }
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $verify = $_POST["verify"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        if ($email != $verify) {
            echo "<p style='color:red;text-align:center'>Email does not match</p>";
            die;
        } 
        #else if (email is not a university email) then invalid email

        $mysqli = new mysqli("spring-2023.cs.utexas.edu", "cs329e_bulko_xander", "canyon-Milan5lung", "cs329e_bulko_xander");

        if ($mysqli->connect_errno) {
            die("Connect error: ".$mysqli->connect_errno.":".$mysqli->connect_errno);
        }

        $username = $mysqli->real_escape_string($username);
        $password = $mysqli->real_escape_string($password);
        $email = $mysqli->real_escape_string($email);

        $result = $mysqli->query("SELECT * FROM passwords");

        if ($result->num_rows == 0) {
            $insert = $mysqli->query("INSERT INTO passwords VALUES ('$username', '$password', '$email')") or die($mysqli->error);
            setcookie("loggedIn", $username, "time() + 3600", "/");
            header("Location: UniEvents.html");
            die;
        } else {
            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_row();
                if ($row[0] == $username) {
                    echo "<p style='color:red;text-align:center'>Username already taken. Please chose another.</p>";
                    die;
                }
            }
            $insert = $mysqli->query("INSERT INTO passwords VALUES ('$username', '$password', '$email')") or die($mysqli->error);
            setcookie("loggedIn", "true", "time() + 3600", "/");
            header("Location: UniEvents.html");
            die;
        }
    }
    ?>

    </div>
  </body>
</html>
