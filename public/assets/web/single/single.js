function single(){
    this.datas=null;
    var data = null;
    this.init=function () {
        var me = this;
        data =  me.datas;
        me.action();
    },
    this.action=function(){
        $(document).ready(function(){
            hljs.configure({languages: ['javascript','typescript', 'ruby', 'python','php','xml','dockerfile','css','scss','csharp','json','php-template','sql','swift']});
            contentDarkMode();
            $('.post-content').find('img').removeAttr('style');
            $('.post-content').find('img').removeAttr('width');
            $('.post-content').find('img').removeAttr('height');
            $('.post-content').find('img').addClass('img-fluid img-thumbnail');
            $("#formPassword").on('submit',function (e) {
                e.preventDefault();
                var btn = "#button-password";
                var url = $(this).attr('action');
                var formData = new FormData(this);
                buttonloading(btn,true);
                $.ajax({
                    url:url,
                    type: "POST",
                    data:formData,
                    dataType:'JSON',
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if(data.status=='success'){
                            return location.reload();
                        }else{
                            buttonloading(btn,false);
                            $("#alertJS").html(alertJS(data.msg,'danger'));
                        }
                    },error:function (error) {
                        buttonloading(btn,false);
                        $("#alertJS").html(alertJS("Hiện máy chủ không thực hiện được tác vụ này vui lòng thực hiện lại sau !",'danger'));
                    }
                });
            });
        });

    }
}
