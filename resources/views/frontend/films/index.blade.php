@extends('frontend.layout')
{{-- Content --}}
@section('content')
 <router-view name="filmsIndex"></router-view>
  <router-view name="FilmsIndex"></router-view>
    <router-view></router-view>


{{-- Scripts --}}
@section('after-scripts-end')

@endsection