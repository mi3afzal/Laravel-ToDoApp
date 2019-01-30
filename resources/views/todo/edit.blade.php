@extends( 'layouts.app' )

@section( 'title', 'Edit Todo' )

@section( 'content' )
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
                <div class="card-header">Update Todo</div>
                <div class="card-body">
					<form class="form-horizontal" method="post" action="{{url('/todo/'.$todo->id)}}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}

						<div class="form-group row">
							<label for="todo" class="col-md-3 col-form-label text-md-right">Todo</label>
							<div class="col-md-8">
								<input type="text" class="form-control {{ $errors->has('todo') ? ' is-invalid' : '' }}" id="todo" name="todo" placeholder="todo" value="{{$todo->todo}}" required> 

								@if ($errors->has('todo'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('todo') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="category" class="col-md-3 col-form-label text-md-right">Category</label>
							<div class="col-md-8">
								<input type="text" class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }}" id="category" name="category" placeholder="category" value="{{$todo->category}}" required> 

								@if ($errors->has('category'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('category') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="category" class="col-md-3 col-form-label text-md-right">Description</label>
							<div class="col-md-8">
								<textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" id="description" name="description" placeholder="category" required>{{$todo->description}}</textarea> 

								@if ($errors->has('description'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="offset-md-3 col-md-8">
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection