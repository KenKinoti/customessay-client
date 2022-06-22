<div class="modal fade" id="new_message">
    <form method="post" action="{{ route('create-message') }}" enctype="multipart/form-data">
        @csrf()
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('message.new')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group margin-top-0">
                        <select id="recipient" name="recipient" class="form-control">
                            <option value="">-- Select Option --</option>
                            @if($sendWriter)
                                <option value="WRITER">Writer</option>
                            @endif
                            @if(isset($departments))
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            @else
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" placeholder="@lang('message.subject')">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="message"
                                  placeholder="@lang('message.message')"></textarea>
                    </div>
                    @if(isset($orderId))
                        <input type="hidden" id="order_id" name="order_id" value="{{ $orderId }}"/>
                    @else
                        <div class="form-group{{ $errors->has('files') ? ' has-error' : '' }}">
                            <div id="newMessageFileList" class="files-list"></div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="files[]" id="newMessageFiles">
                                <label class="custom-file-label" for="newMessageFiles">@lang('message.file')</label>
                            </div>
                            @if ($errors->has('files'))
                                <span class="invalid-feedback">
                                 {{ $errors->first('files') }}
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-simple" data-dismiss="modal">
                        <i class="ti ti-close"></i> @lang('message.close')
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-envelope"></i> @lang('message.send')
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
