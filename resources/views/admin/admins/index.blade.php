@extends('admin.layouts.app')

@section('content')
    <admin-admins-index admins="{{ json_encode($admins->toArray()) }}" site-url="{{ url('/admin/admins') }}"></admin-admins-index>
@endsection
