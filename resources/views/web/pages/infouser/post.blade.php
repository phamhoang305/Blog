@extends('layouts.profile')
@section('web')

<section class="content ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('web.pages.infouser.includes.info')
            </div>
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        @include('web.pages.infouser.includes.menu',['menuType'=>'posts','user'=>$user])
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        @include('web.pages.posts.includes.post-item')
                    </div>
                <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
          <!-- /.card -->
        </div>
    </div>
</section>
@endsection
