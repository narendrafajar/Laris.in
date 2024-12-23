<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}" autocomplete="off">
        @csrf
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header text-center">
                                <img src="{{asset('storage/larisin.png')}}" alt="" width="20%"><br>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <h4>{{__('Login')}}</h4>
                                </div>
                                <form>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" />
                                        <label class="form-label" for="inputEmail">Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <div class="input-group input-group-flat">
                                            <input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Masukan Kata Sandi') }}" required autocomplete="current-password">
                                            {{-- <label class="form-label" for="password"></label> --}}
                                            <span class="input-group-text">
                                                <a href="#" id="password-visibility" class="link-secondary" title="{{ __('Tampilkan kata sandi') }}" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    {{-- <div class="form-check mb-3">
                                        <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                        <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                    </div> --}}
                                    <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                                        {{-- <a class="small" href="password.html">Forgot Password?</a> --}}
                                        {{-- <x-primary-button class="ms-3">
                                            {{ __('Log in') }}
                                        </x-primary-button> --}}
                                        <button class="btn btn-primary" type="submit">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-login-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" /><path d="M3 12h13l-3 -3" /><path d="M13 15l3 -3" /></svg>
                                            {{__('Masuk')}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small">Registered &reg; <a href="potofolio.rndweb.my.id">{{__('RenWebTech')}}</a> 2024</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </form>
</x-guest-layout>
