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
        function saveMail(button,type){
            $("#alertJS,#alertJSTestMail").empty();
            var formData = new FormData($("#formAction")[0]);
            formData.append('type',type);
            buttonloading(button,true);
            $.ajax({
                url:$("#formAction").attr('action'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                            buttonloading(button,false);
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
                            buttonloading(button,false);
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
                        buttonloading(button,false);
                    }
                },
                error: function(er){
                    buttonloading(button,false);
                    _showError(er,"#formAction");
                }
            });
        }
        function saveSetting(button,type){
            $("#alertJS,#alertJSTestMail").empty();
            var formData = new FormData($("#formAction")[0]);
            formData.append('type',type);
            buttonloading(button,true);
            $.ajax({
                url:$("#formAction").attr('action'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                            buttonloading(button,false);
                            Toast.fire({
								icon: data.status,
								title: data.msg
							});
                            _showError("","#formAction");
                            location.reload();
                    }else if(data.status === 'error'){
                            buttonloading(button,false);
                            Toast.fire({
                                icon: data.status,
                                title: data.msg
                            });
                            $("#alertJS").html(alertJS(data.msg,'danger'));
                    }else{
                        buttonloading(button,false);
                    }
                },
                error: function(er){
                    buttonloading(button,false);
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
        function saveSocialite(button){
            var formData = new FormData($("#formAction")[0]);
            buttonloading(button,true);
            $.ajax({
                url:$("#formAction").attr('action'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                            buttonloading(button,false);
                            Toast.fire({
								icon: data.status,
								title: data.msg
							});
                            _showError("","#formAction");
                            location.reload();
                    }else if(data.status === 'error'){
                            buttonloading(button,false);
                            Toast.fire({
                                icon: data.status,
                                title: data.msg
                            });
                    }else{
                        buttonloading(button,false);
                    }
                },
                error: function(er){
                    buttonloading(button,false);
                    _showError(er,"#formAction");
                }
            });
        }
        $("#buttonClearCache").on('click',function(e){
            var button = this;
            buttonloading(button,true);
            $.ajax({
                url:$(button).data('url'),
                type: "GET",
                dataType:'JSON',
                success: function(data){
                    buttonloading(button,false);
                    Toast.fire({
						icon: data.status,
						title: data.msg
				    });


                },
                error: function(er){
                    buttonloading(button,false);
                }
            });
        });

    }
}
