<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $student = Student::paginate(10);
        return response()->json([
            'status' =>true,
            'student' => [],
        ]);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // TO ADD THE INFO INTO DB
        $student = Student::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'address' =>$request->address,
            'sCourse' =>$request->sCourse,
        ]);
        // TO DISPLAY MESSAGE WHEN ADDED SUCCEED
        return response()->json([
            'message' =>'Student successfully added!',
            'student' => $student,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        // DISPLAY THE LIST OF STUDENTS INFO IN DB
        $student = Student::all();
        return response()->json([
            'student' => $student,
            'status' => true
        ],200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {

        $student->update($request->all());


        // $student->name = $request->name;
        // $student->email = $request->email;
        // $student->address =$request->address;
        // $student->sCourse =$request->sCourse;
        // $student->save();

        return response()->json([
            'message' =>'Update Succesfully',
            'student' => $student,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json([
            'message' =>'Delete Successfully',
        ], 204);
    }
}
