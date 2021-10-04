<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Karyon Framework Configuration File
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views
| when calling MY_Controller's render() function.
|
*/

$config['karyon_config'] = array(

	// Site name
	'site_name' => 'Karyon Framework',

	// Default page title prefix
	'page_title_prefix' => '',

	// Default page title
	'page_title' => 'Karyon Framework',

	// Default meta data
	'meta_data'	=> array(
		'author'		=> 'Karyon Solutions',
		'description'	=> 'Karyon Solutions Framework',
		'keywords'		=> ''
		),

	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
			'plugins/jQuery/jquery-2.2.3.min.js',
			),
		'foot'	=> array(
			'assets/bootstrap/dist/js/bootstrap.min.js',
			'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
			'assets/admin/js/jquery.validate.js',
			'assets/admin/js/form-validation.js',
			'plugins/toastr/toastr.js',			
			'plugins/sweetalert/sweetalert2.all.js',
			'plugins/sweetalert/sweetalert2.js',
			'plugins/datatables/jquery.dataTables.min.js',
			'plugins/datatables/dataTables.bootstrap.min.js',
			'plugins/slimScroll/jquery.slimscroll.min.js',
			'assets/admin/dist/js/app.min.js',
			'assets/admin/dist/js/demo.js',
			'plugins/select2/select2.full.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
			'plugins/fullcalendar/fullcalendar.min.js',
			'plugins/timepicker/bootstrap-timepicker.min.js',
			'assets/admin/dist/js/custom-file-input.js',
			'https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js',
			'plugins/daterangepicker.js',
			'plugins/datepicker/bootstrap-datepicker.js'
			
			),
		),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'plugins/datepicker/datepicker3.css',
			'assets/bootstrap/dist/css/bootstrap.min.css',
			'plugins/font-awesome/css/font-awesome.min.css',
			'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
			'plugins/datatables/dataTables.bootstrap.css',
			'plugins/timepicker/bootstrap-timepicker.min.css',
			'plugins/fullcalendar/fullcalendar.min.css',
			'plugins/fullcalendar/fullcalendar.print.css',
			'assets/admin/dist/css/AdminLTE.css',
			'assets/admin/dist/css/skins/_all-skins.css',
			'assets/admin/dist/css/demo.css',
			'assets/admin/dist/css/component.css',
			'plugins/toastr/toastr.css',
			'assets/admin/dist/css/custom.css',
			'plugins/daterangepicker.css',
			)
		),

	// Default CSS class for <body> tag
	'body_class' => '',

	// Menu items
	'menu' => array(
		'admin' => array(
			'name'		=> 'admin',
			'url'		=> '',
			),
		),

	// Login page
	'login_url' => 'login/loginPage',

	// Restricted pages
	'page_auth' => array(
		),

	// Debug tools
	'debug' => array(
		'view_data'	=> FALSE,
		'profiler'	=> FALSE
		),
	);
