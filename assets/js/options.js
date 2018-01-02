$(function () {
    $(".item-upper-wrapper").click(function () {
        if ($(this).parent().find(".item-options-wrapper").is(":visible")) {
            $(this).parent().find(".item-options-wrapper").slideUp('slow');
            $(this).parent().find(".item-upper-wrapper").css("background-color", '');
        } else {
            item = $(this).parent().find(".item-title").text();
            $.ajax({
                type: "POST",
                url: "optionsform.php",
                data: "item=" + item,
                context: this,
                success: function (html) {
                    $(this).parent().find(".item-options-wrapper").html(html);
                    $(this).parent().find(".item-options-wrapper").slideDown('slow');
                    $(this).parent().find(".item-upper-wrapper").css("background-color", "rgba(143, 200, 96, 0.2)");

                }
            });
        }
    });

    $(".options-icon").click(function () {
        alert("Icon clicked");
        $(this).closest(".item-options-wrapper").slideUp('slow');
        $(this).closest(".item-upper-wrapper").css("background-color", '');
    });
});
