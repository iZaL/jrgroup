<table class="table table-striped">
    <tr>
        <td>Name : </td>
        <td>
            @if($user->name_en)
            {{ $user->name_en }}
            @endif
            -
            @if($user->name_ar)
            {{ $user->name_ar }}
            @endif
        </td>
    </tr>
    <tr>
        <td>Username : </td>
        <td>
            @if($user->username)
            {{ $user->username }}
            @else
            {{ Lang::get('site.general.notavail')}}
            @endif
        </td>
    </tr>

    <tr>
        <td>Email : </td>
        <td>
            @if($user->email)
            {{ $user->email }}
            @else
            {{ Lang::get('site.general.notavail')}}
            @endif
        </td>
    </tr>
    <tr>
        <td>Phone : </td>
        <td>
            @if($user->phone)
            {{ $user->phone }}
            @else
            {{ Lang::get('site.general.notavail')}}
            @endif
        </td>
    </tr>
    <tr>
        <td>Civil ID : </td>
        <td>
            @if($user->civilid)
            {{ $user->civilid}}
            @else
            {{ Lang::get('site.general.notavail')}}
            @endif
        </td>
    </tr>
    <tr>
        <td>Address : </td>
        <td>
            @if($user->address)
            {{ $user->address}}
            @else
            {{ Lang::get('site.general.notavail')}}
            @endif
        </td>
    </tr>
    <tr>
        <td>Date Registered : </td>
        <td>
            {{ $user->created_at->format('Y-m-d') }}
        </td>
    </tr>
    <tr>
        <td>Date Expiry : </td>
        <td>
        </td>
    </tr>

</table>