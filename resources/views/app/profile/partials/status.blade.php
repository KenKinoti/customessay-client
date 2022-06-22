@if($user->status == $user::ACTIVATED)
    <span class="badge badge-success">@lang('profile.status.active')</span>
@elseif($user->status == $user::SUSPENDED)
    <span class="badge badge-danger">@lang('profile.status.suspended')</span>
@elseif($user->status == $user::DEACTIVATED)
    <span class="badge badge-danger">@lang('profile.status.deactivated')</span>
@endif
