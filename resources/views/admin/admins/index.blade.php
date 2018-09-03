@extends('admin.layouts.app')

@section('content')
    <h1 class="subtitle"> > List Admins</h1>
    <hr>
    <a href="{{ url('/admin/admins/create') }}" class="button is-success">
        <span class="icon"><i class="fa fa-fw p-r-10 fa-plus"></i></span>Create
    </a>
    <admin-admins-index
        admins="{{ json_encode($admins->toArray()) }}"
        site-url="{{ url('/') }}"
        access-token="{{ auth('web-admin')->user()->createToken('Token')->accessToken }}"
        ></admin-admins-index>
@endsection
