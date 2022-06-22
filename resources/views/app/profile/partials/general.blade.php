<table class="table table-striped">
    <tr>
        <th>@lang('profile.user_id')</th>
        <td>{{  $user->id }}</td>
    </tr>
    <tr>
        <th>@lang('profile.email')</th>
        <td>{{  $user->email }}</td>
    </tr>
    <tr>
        <th>@lang('profile.phone_number')</th>
        <td>{{  $user->phone_number??"N/A" }}</td>
    </tr>
    <tr>
        <th>@lang('profile.country')</th>
        <td>{{ $user->country->name??"N/A" }}</td>
    </tr>
    <tr>
        <th>@lang('profile.timezone')</th>
        <td>{{ $user->timezone??"N/A" }}</td>
    </tr>
</table>
