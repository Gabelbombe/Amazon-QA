var app = window.app || {};

app.loaded = function ()
{
    console.log ('Window is loaded.');
}

window.onload = app.loaded;