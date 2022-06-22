@extends('layouts.app')
@section('title', '#'.$order->id.'-'.$order->topic)

@section('app')
   <div class="order-details">
       <div class="row">
           <div class="col-sm-8">
               <div class="card">
                   <div class="card-body">
                       <h2 class="margin-top-0">
                           @lang('order.number'){{ $order->id }}
                           <div class="status">
                               @include('app.orders.status')
                           </div>
                       </h2>
                       <hr class="margin-0">
                       <ul class="nav nav-tabs">
                           <li class="nav-item">
                               <a href="#details" class="nav-link active" data-toggle="tab">@lang('order.details')</a>
                           </li>
                           <li class="nav-item">
                               <a  class="nav-link" href="#order-files" data-toggle="tab">
                                   @if($order->fileCount())
                                       <span class="badge badge-default">{{ $order->fileCount() }}</span>
                                   @endif
                                   @lang('order.files')
                               </a>
                           </li>
                           <li  class="nav-item">
                               <a  class="nav-link" href="#messages" data-toggle="tab">@lang('message.title')</a>
                           </li>
                           @if($order->revisions->count())
                               <li class="nav-item">
                                   <a  class="nav-link" href="#revisions" data-toggle="tab">@lang('order.revisions')</a>
                               </li>
                           @endif
                           @if($order->disputes->count())
                               <li class="nav-item">
                                   <a  class="nav-link" href="#dispute" data-toggle="tab">
                                       @lang('order.dispute')
                                   </a>
                               </li>
                           @endif
                       </ul>
                       <div class="tab-content">
                           <div id="details" class="tab-pane active">
                               @include('app.orders.partials.details')
                           </div>
                           <div id="order-files" class="tab-pane">
                               @include('app.orders.partials.files')
                           </div>
                           <div id="messages" class="tab-pane">
                               @include('app.orders.partials.messages')
                           </div>
                           @if($order->revisions()->count())
                               <div id="revisions" class="tab-pane">
                                   @include('app.orders.partials.revisions')
                               </div>
                           @endif
                           @if($order->disputes()->count())
                               <div id="dispute" class="tab-pane">
                                   @include('app.orders.partials.disputes')
                               </div>
                           @endif
                       </div>
                   </div>
               </div>
           </div>
           <div class="col-sm-4">
               <div class="card mb-2">
                   <div class="card-body">
                       <h4 class="text-center">
                           @lang('order.price'):{{ currency() }}{{ $order->amount }}
                       </h4>
                   </div>
               </div>
               <div class="card mb-2">
                   <div class="card-body">
                       <div class="card-title">
                           <h4>@lang('order.order_actions')</h4>
                       </div>
                       <div class="actions">
                           @include('app.orders.actions.action')
                       </div>
                   </div>
               </div>
               <div class="card">
                   <div class="card-body">
                       <div class="card-title">
                           <h4>@lang('order.more_details')</h4>
                       </div>
                       @if($order->writer_id)
                           <table class="table table-striped margin-top-10">
                               <tr>
                                   <th>@lang('order.writer_id')</th>
                                   <td>{{ $order->writer->id }}</td>
                               </tr>
                           </table>
                       @else
                           <small class="text-muted">@lang('order.pending_assignment')</small>
                       @endif
                   </div>
               </div>
           </div>
       </div>
   </div>
@stop
