<?php

namespace App\Http\Controllers;

use App\Okr;
use Illuminate\Http\Request;

class OkrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Okr[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return Okr::with('krs')->get();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Okr::find($id)->load(['krs', 'krs.tasks', 'krs.tasks.user', 'user','comments']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
//        dd($request->all());
        $okr = Okr::find($request->id);
        $okr->OKRs_title = $request->OKRs_title;
        $okr->description = $request->description;
        $okr->status = $request->status;
        $okr->categories = $request->categoriesArray;
        $okr->impact_groups = $request->impactGroupsArray;
        $okr->contributors = $request->contributorsArray;
        $okr->target_date = $request->target_date;
        $okr->completion_date = $request->completion_date;
        $okr->save();
        return $okr;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function status($id){
        $okr = Okr::find($id);
        $okr->load(['krs']);
        $status = $okr->krs->groupBy('status');
        $counts = collect();
        $status->each(function ($item) use($counts){
            $status['type'] = $item->first()->status;
            $status['count'] = $item->count();
            $counts->push($status);

        });
        return $counts;
    }
}
