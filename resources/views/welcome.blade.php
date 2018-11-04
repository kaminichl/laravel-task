@extends('frontend.layout')

@section('content')
    
        <div class="row">
     <div class="col-12">
	  
	<router-view name="filmsIndex"></router-view>
	
    <router-view></router-view>
    
      
    </div>
        </div>
      </div>
@stop
