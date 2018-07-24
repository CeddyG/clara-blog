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
        
        #line-template
        {
            height: 200px;
        }
        
        .template
        {
            width: 200px;
            height: 150px;
            
            margin: 20px;
            opacity: 0.7;
            z-index: 10;
        }
        
        #content-zone
        {
            min-height: 500px;
        }
        
        #content-zone .row
        {
            min-height: 200px;
            margin: 15px 0;
            background-color: #001F3F;
            
            opacity: 0.7;
        }
        
        #content-zone .col div
        {
            min-height: 200px;
            margin: 15px;
            background-color: #605ca8;
            
            opacity: 0.7;
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
                            {!! BootForm::open()->action( route('admin.page.update', $oItem->id_page) )->put() !!}
                            {!! BootForm::bind($oItem) !!}
                        @else
                            {!! BootForm::open()->action( route('admin.page.store') )->post() !!}
                        @endif

                        {!! BootForm::text(trans('page.title_page'), 'title_page') !!}
                        
                        @if(isset($oItem))
                            {!! BootForm::select(trans('page-category.page_category'), 'fk_page_category')
                                ->class('select2')
                                ->options([$oItem->fk_page_category => $oItem->page_category->name_page_category])
                                ->data([
                                    'url-select'    => route('admin.page-category.select.ajax'), 
                                    'url-create'    => route('admin.page-category.create'),
                                    'field'         => 'name_page_category'
                            ]) !!}
                        @else
                            {!! BootForm::select(trans('page-category.page_category'), 'fk_page_category')
                                ->class('select2')
                                ->data([
                                    'url-select'    => route('admin.page-category.select.ajax'), 
                                    'url-create'    => route('admin.page-category.create'),
                                    'field'         => 'name_page_category'
                            ]) !!}
                        @endif

                        {!! BootForm::text(trans('page.url_page'), 'url_page') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
      
    <div class="row" id="line-template">
        <div class="col-sm-2 draggable template bg-navy" id="template-row">
            LIGNE
        </div>

        <div class="col-sm-2 draggable template bg-purple" id="template-column">
            COLONNE
        </div>
        
        <div class="col-sm-2 draggable template template-content bg-light-blue" id="template-text">
            TEXT
        </div>

        <div class="col-sm-2 draggable template template-content bg-green" id="template-image">
            IMAGE
        </div>

        <div class="col-sm-2 draggable template template-content bg-yellow" id="template-content">
            CONTENT
        </div>
    </div>
       
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-info">	
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('page.content') }}</h3>
                </div>
                <div class="box-body"> 
                    <div class="col-sm-12">
                        <div id="content-zone"></div>
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
    
    <!-- Draggable -->
    {!! Html::script('bower_components/jquery-ui/jquery-ui.min.js') !!}
    
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
            
            $('.draggable').draggable({
                grid : [20 , 20],
                revert : true,
                revertDuration: 0
            });
            
            $('#content-zone').droppable({
                accept: "#template-row",
                drop : function(){
                    $(this).append('<div class="row"></div>');
                    
                    $('#content-zone > .row').droppable({
                        accept: "#template-column",
                        drop : function(){
                            $(this).append('<div class="col col-lg-4"><div></div></div>');
                            
                            $('#content-zone > .row > .col > div').droppable({
                                accept: ".template-content",
                                drop : function(){
                                    
                                    
                                    $(this).append('');
                                }
                            });
                        }
                    });
                }
            });
        });
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
