@extends('layouts.app')

@section('content')
    <div class="container">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Post title</th>
                    <th scope="col">Created at</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td class="ellipsis">{{$post->title}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>
                        <div class="form-inline">
                            <form method="get" action="{{route('post.index.edit',$post->id)}}">
                                @csrf
                                <button class="btn btn-outline-secondary mr-1"><i class="far fa-edit"></i></button>
                            </form>
                            <form method="post" action="{{route('admin.delete',$post)}}">
                                @csrf
                                <button class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button>
                            </form>

                        </div>

                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $posts->withQueryString()->links() }}
            </div>

    </div>
@endsection
