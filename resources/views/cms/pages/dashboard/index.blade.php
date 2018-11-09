@extends('cms.layouts._default')

@section('content')	

<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Dashboard</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="#">Home</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">

	<div class="card-group">
		<div class="card bg-gradient-purple">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="d-flex no-block align-items-center">
							<div>
								<i class="fa fa-code font-20"></i>
								<p class="font-16 m-b-5">Versão</p>
							</div>
							<div class="ml-auto">
								<h1 class="font-light text-right">2.0</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card bg-gradient-green">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="d-flex no-block align-items-center">
							<div>
								<i class="fa fa-refresh font-20"></i>
								<p class="font-16 m-b-5">Última atualização</p>
							</div>
							<div class="ml-auto">
								<h1 class="font-light text-right">15/10/2018</h1>
							</div>
						</div>
					</div>
					<div class="col-12">
					</div>
				</div>
			</div>
		</div>
		<div class="card bg-gradient-orange">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="d-flex no-block align-items-center">
							<div>
								<i class="fa fa-database font-20"></i>
								<p class="font-16 m-b-5">Hospedagem</p>
							</div>
							<div class="ml-auto">
								<h1 class="font-light text-right">Ilimitada</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card bg-gradient-blue">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="d-flex no-block align-items-center">
							<div>
								<i class="fa fa-cog font-20"></i>
								<p class="font-16 m-b-5">Próximo vencimento</p>
							</div>
							<div class="ml-auto">
								<h1 class="font-light text-right">10/11/2018</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-3 col-md-6">
			<div class="card " title="{!!$day['text']!!}">
				<div class="card-body">
					<div class="d-flex no-block align-items-center">
						<div>
							<span class="text-muted display-6"><i class="ti-bar-chart"></i></span>
						</div>
						<div class="ml-auto text-right" >
							<h2>{!!$day['count']!!}<i class="{!!$day['rel']!!} font-14 text-{!!$day['target']!!}"></i></h2>
							<h6 class="text-muted">Visitas Hoje </h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="card " title="{!!$week['text']!!}">
				<div class="card-body">
					<div class="d-flex no-block align-items-center">
						<div>
							<span class="text-muted display-6"><i class="ti-bar-chart"></i></span>
						</div>
						<div class="ml-auto text-right">
							<h2>{!!$week['count']!!}<i class="{!!$week['rel']!!} font-14 text-{!!$week['target']!!}"></i></h2>
							<h6 class="text-muted">Vísitas essa semana</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="card " title="{!!$month['text']!!}">
				<div class="card-body">
					<div class="d-flex no-block align-items-center">
						<div>
							<span class="text-muted display-6"><i class="ti-bar-chart"></i></span>
						</div>
						<div class="ml-auto text-right">
							<h2>{!!$month['count']!!}<i class="{!!$month['rel']!!} font-14 text-{!!$month['target']!!}"></i></h2>
							<h6 class="text-muted">Vísitas esse mês </h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="card ">
				<div class="card-body">
					<div class="d-flex no-block align-items-center">
						<div>
							<h6>Desde</h6>
							<h6>{!!$year['date']!!}</h6>
						</div>
						<div class="ml-auto text-right">
							<h2>{!!$year['count']!!} </h2>
							<h6 class="text-muted">Total de Visitas </h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-8">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<ul class="list-inline float-right">
								<li class="list-inline-item">
									<h6 class="text-muted">
										<i class="fa fa-circle m-r-5 ct-b-legend"></i>Total de vísitas
									</h6>
								</li>
							</ul>
							<h4 class="card-title">Gráfico de vísitas anual </h4>
							<h5 class="card-subtitle">2018</h5>
						</div>
						<div class="col-12 m-t-20 revenue">
							<div class="graph-visitors" style="height: 350px;"></div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Atividades recentes (log)</h4>
					<div class="profiletimeline">
						<div class="sl-item">
							<div class="sl-left"> {!!img('users/2.jpg', array('class' => 'rounded-circle','width' => '40', 'height' => '40'))!!} </div>
							<div class="sl-right">
								<div><a href="javascript:void(0)" class="link">Humberto Martins</a> <span class="sl-date">5 minutos atrás</span>
								</div>
							</div>
						</div>
						<hr>
						<div class="sl-item">
							<div class="sl-left"> {!!img('users/2.jpg', array('class' => 'rounded-circle','width' => '40', 'height' => '40'))!!} </div>
							<div class="sl-right">
								<div> <a href="javascript:void(0)" class="link">Humberto Martins</a> <span class="sl-date">5 minutos atrás</span>
									<div class="m-t-20 row">
										<div class="col-md-9 col-12">
											<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. </p></div>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="sl-item">
								<div class="sl-left"> {!!img('users/2.jpg', array('class' => 'rounded-circle','width' => '40', 'height' => '40'))!!} </div>
								<div class="sl-right">
									<div><a href="javascript:void(0)" class="link">Humberto Martins</a> <span class="sl-date">5 minutos atrás</span>
										<p class="m-t-10"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper </p>
									</div>
								</div>
							</div>
							<hr>
							<div class="sl-item">
								<div class="sl-left"> {!!img('users/2.jpg', array('class' => 'rounded-circle','width' => '40', 'height' => '40'))!!} </div>
								<div class="sl-right">
									<div><a href="javascript:void(0)" class="link">Humberto Martins</a> <span class="sl-date">minutos atrás</span>
										<blockquote class="m-t-10">
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
										</blockquote>
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