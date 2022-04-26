<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Option;
use File;
use Cache;
use Str;
use Auth;

class SiteController extends Controller
{  

      public function __construct() {
           
        $this->middleware('AdminRole:settings_show', [
            'only' => ['index', 'show','site_settings'],
        ]);
        $this->middleware('AdminRole:settings_add', [
            'only' => ['create', 'store'],
        ]);
        $this->middleware('AdminRole:settings_edit', [
            'only' => ['edit', 'update'],
        ]);
        $this->middleware('AdminRole:settings_delete', [
            'only' => ['destroy', 'multi_delete'],
        ]);

        $this->middleware('AdminRole:CpanelCredentials_show', [
            'only' => ['CpanelCredentials'],
        ]);

          $this->middleware('AdminRole:SystemEnvironment_show', [
            'only' => ['system_environment_view'],
        ]);

        
        
    }

    public function CpanelCredentials()
    {
        if (!Auth()->user()->can('site.settings')) {
            return abort(401);
        }

        $site_info = \App\Option::where('key', 'CpanelCredentials')->first();
 
        if (empty($site_info)) {
            $option = new Option;
            $option->key = "CpanelCredentials";
            $option->value = '{"domain":"","url":"","username":"","password":"","port":""}';
            $option->save() ;
        }

        $site_info = \App\Option::where('key', 'CpanelCredentials')->first();

         $info = json_decode($site_info->value);
           

        $currency_info = json_decode($currency_info->value ?? '');

        return view('admin.settings.CpanelCredentials', compact('info'));
    }

    public function site_settings()
    {
        if (!Auth()->user()->can('site.settings')) {
            return abort(401);
        }

        $site_info = \App\Option::where('key', 'company_info')->first();
         $info = json_decode($site_info->value);




        $currency_name = Option::where('key', 'currency_name')->first();
        $currency_icon = Option::where('key', 'currency_icon')->first();
        $order_prefix = Option::where('key', 'order_prefix')->first();
        $currency_info = Option::where('key', 'currency_info')->first();
        $auto_order = Option::where('key', 'auto_order')->first();
        $termsObject = Option::where('key', 'terms')->first();
        $terms = json_decode($termsObject->value);


        $currency_info = json_decode($currency_info->value ?? '');

        return view('admin.settings.site_settings', compact('info', 'currency_name', 'currency_icon', 'order_prefix', 'currency_info', 'auto_order', 'terms'));
    }

    public function site_settings_update(Request $request)
    {
        $option = Option::where('key', 'company_info')->first();
        if (empty($option)) {
            $option = new Option;
            $option->key = "company_info";
        }
        $site_name = json_encode([
            'ar' => $request->site_name_ar,
            'en' => $request->site_name_en,
        ]);
        $site_description = json_encode([
            'ar' => $request->site_description_ar,
            'en' => $request->site_description_en,
        ]);
        $termsOption = Option::where('key', 'terms')->first();
        $terms = json_encode([
            'ar' => $request->input('terms_ar'),
            'en' => $request->input('terms_en'),
        ]);

        $termsOption['value'] = $terms;
        $termsOption->save();
        $data['name'] = $site_name;
        $data['basic_colors_1'] = $request->basic_colors_1;
        $data['basic_colors_2'] = $request->basic_colors_2;
        $data['footerbackground'] = $request->footerbackground;
        $data['footercolors'] = $request->footercolors;
        $data['btnbackground'] = $request->btnbackground;
        $data['site_description'] = $site_description;
        $data['terms'] = $terms;
        $data['email1'] = $request->email1;
        $data['email2'] = $request->email2;
        $data['phone1'] = $request->phone1;
        $data['phone2'] = $request->phone2;
        $data['country'] = $request->country;
        $data['zip_code'] = $request->zip_code;
        $data['state'] = $request->state;
        $data['city'] = $request->city;
        $data['address'] = $request->address;
        $data['facebook'] = $request->facebook ?? '';
        $data['twitter'] = $request->twitter ?? '';
        $data['linkedin'] = $request->linkedin ?? '';
        $data['instagram'] = $request->instagram ?? '';
        $data['youtube'] = $request->youtube ?? '';
        $data['site_color'] = $request->site_color;
        $option->value = json_encode($data);
        $option->save();

        $currency_data['currency_name'] = $request->currency_name;
        $currency_data['currency_icon'] = $request->currency_icon;
        $currency_data['currency_possition'] = $request->currency_possition;
        $currency_name = Option::where('key', 'currency_info')->first();
        if (empty($currency_name)) {
            $currency_name = new Option;
            $currency_name->key = "currency_info";
        }
        $currency_name->value = json_encode($currency_data);
        $currency_name->save();


        $order_prefix = Option::where('key', 'order_prefix')->first();
        if (empty($order_prefix)) {
            $order_prefix = new Option;
            $order_prefix->key = "order_prefix";
        }
        $order_prefix->value = $request->order_prefix;
        $order_prefix->save();


        $auto_order = Option::where('key', 'auto_order')->first();
        if (empty($auto_order)) {
            $auto_order = new Option;
            $auto_order->key = "auto_order";
        }
        $auto_order->value = $request->auto_order;
        $auto_order->save();

        if ($request->MenuBackgroundPicture)
        {
            $validatedData = $request->validate([
 
                'MenuBackgroundPicture' => 'mimes:png',

 
                'MenuBackgroundPicture' => 'required',
                 
 
            ]);
            $path = 'uploads/Background/';
            $fileName = 'MenuBackgroundPicture.png';
            $request->MenuBackgroundPicture->move($path, $fileName);
        }

        if ($request->MenuBackgroundPicture_en)
        {
            $validatedData = $request->validate([
 
                'MenuBackgroundPicture_en' => 'mimes:png',

 
                'MenuBackgroundPicture_en' => 'required',
                 
 
            ]);
            $path = 'uploads/Background/';
            $fileName = 'MenuBackgroundPicture_en.png';
            $request->MenuBackgroundPicture_en->move($path, $fileName);
        }




        if ($request->logo) {
            $validatedData = $request->validate([
                'logo' => 'mimes:png',
            ]);
            $path = 'uploads/logo/';
            $fileName = 'logo.png';
            $request->logo->move($path, $fileName);
        }

         if ($request->logo_en) {
            $validatedData = $request->validate([
                'logo_en' => 'mimes:png',
            ]);
            $path = 'uploads/logo/';
            $fileName = 'logo_en.png';
            $request->logo_en->move($path, $fileName);
        }



        if ($request->footer_logo) {
            $validatedData = $request->validate([
                'footer_logo' => 'mimes:png',
            ]);
            $path = 'uploads/logo/';
            $fileName = 'footer_logo.png';
            $request->footer_logo->move($path, $fileName);
        }

         if ($request->footer_logo_en) {
            $validatedData = $request->validate([
                'footer_logo_en' => 'mimes:png',
            ]);
            $path = 'uploads/logo/';
            $fileName = 'footer_logo_en.png';
            $request->footer_logo_en->move($path, $fileName);
        }

        if ($request->favicon) {
            $validatedData = $request->validate([
                'favicon' => 'mimes:ico',
            ]);
            $path = 'uploads/favicon/';
            $fileName = 'favicon.ico';
            $request->favicon->move($path, $fileName);
        }


        Cache::forget('site_info');
        return response()->json([trans('success')]);

        //return response()->json(['Site Settings Updated']);
    }


     public function CpanelCredentials_update(Request $request)
    {
        

       $option = Option::where('key', 'CpanelCredentials')->first();
        if (empty($option)) {
            $option = new Option;
            $option->key = "CpanelCredentials";
        }
         

      
        $data['domain'] = $request->domain;
        $data['url'] = $request->url;
        $data['username'] = $request->username;
        $data['password'] = $request->password;
        $data['port'] = $request->port;
        $option->value = json_encode($data);
        $option->save();

         

        Cache::forget('site_info');
        return response()->json([trans('success')]);

        //return response()->json(['Site Settings Updated']);

        
    }

    public function system_environment_view()
    {
        if (!Auth()->user()->can('site.settings')) {
            return abort(401);
        }
        $countries = base_path('resources/lang/langlist.json');
        $countries = json_decode(file_get_contents($countries), true);
        return view('admin.settings.env', compact('countries'));
    }

    public function env_update(Request $request)
    {
        $APP_URL_WITHOUT_WWW = str_replace('www.', '', url('/'));
        $APP_NAME = Str::slug($request->APP_NAME);
        $txt = "APP_NAME=" . $APP_NAME . "
APP_ENV=" . $request->APP_ENV . "
APP_KEY=" . $request->APP_KEY . "
APP_DEBUG=" . $request->APP_DEBUG . "
APP_URL=" . $request->APP_URL . "
APP_URL_WITHOUT_WWW=" . $APP_URL_WITHOUT_WWW . "
APP_PROTOCOLESS_URL=" . $request->APP_PROTOCOLESS_URL . "
APP_PROTOCOL=" . $request->APP_PROTOCOL . "
MULTILEVEL_CUSTOMER_REGISTER=" . $request->MULTILEVEL_CUSTOMER_REGISTER . "

LOG_CHANNEL=" . $request->LOG_CHANNEL . "
LOG_LEVEL=" . $request->LOG_LEVEL . "\n
DB_CONNECTION=" . env("DB_CONNECTION") . "
DB_HOST=" . env("DB_HOST") . "
DB_PORT=" . env("DB_PORT") . "
DB_DATABASE=" . env("DB_DATABASE") . "
DB_USERNAME=" . env("DB_USERNAME") . "
DB_PASSWORD=" . env("DB_PASSWORD") . "\n
BROADCAST_DRIVER=" . $request->BROADCAST_DRIVER . "
CACHE_DRIVER=" . $request->CACHE_DRIVER . "
QUEUE_CONNECTION=" . $request->QUEUE_CONNECTION . "
SESSION_DRIVER=" . $request->SESSION_DRIVER . "
SESSION_LIFETIME=" . $request->SESSION_LIFETIME . "\n
REDIS_HOST=" . $request->REDIS_HOST . "
REDIS_PASSWORD=" . $request->REDIS_PASSWORD . "
REDIS_PORT=" . $request->REDIS_PORT . "\n
QUEUE_MAIL=" . $request->QUEUE_MAIL . "
MAIL_MAILER=" . $request->MAIL_MAILER . "
MAIL_HOST=" . $request->MAIL_HOST . "
MAIL_PORT=" . $request->MAIL_PORT . "
MAIL_USERNAME=" . $request->MAIL_USERNAME . "
MAIL_PASSWORD=" . $request->MAIL_PASSWORD . "
MAIL_ENCRYPTION=" . $request->MAIL_ENCRYPTION . "
MAIL_FROM_ADDRESS=" . $request->MAIL_FROM_ADDRESS . "
MAIL_TO=" . $request->MAIL_TO . "
MAIL_NOREPLY=" . $request->MAIL_NOREPLY . "
MAIL_FROM_NAME=" . Str::slug($request->MAIL_FROM_NAME) . "\n
DO_SPACES_KEY=" . $request->DO_SPACES_KEY . "
DO_SPACES_SECRET=" . $request->DO_SPACES_SECRET . "
DO_SPACES_ENDPOINT=" . $request->DO_SPACES_ENDPOINT . "
DO_SPACES_REGION=" . $request->DO_SPACES_REGION . "
DO_SPACES_BUCKET=" . $request->DO_SPACES_BUCKET . "\n

TIMEZONE=" . $request->TIMEZONE . "" . "
DEFAULT_LANG=" . $request->DEFAULT_LANG . "\n
";
        File::put(base_path('.env'), $txt);
        return response()->json(['System Updated']);


    }
}