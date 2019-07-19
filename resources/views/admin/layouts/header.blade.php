<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ !empty($title)? $title : trans('admin.adminpanel')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('/design/admin') }}/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/design/admin') }}/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('/design/admin') }}/css/ionicons.min.css">
  <!-- Theme style -->
  @if(direction() == 'ltr')
  <link rel="stylesheet" href="{{asset('/design/admin')}}/css/AdminLTE.min.css"><!-- ltr -->
  @else
  <link rel="stylesheet" href="{{asset('/design/admin')}}/css/rtl/AdminLTE.min.css"><!-- rtl -->
  <link rel="stylesheet" href="{{asset('/design/admin')}}/css/rtl/bootstrap-rtl.min.css">
  <link rel="stylesheet" href="{{asset('/design/admin')}}/css/rtl/rtl.css">
  <link href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700&amp;subset=arabic" rel="stylesheet">
  <style>html,body,*{font-family: Tajawal}</style>
  @endif
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('/design/admin') }}/css/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('/design/admin') }}/css/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('/design/admin') }}/css/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('/design/admin') }}/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('/design/admin') }}/css/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('/design/admin') }}/css/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="{{ asset('/design/admin') }}/css/jstree-style.min.css">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300i,400i,600i" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  @stack('css')

</head>
<body class="hold-transition skin-blue sidebar-mini">
