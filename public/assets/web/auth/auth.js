function auth(){
    this.datas=null;
    this.init=function(){
        $("#formLogin").on('submit',function(e){
            var formData = new FormData(this);
            e.preventDefault();
            $("#alertJS").empty();
            buttonloading("#buttonLogin",true);
            $.ajax({
                url:$("#buttonLogin").attr('data-url'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                            buttonloading("#buttonLogin",false);
                            return window.location.href=data.url;
                    }else if(data.status === 'error'){
                            buttonloading("#buttonLogin",false);
                            $("#alertJS").html(alertJS(data.msg,'danger'));
                    }else{
                            buttonloading("#buttonLogin",false);
                            $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng nhập!",'danger'));
                        }
                },
                error: function(er){
                        buttonloading("#buttonLogin",false);
                        $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng nhập!",'danger'));
                }
            });
        });
    }
}
