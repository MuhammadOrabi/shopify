@extends('admin.layouts.app')

@section('content')
    <h1 class="subtitle"> > List Items</h1>
    <hr>
    <a href="{{ url('/admin/items/create') }}" class="button is-success">
        <span class="icon" ><font-awesome-icon class="m-r-10" icon="plus-square" size="xs" fixed-width/></span>
        Create
    </a>
    <hr>
    <admin-items-index :items="{{ $items }}" site-url="{{ url('/') }}"></admin-items-index>
@endsection
