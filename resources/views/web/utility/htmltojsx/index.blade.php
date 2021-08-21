
@extends('layouts.web')
@section('web')
          <div class="content">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card card-dark ">
                        <div class="card-header">
                          <h3 class="card-title text-center">HTML TO JSX</h3>
                        </div>
                        <div class="card-body p-0">
                            <iframe id="page"  width="100%" data-url="{{ route('web.htmltojsx.page') }}"  style="border: none" class="btn-block"></iframe>
                        </div>
                        <div class="card-footer">
                            <a target="_blank" class="btn btn-outline-info " href="https://magic.reactjs.net/htmltojsx.htm">https://magic.reactjs.net/htmltojsx.htm</a>
                        </div>
                      </div>

                </div>
              </div>
            </div>
          </div>
@endsection
@section('runJS')
<script>
$(document).ready(function(){
        $.ajax({
        url:$("#page").data("url"),
        type: "POST",
        dataType:'html',
        success: function(data){
                $("#page").attr("srcdoc", data);
                setTimeout(function(){
                    var the_height = $('#body').contents().find('body')[0];
                    // console.log(the_height);
                    $("#page").attr("height",the_height);
                },300)
                $("#page").attr("height", $(document).height());
        },
        error: function(er){
        }
    });
})
</script>
@endsection
