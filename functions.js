const month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
var index = new Date();
var current = [index.getMonth(), index.getDate(), index.getFullYear()];
var year = current[2];
var count = index.getMonth();
let selected = "";

function generate(direction) {
    count += direction;
    if (count > 11) {
        count -= 12;
        year += 1;
    } else if (count < 0) {
        count += 12;
        year -= 1;
    }

    if (direction == 1 || direction == -1) {
        selected = year + "-" + (count+1).toString().padStart(2,"0") + "-01";
    }

    var Cmonth = month[count];
    var day = days[count];

    if (year%4 == 0 && (year%100 != 0 || year%400 == 0) && Cmonth=="February") {
        day = 29;
    }

    var start = new Date(Cmonth + " 1, " + year + " 11:00:00").getDay();
    var last = new Date(Cmonth + " " + day + ", " + year + " 11:00:00").getDay();
    var fill = 6 - last;
    document.getElementById("Month").innerHTML = Cmonth + " " + year;
    var chart = document.getElementById("days");
    var string = "";

    for (let i = 0; i < day + start + fill; i++) {
        var dayI = i - start + 1;
        if (i % 7 == 0) {
            string += "<div class='week'>\n";
        }

        if (i < start || i - day - start >= 0) {
            string += "<div class='date'></div>\n"
        } else {
            if (i == current[1] + start - 1 && year == current[2] && count == current[0]) {
                string += "<div class='date' style='color:#BF5700;background-color:#C2C2C2' id='" + year + "-" + (count+1).toString().padStart(2,"0") + "-" + dayI.toString().padStart(2,"0") + "' onclick='ajaxFunction(this.id)'>" + dayI + "</div>\n";
                selected = year + "-" + (count+1).toString().padStart(2,"0") + "-" + dayI.toString().padStart(2,"0");
                document.getElementById("date").innerHTML = (count+1) + "/" + dayI + "/" + year; 
            } else {
                string += "<div class='date' id='" + year + "-" + (count+1).toString().padStart(2,"0") + "-" + dayI.toString().padStart(2,"0") + "' onclick='ajaxFunction(this.id)'>" + dayI + "</div>\n";
            }
        }

        if (i % 7 == 6) {
            string += "</div>\n";
        }
    }

    chart.innerHTML = string;
}

function signin() {
   location.href = "SignIn.php";
}

function home() {
    location.href = "UniEvents.php";
}

function signup() {
    location.href = "SignUp.php";
}

function events() {
    location.href = "Events.php";
}

function ajaxFunction(date) {
    var ajaxRequest;
    ajaxRequest = new XMLHttpRequest();

    ajaxRequest.onreadystatechange = function() {
        if(ajaxRequest.readyState == 4) {
            var ajaxDisplay = document.getElementById('events');
            let response = ajaxRequest.responseText.split(";");
            ajaxDisplay.innerHTML = response[0];
            document.getElementById('count').innerHTML = response[1];
        }
    }

    previous = document.getElementById(selected);
    previous.style.color = null;
    previous.style.backgroundcolor = null;
    selected = date;
    clicked = document.getElementById(selected);
    clicked.style.color = "#BF5700";
    clicked.style.backgroundcolor = "#C2C2C2";

    dateArray = date.split("-");
    visibleDate = "";
    if (dateArray[1][0] == 0) {
        visibleDate += dateArray[1][1] + "/";
    } else {
        visibleDate += dateArray[1] + "/";
    }

    if (dateArray[2][0] == 0) {
        visibleDate += dateArray[2][1] + "/" + dateArray[0];
    } else {
        visibleDate += dateArray[2] + "/" + dateArray[0];
    }

    document.getElementById("date").innerHTML = visibleDate;

    var queryString = "?date=" + date;
    ajaxRequest.open("GET", "update.php" + queryString, true);
    ajaxRequest.send(null);
}