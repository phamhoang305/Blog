<form id="formAction">
<div class="modal fade" id="addTestTestdetail" tabindex="-1" role="dialog" aria-labelledby="testdetailpleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTestTestdetailModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <div class="form-group">
                <label>Câu hỏi</label>
                <input name="title" id="title" type="text" placeholder="Tiêu đề ..." class="form-control form-control-sm"/>
                <input name="uniqid" id="uniqid" type="hidden" placeholder="" class="form-control form-control-sm"/>
                <input name="check_uniqid" id="check_uniqid" type="hidden" placeholder="" class="form-control form-control-sm"/>
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <div id="note_quill" class=""></div>
            </div>
            <div id="AlertJS"></div>
            <div class="form-group">
                <label>Câu trả lời</label>
                <div id="listItem">

                </div>
            </div>
            <div class="form-group">
                <button id="addButtonItem" type="button" class="btn btn-info btn-block">Thêm câu trả lời</button>
            </div>
            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" id="status"   placeholder="" class="form-control form-control-sm">
                        <option value="0">Bật</option>
                        <option value="1">Tắt</option>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="submit" id="buttonSaveData" data-url="" class="btn btn-primary">Lưu</button>
      </div>
    </div>
  </div>
</div>
</form>
<form id="import-data">
    <div class="modal fade" id="modalImportData" tabindex="-1" role="dialog" aria-labelledby="modalImportData" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Nhập excel</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                  <div class="form-group">
                      <input type="file" id="file-excel" name="file-excel" class="file-form-control"/>
                  </div>
                  <div class="form-group">
                    <div id="alert-import"></div>
                      <table class="table table-bordered table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 95%">Lỗi</th>
                                    <th style="width: 5%">Dòng</th>
                                </tr>
                            </thead>
                            <tbody id="htmlerror">
                                <tr><td colspan='2'>Không có lỗi nào</td></tr>
                            </tbody>
                        </table>

                  </div>
            </div>
            <div class="modal-footer">
              <button type="button"  class="btn btn-secondary" data-dismiss="modal">Hủy</button>
              <button type="button" id="buttonExportData" data-url="{{ route('admin.quiz.testdetail.export') }}" class="btn btn-info">Xuất</button>
              <button type="submit" id="buttonImportData" data-url="{{ route('admin.quiz.testdetail.import') }}" class="btn btn-success">Nhập </button>
            </div>
          </div>
        </div>
      </div>
</form>
<style>
    .file-form-control {
    display: block;
    width: 100%;
    /* height: calc(2.25rem + 2px); */
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    box-shadow: inset 0 0 0 transparent;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
</style>
