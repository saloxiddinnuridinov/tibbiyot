<?php

namespace App\Http\Controllers;

use App\Models\LessonJoinTerm;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonJoinTermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $model = LessonJoinTerm::get();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'lesson_id' => 'required',
            'term_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $lessonJoinTerm = new LessonJoinTerm();
            $lessonJoinTerm->lesson_id = $request->lesson_id;
            $lessonJoinTerm->term_id = $request->term_id;
            $lessonJoinTerm->save();
            return $lessonJoinTerm;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LessonJoinTerm  $lessonJoinTerm
     * @return \Illuminate\Http\Response
     */
    public function show(LessonJoinTerm $lessonJoinTerm)
    {
        return $lessonJoinTerm;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonJoinTerm  $lessonJoinTerm
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonJoinTerm $lessonJoinTerm)
    {
        return $lessonJoinTerm;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonJoinTerm  $lessonJoinTerm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LessonJoinTerm $lessonJoinTerm)
    {
        $rules = [
            'lesson_id' => 'required',
            'object_file_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
        return response()->json($validator);
        }else{
            $lessonJoinTerms = LessonJoinTerm::find($lessonJoinTerm->id);
            $lessonJoinTerms->lesson_id = $request->lesson_id;
            $lessonJoinTerms->term_id = $request->term_id;
            $lessonJoinTerms->save();
            return $lessonJoinTerms;
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonJoinTerm  $lessonJoinTerm
     * @return \Illuminate\Http\Response
     */
    public function destroy(LessonJoinTerm $lessonJoinTerm)
    {
        $lessonJoinTerm->delete();
        return $lessonJoinTerm::all();
    }
}
