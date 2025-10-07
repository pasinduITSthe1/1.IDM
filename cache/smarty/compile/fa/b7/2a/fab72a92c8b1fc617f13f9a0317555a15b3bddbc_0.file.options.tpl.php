<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:14
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\geolocation\helpers\options\options.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2820e2963_69154776',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fab72a92c8b1fc617f13f9a0317555a15b3bddbc' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\geolocation\\helpers\\options\\options.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2820e2963_69154776 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_162477156968e4f2820323f3_11140915', "field");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_25321763668e4f282092a14_62185983', "input");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/options/options.tpl");
}
/* {block "field"} */
class Block_162477156968e4f2820323f3_11140915 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'field' => 
  array (
    0 => 'Block_162477156968e4f2820323f3_11140915',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ($_smarty_tpl->tpl_vars['field']->value['type'] == 'checkbox_table') {?>
				<div class="well margin-form" style="height: 300px; overflow-y: auto;">
			<table class="table" style="border-spacing : 0; border-collapse : collapse;">
				<thead>
					<tr>
						<th><input type="checkbox" name="checkAll" onclick="checkDelBoxes(this.form, 'countries[]', this.checked)" /></th>
						<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</th>
					</tr>
				</thead>
				<tbody>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['field']->value['list'], 'country');
$_smarty_tpl->tpl_vars['country']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['country']->value) {
$_smarty_tpl->tpl_vars['country']->do_else = false;
?>
						<tr>
							<td><input type="checkbox" name="countries[]" value="<?php echo $_smarty_tpl->tpl_vars['country']->value[$_smarty_tpl->tpl_vars['field']->value['identifier']];?>
" <?php if (in_array(strtoupper($_smarty_tpl->tpl_vars['country']->value['iso_code']),$_smarty_tpl->tpl_vars['allowed_countries']->value)) {?>checked="checked"<?php }?> /></td>
							<td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['country']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
						</tr>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</tbody>
			</table>
		</div>
	<?php } else { ?>
		<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

	<?php }
}
}
/* {/block "field"} */
/* {block "input"} */
class Block_25321763668e4f282092a14_62185983 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input' => 
  array (
    0 => 'Block_25321763668e4f282092a14_62185983',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>

	<?php if ($_smarty_tpl->tpl_vars['field']->value['type'] == 'textarea_newlines') {?>
		<div class="col-lg-9">
			<textarea name=<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
 cols="<?php echo $_smarty_tpl->tpl_vars['field']->value['cols'];?>
" rows="<?php echo $_smarty_tpl->tpl_vars['field']->value['rows'];?>
"><?php echo htmlspecialchars((string)smarty_modifier_replace($_smarty_tpl->tpl_vars['field']->value['value'],';',"\n"), ENT_QUOTES, 'UTF-8', true);?>
</textarea>
		</div>
	<?php } else { ?>
		<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

	<?php }
}
}
/* {/block "input"} */
}
