<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:49
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\helpers\list\list_action_details.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a5046ec3_84321731',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b5f8e3f67edeecd83e598db91c65eaa72813830' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\helpers\\list\\list_action_details.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a5046ec3_84321731 (Smarty_Internal_Template $_smarty_tpl) {
?>
<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" id="details_<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['params']->value['action'], ENT_QUOTES, 'UTF-8', true);?>
_<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="">
	<i class="icon-eye-open"></i> <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>

</a><?php }
}
