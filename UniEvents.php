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
        <div class="event">
          <h4>Event Name</h4>
          <p>Description</p>
          <p>Number of guests</p>
        </div>
      </div>
    </div>
    
  </body>
</html>