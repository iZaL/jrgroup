<table class="table table-striped">
    <tr>
        <td>{{ Lang::get('site.general.name') }} : </td>
        <td>
            @if($user->name_en)
            {{ $user->name_en }}
            @endif

            @if($user->name_ar)
            {{ $user->name_ar }}
            @endif

        </td>
    </tr>
    <tr>
        <td>{{ Lang::get('site.general.email') }} : </td>
        <td>
            @if($user->email)
            {{ $user->email }}
            @else
            {{ Lang::get('site.general.notavail')}}
            @endif
        </td>
    </tr>


</table>