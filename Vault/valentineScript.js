function nextPage() {
    $('#questionTitle').empty();
    $('#questionTitle').append('Yippeeee!!!');
    $("#gifBox").empty();
    $("#gifBox").append('<img src="assets/images/bunnyhug.gif" style="height: 50vh; width: auto; background: none;" alt="Cute animated illustration">');
    $('#btnGroup').empty();
}

var moveCounter = 0

function moveButton() {
    moveCounter = moveCounter + 1;
    var x = (Math.random() * (document.getElementById('valCon').getBoundingClientRect().width- document.getElementById('noButton').offsetWidth - 85))- document.getElementById('noButton').offsetWidth + document.getElementById('valCon').getBoundingClientRect().left;
    var y = (Math.random() * (document.getElementById('valCon').getBoundingClientRect().height- document.getElementById('noButton').offsetHeight - 48))- document.getElementById('noButton').offsetHeight+ document.getElementById('valCon').getBoundingClientRect().top;
    document.getElementById('noButton').style.left = `${x}px`;
    document.getElementById('noButton').style.top = `${y}px`;
    if(moveCounter == 3){
        $("#gifBox").empty();
        $("#gifBox").append('<img src="assets/images/abunny.png" style="height: 30vh; width: auto;" alt="Cute animated illustration">');
    }
    if(moveCounter == 10){
        $("#gifBox").empty();
        $("#gifBox").append('<img src="assets/images/bunnypissed.gif" style="height: 35vh; width: auto; background: none;" alt="Cute animated illustration">');
    }
}