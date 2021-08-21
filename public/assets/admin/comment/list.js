function comment(){
    this.datas=null;
    this.showData =null;
    var showData =null;
    var idArray = [];
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
        $(".count").text(array.length);
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
                body:"Bạn có muốn xóa bình luận này không ?",
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
                body:"Bạn có muốn xóa bình luận này không ?",
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
    }
}
