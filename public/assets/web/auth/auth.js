function auth(){
    this.datas=null;
    this.init=function(){
        $("#formAdLogin").on('submit',function(e){
            var formData = new FormData(this);
            e.preventDefault();
            $("#alertJS").empty();
            var ad_button_login = "#ad_button_login";
            buttonloading(ad_button_login,true);
            $.ajax({
                url:$(ad_button_login).attr('data-url'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                        buttonloading(ad_button_login,false);
                        return window.location.href=$(ad_button_login).attr('data-urlSuccess');
                    }else{
                        buttonloading(ad_button_login,false);
                        $("#alertJS").html(alertJS(data.msg,'danger'));
                    }
                },
                error: function(er){
                        buttonloading(ad_button_login,false);
                        $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng nhập!",'danger'));
                }
            });
        });
    }
}
