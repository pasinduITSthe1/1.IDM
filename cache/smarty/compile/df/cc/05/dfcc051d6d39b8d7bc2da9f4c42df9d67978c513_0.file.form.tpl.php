<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:43
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\stores\helpers\form\form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29fc64b58_28882830',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dfcc051d6d39b8d7bc2da9f4c42df9d67978c513' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\stores\\helpers\\form\\form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29fc64b58_28882830 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18788646068e4f29fbeee09_13072545', 'script');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_65128105268e4f29fbf6454_81918571', "input");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_185696748868e4f29fc3dbf5_42589823', "other_input");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/form/form.tpl");
}
/* {block 'script'} */
class Block_18788646068e4f29fbeee09_13072545 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_18788646068e4f29fbeee09_13072545',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	$(document).ready(function() {
		$('#latitude, #longitude').keyup(function() {
			$(this).val($(this).val().replace(/,/g, '.'));
		});
	});
<?php
}
}
/* {/block 'script'} */
/* {block "input"} */
class Block_65128105268e4f29fbf6454_81918571 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input' => 
  array (
    0 => 'Block_65128105268e4f29fbf6454_81918571',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ($_smarty_tpl->tpl_vars['input']->value['type'] == 'latitude') {?>
	<div class="row">
		<div class="col-lg-3">
			<input type="text"
				<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['size']))) {?>size="<?php echo $_smarty_tpl->tpl_vars['input']->value['size'];?>
"<?php }?>
				<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['maxlength']))) {?>maxlength="<?php echo $_smarty_tpl->tpl_vars['input']->value['maxlength'];?>
"<?php }?>
				name="latitude"
				id="latitude"
				value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']], ENT_QUOTES, 'UTF-8', true);?>
" />
		</div>
		<div class="col-lg-1">
			<div class="form-control-static text-center"> / </div>
		</div>
		<div class="col-lg-3">
			<input type="text"
				<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['size']))) {?>size="<?php echo $_smarty_tpl->tpl_vars['input']->value['size'];?>
"<?php }?>
				<?php if ((isset($_smarty_tpl->tpl_vars['input']->value['maxlength']))) {?>maxlength="<?php echo $_smarty_tpl->tpl_vars['input']->value['maxlength'];?>
"<?php }?>
				name="longitude"
				id="longitude"
				value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['fields_value']->value['longitude'], ENT_QUOTES, 'UTF-8', true);?>
" />
		</div>
	</div>
	<?php } else { ?>
		<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

	<?php }
}
}
/* {/block "input"} */
/* {block "other_input"} */
class Block_185696748868e4f29fc3dbf5_42589823 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'other_input' => 
  array (
    0 => 'Block_185696748868e4f29fc3dbf5_42589823',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ($_smarty_tpl->tpl_vars['key']->value == 'hours') {?>
			<div class="form-group">
				<label class="control-label col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hours:'),$_smarty_tpl ) );?>
</label>
				<div class="col-lg-9"><p class="form-control-static"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'e.g. 10:00AM - 9:30PM'),$_smarty_tpl ) );?>
</p></div>
			</div>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fields_value']->value['days'], 'value', false, 'k');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
			<div class="form-group">
				<label class="control-label col-lg-3"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</label>
				<div class="col-lg-9"><input type="text" size="25" name="hours_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" value="<?php if ((isset($_smarty_tpl->tpl_vars['fields_value']->value['hours'][$_smarty_tpl->tpl_vars['k']->value-1]))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['fields_value']->value['hours'][$_smarty_tpl->tpl_vars['k']->value-1], ENT_QUOTES, 'UTF-8', true);
}?>" /></div>
			</div>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php }
}
}
/* {/block "other_input"} */
}
