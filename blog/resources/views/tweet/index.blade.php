@extends('layouts.default')

@section('page-title')
    ツイート一覧
@endsection

@section('content')
    <div class="col-md-2">
        @if (Auth::check())
        {{ Auth::user()->name }}
        <a class="btn btn-primary" href="/tweets/create">ツイート新規投稿</a>
        @endif
    </div>
    <div class="col-md-10">
        @if (Session::has('flashmessage'))
        <div class="alert alert-success">
            {{ Session::get('flashmessage') }}
        </div>
        @endif
        <table class="table">
            <tbody>
                @foreach($tweets as $tweet)
                <tr>
                    <td>{{ $tweet->user->name }} : {{ $tweet->body }}</td>
                    <td class="text-right">
                        <a href="/tweets/{{ $tweet->id }}">詳細</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

