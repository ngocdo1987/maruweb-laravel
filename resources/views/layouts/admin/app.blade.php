<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <title>@yield('title') | {{ config('app.name') }}</title>

	<!-- Main Styles -->
	<link rel="stylesheet" href="/admin/styles/style.min.css">

	<!-- Themify Icon -->
	{{-- <link rel="stylesheet" href="/admin/fonts/themify-icons/themify-icons.css"> --}}

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="/admin/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="/admin/plugin/waves/waves.min.css">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="/admin/plugin/sweet-alert/sweetalert.css">

	<!-- Percent Circle -->
	<link rel="stylesheet" href="/admin/plugin/percircle/css/percircle.css">

	<!-- Chartist Chart -->
	<link rel="stylesheet" href="/admin/plugin/chart/chartist/chartist.min.css">

	<!-- FullCalendar -->
	<link rel="stylesheet" href="/admin/plugin/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="/admin/plugin/fullcalendar/fullcalendar.print.css" media='print'>

    <!-- Boostrap Tree View -->
	<link rel="stylesheet" href="/admin/plugin/treeview/bootstrap-treeview.css">

	<!-- Datepicker -->
	<link rel="stylesheet" href="/admin/plugin/datepicker/css/bootstrap-datepicker.min.css">

	<!-- DateRangepicker -->
	<link rel="stylesheet" href="/admin/plugin/daterangepicker/daterangepicker.css">

	<!-- Themify Icon -->
	<link rel="stylesheet" href="/admin/fonts/themify-icons/themify-icons.css">

	<!-- Remodal -->
	<link rel="stylesheet" href="/admin/plugin/modal/remodal/remodal.css">
	<link rel="stylesheet" href="/admin/plugin/modal/remodal/remodal-default-theme.css">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<link rel="apple-touch-icon" sizes="152x152" href="/frontend/img/apple-touch-icon-152x152.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/frontend/img/icon-16x16.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/frontend/img/icon-32x32.png">
	<style style="text/css">
		.ui-datepicker {
			z-index: 99 !important;
		}
	</style>
	@yield('css')
	@stack('scripts')
</head>

<body>
	<div class="main-menu">
		<header class="header">
			<a href="#" class="logo">{{ config('app.name') }}</a>
			<button type="button" class="button-close fa fa-times js__menu_close"></button>
		</header>
		<!-- /.header -->
		<div class="content">
			<div class="navigation">
				@include('layouts.admin._nav')
			</div>
			<!-- /.navigation -->
		</div>
		<!-- /.content -->
	</div>
	<!-- /.main-menu -->

    <div class="fixed-navbar">
        <div class="pull-left">
            <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
            <h1 class="page-title">@yield('title')</h1>
            <!-- /.page-title -->
        </div>
        <!-- /.pull-left -->
        <div class="pull-right">
			{{ auth()->user() ? auth()->user()->name :"" }}
            <div class="ico-item">
                <i class="ti-user"></i>
                <ul class="sub-ico-item">
                    <li><a class="" href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log Out') }}</a></li>
                </ul>
                <!-- /.sub-ico-item -->
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        <!-- /.pull-right -->
    </div>
    <!-- /.fixed-navbar -->

    <div id="wrapper">
        <div class="main-content">
            @yield('content')

            <footer class="footer">
                <ul class="list-inline">
                    <li>{{ date('Y') }} © {{ config('app.name') }}.</li>
                </ul>
            </footer>
        </div>
        <!-- /.main-content -->
    </div><!--/#wrapper -->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="/admin/script/html5shiv.min.js"></script>
		<script src="/admin/script/respond.min.js"></script>
	<![endif]-->
	<!--
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="/admin/scripts/jquery.min.js"></script>
	<script type="text/javascript" src="/js/datepicker_ja.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script src="/admin/scripts/modernizr.min.js"></script>
	<script src="/admin/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="/admin/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="/admin/plugin/nprogress/nprogress.js"></script>
	<script src="/admin/plugin/sweet-alert/sweetalert.min.js"></script>
	<script src="/admin/plugin/waves/waves.min.js"></script>
	<!-- Sparkline Chart -->
	<script src="/admin/plugin/chart/sparkline/jquery.sparkline.min.js"></script>
	<script src="/admin/scripts/chart.sparkline.init.min.js"></script>

	<!-- Percent Circle -->
	<script src="/admin/plugin/percircle/js/percircle.js"></script>

	<!-- Google Chart -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<!-- Chartist Chart -->
	<script src="/admin/plugin/chart/chartist/chartist.min.js"></script>
	<script src="/admin/scripts/jquery.chartist.init.min.js"></script>

	<!-- FullCalendar -->
	<script src="/admin/plugin/moment/moment.js"></script>
	<script src="/admin/plugin/fullcalendar/fullcalendar.min.js"></script>
	<script src="/admin/scripts/fullcalendar.init.js"></script>

    <script src="/admin/scripts/main.min.js"></script>

    <script src="/js/tinymce/tinymce.min.js"></script>

	<script type="text/javascript">

        tinymce.init({
			selector: 'textarea.tinymce',
			language: '{{ config('app.locale') }}',
			forced_root_block: false,
			preformatted: true,
			schema: 'html5',
			valid_children: '+a[h3],+a[div]',
			// extended_valid_elements: "a[href|onclick]", // script[src|async|defer|type|charset]
			extended_valid_elements: 'script[language|type|src],input[onclick|type|value|class]',
			plugins: 'preview paste importcss searchreplace autolink autosave save directionality code image link table charmap hr nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars responsivefilemanager',
			imagetools_cors_hosts: ['picsum.photos'],
			menubar: 'edit view insert format tools table help',
			toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | charmap | preview save | insertfile image link anchor',
			toolbar_sticky: true,
			autosave_ask_before_unload: true,
			autosave_interval: "30s",
			autosave_prefix: "{path}{query}-{id}-",
			autosave_restore_when_empty: false,
			autosave_retention: "2m",
			image_advtab: true,
			content_css: '//www.tiny.cloud/css/codepen.min.css',
			link_list: [
				{ title: 'My page 1', value: 'http://www.tinymce.com' },
				{ title: 'My page 2', value: 'http://www.moxiecode.com' }
			],
			image_list: [
				{ title: 'My page 1', value: 'http://www.tinymce.com' },
				{ title: 'My page 2', value: 'http://www.moxiecode.com' }
			],
			image_class_list: [
				{ title: 'None', value: '' },
				{ title: 'Some class', value: 'class-name' }
			],
			importcss_append: true,
			height: 400,
			template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
			template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
			height: 400,
			image_caption: true,
			quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
			noneditable_noneditable_class: "mceNonEditable",
			toolbar_mode: 'sliding',
			contextmenu: "",
			relative_urls: false,
			external_filemanager_path: "/filemanager/",
   			filemanager_title: "{{ __('File Manager') }}" ,
   			external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
		});


    </script>

	<!-- Demo Scripts -->
	<!-- Boostrap Tree View -->
	<script src="/admin/plugin/treeview/bootstrap-treeview.js"></script>

	<!-- Remodal -->
	<script src="/admin/plugin/modal/remodal/remodal.min.js"></script>

    @yield('js')
</body>
</html>