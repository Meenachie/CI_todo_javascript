<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['new'] = 'Welcome/hello';

//testing
$route['gtoken'] = 'Test_api/tokenGen';
$route['vtoken'] = 'Test_api/verify';

//user login
$route['ssignup'] = 'User/signup';
$route['slogin'] = 'User/login';
$route['screate'] = 'Crud/create';
$route['sread'] = 'Crud/read';
$route['sreadtask/(:num)'] = 'Crud/readtask/$1';
$route['supdate/(:num)'] = 'Crud/update/$1';
$route['sdelete/(:num)'] = 'Crud/delete/$1';
$route['sprofile'] = 'Crud/profile';
$route['schange_pwd'] = 'Crud/changePassword';
//using
$route['welcome'] = 'Old';
$route['login'] = 'Old/login';
$route['aflogin'] = 'Old/aflogin';
$route['vprofile'] = 'Old/vprofile';
$route['vchange_password'] = 'Old/vchange_password';
$route['bfedit/(:num)'] = 'Old/bfedit/$1';
$route['signup'] = 'Old/signup';

//beanstalkd
$route['createtask'] = 'Task/ctask';

//old



// $route['home'] = 'Old/home';
// $route['profile'] = 'Old/profile';
// $route['change_password'] = 'Old/change_password';
// $route['logout'] = 'Old/logout';
// $route['create'] = 'Old/create';
// $route['edit/(:any)'] = 'Old/edit/$1';
// $route['update/(:num)'] = 'Old/update/$1';
// $route['delete/(:any)'] = 'Old/delete/$1';

