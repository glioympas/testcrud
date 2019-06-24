@extends('layouts.app')


@section('content')

<div class="container">
	<div class="card ">
	  <h5 class="card-header">Welcome to this simple CRUD app</h5>
	  <div class="card-body">
	    <h5 class="card-title">
	    	@auth
	   			Welcome {{ Auth::user()->name }}
	   		@endauth
	   		@guest
				 You need to login to access your profile.
				 Administators can also manage customer users.
	   	 	@endguest
		</h5>
	    <div class="card-text">
	    	<p>
	    		@auth
					You are logged in as an {{ Auth::user()->isAdministrator() ? 'Administrator' : 'Customer' }}.
	    		@endauth
	    		@guest
	    			Administrator account / password:   [g.lioympas@gmail.com] / [password]
	    		@endguest
	    	</p>
		</div>
		@auth
			@if(Auth::user()->isAdministrator())
				<a href="{{ route('admin.index') }}" class="btn btn-primary">
			    	Visit Administration Dashboard
			    </a>
			@else
				<a href="{{ route('home') }}" class="btn btn-primary">
			    	Visit Your Profile 
			    </a>
			@endif
		@endauth
		@guest
		    <a href="{{ route('login') }}" class="btn btn-primary">
		    	Login to access app
		    </a>
	    @endguest
	  </div>
	</div>
</div>

@endsection