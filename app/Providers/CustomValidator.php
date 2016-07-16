<?php 

namespace App\Providers;

use Validator; 
use Illuminate\Support\ServiceProvider;

class CustomValidator extends ServiceProvider 
{ 

    public function boot() 
    {
        Validator::extend('alpha_spaces', function($attribute, $value) 
        { 
            return preg_match('/^[\pL\s]+$/u', $value); 
        }); 
    } 


    public function register()
    {

    }

}