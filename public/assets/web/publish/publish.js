function publish(){
    this.datas=null;
    var datas=null;
    var is_delete = 0;
    this.init=function(){
        var me = this;
        datas = this.datas;
        me.action();
    }
    this.action=function() {
        hljs.configure({languages: ['javascript','typescript', 'ruby', 'python','php','xml','dockerfile','css','scss','csharp','json','php-template','sql','swift']});
        $(".select2").select2({
             width:'100%'
        });
        var quill  =null;
        $("#change_post_image").on('click',function(){
            $("#file_post_image").val(null);
            $("#file_post_image").trigger('click');
        });
		$("#file_post_image").on('change',function(){
            var file = this;
            var imgTypeUpload = ['image/png', 'image/PNG', 'image/jpg', 'image/JPG', 'image/jpeg', 'image/JPEG', 'image/gif','image/GIF'];
            if (file.files && file.files[0]) {
                var reader = new FileReader();
                var imgType = file.files[0].type;
				var imgSize = file.files[0].size  //kB
                var KilobyteImg = Math.round((imgSize / 1024))
                if(imgTypeUpload.includes(imgType)==false){
                    $("#file_post_image").val(null);
                    $("#alertJSUploadImg").html(alertJS("Hình ảnh không đúng định dạng",'warning'));
                    return false;
                }
                if(KilobyteImg>Kilobyte){
                    $("#file_post_image").val(null);
                    $("#alertJSUploadImg").html(alertJS("Hình ảnh không được quá 5 MB",'warning'));
                    return false;
                }
                $("#buttonRemoveIamge").show();
                $("#buttonRemoveIamge").attr('value',true);
                is_delete = 0;
                setImgSRC(this,"#post_image_review");
            }
        });
        $("#post_title").on('input',function(){
            var text = $(this).val();
            $(".page-title-seo").text(text);
            $(".view-slug").text(toSlug(text));
        });
        $("#post_des").on('input',function(){
            var text = $(this).val();
            $(".page-description-seo").text(text);
        });
        function destory_editor(selector){
            if($(selector)[0])
            {
                var content = $(selector).find('.ql-editor').html();
                $(selector).html(content);

                $(selector).siblings('.ql-toolbar').remove();
                $(selector + " *[class*='ql-']").removeClass (function (index, css) {
                   return (css.match (/(^|\s)ql-\S+/g) || []).join(' ');
                });

                $(selector + "[class*='ql-']").removeClass (function (index, css) {
                   return (css.match (/(^|\s)ql-\S+/g) || []).join(' ');
                });
            }
            else
            {
                console.error('editor not exists');
            }
        }
        function setQuill() {
            var toolbarOptions = [
                ['blockquote', 'code-block'],
                ['bold', 'italic', 'underline', 'strike'],
                ['link','video','image',{"better-table":[]}],
                [{'list': 'ordered'}, { 'list': 'bullet' }],
                [{'script': 'sub'}, { 'script': 'super' }],
                [{'header': [1, 2, 3, 4, 5, 6, false] }],
                [{'color': [] }, { 'background': [] }],
                [{'align': [] }],
            ];
            quill  = new Quill('#post_content', {
                table: true,
                modules: {
                    toolbar: toolbarOptions,
                    syntax: true,
                  },
                theme: 'snow'
            });
        }
        function setTinymce() {
            tinymce.init({
                selector: '#post_content',
                min_height: 400,
                menubar: false,
                plugins: [
                    "advlist autolink lists link charmap print preview anchor",
                    "searchreplace visualblocks  codesample fullscreen",
                    "insertdatetime media table paste imagetools image",
                ],
                toolbar:"fullscreen  preview codesample | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | numlist bullist | forecolor backcolor removeformat | image media link | outdent indent",
                image_title: true,
                automatic_uploads: true,
                file_picker_types: 'image',
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/*');
                        input.onchange = function () {
                        var file = this.files[0];
                        var imgSize = this.files[0].size;
                        var KilobyteImg = Math.round((imgSize / 1024));
                        console.log("Kilobyte",Kilobyte);
                        console.log("KilobyteImg",KilobyteImg);
                        if(KilobyteImg>Kilobyte){
                            alert("Hình ảnh không được quá 3 MB");
                            return false;
                        }else{
                            var reader = new FileReader();
                            reader.onload = function () {
                                var id = 'blobid' + (new Date()).getTime();
                                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                var base64 = reader.result.split(',')[1];
                                var blobInfo = blobCache.create(id, file, base64);
                                blobCache.add(blobInfo);
                                cb(blobInfo.blobUri(), { title: file.name });
                            };
                            reader.readAsDataURL(file);
                        }
                    };
                    input.click();
                },
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
            });
            tinymce.DOM.loadCSS(editor_ui_css);
        }
        $(document).ready(function(){
            if(datas.editor=='quill'){
                setQuill();
            }else if(datas.editor=="tinymce"){
                setTinymce();
            }else{
                datas.editor = "quill";
                setQuill();
            }
            $("#editor").on('change',function(params) {
                var type = $(this).val();
                datas.editor = type;
                if(type=='quill'){
                    tinymce.remove("#post_content");
                    setQuill();
                }else if(type=="tinymce"){
                    destory_editor("#post_content");
                    setTinymce();
                }
            });
        });
        $("#buttonRemoveIamge").on('click',function(e){
            e.stopPropagation();
            $("#buttonRemoveIamge").hide();
            $("#buttonRemoveIamge").attr('value',false);
            $("#file_post_image").val(null);
            $("#post_image_review").attr('src',$("#defaults-image").val());
            is_delete = 1;
        });
        $("#category_id").on('change',function(e) {
            var htmlOption = '<option value=""> -- CHỌN DANH MỤC CON -- </option>';
            var id = $(this).val()+"";
            $.each(datas.subMenus,function (index,item) {
                if(id==item.cate_parentID){
                    htmlOption+= '<option value="'+item.id+'">'+item.cate_name+'</option>';
                }
            });
            $("#category_sub_id").html(htmlOption);
        })
        $("#btnPublic").on('click',function(e){
            var formData = new FormData($("#formAction")[0]);
            formData.append('editor',datas.editor);
            if(datas.editor=='quill'){
                formData.set("post_content", quill.root.innerHTML);
            }else{
                formData.set("post_content",tinyMCE.editors["post_content"].getContent());
            }
            formData.append('uniqid',$('#formAction').attr('value'));
            formData.append('is_delete',is_delete);
            formData.append('approve',false);
            formData.append('tags',JSON.stringify($("#tags").tagsinput('items')));
            onSubmit("#btnPublic",formData);
        });
        $("#btnApprove").on('click',function(e){
            var formData = new FormData($("#formAction")[0]);
            formData.set("post_content", quill.root.innerHTML);
            formData.append('uniqid',$('#formAction').attr('value'));
            formData.append('is_delete',is_delete);
            formData.append('approve',true);
            formData.append('tags',JSON.stringify($("#tags").tagsinput('items')));
            onSubmit("#btnApprove",formData);
        });
        if(datas.type=='update'){
            $("#category_id").val(datas.category_id);
            $("#category_id").trigger('change');
            $.each(datas.subMenus,function (index,item) {
                if(datas.category_id+""==item.id+""){
                    $("#category_id").val(item.cate_parentID);
                    $("#category_id").trigger('change');
                    $("#category_sub_id").val(datas.category_id);
                    $("#category_sub_id").trigger('change');
                }
            });
        }
        function onSubmit(buton,formData){
            $("#alertJS").empty();
            buttonloading(buton,true);
            $.ajax({
                url:(buton=='#btnPublic'?$("#formAction").attr('action'):$("#btnApprove").attr('value')),
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
                        }
                },
                error: function(er){
                    buttonloading(buton,false);
                    if(er.responseJSON.errors.post_content!=undefined){
                        $("#alertJS").html(alertJS(er.responseJSON.errors.post_content[0],'warning'));
                    }else{
                        $("#alertJS").empty();
                    }
                    if(er.responseJSON.errors.file_post_image!=undefined){
                        $("#alertJSUploadImg").html(alertJS(er.responseJSON.errors.file_post_image[0],'warning'));
                    }else{
                        $("#alertJSUploadImg").empty();
                    }
                    _showError(er,"#formAction");
                }
            });
        }
    }
}
