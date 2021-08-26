function profile(){
    this.datas=null;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function() {
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],
            [{'list': 'ordered'}, { 'list': 'bullet' }],
            [{'header': [1, 2, 3, 4, 5, 6, false] }],
            [{'color': [] }, { 'background': [] }],
            [{'align': [] }],
          ];
         var quill  = new Quill('#about', {
            modules: {
                toolbar: toolbarOptions,
                syntax: false,
              },
            theme: 'snow'
        });
        $("#formProfile").on('submit',function(e){
            e.preventDefault();
            $("#alertJS").empty();
            var formData = new FormData(this);
            formData.set("about", quill.root.innerHTML);
            buttonloading("#onSaveProfile",true);
            $.ajax({
                url:$("#formProfile").attr('action'),
                type: "POST",
                data:formData,
                dataType:'JSON',
                processData: false,
                contentType: false,
                success: function(data){
                    if(data.status === 'success'){
                            buttonloading("#onSaveProfile",false);
                            Toast.fire({
								icon: data.status,
								title: data.msg
							});
                            return window.location.href=window.location.href;
                    }else if(data.status === 'error'){
                            buttonloading("#onSaveProfile",false);
                            Toast.fire({
								icon: data.status,
								title: data.msg
							});
                            $("#alertJS").html(alertJS(data.msg,'danger'));
                    }else{
                            buttonloading("#onSaveProfile",false);
                            // $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
                    }
                    _showError(null,"#formProfile");
                },
                error: function(er){
                    console.log();
                    if(er.responseJSON.errors.post_content!=undefined){
                        $("#alertJS").html(alertJS(er.responseJSON.errors.post_content[0],'warning'));
                    }else{
                        $("#alertJS").empty();
                    }
                    _showError(er,"#formProfile");
                    buttonloading("#onSaveProfile",false);
                    // $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
                }
            });
        });
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
                            return window.location.href=window.location.href;
                    }else if(data.status === 'error'){
                            buttonloading("#onSaveChangePass",false);
                            Toast.fire({
								icon: data.status,
								title: data.msg
							});
                            $("#alertJS").html(alertJS(data.msg,'danger'));
                    }else{
                            buttonloading("#onSaveChangePass",false);
                            // $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
                    }
                    _showError(null,"#formChangePass");
                },
                error: function(er){
                    console.log();
                    if(er.responseJSON.errors.post_content!=undefined){
                        $("#alertJS").html(alertJS(er.responseJSON.errors.post_content[0],'warning'));
                    }else{
                        $("#alertJS").empty();
                    }
                    _showError(er,"#formChangePass");
                    buttonloading("#onSaveChangePass",false);
                    // $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
                }
            });
        });
    }
}
