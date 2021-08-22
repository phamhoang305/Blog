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
            $('.post-content').find('img').css('img-fluid img-thumbnail');
        });

    }
}
