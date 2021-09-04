function sub(){
    this.data=null;
    var data = null;
    var runDatatable =null;
    this.init=function () {
        data = this.data;
        console.log(data);
        var me = this;
        me.runDatatable();
        me.runAction();

    }
    this.runDatatable=function() {
        runDatatable = $("#runDatatable").DataTable({
            serverSide: true,
            responsive: true,
            processing: true,
            paging: true,
            lengthChange: true,
            searching: false,
            ordering: true,
            info: true,
            autoWidth: true,
            ajax: {
				url: data.route.getDatatable,
				type: "GET",
				data: function (d) {
					return $.extend({}, d, {
						inputSearch: $("#inputSearch").val(),
                        selectCategoryID :$("#select_category_id").val()
					});
				}
			},
            order: [0, "desc"],
            columns: [
                {
                    title: "#",
                    data: "id",
                    name: "id",
                    className: "text-center",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
			    },
                {
                    title: "Icon",
                    data: "cate_icon",
                    name: "cate_icon",
                    className: "text-center",
                    render: function (data, type, row, meta) {
                        var img ='<div class="image"><img width="40" height="40" title="Chọn hình ảnh" class=" img-circle elevation-2" src="'+data+'" alt="'+row.cate_name+'"></div>';
                        return img;
                    }
			    },
                {
                    title: "Tiêu đề",
                    data: "cate_name",
                    name: "cate_name",
                    className: "text-left",
			    },
                {
                    title: "Sắp xếp",
                    data: "cate_order",
                    name: "cate_order",
                    className: "text-center",
			    },
                {
                    title: "Ngày tạo",
                    data: "created_at",
                    name: "created_at",
                    className: "text-center",

			    },
                {
                    title: "#",
                    data: "id",
                    name: "id",
                    className: "text-center",
                    render: function (data, type, row, meta) {
                        return _buttonActionButton([
                            {
                                icon:'<i class=" fas fa-edit"></i>',
                                title:"Cập nhật",
                                text:"",
                                value:data,
                                class:"btn-success btn-edit"
                            },
                            {
                                icon:'<i class=" fas fa-trash"></i>',
                                title:"Xóa",
                                text:"",
                                value:data,
                                class:"btn-danger btn-delete"
                            }
                        ])
                    }
			    },

            ],
            drawCallback: function (settings) {
				buttonloading("#buttonSearch",false);
			}
		});
    }
    this.runAction=function() {
        $(".icon_review").on('click',function(){
            $("#file_cate_icon").val(null);
            $("#file_cate_icon").trigger('change');
        });
		$("#file_cate_icon").on('change',function(){
            setImgSRC(this,".icon_review");
        });
        $("#buttonSearch").click(function(params) {
            buttonloading("#buttonSearch",true)
            runDatatable.ajax.reload();
        });
        $("#select_category_id").change(function(params) {
            buttonloading("#buttonSearch",true)
            runDatatable.ajax.reload();
        });


        $("#buttonShowModalAction").click(function (params) {
            $("#formAction")[0].reset();
            $("#icon_review").attr('src',"");
            $("#buttonSaveData").attr('data-url',data.route.add);
            $("#parentAction").modal({backdrop:'static',keyboard:false})
        });
        $(document).delegate(".btn-edit","click",function(){
            $("#buttonSaveData").attr('data-url',data.route.edit);
            $("#buttonSaveData").attr('data-id',$(this).val());
            $("#parentActionLabel").text("Cập nhật danh mục");
            $.ajax({
                url:data.route.edit,
                type:"GET",
                dataType:'JSON',
                data:{id:$(this).val()},
                success:function(data){
                    $("#parentAction").modal({ backdrop: 'static', keyboard: false });
                    $.each(data,function(index,item){
                        if(index=='cate_icon'){
                            $("#icon_review").attr('src',item);
                        }
                        $("#"+index).val(item);
                    });
                },error:function(error){
                    $("#parentAction").modal({ backdrop: 'static', keyboard: false });
                    _modalError500(error);
                }
            });
        });
        $('#formAction').submit(function(e) {
            var formData = new FormData(this);
            formData.append('id',$("#buttonSaveData").attr('data-id'));
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
                        $("#parentAction").modal('hide');
                        runDatatable.ajax.reload();
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
            var id = $(this).val();
            _modalDelete({
                url:data.route.delete,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn xóa danh mục này không ?",
                data:{id:id},
                table:"#runDatatable"
            });
        });
    }
}
