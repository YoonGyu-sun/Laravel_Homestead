@extends('showlayouts.showlayout')

    {{-- 사용자 auth --}}
    @section('session_name')
            {{ $management->user->name }}
    @endsection

    {{-- 카테고리 --}}
    @section('type')
        <div>
            {{ old('type',$management->type) }}
        <div>
    @endsection

    {{-- 게시물 --}}
    @section('title1')
        <div>
            {{ old('title',$management->title) }}
        </div>
    @endsection

    {{-- body --}}
    @section('qq')
        <div>
            {{ old('body',$management->body) }}
        <div>    

    @endsection

