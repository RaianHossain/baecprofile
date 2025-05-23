<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>BAEC Profile - Dashboard</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">


	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/backend/global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/backend/assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/backend/assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/backend/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/backend/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ asset('assets/backend/global_assets/js/main/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/plugins/ui/ripple.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('assets/backend/global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>

	<script src="{{ asset('assets/backend/assets/js/app.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/demo_pages/dashboard.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/demo_charts/pages/dashboard/light/streamgraph.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/demo_charts/pages/dashboard/light/sparklines.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/demo_charts/pages/dashboard/light/lines.js') }}"></script>	
	<script src="{{ asset('assets/backend/global_assets/js/demo_charts/pages/dashboard/light/areas.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/demo_charts/pages/dashboard/light/donuts.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/demo_charts/pages/dashboard/light/bars.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/demo_charts/pages/dashboard/light/progress.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/demo_charts/pages/dashboard/light/heatmaps.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/demo_charts/pages/dashboard/light/pies.js') }}"></script>
	<script src="{{ asset('assets/backend/global_assets/js/demo_charts/pages/dashboard/light/bullets.js') }}"></script>
	<!-- /theme JS files -->

	@stack('scripts')

</head>

<body>

	<!-- Main navbar -->
	@include('backend.partials.navbar')
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		@include('backend.partials.sidebar')
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			@include('backend.partials.page-header', [
				'title' => $title ?? '',
				'breadcrumb' => $breadcrumb ?? []
			])
			<!-- /page header -->


			<!-- Content area -->
			@yield('content')
			<!-- /content area -->


			<!-- Footer -->
			@include('backend.partials.footer')
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>