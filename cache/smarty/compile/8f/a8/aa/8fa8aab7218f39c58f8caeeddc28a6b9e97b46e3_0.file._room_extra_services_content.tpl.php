<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:31
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_partials\_room_extra_services_content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29312e6b2_23382510',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8fa8aab7218f39c58f8caeeddc28a6b9e97b46e3' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_partials\\_room_extra_services_content.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:controllers/orders/modals/_extra_services_facilities_tab_content.tpl' => 1,
    'file:controllers/orders/modals/_extra_services_service_products_tab_content.tpl' => 1,
  ),
),false)) {
function content_68e4f29312e6b2_23382510 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:controllers/orders/modals/_extra_services_facilities_tab_content.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:controllers/orders/modals/_extra_services_service_products_tab_content.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<style type="text/css">
	/*Extra demands CSS*/
	#edit_product .extra-services-container .room_demands_container,
	#edit_product .extra-services-container .room_services_container {
		display: none;}
	#edit_product .extra-services-container #save_room_demands,
	#edit_product .extra-services-container #back_to_demands_btn,
	#edit_product .extra-services-container #save_service_service,
	#edit_product .extra-services-container #back_to_service_btn {
		display: none;}
</style>

<?php }
}
