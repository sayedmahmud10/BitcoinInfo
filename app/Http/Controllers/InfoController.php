<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


class InfoController extends Controller
{



    public function index($id){
        
         if(strcasecmp($id,'eur' ) AND strcasecmp($id,'usd' ) AND strcasecmp($id,'gbp' ) ){
             return 'please put proper currency code in request body';
         }
         $highestRate = $this->highestRate($id);
         $lowestRate =  $this->lowestRate($id);
         $currentRate = $this->currentRate($id);
         echo 'Current Rate '.$currentRate.'<br>';
         echo 'Lowest Rate '.$lowestRate.'<br>';
         echo 'HighestRate '.$highestRate.'<br>'; 
        
         
    }
    public function currentRate($id ){
        $currentRateJson = json_decode(file_get_contents('https://api.coindesk.com/v1/bpi/currentprice/'.$id.'.json'), true);

        $currentRate = $currentRateJson['bpi'][ strtoupper($id)]['rate'];
        return $currentRate;

    }
    /* public function LowestHighestRate($id){
        $json = dataHistory($id);
      
        $checkingTime =  $lastMonthTime;
        $checkingDate = $checkingTime->format('Y-m-d');  
         
       /*  for($i=0 ; $i<30; $i++){
     
         if ($json['bpi'][$checkingDate]<$lowestRate){
             $lowestRate = $json['bpi'][$checkingDate];
         };
    
         if ($json['bpi'][$checkingDate]>$highestRate){
            $highestRate = $json['bpi'][$checkingDate];
        }; */
      /*   echo $lowestRate.'<br>';
        echo $highestRate.'<br>'; 
        echo  $json['bpi'][$checkingDate].'<br>'; 
      
    
        }

         
    } */
    public function highestRate($id){
        $json = $this->dataHistory($id);
        $highestRate = $this->initialRate($id) ; 
        $checkingTime =  $this->initialtime();
        $checkingDate = $this->format($checkingTime); 
        for($i=0 ; $i<30; $i++){
     
           
            if ($json['bpi'][$checkingDate]>$highestRate){
               $highestRate = $json['bpi'][$checkingDate];
           };
       
           $checkingTime =  $checkingTime->addDays(1);
           $checkingDate = $checkingTime->format('Y-m-d');
       
           }

           return $highestRate;


    }

    public function lowestRate($id){
        $json = $this->dataHistory($id);
        $lowestRate = $this->initialRate($id);
        $checkingTime =  $this->initialtime();
        $checkingDate = $this->format($checkingTime); 
        for($i=0 ; $i<30; $i++){
     
            if ($json['bpi'][$checkingDate]<$lowestRate){
                $lowestRate = $json['bpi'][$checkingDate];
            };   
           
            
            $checkingTime =  $checkingTime->addDays(1);
           $checkingDate = $checkingTime->format('Y-m-d');
       
           }
        
           return  $lowestRate;
    }
    
    public function initialRate($id){
        $lastMonthDate =$this->format($this->initialtime());
        $json = $this->dataHistory($id);
        return $json['bpi'][$lastMonthDate];

    }
    public function initialtime(){
       return $this->lastMonthDate();

    }
    public function format( $date){
        return $date->format('Y-m-d');
    }
    public function lastMonthDate(){
        $todayDate=Carbon::now()->format('Y-m-d');   
        $lastMonthTime = Carbon::now()->subDays(30);
        return $lastMonthTime;
    }
    public function dataHistory($id){
        $todayDate=Carbon::now()->format('Y-m-d');   
        $lastMonthTime = Carbon::now()->subDays(30);
        $lastMonthDate =  $lastMonthTime->format('Y-m-d');  
        $json = json_decode(file_get_contents('https://api.coindesk.com/v1/bpi/historical/close.json?start='.$lastMonthDate/* 2013-09-01 */.'&end='.$todayDate./* 2013-09-05 */'&currency='.$id), true);
        return $json ;
    }
   
}
