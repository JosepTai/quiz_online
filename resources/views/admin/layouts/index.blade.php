<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="admin_asset/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin_asset/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="admin_asset/css/style.css">
    <link rel="stylesheet" href="admin_asset/css/my.css">
    <link rel="shortcut icon" href="admin_asset/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.layouts._navbar')
      <div class="container-fluid page-body-wrapper">
        @include('admin.layouts._sidebar')
        <div class="main-panel">
          <div class="content-wrapper">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
    <script src="admin_asset/vendors/js/vendor.bundle.base.js"></script>
    <script src="admin_asset/vendors/js/vendor.bundle.addons.js"></script>
    <script src="admin_asset/js/off-canvas.js"></script>
    <script src="admin_asset/js/misc.js"></script>
    <script src="admin_asset/js/dashboard.js"></script>
  </body>
</html>