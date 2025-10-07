<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:52
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\layout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a8b58c74_10448911',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd12d989ef9ab046c271ff65e3bfd549aadafc8c9' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\layout.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./alerts.tpl' => 1,
  ),
),false)) {
function content_68e4f2a8b58c74_10448911 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['header']->value;?>

<?php $_smarty_tpl->_subTemplateRender('file:./alerts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
echo $_smarty_tpl->tpl_vars['page']->value;?>

<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

<?php }
}
