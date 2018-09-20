@extends('admin.layouts.app')

@section('content')
    <div class=" is- is-marginless is-centered">
        <div class="">
            <nav class="card">
                <header class="card-header">
                   <h1 class="subtitle card-header-title"> > Items</h1>
                    <a href="{{ url('/admin/items') }}" class="button is-primary">
                        <span class="icon" ><font-awesome-icon class="m-r-10" icon="arrow-left" size="xs" fixed-width/></span>
                        Back
                    </a>
                </header>
                <div class="card-content content" >
                    <a href="{{ url('/admin/items/'. $item->id.'/edit') }}" class="button is-primary ">
                        <span class="icon"><font-awesome-icon class="m-r-10" icon="edit" /></span>
                        Edit
                    </a>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{ $item->id }}</td>
                            </tr>
                            <tr>
                                <td>Title</td>
                                <td>{{ $item->title }}</td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>
                                    <a href="{{ url('/admin/categories/' . $item->category->id) }}">
                                        {{ $item->category->title }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Slug</td>
                                <td>{{ $item->slug }}</td>
                            </tr>
                            <tr>
                                <td>Tags</td>
                                <td>{{ $item->tags->pluck('title')->implode(',') }}</td>
                            </tr>
                            <tr>
                                <td>Images</td>
                                <td>
                                    <div class="columns">
                                        @foreach($item->images() as $image)
                                            <div class="column">
                                                <figure class="image is-128x128">
                                                    <img src="{{ $image->links['normal'] }}">
                                                </figure>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Created at</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </nav>
        </div>
    </div>
@endsection
