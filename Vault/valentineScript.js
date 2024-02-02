function nextPage() {
    
}

function moveButton() {
    var x = (Math.random() * (document.getElementById('valCon').getBoundingClientRect().width- document.getElementById('noButton').offsetWidth - 85))- document.getElementById('noButton').offsetWidth + document.getElementById('valCon').getBoundingClientRect().left;
    var y = (Math.random() * (document.getElementById('valCon').getBoundingClientRect().height- document.getElementById('noButton').offsetHeight - 48))- document.getElementById('noButton').offsetHeight+ document.getElementById('valCon').getBoundingClientRect().top;
    document.getElementById('noButton').style.left = `${x}px`;
    document.getElementById('noButton').style.top = `${y}px`;
}