@extends('layouts.myContent')
@section('web')
          <div class="content">
            <div class="container-fulld card-category">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header p-2 ">
                            <h3 class="card-title text-center">Bài viết chưa duyệt</h3>
                        </div>
                        <div class="card-body">
                            @include('web.pages.my-content.includes.formSearch')
                            @include('web.pages.my-content.includes.list-post')
                        </div>
                    </div>
                </div>
            </div>
          </div>
@endsection

