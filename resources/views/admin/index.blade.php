@extends('layouts.dashboard')

@section('content')

		<h1> {{ Auth::user()->name }}, welcome to the administration panel.</h1>
		<h4>
			<i>Start managing your backend with this completely clean and easy to use management system.</i>
		</h4>

@endsection