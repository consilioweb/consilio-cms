@extends('cms.layouts._default')
@section('content')	


<div class="page-breadcrumb">
	<div class="row"> 
		<div class="col-5 align-self-center">
			<h4 class="page-title">Arquivos</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{!!route('cms-contents-list', $module->modules_id)!!}">{!!$module->module!!} </a>
						</li>
						<li class="breadcrumb-item">
							<a href="{!!route('cms-contents-list-show', array( $module->modules_id, $content->contents_id))!!}">
								{!!limita_caracteres($content->title, 15)!!}
							</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Arquivos</li>
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
		<div class="col-md-12">

			<!-- Gallery -->
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Listagem de Arquivos</h4>
					<h6 class="card-subtitle">Envie arquivos apenas com as seguintes extenções: <code>{!!$definitions->ext_files!!}</code></h6>

					{!! Form::open(['id' => 'files-upload', 'method' => 'post', 'autocomplete' => 'off', 'route' => ['cms-archives-upload', $module->modules_id, $content->contents_id], 'files' => true]) !!}
					<div class="dz-message" data-dz-message><span>Clique ou Arraste aqui os Arquivos</span></div>
					<div class="fallback">
						<input name="file" type="file" multiple />
					</div>
					{!! Form::close() !!} 
					<input type="hidden" name="app_redirect" id="app_redirect" value="arquivos">
					<input type="hidden" name="app_modules" id="app_modules" value="{!!$module->modules_id!!}">
					<input type="hidden" name="app_contents" id="app_contents" value="{!!$content->contents_id!!}">
				</div>
			</div>
		</div>
	</div>
</div>

@endsection 