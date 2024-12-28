@extends('admin.layouts.guest')
@section('content')
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="{!! asset('images/login-page-img.png') !!}" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login To {{ config('app.name', 'Laravel') }}</h2>
						</div>
						<form method="POST" action="{{ route('admin.post.login') }}">
                            @csrf
							<div class="input-group custom">
                                <input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autofocus placeholder="email" />
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
                                <input id="password" class="form-control form-control-lg" type="password" name="password" required autocomplete="current-password" placeholder="********" />
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input id="remember_me" type="checkbox" class="custom-control-input" name="remember">
										<label class="custom-control-label" for="remember_me">Remember</label>
									</div>									
								</div>
								<div class="col-6 text-right">
									<a href="{{ route('admin.password') }}" class="text-primary">Forgot Password?</a>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
@endsection
