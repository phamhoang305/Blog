function ad(){
    this.datas=null;
    this.showData =null;
    var showData =null;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function(){
        var me = this;
        $(document).delegate('.ad_status','change',function(){
            var id = $(this).data('id');
            var url = $(this).data('url');
            $.ajax({
                url:url,
                type:'POST',
                data:{id:id},
                dataType:'JSON',
                success:function(data){
                    Toast.fire({
                        icon: data.status,
                        title: data.msg
                    });
                },error:function(e){
                    Toast.fire({
                        icon: 'error',
                        title: "Máy chủ không thực hiện được !"
                    });
                }
            });
        });
        $("#saveCodeAdSense").on('click',function(){
            var buton = this;
            var formData = new FormData();
            formData.append('AdSense',$('#AdSense').val());
            var url = $(buton).attr('data-url');
            buttonloading(buton,true);
            $.ajax({
                url:url,
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
                }
            });
        });
    }
}
