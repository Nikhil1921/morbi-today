<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['adminPanel'] = 'adminPanel/home';
$route['adminPanel/logout'] = 'adminPanel/home/logout';
$route['adminPanel/dashboard'] = 'adminPanel/home';
$route['adminPanel/blog']['post'] = 'adminPanel/blog/get';
$route['adminPanel/blogCategory']['post'] = 'adminPanel/blogCategory/get';
$route['adminPanel/advertisement']['post'] = 'adminPanel/advertisement/get';
$route['adminPanel/video']['post'] = 'adminPanel/video/get';
$route['adminPanel/paperCategory']['post'] = 'adminPanel/paperCategory/get';
$route['adminPanel/ePaper']['post'] = 'adminPanel/ePaper/get';
$route['adminPanel/submitNews']['post'] = 'adminPanel/submitNews/get';
$route['adminPanel/socialMedia']['post'] = 'adminPanel/socialMedia/get';
$route['adminPanel/gallery']['post'] = 'adminPanel/gallery/get';

$route['adminPanel/profile'] = 'adminPanel/home/profile';
$route['adminPanel/whatsapp'] = 'adminPanel/home/whatsapp';
$route['adminPanel/changePassword'] = 'adminPanel/home/changePassword';
$route['adminPanel/forgotPassword'] = 'adminPanel/login/forgotPassword';
$route['adminPanel/checkOtp'] = 'adminPanel/login/checkOtp';
$route['adminPanel/backup'] = 'adminPanel/home/backup';

$route['/(:num)'] = 'home/$1';
$route['news/(:num)'] = 'home/news/$1';
$route['news/(:num)/(:any)'] = 'home/news/$1';
$route['category/(:num)'] = 'home/category/$1';
$route['category/(:num)/(:num)'] = 'home/category/$1/$2';
$route['epaper'] = 'home/epaper';
$route['paper/(:num)'] = 'home/paper/$1';
$route['video'] = 'home/video';
$route['about'] = 'home/about';
$route['contact'] = 'home/contact';
$route['submitNews']['get'] = 'home/submitNews';
$route['news']['post'] = 'home/news';
$route['submitNews']['post'] = 'home/submitNewsPost';
$route['all_news/(:num)'] = 'home/all_news/$1';