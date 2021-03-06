@extends('cms.layouts._default')

@section('content')	



<div class="page-breadcrumb">
	<div class="row"> 
		<div class="col-5 align-self-center">
			<h4 class="page-title">{!!$module->module!!}</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{!!$module->module!!}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<!-- Alerts -->
			@include('cms.layouts._alerts')
			<div class="card">
				<div class="card-body">
					{!! Form::open(['method' => 'get', 'autocomplete' => 'on', 'route' => ['cms-contents-list', $module->modules_id]]) !!}
					<div class="row">

						<div class="form-group col-sm-6">
							{!!Form::text('title', null, ['class' => 'form-control','placeholder' => 'Titulo']) !!}	
						</div>

						<div class="form-group col-sm-6">
							{!!Form::select('status', ['1' => 'Ativo',  '2' => 'Inativo'], null, ['class' => 'form-control', 'placeholder' => "Selecione"]) !!}	
						</div>

					</div>

					<button type="submit" class="btn btn-theme btn-sm"><i class="fa fa-search"></i> Buscar</button>
					<a href="{!!route('cms-contents-list-create', $module->modules_id)!!}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Novo</a>
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- Column -->
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Listagem de Conteudo</h4>
					
					<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
						<thead>
							<tr>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">ID</th>
								@if(!empty($module->title))
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">{!!$module->title!!}</th>
								@endif

								@if(!empty($module->category))
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">{!!$module->category!!}</th>
								@endif

								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Cadastrado em</th>

								@if(!empty($module->image_gallery))
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Fotos</th>
								@endif

								@if(!empty($module->file_gallery))
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Arquivos</th>
								@endif

								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">A????es</th>
							</tr>
						</thead>
						<tbody>
							@foreach($contents as $value)
							<tr>
								<td>{!!$value->contents_id!!}</td>

								@if(!empty($module->title))
								<td>{!!limita_caracteres($value->title, 60)!!}</td>
								@endif

								@if(!empty($module->category))
								<td>{!!$value->categorie->title!!}</td>
								@endif

								<td>
									<i class="icon-calender" aria-hidden="true"></i> {!!extractDate($value->created_at)!!} ??s 
									<i class="icon-clock" aria-hidden="true"></i> {!!extrateHour($value->created_at)!!}
								</td>

								@if(!empty($module->image_gallery))
								<td>
									<a title="Imagens" href="{!!route('cms-gallery',  array($module->modules_id, $value->contents_id))!!}" class="btn waves-effect waves-light btn-light"> <i class="icon-camera"></i> Galeria</a>
								</td>
								@endif

								@if(!empty($module->file_gallery))
								<td>
									<a title="Arquivos" href="{!!route('cms-archives',  array($module->modules_id, $value->contents_id))!!}" class="btn waves-effect waves-light btn-light"> <i class=" ti-files"></i> Arquivos</a>
								</td>
								@endif

								<td class="" width="165">
									@if($value->status == 1)
									<a title="Status: Ativo" href="{!!route('cms-contents-list-status', array($module->modules_id , $value->contents_id, "desativar"))!!}" class="btn waves-effect waves-light btn-success"> 
										<i class="ti-check"></i> 
									</a>
									@elseif($value->status == 2)
									<a title="Status: Inativo" href="{!!route('cms-contents-list-status', array($module->modules_id , $value->contents_id, "ativar"))!!}" class="btn waves-effect waves-light btn-danger"> 
										<i class="ti-close"></i> 
									</a>
									@endif

									<a title="Editar" href="{!!route('cms-contents-list-update',  array($module->modules_id, $value->contents_id))!!}" class="btn waves-effect waves-light btn-light"> <i class="ti-pencil"></i> </a>
									<a title="Apagar" href="{!!route('cms-contents-list-delete', array($module->modules_id, $value->contents_id))!!}" class="btn waves-effect waves-light btn-light"> <i class="icon-trash"></i> </a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- Column -->
		</div>
	</div>
</div>


@endsection 