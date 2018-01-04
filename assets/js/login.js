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
                    $('#after_login').css("display", "inline-block", "important");
                    $('#before_login').css("display", "none", "important");
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
