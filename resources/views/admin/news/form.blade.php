@extends('admin/dashboard')

@section('CSS')
    <!-- Select 2 -->
    {!! Html::style('bower_components/select2/dist/css/select2.min.css') !!}

    <style>
        .select2
        {
            width: 100% !important
        }
        
        .input-group
        {
            width: 100% !important
        }
        
        .input-group-addon:hover
        {
            color: black;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <br>
            <div class="box box-info">	
                <div class="box-header with-border">
                    @if(isset($oItem))
                        <h3 class="box-title">Modification</h3>
                    @else
                        <h3 class="box-title">Ajouter</h3>
                    @endif
                </div>
                <div class="box-body"> 
                    <div class="col-sm-12">
                        @if(isset($oItem))
                            {!! BootForm::open()->action( route('admin.news.update', $oItem->id_news) )->put() !!}
                            {!! BootForm::bind($oItem) !!}
                        @else
                            {!! BootForm::open()->action( route('admin.news.store') )->post() !!}
                        @endif

                        
                        @if(isset($oItem))
                            {!! BootForm::select(trans('news-category.news_category'), 'fk_news_category')
                                ->class('select2')
                                ->options([$oItem->fk_news_category => $oItem->news_category->name_news_category])
                                ->data([
                                    'url-select'    => route('admin.news-category.select.ajax'), 
                                    'url-create'    => route('admin.news-category.create'),
                                    'field'         => 'name_news_category'
                            ]) !!}
                        @else
                            {!! BootForm::select(trans('news-category.news_category'), 'fk_news_category')
                                ->class('select2')
                                ->data([
                                    'url-select'    => route('admin.news-category.select.ajax'), 
                                    'url-create'    => route('admin.news-category.create'),
                                    'field'         => 'name_news_category'
                            ]) !!}
                        @endif

                        {!! BootForm::text(trans('news.title_new'), 'title_new') !!}
                        {!! BootForm::textarea(trans('news.text_news'), 'text_news')->addClass('ckeditor') !!}
                        
                        {!! BootForm::text(trans('news.url_image_news'), 'url_image_news') !!}

                        {!! BootForm::submit('Envoyer', 'btn-primary')->addClass('pull-right') !!}

                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
            <a href="javascript:history.back()" class="btn btn-primary">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
            </a>
        </div>
    </div>
@stop

@section('JS')
    <!-- Select 2 -->
    {!! Html::script('bower_components/select2/dist/js/select2.full.min.js') !!}
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').wrap('<div class="input-group input-group-select2"></div>');
            $( ".input-group-select2" ).each(function () {
                var url = $(this).find('.select2').attr(('data-url-create'));
                $(this).prepend('<a href="'+ url +'" target="_blank" class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></a>');
            });
            
            $('.select2').select2({
                ajax: {
                    url: function () {
                        return $(this).attr('data-url-select');
                    },
                    dataType: 'json',
                    delay: 10,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            field: $(this).attr('data-field'),
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data
                        params.page = params.page || 1;
                
                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count 
                }
                        };
                    },
                    cache: true
                },
                them: 'bootstrap'
            });
        } );
    </script> 

    {!! Html::script('bower_components/ckeditor/ckeditor.js') !!}
    
    <script>
        $(function () {
          // Replace the <textarea id="editor1"> with a CKEditor
          // instance, using default configuration.
          CKEDITOR.replace('.ckeditor');
        });
    </script>

@stop