$(function () {
    $("#add_err").css('display', 'none', 'important');
    $("#login-button").click(function(){
        login=$("#login").val();
        pw=$("#pw").val();
        $.ajax({
            type: "POST",
            url: "authentication.inc.php",
            data: "login="+login+"&pw="+pw,
            success: function(html){
                if(html !=='false')    {
                    $("#loggedin").css("display", "block", "important");
                    $("#loggedin").append("<p>Logged in as "+html+"</p>");
                   // document.getElementById("loggedin-user").innerHTML="Logged in as "+html;
                    $("#login-form").css("display", "none");
                }
                else    {
                    $("#add_err").css('display', 'inline', 'important');
                    $("#add_err").html("<p>Wrong username or password</p>");
                }
            }
        });
        return false;
    });
});