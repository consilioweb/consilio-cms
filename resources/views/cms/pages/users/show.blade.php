@extends('cms.layouts._default')

@section('content')	



<!-- Breadcrumb -->
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Usuários</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							<a href="{!!route('cms-users')!!}">Usuários</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{!!(!isset($users)) ? 'Novo' : 'Editar'!!}</li>
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
					<h4 class="card-title">Usuários</h4>
					
					<div class="col-sm-12 col-xs-12">

						@if(isset($users))
						{!! Form::model($users, ['route' => ['cms-users-update', $users->users_id], 'method' => 'put', 'files' => true]) !!}
						@else
						{!! Form::open(['method' => 'post', 'autocomplete' => 'off', 'route' => ['cms-users-create'], 'files' => true]) !!}
						@endif  

						<div class="row">
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-user" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Primeiro Nome ']) !!}
								</div>
							</div>
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-user" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Sobrenome ']) !!}
								</div>
							</div>							
						</div>

						<div class="row">
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-email" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email ', 'autocomplete' => 'off ']) !!}
								</div>
							</div>
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-lock" aria-hidden="true"></i></span>
									</div>
									{!! Form::password('password_input', ['class' => 'form-control password-input', 'placeholder' => 'Senha ', 'autocomplete' => 'off ']) !!}
								</div>
							</div>							
						</div>
						
						<div class="row">
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-calendar" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('birth', null, ['class' => 'form-control datepicker']) !!}
								</div>
							</div>
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="icon-energy" aria-hidden="true"></i></span>
									</div>
									{!!Form::select('type', ['1' => 'Administrador do Sitema',  '2' => 'Adminsitrador do Site',  '3' => 'Usuário do Site'], null, ['placeholder' => "Selecione", 'class' => 'form-control select2', "required" => "required"]) !!}	
								</div>
							</div>							
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="border-preview-img">
									
									<div class="input-group mb-3">
										{!! Form::file('image', ['class' => 'form-control input-file', 'id' => 'photo_profile']) !!}
										<div id="image-holder">				 				
											@if(!empty($users->photo))
											<div class="btn-thumb">
												@if($users->photo != "default.jpg")
												<a style="margin-bottom: 7px;" href="{!!route('cms-users-photos',  array($users->users_id, "delete"))!!}" class="btn waves-effect waves-light btn-dark">
													<i class="icon-trash"></i> Excluir
												</a>
												@endif
											</div>
											{!!img($users->photo, 400, 400, true, true, array("class" => "cover"))!!}
											@endif
										</div> 
									</div>
									<small>*A imagem está com tamanho alterado para melhor pré-visualização, será salva com tamanho original.</small>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Salvar</button>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



@endsection