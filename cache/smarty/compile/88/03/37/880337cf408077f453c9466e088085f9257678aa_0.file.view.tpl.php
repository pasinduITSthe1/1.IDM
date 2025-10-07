<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:44
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\supply_orders\helpers\view\view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a0400dd1_01077790',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '880337cf408077f453c9466e088085f9257678aa' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\supply_orders\\helpers\\view\\view.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a0400dd1_01077790 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_121461156968e4f2a03b3585_49744309', "override_tpl");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/view/view.tpl");
}
/* {block "override_tpl"} */
class Block_121461156968e4f2a03b3585_49744309 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'override_tpl' => 
  array (
    0 => 'Block_121461156968e4f2a03b3585_49744309',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="row">
	<div class="col-lg-6">
		<div class="panel">
			<h3>
				<i class="icon-info"></i>
				<?php if ((isset($_smarty_tpl->tpl_vars['is_template']->value)) && $_smarty_tpl->tpl_vars['is_template']->value == 1) {?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Template'),$_smarty_tpl ) );?>
 <?php }
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'General information'),$_smarty_tpl ) );?>

			</h3>
			<table class="table">
				<tr>
					<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Creation date:'),$_smarty_tpl ) );?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_creation_date']->value;?>
</td>
				</tr>
				<tr>
					<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Supplier:'),$_smarty_tpl ) );?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_supplier_name']->value;?>
</td>
				</tr>
				<tr>
					<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last update:'),$_smarty_tpl ) );?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_last_update']->value;?>
</td>
				</tr>
				<tr>
					<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delivery expected:'),$_smarty_tpl ) );?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_expected']->value;?>
</td>
				</tr>
				<tr>
					<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Warehouse:'),$_smarty_tpl ) );?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_warehouse']->value;?>
</td>
				</tr>
				<tr>
					<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Currency:'),$_smarty_tpl ) );?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_currency']->value->name;?>
</td>
				</tr>
				<tr>
					<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Global discount rate:'),$_smarty_tpl ) );?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_discount_rate']->value;?>
 %</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel">
			<h3>
				<i class="icon-th-list"></i>
				<?php if ((isset($_smarty_tpl->tpl_vars['is_template']->value)) && $_smarty_tpl->tpl_vars['is_template']->value == 1) {?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Template'),$_smarty_tpl ) );?>
 <?php }
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Summary'),$_smarty_tpl ) );?>

			</h3>
			<table class="table">
				<thead>
					<tr>
						<th><span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Designation'),$_smarty_tpl ) );?>
</span></th>
						<th><span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Value'),$_smarty_tpl ) );?>
</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total (tax excl.)'),$_smarty_tpl ) );?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['supply_order_total_te']->value;?>
</td>
					</tr>
					<tr>
						<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Discount'),$_smarty_tpl ) );?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['supply_order_discount_value_te']->value;?>
</td>
					</tr>
					<tr>
						<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total with discount (tax excl.)'),$_smarty_tpl ) );?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['supply_order_total_with_discount_te']->value;?>
</td>
					</tr>
					<tr>
						<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Tax'),$_smarty_tpl ) );?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['supply_order_total_tax']->value;?>
</td>
					</tr>
					<tr>
						<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total (tax incl.)'),$_smarty_tpl ) );?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['supply_order_total_ti']->value;?>
</td>
					</tr>
					<tr>
						<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total to pay.'),$_smarty_tpl ) );?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['supply_order_total_ti']->value;?>
</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php echo $_smarty_tpl->tpl_vars['supply_order_detail_content']->value;?>

<?php
}
}
/* {/block "override_tpl"} */
}
