<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:51
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\helpers\tree\tree_node_item.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a79ea300_58967812',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4f4f4e5b49fc8bbdb5645a8e2060374fd5156039' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\helpers\\tree\\tree_node_item.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a79ea300_58967812 (Smarty_Internal_Template $_smarty_tpl) {
?>
<li class="tree-item" <?php if ((isset($_smarty_tpl->tpl_vars['node']->value['hidden'])) && $_smarty_tpl->tpl_vars['node']->value['hidden'] == true) {?> hidden="hidden"<?php }?>>
	<span class="tree-item-name">
		<i class="tree-dot"></i>
		<label class="tree-toggler"><?php echo $_smarty_tpl->tpl_vars['node']->value['name'];?>
</label>
	</span>
	<?php if ((isset($_smarty_tpl->tpl_vars['node']->value['badge']))) {?>
		<span class="badge <?php if ((isset($_smarty_tpl->tpl_vars['node']->value['badge']['class']))) {
echo $_smarty_tpl->tpl_vars['node']->value['badge']['class'];
}?>"><?php echo $_smarty_tpl->tpl_vars['node']->value['badge']['title'];?>
</span>
	<?php }?>
	<?php if ((isset($_smarty_tpl->tpl_vars['node']->value['hint']))) {?>
		<div class="node-hint"><?php echo $_smarty_tpl->tpl_vars['node']->value['hint'];?>
</div>
	<?php }?>
</li><?php }
}
