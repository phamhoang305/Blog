<form id="formAction">
<div class="modal fade" id="addTestCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTestCategoryModalLabel">Thêm danh mục</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div id="AlertJS"></div>
            <div class="form-group">
                <label>Tên danh mục</label>
                <input name="name" id="name" type="text" placeholder="Tên ..." class="form-control form-control-sm"/>
                <input name="uniqid" id="uniqid" type="hidden" placeholder="Tên ..." class="form-control form-control-sm"/>
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <input name="des" id="des" type="text"  placeholder="Mô tả ..." class="form-control form-control-sm"/>
            </div>
            <div class="form-group">
                <label>Sắp xếp</label>
                <input name="order" type="number" id="order" class="form-control form-control-sm"/>
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
