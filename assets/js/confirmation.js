$(function(){
    $("#dialog-confirm").dialog({
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
            "Confirm": function() {
                $("#message-confirm").css("display", "block");
                $( this ).dialog( "close" );
            },
            Cancel: function() {
                $("#message-cancel").css("display", "block");
                $( this ).dialog( "close" );
            }
        }
    });
});