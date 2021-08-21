function testcategory(){
    this.datas=null;
    var datas = null;
    this.init=function () {
        datas = this.datas;
        console.log(datas);
        var me = this;
        me.runAction();
    }
    this.runAction=function() {
        $("#buttonShowModalAction").click(function (params) {
            $("#formAction")[0].reset();
            $("#addTestCategoryModalLabel").text("Thêm danh mục");
            $("#buttonSaveData").attr('data-url',datas.route.add);
            $("#addTestCategory").modal({backdrop:'static',keyboard:false})
        });
        $(document).delegate(".btn-view","click",function(){
            window.location.href =$(this).data('url');
        });
        $(document).delegate(".btn-edit","click",function(){
            var btn = this;
            $("#buttonSaveData").attr('data-url',datas.route.edit);
            $("#buttonSaveData").attr('data-id',$(this).data('uniqid'));
            $("#addTestCategoryModalLabel").text("Cập nhật danh mục");
            buttonloading(btn,true);
            $.ajax({
                url:$(this).data('url'),
                type:"GET",
                dataType:'JSON',
                success:function(data){
                     buttonloading(btn,false);
                    $("#addTestCategory").modal({ backdrop: 'static', keyboard: false });
                    $.each(data,function(index,item){
                        $("#"+index).val(item);
                        if(index=='status'){
                            $("#"+index).val(item);
                            $("#"+index).trigger('change');
                        }
                    });
                },error:function(error){
                     buttonloading(btn,false);
                    $("#addTestCategory").modal({ backdrop: 'static', keyboard: false });
                    _modalError500(error);
                }
            });
        });
        $('#formAction').submit(function(e) {
            var formData = new FormData(this);
            e.preventDefault();
            $("#AlertJS").empty();
            buttonloading("#buttonSaveData",true);
            $.ajax({
                url:$("#buttonSaveData").attr('data-url'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                        buttonloading("#buttonSaveData",false);
                        Toast.fire({
                            icon: data.status,
                            title: data.msg
                        });
                        $("#addTestCategory").modal('hide');
                        location.reload();
                    }else if(data.status === 'error'){
                        buttonloading("#buttonSaveData",false);
                        $("#AlertJS").html(alertJS(data.msg,'danger'));
                        Toast.fire({
                            icon: data.status,
                            title: data.msg
                        });
                    }else{
                        buttonloading("#buttonSaveData",false);
                        $("#AlertJS").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
                    }
                },
                error: function(er){
                    _showError(er,"#formAction");
                    buttonloading("#buttonSaveData",false);
                }
            });

        });
        $(document).delegate('.btn-delete','click',function(){
            var uniqid = $(this).data('uniqid');
            _modalDelete({
                url:datas.route.delete,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn xóa danh mục này không ?",
                data:{uniqid:uniqid},
                reload:true
            });
        });
    }
}
