<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:06
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\category-count.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27ad67cb7_95110405',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '492bc36a4048ca8316bae9ddb4b68d5977e49f66' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\category-count.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27ad67cb7_95110405 (Smarty_Internal_Template $_smarty_tpl) {
?><span class="heading-counter"><?php if (((isset($_smarty_tpl->tpl_vars['category']->value)) && $_smarty_tpl->tpl_vars['category']->value->id == 1) || ((isset($_smarty_tpl->tpl_vars['nb_products']->value)) && $_smarty_tpl->tpl_vars['nb_products']->value == 0)) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There are no products in this category.'),$_smarty_tpl ) );
} else {
if ((isset($_smarty_tpl->tpl_vars['nb_products']->value)) && $_smarty_tpl->tpl_vars['nb_products']->value == 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There is 1 product.'),$_smarty_tpl ) );
} elseif ((isset($_smarty_tpl->tpl_vars['nb_products']->value))) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There are %d products.','sprintf'=>$_smarty_tpl->tpl_vars['nb_products']->value),$_smarty_tpl ) );
}
}?></span>
<?php }
}
