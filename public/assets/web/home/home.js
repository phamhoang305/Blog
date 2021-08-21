$(document).ready(function() {
    var page = 2;
    $("#button-load-more").on('click',function () {
        var btn=this;
        buttonloading(btn,true);
        $.ajax({
            url:url_getposthome,
            type:'GET',
            data:{page:page},
            dataType:'html',
            success:function(data){
                page++;
                buttonloading(btn,false);
                $(".render-post-home").append(data);
                $(".product-description").tooltip();
            },error:function(error){
                buttonloading(btn,false);
                console.log(error);
            }
        });
    });
});

