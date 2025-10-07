<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:43
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\slip\_status_change_link.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29f0ba5d2_28604315',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f56a25ca7e117d2346001b0c03ed9b15a9839725' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\slip\\_status_change_link.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29f0ba5d2_28604315 (Smarty_Internal_Template $_smarty_tpl) {
?>
<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['status_change_link']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Change Status'),$_smarty_tpl ) );?>
" class="change_status">
    <i class="icon-refresh"></i>
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Change Status'),$_smarty_tpl ) );?>

</a>
<?php }
}
