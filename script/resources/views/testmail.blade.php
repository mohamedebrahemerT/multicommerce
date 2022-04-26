<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
table, th, td {
  border: 1px solid black;
}

table {
  width: 100%;
  text-align: center;
}
</style>
</head>

<body>


	<div  style="margin:1%">
<div class="row">
	<div class="col-6">
		<img src="/uploads/6/logo.png" alt="">
		<br>
		thank you for shoping on ...market this  bla bla  bla bla  bla bla  bla bla  bla bla  bla bla  bla bla  bla bla 
		
	</div>

	<div class="col-6">
		<h5 style="text-align:center;">barcode</h5>
		 <table>
		 	  <tr><td>Invioce</td>	<td>12</td></tr>
		 	  <tr><td>Ref</td>	<td> </td></tr>
		 	  <tr><td>Date</td>	<td>wed 2021-07-28</td></tr>
		 	  <tr><td>Time</td>	<td>10:35:37</td></tr>
		 </table>
		
	</div>

       <div class="col-12">
       	<br>
       	 <table>
       	 	 <tr><td colspan="6" style="background-color:#eee">address</td> </tr>
		 	  <tr><td>9990000000</td> <td>mobile</td> <td>mohamed@gmail.com</td> <td>email</td> <td>ahmed</td> <td>full name</td> </tr>

		 	   
		 	  <tr><td>1</td> <td>Adress ID</td> <td>cairo </td> <td>city</td> <td>egypt</td> <td>country</td> </tr>

		 	    <tr><td>1</td> <td>country ID</td> <td>9990000000 </td> <td>Mobile</td> <td>12124</td> <td>USer ID</td> </tr>

		 	  <tr><td>1</td> <td>block</td> <td>4 </td> <td>street</td> <td>zagazig</td> <td>City</td> </tr>
		 	  
		 </table>
       	
       </div>


         <div class="col-12">
       	<br>
       	 <table>
       	 	 <tr><td colspan="7" style="background-color:#eee">Order note</td>


       	 	  </tr>
		 	  <tr><td>total</td><td>QTY</td> <td>price</td>  <td>product name</td> <td>image</td> </tr>
                                  @foreach($info->order_item as $row)

		 	   <tr><td>50 $</td><td>{{ amount_format($row->amount) }}
                                                    × {{ $row->qty }}</td> <td>{{ amount_format($row->amount) }}</td>  
		 	   	<td>
		 	   		{{ Str::limit($row->term->title,50) ?? '' }}

		 	   		@php
                                                        $variations=json_decode($row->info);
                                                    @endphp
                                                    @foreach ($variations->attribute ?? [] as $item)

                                                        <span></span> <small>{{ $item->attribute->name ?? '' }}
                                                            - {{ $item->variation->name ?? '' }}</small>,
                                                    @endforeach

                                                    @foreach ($variations->options ?? [] as $option)
                                                        <span>{{ __('Option') }} :</span>
                                                        <small>{{ $option->name ?? '' }}</small>,
                                                    @endforeach
		 	   	</td> 

		 	   	<td>
		 	   		<img class="pic-2" src="{{ asset($row->term->preview->media->url ?? 'uploads/default.png') }}" style="width:100px;height:100px;">
		 	   	</td> 
		 	   </tr>

                                        @endforeach


		 	   
		 	 
		 	  
		 </table>
       	
       </div>

        <div class="col-12">
       	<br>
       	 <table>
       	 	 <tr style="background-color:#eee"> <td>Grand Total</td> <td>coupon</td> <td>Discount or coupon</td> <td>shiping</td> <td>Total</td> <td>PAyment Method</td> </tr>
		  
		 	     <tr><td> {{ amount_format($info->total) }}</td><td>0.00</td> <td>{{ amount_format($order_content->coupon_discount) }}</td> <td>{{ amount_format($info->shipping) }}</td>   <td>{{ amount_format($info->total) }}</td> <td>{{ $info->payment_method->method->name ?? 'الدفع عند الاستلام ' }}</td> </tr>

		 	   
		 	 
		 	  
		 </table>
       	
       </div>

       <div class="col-12">
       	<br>
       	 <table>
       	 	 <tr style="background-color:#eee">   <td>التوقيع </td> <td>وقت التسليم </td> <td>تاريخ التسليم </td>  </tr>
		  
		 	     <tr><td>.....</td><td>.....</td> <td>...</td>   </tr>

		 	   
		 	 
		 	  
		 </table>
       	
       </div>
</div>		

	</div>
   <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script-->

</body>
</html>