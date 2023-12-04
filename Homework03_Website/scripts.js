//=======================================
//Name: Nicolaas Dyk
//Date: 11/27/23
//Desc: Clicks Counter Website
//=======================================

const USERNAME_STORAGE = "usernameStored";

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

function test()
{
    var xml = new XMLHttpRequest();

    xml.open()
}