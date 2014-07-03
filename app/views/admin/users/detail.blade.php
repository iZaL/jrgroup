@extends('admin.layouts.print')
@section('content')
<table class=" table ">
    <tr>
        <td></td>
        <td><b>Name in English<b></td>
        <td>
            @if($user->name_en)
                {{ $user->name_en }}
            @else
            {{ Lang::get('site.general.notavail')}}
            @endif
        </td>
    </tr>
    <tr>
        <td><b>Name in Arabic<b></td>
        <td>
            @if($user->name_ar)
                {{ $user->name_ar }}
            @else
                {{ Lang::get('site.general.notavail')}}
            @endif
        </td>
    </tr>
    <tr>
        <td><b>Username<b> </td>
        <td>
            @if($user->username)
            {{ $user->username }}
            @else
            {{ Lang::get('site.general.notavail')}}
            @endif
        </td>
    </tr>

    <tr>
        <td><b>Email</b> </td>
        <td>
            @if($user->email)
            {{ $user->email }}
            @else
            {{ Lang::get('site.general.notavail')}}
            @endif
        </td>
    </tr>
    <tr>
        <td><b>Phone</b> </td>
        <td>
            @if($user->phone)
            {{ $user->phone }}
            @else
            {{ Lang::get('site.general.notavail')}}
            @endif
        </td>
    </tr>
    <tr>
        <td><b>Civil ID</b> </td>
        <td>
            @if($user->civilid)
            {{ $user->civilid}}
            @else
            {{ Lang::get('site.general.notavail')}}
            @endif
        </td>
    </tr>
    <tr>
        <td><b>Address </b></td>
        <td>
            @if($user->address)
            {{ $user->address}}
            @else
            {{ Lang::get('site.general.notavail')}}
            @endif
        </td>
    </tr>
    <tr>
        <td><b>Date Registered </b> </td>
        <td>
            {{ $user->created_at->format('Y-m-d') }}
        </td>
    </tr>
    <tr>
        <td><b>Date Expiry </b> </td>
        <td>
            @if($user->expires_at)
                {{ $user->expires_at->format('Y-m-d') }}
            @endif
        </td>
    </tr>
    <tr>
        <td><b>Member </b></td>
        <td>
            @if($user->member == 1 )
            Yes
            @else
            no
            @endif
        </td>
    </tr>

</table>

@stop