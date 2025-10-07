<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:19
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\modules\tab_modules_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2874dcd22_91196086',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '850ebe51c319d0f236aa77a5b75f966600c8c6ef' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\modules\\tab_modules_list.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:controllers/modules/tab_module_line.tpl' => 2,
  ),
),false)) {
function content_68e4f2874dcd22_91196086 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\function.cycle.php','function'=>'smarty_function_cycle',),));
?>

<?php if ((isset($_smarty_tpl->tpl_vars['tab_modules_list']->value)) && !empty($_smarty_tpl->tpl_vars['tab_modules_list']->value)) {?>
	<table id="tab_modules_list_not_installed" class="table">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tab_modules_list']->value['not_installed'], 'module');
$_smarty_tpl->tpl_vars['module']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->do_else = false;
?>
			<?php ob_start();
echo smarty_function_cycle(array('values'=>",rowalt"),$_smarty_tpl);
$_prefixVariable7 = ob_get_clean();
$_smarty_tpl->_subTemplateRender('file:controllers/modules/tab_module_line.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('class_row'=>$_prefixVariable7), 0, true);
?>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</table>
	<table id="tab_modules_list_installed" class="table">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tab_modules_list']->value['installed'], 'module');
$_smarty_tpl->tpl_vars['module']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->do_else = false;
?>
			<?php ob_start();
echo smarty_function_cycle(array('values'=>",rowalt"),$_smarty_tpl);
$_prefixVariable8 = ob_get_clean();
$_smarty_tpl->_subTemplateRender('file:controllers/modules/tab_module_line.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('class_row'=>$_prefixVariable8), 0, true);
?>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</table>
<?php }?>
<div class="alert alert-addons row-margin-top">
	<a href="https://qloapps.com/addons" onclick="return !window.open(this.href);"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'More modules on qloapps.com/addons/'),$_smarty_tpl ) );?>
</a>
</div>
<?php }
}
