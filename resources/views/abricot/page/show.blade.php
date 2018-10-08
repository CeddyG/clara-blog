@extends('abricot/main')

@section('CSS')
    <style>
        .template-content-image img
        {
            width: 100%;
        }
    </style>
@stop

@section('breadcrumbs')
<aside id="colorlib-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12 breadcrumbs text-center">
                <h2>Page</h2>
                <p><span><a href="index.html">Home</a></span> / <span>{{ $oPage->page_category->name_page_category }}</span> / <span>{{ $oPage->title_page }}</span></p>
            </div>
        </div>
    </div>
</aside>
@stop

@section('content')
    {!! $oPage->content_page !!}
@stop
