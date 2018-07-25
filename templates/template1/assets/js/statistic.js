$(function(){
    $("body")
        .on("click", "#statistic_show", function(e){
            e.preventDefault();
            loaderOn();
            var FormData = $("#statistic_form").serialize();
            refreshStatisticTable( FormData );
        })
        .on("click", "#export", function(e){
            e.preventDefault();
            loaderOn();
            var FormData = $("#statistic_form").serialize();
            statisticExportTabale( FormData );
        });//Document Ready





});


function refreshStatisticTable( FormData ) {
    $.ajax({
        type: "GET",
        url: "?action=show",
        data: FormData,
        success: function(responce) {
            $(".page-wrapper").empty();
            $(".page-wrapper").html(responce);
            loaderOff();
        }
    });
}


function statisticExportTabale( FormData ) {
    $.ajax({
        type: "GET",
        url: "?action=download_table",
        data: FormData,
        success: function(responce) {
            $(".page-wrapper").empty();
            $(".page-wrapper").html(responce);
            loaderOff();
        }
    });
}