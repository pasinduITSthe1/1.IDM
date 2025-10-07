<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:48
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\helpers\form\form_group.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a49dae50_39231369',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04eb1d8890ab716140e1985bfb86e552bca46bc9' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\helpers\\form\\form_group.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a49dae50_39231369 (Smarty_Internal_Template $_smarty_tpl) {
if (count($_smarty_tpl->tpl_vars['groups']->value) && (isset($_smarty_tpl->tpl_vars['groups']->value))) {?>
<div class="row">
	<div class="col-lg-6">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="fixed-width-xs">
						<span class="title_box">
							<input type="checkbox" name="checkme" id="checkme" onclick="checkDelBoxes(this.form, '<?php echo $_smarty_tpl->tpl_vars['input']->value['name'];?>
[]', this.checked)" />
						</span>
					</th>
					<th class="fixed-width-xs">
						<span class="title_box">
							<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['groups_id_title'])) && $_smarty_tpl->tpl_vars['input']->value['groups_id_title']) {
echo $_smarty_tpl->tpl_vars['input']->value['groups_id_title'];
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'ID'),$_smarty_tpl ) );
}?>
						</span>
					</th>
					<th>
						<span class="title_box">
							<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['groups_title'])) && $_smarty_tpl->tpl_vars['input']->value['groups_title']) {
echo $_smarty_tpl->tpl_vars['input']->value['groups_title'];
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Group name'),$_smarty_tpl ) );
}?>
						</span>
					</th>
				</tr>
			</thead>
			<tbody>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'group', false, 'key');
$_smarty_tpl->tpl_vars['group']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->do_else = false;
?>
				<tr>
					<td>
						<?php $_smarty_tpl->_assignInScope('id_checkbox', (($_smarty_tpl->tpl_vars['input']->value['name']).('_')).($_smarty_tpl->tpl_vars['group']->value['id_group']));?>
						<input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['input']->value['name'];?>
[]" class="groupBox" id="<?php echo $_smarty_tpl->tpl_vars['id_checkbox']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['group']->value['id_group'];?>
" <?php if ($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['id_checkbox']->value]) {?>checked="checked"<?php }?> />
					</td>
					<td><?php echo $_smarty_tpl->tpl_vars['group']->value['id_group'];?>
</td>
					<td>
						<label for="<?php echo $_smarty_tpl->tpl_vars['id_checkbox']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['group']->value['name'];?>
</label>
					</td>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</tbody>
		</table>
	</div>
</div>
<?php } else { ?>
<p>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No group created'),$_smarty_tpl ) );?>

</p>
<?php }
}
}
