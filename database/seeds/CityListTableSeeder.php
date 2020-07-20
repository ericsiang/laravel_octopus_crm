<?php

use App\Area;
use App\City;
use Illuminate\Database\Seeder;

class CityListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data=public_path('assets\city.txt');
        $myfile = fopen($data, "r") or die("Unable to open file!");
        while(!feof($myfile))
        {
            $arr[]=''.trim(fgets($myfile)).'';
            //pre(fgets($myfile));
            //dd(fgets($myfile));
        }
        
        fclose($myfile);
        $arr=explode('|',$arr[0]);


        $city_arr=array();
        $are_arr=array();
        $i=0;
        foreach($arr as  $list){
            $i++;
            
            $list_arr=explode(",",$list);
            //dd($list_arr);
            $list_arr2=explode(" ",$list_arr[1]);
            
            //pre($list_arr2);
            //print_r($list_arr2);
            for($j=0;$j<sizeof($list_arr2);$j++){
                if($j%2==0){
                    $area=$list_arr2[$j].','.$list_arr2[$j+1];
                    $city_arr[$list_arr[0]][]=$area;
                }
            }
            //$city_arr[$i][]
        }
        
        
        foreach($city_arr as $city =>$area_arr){
            //pre($city_id);
            $cityL=City::create(['city'=>$city]);
            if($cityL->city_id){
                foreach($area_arr as $k=> $area_str){
                    $area_str_arr=explode(',',$area_arr[$k]);
                    $area=$area_str_arr[0];
                    $zip=$area_str_arr[1];
                    Area::create(['city_id'=>$cityL->city_id,'area'=>$area,'zip'=>$zip]);
                }
            }
        
        }
    }
}
