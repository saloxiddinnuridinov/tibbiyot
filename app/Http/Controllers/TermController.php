<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Term::get();
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
            'keyword_latin' => 'required',
            'keyword_ru' => 'required',
            'keyword_uz' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $term = new Term();
            $term->keyword_latin = $request->keyword_latin;
            $term->keyword_ru = $request->keyword_ru;
            $term->keyword_uz = $request->keyword_uz;
            $term->description_uz = $request->description_uz;
            $term->description_ru = $request->description_ru;
            $term->save();
            return $term;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        return $term;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        return $term;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        $rules = [
            'keyword_latin' => 'required',
            'keyword_ru' => 'required',
            'keyword_uz' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
       
        if ($validator->fails()) {
            return response()->json($validator);
        }else{
            $term = Term::find($term->id);
            $term->keyword_latin = $request->keyword_latin;
            $term->keyword_ru = $request->keyword_ru;
            $term->keyword_uz = $request->keyword_uz;
            $term->description_uz = $request->description_uz;
            $term->description_ru = $request->description_ru;
            $term->save();
            return $term;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        $term->delete();
        return Term::all();
    }
}
