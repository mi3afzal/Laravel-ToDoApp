@extends( 'layouts.app' )

@section( 'title', 'Home' )

@section( 'content' )
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
			<ul class="list-group">
				@if($todos != false) @foreach ($todos as $todo)

				<li class="list-group-item">
					{{$todo->todo}}
					<span class="float-right">
						<a class="secondary-content" href="{{url('/todo/'.$todo->id)}}">Detail</a>
						<a class="secondary-content" href="{{url('/todo/'.$todo->id).'/edit'}}">Edit</a>
						<a href="#" class="secondary-content" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete</a>
						<form id="delete-form" action="{{url('/todo/'.$todo->id)}}" method="POST" style="display: none;">
							{{ method_field('DELETE') }}{{ csrf_field() }}
						</form> 					
					</span>
				</li>

				@endforeach @else
				<li class="list-group-item"> No Todo added yet <a href="{{ url('/todo/create') }}"> click here</a> to add new todo. </li>
				@endif
			</ul>
		</div>

		<div class="col-md-3">
			<img class="img-fluid rounded-circle img-thumbnail" alt="{{$username}}" title="{{$username}}" src="{{asset('storage/'.$image)}}">
		</div>
	</div>
</div>
@endsection