function testlist(){
    this.datas=null;
    var datas = null;
    var Minutes = 0;
    var setinterval = null;
    this.init=function () {
        datas = this.datas;
        console.log(datas);
        var me = this;
        me.runAction();
        me.countdown();
    }
    this.runAction=function() {
        hljs.configure({languages: ['javascript','typescript', 'ruby', 'python','php','xml','dockerfile','css','scss','csharp','json','php-template','sql','swift']});
        function getData(){
            var array = [];
            $(".item-parent-data").each(function(index,item){
                var data = {
                    parentID:$(item).data("parent"),
                    childID:"",
                }
                var children = $(item).children().find(".item-check-data");
                // console.log(children);
                $(children).each(function(index,i){
                    if($(i).is(':checked')){
                        data.childID=$(i).data("child");
                    }
                });
                array.push(data);
            });
            // console.log(array);
            return array;
        }
        function saveData(array){
            console.log(array);
            var formData = new FormData();
            formData.append("test_listID",datas.test_listID);
            formData.append("result_test",JSON.stringify(array));
            buttonloading("#buttonSaveData",true);
            $.ajax({
                url:datas.saveTest,
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
                        return window.location.href = data.url;
                    }else if(data.status === 'error'){
                        buttonloading("#buttonSaveData",false);
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
                    buttonloading("#buttonSaveData",false);
                }
            });
        }
        function startTimer(inputMinutes, display) {
            if(parseInt(inputMinutes)<=0){
                return false;
            }else{
                Minutes = parseInt(inputMinutes)*60;
                var minutes = 0;
                var seconds = 0;
                setinterval =  setInterval(function () {
                    minutes = parseInt(Minutes / 60, 10);
                    seconds = parseInt(Minutes % 60, 10);
                    if(seconds%2==0){
                        $(display).css('background-color','rgb(159, 24, 24)')
                    }else{
                        $(display).css('background-color','rgb(24, 159, 150)')
                    }
                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;
                    $(display).html(minutes + ":" + seconds);
                    if (--Minutes < 0) {
                        Minutes = Minutes;
                        var datasend = getData();
                        saveData(datasend);
                        clearInterval(setinterval);
                    }

                }, 1000);
            }
        }
        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
              let j = Math.floor(Math.random() * (i + 1));
              let temp = array[i];
              array[i] = array[j];
              array[j] = temp;
            }
            return array;
        }
        var strArray=["A","B","C","D","E","F","G","H","J","K","L","M","N"];
        function renderTestDetailTest(data){
            var html='<div class="m2">';
            data = shuffle(data);
            $.each(data,function(index,value){
                html+='<div class="card"><div class="card-body"  style="border: solid 2px #108467;">';
                html+='<table class="table table-bordered table-sm " data-parent="'+value.uniqid+'" >';
                html += '<tr class="dark"><th colspan="3">Câu '+(index+1)+' : '+value.title+'</th></tr>';
                html+='</table>';
                html+='<div class="table-responsive">';
                    html+='<table class="table table-bordered table-sm" data-parent="'+value.uniqid+'" >';
                    if(value.note!="<p><br></p>"){
                        if(value.note!=null){
                            html += '<tr><th colspan="3">'+value.note+'</th></tr>';
                        }
                    }
                    html+='</table>';
                html+='</div>';
                var items = JSON.parse(value.item);
                html+='<table class="table table-bordered table-sm item-parent-data" data-parent="'+value.uniqid+'" >';
                if(items.length>0){
                    $.each((items),function(i,item){
                    html += '<tr>';
                        html += '<td class="text-center" style="width:5%;">'+strArray[i]+'</td>';
                        html += '<td class="text-center" style="width:5%;"><div class="icheck-success d-inline"><input type="radio" name="'+value.uniqid+'"  data-child="'+item.uniqid+'" id="'+item.uniqid+'"   class="item-check-data" ><label for="'+item.uniqid+'"></label></div></td>';
                        var td = document.createElement('td');
                        td.innerText = item.name;
                        html += td.outerHTML;
                     html += '</tr>';
                    });
                }
                html+='</table>';
                html+='</div></div>';
            });
            html+='</div>';
            $("#renderHtmlTestItemDetai").html(html);
            contentDarkMode();
        }
        $(document).delegate(".btn-test","click",function(){
                var r = confirm("Bạn có muốn làm bài không ?");
                var btn = this;
                if (r == true) {
                    buttonloading(btn,true);
                    $.ajax({
                        url:$(this).data('url'),
                        type:"POST",
                        data:{uniqid:$(btn).attr('data-uniqid')},
                        dataType:'JSON',
                        success:function(data){
                            $("#testlistdetail-name").html(data.testlist.testlist_name+" ("+data.count+")");
                            buttonloading(btn,false);
                            renderTestDetailTest(data.testdetails);
                            $("#modalTest").modal({ backdrop: 'static', keyboard: false });
                            startTimer(datas.testlist_minutes,".time-test");
                        },error:function(error){
                            buttonloading(btn,false);
                            $("#modalTest").modal({ backdrop: 'static', keyboard: false });
                            _modalError500(error);
                        }
                    });
                }
        });
        $("#buttonSaveData").on('click',function(){
            var r = confirm("Bạn có muốn nộp bài không ?");
            if(r){
                var datasend = getData();
                saveData(datasend);
            }
        });
        $(".close_test").on('click',function(){
            var r = confirm("Bạn có muốn hủy không ?");
            if(r){
                $("#modalTest").modal("hide");
                if(setinterval){
                    clearInterval(setinterval);
                }
            }
        });
        $(document).ready(function() {
            contentDarkMode();
        });
    }
    this.countdown=function(){

    }
}
