<form id="formAction">
<div class="modal fade" id="parentAction" tabindex="-1" role="dialog" aria-labelledby="parentActionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="parentActionLabel">Thêm danh mục</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

                <div class="card card-success card-outline ">
                    <div class="card-body box-profile changerimg text-center"  >
                        <label class="" for="file_cate_icon" >
                            <img title="Chọn hình ảnh" width="60" width="60" class="profile-user-img img-fluid img-circle icon_review" id="icon_review"  src="" alt="">
                            <input type="file" name="file_cate_icon" id="file_cate_icon" class="d-none">
                            <h3 class="profile-username text-center "><b class="text_fullname">ICON</b></h3>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div id="AlertJS"></div>
                </div>
                <div class="form-group">
                    <label for="cate_name" class="col-form-label">Tiêu đề</label>
                    <input type="text" class="form-control form-control-sm" name="cate_name" id="cate_name">
                </div>
                <div class="form-group">
                    <label for="cate_order" class="col-form-label">Sắp xếp</label>
                    <input type="number" min="1" max="100" class="form-control form-control-sm" name="cate_order" id="cate_order">
                </div>
                <div class="form-group">
                    <label for="cate-des" class="col-form-label">Mô tả</label>
                    <textarea class="form-control form-control-sm" name="cate-des" id="cate-des"></textarea>
                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">HỦy</button>
          <button type="submit" id="buttonSaveData" class="btn btn-primary">Lưu</button>
        </div>
      </div>
    </div>
  </div>
</form>
