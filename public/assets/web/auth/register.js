function register(){
    this.datas=null;
    this.init=function(){
        $("#buttonRegister").on('click',function(e){
            $(".alertJS").empty();
            var formData = new FormData($("#formRegister")[0]);
            formData.append('type','register');
            formData.append('code',$("#code").val());
            onSubmit(formData,"#buttonRegister")
        });
        $(".buttonConfirm").on('click',function(e){
            $(".alertJS,#alertJSConfirm").empty();
            var formData = new FormData($("#formRegister")[0]);
            formData.append('type','confirm');
            onSubmit(formData,".buttonConfirm")
        });
        function onSubmit(formData,button) {
            buttonloading(button,true);
            $.ajax({
                url:$(button).attr('data-url'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(formData.get('type')=='confirm'){
                        if(data.status === 'success'){
                            buttonloading(button,false);
                            $("#alertJSConfirm").html(alertJS(data.msg,'success'));
                            $("#modalCode").modal({backdrop:'static',keyboard:true});
                        }else{
                            buttonloading(button,false);
                            $("#alertJSConfirm").html(alertJS(data.msg,'danger'));
                            $(".alertJS").html(alertJS(data.msg,'danger'));
                        }
                    }else{
                        if(data.status === 'success'){
                            return window.location.href=data.url;
                            // buttonloading(button,false);
                        }else{
                            buttonloading(button,false);
                            $(".alertJS").html(alertJS(data.msg,'danger'));
                        }
                    }

                },
                error: function(er){
                    _showError(er,"#formRegister");
                    buttonloading(button,false);
                }
            });
        }
    }
}
