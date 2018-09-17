@extends('admin.layouts.app')

@section('content')
    <admin-media
        :form="false"
        site-url="{{ url('/') }}"
        ></admin-media>
@endsection
