<div class="text-right my-2">
    <a href="#" class="btn btn-circled btn-primary" data-toggle="modal" data-target="#new_message">
        <i class="ti ti-pencil-alt"></i> @lang('message.new')
    </a>
</div>
<hr class="margin-0">
@include('app.messages.messages',['messages' => $order->userMessages, 'user' => Auth::user(), 'messageFlag' => new \App\Common\MessageFlag()])
@include('app.messages.new_message', ['orderId' => $order->id, 'sendWriter'=> $order->writer_id?true:false])
@include('app.messages.reply_message', ['orderId' => $order->id])
