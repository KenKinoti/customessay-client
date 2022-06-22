<form action="{{ route('potential') }}" method="post" class="validate-form bg-primary rounded ">
    <div id="bannerCalculator" class="pt-3 pl-3 pr-3 pb-1  rounded-top">
        <h6 class="text-center mb-4 text-white text-uppercase">@lang('order.calculators.simple.title')</h6>
        <div class="form-group">
            <div class="form-row">
                <div class="col-sm-12">
                    <select class="form-control" data-rule-required="true" name="academicLevel"
                            id="bannerAcademicLevel">
                        <option value="">@lang('order.academic_level')</option>
                        @foreach($academicLevels as $academicLevel)
                            <option value="{{ $academicLevel->id }}" {{ $academicLevel->name == 'High School' ? 'selected':null }}>
                                {{ $academicLevel->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-sm-12">
                    <select class="form-control" data-rule-required="true" name="paper" id="paper">
                        <option value="">@lang('order.paper_type')</option>
                        @foreach($papers as $paper)
                            <option value="{{ $paper->id }}" {{ $paper->name == 'Essay' ? 'selected':null }}>
                                {{ $paper->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-sm-12">
                    <select class="form-control" data-rule-required="true" id="bannerDeadline" name="deadline">
                        <option value="">@lang('order.deadline')</option>
                        @foreach($deadlines as $deadline)
                            <option value="{{ $deadline->id }}"
                                    data-type="{{ $deadline->type }}"
                                    data-value="{{ $deadline->value }}"
                                    {{ $deadline->name == '14 Days' ? "selected":""  }}>
                                {{ $deadline->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-sm-12">
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control zero-spin text-center" id="bannerPages" name="pages"
                               value="{{ $order->pages ?? old('pages',1) }}">
                        <small class="ml-3"><em id="bannerWords"></em></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-sm-12">
                    <input class="form-control" name="email" id="email"
                           data-rule-required="true"
                           data-rule-email="true"
                           placeholder="@lang('auth.form.email')" type="email">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group p-3 rounded-bottom ">
        <div class="form-row">
            <div class="col-sm-4">
                <small class="d-block">@lang('order.calculators.simple.total')</small>
                <sup class="currency">{{ currency() }}</sup>
                <span id="bannerPrice" class="price"></span>
            </div>
            <div class="col-sm-8">
                <button type="submit" class="btn btn-warning text-white btn-block mt-3">
                    <i class="fa fa-shopping-cart"></i> @lang('order.calculators.simple.order_now')
                </button>
            </div>
        </div>
    </div>
</form>
@include('orders.partials.prices')
