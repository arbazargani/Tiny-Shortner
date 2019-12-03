const ScrRatio = screen.width + "*" + screen.height;

var xhttp = new XMLHttpRequest();
// xhttp.onreadystatechange = function () {
//     if(this.readyState === 4 && this.status === 200) {
//         document.getElementById('res').innerHTML = xhttp.responseText;
//     }
// };
xhttp.open('POST', "http://localhost:8080/tny/core/analysis/AgentHandler.php", true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("ScrRatio="+ScrRatio);