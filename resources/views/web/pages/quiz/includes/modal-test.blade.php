
    <div class="modal fade" id="modalTest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-full" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="testlistdetail-name">Xem trước</h5>
              <button type="button" class="close close_test">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" >
                    <div id="AlertJS"></div>
                    @isset($info)
                    @if ($info->testlist_minutes>0)
                        <table class="table table-bordered table-sm">
                            <tr><th class="text-center">Thời gian</th></tr>
                            <tr><th class="text-center text-white time-test"><span></span></th></tr>
                        </table>
                    @endif
                    @endisset
                    <div id="renderHtmlTestItemDetai" class="table-responsive"></div>
            </div>
            <div class="modal-footer">

                @isset($info)
                @if ($info->testlist_minutes>0)
                <button type="button"  class="btn btn-info time-test pull-left">00:00</button>
                @endif
                @endisset
                <button type="button"  class="btn btn-danger pull-right close_test" >Hủy</button>
                <button type="button" id="buttonSaveData"  class="btn btn-info pull-right" >Nộp bài</button>
            </div>
          </div>
        </div>
      </div>

