
@extends('layouts.web')
@section('web')
          <div class="content">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                    <div class="card card-dark ">
                        <div class="card-header">
                          <h3 class="card-title text-center">File to Base64</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>File</label>
                                <input class="file-form-control" name="filetobase64" type="file" />
                            </div>
                            <div class="form-group">
                                <label>Base64</label>
                                <textarea rows="15" class="form-control" id="base64"></textarea>
                                <button disabled type="button" id="btn-copy" class="btn btn-info mt-1">Sao chép</button>
                                <button type="button" id="btn-clear" class="btn btn-danger mt-1">Xóa</button>
                            </div>
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
    $("input[name='filetobase64']").on('change',function(evt){
        var f = evt.target.files[0];
        if (f) {
            var reader = new FileReader();
            var Type = f.type;
            reader.onload = (function(theFile) {
            return function(e) {
                var binaryData = e.target.result;
                var base64String = window.btoa(binaryData);
                document.getElementById('base64').value = "data:"+Type+";base64,"+base64String;
                $("#btn-copy").prop('disabled',false);
            };
            })(f);
            reader.readAsBinaryString(f);
        }
    });
    $("#btn-clear").on('click',function(){
        $("input[name='filetobase64']").val(null);
        var copyText = document.getElementById("base64");
        copyText.value = null;
        $("#btn-copy").prop('disabled',true);
    });
    $("#btn-copy").on('click',function(){
        var copyText = document.getElementById("base64");
        copyText.select();
        copyText.setSelectionRange(0, copyText.value.length);
        navigator.clipboard.writeText(copyText.value);
    });
})
</script>
@endsection
