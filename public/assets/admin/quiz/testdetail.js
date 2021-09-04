function testdetail(){
    this.datas=null;
    var datas = null;
    this.init=function () {
        datas = this.datas;
        console.log(datas);
        var me = this;
        me.runAction();
    }
    this.runAction=function() {
        hljs.configure({languages: ['javascript','typescript', 'ruby', 'python','php','xml','dockerfile','css','scss','csharp','json','php-template','sql','swift']});
        function new_uuid() {
            var temp_url = URL.createObjectURL(new Blob());
            var uuid = temp_url.toString();
            URL.revokeObjectURL(temp_url);
            return uuid.substr(uuid.lastIndexOf('/') + 1); // remove prefix (e.g. blob:null/, blob:www.test.com/, ...)
          }
        function renderItem(time,name){
            var html ='<div class="input-group p-1 __item" data-uniqid="'+time+'" id="item-'+time+'">';
                        html+='<div class="input-group-prepend">';
                            html+='<div class="input-group-text">';
                                    html+='<input name="radio-item" id="'+time+'" value="'+time+'" class="__radio" type="radio">';
                            html+='</div>';
                        html+='</div>';
                        html+='<input type="text" id="name-'+time+'" value="'+name+'" placeholder="Nhập câu trả lời  ..." class="form-control name-value">';
                        html+='<div class="input-group-prepend">';
                            html+='<button type="button" value="'+time+'" class="btn btn-danger item-delete"><i class="fa fa-trash"></i></button>';
                        html+='</div>';
            html+='</div>';
            return html;
        }
        var toolbarOptions = [
            ['blockquote', 'code-block'],
            ['bold', 'italic', 'underline', 'strike'],
            [{'list': 'ordered'}, { 'list': 'bullet' }],
            [{'header': [1, 2, 3, 4, 5, 6, false] }],
            [{'color': [] }, { 'background': [] }],
            [{'align': [] }],
          ];
         var quill  = new Quill('#note_quill', {
            table: true,
            modules: {
                toolbar: toolbarOptions,
                syntax: true,
              },
            theme: 'snow'
        });
        $("#buttonShowModalAction").click(function (params) {
            $("#formAction")[0].reset();
            quill.root.innerHTML = "";
            $("#listItem").html(alertJS('Chưa có câu trả lời nào !','danger'));
            $("#addTestTestdetailModalLabel").text("Thêm câu hỏi mới");
            $("#buttonSaveData").attr('data-url',datas.route.add);
            $("#addTestTestdetail").modal({backdrop:'static',keyboard:false})
        });
        $(document).delegate(".btn-view","click",function(){
            window.location.href =$(this).data('url');
        });
        $(document).delegate(".btn-edit","click",function(){
            var btn = this;
            $("#listItem").html("");
            $("#buttonSaveData").attr('data-url',datas.route.edit);
            $("#buttonSaveData").attr('data-id',$(this).data('uniqid'));
            $("#addTestTestdetailModalLabel").text("Cập nhật câu hỏi");
            buttonloading(btn,true);
            $.ajax({
                url:$(this).data('url'),
                type:"GET",
                dataType:'JSON',
                success:function(data){
                     buttonloading(btn,false);
                    $("#addTestTestdetail").modal({ backdrop: 'static', keyboard: false });
                    $.each(data,function(index,item){
                        $("#"+index).val(item);
                        if(index=='note'){
                            quill.root.innerHTML =item;
                        }
                        if(index=='status'){
                            $("#"+index).val(item);
                            $("#"+index).trigger('change');
                        }
                        if(index=='item'){
                            var html = "";
                            if(item.length>0){
                                $.each(item,function(index,item){
                                    html+=renderItem(item.uniqid,item.name);
                                });
                                $("#listItem").append(html);
                            }else{
                                $("#listItem").html(alertJS('Chưa có câu trả lời nào !','danger'));
                            }
                        }
                        if(index=='check_uniqid'){
                            $("#check_uniqid").val(item);
                            $("#"+item).prop('checked',true);
                        }
                    });
                },error:function(error){
                     buttonloading(btn,false);
                    $("#addTestTestdetail").modal({ backdrop: 'static', keyboard: false });
                    _modalError500(error);
                }
            });
        });
        // console.log(uuid());
        var number = 0;
        $("#addButtonItem").on('click',function(){
            number++;
            if($(".__item").length==0){
                $("#listItem").html("");
            }
            $("#listItem").append(renderItem(new_uuid()+"-"+number,""));
        });
        $(document).delegate(".__radio","click",function(){
            $("#check_uniqid").val($(this).val());
        })
        $(document).delegate(".item-delete","click",function(){
                var check_uniqid = $("#check_uniqid").val();
                var id = $(this).val();
                if(id==check_uniqid){
                    $("#check_uniqid").val("");
                }
                $("#item-"+id).remove();
                if($(".__item").length==0){
                    $("#check_uniqid").val("");
                    $("#listItem").html(alertJS('Chưa có câu trả lời nào !','danger'));
                }
        });
        function getItem(){
            var data = [];
            $(".__item").each(function(index,item){
                    var uniqid = $(item).data('uniqid');
                    data.push({
                        uniqid:uniqid,
                        name:$("#name-"+uniqid).val(),
                    });
            });
            return data;
        }
        $('#formAction').submit(function(e) {
            var check_uniqid = $("#check_uniqid").val();
            var item = getItem();
            if(item.length<2){
                $("#AlertJS").html(alertJS("Nhập ít nhất 2 câu trả lời !",'warning'));
                return false;
            }else{
                if(check_uniqid==""){
                    $("#AlertJS").html(alertJS("Vui lòng chọn đáp án đúng cho câu trả lời đúng !",'warning'));
                    return false;
                }else{
                    var formData = new FormData(this);
                    formData.append('test_listID',datas.test_listID);
                    formData.append("note", quill.root.innerHTML);
                    formData.append("item",JSON.stringify(getItem()));
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
                                $("#addTestTestdetail").modal('hide');
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
                }
            }
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
        $("#buttonShowModalImport").on('click',function(){
            $("#modalImportData").modal({ backdrop: 'static', keyboard: false });
        });
        $("#buttonExportData").on('click',function(){
            $("#alert-import").empty();
            var btn = this;
            var url = $(btn).data('url');
            buttonloading(btn, true);
            $.ajax({
                url:url,
                type:"POST",
                data:{name_file:datas.name},
                dataType:"JSON",
                success:function(data){
                    buttonloading(btn, false);
					Toast.fire({
						icon: data.icon,
						title: data.messages
					});
					var a = $("<a>");
					a.attr("href", data.file),
					$("body").append(a),
					a.attr("download", datas.name+"-"+data.name+".xlsx"),
					a[0].click(),
					a.remove();
                },error:function(error){
                    buttonloading(btn, false);
                    console.log(error);
                    $("#alert-import").html(alertJS("Máy chủ không thực hiện được vui lòng kiểm tra lại !","danger"));
                }
            })
        });
        $("#file-excel").on("click",function(e) {
            $("#htmlerror").html("");
            $("#file-excel").val(null);
        })
        $('#import-data').submit(function(e) {
            var formData = new FormData(this);
            formData.append('test_listID',datas.test_listID);
            e.preventDefault();
            $("#alert-import").empty();
            var btn = "#buttonImportData";
            var url = $(btn).data('url');
            buttonloading(btn, true);
            var file = $("#file-excel")[0]
            var imgTypeUpload = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
            if (file.files && file.files[0]) {
                var reader = new FileReader();
                var imgType = file.files[0].type;
                console.log(imgType);
                if(imgTypeUpload.includes(imgType)==false){
                    buttonloading(btn, false);
                    $("#file-excel").val(null);
                    $("#alert-import").html(alertJS("File không đúng định dạng xlsx",'danger'));
                    setTimeout(function name(params) {
                        buttonloading(btn, false);
                    },500)
                }else{
                    $.ajax({
                        url:url,
                        type: "POST",
                        data:formData,
                        dataType:'JSON',
                        processData: false,
                        contentType: false,
                        success: function(data){
                            if(data.status === 'success'){
                                Toast.fire({
                                    icon: data.status,
                                    title: data.msg
                                });
                                $("#alert-import").html(alertJS(data.msg,'success'));
                                $("#htmlerror").html("<tr><td colspan='2'>Không có lỗi nào</td></tr>");
                                setTimeout(function () {
                                    location.reload();
                                    buttonloading(btn, false);
                                },1000);
                            }else if(data.status === 'error'){
                                buttonloading(btn, false);
                                $("#alert-import").html(alertJS(data.msg,'danger'));
                                var htmlerror ="";
                                $.each(data.errors,function(index,item) {
                                    htmlerror+='<tr>';
                                        htmlerror+='<td style="width: 95%">'+item.msg+'</td>';
                                        htmlerror+='<td style="width: 5%">'+item.row+'</td>';
                                    htmlerror+='</tr>';
                                });
                                // $("#file-excel").val(null);
                                $("#htmlerror").html(htmlerror);
                            }
                        },
                        error: function(er){
                            $("#alert-import").html(alertJS("Máy chủ không thể thực hiện vui lòng thực hiện lại !",'danger'));
                            buttonloading(btn, false);
                        }
                    });
                }
            }else{
                $("#alert-import").html(alertJS("Vui lòng chọn file !",'danger'));
                setTimeout(function name(params) {
                    buttonloading(btn, false);
                },500)
            }


        });

    }
}
