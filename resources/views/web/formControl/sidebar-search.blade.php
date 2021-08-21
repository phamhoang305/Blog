<div class="card">
    <div class="card-header ">
        <h3 class="card-title">Tìm kiếm</h3>
      <!-- /.user-block -->
      <div class="card-tools">

        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
        </button>

      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body" >
        <form action="">
        <div class="row">

            <div class="col-md-12">
                <div class="form-group">
                    <select id="categoryParent" class="form-control">
                        <option value=""> - Chọn hình thức - </option>
                        @foreach (getMenu() as $item)
                                <option value="{{ $item->cate_slug }}">{{ $item->cate_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <select id="categoryChildren" class="form-control">
                        <option value=""> - Chọn dịch vụ -</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <select class="form-control">
                        <option value=""> - Chọn tỉnh thành - </option>
                        @foreach (getProvince() as $item)
                        <option value="{{$item->province_slug}}">{{ $item->province_name }}</option>
                        @endforeach


                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <select class="form-control">
                        <option value=""> - Quận huyện -</option>

                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <select class="form-control">
                        <option value=""> - Phường xã -</option>

                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <select class="form-control">
                        <option value=""> - Diễn tích -</option>

                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <select class="form-control">
                        <option value=""> - Mức giá -</option>

                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="input-group input-group">
                        <input type="text" placeholder="Tìm kiếm ... " class="form-control">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                      </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@section('runJS')
@parent
<script src="{{asset('assets/web/sidebar/sidebar_search.js')}}?v={{ time() }}"></script>
<script>
   var sidebar_search = new sidebar_search();
   sidebar_search.datas={
        dataCategorys:@json(getMenu())
   };
   sidebar_search.init();
</script>
@endsection

