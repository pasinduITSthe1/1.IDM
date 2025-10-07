<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:09
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\cart_rules\product_rule_group.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27d4281b0_48191406',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b9f7bec23014e567464ddcdd43b3db15f43dbb8' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\cart_rules\\product_rule_group.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27d4281b0_48191406 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<tr id="product_rule_group_<?php echo intval($_smarty_tpl->tpl_vars['product_rule_group_id']->value);?>
_tr">
	<td>
		<a class="btn btn-default" href="javascript:removeProductRuleGroup(<?php echo intval($_smarty_tpl->tpl_vars['product_rule_group_id']->value);?>
);">
			<i class="icon-remove text-danger"></i>
		</a>
	</td>
	<td>


		<div class="form-group">
			<label class="control-label col-lg-4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The cart must contain at least'),$_smarty_tpl ) );?>
</label>
			<div class="col-lg-1">
				<input type="hidden" name="product_rule_group[]" value="<?php echo intval($_smarty_tpl->tpl_vars['product_rule_group_id']->value);?>
" />
				<input class="form-control" type="text" name="product_rule_group_<?php echo intval($_smarty_tpl->tpl_vars['product_rule_group_id']->value);?>
_quantity" value="<?php echo intval($_smarty_tpl->tpl_vars['product_rule_group_quantity']->value);?>
" />
			</div>
			<div class="col-lg-7">
				<label  class="control-label pull-left"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room type(s) matching the following rules:'),$_smarty_tpl ) );?>
</label>
			</div>
		</div>



		<div class="form-group">

			<label class="control-label col-lg-4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add a rule concerning'),$_smarty_tpl ) );?>
</label>
			<div class="col-lg-4">
				<select class="form-control" id="product_rule_type_<?php echo intval($_smarty_tpl->tpl_vars['product_rule_group_id']->value);?>
">
					<option value=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'-- Choose --'),$_smarty_tpl ) );?>
</option>
					<option value="products"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room Types'),$_smarty_tpl ) );?>
</option>
									</select>
			</div>
			<div class="col-lg-4">
				<a class="btn btn-default" href="javascript:addProductRule(<?php echo intval($_smarty_tpl->tpl_vars['product_rule_group_id']->value);?>
);">
					<i class="icon-plus-sign"></i>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Add"),$_smarty_tpl ) );?>

				</a>
			</div>

		</div>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The Room Type(s) are matching one of these:'),$_smarty_tpl ) );?>

		<table id="product_rule_table_<?php echo intval($_smarty_tpl->tpl_vars['product_rule_group_id']->value);?>
" class="table table-bordered">
			<?php if ((isset($_smarty_tpl->tpl_vars['product_rules']->value)) && smarty_modifier_count($_smarty_tpl->tpl_vars['product_rules']->value)) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_rules']->value, 'product_rule');
$_smarty_tpl->tpl_vars['product_rule']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product_rule']->value) {
$_smarty_tpl->tpl_vars['product_rule']->do_else = false;
?>
					<?php echo $_smarty_tpl->tpl_vars['product_rule']->value;?>

				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php }?>
		</table>

	</td>
</tr>
<?php }
}
