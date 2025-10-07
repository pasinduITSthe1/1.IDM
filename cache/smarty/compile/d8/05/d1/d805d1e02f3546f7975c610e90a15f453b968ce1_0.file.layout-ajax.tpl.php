<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:52
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\layout-ajax.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a8a3d5c9_64751479',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd805d1e02f3546f7975c610e90a15f453b968ce1' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\layout-ajax.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a8a3d5c9_64751479 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
if ((isset($_smarty_tpl->tpl_vars['json']->value))) {?>
{<?php if ((isset($_smarty_tpl->tpl_vars['status']->value)) && is_string($_smarty_tpl->tpl_vars['status']->value) && trim($_smarty_tpl->tpl_vars['status']->value) != '') {
$_smarty_tpl->_assignInScope('hasresult', 'ok');?>"status" : "<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
"<?php }
if ((isset($_smarty_tpl->tpl_vars['confirmations']->value)) && smarty_modifier_count($_smarty_tpl->tpl_vars['confirmations']->value) > 0) {
if ($_smarty_tpl->tpl_vars['hasresult']->value == 'ok') {?>,<?php }
$_smarty_tpl->_assignInScope('hasresult', 'ok');?>"confirmations" : <?php echo $_smarty_tpl->tpl_vars['confirmations']->value;
}
if ((isset($_smarty_tpl->tpl_vars['informations']->value)) && smarty_modifier_count($_smarty_tpl->tpl_vars['informations']->value) > 0) {
if ($_smarty_tpl->tpl_vars['hasresult']->value == 'ok') {?>,<?php }
$_smarty_tpl->_assignInScope('hasresult', 'ok');?>"informations" : <?php echo $_smarty_tpl->tpl_vars['informations']->value;
}
if ((isset($_smarty_tpl->tpl_vars['errors']->value)) && smarty_modifier_count($_smarty_tpl->tpl_vars['errors']->value) > 0) {
if ($_smarty_tpl->tpl_vars['hasresult']->value == 'ok') {?>,<?php }
$_smarty_tpl->_assignInScope('hasresult', 'ok');?>"error" : <?php echo $_smarty_tpl->tpl_vars['errors']->value;
}
if ((isset($_smarty_tpl->tpl_vars['warnings']->value)) && smarty_modifier_count($_smarty_tpl->tpl_vars['warnings']->value) > 0) {
if ($_smarty_tpl->tpl_vars['hasresult']->value == 'ok') {?>,<?php }
$_smarty_tpl->_assignInScope('hasresult', 'ok');?>"warnings" : <?php echo $_smarty_tpl->tpl_vars['warnings']->value;
}
if ($_smarty_tpl->tpl_vars['hasresult']->value == 'ok') {?>,<?php }
$_smarty_tpl->_assignInScope('hasresult', 'ok');?>"content" : <?php echo $_smarty_tpl->tpl_vars['page']->value;?>
}
<?php } else { ?>
	<?php if ((isset($_smarty_tpl->tpl_vars['conf']->value))) {?>
		<div class="alert alert-success">
			<?php echo $_smarty_tpl->tpl_vars['conf']->value;?>

		</div>
	<?php }?>

	<?php if (count($_smarty_tpl->tpl_vars['errors']->value)) {?> 		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php if (count($_smarty_tpl->tpl_vars['errors']->value) == 1) {?>
				<?php echo $_smarty_tpl->tpl_vars['errors']->value[0];?>

			<?php } else { ?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d errors','sprintf'=>smarty_modifier_count($_smarty_tpl->tpl_vars['errors']->value)),$_smarty_tpl ) );?>

				<br/>
				<ul>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'error');
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
?>
						<li><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</li>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</ul>
			<?php }?>
		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['informations']->value)) && count($_smarty_tpl->tpl_vars['informations']->value) && $_smarty_tpl->tpl_vars['informations']->value) {?>
		<div class="alert alert-info" style="display:block;">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['informations']->value, 'info');
$_smarty_tpl->tpl_vars['info']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['info']->value) {
$_smarty_tpl->tpl_vars['info']->do_else = false;
?>
				<?php echo $_smarty_tpl->tpl_vars['info']->value;?>
<br/>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['confirmations']->value)) && count($_smarty_tpl->tpl_vars['confirmations']->value) && $_smarty_tpl->tpl_vars['confirmations']->value) {?>
		<div class="alert alert-success" style="display:block;">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['confirmations']->value, 'confirm');
$_smarty_tpl->tpl_vars['confirm']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['confirm']->value) {
$_smarty_tpl->tpl_vars['confirm']->do_else = false;
?>
				<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
<br />
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div>
	<?php }?>

	<?php if (count($_smarty_tpl->tpl_vars['warnings']->value)) {?>
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php if (count($_smarty_tpl->tpl_vars['warnings']->value) > 1) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There are %d warnings.','sprintf'=>count($_smarty_tpl->tpl_vars['warnings']->value)),$_smarty_tpl ) );?>

				<span style="margin-left:20px;" id="labelSeeMore">
					<a id="linkSeeMore" href="#" style="text-decoration:underline"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click here to see more'),$_smarty_tpl ) );?>
</a>
					<a id="linkHide" href="#" style="text-decoration:underline;display:none"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hide warning'),$_smarty_tpl ) );?>
</a>
				</span>
			<?php } else { ?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There is %d warning.','sprintf'=>count($_smarty_tpl->tpl_vars['warnings']->value)),$_smarty_tpl ) );?>

			<?php }?>
			<ul style="display:<?php if (count($_smarty_tpl->tpl_vars['warnings']->value) > 1) {?>none<?php } else { ?>block<?php }?>;" id="seeMore">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['warnings']->value, 'warning');
$_smarty_tpl->tpl_vars['warning']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['warning']->value) {
$_smarty_tpl->tpl_vars['warning']->do_else = false;
?>
				<li><?php echo $_smarty_tpl->tpl_vars['warning']->value;?>
</li>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</ul>
		</div>
	<?php }?>
	<?php echo $_smarty_tpl->tpl_vars['page']->value;?>

<?php }
}
}
