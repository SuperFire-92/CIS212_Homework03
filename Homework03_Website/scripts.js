//=======================================
//Name: Nicolaas Dyk
//Date: 11/27/23
//Desc: Clicks Counter Website
//=======================================

const USERNAME_STORAGE = "usernameStored";

var gameRunning = false;
var gameStarting = false;
var curScore;
var clicksPerSec;

function indexStart()
{
    //Get the error display
    var errorDisplay = document.getElementById("txt_errorDisplay");
    
    //Set the innerHTML of the error display to show the error
    errorDisplay.innerHTML = sessionStorage.getItem('errorType');

    //Remove the error from the session storage to avoid showing it again later
    sessionStorage.removeItem('errorType');

    //Get rid of the currently logged in user in case the user has navigated here without logging out
    sessionStorage.removeItem(USERNAME_STORAGE);
}

function signUpStart()
{
    //Get the error display
    var errorDisplay = document.getElementById("txt_errorDisplay");
    
    //Set the innerHTML of the error display to show the error
    errorDisplay.innerHTML = sessionStorage.getItem('errorType');

    //Remove the error from the session storage to avoid showing it again later
    sessionStorage.removeItem('errorType');

    //Get rid of the currently logged in user in case the user has navigated here without logging out
    sessionStorage.removeItem(USERNAME_STORAGE);
}

function clickerStart()
{
    var timer = document.getElementById("txt_countdown");
    var score = document.getElementById("txt_score");

    timer.innerHTML = "Waiting to start";
    score.innerHTML = "0";

    //findHighScores();
}

function highscoresStart()
{
    var table = document.getElementById("table_highscores");
    var tableLayout = sessionStorage.getItem("highscores");

    table.innerHTML = tableLayout;
}

function runGame()
{
    if (!gameStarting)
    {
        gameStarting = true;
        var score = document.getElementById("txt_score");
        score.innerHTML = 0;
        curScore = 0;
        tickdownTimer("3");
        setTimeout(tickdownTimer, 1000, "2");
        setTimeout(tickdownTimer, 2000, "1");
        setTimeout(tickdownTimer, 3000, "GO! 5");
        setTimeout(startGame, 3000);
        setTimeout(tickdownTimer, 4000, "GO! 4");
        setTimeout(tickdownTimer, 5000, "GO! 3");
        setTimeout(tickdownTimer, 6000, "GO! 2");
        setTimeout(tickdownTimer, 7000, "GO! 1");
        setTimeout(endGame, 8000);
    }


    function startGame()
    {
        gameRunning = true;
    }

    function endGame()
    {
        tickdownTimer("Click To Play Again!");
        gameRunning = false;
        gameStarting = false;
        clicksPerSec = curScore / 5;
        addScoreToDatabase();
    }
}

function findHighScores()
{
    var xml = new XMLHttpRequest();

    xml.open('GET','highscores.php');

    var highscores = sessionStorage.getItem('highscores');

    var highscoreDisplay = document.getElementById("txt_highscores");

    highscoreDisplay.innerHTML = highscores;
}

//Sets the timer to the provided string
function tickdownTimer(i)
{
    var timer = document.getElementById("txt_countdown");

    timer.innerHTML = i;
}

//Used for the button in clicker.html to add to the score
function addToScore()
{
    if (gameRunning)
    {
        var score = document.getElementById("txt_score");
        curScore++;
        score.innerHTML = curScore;
    }
}

function addScoreToDatabase()
{
    //Send a request to the score_upload page without ever having to move the user to that page.
    var xml = new XMLHttpRequest();

    xml.open('GET','score_upload.php?totalClicks=' + curScore + '&clickPerSec=' + clicksPerSec + '&username=' + sessionStorage.getItem(USERNAME_STORAGE));
    xml.send();

    //Code used for testing
    xml.onload = function()
    {
        if (xml.status != 200)
        {
            alert('ERROR');
        }
        else
        {
            //alert('DONE');
        }
    };

    xml.onprogress = function(event)
    {
        if (event.lengthComputable)
        {
            //alert('Not finished');
        }
        else
        {
            //alert('Finished');
        }
    };

    xml.onerror = function()
    {
        alert('REQUEST FAILED');
    }
}