$(document).ready(function(){

    //$("a.reg, a.log").click(function(){
    $("a.reg, a.log, a.a_remind").click(function(){
        if ($(this).hasClass("reg")) {
            $(".popup.register").fadeIn();
        } else if ($(this).hasClass("log")) {
            $(".popup.login").fadeIn();
        } else if ($(this).hasClass("a_remind")) {
            $(".popup.login").fadeOut();
            $(".popup.remind").fadeIn();
        }
        $(".popup-wrap").fadeIn();
        $(".popup-wrap").click(function(){
            $(".popup-wrap").fadeOut();
            $(".popup.login").fadeOut();
            $(".popup.register").fadeOut();
            $(".popup.remind").fadeOut();
        });
        return false;
    });

    $(".popup.register form, .popup.login form, .popup.remind form").on("submit", function(){
        var formdata = $(this).serialize();
        $(".inputgroup.error").removeClass("error");
        $.ajax({
            url: '/ajax/',
            method: 'post',
            dataType: 'json',
            data: formdata,
            success: function(data){
                if (typeof data.result !== "undefined") {
                    if (data.result == true) {
                        if (typeof data.url !== "undefined") {
                            document.location.href = data.url;
                        } else {
                            document.location.href = "/";
                        }
                    } else {
                        if (typeof data.errors !== "undefined") {
                            for (key in data.errors) {
                                $("input[name='"+data.errors[key].field+"']").parent(".inputgroup").addClass("error");
                                $("input[name='"+data.errors[key].field+"']").parent(".inputgroup").children(".errortext").html(data.errors[key].text);
                            }
                            $(".inputgroup.error:first input").focus();
                        } else {
                            if (typeof data.text !== "undefined") {
                                alert(data.text);
                            } else {
                                alert("Произошло непоправимое, обратитесь к администратору (1)!");
                            }
                        }
                    }
                } else {
                    alert("Произошло непоправимое, обратитесь к администратору (2)!");
                }
            },
            error: function(){
                alert("Произошло непоправимое, обратитесь к администратору (3)!");
            }
        });
        return false;
    });

});



