<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:43
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\stock_cover\helpers\list\list_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29fa16a08_58028481',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5e189f2a9191f4c8b83933554a2e1f7eb175b873' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\stock_cover\\helpers\\list\\list_header.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29fa16a08_58028481 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_67087621568e4f29f9cb5d7_96776458', 'override_header');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/list/list_header.tpl");
}
/* {block 'override_header'} */
class Block_67087621568e4f29f9cb5d7_96776458 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'override_header' => 
  array (
    0 => 'Block_67087621568e4f29f9cb5d7_96776458',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php if ((isset($_smarty_tpl->tpl_vars['show_filter']->value)) && $_smarty_tpl->tpl_vars['show_filter']->value) {?>
<div class="panel">
	<h3><i class="icon-cogs"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Filters'),$_smarty_tpl ) );?>
</h3>
	<div class="filter-stock-extended">
		<form id="stock_cover" method="get" class="form-horizontal">
			<input type="hidden" name="controller" value="AdminStockCover" />
			<input type="hidden" name="token" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['token']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
			<?php if (count($_smarty_tpl->tpl_vars['stock_cover_periods']->value) > 1) {?>
			<div class="form-group">
				<label for="coverage_period" class="control-label col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Filter by period:'),$_smarty_tpl ) );?>
</label>
				<div class="col-lg-9">
					<select id="coverage_period" name="coverage_period" onchange="$('#stock_cover').submit();">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['stock_cover_periods']->value, 'i', false, 'k');
$_smarty_tpl->tpl_vars['i']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->do_else = false;
?>
							<option <?php if ($_smarty_tpl->tpl_vars['i']->value == $_smarty_tpl->tpl_vars['stock_cover_cur_period']->value) {?> selected="selected"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</option>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</select>
				</div>
			</div>
			<?php }?>
			<?php if (count($_smarty_tpl->tpl_vars['stock_cover_warehouses']->value) > 0) {?>
			<div class="form-group">
				<label for="id_warehouse" class="control-label col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Filter by warehouse:'),$_smarty_tpl ) );?>
</label>
				<div class="col-lg-9">
					<select id="id_warehouse" name="id_warehouse" onchange="$('#stock_cover').submit();">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['stock_cover_warehouses']->value, 'i', false, 'k');
$_smarty_tpl->tpl_vars['i']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->do_else = false;
?>
							<option <?php if ($_smarty_tpl->tpl_vars['i']->value['id_warehouse'] == $_smarty_tpl->tpl_vars['stock_cover_cur_warehouse']->value) {?> selected="selected"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['i']->value['id_warehouse'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</option>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</select>
				</div>
			</div>
			<?php }?>
			<div class="form-group">
				<label for="warn_days" class="control-label col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Highlight when coverage (in days) is less than:'),$_smarty_tpl ) );?>
</label>
				<div class="col-lg-9">
					<input id="warn_days" name="warn_days" type="text" size="3" onchange="$('#stock_cover').submit();" value="<?php if ((isset($_smarty_tpl->tpl_vars['stock_cover_warn_days']->value))) {
echo $_smarty_tpl->tpl_vars['stock_cover_warn_days']->value;
}?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<?php }
}
}
/* {/block 'override_header'} */
}
