function FreshTodayView() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
            if(this.readyState === 4 && this.status === 200) {
            document.getElementById('todayView').innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('POST', "http://localhost:8080/tny/core/analysis/AdminHandler.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("LiveTodayView");
}   
function FreshWeekView() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
            if(this.readyState === 4 && this.status === 200) {
            document.getElementById('weekViews').innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('POST', "http://localhost:8080/tny/core/analysis/AdminHandler.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("LiveWeekViews");
}
function FreshWeekLinks() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
            if(this.readyState === 4 && this.status === 200) {
            document.getElementById('weekLinks').innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('POST', "http://localhost:8080/tny/core/analysis/AdminHandler.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("LiveWeekLinks");
}
function FreshAllLinks() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
            if(this.readyState === 4 && this.status === 200) {
            document.getElementById('TodayLinks').innerHTML = xhttp.responseText;
        }
    };
    xhttp.open('POST', "http://localhost:8080/tny/core/analysis/AdminHandler.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("LiveTodayLinks");
}



function FreshAdminRport() {
    FreshTodayView();
    FreshWeekView();
    FreshWeekLinks();
    FreshAllLinks();
}
var intervalID = window.setInterval(FreshAdminRport, 5000);