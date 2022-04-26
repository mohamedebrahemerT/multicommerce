<?php
// To implement in admingroups permissions
// to remove CRUD from Validation remove route name
return [
	
	"dashboard" => [ 'read'],
	"Orders" => ['create', 'read', 'update', 'delete'],
	"Plans" => ['create', 'read', 'update', 'delete'],
	"Reports" => ['read'],
	"Customers" => ['create', 'read', 'update', 'delete'],
	"counteries" => ['create', 'read', 'update', 'delete'],
	"cities" => ['create', 'read', 'update', 'delete'],
	"states" => ['create', 'read', 'update', 'delete'],
	"Domains" => ['create', 'read', 'update', 'delete'],
	"cron" => [ 'read'],
	"paymentgeteway" => ['read', 'update' ],
	"Pages" => ['create', 'read', 'update', 'delete'],
	"FrontendSettings" => [ 'read', 'update' ],
	"Gallery" => [ 'read', 'update' ],
	"Menu" => [ 'read', 'update' ],
	"SEO" => [ 'read', 'update' ],
	"marketing" => ['create', 'read', 'update', 'delete'],
	
	"settings" => [ 'read', 'update'],
	"CpanelCredentials" => ['create', 'read', 'update', 'delete'],
	"SystemEnvironment" => ['create', 'read', 'update', 'delete'],
	"Admins" => ['create', 'read', 'update', 'delete'],
	 
	"AdminGroup" => ['create', 'read', 'update', 'delete'],
	
];	