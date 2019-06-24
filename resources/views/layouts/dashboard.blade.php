<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Administration</title>


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

</head>
<body>
	
	<div class="content">
		
		<nav>
			<div class="logo">
				<a href="{{ route('admin.index') }}">WebExpert </a>
			</div>

			<div class="user">
				<img src="{{ asset('images/user.png') }}" alt="">
				<div class="user-info">
					<span>{{ Auth::user()->name }}</span>
					<span></span>
				</div>
			</div>

			<div class="navbar-custom">
				<ul>
					<li>
						<a href="{{ route('admin.index') }}">
							<i class="fas fa-home"></i>
						<span>Dashboard Home</span>
						</a>
					</li>

					<li>
							<a href="{{ route('home') }}">
								<i class="fas fa-user"></i>
								<span>Edit your profile</span>
							</a>
					</li>

					@if(Auth::user()->isAdministrator())
						<li>
							<a href="{{ route('customers.index') }}">
								<i class="fas fa-user"></i>
								<span>Manage Customers</span>
							</a>
						</li>
					@endif
				</ul>
			</div>

			<div class="line"></div>

		</nav>

		<main>
			
			<div class="top-options">
				<a href="{{ route('index') }}" target="_blank" class="visit">Visit Site</a>
				<a href="#" class="logout" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                 Logout
                  </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                    </form>
			</div>

			<div class="navbar2">
				<ul>
					<li>
						<a href="{{ route('admin.index') }}">
							<i class="fas fa-home"></i>
						<span>Dashboard Home</span>
						</a>
					</li>

					<li>
							<a href="{{ route('home') }}">
								<i class="fas fa-user"></i>
								<span>Edit your profile</span>
							</a>
					</li>

					@if(Auth::user()->isAdministrator())
						<li>
							<a href="{{ route('customers.index') }}">
								<i class="fas fa-user"></i>
								<span>Manage Customers</span>
							</a>
						</li>
					@endif
				</ul>
			</div>

			<div class="main">
				@yield('content')
			</div>

		</main>

	</div>
	
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="{{ asset('js/dashboard.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>

	@yield('scripts')
</body>
</html>