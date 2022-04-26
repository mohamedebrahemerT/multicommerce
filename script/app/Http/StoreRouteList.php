<?php
// To implement in admingroups permissions
// to remove CRUD from Validation remove route name
return [
	
	"dashboard" => [ 'read'],
	"POS" => ['create', 'read', 'update', 'delete'],
	"Orders" => ['create', 'read', 'update', 'delete'],
	"Refund" => ['create', 'read', 'update', 'delete'],
	"Products" => ['create', 'read', 'update', 'delete'],
	"Inventory" => ['create', 'read', 'update', 'delete'],
	"Categories" => ['create', 'read', 'update', 'delete'],
	"Attributes" => ['create', 'read', 'update', 'delete'],
	"Brands" => ['create', 'read', 'update', 'delete'],
	"Coupons" => ['create', 'read', 'update', 'delete'],
	"Customers" => ['create', 'read', 'update', 'delete'],
	"Transactions" => ['create', 'read', 'update', 'delete'],
	"Reports" => ['create', 'read', 'update', 'delete'],
	"ReviewRatings" => ['create', 'read', 'update', 'delete'],
	"Shipping" => ['create', 'read', 'update', 'delete'],
	"locations" => ['create', 'read', 'update', 'delete'],
	"ShippingPrice" => ['create', 'read', 'update', 'delete'],
	"OfferAds" => ['create', 'read', 'update', 'delete'],
	"BumpAds" => ['create', 'read', 'update', 'delete'],
	"BannerAds" => ['create', 'read', 'update', 'delete'],
	"Settings" => ['create', 'read', 'update', 'delete'],
	"Bookingschedule" => ['create', 'read', 'update', 'delete'],
	"ShopSettings" => ['create', 'read', 'update', 'delete'],
	"taxes" => ['create', 'read', 'update', 'delete'],
	"PaymentOption" => ['create', 'read', 'update', 'delete'],
	"Subscriptions" => ['create', 'read', 'update', 'delete'],
	"MarketingTools" => ['create', 'read', 'update', 'delete'],
	"Calender" => ['create', 'read', 'update', 'delete'],
	"Employees" => ['create', 'read', 'update', 'delete'],
	"Onlinestore" => ['create', 'read', 'update', 'delete'],
	 
	 
	"AdminGroup" => ['create', 'read', 'update', 'delete'],
	
];	