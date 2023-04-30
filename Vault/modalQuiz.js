const myModalLl = document.getElementById('passwordModal1')
myModalLl.addEventListener('show.bs.modal', event => {
    //On modal Show
    var questions = [{
        question: "What do you want to be when you grow up?",
        choices: ["Librarian", "Dentist", "Teacher"],
        correctAnswer: 1
    }, {
        question: "Which of these is your favourite colour?",
        choices: ["Gold", "Maroon", "Llilac"],
        correctAnswer: 2
    }, {
        question: "Where did I take you to eat on our first date?",
        choices: ["Shakeshack", "Mcdonald's", "Nobu"],
        correctAnswer: 0
    }, {
        question: "What's our comfort show?",
        choices: ["Vampire Diaries", "Brooklyn nine-nine", "Family Guy"],
        correctAnswer: 0
    }, {
        question: "Who do I hate?",
        choices: ["Greg", "Samuel", "Rory"],
        correctAnswer: 2
    }];

    var questionCounter = 0; //Tracks question number
    var selections = []; //Array containing user choices
    var quiz = $('#quiz'); //Quiz div object

    // Display initial question
    displayNext();

    // Click handler for the 'next' button
    $('#submit').on('click', function (e) {
        e.preventDefault();

        // Suspend click listener during fade animation
        if(quiz.is(':animated')) {
        return false;
        }
        selections[questionCounter] = +$('input[name="answer"]:checked').val();
        
        i = selections.length -1
        if (isNaN(selections[questionCounter])){
            $("#answer").empty();
            $("#answer").append('You gotta answer dummy');
            $("#answer").show();
        }else {
        displayNext();
        questionCounter++;
        }
    });
    
    $('#restart').on('click', function (e) {
        e.preventDefault();

        questionCounter = 0;
        displayNext();
        return;
    });

    // Creates and returns the div that contains the questions and
    // the answer selections
    function createQuestionElement(index) {
        var qElement = $('<div>', {
        id: 'question'
        });

        var header = $('<h4>Question ' + (index + 1) + ':</h4>');
        qElement.append(header);

        var question = $('<p>').append(questions[index].question);
        qElement.append(question);

        var radioButtons = createRadios(index);
        qElement.append(radioButtons);

        return qElement;
    }

    // Creates a list of the answer choices as radio inputs
    function createRadios(index) {
        var radioList = $('<ul>');
        var item;
        var input = '';
        for (var i = 0; i < questions[index].choices.length; i++) {
        item = $('<li>');
        input = '<input type="radio" name="answer" value=' + i + ' />';
        input += questions[index].choices[i];
        item.append(input);
        radioList.append(item);
        }
        return radioList;
    }

    // Displays next requested element
    function displayNext() {
        quiz.fadeOut(function() {
        $("#answer, #alert").hide();
        $('#question').remove();
        $("#next").hide();
        $("#submit").show();

        if(questionCounter < questions.length){
            var nextQuestion = createQuestionElement(questionCounter);
            quiz.append(nextQuestion).fadeIn();
        }else {
            var scoreElem = displayScore();
            quiz.append(scoreElem).fadeIn();
            $('#submit').hide();
        }
        });
    }

    // Computes score and returns a paragraph element to be displayed
    function displayScore() {
        var score = $('<p>',{id: 'question'});

        var numCorrect = 0;
        for (var i = 0; i < selections.length; i++) {
            if (selections[i] === questions[i].correctAnswer) {
                numCorrect++;
            }
        }
        if(numCorrect === questions.length){
            score.append('Okay you got all my questions right, maybe you are my gf after all.');
            score.append('The password is "DREAMLAND"');
        }
        else{
        score.append('You got only got ' + numCorrect + ' out of ' +
                    questions.length + ' right, no password for you.');
        score.append('You can always try again though');
        }
        return score;
    }

})
