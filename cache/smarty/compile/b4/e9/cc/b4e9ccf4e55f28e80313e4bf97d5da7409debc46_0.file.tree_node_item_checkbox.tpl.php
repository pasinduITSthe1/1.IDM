<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:51
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\helpers\tree\tree_node_item_checkbox.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a7b19538_02120510',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b4e9ccf4e55f28e80313e4bf97d5da7409debc46' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\helpers\\tree\\tree_node_item_checkbox.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a7b19538_02120510 (Smarty_Internal_Template $_smarty_tpl) {
?><li class="tree-item<?php if ((isset($_smarty_tpl->tpl_vars['node']->value['disabled'])) && $_smarty_tpl->tpl_vars['node']->value['disabled'] == true) {?> tree-item-disable<?php }?>" <?php if ((isset($_smarty_tpl->tpl_vars['node']->value['hidden'])) && $_smarty_tpl->tpl_vars['node']->value['hidden'] == true) {?> hidden="hidden"<?php }?>>
	<span class="tree-item-name<?php if ((isset($_smarty_tpl->tpl_vars['node']->value['disabled'])) && $_smarty_tpl->tpl_vars['node']->value['disabled'] == true) {?> tree-item-name-disable<?php }?>">
		<input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['node']->value['input_name'];?>
[]" value="<?php echo $_smarty_tpl->tpl_vars['node']->value['value'];?>
"<?php if ((isset($_smarty_tpl->tpl_vars['node']->value['selected'])) && $_smarty_tpl->tpl_vars['node']->value['selected'] == true) {?> checked="checked"<?php }
if ((isset($_smarty_tpl->tpl_vars['node']->value['disabled'])) && $_smarty_tpl->tpl_vars['node']->value['disabled'] == true) {?> disabled="disabled"<?php }?> <?php if ((isset($_smarty_tpl->tpl_vars['node']->value['hidden'])) && $_smarty_tpl->tpl_vars['node']->value['hidden'] == true) {?> hidden="hidden"<?php }?> />
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
</li>
<?php }
}
