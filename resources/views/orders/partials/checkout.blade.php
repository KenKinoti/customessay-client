<div class="order__payment-methods">
    <div class="wizard-card page" data-color="purple">
        <div id="paymentMethods">
            <div id="wallet" class="{{ Auth::check() ? '': ' d-none' }}">
                <div class="choice d-flex{{ old('payment_method') == "wallet" ?' active':''}}"
                     data-toggle="wizard-radio">
                    <input type="radio" name="payment_method"
                           @if(old('payment_method') == "wallet")
                           checked
                           @endif
                           value="wallet">
                    <div class="icon">
                        <i class="ti ti-wallet"></i>
                    </div>
                    <div class="details">
                        <div class="h5">@lang('order.checkout.wallet')</div>
                        <small>@lang('order.checkout.wallet_description')</small>
                    </div>
                </div>
            </div>
            <div id="paypal">
                <div class="choice d-flex{{ (!Auth::check() || old('payment_method') == "paypal") ?' active':'' }}"
                     data-toggle="wizard-radio">
                    <input type="radio" name="payment_method"
                           {{ old('payment_method') == "paypal"?"checked":"" }}
                           {{ Auth::check()? '':'checked' }}
                           value="paypal">
                    <div class="icon">
                        <img src="{{ asset('images/paypal-outline.png') }}" alt="PayPal Logo Outline">
                    </div>
                    <div class="details">
                        <div class="h5 payment-name">@lang('order.checkout.pay_pal')</div>
                        <small>@lang('order.checkout.pay_pal_desc')</small>
                    </div>
                </div>
            </div>
            <div id="payment-method-error" class="col-xs-12 text-danger"></div>
            <div class="mt-4 text-center" >
                <p>@lang('order.checkout.terms_text')
                    <a href="{{ url('terms-and-conditions') }}">@lang('order.checkout.terms')</a>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block btn-lg">
        <i class="ti ti-shopping-cart"></i> @lang('order.form.checkout')
    </button>
</div>
