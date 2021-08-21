function setting(){
    this.datas=null;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function(){
        $("#change_icon").on('click',function(){
            $("#file_icon").val(null);
            $("#file_icon").trigger('click');
        });
		$("#file_icon").on('change',function(){
            setImgSRC(this,"#icon_review");
        });
        $("#change_logo").on('click',function(){
            $("#file_logo").val(null);
            $("#file_logo").trigger('click');
        });
		$("#file_logo").on('change',function(){
            setImgSRC(this,"#logo_review");
        });
        $(".onSaveSetting").on('click',function(e){
            saveSetting(".onSaveSetting","updateSeting");
        });
        $("#testSenMail").on('click',function(e){
            saveMail("#testSenMail","testMail");
        });
        $("#saveMail").on('click',function(e){
            saveMail("#saveMail","saveMail");
        });
        function saveMail(buton,type){
            $("#alertJS,#alertJSTestMail").empty();
            var formData = new FormData($("#formAction")[0]);
            formData.append('type',type);
            buttonloading(buton,true);
            $.ajax({
                url:$("#formAction").attr('action'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                            buttonloading(buton,false);
                            Toast.fire({
								icon: data.status,
								title: data.msg
							});
                            _showError("","#formAction");
                            if(type=='saveMail'){
                                location.reload();
                            }else{
                                $("#alertJSTestMail").html(alertJS(data.msg,'success'));
                            }
                    }else if(data.status === 'error'){
                            buttonloading(buton,false);
                            if(type=='saveMail'){
                                Toast.fire({
                                    icon: data.status,
                                    title: data.msg
                                });
                                $("#alertJS").html(alertJS(data.msg,'danger'));
                            }else{
                                $("#alertJSTestMail").html(alertJS(data.msg,'danger'));
                            }
                    }else{
                        buttonloading(buton,false);
                    }
                },
                error: function(er){
                    buttonloading(buton,false);
                    _showError(er,"#formAction");
                }
            });
        }
        function saveSetting(buton,type){
            $("#alertJS,#alertJSTestMail").empty();
            var formData = new FormData($("#formAction")[0]);
            formData.append('type',type);
            buttonloading(buton,true);
            $.ajax({
                url:$("#formAction").attr('action'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                            buttonloading(buton,false);
                            Toast.fire({
								icon: data.status,
								title: data.msg
							});
                            _showError("","#formAction");
                            location.reload();
                    }else if(data.status === 'error'){
                            buttonloading(buton,false);
                            Toast.fire({
                                icon: data.status,
                                title: data.msg
                            });
                            $("#alertJS").html(alertJS(data.msg,'danger'));
                    }else{
                        buttonloading(buton,false);
                    }
                },
                error: function(er){
                    buttonloading(buton,false);
                    _showError(er,"#formAction");
                }
            });
        }
        $("#btnSaveFacebook").on('click',function(e){
            var button = this;
            saveSocialite(button);
        });
        $("#btnSaveGoogle").on('click',function(e){
            var button = this;
            saveSocialite(button);
        });
        $("#btnSaveGithup").on('click',function(e){
            var button = this;
            saveSocialite(button);
        });
        function saveSocialite(buton){
            var formData = new FormData($("#formAction")[0]);
            buttonloading(buton,true);
            $.ajax({
                url:$("#formAction").attr('action'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                            buttonloading(buton,false);
                            Toast.fire({
								icon: data.status,
								title: data.msg
							});
                            _showError("","#formAction");
                            location.reload();
                    }else if(data.status === 'error'){
                            buttonloading(buton,false);
                            Toast.fire({
                                icon: data.status,
                                title: data.msg
                            });
                    }else{
                        buttonloading(buton,false);
                    }
                },
                error: function(er){
                    buttonloading(buton,false);
                    _showError(er,"#formAction");
                }
            });
        }
    }
}
