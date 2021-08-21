function pass(){
    this.datas=null;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function() {
        $("#formChangePass").on('submit',function(e){
            e.preventDefault();
            $("#alertJS").empty();
            var formData = new FormData(this);
            buttonloading("#onSaveChangePass",true);
            $.ajax({
                url:$("#formChangePass").attr('action'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                            buttonloading("#onSaveChangePass",false);
                            Toast.fire({
								icon: data.status,
								title: data.msg
							});
                            $("#alertJS").html(alertJS(data.msg,'success'));
                            $("#re_password,#new_password,#token").val('');
                    }else if(data.status === 'error'){
                            buttonloading("#onSaveChangePass",false);
                            Toast.fire({
								icon: data.status,
								title: data.msg
							});
                            $("#alertJS").html(alertJS(data.msg,'danger'));
                    }else{
                            buttonloading("#onSaveChangePass",false);
                            $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
                    }
                    _showError(null,"#formChangePass");
                },
                error: function(er){
                    $("#alertJS").empty();
                    _showError(er,"#formChangePass");
                    buttonloading("#onSaveChangePass",false);
                    // $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
                }
            });
        });
    }
}
