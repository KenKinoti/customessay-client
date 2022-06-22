<div class="pt-2">
    <div class="item pages">
        <div class="row">
            <div class="col-9">
                <span class="description"></span>
            </div>
            <div class="col-3 text-right">
                {{ currency() }}<span class="amount"></span>
            </div>
        </div>
    </div>
    <div class="item slides">
        <div class="row">
            <div class="col-9">
                <span class="description"></span>
            </div>
            <div class="col-3 text-right">
                {{ currency() }}<span class="amount"></span>
            </div>
        </div>
    </div>
    <div class="item charts">
        <div class="row">
            <div class="col-9">
                <span class="description"></span>
            </div>
            <div class="col-3 text-right">
                {{ currency() }}<span class="amount"></span>
            </div>
        </div>
    </div>
    <div class="item preferred-writer">
        <div id="preferredWriterItem" class="row">
            <div class="col-9">
                <span class="description">@lang('order.preferred_writer')</span>
            </div>
            <div class="col-3 text-right">
                {{ currency() }}<span class="amount"></span>
            </div>
        </div>
    </div>
    <div class="item digital-sources">
        <div class="row">
            <div class="col-9">
                <span class="description">@lang('order.digital_references')</span>
            </div>
            <div class="col-3 text-right">
                {{ currency() }}<span class="amount"></span>
            </div>
        </div>
    </div>
    <div class="item advanced-writer">
        <div class="row">
            <div class="col-9">
                <span class="description">@lang('order.level_advanced')</span>
            </div>
            <div class="col-3 text-right">
                {{ currency() }}<span class="amount"></span>
            </div>
        </div>
    </div>
    <div class="item technical">
        <div class="row">
            <div class="col-9">
                <span class="description">@lang('order.technical_discipline')</span>
            </div>
            <div class="col-3 text-right">
                {{ currency() }}<span class="amount"></span>
            </div>
        </div>
    </div>
    <div class="item plagiarism">
        <div class="row">
            <div class="col-9">
                <span class="description">@lang('order.plagiarism_report') </span>
            </div>
            <div class="col-3 text-right">
                {{ currency() }}<span class="amount"></span>
            </div>
        </div>
    </div>
    <div class="item grammar">
        <div class="row">
            <div class="col-9">
                <span class="description">@lang('order.grammar_report') </span>
            </div>
            <div class="col-3 text-right">
                {{ currency() }}<span class="amount"></span>
            </div>
        </div>
    </div>
    <div class="border-top py-2 mt-3 text-dark">
        <div class="row">
            <div class="col-8 d-flex align-items-center">
                <strong class="total-text">@lang('order.calculators.simple.total') </strong>
            </div>
            <div class="col-4 d-flex align-items-center justify-content-end">
                {{ currency() }}<span class="price totalPrice"></span>
            </div>
        </div>
    </div>
</div>
