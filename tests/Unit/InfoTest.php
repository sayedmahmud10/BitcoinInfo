<?php

namespace Tests\Unit;


use PHPUnit\Framework\TestCase;
use App\Http\Controllers\InfoController;


class InfoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_currentRate($id)
    {
        $rate = (new InfoController)->currentRate($id);
        if ($rate){
            $this->assertTrue(true);
        }
        
    }
    public function test_dataHistory($id)
    {
        $data = (new InfoController)-> dataHistory($id);
        if ($data){
            $this->assertTrue(true);
        }
        
    }
   
    public function test_lastMonthDate()
    {
        $data = (new InfoController)->lastMonthDate();
        if ($data){
            $this->assertTrue(true);
        }
        
    }
    public function test_initialRate($id)
    {
        $data = (new InfoController)->initialRate($id);
        if ($data){
            $this->assertTrue(true);
        }
        
    }
    public function test_highestRate($id)
    {
        $data = (new InfoController)->highestRate($id);
        if ($data){
            $this->assertTrue(true);
        }
        
    }
    public function test_lowestRate($id)
        {
            $data = (new InfoController)->lowestRate($id);
            if ($data){
                $this->assertTrue(true);
            }
            
        }

}
