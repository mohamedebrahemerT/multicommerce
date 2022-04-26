<?php

namespace App\Providers;
use App\Useroption;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use Session;
use DB;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer('*', function($view)
        {
            $view->with([
                'locale' => \Session::get('locale'),
            ]);
        });

         //get general setting value
        $general_setting = DB::table('general_settings')->latest()->first();

        View::share('general_setting', $general_setting);


        if(Useroption::where('user_id', domain_info('user_id'))->where('key', 'local')->first())
        {
              $local=Useroption::where('user_id', domain_info('user_id'))->where('key', 'local')->first()->value;
              \App::setlocale($local);
        }

         $user_id = domain_info('user_id');
 
                                    
      if(Useroption::where('user_id',$user_id)->where('key','currency')->first())
      {
         $currency=Useroption::where('key','currency')->where('user_id',$user_id)->first();
      }
         
      $currency=json_decode($currency->value ?? '');

        View::share('currency', $currency);

    

    }
}
