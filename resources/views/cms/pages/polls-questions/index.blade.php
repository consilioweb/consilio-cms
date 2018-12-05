@extends('cms.layouts._default')
@section('content')


<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Enquetes</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{!!route('cms-polls')!!}">Enquetes</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{!!$poll->question!!}</li>
						<li class="breadcrumb-item active" aria-current="page">Opções</li>
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

			<div class="card">
				<div class="card-body">
					{!! Form::open(['method' => 'get', 'autocomplete' => 'on', 'route' => ['cms-polls-questions', $poll->polls_id]]) !!}
					<div class="row">

						<div class="form-group col-sm-12">
							{!!Form::text('title', null, ['class' => 'form-control','placeholder' => 'Titulo']) !!}	
						</div>



					</div>

					<div class="pull-left">
						<button type="submit" class="btn btn-theme btn-sm"><i class="fa fa-search"></i> Buscar</button>
						<a href="{!!route('cms-polls-questions-create', $poll->polls_id)!!}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Nova Opção</a>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Listagem de Perguntas</h4>
					<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
						<thead>
							<tr>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Pergunta</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Votos</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Ações</th>
							</tr>
						</thead>
						<tbody> 
							@foreach($polls_questions as $value)
							<tr>
								<td>{!!$value->question!!}</td>
								<td>{!!$value->votes!!} </td>
								<td class="" width="165">									
									<a title="Apagar" href="{!!route('cms-polls-questions-delete', array($value->polls_id,$value->polls_questions_id))!!}" class="btn waves-effect waves-light btn-light"> <i class="icon-trash"></i> </a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div> 
	</div>

</div>


@endsection 