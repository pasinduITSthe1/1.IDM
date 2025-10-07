<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:46
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\error.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a243c386_03392312',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90e46d423332c8566bd9c81fed08802b020c89dd' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\error.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a243c386_03392312 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
if ((isset($_smarty_tpl->tpl_vars['php_errors']->value)) && smarty_modifier_count($_smarty_tpl->tpl_vars['php_errors']->value)) {?>
<div class="bootstrap">
	<div id="error-modal" class="modal fade">
		<div class="modal-dialog">
			<div class="alert alert-danger clearfix">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['php_errors']->value, 'php_error');
$_smarty_tpl->tpl_vars['php_error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['php_error']->value) {
$_smarty_tpl->tpl_vars['php_error']->do_else = false;
?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%1$s on line %2$s in file %3$s','sprintf'=>array(htmlspecialchars((string)$_smarty_tpl->tpl_vars['php_error']->value['type'], ENT_QUOTES, 'UTF-8', true),htmlspecialchars((string)$_smarty_tpl->tpl_vars['php_error']->value['errline'], ENT_QUOTES, 'UTF-8', true),htmlspecialchars((string)$_smarty_tpl->tpl_vars['php_error']->value['errfile'], ENT_QUOTES, 'UTF-8', true))),$_smarty_tpl ) );?>
<br />
					[<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['php_error']->value['errno'], ENT_QUOTES, 'UTF-8', true);?>
] <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['php_error']->value['errstr'], ENT_QUOTES, 'UTF-8', true);?>
<br /><br />
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i class="icon-remove"></i> Close</button>
			</div>
		</div>
	</div>
</div>
<?php }
}
}
