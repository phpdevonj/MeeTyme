<x-master-layout>
    {{ Form::open(['route' => ['provider.commission', $providerdata->id], 'method' => 'post','data--submit'=>'provider'.$providerdata->id]) }}
    <main class="main-area">
        <div class="main-content">
            <div class="container-fluid">
                @include('partials._provider')
                <div class="card mb-30">
                    <div class="card-body p-30">
                        <div class="col-lg-12">
                            <div class="card overview-detail mb-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Default</h4>
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{ Form::label('type',trans('messages.type').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                            <input type="text" class="form-control"
                                                   placeholder="{{optional(optional($providerdata)->providertype)['type'] }}"
                                                   readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{ Form::label('commission',trans('messages.commission').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                            <input type="text" class="form-control"
                                                   placeholder="{{optional(optional($providerdata)->providertype)['commission']}}"
                                                   readonly>
                                        </div>

                                        <div class="col-md-12 mt-2">
                                            <h4>Custom</h4>
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{ Form::label('type', __('messages.select_name',[ 'select' => __('messages.type') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                            <br/>
                                            {{ Form::select('type',['percent' => __('messages.percent') , 'fixed' => __('messages.fixed') ],old('type', $providerdata->commission_type ?? null),[ 'id' => 'type' ,'class' =>'form-control select2js','required']) }}
                                            <span class="text-danger">{{__('messages.hint')}}</span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{ Form::label('commission',__('messages.commission').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false) }}
                                            {{ Form::number('commission',old('commission', $providerdata->commission ?? null), [ 'min' => 0, 'step' => 'any' , 'placeholder' => __('messages.commission'),'class' =>'form-control']) }}
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{ Form::label('action',trans('messages.action'),['class'=>'form-control-label'], false ) }}
                                            <div class="w-100">
                                                <button type="submit" class="text-center w-auto btn  btn-primary"
                                                        style="height: 46px;"> {{ __('messages.save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{ Form::close() }}

</x-master-layout>
