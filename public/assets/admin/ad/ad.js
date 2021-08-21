function ad(){
    this.datas=null;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function() {
        $("#file_image_name").on('click',function(){
            $("#file_ad").click();
        });
        $("#url").on('blur',function(){
            if($("#url").val()!=""){
                setCode($("#file_image_name").val());
            }else{
                $("#code").val('');
            }

        });
        $("#idClear").on('click',function(){
            $("#file_ad").val(null);
            $("#code,#url,#file_image_name").val('');
        });
        function setCode(url_image){
            var url  = $("#url").val();
            var code =  '<a href="'+url+'"><img class="img-fluid img-thumbnail" src="[image]" alt=""></a>';
            $("#code").val(code);
        }
        $("#file_ad").on('change',function(evt){
            var f = evt.target.files[0];
            var type = evt.target.files[0].type;
            var d = new Date();
            var n = d.getTime();
            var fileName = "block_"+n+"_"+evt.target.files[0].name;

            if(
                type=='image/jpg'||
                type=='image/JPG'||
                type=='image/png'||
                type=='image/PNG'||
                type=='image/gif'||
                type=='image/GIF'||
                type=='image/jpeg'||
                type=='image/JPEG'
            ){
                $("#file_image_name").val(fileName);
                setCode(fileName);
            }else{
                $("#file_ad").val(null);
            }
        });
        $("#onSaveAd").on('click',function(e){
            onSubmit("#onSaveAd");
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
                    if(er.responseJSON.errors.post_content!=undefined){
                        $("#alertJS").html(alertJS(er.responseJSON.errors.post_content[0],'warning'));
                    }else{
                        $("#alertJS").empty();
                    }
                    _showError(er,"#formAction");
                }
            });
        }
    }
}
