<!DOCTYPE html>
<html lang="en">
  <head>
    <title>UniEvents</title>
    <meta charset="UTF-8">
    <meta name="description" content="Web site for university students to post and see various events">
    <link rel="stylesheet" href="styles.css">
    <script src="functions.js" defer></script>
  </head>

  <body onload="generate()">

    <div class="navbar">
        <img src="New Logo.png" alt ="UniEvents Logo" height="50" width="150" onclick="home()"></img>
<?php 
if (isset($_COOKIE["loggedIn"])) {
  echo "<button class='navbtn' id='Events' onclick='events()'>Add Event</button>";
} else {
  echo "<button class='navbtn' id='SignIn' onclick='signin()'>Sign in</button>";
}
?>  
    </div>

    <div class="calendar">
        <div class="month">
            <div class="arrow" onclick="updateMonth(-1)"><</div>
            <div id="Month">Month</div>
            <div class="arrow" onclick="updateMonth(1)">></div>
        </div>
        <div class="weekdays">
            <div class="day">Sun</div>
            <div class="day">Mon</div>
            <div class="day">Tue</div>
            <div class="day">Wed</div>
            <div class="day">Thu</div>
            <div class="day">Fri</div>
            <div class="day">Sat</div>
        </div>
        <div class="days" id="days">
        </div>
    </div>
    
    <div class="column">
      <div class="eventHeader">Events</div>
      <div class="events"> 
      <!--TODO: add event count for that day, label in events section showing the selected date, and ajax-->
        <?php

        $mysqli = new mysqli("spring-2023.cs.utexas.edu", "cs329e_bulko_xander", "canyon-Milan5lung", "cs329e_bulko_xander");

        $date = date("Y-m-d");
        $list = $mysqli->query("SELECT * FROM events WHERE eventDate='$date' ORDER BY eventTime") or die($mysqli->error);

        if ($list->num_rows == 0) {
          echo "<h4>No events on this date</h4>";
        } else {
          for ($i = 0; $i < $list->num_rows; $i++) {
            $row = $list->fetch_row();
            echo "<div class='event'>";
            echo "<h4>$row[1]</h4>";
            echo "<p>Time: $row[3]</p>";
            echo "<p>Location: $row[4]</p>";
            echo "<p>Description: $row[5]</p>";
            echo "</div>";
          }
        }

        ?>
        <!-- <div class="event">
          <h4>Event Name</h4>
          <p>Description</p>
          <p>Number of guests</p>
        </div> -->
      </div>
    </div>
    
  </body>
</html>
