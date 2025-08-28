<x-guest-layout>
    @section('title')
        {{ 'Log in' }}
    @endsection
    <section class="p-3 p-md-4 p-xl-5">
    <div class="container">
    <div class="card border-light-subtle shadow-sm">
      <div class="row g-0">
        <div class="col-12 col-md-6">
          <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src={{ asset('images/HomeBanner.jpg') }} alt="">
        </div>
        <div class="col-12 col-md-6">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <div class="row">
              <div class="col-12">
                <div class="card-header text-center">
                    <a href="/" class="h1"><b>{{ config('app.name') }}</a>
                </div>
              </div>
            </div>
            <form action="{{ route('login') }}" method="POST">
              @csrf
              <div class="row gy-3 gy-md-4 overflow-hidden">
                Username:
                <div class="input-group mb-3">
                        <input id="email" class="form-control" type="email" name="email" :value="old('email')"
                            required autofocus autocomplete="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                </div>
                Password:
                <div class="input-group mb-3">
                  <input id="password" class="form-control" type="password" name="password" required
                            autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 danger" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 danger" />
                </div>
                </div>
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn bsb-btn-xl btn-primary" type="submit">Log in now</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-12">
                <hr class="mt-5 mb-4 border-secondary-subtle">
                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                    <p class="mb-1">
                        <a href="{{ route('password.request') }}">I forgot my password</a>
                    </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    {{-- <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>{{ config('app.name') }}</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" class="form-control" type="email" name="email" :value="old('email')"
                            required autofocus autocomplete="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" class="form-control" type="password" name="password" required
                            autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                {{-- <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="{{ route('facebook.login') }}" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="{{ route('google.login') }}" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                    <a href="{{ route('github.login') }}" class="btn btn-block btn-dark">
                        <i class="fab fa-github mr-2"></i> Sign in using Github
                    </a>
                </div> --}}
                {{-- <p class="mb-1">
                    <a href="{{ route('password.request') }}">I forgot my password</a>
                </p> --}}
                {{-- <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Register a new Account</a>
                </p> --}}
            {{-- </div> --}}
            <!-- /.card-body -->
        {{-- </div> --}}
        <!-- /.card -->
    {{-- </div> --}}
</x-guest-layout>
