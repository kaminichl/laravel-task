@extends('frontend.layout')

@section('content')
     <h2 class="text-center">Register</h2>
        <div class="row">
     <div class="col-12">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Please fill your details</h5>
          </div>
          <div class="modal-body">
		  {{ Form::open(['name' => 'regsiter', 'id' =>'signupform' , 'url' => '/register', 'method' => 'POST']) }}

			
			@if(count($errors) > 0)
			  <div class="alert alert-danger">
				@foreach($errors->all() as $message)
					<span>{{ $message }}</span>
				@endforeach
				</div>
			@endif	
			

			<div class="form-group">
				{{-- Name field --}}
				{{ Form::label('name') }}
				{{ Form::text('name') }}
			</div>
			
			<div class="form-group">
				{{-- Email field --}}
				{{ Form::label('email', 'Email address') }}
				{{ Form::email('email') }}
			</div>
			
			<div class="form-group">
				{{-- Password field --}}
				{{ Form::label('password', 'Password') }}
				{{ Form::password('password') }}
			</div>
			
			<div class="form-group">
				{{-- Password confirmation field --}}
				{{ Form::label('password_confirmation', 'Password confirmation') }}
				{{ Form::password('password_confirmation') }}
			</div>
			
			
             <div class="form-group"> 
				{{-- Form submit button --}}
				{{ Form::submit('Register',['class'=>"submit btn btn-primary btn-shadow btn-gradient"]) }}
			</div>
			

		{{ Form::close() }}
           
          </div>
        </div>
      </div>
    </div>
        </div>
      </div>
@stop
