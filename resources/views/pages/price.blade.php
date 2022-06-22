<div class="prices">
    <ul class="nav nav-pills nav-stacked">
        <li class="nav-item"><a class="nav-link font-23 active " href="#essayTab" data-toggle="tab">{{ __('Essay') }}</a></li>
        <li class="nav-item"><a class="nav-link font-23 " href="#chartsTab" data-toggle="tab">{{ __('Charts') }}</a></li>
        <li class="nav-item"><a class="nav-link font-23" href="#presentationTab" data-toggle="tab">{{ __('Presentation') }}</a>
        </li>
    </ul>
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div id="essayTab" class="tab-pane active">
                    @include('pages.partials.prices',['type' => 'essay'])
                </div>
                <div id="chartsTab" class="tab-pane">
                    @include('pages.partials.prices',['type' => 'chart'])
                </div>
                <div id="presentationTab" class="tab-pane">
                    @include('pages.partials.prices',['type' => 'presentation'])
                </div>
            </div>
        </div>
    </div>
</div>


