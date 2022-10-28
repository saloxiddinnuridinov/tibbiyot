<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Student::get();
        return $model;
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
     * Store a newly created resource n storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();

        $rules = [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $student = new Student();
            $student->name = $request->name;
            $student->surname = $request->surname;
            $student->email = $request->email;
            $student->email_verified_at = $request->email_verified_at;
            $student->status = $request->status;
            $student->block_reason = $request->block_reason;
            $student->is_blocked = $request->is_blocked;
            $student->password = $request->password;
            $student->balance = $request->balance;
            $student->birthday = $request->birthday;
            $student->save();
            return $student;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return $student;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return $student; 
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
        $rules = [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json($validator);
    }else{
        
        $update_student = Student::find($student->id);
        $update_student->name = $request->name;
        $update_student->surname = $request->surname;
        $update_student->email = $request->email;
        $update_student->email_verified_at = $request->email_verified_at;
        $update_student->status = $request->status;
        $update_student->block_reason = $request->block_reason;
        $update_student->is_blocked = $request->is_blocked;
        $update_student->password = $request->password;
        $update_student->balance = $request->balance;
        $update_student->birthday = $request->birthday;
        $update_student->save();
        return $update_student;
    }
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
        return Student::all();
    }
}
