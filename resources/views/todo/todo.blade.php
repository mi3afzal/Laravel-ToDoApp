@extends( 'layouts.app' )

@section( 'title', title_case($todo->todo) )

@section( 'content' )
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary"><h3>{{title_case($todo->todo)}} <a href="{{url('/todo/'.$todo->id).'/edit'}}" class="btn btn-warning btn-sm float-right">Edit</a></h3></div>
                <div class="card-body">{{$todo->description}}</div>
				<div class="card-footer"><strong>Category:</strong> {{$todo->category}}</div>
			</div>
		</div>
	</div>
</div>
@endsection