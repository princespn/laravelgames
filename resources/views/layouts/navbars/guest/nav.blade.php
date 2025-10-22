<!-- <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <nav class=" navbar navbar-expand-lg blur blur-rounded mx-auto w-100 mt-2 shadow position-absolute start-0 end-0 ">
                <div class="container-fluid">
                    <a class="navbar-brand" target="_blank" href="https://www.thehscc.co.uk/">
                        <img src="{{asset('images/logo/Energeios.png')}}" class="img-fluid" />
                    </a>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ms-auto">
                            @if(!\Request::is('sign-up'))
                            <li class="nav-item">
                                <a href="{{url('/sign-up')}}" target="_blank" class="nav-link me-2">
                                    <i class="fas fa-user-circle opacity-6 text-dark me-1" aria-hidden="true"></i> Sign Up
                                </a>
                            </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{url('/login')}}"  target="_blank" class="nav-link me-2">
                                        <i class="fas fa-user-circle opacity-6 text-dark me-1" aria-hidden="true"></i> Login
                                    </a>
                                </li>
                                @endif
                        </ul>
                    </div>
                    <div id="google_translate_element"></div>
                </div>
            </nav>
        </div>
    </div>
</div>
 -->