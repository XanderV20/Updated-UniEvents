const month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
var index = new Date();
var current = [index.getMonth(), index.getDate(), index.getFullYear()];
var year = current[2];
var count = index.getMonth();

function generate() {
    var Cmonth = month[current[0]];
    var day = days[current[1]];
    if (year%4 == 0 && (year%100 != 0 || year%400 == 0) && Cmonth=="February") {
        day = 29;
    }
    var start = new Date(Cmonth + " 1, " + current[2] + " 11:00:00").getDay();
    var last = new Date(Cmonth + " " + day + ", " + current[2] + " 11:00:00").getDay();
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
            if (i == current[1] + start - 1) {
                string += "<div class='date' style='color:#BF5700'>" + dayI + "</div>\n";
            } else {
                string += "<div class='date'>" + dayI + "</div>\n";
            }
        }

        if (i % 7 == 6) {
            string += "</div>\n";
        }
    }

    chart.innerHTML = string;
}

function updateMonth(direction) {
    count += direction;
    if (count > 11) {
        count -= 12;
        year += 1;
    } else if (count < 0) {
        count += 12;
        year -= 1;
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
                string += "<div class='date' style='color:#BF5700'>" + dayI + "</div>\n";
            } else {
                string += "<div class='date'>" + dayI + "</div>\n";
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