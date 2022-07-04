<div class="wrapper ">
  @include('layouts.frontend.navbars.sidebar')
  <div class="main-panel">
    @include('layouts.frontend.navbars.navs.auth')

      @if(session('message'))
          <div class="row mb-2">
              <div class="col-lg-12">
                  <div class="alert alert-success" role="alert">{{ session('message') }}</div>
              </div>
          </div>
      @endif
      @if($errors->count() > 0)
          <div class="alert alert-danger">
              <ul class="list-unstyled">
                  @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif


    @yield('content')

    @include('layouts.frontend.footers.auth')
  </div>
</div>
