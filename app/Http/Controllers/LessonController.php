<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lesson = Lesson::get();
        return $lesson;
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
            'title_uz' => 'required',
            'title_ru' => 'required',
            'category_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $lesson = new Lesson();
            $lesson->title_ru = $request->title_ru;
            $lesson->title_uz = $request->title_uz;
            $lesson->category_id = $request->category_id;
            $lesson->save();
            return $lesson;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        return $lesson;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        return $lesson;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $rules = [
            'title_uz' => 'required',
            'title_ru' => 'required',
            'category_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
        return response()->json($validator);
        }else{
            $lesson_update = Lesson::find($lesson->id);
            $lesson_update->title_ru = $request->title_ru;
            $lesson_update->title_uz = $request->title_uz;
            $lesson_update->category_id = $request->category_id;
            $lesson_update->save();
            return $lesson_update;
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return Lesson::all();
    }
}
