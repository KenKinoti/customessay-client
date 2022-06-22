<div class="modal" id="add-new-files" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="add-new-files-form" method="post" enctype="multipart/form-data"
                  action="{{ route('orders.add-new-files', ['id'=> $order->id]) }}">
                @csrf()
                <div class="modal-header">
                    <h4 class="modal-title">@lang('order.add_files')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body padding-bottom-35">
                    <div class="files-list"></div>
                    <div class="form-group margin-top-25 margin-bottom-25">
                        <label for="file" class="col-sm-2 control-label">@lang('order.files')</label>
                        <div class="col-sm-10">
                            <div class="form-file-upload">
                                <input type="file" name="files[]" id="files">
                                <div class="input-group">
                                    <input type="text" class="form-control">
                                    <span class="input-group-btn input-group-s">
                                        <button type="button" class="btn btn-just-icon btn-primary btn-file">
                                            <i class="fa fa-upload"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-simple"
                            data-dismiss="modal"> @lang('order.close')
                    </button>
                    <button type="submit" class="btn btn-primary btn-round">
                        @lang('order.submit')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
