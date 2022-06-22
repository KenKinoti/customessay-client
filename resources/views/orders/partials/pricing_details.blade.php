<div class="form-group">
    <label class="control-label">@lang('order.academic_level') </label>
    <div class="radio-btn-group">
        @foreach($academicLevels as $academicLevel)
            @if(old('academic_level_id') == $academicLevel->id)
                <span class="radio-btn active" data-option="{{ $academicLevel->id }}"
                      data-target="academic_level_id">
                            {{ $academicLevel->name }}
                        </span>
                <input type="hidden" name="academic_level_id" id="academic_level_id"
                       value="{{ $academicLevel->id }}">
            @elseif(isset($order) && $order->academic_level_id == $academicLevel->id)
                <span class="radio-btn active" data-option="{{ $academicLevel->id }}"
                      data-target="academic_level_id">
                            {{ $academicLevel->name }}
                        </span>
                <input type="hidden" name="academic_level_id" id="academic_level_id" value="{{ $order->academic_level_id }}">
            @elseif($academicLevel->name == 'High School' && !isset($order) && empty(old('academic_level_id')))
                <span class="radio-btn active" data-option="{{ $academicLevel->id }}"
                      data-target="academic_level_id">
                            {{ $academicLevel->name }}
                            <input type="hidden" name="academic_level_id" id="academic_level_id"
                                   value="{{ $academicLevel->id }}">
                        </span>
            @else
                <span class="radio-btn" data-option="{{ $academicLevel->id }}"
                      data-target="academic_level_id">
                    {{ $academicLevel->name }}
                </span>
            @endif
        @endforeach
    </div>
    @if ($errors->has('academic_level_id'))
        <span class="invalid-feedback">
                <strong>{{ $errors->first('academic_level_id') }}</strong>
            </span>
    @endif
</div>
<div class="form-group">
    <label class="control-label">@lang('order.pages') </label>
    <div class="row">
        <div class="col-sm-3">
            <input type="text" class="form-control zero-spin text-center" id="pages" name="pages"
                   value="{{ $order->pages ?? old('pages',1) }}">
            <small><em id="orderWords"></em></small>
        </div>
        <div class="col-sm-9">
            <div class="mt-2">
                @foreach($spacing as $space)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="spacing" id="{{ $space }}" class="custom-control-input"
                               @if($loop->first)
                               checked
                               @elseif(isset($order) && $order->spacing == $space)
                               checked
                               @endif
                               value="{{ $space }}">
                        <label for="{{ $space }}" class="custom-control-label">
                            {{ ucwords($space) }} Spacing
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="charts" class="control-label">@lang('order.charts') </label>
            <input type="text" class="form-control zero-spin text-center" id="charts"
                   value="{{ $order->charts??old('charts',0) }}"
                   name="charts">
            @if ($errors->has('charts'))
                <span class="invalid-feedback">
                        <strong>{{ $errors->first('charts') }}</strong>
                    </span>
            @endif
        </div>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <label class="control-label">@lang('order.ppt_slides') </label>
            <div class="row">
                <div class="col-sm-3">
                    <input type="text" class="form-control zero-spin text-center" id="ppt_slides" name="ppt_slides"
                           value="{{ $order->ppt_slides ?? old('ppt_slides', 0) }}">
                </div>
                <div class="col-sm-9">
                    <div id="speakerNotes" class="mt-2">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="speakerNote" id="withNotes" class="custom-control-input"
                                   @if(isset($order) && $order->speaker_notes == 1)
                                   checked
                                   @else
                                   checked
                                   @endif
                                   value="1">
                            <label class="custom-control-label" for="withNotes">
                                @lang('order.with_notes') 
                            </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="speakerNote" id="withoutNotes" class="custom-control-input"
                                   @if(isset($order) && $order->speaker_notes == 0)
                                   checked
                                   @endif
                                   value="0">
                            <label class="custom-control-label" for="withoutNotes">
                                @lang('order.without_notes') 
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="sources" class="control-label">@lang('order.sources') </label>
    <div class="d-flex align-items-center">
        <div class="mr-5">
            <input type="text" class="form-control zero-spin text-center" id="sources"
                   value="{{ $order->sources??old('sources',0) }}"
                   name="sources">
            @if ($errors->has('sources'))
                <span class="invalid-feedback">
                            <strong>{{ $errors->first('sources') }}</strong>
                        </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <label class="col-md-3 control-label">@lang('order.writer_level') <br></label>
        <div class="col-md-9">
            <div class="radio-btn-group">
                @if(isset($order) && $order->requires_enl_writer )
                    <input type="hidden" id="requires_enl_writer" name="requires_enl_writer" value="1">
                    <span class="radio-btn" data-option="0" data-target="requires_enl_writer">
                     @lang('order.level_general')
                </span>
                    <span class="radio-btn active" data-option="1" data-target="requires_enl_writer">
                     @lang('order.level_advanced')
                </span>
                @else
                    <input type="hidden" id="requires_enl_writer" name="requires_enl_writer" value="0">
                    <span class="radio-btn active" data-option="0" data-target="requires_enl_writer">
                     @lang('order.level_general') 
                </span>
                    <span class="radio-btn" data-option="1" data-target="requires_enl_writer">
                     @lang('order.level_advanced') 
                </span>
                @endif
                @if ($errors->has('requires_enl_writer'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('requires_enl_writer') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <label for="preferred_writer" class="control-label col-md-3">
            @lang('order.preferred_writer')<br> 
        </label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="preferred_writer"
                   value="{{ $order->writer_id ?? old('writer_id', '') }}"
                   placeholder="@lang('order.preferred_writer_desc') " name="writer_id">
            @if ($errors->has('writer_id'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('writer_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <label class="control-label col-md-3">
            @lang('order.additional_services') <br>
        </label>
        <div class="col-md-9">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" id="plagiarism" name="plagiarism" class="custom-control-input"
                       @if(old('plagiarism'))
                       checked
                       @elseif(isset($order) && $order->plagiarism_report)
                       checked
                    @endif>
                <label class="custom-control-label" for="plagiarism">@lang('order.plagiarism_report') </label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" id="grammar" name="grammar" class="custom-control-input"
                       @if(old('grammar'))
                       checked
                       @elseif(isset($order) && $order->grammar_report)
                       checked
                    @endif>
                <label class="custom-control-label" for="grammar">@lang('order.grammar_report') </label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="requires_digital_references" id="requireSources"
                       class="custom-control-input"
                       @if(old('requires_digital_references'))
                       checked
                       @elseif(isset($order) && $order->requires_digital_references)
                       checked 
                    @endif
                >
                <label for="requireSources" class="custom-control-label">
                    @lang('order.digital_sources_copy')  
                </label>
            </div>
        </div>
    </div>
</div>
