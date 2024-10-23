<x-guest-layout>
    <div class="wrapper">
        <section class="login-content">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="offset-md-2 col-md-8 col-sm-12 mt-5">
                        <div class="row align-items-center">
                            <!-- Session Status -->
                            <x-auth-session-status class="alert alert-success" :status="session('status')" />
                            <div class="col-md-8 col-sm-12">
                                <h2 class="mb-2">Sign In</h2>
                                <p>Devi effettuare il login per vedere I lead.</p>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row" bis_skin_checked="1">
                                        <!-- Email Address -->
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group">
                                                <x-text-input id="email" class="floating-input form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                                <x-input-label for="email" :value="__('Email')"/>
                                                <x-input-error :messages="$errors->get('email')" class="text text-danger" />
                                            </div>
                                        </div>
                                        <!-- Password -->
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group">
                                                <x-text-input id="password" class="floating-input form-control" type="password" name="password" required autocomplete="current-password" />
                                                <x-input-label for="password" :value="__('Password')" />
                                                <x-input-error :messages="$errors->get('password')"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                                                <label class="custom-control-label" for="remember_me">{{ __('Remember me') }}</label>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6 rtl-left">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-primary float-right">{{ __('Forgot your password?') }}</a>
                                            @endif
                                        </div> --}}
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>
