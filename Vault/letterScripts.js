function menuToggle(x) {
    document.getElementById("menuDropdown").style.width = document.getElementById("menuDropdown").style.width == "150px" ? "0" : "150px";
 }

let letter1 = localStorage.getItem("letter1");
if(letter1 == null){
    if(window.location.href.indexOf("home.html") == -1){
        location.replace("home.html");
    }        
}

function revealSurprise(){
    var surprise = $('#surprise');
    surprise.empty();
    surprise.append('<iframe src="https://trinket.io/embed/python/c91f5265c3?outputOnly=true&runOption=run&start=result" width="320" height="356" frameborder="0" marginwidth="0" marginheight="0" allowfullscreen></iframe>').fadeIn();
}
