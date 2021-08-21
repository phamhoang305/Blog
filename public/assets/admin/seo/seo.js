
function seo(){
    this.datas=null;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function() {
        $("#change_seo").on('click',function(){
            $("#file_seo").val(null);
            $("#file_seo").trigger('click');
        });
		$("#file_seo").on('change',function(){
            setImgSRC(this,"#seo_review");
        });

        $(".onSaveData").on('click',function(e){
            onSubmit(".onSaveData");
        });
        function onSubmit(buton){
            $("#alertJS").empty();
            var formData = new FormData($("#updateSeo")[0]);
            formData.append('sitemap_frequency',$('#sitemap_frequency').val());
            buttonloading(buton,true);
            $.ajax({
                url:$("#updateSeo").attr('action'),
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
                            _showError("","#updateSeo");
                            return window.location.href=window.location.href;
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
                    _showError(er,"#updateSeo");
                }
            });
        }
    }
}
