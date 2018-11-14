@extends('cms.layouts._default')
@section('content')



<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Anuncios</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Plugins</li>
						<li class="breadcrumb-item active" aria-current="page">Anúncios</li>
					</ol>
				</nav>
			</div>
		</div>
	</div> 
</div>

<div class="container-fluid">
	<!-- Alerts -->
	@include('cms.layouts._alerts')


	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">

					<a href="#" class="btn waves-effect waves-light btn-outline-dark active" style="border-bottom-right-radius: 0; border-bottom-left-radius: 0;">Anúncios</a>

					<div class="tab-content tabcontent-border">
						<div class="tab-pane active" id="home" role="tabpanel">
							<div class="row">
								<div class="col-8">
									
								</div>
								<div class="col-4"></div>
							</div>
						</div>
						<div class="tab-pane  p-20" id="profile" role="tabpanel">2</div>
						<div class="tab-pane p-20" id="messages" role="tabpanel">3</div>
					</div>

				</div>
			</div>
		</div>
	</div>


	<div class="row">

		<div class="col-md-7">
			<div class="card card-accent-theme">
				<div class=" products-widget">
					<div class="header">
						<div class="heading">Anuncios</div>
					</div>
					<!-- end header -->
					<div class="table-responsive">
						<table class="table table-hover">
							<tr>
								<td class="doc-img">
									<img src="http://via.placeholder.com/100x100" alt="user" />
								</td>
								<td class="document">
									bannerbig - Agência Crown
								</td>

								<td class="status">
									<span class="badge badge-boxed badge-success">Ativo</span>
								</td>
								<td class="user">

									<div class="heading">Sem Expirar</div>
									<br/>
									<small>--/--/---- </small>

								</td>
								<td class="action">
									<button class="btn btn-theme btn-sm">
										<i class="mdi mdi-dots-vertical"></i>
									</button>
								</td>

							</tr>
						</table>
						<!-- end table -->
					</div>
					<!-- end table-responsive -->
				</div>
				<!-- end product-widget -->

			</div>
			<!-- end card -->
		</div>
		<!-- end-col -->

		<div class="col-md-5 summary-widgets">

			<div class="card card-accent-theme">

				<div class="card-body">
					<h6 class="text-theme">Summary</h6>
					<div class="row">
						<div class="col-md-6 summary-widget-1">
							<div class="card ">
								<div class="card-body">
									<div class="number">21</div>
									<small>Active Users</small>
									<div class="progress xs ">
										<div class="progress-bar bg-info" style="width: 80%; " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6 summary-widget-1">
							<div class="card ">
								<div class="card-body">
									<div class="number">38</div>
									<small>Over Due</small>
									<div class="progress xs ">
										<div class="progress-bar bg-danger" style="width: 60%; " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6 summary-widget-1">
							<div class="card">
								<div class="card-body">
									<div class="number">120</div>
									<small>Sales</small>
									<div class="progress xs ">
										<div class="progress-bar bg-success" style="width: 60%; " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6 summary-widget-1">
							<div class="card ">
								<div class="card-body">
									<div class="number">12</div>
									<small>expense</small>
									<div class="progress xs ">
										<div class="progress-bar bg-warning" style="width: 60%; " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6 summary-widget-1">
							<div class="card ">
								<div class="card-body">
									<div class="number">21</div>
									<small>Active Users</small>
									<div class="progress xs ">
										<div class="progress-bar bg-info" style="width: 10%; " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6 summary-widget-1">
							<div class="card ">
								<div class="card-body">
									<div class="number">10</div>
									<small>Over Due</small>
									<div class="progress xs ">
										<div class="progress-bar bg-danger" style="width: 20%; " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
										</div>
									</div>
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