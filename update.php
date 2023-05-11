<?php
    $mysqli = new mysqli("spring-2023.cs.utexas.edu", "cs329e_bulko_xander", "canyon-Milan5lung", "cs329e_bulko_xander");

    if ($mysqli->connect_errno) {
        die("Connect error: ".$mysqli->connect_errno.":".$mysqli->connect_errno);
    }

    $mysqli->select_db("cs329e_bulko_xander") or die($mysqli->error);

    $date = $_GET["date"];

    $result = $mysqli->query("SELECT * FROM events WHERE eventDate='$date' ORDER BY eventTime");

    if ($result->num_rows == 0) {
        $string = "<h4>No events today</h4>;0-0 of 0";
    } else {
        $string = "";
        for ($i = 0; $i < $result->num_rows; $i++) {
            $row = $result->fetch_row();
            $string .= "<div class='event'>\n<h4>$row[1]</h4>\n<p>Time: $row[3]</p>\n<p>Location: $row[4]</p>\n<p>Description: $row[5]</p>\n</div>";
        }
        $string .= ";1-".$result->num_rows." of ".$result->num_rows;
    }

    echo $string;
?>
