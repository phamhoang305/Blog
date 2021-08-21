@extends('layouts.admin')
@section('admin')
          <div class="content">
            <div class="container-fulld card-category">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center">Bài viết công bố</h3>
                        </div>
                        <div class="card-body">
                            @include('admin.pages.post.includes.formSearch')
                            @include('admin.pages.post.includes.list')
                        </div>
                    </div>

                </div>
            </div>
          </div>
@endsection
