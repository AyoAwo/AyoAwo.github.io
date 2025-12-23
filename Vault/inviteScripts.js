function menuToggle(x) {
    document.getElementById("menuDropdown").style.width = document.getElementById("menuDropdown").style.width == "150px" ? "0" : "150px";
 }

const anniversary = new Date(2023,7,1,23,0,0);
var date = new Date();
if(date < anniversary){
    if(window.location.href.indexOf("index.html") == -1){
        location.replace("index.html");
    }
}