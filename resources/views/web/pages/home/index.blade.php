@extends('layouts.web')
@section('web')
          <div class="content">
            <div class="container">
              <div class="row">
                <div class="col-lg-8">
                    @if (getAds('home_header'))
                    <div class="card">
                        <div class="card-body">
                        {!! getAds('home_header') !!}
                        </div>
                    </div>
                    @endif
                    <ul id="render-post-home" class="products-list product-list-in-card render-post-home">

                    </ul>
                    <div class="card-body text-center">
                        <button class="btn bg-dark btn-block" id="button-load-more" style="display: none">Xem thêm</button>
                    </div>
                    {{-- @include('web.formControl.product-list') --}}
                    @if (getAds('home_footer'))
                    <div class="card">
                        <div class="card-body">
                            {!! getAds('home_footer') !!}
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-lg-4 card-category">
                    @include('web.formControl.controlSidebar')
                </div>
              </div>
            </div>
          </div>
@endsection
@section("runJS")
<script src="{{asset('assets/web/home/home.js')}}?v={{uniqid()}}"></script>
@endsection
