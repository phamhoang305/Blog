function page(){
    this.datas=null;
    this.init=function(){
        var me = this;
        me.action();
    }
    this.action=function() {
        hljs.configure({languages: ['javascript','typescript', 'ruby', 'python','php','xml','dockerfile','css','scss','csharp','json','php-template','sql','swift']});
        var quill = null;
        $(document).ready(function(){
            var toolbarOptions = [
                ['blockquote', 'code-block'],
                ['bold', 'italic', 'underline', 'strike'],
                ['link','video','image'],
                [{'list': 'ordered'}, { 'list': 'bullet' }],
                [{'script': 'sub'}, { 'script': 'super' }],
                [{'header': [1, 2, 3, 4, 5, 6, false] }],
                [{'color': [] }, { 'background': [] }],
                [{'align': [] }],
              ];
              quill  = new Quill('#post_content', {
                modules: {
                    toolbar: toolbarOptions,
                    syntax: true,
                  },
                theme: 'snow'
            });
        });
        $("#btnPublic").on('click',function(e){
            onSubmit("#btnPublic");
        });
        function onSubmit(buton){
            $("#alertJS").empty();
            var formData = new FormData($("#formAction")[0]);
            formData.set("post_content",quill.root.innerHTML);
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
                            return window.location.href=data.url;
                    }else if(data.status === 'error'){
                            buttonloading(buton,false);
                            Toast.fire({
								icon: data.status,
								title: data.msg
							});
                            $("#alertJS").html(alertJS(data.msg,'danger'));
                    }else{
                            buttonloading(buton,false);
                            // $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
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


                    // $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng ký!",'danger'));
                }
            });
        }
    }
}
