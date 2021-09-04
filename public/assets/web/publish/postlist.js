function postlist(){
    this.datas=null;
    this.showData =null;
    var showData =null;
    var uniqids = [];
    this.init=function(){
        showData = this.showData;
        var me = this;
        me.action();
    }
    this.idArray = function () {
		var array = [];
		var checkRow = $(".checkItem");
		$(checkRow).each(function (index, item) {
			if ($(item).is(":checked")) {
				array.push($(item).val());
			}
		});
        if(array.length>0){
            $(".showAction").show();
        }else{
            $(".showAction").hide();
        }
        $(".count").text(array.length)
		uniqids = array;
	};
    this.action=function(){
        var me = this;
        $(document).delegate('.btn-update','click',function(){
            var url = $(this).data('url');
            return window.location.href = url;
        });
        $(document).delegate('.btn-trash','click',function(){
            var uniqid = $(this).data('uniqid');
            var url = $(this).data('url');
            uniqids=[uniqid];
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn xóa không ?",
                data:{uniqids:JSON.stringify(uniqids),type:'trash','showData':showData},
                reload:true
            });
        });
        $(document).delegate('.btn-lock','click',function(){
            var uniqid = $(this).data('uniqid');
            var url = $(this).data('url');
            uniqids=[uniqid];
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn khóa bài viết này không ?",
                data:{uniqids:JSON.stringify(uniqids),type:'lock','showData':showData},
                reload:true
            });
        });
        $(document).delegate('.btn-unlock','click',function(){
            var uniqid = $(this).data('uniqid');
            var url = $(this).data('url');
            uniqids=[uniqid];
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn mở khóa bài viết này không ?",
                data:{uniqids:JSON.stringify(uniqids),type:'unlock','showData':showData},
                reload:true
            });
        });
        $(document).delegate('.btn-restore','click',function(){
            var uniqid = $(this).data('uniqid');
            var url = $(this).data('url');
            uniqids=[uniqid];
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn khôi phục lại bài viết này không ?",
                data:{uniqids:JSON.stringify(uniqids),type:'restore','showData':showData},
                reload:true
            });
        });
        $(document).delegate('.btn-delete','click',function(){
            var uniqid = $(this).data('uniqid');
            var url = $(this).data('url');
            uniqids=[uniqid];
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn xóa vĩnh viễn bài viết này không ?",
                data:{uniqids:JSON.stringify(uniqids),type:'delete','showData':showData},
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
        //// CHECK BOX
        $(document).delegate('.btn-trash-all','click',function(){
            var url = $(this).data('url');
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn xóa không ?",
                data:{uniqids:JSON.stringify(uniqids),type:'trash','showData':showData},
                reload:true
            });
        });
        $(document).delegate('.btn-lock-all','click',function(){
            var url = $(this).data('url');
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn khóa bài viết này không ?",
                data:{uniqids:JSON.stringify(uniqids),type:'lock','showData':showData},
                reload:true
            });
        });
        $(document).delegate('.btn-unlock-all','click',function(){
            var url = $(this).data('url');
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn mở khóa bài viết này không ?",
                data:{uniqids:JSON.stringify(uniqids),type:'unlock','showData':showData},
                reload:true
            });
        });
        $(document).delegate('.btn-restore-all','click',function(){
            var url = $(this).data('url');
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn khôi phục lại bài viết này không ?",
                data:{uniqids:JSON.stringify(uniqids),type:'restore','showData':showData},
                reload:true
            });
        });
        $(document).delegate('.btn-delete-all','click',function(){
            var url = $(this).data('url');
            _modalDelete({
                url:url,
                type:"POST",
                title:"Thông báo",
                body:"Bạn có muốn xóa vĩnh viễn bài viết này không ?",
                data:{uniqids:JSON.stringify(uniqids),type:'delete','showData':showData},
                reload:true
            });
        });
    }
}
