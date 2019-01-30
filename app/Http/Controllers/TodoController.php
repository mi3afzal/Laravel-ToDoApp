<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
	{
		$result = Auth::user()->todo()->get();
		
		if($result->isEmpty()) $result = false;

		return view('todo.index',['todos'=>$result,'image'=>Auth::user()->userimage,'username'=>Auth::user()->name]);
	}
	
	/**
	* Get a validator for an incoming Todo request.
	*
	* @param  array  $request
	* @return \Illuminate\Contracts\Validation\Validator
	*/
	protected function validator(array $request)
	{
		return Validator::make($request, [
			'todo' => 'required',
			'description' => 'required',
			'category' => 'required'
		]);
	}
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
		if(Auth::user()->todo()->Create($request->all())){
			return $this->index();
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return view('todo.todo', ['todo' => $todo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        return view('todo.edit',['todo' => $todo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $this->validator($request->all())->validate();
		if($todo->fill($request->all())->save()){
			return $this->show($todo);
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        if($todo->delete()){
			return back();
		}
    }
}
