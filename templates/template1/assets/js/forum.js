$(function(){

    $( "body" )
        .on("keyup", function(){
            var HintBlock = $(".search_result");
            var HintList = HintBlock.find( "ul" );
            var searchingString = $("#searching_string").val();

            if( searchingString.length < 4 )
            {
                HintBlock.hide( "fast" );
            }
            else
            {
                $.ajax({
                    type: "GET",
                    url: "",
                    dataType: "json",
                    data: {
                        action: "search",
                        hint: "1",
                        searching_string: searchingString
                    },
                    success: function(responce) {
                        HintList.empty();
                        $.each( responce, function( index, value ){
                            HintList.append("<li class='search_hint' data-appid='" + value.id + "'>" + value.subject + "</li>");
                        });
                    }
                });

                HintBlock.show( "slow" );
            }
        })
        .on("click", ".search_hint", function(){
            var www = $("#wwwroot").val();
            var appId = $(this).data("appid");
            var link = www + "/forum/" + appId;
            location.href = link;
        })
        .on("click", ".show_result", function(e){
            e.preventDefault();
            var searchingStr = $( "#searching_string" ).val();
            loaderOn();
            showSearchResult( searchingStr );
        });

});


function showSearchResult( searchingStr ) {
    $.ajax({
        type: "GET",
        url: "",
        data: {
            action: "search",
            searching_string: searchingStr
        },
        success: function( responce )
        {
            $( "#content" ).html( responce );
            loaderOff();
        }
    });
}

