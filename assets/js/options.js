$(function () {
    $(".item-upper-wrapper").click(function () {
        if ($(this).hasClass("current")) {
            $(this).parent().find(".item-options-wrapper").slideUp('slow');
            $(this).removeClass("current");
            $(this).css("background-color", '');

        } else {
            $('article .current').css("background-color", '');
            $('article .current').parent().find('.item-options-wrapper').slideUp('slow',function() {
                $(this).parent().find('.item-upper-wrapper').removeClass('current');
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
                }
            });
        }
        return false;
    });
});
