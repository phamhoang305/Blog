@extends('layouts.web')
@section('web')
<!-- Main content -->
<div class="content">
    <div class="container ">
        @include('web.formControl.top-authors',['_topAuthors'=>$topAuthors, 'headerTopAuth'=>true,'footerTopAuth'=>true])
    </div>
</div>
@endsection
