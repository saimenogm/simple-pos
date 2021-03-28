<?php
namespace App\Reports;

class MyReport extends \koolreport\KoolReport
{

    public function __construct($start_date_passed, $end_date_passed) 
    {
        $start_date = $start_date_passed;
        $end_date = $end_date_passed;
        
    }

    //use \koolreport\laravel\Friendship;
    // By adding above statement, you have claim the friendship between two frameworks
    // As a result, this report will be able to accessed all databases of Laravel
    // There are no need to define the settings() function anymore
    // while you can do so if you have other datasources rather than those
    // defined in Laravel.
    
/*
    function setup()
    {
        // Let say, you have "sale_database" is defined in Laravel's database settings.
        // Now you can use that database without any futher setitngs.
        $this->src("sap")
        ->query("SELECT * FROM sales")
        ->pipe($this->dataStore("sales"));        

    }
    */
        public function settings()
    {
        return array(
            "dataSources"=>array(
                "sap"=>array(
                    'host' => 'localhost',
                    'username' => 'root',
                    'password' => '',
                    'dbname' => 'sap',
                    'charset' => 'utf8',  
                    'class' => "\koolreport\datasources\MySQLDataSource"  
                ),
            )
        );
    }
    public function setup()
    {
        $this->src('sap')
        ->query("SELECT * FROM purchases")
        ->pipe($this->dataStore('purchases'));
    }
    
}