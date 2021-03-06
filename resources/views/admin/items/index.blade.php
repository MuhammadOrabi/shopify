@extends('admin.layouts.app')

@section('content')
    <h1 class="subtitle"> > List {{ @$category->title }} Items</h1>
    <hr>
    <a href="{{ url('/admin/items/create?category_id=' . @$category->id) }}" class="button is-success">
        <span class="icon" ><font-awesome-icon class="m-r-10" icon="plus-square" size="xs" fixed-width/></span>
        Create
    </a>
    <hr>
    <admin-items-index category_id="{{ @$category->id }}" site-url="{{ url('/') }}"></admin-items-index>
@endsection
