$(function (){
    $(".item").click(function () {
        if (!$(this).hasClass("current")) {
            $(".list").find(".current").removeClass("current");
            $(this).addClass("current");
            id = $(this).find(".id").text();
            name = $(this).find(".name").text();
            description = $(this).find(".description").text();
            price = $(this).find(".price").text();
            url = $(this).find(".imgurl").text();
            category = $(this).find(".categoryid").text();
            $(".idfield").val(id);
            $(".namefield").val(name);
            $(".descfield").val(description);
            $(".imgfield").val(url);
            $(".pricefield").val(price);
            $(".catfield").val(category);
            $(".add").prop('disabled', true);
            $(".update").prop('disabled', false);
            $(".delete").prop('disabled', false);
        }
    });

    $(".clear").click(function () {
        $(".add").prop('disabled', false);
        $(".update").prop('disabled', true);
        $(".delete").prop('disabled', true);
        $(".idfield").val('');
        $(".namefield").val('');
        $(".descfield").val('');
        $(".imgfield").val('');
        $(".pricefield").val('');
        $(".catfield").val('');
    })
});