/* 
 * 
 * 
 * 
 */


$(document).ready(function()
{
    $("#loginbutton").click(function()
    {
        $("#centerwindow").show();
        $("#loginwindow").show();
        $("#registerwindow").hide();
    });
    
    $("#registerbutton").click(function()
    {
        $("#centerwindow").show();
        $("#registerwindow").show();
        $("#loginwindow").hide();
    });
    
    $("#closewindow").click(function()
    {
        $("#centerwindow").hide();
        $("#registerwindow").hide();
        $("#loginwindow").hide();
    });
    
});