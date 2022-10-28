<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Displays a list off all the items
    public function index()
    {
        $user_id = auth()->user()->id;      //get id of current user
        // Getting query params from URL. Eg; api/todos?status=[status]
        $status = request('status');
        if ($status) {
            // If status val passed as query param
            return Todo::where('status', $status)
                ->where('user_id', $user_id)
                ->get();    // return items that match the status and the user_id
        }
        return Todo::where('user_id', $user_id)->get(); // all items that match user_id
        // return Todo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;      //get id of current user
        // Create input validation
        $request->validate([
            'name' => 'required',
            // 'user_id' => 'required',
            'status' => ['required','in:NotStarted,OnGoing,Completed'],
        ]);
        $request->request->add(['user_id' => $user_id]);    //Add user id to request
        // $request = $request->merge(['user_id'=>$user_id]);
        return Todo::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Todo::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        $todo->update($request->all());
        return $todo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Todo::destroy($id);
    }

    /**
     * Search for a description specified.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($description)
    {
        return Todo::where('description', 'ilike', '%'.$description.'%')->get();    //using 'ilike' instead of 'like' makes it ignore case when searching
    }

    /**
     * Search for a description specified.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
