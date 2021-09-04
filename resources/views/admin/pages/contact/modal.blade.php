<div class="modal fade" id="viewMailDetail" tabindex="-1" role="dialog" aria-labelledby="viewMailDetail" aria-hidden="true">
    <div class="modal-dialog modal-g" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Xem chi tiết</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="">Họ tên</label>
                <input class="form-control form-control-sm" readonly id="full_name"/>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input class="form-control form-control-sm" readonly id="email"/>
            </div>
            <div class="form-group">
                <label for="">Nội dung</label>
                <div id="body">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
          <button type="button" id="ButtonReply" class="btn btn-primary">Trả lời</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewMailReply" tabindex="-1" role="dialog" aria-labelledby="viewMailDetail" aria-hidden="true">
    <div class="modal-dialog modal-g" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Xem chi tiết</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="AlertJSReply"></div>
            <div class="form-group">
                <label for="">Email</label>
                <input class="form-control form-control-sm"  id="email_Reply"/>
            </div>
            <div class="form-group">
                <label for="">Tiêu đề</label>
                <input class="form-control form-control-sm" value="PHẢN HỒI LIÊN HỆ "  id="subject_Reply"/>
            </div>
            <div class="form-group">
                <label for="">Nội dung</label>
                <div id="body_Reply">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
          <button type="button" data-url="{{route('admin.contact.replyAjax')}}" id="ButtonSentReply" class="btn bg-navy">Gủi Mail</button>
        </div>
      </div>
    </div>
  </div>
