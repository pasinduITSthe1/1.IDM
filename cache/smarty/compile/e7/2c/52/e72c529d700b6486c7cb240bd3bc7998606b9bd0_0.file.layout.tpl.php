<?php
/* Smarty version 4.5.5, created on 2025-11-03 11:48:25
  from 'C:\wamp64\www\1.IDM\admin134miqa0b\themes\default\template\layout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69084931230bc0_59728341',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e72c529d700b6486c7cb240bd3bc7998606b9bd0' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin134miqa0b\\themes\\default\\template\\layout.tpl',
      1 => 1759835419,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./alerts.tpl' => 1,
  ),
),false)) {
function content_69084931230bc0_59728341 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['header']->value;?>

<?php $_smarty_tpl->_subTemplateRender('file:./alerts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
echo $_smarty_tpl->tpl_vars['page']->value;?>

<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

<?php }
}
