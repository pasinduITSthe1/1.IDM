<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:48
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\helpers\list\list_action_delete.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a4ee1f76_50307640',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3594a5909199ddcc9a70743af7a6f106d5e84886' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\helpers\\list\\list_action_delete.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a4ee1f76_50307640 (Smarty_Internal_Template $_smarty_tpl) {
?><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php if ((isset($_smarty_tpl->tpl_vars['confirm']->value))) {?> onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')){return true;}else{event.stopPropagation(); event.preventDefault();};"<?php }?> title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="delete">
	<i class="icon-trash"></i> <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>

</a><?php }
}
