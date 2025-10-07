<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:51
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\helpers\tree\tree_node_folder.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a7571077_85769350',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '39da9e869e4b9ea62455ee2de1b8dc4189beaba5' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\helpers\\tree\\tree_node_folder.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a7571077_85769350 (Smarty_Internal_Template $_smarty_tpl) {
?><li class="tree-folder" <?php if ((isset($_smarty_tpl->tpl_vars['node']->value['hidden'])) && $_smarty_tpl->tpl_vars['node']->value['hidden'] == true) {?> hidden="hidden"<?php }?>>
	<span class="tree-folder-name">
		<i class="icon-folder-close"></i>
		<label class="tree-toggler"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['node']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
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
	<ul class="tree">
		<?php echo $_smarty_tpl->tpl_vars['children']->value;?>

	</ul>
</li><?php }
}
