function contact(){
    this.datas=null;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function() {
        $("#sendContact").on('click',function(e){
            onSubmit("#sendContact");
        });
        $("#contact-button-confirm").on('click',function(e){
            onSubmit("#contact-button-confirm");
        });
        function onSubmit(buton){
            $("#alertJS,#alertJSConfirm").empty();
            var formData = new FormData($("#formAction")[0]);
            formData.append('result',$("#result").val())
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
                            $("#MathA").text(data.math.MathA);
                            $("#MathB").text(data.math.MathB);
                            $("#MathType").text(data.math.MathType);
                            $("#full_name,#email,#body,#result").val('');
                            $("#modalMath").modal('hide');
                            showError("","#formAction");
                    }else if(data.status === 'error'){
                            buttonloading(buton,false);
                            if(buton=="#contact-button-confirm"){
                                $("#alertJSConfirm").html(alertJS(data.msg,'danger'));
                            }else{
                                $("#modalMath").modal({backdrop:'static',keyboard:true});
                                $("#alertJS").html(alertJS(data.msg,'danger'));
                            }
                            showError("","#formAction");
                    }else{
                        buttonloading(buton,false);
                    }
                },
                error: function(er){
                    buttonloading(buton,false);
                    if(er.responseJSON.errors.body!=undefined){
                        $("#alertJS").html(alertJS(er.responseJSON.errors.body[0],'warning'));
                    }else{
                        $("#alertJS").empty();
                    }
                    _showError(er,"#formAction");
                }
            });
        }
    }
}
