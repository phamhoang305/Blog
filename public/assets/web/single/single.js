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
            if($('body').hasClass('dark-mode')){
                $('.post-content').find('a').css('color','rgb(96 224 218)');
                $('.post-content').find('p').css('color','whitesmoke');
                $('.post-content').find('font').css('color','whitesmoke');
                $('.post-content').find('ul').css('color','whitesmoke');
                $('.post-content').find('li').css('color','whitesmoke');
                $('.post-content').find('h1').css('color','whitesmoke');
                $('.post-content').find('h2').css('color','whitesmoke');
                $('.post-content').find('h3').css('color','whitesmoke');
                $('.post-content').find('h5').css('color','whitesmoke');
                $('.post-content').find('h6').css('color','whitesmoke');
                $('.post-content').find('table tr').css('color','whitesmoke');
                $('.post-content').find('table tr th').css('color','whitesmoke');
                $('.post-content').find('table tr td').css('color','whitesmoke');
                $('.post-content').find('th span').css('color','whitesmoke');
                $('.post-content').find('td span').css('color','whitesmoke');
                $('.post-content').find('td p').css('color','whitesmoke');
                $('.post-content').find('td p font').css('color','whitesmoke');
            }
        });

    }
}
