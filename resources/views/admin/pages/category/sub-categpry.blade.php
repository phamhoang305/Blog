@extends('layouts.admin')
@section('admin')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-list"></i>
                 Danh sách danh mục con
              </h3>
            </div>
            <div class="card-body">
                <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" id="select_category_id" name="select_category_id">
                                    <option value="">-- TẤT CẢ DANH MỤC --</option>
                                    @foreach (getMenu() as $item)
                                        <option  value="{{$item->id}}">{{$item->cate_name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" id="inputSearch" name="inputSearch"  placeholder="Tìm kiếm .... " class="form-control">
                                    <span class="input-group-append">
                                      <button type="button" id="buttonSearch" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                  </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button id="buttonShowModalAction"  class="btn btn-warning btn-block ">Thêm mới</button>
                            </div>

                        </div>


                  </div>
            </div>
            <!-- /.card -->
          </div>
          <div class="card card-info card-outline">

            <div class="card-body">
                <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <table id="runDatatable" class="table hover table-hover table-sm table-striped w-100">
                                </table>
                            </div>
                        </div>

                  </div>
            </div>
            <!-- /.card -->
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- ./row -->
    </div><!-- /.container-fluid -->
  </section>
@include('admin.pages.category.modal.subAction')
@endsection
@section('runJS')
@parent
<script src="{{asset('assets/admin/category/sub.js')}}?v={{ time() }}"></script>
<script>
   var sub = new sub();
    sub.data={
        route:{
            getDatatable:"{{route('admin.category.sub.datatable')}}",
            add:"{{route('admin.category.sub.add')}}",
            edit:"{{route('admin.category.sub.edit')}}",
            delete:"{{route('admin.category.sub.delete')}}",
        }
    },
    sub.init();
</script>
@endsection
