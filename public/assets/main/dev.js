var optionDelete ={
	title:"Thông báo",
	body:"Có chắc chắn muốn xóa không !",
	textCancel:"Hủy bỏ",
	textConfirm:"Xắc nhận",
	method:'POST',
	url:'',
	data:{},
	table:null,
    emptyEL:null,
    removeEL:null,
    reload:false
}
function merge(a, b) {
	return $.merge($.merge([], a), b);
}
function numberSeparator(Number) {
	var commaCounter = 10;
	Number += '';
	for (var i = 0; i < commaCounter; i++) {
		Number = Number.replace(',', '');
	}

	x = Number.split('.');
	y = x[0];
	z = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;

	while (rgx.test(y)) {
		y = y.replace(rgx, '$1' + ',' + '$2');
	}
	commaCounter++;
	return y + z;
}
function _modalDelete(obj) {
    console.log(obj);
	if(obj!=undefined){
		if(obj.title!=undefined){
			optionDelete.title = obj.title;
		}
		if(obj.body!=undefined){
			optionDelete.body = obj.body;
		}
		if(obj.textCancel!=undefined){
			optionDelete.textCancel = obj.textCancel;
		}
		if(obj.textConfirm!=undefined){
			optionDelete.textConfirm = obj.textConfirm;
		}
		if(obj.method!=undefined){
			optionDelete.method = obj.method;
		}
        if(obj.type!=undefined){
			optionDelete.method = obj.type;
		}
		if(obj.url!=undefined){
			optionDelete.url = obj.url;
		}
		if(obj.data!=undefined){
			optionDelete.data = obj.data;
		}
		if(obj.table!=undefined){
			optionDelete.table = obj.table;
		}
        if(obj.removeEL!=undefined){
			optionDelete.removeEL = obj.removeEL;
		}
        if(obj.emptyEL!=undefined){
			optionDelete.emptyEL = obj.emptyEL;
		}
        if(obj.reload!=undefined){
            optionDelete.reload = obj.reload;
        }
		if(optionDelete.url==''){
			$("#errorAlert").remove();
			var html='<div class="alert alert-danger" id="errorAlert">'
				html+='<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>';
				html+='Chưa có data ! _modalDelete({..})';
			html+='</div>';
			$("#delete-body").prepend(html);
			$("#modalDelete").modal('show');
		}else{
			$("#delete-title").html(optionDelete.title);
			$("#delete-body").html(optionDelete.body);
			$("#delete-button-cancel").html(optionDelete.textCancel);
			$("#delete-button-confirm").html(optionDelete.confirm);
			$("#modalDelete").modal('show');
		}
	}else{
		alert("Chưa có data ! _modalDelete({..})");
		return;
	}

}
function _modalError500(error){
	console.log(error);
	$("#errorAlert").remove();
	if(error.responseJSON.message==''){
		error.responseJSON.message = error.statusText
	}
	var html='<div class="alert alert-danger" id="errorAlert">'
		html+='<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>';
		html+=error.responseJSON.message;
	html+='</div>';
	$(".modal-body").prepend(html);
}
function _buttonActionDropdown(data){

	var htmlButton='<div class="btn-group ">';
		htmlButton+='<button data-toggle="dropdown" class="btn btn-info btn-white dropdown-toggle" aria-expanded="true">	<i class="fa fa-cog"></i></button>';
		htmlButton+='<ul class="dropdown-menu dropdown-info dropdown-menu-right">';
			 $.each(data,function(index,item){
				if(item.icon==undefined){
					item.icon = '';
				}
				if(item.title==undefined){
					item.title = item.text;
				}
                htmlButton+='<li><button class="btn btn-xs btn-block  '+item.class+'" '+item.attr+'  value="'+item.value+'" title="'+item.title+'">'+item.icon+'&nbsp;'+item.text+'</button></li>';
            });
		htmlButton+='</ul>';
	 htmlButton+='</div>';
    return htmlButton;
}
function _buttonActionButton(data){
		var htmlButton='<div class="btn-group">'
			 $.each(data,function(index,item){
				if(item.icon==undefined){
					item.icon = '';
				}
				if(item.text==undefined){
					item.text = '';
				}
				if(item.title==undefined){
					item.title = item.text;
				}
				htmlButton+='<button class="btn btn-xs  '+item.class+'" '+item.attr+'  value="'+item.value+'" title="'+item.title+'">'+item.icon+'&nbsp;'+item.text+'</button></li>';
			 });
		htmlButton+='</div>';
		return htmlButton;
}
function _showError(er,form){
	if(form==undefined){form ="";}
	$(".is-invalid").addClass('is-valid');
	$(".is-invalid").removeClass('is-invalid');
	$(".invalid-feedback").remove();
	if(er.status==422 ){
		var errors = er.responseJSON.errors;
		$.each(errors,function(key,value){
			var input = 	$(form+" input[name="+key+"]");
			var textarea = 	$(form+" textarea[name="+key+"]");
			var select = 	$(form+" select[name="+key+"]");
			if(input){
				input.addClass('is-invalid');
				if(input.parent('.form-group')){
					input.parent('.form-group').append('<span  class="error invalid-feedback"><i class="far fa-times-circle"></i> '+value[0]+'</span>');
				}
				if(input.parent('.input-group').parent('.form-group')){
					input.parent('.input-group').parent('.form-group').append('<span  class="error invalid-feedback"><i class="far fa-times-circle"></i> '+value[0]+'</span>');
				}

			}else{
				$(input).removeClass('is-invalid');
			}
			if(textarea){
				textarea.addClass('is-invalid');
				if(textarea.parent('.form-group')){
					textarea.parent('.form-group').append('<span  class="error invalid-feedback"><i class="far fa-times-circle"></i> '+value[0]+'</span>');
				}else if(textarea.parent('.input-group').parent('.form-group')){
					textarea.parent('.input-group').parent('.form-group').append('<span  class="error invalid-feedback"><i class="far fa-times-circle"></i> '+value[0]+'</span>');
				}
			}else{
				$(textarea).removeClass('is-invalid');
			}
			if(select){
				select.addClass('is-invalid');
				if(select.parent('.form-group')){
					select.parent('.form-group').append('<span  class="error invalid-feedback"><i class="far fa-times-circle"></i> '+value[0]+'</span>');
				}else if(select.parent('.input-group').parent('.form-group')){
					select.parent('.input-group').parent('.form-group').append('<span  class="error invalid-feedback"><i class="far fa-times-circle"></i> '+value[0]+'</span>');
				}
			}else{
				$(select).removeClass('is-invalid');
			}
		});
	}
}
function reloadTable(e){
    if(e!=undefined){
        $(e).DataTable().ajax.reload();
    }
}
function buttonloading(e, type) {
    if (type == true) {
        console.log(type);
		if (!$(e).children("span").hasClass("loadding")) {
			$(e).attr("disabled", type);
            $(e).prepend('<span  class="loadding spinner-border spinner-border-sm mr-1"></span>');
			$(e).children('i').hide();
		}
	} else {
        console.log(type);

		if ($(e).children("span").hasClass("loadding")) {
			$(e).children("span").remove();
			$(e).attr("disabled", type);
			$(e).children('i').show();
		}
	}
}
function LangDataTable() {
	return {
		loadingRecords: "Đang tải ....",
		sProcessing: "<img style='width:50px; height:50px;' src='" + url_loading + "'/>",
		sLengthMenu: "Xem _MENU_ mục",
			sZeroRecords: "Không tìm thấy dòng nào phù hợp",
			sInfo: "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
			sInfoEmpty: "Đang xem 0 đến 0 trong tổng số 0 mục",
			sInfoFiltered: "(được lọc từ _MAX_ mục)",
			sInfoPostFix: "",
			sSearch: "Tìm:",
			sUrl: "",
			oPaginate: {
				sFirst: "Đầu",
				sPrevious: "Trước",
				sNext: "Tiếp",
				sLast: "Cuối",
			},
	};
}
// $.extend(true, $.fn.dataTable.defaults, {
// 	language: LangDataTable()
// });
function echo(e){
    if(e==null||e==''){
        return '';
    }else{
        return e;
    }
}
var Lang = 'vi';
var dateRangePickerLocale = Lang == "en"?{
		format: "DD-MM-YYYY",
		customRangeLabel: "Custom",
		applyLabel: "Select",
		cancelLabel: "Delete",
}:{
		format: "DD-MM-YYYY",
		customRangeLabel: "Tùy Chọn",
		applyLabel: "Chọn",
		cancelLabel: "Xóa",
};
function daterange(daterange,dateBegin,dateEnd,type){

	var begin = moment(moment().startOf(type)).format("YYYY-MM-DD");
	var end = moment(moment().endOf(type)).format("YYYY-MM-DD");
	$(dateBegin).val(begin);
	$(dateEnd).val(end);
	$(daterange).daterangepicker({
		ranges   : {
			// 'Từ trước đến nay'  : ['', ''],
			'Tháng này'  : [moment().startOf('month'), moment().endOf('month')],
			'Tháng trước'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
			'Hôm nay'       : [moment(), moment()],
			'Hôm qua'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'7 Ngày qua' : [moment().subtract(6, 'days'), moment()],
			'30 ngày trước': [moment().subtract(29, 'days'), moment()],
			'Năm nay'  : [moment().startOf('year'), moment().endOf('year')],
			'Năm trước'  : [moment().subtract(1, 'year').startOf('year'),moment().subtract(1, 'year').endOf('year')],
		},
		locale: dateRangePickerLocale,
		startDate: moment(moment().startOf(type), "DD-MM-YYYY"),
		endDate: moment(moment().endOf(type), "DD-MM-YYYY"),
		language:Lang,
	},
	function (start, end,label) {
		$(".daterangepicker_label").val(label);
		if(start._isValid==false||end._isValid==false){
			$(daterange).attr('readonly',true);
			$(dateBegin).val("");
			$(dateEnd).val("");
		}else{
			$(dateBegin).val(start.format("YYYY-MM-DD"));
			$(dateEnd).val(end.format("YYYY-MM-DD"));
			$(daterange).attr('readonly',false);
		}
	}
   );
}
// daterange('#daterange','#dateBegin','#dateEnd',show_data);
function input_money_format(e) {
    $(e).val($(e).val().replace(/\D/gm, ""));
    var val = $(e).val().split(",").join("");
    e.value = val.toString().split(/(?=(?:\d{3})+(?:\.|$))/g).join(",");
}
function money_format_to_number(e) {
if(e==null||e==''){
	return '';
}else{
	return parseFloat(e.toString().replace(/,/g, ""));
}
}
function money_format(e) {

    if(e==null||e==''){
        return '';
    }else{
        return e.toString().split(/(?=(?:\d{3})+(?:\.|$))/g).join(",");
    }
}
var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
function thongbao(icon,messages){
    Toast.fire({
        icon: icon,
        title:messages
    });
}
function null_to_number(e){
    if(e==null||e=='null'){
        return 0;
    }else{
        return e;
    }
}
function init_tinymce(selector, min_height) {
	var menu_bar = "file edit view insert format tools table image help";
	if (selector == ".tinyMCEQuiz") {
		menu_bar = false;
	}
	tinymce.init({
		selector: selector,
        min_height: min_height,
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
function changeDarkMode(url,type){
    $.ajax({
        url:url,
        type:'POST',
        dataType:'JSON',
        data:{type:type},
        success:function(data){
            if('web.posts.index'==isDarkMode){
                return location.reload();
            }else{
                if(type=='on'){
                    $("#bodyClass").addClass('dark-mode');
                }else{
                    $("#bodyClass").removeClass('dark-mode');
                }
            }
        },error:function(error){

        }
    });
}
function readImage(inputElement) {
	console.log(inputElement);
    var deferred = $.Deferred();
    var files = inputElement.get(0).files;
    if (files && files[0]) {
        var fr = new FileReader();
        fr.onload = function (e) {
            deferred.resolve(e.target.result);
        };
        fr.readAsDataURL(files[0]);
    } else {
        deferred.resolve(undefined);
    }
    return deferred.promise();
}
function setImgSRC(InputFile, img) {
    readImage($(InputFile)).done(function (base64Data) {
        $(img).attr('src', base64Data);
    });
}
function setImgAttr(InputFile, elm) {
    readImage($(InputFile)).done(function (base64Data) {
        $(elm).attr('style',"background-image: url("+base64Data+")");
    });
}
function colorStatus(e){

    if(e=='1') return "text-primary";
    if(e=='2') return "text-danger";
    if(e=='3') return "text-done";
    return "";
}
function alertJS(message,type) {
    var alerthtml = '<div class="alert alert-'+type+' text-small alert-dismissible" role="alert">';
    alerthtml += '' + message + '';
    alerthtml += '<button type="button" class="close" style="color:#fff" data-dismiss="alert" aria-label="Close">';
    alerthtml += '<span style="color:#fff" aria-hidden="true">&times;</span>';
    alerthtml += '</button>';
    alerthtml += '</div>'
    return alerthtml;
}
function removeEL() {
    if(optionDelete.removeEL!=null){
        $(optionDelete.removeEL).remove();
    }
}
function emptyEL() {
    if(optionDelete.emptyEL!=null){
        $(optionDelete.emptyEL).empty();
    }
}
function reloadPage() {
    if(optionDelete.reload==true){
        location.reload();
    }
}
contextLoader={};
contextLoader.htmlContent='<div style="margin:3px;" class="timeline-item"><div class="animated-background"><div class="background-masker header-top"></div><div class="background-masker header-left"></div><div class="background-masker header-right"></div><div class="background-masker header-bottom"></div><div class="background-masker subheader-left"></div><div class="background-masker subheader-right"></div><div class="background-masker subheader-bottom"></div><div class="background-masker content-top"></div><div class="background-masker content-first-end"></div><div class="background-masker content-second-line"></div><div class="background-masker content-second-end"></div><div class="background-masker content-third-line"></div><div class="background-masker content-third-end"></div></div></div>';
contextLoader.addLoader = function(theDiv,count){
	var htmlLoader="";
	if(count==undefined||count==-1){
		count = 1;
	}
	if(count==undefined||count==-1){
		count = 100;
	}
	for(i=1;i<=count;i++){
		htmlLoader+=contextLoader.htmlContent;
	}
	document.querySelector(theDiv).innerHTML = htmlLoader;
}
if($("div").hasClass("listLoading")) {
    contextLoader.addLoader('.listLoading',parseInt($(".listLoading").attr('data-count')));
}
$(document).ready(function() {
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } });
    $(document).delegate(".btn-show-login",'click',function(){
        $("#modalLogin").modal('show');
    });
    $(".mytooltip").tooltip();
    $("#formLogin").on('submit',function(e){
        var formData = new FormData(this);
        e.preventDefault();
        $("#alertJS").empty();
        buttonloading("#buttonLogin",true);
        $.ajax({
            url:$("#buttonLogin").attr('data-url'),
            type: "POST",
            data:formData,
            dataType:'JSON',
            processData: false,
            contentType: false,
            success: function(data){
                if(data.status === 'success'){
                        buttonloading("#buttonLogin",false);
                        return location.reload();
                }else if(data.status === 'error'){
                        buttonloading("#buttonLogin",false);
                        $("#alertJS").html(alertJS(data.msg,'danger'));
                }else{
                        buttonloading("#buttonLogin",false);
                        $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng nhập!",'danger'));
                    }
            },
            error: function(er){
                    buttonloading("#buttonLogin",false);
                    $("#alertJS").html(alertJS("Máy chủ không thể thực hiện đăng nhập!",'danger'));
            }
        });
    });
    $('.count').each(function () {
        $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
        }, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
                    $(this).text(Math.ceil(now));
            }
        });
    });
	var pathname = window.location.href;
    console.log(pathname);
    var elmParent =  $('.nav-sidebar > .nav-item  > a[href="'+pathname+'"]');
    elmParent.addClass('active');
    console.log(elmParent);
    var elmParent =  $('.nav-treeview > .nav-item > a[href="'+pathname+'"]');
    elmParent.addClass('active')
    elmParent.parents('.has-treeview').children().addClass('active')
    elmParent.parents('.has-treeview').addClass('active menu-open')
    elmParent.parent().parent().attr('style','display: block;').parent().addClass('active');
    elmParent.addClass('active ');
	$("#delete-button-confirm").on('click',function(){
		buttonloading('#delete-button-confirm',true);
		$.ajax({
			url:optionDelete.url,
			type:optionDelete.method,
			dataType:'JSON',
			data:optionDelete.data,
			success:function(data) {
				buttonloading('#delete-button-confirm',false);
				if(data.status=='success'){
                    reloadTable(optionDelete.table);
					$("#modalDelete").modal('hide');
					Toast.fire({
                        icon: data.status,
                        title: data.msg
                    });
                    emptyEL();
                    removeEL();
                    reloadPage();
				}else if(data.status=='error'){
					Toast.fire({
                        icon: data.status,
                        title: data.msg
                    });
				}
			},error:function(error){
				console.log(error);
				buttonloading('#delete-button-confirm',false);
				_modalError500(error);
			}
		});
	});
    $(".button-logout").on('click',function(e){
        e.preventDefault();
		$.ajax({
			url:$(this).attr('href'),
			type:'GET',
			dataType:'JSON',
			success:function(data) {
                location.reload();
			},error:function(error){
                alert("Not logout !")
			}
		})
	});
	$("#changeDarkMode").on('click',function(){
		var type = $(this).attr('data-darkmode');
		var url = $(this).attr('data-url');
		$(this).attr('data-darkmode',type=='on'?'off':'on');
        changeDarkMode(url,type);
	});
    $(document).delegate(".btn-addFollows",'click',function(){
        var button = this;
        var url = $(this).data('url');
        var id = $(this).val();
        var event = $(this).data('event');
        var data={
            button:button,
            url:url,
            id:id,
            event:event
        }
        buttonloading(data.button,true);
        $.ajax({
            url:data.url,
            type:'POST',
            dataType:'JSON',
            data:{id:data.id},
            success:function(res){
                if(res.status=='success'){
                    $(".removeFollows"+data.id).show();
                    $(".addFollows"+data.id).hide();
                    $("#follow-"+data.id).text(res.data.CountFollows);
                    $("#following-"+res.data.auth.id).text(res.data.auth.CountFollowing);
                    buttonloading(data.button,false);
                }else{
                    buttonloading(data.button,false);
                }
            },error:function(er){
                buttonloading(data.button,false);
            }
        });
    });
    $(document).delegate(".btn-removeFollows",'click',function(){
        var button = this;
        var url = $(this).data('url');
        var id = $(this).val();
        var event = $(this).data('event');
        var data={
            button:button,
            url:url,
            id:id,
            event:event
        }
        buttonloading(data.button,true);
        $.ajax({
            url:data.url,
            type:'POST',
            dataType:'JSON',
            data:{id:data.id},
            success:function(res){
                if(res.status=='success'){
                    $(".removeFollows"+data.id).hide();
                    $(".addFollows"+data.id).show();
                    $("#follow-"+data.id).text(res.data.CountFollows);
                    $("#following-"+res.data.auth.id).text(res.data.auth.CountFollowing);
                    buttonloading(data.button,false);
                    if(data.event=='remove'){
                        setTimeout(function() {
                            location.reload();
                            $("#itemAuthID"+data.id).remove();
                        },500);
                    }
                }else{
                    buttonloading(data.button,false);
                }
            },error:function(er){
                buttonloading(data.button,false);
            }
        });

    });
    setTimeout(function () {
        $(".is767").removeClass('d-none');
    },1000)
    if(typeof Lazy === "function"){
        $('img').Lazy({
            successLoader: function(element, response) {
                response(true);
            },
            errorLoader: function(element, response) {
                response(false);
            }
        });
    }
    mybutton = document.getElementById("back-to-top");
    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
    $("#back-to-top").on('click',function(){
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    });
    var loadhome = false;
    if($('ul').hasClass("render-post-home")){loadhome = true;$("#button-load-more").hide()}
    function showDone(){
        $(".listLoading,.search_loading,.skeleton,.single_loading").remove();
        $(".listLoadingDone,.post-content,.search_loadingDone,.single_loadingDone").slideDown('show');
    }
    if($('div').hasClass("controlSidebar")){
        contextLoader.addLoader('.search_loading',1);
        contextLoader.addLoader('#randomPosts,#postTopView,#tags,#authors,#sameCategory',3);
        if(loadhome){ contextLoader.addLoader('#render-post-home',10);}
        $.ajax({
            url:url_widget,
            type:'GET',
            data:{
                _postID:$.trim(_postID),
                _cate_slug:$.trim(_cate_slug),
                _loadhome:loadhome
            },
            dataType:'JSON',
            success:function(data){
                $("#sameCategory").html(data.sameCategory);
                $("#randomPosts").html(data.randomPosts);
                $("#postTopView").html(data.postTopView);
                $("#tags").html(data.tags);
                $("#authors").html(data.authors);
                $("#render-post-home").html(data.posthome);
                $("#button-load-more").show()
                showDone();
                $(".product-description").tooltip();
            },error:function(error){
                 console.log(error);
            }
        });
    }else{
        showDone();
    }
    var colors = ['#20c997','#20c997','#e83e8c','#dc3545',];
    $('.text-sm .main-header .nav-link,.bg-rand').mouseenter(function() {
        var rand = colors[Math.floor(Math.random() * colors.length)];
        $(this).css('background-color', rand);
    });
    $('.text-sm .main-header .nav-link,.bg-rand').mouseleave(function() {
        $(this).css('background-color', '');
    });

});
function toSlug(title)
{
    var  slug;
   //Lấy text từ thẻ input title
   //Đổi chữ hoa thành chữ thường
   slug = title.toLowerCase();

   //Đổi ký tự có dấu thành không dấu
   slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
   slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
   slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
   slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
   slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
   slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
   slug = slug.replace(/đ/gi, 'd');
   //Xóa các ký tự đặt biệt
   slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
   //Đổi khoảng trắng thành ký tự gạch ngang
   slug = slug.replace(/ /gi, "-");
   //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
   //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
   slug = slug.replace(/\-\-\-\-\-/gi, '-');
   slug = slug.replace(/\-\-\-\-/gi, '-');
   slug = slug.replace(/\-\-\-/gi, '-');
   slug = slug.replace(/\-\-/gi, '-');
   //Xóa các ký tự gạch ngang ở đầu và cuối
   slug = '@' + slug + '@';
   slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    return slug;
}
function createYoutubeEmbed  (key){
    return '<iframe  src="https://www.youtube.com/embed/' + key + '" frameborder="0" uk-video="automute: true" allowfullscreen uk-responsive></iframe>';
}
function transformYoutubeLinks  (text){
    if (!text) return text;
    const self = this;
    const linkreg = /(?:)<a([^>]+)>(.+?)<\/a>/g;
    const fullreg = /(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)([^& \n<]+)(?:[^ \n<]+)?/g;
    const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([^& \n<]+)(?:[^ \n<]+)?/g;
    let resultHtml = text;
    // get all the matches for youtube links using the first regex
    const match = text.match(fullreg);
    if (match && match.length > 0) {
      // get all links and put in placeholders
      const matchlinks = text.match(linkreg);
      if (matchlinks && matchlinks.length > 0) {
        for (var i=0; i < matchlinks.length; i++) {
          resultHtml = resultHtml.replace(matchlinks[i], "#placeholder" + i + "#");
        }
      }
      // now go through the matches one by one
      for (var i=0; i < match.length; i++) {
        // get the key out of the match using the second regex
        let matchParts = match[i].split(regex);
        // replace the full match with the embedded youtube code
        resultHtml = resultHtml.replace(match[i], self.createYoutubeEmbed(matchParts[1]));
      }
      // ok now put our links back where the placeholders were.
      if (matchlinks && matchlinks.length > 0) {
        for (var i=0; i < matchlinks.length; i++) {
          resultHtml = resultHtml.replace("#placeholder" + i + "#", matchlinks[i]);
        }
      }
    }
    return resultHtml;
};

var colors = new Array(
    [62,35,255],
    [60,255,60],
    [255,35,98],
    [45,175,230],
    [255,0,255],
    [255,128,0]);

  var step = 0;
  //color table indices for:
  // current color left
  // next color left
  // current color right
  // next color right
  var colorIndices = [0,1,2,3];

  //transition speed
  var gradientSpeed = 0.002;

  function updateGradient()
  {

    if ( $===undefined ) return;
    var c0_0 = colors[colorIndices[0]];
    var c0_1 = colors[colorIndices[1]];
    var c1_0 = colors[colorIndices[2]];
    var c1_1 = colors[colorIndices[3]];
    var istep = 1 - step;
    var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
    var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
    var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
    var color1 = "rgb("+r1+","+g1+","+b1+")";
    var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
    var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
    var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
    var color2 = "rgb("+r2+","+g2+","+b2+")";
   $('.bg-color').css({
    background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
    background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});
    $('.color').css({color: color1})
    $('.border-color').css({color: '4px solid '+color1+';'})
    step += gradientSpeed;
    if ( step >= 1 )
    {
      step %= 1;
      colorIndices[0] = colorIndices[1];
      colorIndices[2] = colorIndices[3];
      //pick two new target color indices
      //do not pick the same as the current one
      colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
      colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length
    }
  }
setInterval(updateGradient,5);
function randomUuidv4(){return([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g,t=>(t^crypto.getRandomValues(new Uint8Array(1))[0]&15>>t/4).toString(16))}
function uuid(){return `${randomUuidv4()}-${Math.round(new Date().getTime() / 1000)}`;}
function contentDarkMode() {
    if($('body').hasClass('dark-mode')){
        var color = '#dbe4ec';
        $('.post-content').find('a').css('color','rgb(96 224 218)');
        $('.post-content').find('p,h1,h2,h3,h4,h5,h6,ul,li').css('color',color);
        $('.post-content').find('p span').css('color',color);
        $('.post-content').find('p font').css('color',color);
        $('.post-content').find('h1 span,h2 span,h3 span,h4 span,h5 span,h6 span,li span').css('color',color);
        $('.post-content').find('h1 strong,h2 strong,h3 strong,h4 strong,h5 strong,h6 strong,li strong').css('color',color);
        $('.post-content').find('h1 b,h2 b,h3 b,h4 b,h5 b,h6 b,li b').css('color',color);
        $('.post-content').find('h1 font,h2 font,h3 font,h4 font,h5 font,h6 font,li font').css('color',color);
        $('.post-content').find('h1 i,h2 i,h3 i,h4 i,h5 i,h6 i,li i').css('color',color);
        $('.post-content').find('table').removeAttr('style');
        $('.post-content').find('table').addClass('table hover table-bordered table-hover table-sm table-striped w-100');
        $('.post-content').find('table tr').removeAttr('style');
        $('.post-content').find('table tr th').removeAttr('style');
        $('.post-content').find('table tr td').removeAttr('style');
        $('.post-content').find('table tr').css('color',color);
        $('.post-content').find('table tr th').css('color',color);
        $('.post-content').find('table tr td').css('color',color);
        $('.post-content').find('table th span').css('color',color);
        $('.post-content').find('table td span').css('color',color);
        $('.post-content').find('table td p').css('color',color);
        $('.post-content').find('table td p font').css('color',color);
        $('.post-content').find('pre').css('background-color','#121416;');
    }
}
