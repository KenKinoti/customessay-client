<div class="pricing">
    <table class="table table-bordered margin-top-10">
        <tr>
            <th width="15%"></th>
            @foreach($academicLevels as $academicLevel)
                <th >{{ $academicLevel->name }}</th>
            @endforeach
        </tr>
        @foreach($deadlines as $deadline)
            <tr >
                <th >{{ $deadline->name }}</th>
                @foreach($academicLevels as $academicLevel)
                    <td >
                        {{ $pricing[$type.'_l'.$academicLevel->id.'-d'.$deadline->id]?? 0 }}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </table>
</div>