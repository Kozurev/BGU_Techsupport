$(function(){

    $(".section-block").on("click", "h3", function(){
        var ul = $(this).parent().find(".dropdown");

        if(ul.css("display") == "none")
        {
            ul.show("slow");
        }
        else
        {
            ul.hide("slow");
        }
    });

});