function role(){
    this.datas=null;
    var data = null;
    this.init=function(){
        var me = this;
        data = this.datas;
        me.action();
    }
    this.action=function() {
        $("#onSaveRole").on('click',function(e){
            onSubmit("#onSaveRole");
        });
        function getDataRole(){
            var roles = Array();
            $("input[name='roles[]']:checked").each(function(index,item){
                roles.push($(item).val());
            });
            return JSON.stringify(roles);
        }
        $(document).ready(function(){
            if(data.type=='update'){
                $("input[name='roles[]']").each(function(index,item){
                    if(data.roles.includes($(item).val())){
                        $(item).prop('checked',true);
                    }
                });
            }
        });
        function onSubmit(buton){
            $("#alertJS").empty();
            var formData = new FormData($("#formAction")[0]);
            formData.append('id',$('#formAction').attr('value'));
            formData.append('permission',getDataRole());
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
    }
}
