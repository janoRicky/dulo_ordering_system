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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'E_controller_main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['img'] = 'E_controller_main/view_image';


// PAGES - USER
$route['home'] = 'E_controller_main/view_u_home';
$route['products'] = 'E_controller_main/view_u_products';
$route['product'] = 'E_controller_main/view_u_product';
$route['custom'] = 'E_controller_main/view_u_custom';
$route['cart'] = 'E_controller_main/view_u_cart';
$route['login'] = 'E_controller_main/view_u_login';
$route['register'] = 'E_controller_main/view_u_register';

$route['account'] = 'E_controller_main/view_u_account';
$route['account_details'] = 'E_controller_main/view_u_account_details';
$route['my_orders'] = 'E_controller_main/view_u_my_orders';
$route['my_order_details'] = 'E_controller_main/view_u_my_order_details';
$route['my_order_payment'] = 'E_controller_main/view_u_my_order_payment';
$route['my_order_payment_adtl'] = 'E_controller_main/view_u_my_order_adtl_payment';

$route['customer_support'] = 'E_controller_main/view_u_customer_support';


// SESSION
$route['to_cart'] = 'user/U_controller_session/to_cart';
$route['remove_from_cart'] = 'user/U_controller_session/remove_from_cart';

// FUNCTIONS
$route['login_verify'] = 'user/U_controller_login/user_login_verification';
$route['logout'] = 'E_controller_main/user_logout';

$route['register_account'] = 'user/U_controller_create/user_account_register';

$route['place_order'] = 'user/U_controller_create/new_order';
$route['place_custom_order'] = 'user/U_controller_create/new_order_custom';
$route['payment'] = 'user/U_controller_create/submit_payment';

$route['update_personal_info'] = 'user/U_controller_update/user_details_update';
$route['update_account_info'] = 'user/U_controller_update/user_account_update';
$route['update_address_info'] = 'user/U_controller_update/user_address_update';
$route['update_contact_info'] = 'user/U_controller_update/user_contact_update';

$route['submit_order'] = 'E_controller_main/view_u_submit_order';

$route['order_receive'] = 'user/U_controller_update/user_order_receive';

$route['send_message'] = 'user/U_controller_create/new_message_user';

// PAGES - ADMIN
$route['admin'] = 'E_controller_main/view_a_login';
$route['admin/dashboard'] = 'E_controller_main/view_a_dashboard';
$route['admin/config'] = 'E_controller_main/view_a_config';

$route['admin/products'] = 'E_controller_main/view_a_products';
$route['admin/products_view'] = 'E_controller_main/view_a_products_view';
$route['admin/products_edit'] = 'E_controller_main/view_a_products_edit';

$route['admin/types'] = 'E_controller_main/view_a_types';
$route['admin/types_view'] = 'E_controller_main/view_a_types_view';
$route['admin/types_edit'] = 'E_controller_main/view_a_types_edit';

$route['admin/orders'] = 'E_controller_main/view_a_orders';
$route['admin/orders_view'] = 'E_controller_main/view_a_orders_view';
$route['admin/orders_edit'] = 'E_controller_main/view_a_orders_edit';

$route['admin/orders_custom'] = 'E_controller_main/view_a_orders_custom';
$route['admin/orders_custom_view'] = 'E_controller_main/view_a_orders_custom_view';
$route['admin/orders_custom_edit'] = 'E_controller_main/view_a_orders_custom_edit';

$route['admin/users'] = 'E_controller_main/view_a_users';
$route['admin/users_view'] = 'E_controller_main/view_a_users_view';
$route['admin/users_edit'] = 'E_controller_main/view_a_users_edit';

$route['admin/messaging'] = 'E_controller_main/view_a_messaging';
$route['admin/messaging_view'] = 'E_controller_main/view_a_messaging_view';

$route['admin/accounts'] = 'E_controller_main/view_a_accounts';
$route['admin/accounts_view'] = 'E_controller_main/view_a_accounts_view';
$route['admin/accounts_edit'] = 'E_controller_main/view_a_accounts_edit';


// FUNCTIONS
$route['admin/login'] = 'admin/A_controller_login/admin_login_verification';
$route['admin/logout'] = 'E_controller_main/admin_logout';

$route['admin/email_search'] = 'E_controller_main/search_emails';
$route['admin/address_get'] = 'E_controller_main/get_address';

$route['admin/name_search'] = 'E_controller_main/search_names';
$route['admin/info_get'] = 'E_controller_main/get_info';

$route['admin/user_search'] = 'E_controller_main/search_users';

// - CREATE
$route['admin/product_create'] = 'admin/A_controller_create/new_product';
$route['admin/type_create'] = 'admin/A_controller_create/new_type';
$route['admin/order_create'] = 'admin/A_controller_create/new_order';
$route['admin/order_custom_create'] = 'admin/A_controller_create/new_order_custom';
$route['admin/user_create'] = 'admin/A_controller_create/new_user_account';
$route['admin/acc_create'] = 'admin/A_controller_create/new_admin_account';

$route['admin/order_add_payment'] = 'admin/A_controller_create/new_order_payment';
$route['admin/order_add_payment_tbp'] = 'admin/A_controller_create/new_order_payment_tbp';
$route['admin/message_send'] = 'admin/A_controller_create/new_message_admin';

// - UPDATE
$route['admin/product_update'] = 'admin/A_controller_update/edit_product';
$route['admin/type_update'] = 'admin/A_controller_update/edit_type';
$route['admin/order_update'] = 'admin/A_controller_update/edit_order';
$route['admin/order_custom_update'] = 'admin/A_controller_update/edit_order_custom';
$route['admin/user_update'] = 'admin/A_controller_update/edit_user_account';
$route['admin/acc_update'] = 'admin/A_controller_update/edit_admin_account';

$route['admin/product_update_featured'] = 'admin/A_controller_update/edit_product_featured';
$route['admin/type_update_featured'] = 'admin/A_controller_update/edit_type_featured';
$route['admin/product_update_visibility'] = 'admin/A_controller_update/edit_product_visibility';
$route['admin/order_update_state'] = 'admin/A_controller_update/edit_order_state';
$route['admin/order_update_state_custom'] = 'admin/A_controller_update/edit_order_state_custom';
$route['admin/order_update_payment'] = 'admin/A_controller_update/edit_order_payment';

$route['admin/config_update'] = 'admin/A_controller_update/edit_config';

// - DELETE
$route['admin/product_delete'] = 'admin/A_controller_delete/delete_product';
$route['admin/type_delete'] = 'admin/A_controller_delete/delete_type';
$route['admin/order_delete'] = 'admin/A_controller_delete/delete_order';
$route['admin/order_custom_delete'] = 'admin/A_controller_delete/delete_order_custom';
$route['admin/user_delete'] = 'admin/A_controller_delete/delete_user_account';
$route['admin/acc_delete'] = 'admin/A_controller_delete/delete_admin_account';

$route['admin/payment_delete'] = 'admin/A_controller_delete/delete_payment_tbp';


// NOTES:
// url of admin log-in is "http://localhost/angeliclay_system/admin"
// url of admin dashboard is "http://localhost/angeliclay_system/admin/dashboard"
