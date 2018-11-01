@extends('cms.layouts._default')

@section('content')	


<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Categorias</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{!!route('cms-categories')!!}">Categorias</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{!!(!isset($categories)) ? 'Novo' : 'Editar'!!}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{!!(!isset($categories)) ? 'Nova' : 'Editar'!!} Categoria</h4>
					@if(isset($categories))
					{!! Form::model($categories, ['route' => ['cms-categories-update', $categories->categories_id], 'method' => 'put']) !!}
					@else
					{!! Form::open(['method' => 'post', 'autocomplete' => 'off', 'route' => ['cms-categories-create']]) !!}
					@endif   
					<div class="form-group row">
						<label for="title" class="col-2 col-form-label">Módulo/Página </label>
						<div class="col-10">
							<select id="modules_id" name="modules_id" class="select2 form-control custom-select" data-placeholder="Selecione o Módulo/Página" style="width: 100%; height:36px;"  required >	
								<option value="">Selecione</option>
								@foreach ($modules as $value)
								<option value="{!! $value->modules_id !!}" @if(isset($categories)) {{   $categories->modules_id == $value->modules_id  ? "selected" : "" }} @endif >{!! $value->module!!}</option>
								@endforeach
							</select>
						</div>
					</div>	
					<div class="form-group row">
						<label for="title" class="col-2 col-form-label">Titulo da Categoria </label>
						<div class="col-10">
							{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Titulo da Categoria', 'required' => 'required', 'id' => 'title']) !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="subtitle" class="col-2 col-form-label">Sub-Titulo da Categoria </label>
						<div class="col-10">
							{!! Form::text('subtitle', null, ['class' => 'form-control', 'placeholder' => 'Sub Titulo da Categoria', 'required' => 'required', 'id' => 'subtitle']) !!}
						</div>
					</div>

					<button type="submit" class="btn btn-primary">Salvar</button>
					{!! Form::close() !!}   	
				</div>	    
			</div>
		</div>
	</div>
</div>


@endsection