<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:44
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\supply_orders_change_state\helpers\form\form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a05649e4_50865171',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bb639e202328d5e3217e7ccbc9718e31c9f58828' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\supply_orders_change_state\\helpers\\form\\form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a05649e4_50865171 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_100663581468e4f2a04f80e4_41125082', "other_input");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_164445944968e4f2a0546318_42889188', "other_fieldsets");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/form/form.tpl");
}
/* {block "other_input"} */
class Block_100663581468e4f2a04f80e4_41125082 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'other_input' => 
  array (
    0 => 'Block_100663581468e4f2a04f80e4_41125082',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.regex_replace.php','function'=>'smarty_modifier_regex_replace',),));
?>


<?php if ((isset($_smarty_tpl->tpl_vars['supply_order']->value)) && $_smarty_tpl->tpl_vars['supply_order']->value->id > 0 && (isset($_smarty_tpl->tpl_vars['supply_order_states']->value)) && !(isset($_smarty_tpl->tpl_vars['printed']->value))) {
$_smarty_tpl->_assignInScope('printed', 1);
echo '<script'; ?>
>
$(document).ready(function() {
	$('#id_supply_order_state option').each(function () {
		
		if ($(this).attr('disabled') == false)
			$(this).attr('selected', true);
		
		return ($(this).attr('disabled') == true);
		
	});
});
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_assignInScope('order_state', smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['supply_order_state']->value->name[$_smarty_tpl->tpl_vars['employee']->value->id_lang],"/[^A-Za-z_ \t]/",''));?>
<div class="alert alert-warning"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>sprintf('Current order status: %s',$_smarty_tpl->tpl_vars['order_state']->value)),$_smarty_tpl ) );?>
</strong></div>
<div class="alert alert-info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Choose the new status for your order'),$_smarty_tpl ) );?>
</div>
<div class="form-horizontal">
	<input type="hidden" name="id_supply_order" id="id_supply_order" value="<?php echo $_smarty_tpl->tpl_vars['supply_order']->value->id;?>
">
	<div class="form-group">
		<label class="control-label col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status of the order:'),$_smarty_tpl ) );?>
</label>						
		<div class="col-lg-9">
			<select name="id_supply_order_state" id="id_supply_order_state">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['supply_order_states']->value, 'state');
$_smarty_tpl->tpl_vars['state']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->do_else = false;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['state']->value['id_supply_order_state'];?>
" <?php if ($_smarty_tpl->tpl_vars['state']->value['allowed'] == 0) {?> disabled="disabled" <?php }?>><?php echo $_smarty_tpl->tpl_vars['state']->value['name'];?>
</option>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</select>
		</div>
	</div>
</div>
<div class="margin-form">
<input type="submit" id="<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
_form_submit_btn" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save'),$_smarty_tpl ) );?>
" name="submitChangestate" class="button" style="display: none;">
</div>
<?php }
}
}
/* {/block "other_input"} */
/* {block "other_fieldsets"} */
class Block_164445944968e4f2a0546318_42889188 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'other_fieldsets' => 
  array (
    0 => 'Block_164445944968e4f2a0546318_42889188',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
							
<?php if ((isset($_smarty_tpl->tpl_vars['supply_order_state']->value)) && $_smarty_tpl->tpl_vars['supply_order_state']->value->editable == false && (isset($_smarty_tpl->tpl_vars['supply_order']->value))) {?>
<div class="panel">
	<h3><i class="icon-download-alt"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Print the supply order form'),$_smarty_tpl ) );?>
</h3>
	<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminPdf'), ENT_QUOTES, 'UTF-8', true);?>
&amp;submitAction=generateSupplyOrderFormPDF&amp;id_supply_order=<?php echo intval($_smarty_tpl->tpl_vars['supply_order']->value->id);?>
" onclick="return !window.open(this.href);" title="Export as PDF" class="btn btn-default"><i class="icon-download-alt"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click here to download the supply order form.'),$_smarty_tpl ) );?>
.</a>
</div>
<?php }?>

<?php
}
}
/* {/block "other_fieldsets"} */
}
