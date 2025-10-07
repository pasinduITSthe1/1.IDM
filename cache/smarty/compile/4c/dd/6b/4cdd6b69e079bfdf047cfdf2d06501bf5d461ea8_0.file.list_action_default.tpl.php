<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:48
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\helpers\list\list_action_default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a4e1ad70_43456925',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4cdd6b69e079bfdf047cfdf2d06501bf5d461ea8' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\helpers\\list\\list_action_default.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a4e1ad70_43456925 (Smarty_Internal_Template $_smarty_tpl) {
?><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
"<?php if ((isset($_smarty_tpl->tpl_vars['name']->value))) {?> name="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php }?> class="default">
	<i class="icon-asterisk"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a><?php }
}
