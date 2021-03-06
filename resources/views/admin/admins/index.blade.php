@extends('admin.layouts.app')

@section('content')
    <h1 class="subtitle"> > List Admins</h1>
    <hr>
    <a href="{{ url('/admin/admins/create') }}" class="button is-success">
        <span class="icon" ><font-awesome-icon class="m-r-10" icon="user-plus" size="xs" fixed-width/></span>
        Create
    </a>
    <admin-admins-index
        admins="{{ json_encode($admins->toArray()) }}"
        site-url="{{ url('/') }}"
        ></admin-admins-index>
@endsection
