<?php

namespace App\Http\Controllers;

use App\Charts\BookChart;
use App\Charts\UserChart;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\UserBook ;
class UserChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr =[];
        $arr2 =[];
        $byweek = UserBook::all()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('W');
        });
        foreach ($byweek as $key  ) {


        array_push($arr, $key->sum('price'));
        array_push($arr2, 'week');

        }
        // dd($arr);

        $usersChart = new BookChart;
        $usersChart->labels($arr2);
        $usersChart->dataset('profits over book', 'line', $arr);
        return view('users', [ 'usersChart' => $usersChart ,'www'=>$byweek] );
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
        //
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
        //
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
}
