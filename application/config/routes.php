<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

//News detail
$route['News-(:any)-(:num).html'] = 'news/text_news/$1/$2';

//Gallery Detail
$route['Gallery-(:any)-(:num).html'] = 'gallery/gallery_detail/$1/$2';

//Article
$route['Article-(:any)-(:num).html'] = 'article/index/$1/$2';

//Home
$route['Home.html'] = 'home/index';

//News List
$route['News.html'] = 'news/index';
$route['News.html/(:num)'] = 'news/index/$1';

//Gallery List
$route['Gallery.html'] = 'Gallery/index';
$route['Gallery.html/(:num)'] = 'Gallery/index/$1';

//Products
$route['Products.html'] = 'Products/index';

//Financial Statement
$route['Financial_Statement.html'] = 'Financial_Statement/index';

//Contract
$route['Contact.html'] = 'contact/index';

//Annual Report
$route['Annual_Report.html'] = 'annual_report/index';
$route['Annual_Report-(:any).html'] = 'annual_report/index/$1';

//Form 56-1
$route['Form_56-1.html'] = 'Form_56_1/index';
$route['Form_56-1.html/(:num)'] = 'Form_56_1/index/$1';

//Annual General Meeting
$route['Annual-General-Meeting.html'] = 'meeting/index';
$route['Annual-General-Meeting.html/(:num)'] = 'meeting/index/$1';

 //-----------------------------------------------------------------------------------
$route['default_controller'] = "home";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */