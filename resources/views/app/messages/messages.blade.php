<div id="messages">
    @forelse($messages as $message)
        <div class="message {{ $message->isUnread($user)?" unread":"" }}">
            <div class="row">
                <div class="col-sm-10">
                    <a class="message-header" href="javascript:" data-parent="#messages"
                       data-toggle="collapse" data-target="#message{{ $message->id }}">
                        <span class="sender " style="color: black !important">
                            @if($message->sender_id == $user->id)
                                @if($message->recipient->userType->name == "Employee")
                                    @lang('message.me') -> {{ $message->recipient->employeeProfile->department->name }}
                                @else
                                    @lang('message.me') -> {{ $message->recipient->userType->name }}
                                @endif
                            @elseif($message->recipient_id == $user->id)
                                @if($message->sender->userType->name == "Employee")
                                    {{ $message->sender->employeeProfile->department->name }} -> @lang('message.me')
                                @else
                                    {{ $message->sender->UserType->name }} -> @lang('message.me')
                                @endif
                            @endif
                         </span>
                        <span class="subject" style="color: black !important">
                            @if($message->order_id)
                                <strong  style="color: black !important">@lang('order.number'){{  $message->order_id }}</strong>
                            @endif
                            {!! strip_tags($message->subject,'<strong style="color: black !important;">') !!}
                        </span>
                        <span class="date">
                            @if($message->flag == $messageFlag::REPLY)
                                <i class="ti ti-reply"></i>
                            @endif
                            @if($message->flag == $messageFlag::BLOCKED)
                                <span class="badge badge-danger"><i class="ti ti-hand-stop-o"></i>
                                    @lang('message.blocked')</span><br>
                            @endif
                            {{ $message->formattedDateTime('created_at') }}
                        </span>
                    </a>
                </div>
                <div class="col-sm-2">
                    @if($message->order_id)
                        <span class="order-id">
                            <a href="{{  route('orders.show',['id' => $message->order_id]) }}" class="text-black">#{{ $message->order_id }}</a>
                        </span>
                    @endif
                </div>
            </div>
            <div id="message{{ $message->id }}" data-message-id="{{ $message->id }}"
                 class="collapsible collapse message-body">
                <div class="p-3">
                    {!!  nl2br(strip_tags($message->content,'<strong><p>')) !!}
                </div>
                @if($message->flag == $messageFlag::BLOCKED)
                    <div class="mt-4">
                        <small class="text text-danger">
                            <em>@lang('message.blocked_message') <a href="{{ url('terms-and-conditions') }}">
                                    @lang('message.terms')</a></em>
                        </small>
                    </div>
                @endif
                @if($message->hasMedia('messages'))
                    <div class="mt-4">
                        <h6 class="text-muted margin-0"><i class="ti ti-paperclip"></i> @lang('message.attachments')
                        </h6>
                        <ol>
                            @foreach($message->getMedia('messages') as $media)
                                <li>
                                    <a href="{{ route('messages.download',['mediaItem'=> $media->id]) }}">
                                        {{ $media->file_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ol>

                    </div>
                @endif
                @if($message->sender_id != $user->id)
                    <div class="message-actions text-center">
                        <button class="btn btn-primary btn-sm btn-round reply"
                                data-message-id="{{ $message->id }}"
                                data-toggle="modal"
                                data-target="#reply_message">
                            <i class="ti ti-reply font-size-13"></i> @lang('message.reply')
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info alert-outline mb-0">
            <i class="ti ti-info-circle"></i>
            @lang('message.no_messages')
        </div>
    @endforelse
</div>
