@extends('admin::layouts.base')
@section('content')
<content-layout :page_data='@json($data)'></content-layout>
@endsection
