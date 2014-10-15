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

$route['default_controller'] = "website/home/index";
$route['404_override'] = '';
/*--------route frontend-----------------------------*/
$route['trang-chu.html']= "website/home/index";
$route['gioi-thieu.html']= "website/home/about";
$route['san-pham.html']= "website/home/product";
$route['tin-tuc-su-kien.html']= "website/home/news";
$route['tu-van-hoi-dap.html']= "website/home/anw";
$route['ajax_product']= "website/home/ajax_product";
$route['san-pham/(:any)']= "website/home/detail_product/$1";
$route['tin-tuc-su-kien/(:any)']= "website/home/detail_news/$1";


/*--------End frontend------- */
/*--------route admincp------------------------------*/
$route['admincp'] = "admincp/login/index";
$route['backend/welcome'] = "welcome";
$route['logout'] = "admincp/login/logout";
$route['login'] = "admincp/login/loginAction";
$route['backend/game/index'] = "admincp/admin_game/index";
$route['backend/game/add'] = "admincp/admin_game/add";
$route['backend/list/(:any)'] = "admincp/admin_ajax/get_list/$1";
$route['backend/menu/add'] = "admincp/admin_menu/add";
$route['backend/menu/index'] = "admincp/admin_menu/index";

$route['backend/article/index'] = "admincp/admin_article/index";
$route['backend/article/add'] = "admincp/admin_article/add";
$route['backend/ajax/addarticle'] = "admincp/admin_ajax/addarticle";


$route['backend/account/index'] = "admincp/admin_account/index";
$route['backend/account/add'] = "admincp/admin_account/add";
$route['backend/ajax/addaccount'] = "admincp/admin_ajax/addaccount";

$route['backend/game/category'] = "admincp/admin_game/category";
$route['backend/game/addcategory'] = "admincp/admin_game/addcategory";
$route['backend/ajax/addgamecategory'] = "admincp/admin_ajax/addgamecategory";

$route['backend/ajax/addgame'] = "admincp/admin_ajax/addgame";
$route['backend/ajax/addgameimage'] = "admincp/admin_ajax/addgameimage";
$route['backend/ajax/addgameimagewap'] = "admincp/admin_ajax/addgameimagewap";

$route['backend/listgame'] = "admincp/admin_ajax/listgame";
$route['backend/listnewsevent'] = "admincp/admin_ajax/listnewsevent";

$route['backend/game/publisher'] = "admincp/admin_game/publisher";
$route['backend/game/addpublisher'] = "admincp/admin_game/addpublisher";
$route['backend/ajax/addpublisher'] = "admincp/admin_ajax/addpublisher";
$route['backend/ajax/updatestatusgame/(:any)/(:any)/(:any)/(:any)'] = "admincp/admin_ajax/updatestatusgame/$1/$2/$3/$4";
$route['backend/ajax/deletegame/(:any)/(:any)/(:any)/(:any)'] = "admincp/admin_ajax/deletegame/$1/$2/$3/$4";


$route['backend/game/platform'] = "admincp/admin_game/platform";
$route['backend/game/add_platform'] = "admincp/admin_game/add_platform";

$route['backend/newsevent/index'] = "admincp/admin_newsevent/index";
$route['backend/newsevent/add'] = "admincp/admin_newsevent/add";
$route['backend/ajax/addmenu'] = "admincp/admin_ajax/addmenu";
$route['backend/ajax/updatestatus/(:any)/(:any)/(:any)/(:any)'] = "admincp/admin_ajax/updatestatus/$1/$2/$3/$4";
$route['backend/ajax/delete/(:any)/(:any)/(:any)/(:any)'] = "admincp/admin_ajax/delete/$1/$2/$3/$4";

$route['backend/ajax/addmenu'] = "admincp/admin_ajax/addmenu";
$route['backend/newsevent/index'] = "admincp/admin_newsevent/index";
$route['backend/newsevent/add'] = "admincp/admin_newsevent/add";
$route['backend/newsevent/add/(:any)'] = "admincp/admin_newsevent/add/$1";
$route['backend/newsevent/addcategory/(:any)'] = "admincp/admin_newsevent/news_addcategory/$1";
$route['backend/updatenews/(:any)']="admincp/admin_ajax/updatenews/$1";
$route['backend/deletenews/(:any)']="admincp/admin_ajax/deletenews/$1";
$route['backend/ajax/addnewsevent'] = "admincp/admin_ajax/addnewsevent";
$route['backend/ajax/update_news_category'] = "admincp/admin_ajax/update_news_category";
$route['backend/ajax/delete_news_category'] = "admincp/admin_ajax/delete_news_category";
$route['backend/menu/group'] = "admincp/admin_menu/group";
$route['backend/menu/addgroup'] = "admincp/admin_menu/addgroup";
$route['backend/menu/addgroup/(:any)'] = "admincp/admin_menu/addgroup/$1";
$route['backend/updatemenugroup/(:any)']="admincp/admin_ajax/updatemenugroup/$1";
$route['backend/deletemenugroup/(:any)']="admincp/admin_ajax/deletemenugroup/$1";
$route['backend/ajax/addmenugroup'] = "admincp/admin_ajax/addmenugroup";
$route['backend/ajax/changepass'] = "admincp/admin_ajax/changepass";
$route['backend/newsevent/category'] = "admincp/admin_newsevent/news_category";
$route['backend/newsevent/addcategory'] = "admincp/admin_newsevent/news_addcategory";
$route['backend/ajax/addnewseventimage'] = "admincp/admin_ajax/addnewseventimage";
$route['backend/home/index'] = "admincp/admin_home/index";
$route['backend/home/add'] = "admincp/admin_home/add";
$route['backend/ajax/addslide'] = "admincp/admin_ajax/addslide";
$route['backend/product/index'] = "admincp/admin_product/index";
$route['backend/product/add'] = "admincp/admin_product/add";
$route['backend/ajax/addproduct'] = "admincp/admin_ajax/addproduct";
$route['backend/contact/index'] = "admincp/admin_contact/index";
$route['backend/contact/detail'] = "admincp/admin_contact/detail";
$route['backend/ajax/contact_count'] = "admincp/admin_ajax/contact_count";
/* End of file routes.php */
/* Location: ./application/config/routes.php */