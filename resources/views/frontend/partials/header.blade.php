<section>
    <div class="container py-2">        
        <div class="row align-items-center">
            <a class="col-12 col-sm-12 col-md-6 d-flex align-items-center" href="{{ route('frontend.home') }}" style="text-decoration: none; color: black;">
                <img src="{{ asset('assets/baec_logo.png') }}" alt="" class="img-fluid" height="60" width="60">
                <span class="ms-2">Bangladesh Atomic Energy Commission</span>
            </a>
            <div class="col-12 col-sm-12 col-md-6 gap-3 d-flex justify-content-end align-items-center">
                <a href="tel:+880212345678" class="text-decoration-none text-dark">
                    <i class="fas fa-phone-alt me-1"></i> +8802-8181846
                </a>
                <a href="mailto:info@baec.gov.bd" class="text-decoration-none text-dark">
                    <i class="fas fa-envelope me-1"></i> info@baec.gov.bd
                </a> 
                @role('super_admin')               
                <a href="{{ route('admin.dashboard')}}">
                    <button class="btn btn-primary" style="background-color: #0058A9; border: none;">
                        <i class="fas fa-user-shield me-1"></i> Dashboard
                    </button>
                </a>
                @endrole
                @if(Auth::check())
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <button class="btn btn-primary" style="background-color: #0058A9; border: none;">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </a>
                @else
                <a href="{{ route('login') }}">
                    <button class="btn btn-primary" style="background-color: #0058A9; border: none;">
                        <i class="fas fa-user me-1"></i> Login
                    </button>
                </a>
                <a href="{{ route('register') }}">
                    <button class="btn btn-primary" style="background-color: #0058A9; border: none;">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </button>
                </a>
                @endif
            
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</section>