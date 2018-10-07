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
        
        .template-content-image img
        {
            width: 100%;
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
        
        .setting-input-row
        {
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
@stop

@section('content')
    @if(isset($oItem))
        {!! BootForm::open()->action( route('admin.page.update', $oItem->id_page) )->put() !!}
        {!! BootForm::bind($oItem) !!}
    @else
        {!! BootForm::open()->action( route('admin.page.store') )->post() !!}
    @endif
    
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
                    
                    @if(isset($oItem))
                        <textarea name="content_page" id="content_page" class="hidden">{!! $oItem->content_page !!}</textarea>
                    @else
                        <textarea name="content_page" id="content_page" class="hidden"></textarea>
                    @endif
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
                    @if(isset($oItem))
                        <div id="content-zone">{!! $oItem->content_page !!}</div>
                    @else
                        <div id="content-zone"></div>
                    @endif
                    
                    {!! BootForm::submit(__('general.send'), 'btn-primary')->addClass('pull-right') !!}

                    
                </div>
            </div>
            <a href="javascript:history.back()" class="btn btn-primary">
                <span class="glyphicon glyphicon-circle-arrow-left"></span> {{ __('general.return') }}
            </a>
        </div>
    </div>
    
    <div class="modal fade" id="modal-row">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ __('page.modal_row_title') }}</h4>
                </div>
                <div class="modal-body">
                    @include('admin.page.partials.settings', ['sType' => 'row'])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ __('general.close') }}</button>
                    <button type="button" class="btn btn-primary" id="submit-modal-row">{{ __('general.save') }}</button>
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
                                                ->class('slider slider-size')
                                                ->data(config('clara.page.slider.aqua')+['size' => 'xs', 'type' => 'size'])
                                                ->beforeAddon('<input class="check-size minimal" type="checkbox" id="check-size-xs" data-size="xs">') !!}

                                            {!! BootForm::inputGroup('Small', 'sm-size')
                                                ->type('text')
                                                ->class('slider slider-size')
                                                ->data(config('clara.page.slider.aqua')+['size' => 'sm', 'type' => 'size'])
                                                ->beforeAddon('<input class="check-size minimal" type="checkbox" id="check-size-sm" data-size="sm">') !!}

                                            {!! BootForm::inputGroup('Medium', 'md-size')
                                                ->type('text')
                                                ->class('slider slider-size')
                                                ->data(config('clara.page.slider.aqua')+['size' => 'md', 'type' => 'size'])
                                                ->beforeAddon('<input class="check-size minimal" type="checkbox" id="check-size-md" data-size="md">') !!}

                                            {!! BootForm::inputGroup('Large', 'lg-size')
                                                ->type('text')
                                                ->class('slider slider-size')
                                                ->data(config('clara.page.slider.aqua')+['size' => 'lg', 'type' => 'size'])
                                                ->beforeAddon('<input class="check-size minimal" type="checkbox" id="check-size-lg" data-size="lg">') !!}
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-6">
                                            <h4 class="text-center">{{ __('page.offset') }}</h4>
                                            {!! BootForm::inputGroup('X-Small', 'xs-offset')
                                                ->type('text')
                                                ->class('slider slider-offset')
                                                ->data(config('clara.page.slider.purple')+['size' => 'xs', 'type' => 'offset'])
                                                ->beforeAddon('<input class="check-offset minimal" type="checkbox" id="check-offset-xs" data-size="xs">') !!}

                                            {!! BootForm::inputGroup('Small', 'sm-offset')
                                                ->type('text')
                                                ->class('slider slider-offset')
                                                ->data(config('clara.page.slider.purple')+['size' => 'sm', 'type' => 'offset'])
                                                ->beforeAddon('<input class="check-offset minimal" type="checkbox" id="check-offset-sm" data-size="sm">') !!}

                                            {!! BootForm::inputGroup('Medium', 'md-offset')
                                                ->type('text')
                                                ->class('slider slider-offset')
                                                ->data(config('clara.page.slider.purple')+['size' => 'md', 'type' => 'offset'])
                                                ->beforeAddon('<input class="check-offset minimal" type="checkbox" id="check-offset-md" data-size="md">') !!}

                                            {!! BootForm::inputGroup('Large', 'lg-offset')
                                                ->type('text')
                                                ->class('slider slider-offset')
                                                ->data(config('clara.page.slider.purple')+['size' => 'lg', 'type' => 'offset'])
                                                ->beforeAddon('<input class="check-offset minimal" type="checkbox" id="check-offset-lg" data-size="lg">') !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    @include('admin.page.partials.settings', ['sType' => 'col'])
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->
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
                    <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_3" data-toggle="tab">{{ __('page.text') }}</a></li>
                                <li><a href="#tab_4" data-toggle="tab">{{ __('page.advanced') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_3">
                                    <textarea class="ckeditor" id="text-content"></textarea>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_4">
                                    @include('admin.page.partials.settings', ['sType' => 'text'])
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                    </div>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('general.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{ __('page.modal_image_title') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_5" data-toggle="tab">{{ __('page.image') }}</a></li>
                                <li><a href="#tab_6" data-toggle="tab">{{ __('page.advanced') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_5">
                                    {!! BootForm::text(__('page.url'), 'image_url') !!}
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_6">
                                    @include('admin.page.partials.settings', ['sType' => 'image'])
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ __('general.close') }}</button>
                    <button type="button" class="btn btn-primary" id="submit-modal-image">{{ __('general.save') }}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <div class="modal fade" id="modal-data">
        <div class="modal-dialog modal-lg">
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
    {!! BootForm::close() !!}
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
            var aClassNoRemove  = [
                'row',
                'col',
                'template-container',
                'ui-droppable',
                'template-content-render',
                'template-content-text',
                'template-content-image',
                'template-content-data'
            ];
            
            function buildModalRow()
            {
                buildSettings('row');
            }
            
            function buildModalCol()
            {
                var aClass  = oCurrentElement.attr('class').split(' ');
                var nbClass = aClass.length;
                var iSize   = 12;
                var aSize   = ['xs', 'sm', 'md', 'lg'];
                
                buildSettings('col');
                
                //Size
                for(var i = 0; i < 4; i++)
                {
                    var sReg = new RegExp('col-'+aSize[i]+'-(\\d+)');
                    
                    if (oCurrentElement[0].className.match(sReg) !== null)
                    {
                        for (var j = 0; j < nbClass; j++) 
                        {
                            if (aClass[j].substring(0,7) == 'col-'+aSize[i]+'-' && aClass[j].substring(0,14) != 'col-'+aSize[i]+'-offset-')
                            {
                                iSize = aClass[j].substring(7);
                            }
                        }

                        $('#check-size-'+aSize[i]+'').iCheck('check');
                        $('#'+aSize[i]+'-size').bootstrapSlider('enable');
                    }
                    else
                    {
                        $('#check-size-'+aSize[i]+'').iCheck('uncheck');
                        $('#'+aSize[i]+'-size').bootstrapSlider('disable');
                    } 
                    
                    $('#'+aSize[i]+'-size').bootstrapSlider('setValue', parseInt(iSize), true);
                }
                
                var iSize = 1;
                for(var i = 0; i < 4; i++)
                {
                    //Offset
                    if (oCurrentElement.is('[class*=col-'+aSize[i]+'-offset]'))
                    {
                        for (var j = 0; j < nbClass; j++) 
                        {
                            if (aClass[j].substring(0,14) == 'col-'+aSize[i]+'-offset-')
                            {
                                iSize = aClass[j].substring(14);
                            }
                        }

                        $('#check-offset-'+aSize[i]+'').iCheck('check');
                        $('#'+aSize[i]+'-offset').bootstrapSlider('enable');
                    }
                    else
                    {
                        $('#check-offset-'+aSize[i]+'').iCheck('uncheck');
                        $('#'+aSize[i]+'-offset').bootstrapSlider('disable');
                    } 
                    
                    $('#'+aSize[i]+'-offset').bootstrapSlider('setValue', parseInt(iSize), true);
                }
            }
            
            function buildModalText()
            {
                buildSettings('text');
                CKEDITOR.instances['text-content'].setData(oCurrentElement.html());
            }
            
            function buildModalImage()
            {
                buildSettings('image');
                
                $('#image_url').val(oCurrentElement.attr('src'));
            }
            
            function buildSettings(sType)
            {
                $('#setting-'+sType).find('.setting-input-row').remove();
                
                var oSettingClass       = $('#setting-'+sType).find('.setting-class');
                var oSettingStyle       = $('#setting-'+sType).find('.setting-style');
                var oSettingAttribute   = $('#setting-'+sType).find('.setting-attribute');
                
                //Class
                var sClass = oCurrentElement.attr('class');
                
                if (typeof sClass !== typeof undefined && sClass !== false) 
                {
                    var aClass  = oCurrentElement.attr('class').split(' ');
                    var nbClass = aClass.length;

                    for(var i = 0; i < nbClass; i++)
                    {
                        if (aClassNoRemove.indexOf(aClass[i]) == -1 && !aClass[i].match(/(^|\s)col-\S+/g))
                        {
                            oSettingClass.append(buildClassSetting(aClass[i]));
                        }
                    }
                }
                
                //Style
                var sAttr = oCurrentElement.attr('style');
                
                if (typeof sAttr !== typeof undefined && sAttr !== false) 
                {
                    var aStyle          = oCurrentElement.attr('style').split(';');
                    var nbStyle         = aStyle.length;
                    var aCurrentStyle   = [];

                    for(var i = 0; i < nbStyle; i++)
                    {
                        aCurrentStyle = aStyle[i].split(':');
                        if (aCurrentStyle[0] != '' && aCurrentStyle[1] != '')
                        {
                            oSettingStyle.append(buildStyleSetting(aCurrentStyle[0], aCurrentStyle[1]));
                        }
                    }
                }
                
                //Attributes
                oCurrentElement.each(function() {
                    $.each(this.attributes,function(i,a){
                        if (a.name != 'class' && a.name != 'style' && a.name != 'src')
                        {
                            oSettingAttribute.append(buildAttributeSetting(a.name, a.value));                            
                        }
                    });
                });
            }
            
            function buildClassSetting(sClass)
            {
                return '<div class="row setting-input-row">'
                    +'<div class="col col-xs-8">'
                    +'<input value="'+sClass+'" class="form-control setting-input-class" type="text" />'
                    +'</div>'
                    +'<div class="col col-xs-4">'
                    +'<button class="btn btn-danger del-setting" type="button">'
                    +'<i class="glyphicon glyphicon-trash"></i>'
                    +'</button>'
                    +'</div>'
                    +'</div>';
            }
            
            function buildStyleSetting(sStyle, sValue)
            {
                return '<div class="row setting-input-row">'
                    +'<div class="col col-xs-4">'
                    +'<input value="'+sStyle+'" class="form-control setting-input-style" type="text" />'
                    +'</div>'
                    +'<div class="col col-xs-4">'
                    +'<input value="'+sValue+'" class="form-control setting-input-style-value" type="text" />'
                    +'</div>'
                    +'<div class="col col-xs-4">'
                    +'<button class="btn btn-danger del-setting" type="button">'
                    +'<i class="glyphicon glyphicon-trash"></i>'
                    +'</button>'
                    +'</div>'
                    +'</div>';
            }
            
            function buildAttributeSetting(sAttribute, sValue)
            {
                return '<div class="row setting-input-row setting-attribute">'
                    +'<div class="col col-xs-4">'
                    +'<input value="'+sAttribute+'" class="form-control setting-input-attribute" type="text" />'
                    +'</div>'
                    +'<div class="col col-xs-4">'
                    +'<input value="'+sValue+'" class="form-control setting-input-attribute-value" type="text" />'
                    +'</div>'
                    +'<div class="col col-xs-4">'
                    +'<button class="btn btn-danger del-setting" type="button">'
                    +'<i class="glyphicon glyphicon-trash"></i>'
                    +'</button>'
                    +'</div>'
                    +'</div>';
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
                                            $(this).append('<div class="template-content-render template-content-image"><img src="" /></div>');
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
                buildModalRow();
                $('#modal-row').modal();
            });

            $('#content-zone').on('click', '.template-container', function(e){
                if (e.target !== this)
                    return;
                
                oCurrentElement = $(this); 
                buildModalCol();
                $('#modal-col').modal();
            });

            $('#content-zone').on('click', '.template-content-render, .template-content-render *', function(e){
                if (e.target !== this)
                    return;
                
                oCurrentElement = $(this);
                
                if ($(this).hasClass('template-content-text'))
                {
                    buildModalText();
                    $('#modal-text').modal();
                }
                
                if ($(this).parents('.template-content-text').length)
                {
                    oCurrentElement = $(this).parents('.template-content-text').eq(0);
                    buildModalText();
                    $('#modal-text').modal();
                }
                
                if ($(this).hasClass('template-content-image'))
                {
                    oCurrentElement = $(this).find('img');
                    buildModalImage();
                    $('#modal-image').modal();
                }
                
                if ($(this).parent().hasClass('template-content-image'))
                {
                    buildModalImage();
                    $('#modal-image').modal();
                }
                
                if ($(this).hasClass('template-content-data'))
                {
                    $('#modal-data').modal();
                }                
            });
            
            /**
             * Editing column
             */
            $('.slider').bootstrapSlider();
            
            $('.slider').on('slideStop', function(){
                var oElement    = $(this);
                var bCurrentEl  = false;
                var iNewValue   = $(this).val();
                var sType       = $(this).data('type');
                
                $('input.slider-'+sType).each(function(){
                    var oCheckBox = $('#check-size-'+$(this).data('size'));
                    
                    if (oCheckBox.is(':checked') && bCurrentEl)
                    {
                        return false;
                    }
                    
                    if (!oCheckBox.is(':checked') && bCurrentEl)
                    {
                        $(this).bootstrapSlider('setValue', parseInt(iNewValue), true);
                    }
                    
                    if (oElement[0] == $(this)[0])
                    {
                        bCurrentEl = true;
                    }
                });
            });
            
            $('.check-size, .check-offset').on('ifChanged', function(){
                var size        = $(this).data('size');
                    
                if ($(this).is('[class*=check-size]'))
                {
                    var sType = 'size';
                }
                    
                if ($(this).is('[class*=check-offset]'))
                {
                    var sType = 'offset';
                }
                    
                if(!this.checked) 
                {
                    var oElement    = $(this);
                    var iNewValue   = 12;
                    var bCurrentEl  = false;
                    
                    $('.check-'+sType).each(function(){
                        if (oElement[0] == $(this)[0])
                        {
                            bCurrentEl = true;
                        }
                        
                        if (this.checked && !bCurrentEl)
                        {
                            iNewValue = $(this).parents('.input-group').find('input.slider').first().val();
                        }
                    });
                    
                    $('#'+size+'-'+sType)
                        .bootstrapSlider('setValue', parseInt(iNewValue), true)
                        .bootstrapSlider('disable');
                
                    var bCurrentEl  = false;
                    $('input.slider-'+sType).each(function(){
                        var oCheckBox = $('#check-'+sType+'-'+$(this).data('size'));

                        if (oCheckBox.is(':checked') && bCurrentEl)
                        {
                            return false;
                        }

                        if (!oCheckBox.is(':checked') && bCurrentEl)
                        {
                            $(this).bootstrapSlider('setValue', parseInt(iNewValue), true);
                        }

                        if (oElement[0] == oCheckBox[0])
                        {
                            bCurrentEl = true;
                        }
                    });
                }
                else
                {
                    $('#'+size+'-'+sType).bootstrapSlider('enable');
                }
            });
            
            /**
             * Editing settings
             */
            $('.add-line-class').on('click', function(){
                $(this).parent().append(buildClassSetting(''));
            });
            
            $('.add-line-style').on('click', function(){
                $(this).parent().append(buildStyleSetting('', ''));
            });
            
            $('.add-line-attribute').on('click', function(){
                $(this).parent().append(buildAttributeSetting('', ''));
            });
            
            $('body').on('click', '.del-setting', function(){
                $(this).closest('.setting-input-row').remove();
            });
            
            /**
             * Submitting
             */
            $('#submit-modal-col').on('click', function(){
                setSettings('col');
                
                var aSize   = ['xs', 'sm', 'md', 'lg'];                
                var aClass  = [];
                
                for(var i = 0; i < aSize.length; i++)
                {
                    if ($('#check-size-'+aSize[i]).is(':checked'))
                    {
                        aClass.push('col-'+aSize[i]+'-'+$('#'+aSize[i]+'-size').val());
                    }
                    
                    if ($('#check-offset-'+aSize[i]).is(':checked'))
                    {
                        aClass.push('col-'+aSize[i]+'-offset-'+$('#'+aSize[i]+'-offset').val());
                    }
                }
                
                oCurrentElement.addClass(aClass.join(' '));
                
                copyContent();
                $('#modal-col').modal('hide');
            });
            
            $('#submit-modal-row').on('click', function(){
                setSettings('row');
                
                copyContent();
                $('#modal-row').modal('hide');
            });
            
            $('#submit-modal-text').on('click', function(){
                oCurrentElement.html(CKEDITOR.instances['text-content'].getData());
                setSettings('text');
                
                copyContent();
                $('#modal-text').modal('hide');
            });
            
            $('#submit-modal-image').on('click', function(){
                oCurrentElement.attr('src', $('#image_url').val());
                
                setSettings('image');
                
                copyContent();
                $('#modal-image').modal('hide');
            });
            
            function setSettings(sType)
            {
                //Class
                var sClass = oCurrentElement.attr('class');
                
                if (typeof sClass !== typeof undefined && sClass !== false) 
                {
                    var aClass = oCurrentElement.attr('class').split(' ');

                    for(var i = 0; i < aClass.length; i++)
                    {
                        if (aClassNoRemove.indexOf(aClass[i]) == -1)
                        {
                            oCurrentElement.removeClass(aClass[i]);
                        }
                    }
                }

                $('#setting-'+sType).find('.setting-input-class').each(function(){
                    oCurrentElement.addClass($(this).val());
                });
                
                //Style
                var aStyle          = [];
                var aStyleName      = [];
                var aStyleValue     = [];
                $('#setting-'+sType).find('.setting-input-style').each(function(){
                    aStyleName.push($(this).val());
                });
                
                var nbStyle = aStyleName.length;
                
                $('#setting-'+sType).find('.setting-input-style-value').each(function(){
                    aStyleValue.push($(this).val());
                });
                
                for(var i = 0; i < nbStyle; i++)
                {
                    if (aStyleName[i] != '' && aStyleValue[i] != '')
                    {
                        aStyle.push(aStyleName[i]+': '+aStyleValue[i]);
                    }
                }
                
                if (aStyle.length > 0)
                {
                    oCurrentElement.attr('style', aStyle.join('; '));
                }
                else
                {
                    oCurrentElement.removeAttr('style');
                }
                
                //Attribute
                oCurrentElement.each(function() {
                    $.each(this.attributes,function(i,a){
                        if (a.name != 'class' && a.name != 'style' && a.name != 'src')
                        {
                            oCurrentElement.removeAttr(a.name);                            
                        }
                    });
                });
                
                var aAttributeName      = [];
                var aAttributeValue     = [];
                $('#setting-'+sType).find('.setting-input-attribute').each(function(){
                    aAttributeName.push($(this).val());
                });
                
                var nbAttribute = aAttributeName.length;
                
                $('#setting-'+sType).find('.setting-input-attribute-value').each(function(){
                    aAttributeValue.push($(this).val());
                });
                
                for(var i = 0; i < nbAttribute; i++)
                {
                    if (aAttributeName[i] != '' && aAttributeValue[i] != '')
                    {
                        oCurrentElement.attr(aAttributeName[i], aAttributeValue[i]);
                    }
                }
            }
            
            function copyContent()
            {
                $('#content_page').html($('#content-zone').html());
            }
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
