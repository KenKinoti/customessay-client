<form id="pageCalculator" action="{{ route('potential') }}" method="post" class="validate-form">
    <div class="order card m-0 h-100">
        <div class="card-body">
            <div class="card-title">
                <h4 class="text-center border-bottom pb-3">
                    @lang('order.calculators.page.title')
                </h4>
            </div>
            @csrf()
            <div class="form-group">
                <label class="control-label">@lang('order.academic_level') </label>
                <div class="py-1 radio-btn-group">
                    @foreach($academicLevels as $academicLevel)
                        @if($academicLevel->name == 'High School')
                            <span class="radio-btn active" data-option="{{ $academicLevel->id }}"
                                  data-target="pageAcademicLevel">
                                {{ $academicLevel->name }}
                            </span>
                            <input type="hidden" id="pageAcademicLevel" name="academicLevel"
                                   value="{{ $academicLevel->id }}">
                        @else
                            <span class="radio-btn" data-option="{{ $academicLevel->id }}"
                                  data-target="pageAcademicLevel">
                                {{ $academicLevel->name }}
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-8">
                        <label class="control-label" for="pageDeadline">@lang('order.deadline')</label>
                        <select class="form-control" id="pageDeadline" name="deadline">
                            <option value="">Select Option</option>
                            @foreach($deadlines as $deadline)
                                <option value="{{ $deadline->id }}"
                                        data-type="{{ $deadline->type }}"
                                        data-value="{{ $deadline->value }}"
                                        {{ $deadline->name == '14 Days' ? "selected":""  }}>
                                    {{ $deadline->name }}
                                </option>
                            @endforeach
                        </select>
                        <small>@lang('order.form.ready_by') <strong id="pageDeliveryDate"></strong></small>
                    </div>
                    <div class="col-sm-4">
                        <label for="pagePages" class="control-label">@lang('order.pages')</label>
                        <div class="mr-2">
                            <input type="text" class="form-control zero-spin text-center" id="pagePages" name="pages"
                                   value="1">
                        </div>
                        <small><em id="pageWords"></em></small>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label" for="pageSlides">
                            @lang('order.ppt_slides')
                        </label>
                        <input type="text" class="form-control zero-spin text-center" id="pageSlides"
                               name="slides" value="0">
                    </div>
                    <div class="col-sm-3">
                        <label for="pageCharts" class="control-label">
                            @lang('order.charts')
                        </label>
                        <input type="text" class="form-control zero-spin text-center" id="pageCharts"
                               value="0" name="charts">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex align-items-center justify-content-end">
                <span class="currency">{{ currency() }}</span><span class="price" id="pagePrice"></span>
                <button type="" class="btn-warning btn btn-lg ml-3">
                    <a href="{{ url('/order')}}">@lang('order.calculators.page.continue')</a>
                </button>
            </div>
        </div>
    </div>
</form>
@include('orders.partials.prices')
