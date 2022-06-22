<div class="form-group">
    <div class="row">
        <div class="col-sm-12">
            <label for="paper_type_id" class="control-label">
                @lang('order.paper_type')
            </label>
            <select name="paper_type_id" id="paper_type_id"
                    class="form-control{{ $errors->has('paper_type_id') ? ' is-invalid' : '' }}">
                <option value="">---Select Option--- </option>
                @foreach($paperTypes as $paperType)
                    <option value="{{ $paperType->id }}"
                            @if(old('paper_type_id') == $paperType->id)
                            selected
                        @endif
                    @isset($order)
                        {{ $order->paper_type_id == $paperType->id ?"selected":"" }}
                        @endisset>
                        {!! $paperType->name !!}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('paper_type_id'))
                <span class="invalid-feedback">
                    {{ $errors->first('paper_type_id') }}
                </span>
            @endif
        </div>
        <div class="col-sm-12">
            <label for="topic" class="control-label">
                @lang('order.topic')
            </label>
            <input id="topic" type="text" class="form-control{{ $errors->has('topic') ? ' is-invalid' : '' }}"
                   name="topic"
                   value="{{ $order->topic ?? old('topic') }}">
            @if ($errors->has('topic'))
                <span class="invalid-feedback">
                    {{ $errors->first('topic') }}
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group mb-0">
    <div class="row">
        <div class="col-sm-12">
            <label for="discipline_id" class="control-label">
                @lang('order.discipline')
            </label>
            <select name="discipline_id" id="discipline_id"
                    class="form-control{{ $errors->has('discipline_id') ? ' is-invalid' : '' }}">
                <option value="" data-technical="0">---Select Option--- </option>
                @foreach($disciplines as $discipline)
                    <option value="{{ $discipline->id }}"
                            @if(old('discipline_id') == $discipline->id)
                            selected
                            @endif
                            @isset($order)
                            {{ $order->discipline_id == $discipline->id?"selected":"" }}
                            @endisset
                            data-technical="{{ $discipline->is_technical }}">{!!  $discipline->name !!}</option>
                @endforeach
            </select>
            @if ($errors->has('discipline_id'))
                <span class="invalid-feedback">
                    {{ $errors->first('discipline_id') }}
                </span>
            @endif
        </div>
        <div class="col-sm-12">
            <label for="pageDeadline" class="control-label">@lang('order.deadline') </label>
            <select class="form-contro{{ $errors->has('deadline_id') ? ' is-invalid' : '' }}l" id="pageDeadline"
                    name="deadline_id">
                <option value="">Select Option </option>
                @foreach($deadlines as $deadline)
                    <option value="{{ $deadline->id }}" data-type="{{ $deadline->type }}"
                            data-value="{{ $deadline->value }}"
                            @if(old('deadline_id') == $deadline->id)
                            selected
                            @elseif($deadline->name == '14 Days 14 天' && empty(old('deadline_id')))
                            selected
                        @endif
                    @isset($order)
                        {{ $order->deadline_id == $deadline->id?"selected":"" }}
                        @endisset
                    >
                        {{ $deadline->name }}
                    </option>
                @endforeach
            </select>
            <small>@lang('order.form.ready_by')  <strong id="orderDeliveryDate"></strong></small>
            @if ($errors->has('deadline_id'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('deadline_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group">
    <label class="control-label">@lang('order.paper_format') </label>
    <div class="py-1 radio-btn-group">
        @foreach($citations as $citation)
            @if(old('citation_id') == $citation->id)
                <span class="radio-btn active" data-option="{{ $citation->id }}" data-target="citation_id">
                        {{ $citation->name }}
                    </span>
                <input type="hidden" name="citation_id" id="citation_id" value="{{ $citation->id }}">
            @elseif(isset($order) && $order->citation_id == $citation->id)
                <span class="radio-btn active" data-option="{{ $citation->id }}" data-target="citation_id">
                        {{ $citation->name }}
                    </span>
                <input type="hidden" name="citation_id" id="citation_id" value="{{ $citation->id }}">
            @elseif($citation->name == 'MLA' && !isset($order) && empty(old('citation_id')))
                <span class="radio-btn active" data-option="{{ $citation->id }}" data-target="citation_id">
                        {{ $citation->name }}
                    </span>
                <input type="hidden" name="citation_id" id="citation_id" value="{{ $citation->id }}">
            @else
                <span class="radio-btn" data-option="{{ $citation->id }}" data-target="citation_id">
                        {{ $citation->name }}
                    </span>
            @endif
        @endforeach
        <span class="radio-btn @if(isset($order->citation_id) && !is_numeric($order->citation_id)) active @endif" data-option="other" data-target="citation_id">
            @lang('order.other')
        </span>
    </div>
    <input id="other_citation" class="form-control" type="text" value="{{ $order->citation_id ??'' }}"
           placeholder="Enter preferred format..."
           name="other_citation">
    @if ($errors->has('citation_id'))
        <span class="invalid-feedback">
                <strong>{{ $errors->first('citation_id') }}</strong>
            </span>
    @endif
</div>
<div class="form-group">
    <label for="instructions" class="control-label">
        @lang('order.instructions')
    </label>
    <textarea id="instructions" type="text"
              placeholder="Give detailed Instructions about your paper  "
              class="form-control{{ $errors->has('instructions') ? ' is-invalid' : '' }}"
              rows="3" name="instructions">{{  $order->instructions??old('instructions') }}</textarea>
    @if ($errors->has('instructions'))
        <span class="invalid-feedback">
            {{ $errors->first('instructions') }}
        </span>
    @endif
</div>
@auth
    <div class="form-group">
        <label for="related_orders" class="control-label">
            @lang('order.related_orders')
        </label>
        <select name="related_orders[]"
                class="form-control{{ $errors->has('related_orders') ? ' is-invalid' : '' }}"
                id="related_orders" multiple="multiple">
            <option value=""></option>
            @foreach($relatedOrders as $relatedOrder)
                <option value="{{ $relatedOrder->id }}"
                        @if(in_array($relatedOrder->id, old('related_orders',[])))
                        selected
                    @endif
                @isset($order)
                    {{ in_array($relatedOrder->id, $order->related_orders??[])?"selected":"" }}
                    @endisset>
                    Order #{{ $relatedOrder->id }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('related_orders'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('related_orders') }}</strong>
            </span>
        @endif
    </div>
@endauth
<div class="form-group">
    <label for="file" class="control-label">
        @lang('order.add_files')
        </label>
    <div class="files-list mb-2"></div>
    <div class="custom-file">
        <input type="file" class="custom-file-input" name="files[]" id="files">
        <label class="custom-file-label" for="customFile">@lang('order.upload_files') </label>
    </div>
    @if ($errors->has('files'))
        <span class="invalid-feedback">
            {{ $errors->first('files') }}
        </span>
    @endif
</div>
