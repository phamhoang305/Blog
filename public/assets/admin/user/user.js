function user(){
    this.datas=null;
    var datas= null;
    this.init=function(){
        var me = this;
        datas = this.datas;
        me.action();
    }
    this.action=function() {
        $("#type").on('change',function(){
            var value = $(this).val();
            if(value=='userCreate'){
                $("#roleHiden").hide();
            }else{
                $("#roleHiden").show();
            }
        });

        $("#onSaveUser").on('click',function(e){
            onSubmit("#onSaveUser");
        });
        function onSubmit(buton){
            $("#alertJS").empty();
            var formData = new FormData($("#formAction")[0]);
            formData.append('id',$('#formAction').attr('value'));
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
                            return window.location.href=data.url;
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
        if(datas.action=='update'){
            $("#type").val(datas.type);
            $("#type").trigger('change');
        }
    }
}
