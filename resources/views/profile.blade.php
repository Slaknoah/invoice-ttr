@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="/uploads/{{ $user->avatar }}" width="150px" height="150px" class="user-avatar">
            <h3>Профиль {{ $user->name }}</h3>
            <form enctype="multipart/form-data" action="/profile" method="POST">
                <label>Обновить фотографию профиля</label>
                <div class="file-field input-field">
                  <div class="btn waves-effect waves-light">
                    <span>Выбрать файл</span>
                    <input type="file" name="avatar">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                  </div>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn right" value="Отправить">
            </form>
        </div>
    </div>
</div>
@endsection
