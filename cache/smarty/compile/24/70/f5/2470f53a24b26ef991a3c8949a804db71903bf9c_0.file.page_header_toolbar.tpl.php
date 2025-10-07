<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:19
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\modules\page_header_toolbar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2871febb5_81651083',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2470f53a24b26ef991a3c8949a804db71903bf9c' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\modules\\page_header_toolbar.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2871febb5_81651083 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_174103992868e4f2870c6ca4_90734631', 'pageTitle');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_99370411068e4f2870d54b3_44560470', 'toolbarBox');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "page_header_toolbar.tpl");
}
/* {block 'pageTitle'} */
class Block_174103992868e4f2870c6ca4_90734631 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'pageTitle' => 
  array (
    0 => 'Block_174103992868e4f2870c6ca4_90734631',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<h2 class="page-title">
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'List of modules'),$_smarty_tpl ) );?>

</h2>
<?php
}
}
/* {/block 'pageTitle'} */
/* {block 'toolbarBox'} */
class Block_99370411068e4f2870d54b3_44560470 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'toolbarBox' => 
  array (
    0 => 'Block_99370411068e4f2870d54b3_44560470',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<div class="page-bar toolbarBox">
	<div class="btn-toolbar">
		<ul class="nav nav-pills pull-right">
			<?php if ((isset($_smarty_tpl->tpl_vars['upgrade_available']->value)) && smarty_modifier_count($_smarty_tpl->tpl_vars['upgrade_available']->value)) {?>
				<?php $_smarty_tpl->_assignInScope('modules', '');?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['upgrade_available']->value, 'module');
$_smarty_tpl->tpl_vars['module']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->do_else = false;
?>
					<?php $_smarty_tpl->_assignInScope('modules', ($_smarty_tpl->tpl_vars['modules']->value).($_smarty_tpl->tpl_vars['module']->value['name']).('|'));?>
					<?php if ($_smarty_tpl->tpl_vars['module']->value['is_native']) {?>
						<?php $_smarty_tpl->_assignInScope('native_upgade', true);?>
					<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<?php $_smarty_tpl->_assignInScope('modules', substr((string) $_smarty_tpl->tpl_vars['modules']->value, (int) 0, (int) -1));?>
				<?php if ((isset($_smarty_tpl->tpl_vars['native_upgade']->value)) && $_smarty_tpl->tpl_vars['native_upgade']->value) {?>
					<li>
						<a id="desc-module-update-all" class="toolbar_btn" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['currentIndex']->value, ENT_QUOTES, 'UTF-8', true);?>
&amp;token=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['token']->value, ENT_QUOTES, 'UTF-8', true);?>
&amp;updateAll=1" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Update all'),$_smarty_tpl ) );?>
">
							<i class="process-icon-refresh"></i>
							<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Update all'),$_smarty_tpl ) );?>
</span>
						</a>
					</li>
				<?php }?>
			<?php } else { ?>
				<li>
					<a id="desc-module-check-and-update-all" class="toolbar_btn" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['currentIndex']->value, ENT_QUOTES, 'UTF-8', true);?>
&amp;token=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['token']->value, ENT_QUOTES, 'UTF-8', true);?>
&amp;check=1" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check for update'),$_smarty_tpl ) );?>
">
						<i class="process-icon-refresh"></i>
						<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check for update'),$_smarty_tpl ) );?>
</span>
					</a>
				</li>
			<?php }?>
			<li>
				<a id="desc-module-catalog" class="toolbar_btn anchor" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminModulesCatalog');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Recommended Modules and Services'),$_smarty_tpl ) );?>
">
					<i class="process-icon-modules-list"></i>
					<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Recommendations'),$_smarty_tpl ) );?>
</span>
				</a>
			</li>
			<?php if ($_smarty_tpl->tpl_vars['add_permission']->value == '1') {?>
				<?php if ($_smarty_tpl->tpl_vars['context_mode']->value != Context::MODE_HOST) {?>
					<li>
						<a id="desc-module-new" class="toolbar_btn anchor" href="#" onclick="$('#module_install').slideToggle();" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add a new module'),$_smarty_tpl ) );?>
">
							<i class="process-icon-new"></i>
							<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add a new module'),$_smarty_tpl ) );?>
</span>
						</a>
					</li>
				<?php } else { ?>
					<li>
						<a id="desc-module-new" class="toolbar_btn" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminModules');?>
&addnewmodule" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add a new module'),$_smarty_tpl ) );?>
">
							<i class="process-icon-new"></i>
							<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add a new module'),$_smarty_tpl ) );?>
</span>
						</a>
					</li>
				<?php }?>
			<?php }?>
			<?php if ((isset($_smarty_tpl->tpl_vars['help_link']->value))) {?>
						<?php }?>
		</ul>
	</div>
</div>
<?php
}
}
/* {/block 'toolbarBox'} */
}
