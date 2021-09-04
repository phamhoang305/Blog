function user(){
    this.datas=null;
    this.showData =null;
    var showData =null;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function(){
        var me = this;
        $(document).delegate('.btn-delete','click',function(){
            var button = this;
            var id = $(this).data('id');
            var url = $(this).data('url');
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn xóa trang này không ?",
                data:{id:id,type:'delete','showData':showData},
                removeEL:"#item-"+id,
                reload:true
            });
        });
        $(document).delegate('.post_status','change',function(){
            var button = this;
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

    }
    $("#type").on('change',function(){
        if($(this).val()=='userAdminCreate'){
            $("#showType").removeClass('d-none')
        }else{
            $("#showType").addClass('d-none')
        }
    });

}
