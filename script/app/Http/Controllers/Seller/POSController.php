<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PosSetting;
use App\Models\User;
use App\Models\coupons;
use App\Models\Tax;
use App\Models\Sale;
use App\Models\CustomerGroup;
use App\Category;
use App\Term;
use App\Order;
use App\Attribute;
use App\Stock;
use App\Postcategory;

use App\Orderitem;
use App\Ordermeta;
use App\Models\Price;
use Auth;
use DB;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\Unit;
use App\Models\Currency;
use App\Models\CashRegister;
use App\Models\Product_Warehouse;
use App\Models\Product_Sale;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\Payment;
use App\Models\PaymentWithCheque;
use App\Models\PaymentWithGiftCard;
use App\Models\PaymentWithCreditCard;
use App\Models\PaymentWithPaypal;
use App\Models\Account;
use App\Models\Coupon;
use App\Models\GiftCard;
use App\Models\Delivery;
use Stripe\Stripe;
use NumberToWords\NumberToWords;
use Redirect;
use App\Useroption;
use App\Models\Termoption;
use Illuminate\Support\Facades\Session;



class POSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function saleData(Request $request)
    {
        $columns = array( 
            1 => 'created_at', 
            2 => 'reference_no',
            7 => 'grand_total',
            8 => 'paid_amount',
        );
        
        
        if(Auth::user()->role_id > 2 && config('staff_access') == 'own')
            $totalData = Sale::where('user_id', Auth::id())->count();
        else
            $totalData = Sale::count();

        $totalFiltered = $totalData;
        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;
        $start = $request->input('start');
        $order = 'sales.'.$columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value'))){
            if(Auth::user()->role_id > 2 && config('staff_access') == 'own')
                $sales = Sale::with('biller', 'customer', 'warehouse', 'user')->offset($start)
            ->where('user_id', Auth::id())
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
            else
                $sales = Sale::with('biller', 'customer', 'warehouse', 'user')->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        }
        else
        {
            $search = $request->input('search.value');
            if(Auth::user()->role_id > 2 && config('staff_access') == 'own') {
                $sales =  Sale::select('sales.*')
                ->with('User', 'customer', 'warehouse', 'user')
                ->join('User', 'sales.customer_id', '=', 'customers.id')
                ->whereDate('sales.created_at', '=' , date('Y-m-d', strtotime(str_replace('/', '-', $search))))
                ->where('sales.user_id', Auth::id())
                ->orwhere([
                    ['sales.reference_no', 'LIKE', "%{$search}%"],
                    ['sales.user_id', Auth::id()]
                ])
                ->orwhere([
                    ['customers.name', 'LIKE', "%{$search}%"],
                    ['sales.user_id', Auth::id()]
                ])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)->get();

                $totalFiltered = Sale::
                join('customers', 'sales.customer_id', '=', 'customers.id')
                ->whereDate('sales.created_at', '=' , date('Y-m-d', strtotime(str_replace('/', '-', $search))))
                ->where('sales.user_id', Auth::id())
                ->orwhere([
                    ['sales.reference_no', 'LIKE', "%{$search}%"],
                    ['sales.user_id', Auth::id()]
                ])
                ->orwhere([
                    ['customers.name', 'LIKE', "%{$search}%"],
                    ['sales.user_id', Auth::id()]
                ])
                ->count();
            }
            else {
                $sales =  Sale::select('sales.*')
                ->with('biller', 'customer', 'warehouse', 'user')
                ->join('customers', 'sales.customer_id', '=', 'customers.id')
                ->whereDate('sales.created_at', '=' , date('Y-m-d', strtotime(str_replace('/', '-', $search))))
                ->where('sales.user_id', Auth::id())
                ->orwhere('sales.reference_no', 'LIKE', "%{$search}%")
                ->orwhere('customers.name', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)->get();

                $totalFiltered = Sale::
                join('customers', 'sales.customer_id', '=', 'customers.id')
                ->whereDate('sales.created_at', '=' , date('Y-m-d', strtotime(str_replace('/', '-', $search))))
                ->where('sales.user_id', Auth::id())
                ->orwhere('sales.reference_no', 'LIKE', "%{$search}%")
                ->orwhere('customers.name', 'LIKE', "%{$search}%")
                ->count();
            }
        }
        $data = array();
        if(!empty($sales))
        {
            foreach ($sales as $key=>$sale)
            {
                $nestedData['id'] = $sale->id;
                $nestedData['key'] = $key;
                $nestedData['date'] = date(config('date_format'), strtotime($sale->created_at->toDateString()));
                $nestedData['reference_no'] ='';
                $nestedData['biller'] ='' /*$sale->biller->name  */;
                $nestedData['customer'] = ''/*$sale->customer->name*/;

                if($sale->sale_status == 1){
                    $nestedData['sale_status'] = '<div class="badge badge-success">'.trans('file.Completed').'</div>';
                    $sale_status = trans('file.Completed');
                }
                elseif($sale->sale_status == 2){
                    $nestedData['sale_status'] = '<div class="badge badge-danger">'.trans('file.Pending').'</div>';
                    $sale_status = trans('file.Pending');
                }
                else{
                    $nestedData['sale_status'] = '<div class="badge badge-warning">'.trans('file.Draft').'</div>';
                    $sale_status = trans('file.Draft');
                }

                if($sale->payment_status == 1)
                    $nestedData['payment_status'] = '<div class="badge badge-danger">'.trans('file.Pending').'</div>';
                elseif($sale->payment_status == 2)
                    $nestedData['payment_status'] = '<div class="badge badge-danger">'.trans('file.Due').'</div>';
                elseif($sale->payment_status == 3)
                    $nestedData['payment_status'] = '<div class="badge badge-warning">'.trans('file.Partial').'</div>';
                else
                    $nestedData['payment_status'] = '<div class="badge badge-success">'.trans('file.Paid').'</div>';

                $nestedData['grand_total'] = number_format($sale->grand_total, 2);
                $nestedData['paid_amount'] = number_format($sale->paid_amount, 2);
                $nestedData['due'] = number_format($sale->grand_total - $sale->paid_amount, 2);
                $nestedData['options'] = '<div class="btn-group">
                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                <li><a href="'.'/sale.invoice'.$sale->id.'" class="btn btn-link"><i class="fa fa-copy"></i> '.trans('file.Generate Invoice').'</a></li>
                <li>
                <button type="button" class="btn btn-link view"><i class="fa fa-eye"></i> '.trans('file.View').'</button>
                </li>';

                $nestedData['options'] .= '<li>
                <a href="'.url('sales/'.$sale->id.'/create').'" class="btn btn-link"><i class="dripicons-document-edit"></i> '.trans('file.edit').'</a>
                </li>';

                $nestedData['options'] .= 
                '<li>
                <button type="button" class="add-payment btn btn-link" data-id = "'.$sale->id.'" data-toggle="modal" data-target="#add-payment"><i class="fa fa-plus"></i> '.trans('file.Add Payment').'</button>
                </li>
                <li>
                <button type="button" class="get-payment btn btn-link" data-id = "'.$sale->id.'"><i class="fa fa-money"></i> '.trans('file.View Payment').'</button>
                </li>
                <li>
                <button type="button" class="add-delivery btn btn-link" data-id = "'.$sale->id.'"><i class="fa fa-truck"></i> '.trans('file.Add Delivery').'</button>
                </li>';


                $nestedData['options'] .= \Form::open([ "method" => "DELETE"] ).'
                <li>
                <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> '.trans("file.delete").'</button> 
                </li>'.\Form::close().'
                </ul>
                </div>';
                // data for sale details by one click
                $coupon = Coupon::find($sale->coupon_id);
                if($coupon)
                    $coupon_code = $coupon->code;
                else
                    $coupon_code = null;

                $nestedData['sale'] = array(/* '[ "'.date(config('date_format'), strtotime($sale->created_at->toDateString())).'"', ' "'.$sale->reference_no.'"', ' "'.$sale_status.'"', ' "'.$sale->biller->name.'"', ' "'.$sale->biller->company_name.'"', ' "'.$sale->biller->email.'"', ' "'.$sale->biller->phone_number.'"', ' "'.$sale->biller->address.'"', ' "'.$sale->biller->city.'"', ' "'.$sale->customer->name.'"', ' "'.$sale->customer->phone_number.'"', ' "'.$sale->customer->address.'"', ' "'.$sale->customer->city.'"', ' "'.$sale->id.'"', ' "'.$sale->total_tax.'"', ' "'.$sale->total_discount.'"', ' "'.$sale->total_price.'"', ' "'.$sale->order_tax.'"', ' "'.$sale->order_tax_rate.'"', ' "'.$sale->order_discount.'"', ' "'.$sale->shipping_cost.'"', ' "'.$sale->grand_total.'"', ' "'.$sale->paid_amount.'"', ' "'.preg_replace('/\s+/S', " ", $sale->sale_note).'"', ' "'.preg_replace('/\s+/S', " ", $sale->staff_note).'"', ' "'.$sale->user->name.'"', ' "'.$sale->user->email.'"', ' "'.$sale->warehouse->name.'"', ' "'.$coupon_code.'"', ' "'.$sale->coupon_discount.'"]'
                */);
                    $data[] = $nestedData;
                }
            }
            $json_data = array(
                "draw"            => intval($request->input('draw')),  
                "recordsTotal"    => intval($totalData),  
                "recordsFiltered" => intval($totalFiltered), 
                "data"            => $data   
            );
            
            echo json_encode($json_data);
        }
        public function all_sales( )
        {

                

            $lims_sale_all = Sale::orderBy('id', 'desc')->get();

            $lims_gift_card_list = GiftCard::where("is_active", true)->get();
            $lims_pos_setting_data = PosSetting::latest()->first();
            $lims_account_list = Account::where('is_active', true)->get();

            return view('seller.POS.all_sales',compact('lims_sale_all', 'lims_gift_card_list', 'lims_pos_setting_data', 'lims_account_list'));

        }
        public function index(Request $request, $type = 1)
        {
             $auth_id = Auth::id();

            $lims_pos_setting_data = PosSetting::latest()->first();
            $lims_biller_list = User::where('role_id', 3)->get();
            //$lims_customer_list =User::where('role_id', 3)->get();
            $lims_customer_list=User::where('created_by',Auth::id())->withCount('orders')->orderBy('orders_count','DESC')->where('role_id',2)->latest()->get();


            $lims_tax_list = Tax::where('is_active', true)->get();


            $lims_category_list = Category::
            where('type','category')->
            where('user_id', $auth_id)->get();

            $lims_brand_list  = Category::where('user_id', $auth_id)->
            where('type','brand')->get();

            $lims_product_list = Term::where('type', 'product')
            ->with('preview')->where('status', $type)
            ->where('status',1)
            ->where('user_id', $auth_id)->get();

            $product_number = count($lims_product_list);

            

            $alert_product = Term::where('type', 'product')
            ->with('preview')->where('status', $type)
            ->where('user_id', $auth_id)->count();
            $lims_coupon_list = coupons::get();
            $currency="RS";


            return view('seller.POS.index',compact('lims_pos_setting_data','lims_biller_list','lims_customer_list','lims_tax_list','lims_category_list','lims_brand_list','product_number','lims_product_list','alert_product','lims_coupon_list','currency'));

        }


        public function limsProductSearch(Request $request)
        {

            $todayDate = date('Y-m-d');
            $product_code = explode("(", $request['data']);
            $product_code[0] = rtrim($product_code[0], " ");
            $product_variant_id = null;
          
            $lims_product_data = Term::where('id', $product_code[0])->first();
            $lims_product_data->price;
            $price= Price::where('term_id',$lims_product_data->id)->first()->price;

             $Stock=Stock::where('term_id',$lims_product_data->id)->first()->stock_qty;

                if ( $Stock== 0) 

                {


                     $product[] = $lims_product_data->id;
            if(\Session::get('locale') == 'ar')

            {
             $product[] = 'لا يوجد مخزون كلفي لهذا المنتج  ';
         }
         else
         {
             $product[] = 'out of stoc';

         }

         $product[] = 0;

         $product[] = 0;
         $product[] = 'No Tax';




         $product[] = 'n/a'. ',';
         $product[] = 'n/a'. ',';
         $product[] = 'n/a'. ',';

         $product[] = $lims_product_data->id;
         $product[] = $product_variant_id;
         $product[] = $lims_product_data->promotion;
         return $product;
                    
                }
                else
                {
                     $product[] = $lims_product_data->id;
            if(\Session::get('locale') == 'ar')

            {
             $product[] = $lims_product_data->title_ar;
         }
         else
         {
             $product[] = $lims_product_data->title_en;

         }

         $product[] = $price;

         $product[] = 0;
         $product[] = 'No Tax';




         $product[] = 'n/a'. ',';
         $product[] = 'n/a'. ',';
         $product[] = 'n/a'. ',';

         $product[] = $lims_product_data->id;
         $product[] = $product_variant_id;
         $product[] = $lims_product_data->promotion;
         return $product;
                }

           

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

    public function get_variant()
    {
          $id = request('id');
        $user_id = domain_info('user_id');


          $info = Term::where('user_id', $user_id)->where('type', 'product')->where('status', 1)->with('medias', 'content', 'categories', 'brands', 'seo', 'price', 'options', 'stock','preview')->findorFail($id);

       
 
        $variations = collect($info->attributes)->groupBy(function ($q) {
            return $q->attribute->name;
            //return json_decode($q->attribute->name)->ar;
        });
       
        

           

  $cats_ids=[];
 foreach(Attribute::where('term_id',$info->id)->groupBy('category_id')->get() as $category )
        {
           array_push($cats_ids,$category->category_id);
        }
      $sizebox='';
           $sizebox_item='';
 
      foreach(Attribute::whereIn('category_id',$cats_ids)->where('term_id',$info->id)->get() as $variation ) 
        {

      $sizebox_item.='<li value="'.$variation->variation->id.'" >'.$variation->variation->name.' </li>';
        }

         $sizebox.='<div class="size-boxul">
                                      <ul id="myid">  
        
                         '.$sizebox_item.'
           
             
                                           
                                        </ul>
                                    </div>';
   
        return  $sizebox ="<ul id='myid'>  
<li id='1'>First</li>  
<li id='2'>Second</li>  
<li id='3'>Third</li>  
<li id='4'>Fourth</li>  
<li id='5'>Fifth</li>  
</ul>  ";

        
    }
    public function store(Request $request)
    {

         

       $data = $request->all();

           $user_id= Auth::id();
  $prefix=Useroption::where('user_id',$user_id)->where('key','order_prefix')->first();
        $max_id=Order::max('id');
        if (empty($prefix)) {
          $prefix=$max_id+1;
        }
        else{
           if(Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name')->first())
        {
              $shop_name=Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name')->first()->value;
        }
              $shop_name = substr( $shop_name, 0, 6); //first 5 chars "Hello"
         $prefix=$shop_name.$max_id;
       }




       $Order=new Order();
       $Order->order_no=$prefix;
       $Order->transaction_id=$data['_token'];
       $Order->customer_id=$data['customer_id'];
       $Order->user_id=Auth::id();
       $Order->order_type=1;
       $Order->payment_status=1;
       $Order->status='processing';
       $Order->tax=$data['total_tax'];
       $Order->shipping=$data['shipping_cost'] ?: 0;
       $Order->total=$data['grand_total'];
       $Order->is_fully_refunded=0;
       $Order->is_partially_refunded=0;
       $Order->refund_status='';
       $Order->reason='';
       $Order->status='pos';

       $Order->seller_take_action='';
                // $Order->order_date=*date('Y-m-d H:i:s')*/;
                // $Order->order_time=*date('H:i:s')*/;
       $Order->save();

       $data['customer_id'];

       $posts=User::where('created_by',Auth::id())->first();

       $info['name'] = $posts->name;
       $info['email'] = $posts->email;
       $info['comment'] = '';
       $info['coupon_discount'] =  $data['order_discount'] ;
       $info['sub_total'] = $data['total_price'];


       $meta = new Ordermeta;
       $meta->order_id = $Order->id;
       $meta->key = 'content';
       $meta->value = json_encode($info);
       $meta->save();


       foreach ($data['product_code'] as $key => $item) {
           $Orderitem=new Orderitem();
           $Orderitem->order_id=$Order->id;
           $Orderitem->term_id=$data['product_id'][$key];
           $Orderitem->info='{"attribute":[],"options":[]}';
           $Orderitem->qty=$data['qty'][$key];
           $Orderitem->amount=$data['net_unit_price'][$key];
                // $Orderitem->is_refundable='';
                 //$Orderitem->reason='';
                 //$Orderitem->refund_status='';
           $Orderitem->save();
       }


    session()->flash('success', __('sold successfully'));
             
       return redirect('seller/POS/');
   }

   public function genInvoice($id)
   {
       $lims_sale_data = Sale::find($id);
       $lims_product_sale_data = Product_Sale::where('sale_id', $id)->get();
       $lims_biller_data = User::find($lims_sale_data->biller_id);
       $lims_warehouse_data = Warehouse::find($lims_sale_data->warehouse_id);
       $lims_customer_data = User::find($lims_sale_data->customer_id);
       $lims_payment_data = Payment::where('sale_id', $id)->get();

       $numberToWords = new NumberToWords();
       if(\App::getLocale() == 'ar' || \App::getLocale() == 'hi' || \App::getLocale() == 'vi' || \App::getLocale() == 'en-gb')
        $numberTransformer = $numberToWords->getNumberTransformer('en');
    else
        $numberTransformer = $numberToWords->getNumberTransformer(\App::getLocale());
    $numberInWords = $numberTransformer->toWords($lims_sale_data->grand_total);

    return view('seller.POS.invoice', compact('lims_sale_data', 'lims_product_sale_data', 'lims_biller_data', 'lims_warehouse_data', 'lims_customer_data', 'lims_payment_data', 'numberInWords'));
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function posSetting()
    {
        $lims_customer_list = User::get();
           
        $lims_biller_list = User::get();
        $lims_pos_setting_data = PosSetting::latest()->first();
        
        return view('seller.POS.pos_setting', compact('lims_customer_list', 'lims_biller_list', 'lims_pos_setting_data'));
    }

    public function posSettingStore(Request $request)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $data = $request->all();
        //writting paypal info in .env file
        $path = '.env';
        $searchArray = array('PAYPAL_LIVE_API_USERNAME='.env('PAYPAL_LIVE_API_USERNAME'), 'PAYPAL_LIVE_API_PASSWORD='.env('PAYPAL_LIVE_API_PASSWORD'), 'PAYPAL_LIVE_API_SECRET='.env('PAYPAL_LIVE_API_SECRET') );

        $replaceArray = array('PAYPAL_LIVE_API_USERNAME='.$data['paypal_username'], 'PAYPAL_LIVE_API_PASSWORD='.$data['paypal_password'], 'PAYPAL_LIVE_API_SECRET='.$data['paypal_signature'] );

        file_put_contents($path, str_replace($searchArray, $replaceArray, file_get_contents($path)));

        $pos_setting = PosSetting::firstOrNew(['id' => 1]);
        $pos_setting->id = 1;
        $pos_setting->customer_id = $data['customer_id'];
        $pos_setting->warehouse_id = $data['warehouse_id'];
        $pos_setting->biller_id = $data['biller_id'];
        $pos_setting->product_number = $data['product_number'];
        $pos_setting->stripe_public_key = $data['stripe_public_key'];
        $pos_setting->stripe_secret_key = $data['stripe_secret_key'];
        if(!isset($data['keybord_active']))
            $pos_setting->keybord_active = false;
        else
            $pos_setting->keybord_active = true;
        $pos_setting->save();
        return redirect()->back()->with('message', 'POS setting updated successfully');
    }
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


        $lims_customer_list = User::get();
        $lims_warehouse_list = Warehouse::where('is_active', true)->get();
        $lims_biller_list = User::get();
        $lims_tax_list = Tax::where('is_active', true)->get();
        $lims_sale_data = Sale::find($id);
        $lims_product_sale_data = Product_Sale::where('sale_id', $id)->get();
        return view('seller.POS.edit',compact('lims_customer_list', 'lims_warehouse_list', 'lims_biller_list', 'lims_tax_list', 'lims_sale_data','lims_product_sale_data'));

        

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


        $data = $request->except('document');
        //return dd($data);
        $document = $request->document;
        if ($document) {
            $v = Validator::make(
                [
                    'extension' => strtolower($request->document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:jpg,jpeg,png,gif,pdf,csv,docx,xlsx,txt',
                ]
            );
            if ($v->fails())
                return redirect()->back()->withErrors($v->errors());

            $documentName = $document->getClientOriginalName();
            $document->move('public/sale/documents', $documentName);
            $data['document'] = $documentName;
        }
        $balance = $data['grand_total'] - $data['paid_amount'];
        if($balance < 0 || $balance > 0)
            $data['payment_status'] = 2;
        else
            $data['payment_status'] = 4;
        $lims_sale_data = Sale::find($id);
        $lims_product_sale_data = Product_Sale::where('sale_id', $id)->get();
        $product_id = $data['product_id'];
        $product_code = $data['product_code'];
        $product_variant_id = $data['product_variant_id'];
        $qty = $data['qty'];
        $sale_unit = $data['sale_unit'];
        $net_unit_price = $data['net_unit_price'];
        $discount = $data['discount'];
        $tax_rate = $data['tax_rate'];
        $tax = $data['tax'];
        $total = $data['subtotal'];
        $old_product_id = [];
        $product_sale = [];
        foreach ($lims_product_sale_data as  $key => $product_sale_data) {
            $old_product_id[] = $product_sale_data->product_id;
            $old_product_variant_id[] = null;
            $lims_product_data = Term::find($product_sale_data->product_id);

            if( ($lims_sale_data->sale_status == 1) && ($lims_product_data->type == 'combo') ) {
                $product_list = explode(",", $lims_product_data->product_list);
                $qty_list = explode(",", $lims_product_data->qty_list);

                foreach ($product_list as $index=>$child_id) {
                    $child_data = Term::find($child_id);
                    $child_warehouse_data = Product_Warehouse::where([
                        ['product_id', $child_id],
                        ['warehouse_id', $lims_sale_data->warehouse_id ],
                    ])->first();

                    $child_data->qty += $product_sale_data->qty * $qty_list[$index];
                    $child_warehouse_data->qty += $product_sale_data->qty * $qty_list[$index];

                    $child_data->save();
                    $child_warehouse_data->save();
                }
            }
            elseif( ($lims_sale_data->sale_status == 1) && ($product_sale_data->sale_unit_id != 0)) {
                $old_product_qty = $product_sale_data->qty;
                $lims_sale_unit_data = Unit::find($product_sale_data->sale_unit_id);
                if ($lims_sale_unit_data->operator == '*')
                    $old_product_qty = $old_product_qty * $lims_sale_unit_data->operation_value;
                else
                    $old_product_qty = $old_product_qty / $lims_sale_unit_data->operation_value;
                if($product_sale_data->variant_id) {
                    $lims_product_variant_data = ProductVariant::select('id', 'qty')->FindExactProduct($product_sale_data->product_id, $product_sale_data->variant_id)->first();
                    $lims_product_warehouse_data = Product_Warehouse::FindProductWithVariant($product_sale_data->product_id, $product_sale_data->variant_id, $lims_sale_data->warehouse_id)
                    ->first();
                    $old_product_variant_id[$key] = $lims_product_variant_data->id;
                    $lims_product_variant_data->qty += $old_product_qty;
                    $lims_product_variant_data->save();
                }
                else
                    $lims_product_warehouse_data = Product_Warehouse::FindProductWithoutVariant($product_sale_data->product_id, $lims_sale_data->warehouse_id)
                ->first();
                $lims_product_data->qty += $old_product_qty;
                $lims_product_warehouse_data->qty += $old_product_qty;
                $lims_product_data->save();
                $lims_product_warehouse_data->save();
            }
            if($product_sale_data->variant_id && !(in_array($old_product_variant_id[$key], $product_variant_id)) ){
                $product_sale_data->delete();
            }
            elseif( !(in_array($old_product_id[$key], $product_id)) )
                $product_sale_data->delete();
        }
        foreach ($product_id as $key => $pro_id) {
            $lims_product_data = Term::find($pro_id);
            $product_sale['variant_id'] = null;
            if($lims_product_data->type == 'combo' && $data['sale_status'] == 1){
                $product_list = explode(",", $lims_product_data->product_list);
                $qty_list = explode(",", $lims_product_data->qty_list);

                foreach ($product_list as $index=>$child_id) {
                    $child_data = Term::find($child_id);
                    $child_warehouse_data = Product_Warehouse::where([
                        ['product_id', $child_id],
                        ['warehouse_id', $data['warehouse_id'] ],
                    ])->first();

                    $child_data->qty -= $qty[$key] * $qty_list[$index];
                    $child_warehouse_data->qty -= $qty[$key] * $qty_list[$index];

                    $child_data->save();
                    $child_warehouse_data->save();
                }
            }
            if($sale_unit[$key] != 'n/a') {
                $lims_sale_unit_data = Unit::where('unit_name', $sale_unit[$key])->first();
                $sale_unit_id = $lims_sale_unit_data->id;
                if($data['sale_status'] == 1) {
                    $new_product_qty = $qty[$key];
                    if ($lims_sale_unit_data->operator == '*') {
                        $new_product_qty = $new_product_qty * $lims_sale_unit_data->operation_value;
                    } else {
                        $new_product_qty = $new_product_qty / $lims_sale_unit_data->operation_value;
                    }
                    if($lims_product_data->is_variant) {
                        $lims_product_variant_data = ProductVariant::select('id', 'variant_id', 'qty')->FindExactProductWithCode($pro_id, $product_code[$key])->first();
                        $lims_product_warehouse_data = Product_Warehouse::FindProductWithVariant($pro_id, $lims_product_variant_data->variant_id, $data['warehouse_id'])
                        ->first();
                        
                        $product_sale['variant_id'] = $lims_product_variant_data->variant_id;
                        $lims_product_variant_data->qty -= $new_product_qty;
                        $lims_product_variant_data->save();
                    }
                    else {
                        $lims_product_warehouse_data = Product_Warehouse::FindProductWithoutVariant($pro_id, $data['warehouse_id'])
                        ->first();
                    }
                    $lims_product_data->qty -= $new_product_qty;
                    $lims_product_warehouse_data->qty -= $new_product_qty;
                    $lims_product_data->save();
                    $lims_product_warehouse_data->save();
                }
            }
            else
                $sale_unit_id = 0;
            
            //collecting mail data
            if($product_sale['variant_id']) {
                $variant_data = Variant::select('name')->find($product_sale['variant_id']);
                $mail_data['products'][$key] = $lims_product_data->name . ' [' . $variant_data->name . ']';
            }
            else
                $mail_data['products'][$key] = $lims_product_data->name;

            if($lims_product_data->type == 'digital')
                $mail_data['file'][$key] = url('/public/product/files').'/'.$lims_product_data->file;
            else
                $mail_data['file'][$key] = '';
            if($sale_unit_id)
                $mail_data['unit'][$key] = $lims_sale_unit_data->unit_code;
            else
                $mail_data['unit'][$key] = '';

            $product_sale['sale_id'] = $id ;
            $product_sale['product_id'] = $pro_id;
            $product_sale['qty'] = $mail_data['qty'][$key] = $qty[$key];
            $product_sale['sale_unit_id'] = $sale_unit_id;
            $product_sale['net_unit_price'] = $net_unit_price[$key];
            $product_sale['discount'] = $discount[$key];
            $product_sale['tax_rate'] = $tax_rate[$key];
            $product_sale['tax'] = $tax[$key];
            $product_sale['total'] = $mail_data['total'][$key] = $total[$key];
            
            if($product_sale['variant_id'] && in_array($product_variant_id[$key], $old_product_variant_id)) {
                Product_Sale::where([
                    ['product_id', $pro_id],
                    ['variant_id', $product_sale['variant_id']],
                    ['sale_id', $id]
                ])->update($product_sale);
            }
            elseif( $product_sale['variant_id'] === null && (in_array($pro_id, $old_product_id)) ) {
                Product_Sale::where([
                    ['sale_id', $id],
                    ['product_id', $pro_id]
                ])->update($product_sale);
            }
            else
                Product_Sale::create($product_sale);
        }
        $lims_sale_data->update($data);
        $lims_customer_data = User::find($data['customer_id']);
        $message = 'Sale updated successfully';
        //collecting mail data
        if($lims_customer_data->email){
            $mail_data['email'] = $lims_customer_data->email;
            $mail_data['reference_no'] = $lims_sale_data->reference_no;
            $mail_data['sale_status'] = $lims_sale_data->sale_status;
            $mail_data['payment_status'] = $lims_sale_data->payment_status;
            $mail_data['total_qty'] = $lims_sale_data->total_qty;
            $mail_data['total_price'] = $lims_sale_data->total_price;
            $mail_data['order_tax'] = $lims_sale_data->order_tax;
            $mail_data['order_tax_rate'] = $lims_sale_data->order_tax_rate;
            $mail_data['order_discount'] = $lims_sale_data->order_discount;
            $mail_data['shipping_cost'] = $lims_sale_data->shipping_cost;
            $mail_data['grand_total'] = $lims_sale_data->grand_total;
            $mail_data['paid_amount'] = $lims_sale_data->paid_amount;
            if($mail_data['email']){
                try{
                    Mail::send( 'mail.sale_details', $mail_data, function( $message ) use ($mail_data)
                    {
                        $message->to( $mail_data['email'] )->subject( 'Sale Details' );
                    });
                }
                catch(\Exception $e){
                    $message = 'Sale updated successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
                }
            }
        }

        return redirect('seller/all_sales')->with('message', $message);
    }

    public function getProduct($id)
    {
       $type = 1;
       $auth_id = Auth::id();
       $lims_product_warehouse_data = Term::where('type', 'product')
       ->with('preview')->where('status', $type)
       ->where('user_id', $auth_id)->get();



       $product_code = [];
       $product_name = [];
       $product_qty = [];
       $product_price = [];
       $product_data = [];
        //product without variant

       foreach ($lims_product_warehouse_data as $product_warehouse) 
       {

        $product_qty[] = $product_warehouse->stock->stock_qty;
        $price= Price::where('term_id',$product_warehouse->id)->first()->price;
        $product_price[] = $price;
        $product_code[] =  $product_warehouse->id;
        $product_name[] = htmlspecialchars($product_warehouse->title);
        $product_type[] = $product_warehouse->type;
        $product_id[] = $product_warehouse->id;
        $product_list[] = $product_warehouse->product_list;
        $qty_list[] = $product_warehouse->qty_list;
    }


    $product_data = [$product_code, $product_name, $product_qty, $product_type, $product_id, $product_list, $qty_list, $product_price];

    return $product_data;
}

public function getProductByFilter($category_id, $brand_id)
{

    $auth_id = Auth::id();
    $type = 1;
    $data = [];

    if(($category_id != 0) && ($brand_id == 0)){


       $Attributes=Attribute::where('category_id',$category_id)->get();

       $lims_product_list_ides=[];

       foreach ($Attributes as $key => $Attribute) {

         array_push($lims_product_list_ides,$Attribute->term_id);
     }


     $lims_product_list=Term::where('type', 'product')
     ->with('preview')->where('status', $type)
     ->whereIn('id', $lims_product_list_ides)
     ->where('user_id', $auth_id)->get();


 }
 elseif(($category_id == 0) && ($brand_id != 0)){
    

         Category::where('id',$brand_id)->where('type','brand')->first();

     $Attributes=Postcategory::where('category_id',$brand_id)->get();

     $lims_product_list_ides=[];

     foreach ($Attributes as $key => $Attribute) {

         array_push($lims_product_list_ides,$Attribute->term_id);
     }
                 $lims_product_list_ides;

     $lims_product_list=Term::where('type', 'product')
     ->with('preview')->where('status', $type)
     ->whereIn('id', $lims_product_list_ides)
     ->where('user_id', $auth_id)->get();
 }
 else
 {
   $lims_product_list = DB::table('terms')->where('user_id',$auth_id)->get();
}

$index = 0;

foreach ($lims_product_list as $product) {

    $data['name'][$index] = $product->title;
    $data['code'][$index] = $product->id;
    $images =  asset( substr($product->preview->media->url, -51)  );
    $data['image'][$index] = $images;


    $index++;

}

return $data;
}


public function checkAvailability($warehouse_id)
{
    $open_register_number = CashRegister::where([
        ['user_id', Auth::id()],
        ['warehouse_id', $warehouse_id],
        ['status', true]
    ])->count();
    if($open_register_number)
        return 'true';
    else
        return 'false';
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $url = url()->previous();
        $lims_sale_data = Sale::find($id);
        $lims_product_sale_data = Product_Sale::where('sale_id', $id)->get();
        $lims_delivery_data = Delivery::where('sale_id',$id)->first();
        if($lims_sale_data->sale_status == 3)
            $message = 'Draft deleted successfully';
        else
            $message = 'Sale deleted successfully';
        foreach ($lims_product_sale_data as $product_sale) {
            $lims_product_data = Term::find($product_sale->product_id);
            //adjust product quantity
            if( ($lims_sale_data->sale_status == 1) && ($lims_product_data->type == 'combo') ){
                $product_list = explode(",", $lims_product_data->product_list);
                $qty_list = explode(",", $lims_product_data->qty_list);

                foreach ($product_list as $index=>$child_id) {
                    $child_data = Term::find($child_id);
                    $child_warehouse_data = Product_Warehouse::where([
                        ['product_id', $child_id],
                        ['warehouse_id', $lims_sale_data->warehouse_id ],
                    ])->first();

                    $child_data->qty += $product_sale->qty * $qty_list[$index];
                    $child_warehouse_data->qty += $product_sale->qty * $qty_list[$index];

                    $child_data->save();
                    $child_warehouse_data->save();
                }
            }
            elseif(($lims_sale_data->sale_status == 1) && ($product_sale->sale_unit_id != 0)){
                $lims_sale_unit_data = Unit::find($product_sale->sale_unit_id);
                if ($lims_sale_unit_data->operator == '*')
                    $product_sale->qty = $product_sale->qty * $lims_sale_unit_data->operation_value;
                else
                    $product_sale->qty = $product_sale->qty / $lims_sale_unit_data->operation_value;
                if($product_sale->variant_id) {
                    $lims_product_variant_data = ProductVariant::select('id', 'qty')->FindExactProduct($lims_product_data->id, $product_sale->variant_id)->first();
                    $lims_product_warehouse_data = Product_Warehouse::FindProductWithVariant($lims_product_data->id, $product_sale->variant_id, $lims_sale_data->warehouse_id)->first();
                    $lims_product_variant_data->qty += $product_sale->qty;
                    $lims_product_variant_data->save();
                }
                else {
                    $lims_product_warehouse_data = Product_Warehouse::FindProductWithoutVariant($lims_product_data->id, $lims_sale_data->warehouse_id)->first();
                }

                $lims_product_data->qty += $product_sale->qty;
                $lims_product_warehouse_data->qty += $product_sale->qty;
                $lims_product_data->save();
                $lims_product_warehouse_data->save();
            }
            $product_sale->delete();
        }
        $lims_payment_data = Payment::where('sale_id', $id)->get();
        foreach ($lims_payment_data as $payment) {
            if($payment->paying_method == 'Gift Card'){
                $lims_payment_with_gift_card_data = PaymentWithGiftCard::where('payment_id', $payment->id)->first();
                $lims_gift_card_data = GiftCard::find($lims_payment_with_gift_card_data->gift_card_id);
                $lims_gift_card_data->expense -= $payment->amount;
                $lims_gift_card_data->save();
                $lims_payment_with_gift_card_data->delete();
            }
            elseif($payment->paying_method == 'Cheque'){
                $lims_payment_cheque_data = PaymentWithCheque::where('payment_id', $payment->id)->first();
                $lims_payment_cheque_data->delete();
            }
            elseif($payment->paying_method == 'Credit Card'){
                $lims_payment_with_credit_card_data = PaymentWithCreditCard::where('payment_id', $payment->id)->first();
                $lims_payment_with_credit_card_data->delete();
            }
            elseif($payment->paying_method == 'Paypal'){
                $lims_payment_paypal_data = PaymentWithPaypal::where('payment_id', $payment->id)->first();
                if($lims_payment_paypal_data)
                    $lims_payment_paypal_data->delete();
            }
            elseif($payment->paying_method == 'Deposit'){
                $lims_customer_data = Customer::find($lims_sale_data->customer_id);
                $lims_customer_data->expense -= $payment->amount;
                $lims_customer_data->save();
            }
            $payment->delete();
        }
        if($lims_delivery_data)
            $lims_delivery_data->delete();
        if($lims_sale_data->coupon_id) {
            $lims_coupon_data = Coupon::find($lims_sale_data->coupon_id);
            $lims_coupon_data->used -= 1;
            $lims_coupon_data->save();
        }
        $lims_sale_data->delete();
        return Redirect::to($url)->with('not_permitted', $message);
    }

    public function getCustomerGroup($id)
    {
       $lims_customer_data = User::find($id);
       $lims_customer_group_data = CustomerGroup::find($lims_customer_data->customer_group_id);
       return $lims_customer_group_data->percentage;
   }


   public function customer_store(Request $request)
   {


     $limit=user_limit();
     $posts_count=\App\Models\User::where('created_by',Auth::id())->count();
     if ($limit['customer_limit'] <= $posts_count) {

       $error['errors']['error']=trans('Maximum customers limit exceeded');
       return response()->json($error,401);
   }


   $validatedData = $request->validate([
    'email' => 'required|email|unique:users,email|max:50',
    'name' => 'required|max:20',
    'phone' => 'required',
]);

   $data=Auth::user();


   $user= new User;
   $user->name = $request->name;
   $user->email = $request->email;
   $user->role_id = 2;
   $user->created_by = $data->id;
   $user->domain_id = $data->domain_id;
   $user->phone = $request->phone;
   $user->save();

        return response()->json([trans('success')]);
   
}



}
