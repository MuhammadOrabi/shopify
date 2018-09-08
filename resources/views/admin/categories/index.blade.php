@extends('admin.layouts.app')

@section('content')
    <h1 class="subtitle"> > List Categories</h1>
    <hr>
    <a href="{{ url('/admin/categories/create') }}" class="button is-success">
        <span class="icon" ><font-awesome-icon class="m-r-10" icon="plus-square" size="xs" fixed-width/></span>
        Create
    </a>
    <admin-categories-index
        categories="{{ json_encode($categories->toArray()) }}"
        site-url="{{ url('/') }}"
        access-token="{{ auth('web-admin')->user()->createToken('Token')->accessToken }}"
        ></admin-categories-index>
@endsection
