@extends('admin/dashboard')

@section('CSS')
    <!-- Select 2 -->
    {!! Html::style('bower_components/select2/dist/css/select2.min.css') !!}
    
    <!-- iCheck for checkboxes and radio inputs -->
    {!! Html::style('adminlte/plugins/iCheck/all.css') !!}
    
    <!-- bootstrap slider -->
    {!! Html::style('adminlte/plugins/bootstrap-slider/slider.css') !!}

    <style>
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
            padding-left: 30px;
            padding-right: 30px;
        }
        
        #content-zone .row
        {
            min-height: 200px;
            margin-top: 15px;
            margin-bottom: 15px;
            background-color: #001F3F;
            
            opacity: 0.7;
        }
        .template-container
        {
            min-height: 200px;
            margin-top: 15px;
            margin-bottom: 15px;
            background-color: #605ca8;
            background-clip: content-box;
            
            opacity: 0.7;
        }
        
        .template-content-render
        {
            min-height: 150px;
            margin: 25px;
            opacity: 1;
        }
        
        .template-content-text
        {
            background-color: #3c8dbc;
        }
        
        .template-content-image
        {
            background-color: #00a65a;
        }
        
        .template-content-data
        {
            background-color: #f39c12;
        }
        
        #content-zone .row,
        .template-container,
        .template-content-render
        {
            cursor: pointer;
        }
        
        #modal-col .input-group-addon
        {
            border: 0;
            vertical-align: top;
            padding-right: 15px;
            padding-left: 0;
        }
        
        .slider.slider-horizontal
        {
            margin-bottom: 40px !important;
        }
        
        .slider-tick-label-container
        {
            margin-left: -4.5% !important;
            margin-top: 0 !important;
        }
        
        .slider-tick-label
        {
            width: 8.7% !important;
            padding-top: 20px !important;
        }
        
        .slider-tick.round
        {
            display: none;
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
                    @if(isset($oItem))
                        {!! BootForm::open()->action( route('admin.page.update', $oItem->id_page) )->put() !!}
                        {!! BootForm::bind($oItem) !!}
                    @else
                        {!! BootForm::open()->action( route('admin.page.store') )->post() !!}
                    @endif

                    {!! BootForm::text(__('page.title_page'), 'title_page') !!}

                    @if(isset($oItem))
                        {!! BootForm::select(__('page-category.page_category'), 'fk_page_category')
                            ->class('select2 form-control')
                            ->options([$oItem->fk_page_category => $oItem->page_category->name_page_category])
                            ->data([
                                'url-select'    => route('admin.page-category.select.ajax'), 
                                'url-create'    => route('admin.page-category.create'),
                                'field'         => 'name_page_category'
                        ]) !!}
                    @else
                        {!! BootForm::select(__('page-category.page_category'), 'fk_page_category')
                            ->class('select2 form-control')
                            ->data([
                                'url-select'    => route('admin.page-category.select.ajax'), 
                                'url-create'    => route('admin.page-category.create'),
                                'field'         => 'name_page_category'
                        ]) !!}
                    @endif

                    {!! BootForm::text(__('page.url_page'), 'url_page') !!}
                </div>
            </div>
        </div>
    </div>
      
    <div class="row" id="line-template">
        <div class="col-sm-12">
            <div class="box box-info">	
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('page.template') }}</h3>
                </div>
                <div class="box-body"> 
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

                    <div class="col-sm-2 draggable template template-content bg-yellow" id="template-data">
                        DATA
                    </div>
                </div>
            </div>
        </div>
    </div>
       
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-info">	
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('page.content') }}</h3>
                </div>
                <div class="box-body"> 
                    <div id="content-zone"></div>
                    {!! BootForm::submit(__('general.send'), 'btn-primary')->addClass('pull-right') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
            <a href="javascript:history.back()" class="btn btn-primary">
                <span class="glyphicon glyphicon-circle-arrow-left"></span> {{ __('general.return') }}
            </a>
        </div>
    </div>
    
    <div class="modal fade" id="modal-row">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ __('page.modal_row_title') }}</h4>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ __('general.close') }}</button>
                    <button type="button" class="btn btn-primary">{{ __('general.save') }}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <div class="modal fade" id="modal-col">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ __('page.modal_col_title') }}</h4>
                </div>
                <div class="modal-body">
                    {!! BootForm::open() !!}
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">{{ __('page.size') }}</a></li>
                                <li><a href="#tab_2" data-toggle="tab">{{ __('page.advanced') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <h4 class="text-center">{{ __('page.width') }}</h4>
                                            {!! BootForm::inputGroup('X-Small', 'xs-size')
                                                ->type('text')
                                                ->class('slider')
                                                ->data(config('clara.page.slider.aqua'))
                                                ->beforeAddon('<input class="check-size minimal" type="checkbox" id="check-size-xs">') !!}

                                            {!! BootForm::inputGroup('Small', 'sm-size')
                                                ->type('text')
                                                ->class('slider')
                                                ->data(config('clara.page.slider.aqua'))
                                                ->beforeAddon('<input class="check-size minimal" type="checkbox" id="check-size-sm">') !!}

                                            {!! BootForm::inputGroup('Medium', 'md-size')
                                                ->type('text')
                                                ->class('slider')
                                                ->data(config('clara.page.slider.aqua'))
                                                ->beforeAddon('<input class="check-size minimal" type="checkbox" id="check-size-md">') !!}

                                            {!! BootForm::inputGroup('Large', 'lg-size')
                                                ->type('text')
                                                ->class('slider')
                                                ->data(config('clara.page.slider.aqua'))
                                                ->beforeAddon('<input class="check-size minimal" type="checkbox" id="check-size-lg">') !!}
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-6">
                                            <h4 class="text-center">{{ __('page.offset') }}</h4>
                                            {!! BootForm::inputGroup('X-Small', 'xs-offset')
                                                ->type('text')
                                                ->class('slider')
                                                ->data(config('clara.page.slider.purple'))
                                                ->beforeAddon('<input class="check-offset minimal" type="checkbox" id="check-offset-xs">') !!}

                                            {!! BootForm::inputGroup('Small', 'sm-offset')
                                                ->type('text')
                                                ->class('slider')
                                                ->data(config('clara.page.slider.purple'))
                                                ->beforeAddon('<input class="check-offset minimal" type="checkbox" id="check-offset-sm">') !!}

                                            {!! BootForm::inputGroup('Medium', 'md-offset')
                                                ->type('text')
                                                ->class('slider')
                                                ->data(config('clara.page.slider.purple'))
                                                ->beforeAddon('<input class="check-offset minimal" type="checkbox" id="check-offset-md">') !!}

                                            {!! BootForm::inputGroup('Large', 'lg-offset')
                                                ->type('text')
                                                ->class('slider')
                                                ->data(config('clara.page.slider.purple'))
                                                ->beforeAddon('<input class="check-offset minimal" type="checkbox" id="check-offset-lg">') !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    The European languages are members of the same family. Their separate existence is a myth.
                                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                                    in their grammar, their pronunciation and their most common words. Everyone realizes why a
                                    new common language would be desirable: one could refuse to pay expensive translators. To
                                    achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                                    words. If several languages coalesce, the grammar of the resulting language is more simple
                                    and regular than that of the individual languages.
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->
                    {!! BootForm::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ __('general.close') }}</button>
                    <button type="button" class="btn btn-primary" id="submit-modal-col">{{ __('general.save') }}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <div class="modal fade" id="modal-text">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ __('page.modal_text_title') }}</h4>
                </div>
                <div class="modal-body">
                    <textarea class="ckeditor" id="text-content"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ __('general.close') }}</button>
                    <button type="button" class="btn btn-primary" id="submit-modal-text">{{ __('general.save') }}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <div class="modal fade" id="modal-image">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ __('page.modal_image_title') }}</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ __('general.close') }}</button>
                    <button type="button" class="btn btn-primary">{{ __('general.save') }}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <div class="modal fade" id="modal-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ __('page.modal_data_title') }}</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ __('general.close') }}</button>
                    <button type="button" class="btn btn-primary">{{ __('general.save') }}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@stop

@section('JS')
    <!-- Select 2 -->
    {!! Html::script('bower_components/select2/dist/js/select2.full.min.js') !!}
    
    <!-- iCheck 1.0.1 -->
    {!! Html::script('adminlte/plugins/iCheck/icheck.min.js') !!}
    
    <!-- Draggable -->
    {!! Html::script('bower_components/jquery-ui/jquery-ui.min.js') !!}
    
    <!-- Bootstrap slider -->
    {!! Html::script('adminlte/plugins/bootstrap-slider/bootstrap-slider.js') !!}
    
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
            
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            });
        });    
    </script>
            
    <script type="text/javascript">
        $(document).ready(function() {
            var oCurrentElement = null;
            
            function buildModalCol()
            {
                var aClass = oCurrentElement.attr('class').split(' ');
                var nbClass = aClass.length;
                
                var sizeXs = 12;
                var sizeSm = 12;
                var sizeMd = 12;
                var sizeLg = 12;
                
                if (oCurrentElement.is('[class*=col-xs]'))
                {
                    for (var i = 0; i < nbClass; i++) 
                    {
                        if (aClass[i].substring(0,7) == 'col-xs-')
                        {
                            sizeXs = aClass[i].substring(7);
                        }
                    }
                    
                    $('#check-size-xs').iCheck('check');
                    $('#xs-size').bootstrapSlider('enable');
                }
                else
                {
                    $('#check-size-xs').iCheck('uncheck');
                    $('#xs-size').bootstrapSlider('disable');
                }    
                
                if (oCurrentElement.is('[class*=col-sm]'))
                {
                    for (var i = 0; i < nbClass; i++) 
                    {
                        if (aClass[i].substring(0,7) == 'col-sm-')
                        {
                            sizeSm = aClass[i].substring(7);
                        }
                    }
                    
                    $('#check-size-sm').iCheck('check');
                    $('#sm-size').bootstrapSlider('enable');
                }
                else
                {
                    sizeSm = sizeXs;
                    $('#check-size-sm').iCheck('uncheck');
                    $('#sm-size').bootstrapSlider('disable');
                }
                
                if (oCurrentElement.is('[class*=col-md]'))
                {
                    for (var i = 0; i < nbClass; i++) 
                    {
                        if (aClass[i].substring(0,7) == 'col-md-')
                        {
                            sizeMd = aClass[i].substring(7);
                        }
                    }
                    
                    $('#check-size-md').iCheck('check');
                    $('#md-size').bootstrapSlider('enable');
                }
                else
                {
                    sizeMd = sizeSm;
                    $('#check-size-md').iCheck('uncheck');
                    $('#md-size').bootstrapSlider('disable');
                }
                
                if (oCurrentElement.is('[class*=col-lg]'))
                {
                    for (var i = 0; i < nbClass; i++) 
                    {
                        if (aClass[i].substring(0,7) == 'col-lg-')
                        {
                            sizeLg = aClass[i].substring(7);
                        }
                    }
                    
                    $('#check-size-lg').iCheck('check');
                    $('#lg-size').bootstrapSlider('enable');
                }
                else
                {
                    sizeLg = sizeMd;
                    $('#check-size-lg').iCheck('uncheck');
                    $('#lg-size').bootstrapSlider('disable');
                }
                
                $('#xs-size').bootstrapSlider('setValue', parseInt(sizeXs), true);
                $('#sm-size').bootstrapSlider('setValue', parseInt(sizeSm), true);
                $('#md-size').bootstrapSlider('setValue', parseInt(sizeMd), true);
                $('#lg-size').bootstrapSlider('setValue', parseInt(sizeLg), true);
            }
            
            $('.draggable').draggable({
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
                            $(this).append('<div class="col col-xs-3 template-container"></div>');
                            
                            $('#content-zone > .row > .col').droppable({
                                accept: ".template-content",
                                drop : function(ev, template){
                                    
                                    switch (template.draggable.attr('id'))
                                    {
                                        case 'template-text':
                                            $(this).append('<div class="template-content-render template-content-text"></div>');
                                            break;
                                        
                                        case 'template-image':
                                            $(this).append('<div class="template-content-render template-content-image"></div>');
                                            break;
                                        
                                        case 'template-data':
                                            $(this).append('<div class="template-content-render template-content-data"></div>');
                                            break;
                                    }                                    
                                }
                            });
                        }
                    });
                }
            });
            
            $('#content-zone').on('click', '.row', function(e){
                if (e.target !== this)
                    return;
                
                oCurrentElement = $(this);
                $('#modal-row').modal();
            });

            $('#content-zone').on('click', '.template-container', function(e){
                if (e.target !== this)
                    return;
                
                oCurrentElement = $(this); 
                buildModalCol();
                $('#modal-col').modal();
            });

            $('#content-zone').on('click', '.template-content-render', function(e){
                if (e.target !== this)
                    return;
                
                oCurrentElement = $(this);
                
                if ($(this).hasClass('template-content-text'))
                {
                    $('#modal-text').modal();
                }
                
                if ($(this).hasClass('template-content-image'))
                {
                    $('#modal-image').modal();
                }
                
                if ($(this).hasClass('template-content-data'))
                {
                    $('#modal-data').modal();
                }                
            });
            
            //Editing column
            $('.slider').bootstrapSlider();
            //TODO
            $('.slider').on('change', function(){
                var oElement    = $(this);
                var bCurrentEl  = false;
                var iNewValue   = $(this).val();
                
                $('.slider').each(function(){
                    var oCheckBox = $(this).parents('.input-group').find('input.check-size').first();
console.log(!oCheckBox.is(':checked') && bCurrentEl);
                    if (!oCheckBox.is(':checked') && bCurrentEl)
                    {
                        $(this).bootstrapSlider('setValue', parseInt(iNewValue), true);
                    }
 console.log(oElement == $(this)[0]);                   
                    if (oElement == $(this)[0])
                    {
                        bCurrentEl = true;
                    }
                });
            });
            
            $('.check-size').on('ifChanged', function(){
                if(!this.checked) 
                {
                    var oElement    = $(this)[0];
                    var iNewValue   = 12;
                    var bCurrentEl  = false;
                    
                    $('.check-size').each(function(){
                        if (oElement == $(this)[0])
                        {
                            bCurrentEl = true;
                        }
                        
                        if (this.checked && !bCurrentEl)
                        {
                            iNewValue = $(this).parents('.input-group').find('input.slider').first().val();
                        }
                    });
                    
                    $(this)
                        .parents('.input-group')
                        .find('input.slider')
                        .first()
                        .bootstrapSlider('setValue', parseInt(iNewValue), true)
                        .bootstrapSlider('disable');
                }
                else
                {
                    $(this)
                        .parents('.input-group')
                        .find('input.slider')
                        .first()
                        .bootstrapSlider('enable');
                }
            });
            
            $('#submit-modal-col').on('click', function(){
                oCurrentElement.removeClass (function (index, className) {
                    return (className.match (/(^|\s)col-\S+/g) || []).join(' ');
                });
                
                var aClass = [];
                
                if ($('#check-size-xs').is(':checked'))
                {
                    aClass.push('col-xs-'+$('#xs-size').val());
                }
                
                if ($('#check-size-sm').is(':checked'))
                {
                    aClass.push('col-sm-'+$('#sm-size').val());
                }
                
                if ($('#check-size-md').is(':checked'))
                {
                    aClass.push('col-md-'+$('#md-size').val());
                }
                
                if ($('#check-size-lg').is(':checked'))
                {
                    aClass.push('col-lg-'+$('#lg-size').val());
                }
                
                oCurrentElement.addClass(aClass.join(' '));
                
                $('#modal-col').modal('hide');
            });
            
            $('#submit-modal-text').on('click', function(){
                oCurrentElement.html(CKEDITOR.instances['text-content'].getData());
                
                $('#modal-text').modal('hide');
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
