@extends('cms.layouts._default')

@section('content')	


<!-- Breadcrumb -->
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Backup</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Banco de Dados</li>
						<li class="breadcrumb-item active" aria-current="page">Backup</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">		
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Backup de Banco de Dados</h4>

					<div class="col-sm-12 col-xs-12">
						<form>							
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-pencil-square-o"></i></span>
								</div>
								<input type="text" name="db" class="form-control" placeholder="Banco de Dados" value="{!!$db['database']!!}" disabled="disabled">
							</div>	
							<div class="form-grou">
								@foreach($tables as $table)
								@foreach($table as $key => $value)
								<div class="row">
									<div class="col-md-12 custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="{!!$value!!}">
										<label class="custom-control-label" for="{!!$value!!}">{!!$value!!}</label>
									</div>
								</div>										
								@endforeach
								@endforeach
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
