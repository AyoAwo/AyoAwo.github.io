
function menuToggle(x) {
    x.classList.toggle("change");

    document.getElementById("menuDropdown").style.width = document.getElementById("menuDropdown").style.width == "150px" ? "0" : "150px";
    document.getElementById("main").style.marginLeft = document.getElementById("main").style.marginLeft == "150px" ? "0" : "150px";
}

$(document).ready(function() {
    document.getElementById("letter1Link").hidden = true;
    let letter1 = localStorage.getItem("letter1");
    if(letter1 != null){
        document.getElementById("letter1Link").hidden = false;
    }
})
