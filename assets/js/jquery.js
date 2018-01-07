$(function () {
    $(".item-upper-wrapper").click(function () {
        if ($(this).hasClass("current")) {
            $(this).parent().find(".item-options-wrapper").slideUp('slow');
            $(this).removeClass("current");
            $(this).css("background-color", '');
            $(this).find("a").css("opacity", '');

        } else {
            $('article .current').css("background-color", '');
            $('article .current').parent().find('.item-options-wrapper').slideUp('slow',function() {
                $(this).parent().find('.item-upper-wrapper').removeClass('current');
                $(this).parent().find("a").css("opacity", '');
            });

            id = $(this).parent().find("input[name='product[id]']").val();
            $.ajax({
                type: "POST",
                url: "optionsform.php",
                data: "id=" + id,
                context: this,
                success: function (html) {
                    $(this).parent().find(".item-options-wrapper").html(html);
                    $(this).parent().find(".item-options-wrapper").slideDown('slow');
                    $(this).css("background-color", "rgba(143, 200, 96, 0.2)");
                    $(this).addClass("current");
                    $(this).find("a").css("opacity", "0.5");
                }
            });
        }
        return false;
    });

    if (window.location.href.indexOf("Confirmation") > -1){
        $('a.order').hide();
    } else {
        $('a.order').show();
    }

    $("a.confirm").click(function () {
        $( "#dialog-confirm" ).dialog( "open" );
    });

    $("#dialog-confirm").dialog({
        autoOpen: false,
        resizable: true,
        height: "auto",
        width: "auto",
        modal: true,
        buttons: {
            "Confirm": function() {
                $("#message-confirm").css("display", "block");
                $('#order-info').hide();
                $( this ).dialog( "close" );
            },
            Cancel: function() {
                window.location.replace("index.php");
                $( this ).dialog( "close" );
            }
        }
    });

    $("#logout-form button").click(function () {
        $.ajax({
            url: "logout.php",
            success: function (html) {
                window.location.replace(window.location.href);
            }
        });
    });

});
