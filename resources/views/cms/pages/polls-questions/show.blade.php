@extends('cms.layouts._default')
@section('content')	


<!-- Breadcrumb -->
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
						<li class="breadcrumb-item active" aria-current="page">
							<a href="{!!route('cms-polls-questions', $polls->polls_id)!!}">								
								{!!$polls->question!!}
							</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Opções</li>
						<li class="breadcrumb-item active" aria-current="page">{!!(!isset($polls_questions)) ? 'Novo' : 'Editar'!!}</li>
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
					<h4 class="card-title">Cadastro de Enquete</h4>
					
					<div class="col-sm-12 col-xs-12">
						@if(isset($polls_questions))
						{!! Form::model($polls_questions, ['route' => ['cms-polls-questions-update', $polls->polls_id, $polls_questions->polls_questions_id], 'method' => 'put']) !!}
						@else
						{!! Form::open(['method' => 'post', 'autocomplete' => 'off', 'route' => ['cms-polls-questions-create', $polls->polls_id], 'files' => true]) !!}
						<input type="hidden" name="polls_id" value="{!!$polls->polls_id!!}">
						@endif  

						<div class="row">
							<div class="col-lg-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="icon-pencil" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('question', null, ['class' => 'form-control', 'placeholder' => 'Pergunta']) !!}
								</div>
							</div>
						</div>
						<hr>
						<button type="submit" class="btn btn-primary">Salvar</button>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



@endsection