{{--<div class="col-lg-12">--}}
{{--    <div class="row">--}}
{{--        <!--contents-->--}}
{{--        <div></div>--}}
{{--        @includeIf(config('app_settings.flash_partial'))--}}
{{--        <form method="post" action="{{ config('app_settings.url') }}" enctype="multipart/form-data" role="form">--}}
{{--            {!! csrf_field() !!}--}}
{{--            <div class="topics col-lg-12">--}}
{{--                <div class="container">--}}
{{--                    <ul class="nav nav-tabs ">--}}
{{--                        @if( isset($settingsUI) && count($settingsUI) )--}}
{{--                            @foreach(Arr::get($settingsUI, 'sections', []) as $section => $fields)--}}
{{--                                <li class="{{$section == 'app' ? 'active' : ''}}"><a data-toggle="tab"--}}
{{--                                                                                     href="#{{$fields['id']}}">{{$fields['title']}}</a>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </ul>--}}
{{--                    <div class="tab-content">--}}
{{--                        @if( isset($settingsUI) && count($settingsUI) )--}}
{{--                            @foreach(Arr::get($settingsUI, 'sections', []) as $section => $fields)--}}
{{--                                <div id="{{$fields['id']}}" class="tab-pane {{$section == 'app' ? 'active' : ''}}">--}}
{{--                                    @component('app_settings::section', compact('fields'))--}}
{{--                                        <div--}}
{{--                                            class="{{ Arr::get($fields, 'section_body_class', config('app_settings.section_body_class', 'card-body')) }}">--}}
{{--                                            @foreach(Arr::get($fields, 'inputs', []) as $field)--}}
{{--                                                @if(!view()->exists('app_settings::fields.' . $field['type']))--}}
{{--                                                    <div--}}
{{--                                                        style="background-color: #f7ecb5; box-shadow: inset 2px 2px 7px #e0c492; border-radius: 0.3rem; padding: 1rem; margin-bottom: 1rem">--}}
{{--                                                        Defined setting <strong>{{ $field['name'] }}</strong> with--}}
{{--                                                        type <code>{{ $field['type'] }}</code> field is not supported.--}}
{{--                                                        <br>--}}
{{--                                                        You can create a <code>fields/{{ $field['type'] }}--}}
{{--                                                            .balde.php</code>--}}
{{--                                                        to--}}
{{--                                                        render this input however you want.--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                                @includeIf('app_settings::fields.' . $field['type'] )--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    @endcomponent--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-12">--}}
{{--                    <button class="btn-primary btn">--}}
{{--                        {{ Arr::get($settingsUI, 'submit_btn_text', 'Save Settings') }}--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="col-md-12 ">
    @includeIf(config('app_settings.flash_partial'))
    <form method="post" action="{{ config('app_settings.url') }}" enctype="multipart/form-data" role="form">
        {!! csrf_field() !!}
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    @if( isset($settingsUI) && count($settingsUI) )
                        @foreach(Arr::get($settingsUI, 'sections', []) as $section => $fields)
                            <li class="nav-item ">
                                <a class="nav-link {{$section == 'app' ? 'active' : ' '}}" id="custom-tabs-two-home-tab" data-toggle="pill"
                                   href="#{{$fields['id']}}" role="tab" aria-controls="custom-tabs-two-home"
                                   aria-selected="false">{{$fields['title']}}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                    @if( isset($settingsUI) && count($settingsUI) )
                        @foreach(Arr::get($settingsUI, 'sections', []) as $section => $fields)
                            <div id="{{$fields['id']}}" class="tab-pane {{$section == 'app' ? 'active' : ''}}">
                                @component('app_settings::section', compact('fields'))
                                    <div
                                        class="{{ Arr::get($fields, 'section_body_class', config('app_settings.section_body_class', 'card-body')) }}">
                                        @foreach(Arr::get($fields, 'inputs', []) as $field)
                                            @if(!view()->exists('app_settings::fields.' . $field['type']))
                                                <div
                                                    style="background-color: #f7ecb5; box-shadow: inset 2px 2px 7px #e0c492; border-radius: 0.3rem; padding: 1rem; margin-bottom: 1rem">
                                                    Defined setting <strong>{{ $field['name'] }}</strong> with
                                                    type <code>{{ $field['type'] }}</code> field is not supported.
                                                    <br>
                                                    You can create a <code>fields/{{ $field['type'] }}
                                                        .balde.php</code>
                                                    to
                                                    render this input however you want.
                                                </div>
                                            @endif
                                            @includeIf('app_settings::fields.' . $field['type'] )
                                        @endforeach
                                    </div>
                                @endcomponent
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button class="btn-primary btn">
                {{ Arr::get($settingsUI, 'submit_btn_text', 'Save Settings') }}
            </button>
        </div>
        <br>
        <br>
    </form>
</div>
