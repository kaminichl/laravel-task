@extends('frontend.layout')

@section('content')
     <h2 class="text-center">Login</h2>
        <div class="row">
     <div class="col-12">
	  
      <div role="document" class="modal-dialog">
        <div class="modal-content">
         
          <div class="modal-body">
		  @if(count($errors) > 0)
		  <div class="alert alert-danger">
			@foreach($errors->all() as $message)
				<span>{{ $message }}</span>
			@endforeach
			</div>
		 @endif	
			
            {{ Form::open(['name' => 'regsiter', 'id' =>'loginform' , 'url' => '/login', 'method' => 'POST']) }}
             <div class="form-group">
				{{-- Name field --}}
				{{ Form::label('email') }}
				{{ Form::text('email') }}
			</div>
			<div class="form-group">
				{{-- Password field --}}
				{{ Form::label('password', 'Password') }}
				{{ Form::password('password') }}
			</div>
             
           
              <div class="form-group">
                <button type="submit" class="submit btn btn-primary btn-shadow btn-gradient">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    
      
    </div>
        </div>
      </div>
@stop
