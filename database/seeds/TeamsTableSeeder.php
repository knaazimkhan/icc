<?php

use App\Team;
use App\Player;
use App\Fixture;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Australia','group' => 'A'],
            ['name' => 'Bangladesh','group' => 'A'],
            ['name' => 'England','group' => 'A'],
            ['name' => 'India','group' => 'A'],
            ['name' => 'New Zealand','group' => 'B'],
            ['name' => 'Pakistan','group' => 'B'],
            ['name' => 'South Africa','group' => 'B'],
            ['name' => 'Sri Lanka','group' => 'B']
        ];
        foreach ($data as $key => $value) {
            $team = Team::create([
                'name' => $value['name'],
                'group' => $value['group']
            ]);
            for ($i=1; $i < 12; $i++) { 
                Player::create([
                    'name' => 'Player_'.$i,
                    'team_id' => $team->id
                ]);
            }
        }

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
