<?php

namespace App\Http\Controllers;

use App\Team;
use App\Fixture;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function index()
    {
        $teams = Team::all();
        $fixtures = Fixture::all();
        return view('welcome', compact('teams', 'fixtures'));
    }

    public function fixture()
    {
        $teams = Team::where('group', 'A')->get();
        $index = 0;
        $week = 1;
        for ($i=0; $i < count($teams); $i++) {
            for ($j=0; $j < count($teams); $j++) { 
                if($j > $i){
                    $fixtures[$index]['match'] = $teams[$i]->name.'-'.$teams[$j]->name;
                    $fixtures[$index]['group'] = $teams[$i]->group;
                    $fixtures[$index++]['week'] = $week++;
                    // $week++;
                }
            }
        }
        
        $teams = Team::where('group', 'B')->get();
        $week = 1;
        for ($i=0; $i < count($teams); $i++) {
            for ($j=0; $j < count($teams); $j++) { 
                if($j > $i){
                    $fixtures[$index]['match'] = $teams[$i]->name.'-'.$teams[$j]->name;
                    $fixtures[$index]['group'] = $teams[$i]->group;
                    $fixtures[$index++]['week'] = $week++;
                }
            }
        }
        foreach ($fixtures as $key => $fixture) {
            Fixture::create($fixture);
        }
    }
}
