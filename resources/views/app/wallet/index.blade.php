@extends('layouts.app')

@section('title','Wallet')

@section('app')
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body text-center">
                    <p>@lang('wallet.available_balance')</p>
                    <h3 class="margin-top-20">
                        {{ currency() }}{{ number_format($balance) }}
                    </h3>
                    <button {{ $maxDeposit > 0 ? "":"disabled" }} class="btn btn-secondary btn-circled" data-toggle="modal"
                            data-target="#make-deposit">
                        <i class="ti ti-plus"></i> @lang('wallet.deposit')
                    </button>
                    <p>
                        <em>
                            <small>*@lang('wallet.maximum_balance') <strong>{{ currency() }}{{number_format($maxBalance)}}</strong>
                            </small>
                        </em>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'table table-striped']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="make-deposit" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <form class="validate-form" action="{{ route('wallet-deposit') }}" method="post">
                @csrf()
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">@lang('wallet.make_deposit')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="payment_method" value="flutterwave">
                        <div class="form-group">
                            <input type="text" name="amount" data-rule-required="true" data-rule-max="{{ $maxDeposit }}"
                                   class="form-control" placeholder="Amount">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-round btn-success">
                            <i class="ti ti-money"></i> @lang('wallet.deposit')
                        </button>
                        <button type="button" class="btn btn-simple" data-dismiss="modal">
                            @lang('wallet.close')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@include('app.partials.data_tables.js_files')
