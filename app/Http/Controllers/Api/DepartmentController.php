<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department =Department::all();
        return response()->json([
            'data'=> $department,
            'message'=>'all department data ',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $result = Department::create([
            'name'=>$request->name,
        ]);
        return response()->json([
            'data'=> $result,
            'message'=>'department created ',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department =Department::find($id);
        return response()->json([
            'data'=> $department,
            'message'=>'this department data ',
        ]);
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
        $request->validate([
            'name'=>'required',
        ]);
        $department =Department::find($id);
        $department->name = $request->name;
        $department->save();
        return response()->json([
            'data'=> $department,
            'message'=>'this department name is updated ',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department =Department::find($id);
        $result = $department->delete();
        return response()->json([
            'data'=> $result,
            'message'=>'department deleted',
        ]);
        
    }
}
