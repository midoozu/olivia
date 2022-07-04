@extends('layouts.frontend.app', ['activePage' => 'notifications', 'titlePage' => __('Notifications')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h3 class="card-title">Notifications</h3>
        <p class="card-category">Handcrafted by our friend
          <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. Please checkout the
          <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">full documentation.</a>
        </p>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">

            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
              </button>
              <span>
                <b> Danger - </b> This is a regular notification made with ".alert-danger"</span>
            </div>

          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="places-buttons">
          <div class="row">
            <div class="col-md-6 ml-auto mr-auto text-center">
              <h4 class="card-title">
                Notifications Places
                <p class="category">Click to view notifications</p>
              </h4>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 col-md-10 ml-auto mr-auto">
              <div class="row">
                <div class="col-md-4">
                  <button class="btn btn-primary btn-block" onclick="md.showNotification('top','left')">Top Left</button>
                </div>
                <div class="col-md-4">
                  <button class="btn btn-primary btn-block" onclick="md.showNotification('top','center')">Top Center</button>
                </div>
                <div class="col-md-4">
                  <button class="btn btn-primary btn-block" onclick="md.showNotification('top','right')">Top Right</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 col-md-10 ml-auto mr-auto">
              <div class="row">
                <div class="col-md-4">
                  <button class="btn btn-primary btn-block" onclick="md.showNotification('bottom','left')">Bottom Left</button>
                </div>
                <div class="col-md-4">
                  <button class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">Bottom Center</button>
                </div>
                <div class="col-md-4">
                  <button class="btn btn-primary btn-block" onclick="md.showNotification('bottom','right')">Bottom Right</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
