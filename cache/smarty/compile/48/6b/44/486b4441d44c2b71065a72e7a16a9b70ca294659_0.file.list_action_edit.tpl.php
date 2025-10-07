<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:44
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\tax_rules\helpers\list\list_action_edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a0b51929_45390915',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '486b4441d44c2b71065a72e7a16a9b70ca294659' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\tax_rules\\helpers\\list\\list_action_edit.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a0b51929_45390915 (Smarty_Internal_Template $_smarty_tpl) {
?><a onclick="loadTaxRule('<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
'); return false;" href="#" class="btn btn-default">
	<i class="icon-pencil"></i>
	<?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a><?php }
}
