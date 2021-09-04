function contact(){
    this.datas=null;
    this.showData =null;
    var showData =null;
    var idArray =[];
    this.init=function(){
        var me = this;
        me.action();
    }
    this.idArray = function () {
		var array = [];
		var checkRow = $(".checkItem");
		$(checkRow).each(function (index, item) {
			if ($(item).is(":checked")) {
				array.push(parseInt($(item).val()));
			}
		});
        if(array.length>0){
            $(".showAction").show();
        }else{
            $(".showAction").hide();
        }
        $(".count").text(array.length)
        // console.log(array);
		idArray = array;
	};
    this.action=function(){
        var me = this;
        $(document).delegate('.btn-delete','click',function(){
            var id = $(this).data('id');
            var url = $(this).data('url');
            idArray=[id];
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn xóa liên hệ này không ?",
                data:{idArray:JSON.stringify(idArray)},
                reload:true
            });
        });
        $(document).delegate('.btn-delete-all','click',function(){
            var url = $(this).data('url');
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn xóa liên hệ này không ?",
                data:{idArray:JSON.stringify(idArray)},
                reload:true
            });
        });
        $(document).delegate('.checkAll','click',function(){
            if ($(this).is(":checked")) {
                var checkRow = $(".checkItem");
                $(checkRow).prop('checked',true);
                me.idArray();
			}else{
                var checkRow = $(".checkItem");
                $(checkRow).prop('checked',false);
                me.idArray();
            }
        });
        $(document).delegate('.checkItem','click',function(){
            if ($(this).is(":checked")) {
                $(this).prop('checked',true);
                me.idArray();
			}else{
                $(this).prop('checked',false);
                me.idArray();
            }
        });
        var toolbarOptions = [
            ['blockquote', 'code-block'],
            ['bold', 'italic', 'underline', 'strike'],
            [{'list': 'ordered'}, { 'list': 'bullet' }],
            [{'header': [1, 2, 3, 4, 5, 6, false] }],
            [{'color': [] }, { 'background': [] }],
            [{'align': [] }],
          ];
         var quillView  = new Quill('#body', {
            table: true,
            modules: {
                toolbar: false,
                syntax: true,
              },
            theme: 'snow'
        });
        var body_Reply= new Quill('#body_Reply', {
            table: true,
            modules: {
                toolbar: true,
                syntax: true,
              },
            theme: 'snow'
        });
        $(document).delegate('.btn-view ','click',function(){
            var btn = this;
            var url=$(btn).data('url');
            var id=$(btn).data('id');
            buttonloading(btn,true);
            $.ajax({
                url:url,
                data:{id:id},
                type:"GET",
                dataType:'JSON',
                success:function(data){
                    buttonloading(btn,false);
                    if(data.status==1){
                        $("#status-table-"+data.id).text('Đã xem');
                        $("#status-table-"+data.id).removeClass('badge-warning');
                        $("#status-table-"+data.id).addClass('badge-success');
                    }
                    $.each(data,function(index,item){
                        $("#"+index).val(item);
                        if(index=="body"){
                            quillView.root.innerHTML = item;
                        }
                    });
                    $("#viewMailDetail").modal({ backdrop: 'static', keyboard: false });
                },error:function(error){
                     buttonloading(btn,false);
                    $("#viewMailDetail").modal({ backdrop: 'static', keyboard: false });
                    _modalError500(error);
                }
            });
        });
        $("#ButtonReply").on('click',function(){
            var btn = this;
            buttonloading(btn,true);
            $("#viewMailDetail").modal("hide");
            setTimeout(function(){
                $("#subject_Reply").val("Phản hồi liên hệ");
                $("#email_Reply").val($("#email").val());
                buttonloading(btn,false);
                $("#viewMailReply").modal({ backdrop: 'static', keyboard: false });
            },500);
        });
        $("#ButtonSentReply").on('click',function(){
            var btn = this;
            $("#AlertJSReply").empty();
            var url = $(btn).attr('data-url');
            buttonloading(btn,true);
            var formData = new FormData();
            formData.append('email',$("#email_Reply").val());
            formData.append('subject',$("#subject_Reply").val());
            formData.append('body',body_Reply.root.innerHTML);
            $.ajax({
                url:url,
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                        buttonloading(btn,false);
                        Toast.fire({
                            icon: data.status,
                            title: data.msg
                        });
                        $("#AlertJSReply").html(alertJS(data.msg,'success'));
                    }else if(data.status === 'error'){
                        buttonloading(btn,false);
                        Toast.fire({
                            icon: data.status,
                            title: data.msg
                        });
                    }
                },
                error: function(er){
                    _showError(er,"#formAction");
                    $("#AlertJSReply").html(alertJS("Máy chủ không thể thực gửi mail vào lúc này !",'danger'));
                    buttonloading(btn,false);
                }
            });
        });

    }
}
