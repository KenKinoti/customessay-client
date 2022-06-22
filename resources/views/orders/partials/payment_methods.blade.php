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
                <div class="h6 m-0">@lang('order.checkout.wallet')</div>
                <small>@lang('order.checkout.wallet_description')</small>
            </div>
        </div>
    </div>
    <div id="paypal">
        <div class="choice d-flex{{ (!Auth::check() || old('payment_method') == "paypal") ?' active':'' }}"
             data-toggle="wizard-radio">
            <input type="radio" name="payment_method"
                   {{ old('payment_method') == "flutterwave"?"checked":"" }}
                   {{ Auth::check()? '':'checked' }}
                   value="flutterwave">
          
            <div class="details">
               <img src="{{ asset('images/paypala.png') }}" class="img-fluid" alt="PayPal Payment Methods">
            </div>
        </div>
    </div>
    <div id="payment-method-error" class="text-danger my-2"></div>
    <p class="mb-0 px-3 text-center">@lang('order.checkout.terms_text')
        <a href="{{ url('terms-and-conditions') }}">@lang('order.checkout.terms') </a><br>

</div>
