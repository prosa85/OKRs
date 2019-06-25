<?php

namespace App\Http\Controllers;

use App\Kr;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kr  $kr
     * @return \Illuminate\Http\Response
     */
    public function show(Kr $kr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kr  $kr
     * @return \Illuminate\Http\Response
     */
    public function edit(Kr $kr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kr  $kr
     * @return Kr|\Illuminate\Http\Response
     */
    public function update(Request $request, Kr $kr)
    {
        $kr->title = $request->title;
        $kr->description = $request->description;
        $kr->status = $request->status;
        $kr->target_date = $request->target_date;
        $kr->completion_date = $request->completion_date;
        $kr->vx_impact = $request->vx_impact;
        $kr->save();
        return $kr;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kr  $kr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kr $kr)
    {
        //
    }
}
