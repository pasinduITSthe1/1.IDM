<?php
/* Smarty version 4.5.5, created on 2025-10-07 16:33:11
  from 'C:\wamp64\www\1.IDM\modules\blocknavigationmenu\views\templates\hook\navigationMenuBlock.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f36f2ed376_53126085',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ce30cc4a04b09999f020607f1660ef0881bb5bd9' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\blocknavigationmenu\\views\\templates\\hook\\navigationMenuBlock.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f36f2ed376_53126085 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_102601960268e4f36f2bc456_22368546', 'navigation_menu');
?>

<?php }
/* {block 'displayDefaultNavigationHook'} */
class Block_79218969668e4f36f2db582_49256113 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayDefaultNavigationHook"),$_smarty_tpl ) );?>

						<?php
}
}
/* {/block 'displayDefaultNavigationHook'} */
/* {block 'displayExternalNavigationHook'} */
class Block_157525667668e4f36f2e70a9_40851046 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayExternalNavigationHook"),$_smarty_tpl ) );?>

					<?php
}
}
/* {/block 'displayExternalNavigationHook'} */
/* {block 'navigation_menu'} */
class Block_102601960268e4f36f2bc456_22368546 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'navigation_menu' => 
  array (
    0 => 'Block_102601960268e4f36f2bc456_22368546',
  ),
  'displayDefaultNavigationHook' => 
  array (
    0 => 'Block_79218969668e4f36f2db582_49256113',
  ),
  'displayExternalNavigationHook' => 
  array (
    0 => 'Block_157525667668e4f36f2e70a9_40851046',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div class="header-top-item">
		<button type="button" class="nav_toggle">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>

	<div id="menu_cont" class="menu_cont_right">
		<div class="row margin-lr-0">
			<div class="col-xs-12 col-sm-12">
				<div class="row margin-lr-0">
					<span class="pull-right close_navbar"><i class="icon-close"></i></span>
				</div>
				<div class="row">
					<ul class="nav nav-pills nav-stacked wk-nav-style">
						<?php if ((isset($_smarty_tpl->tpl_vars['navigation_links']->value)) && $_smarty_tpl->tpl_vars['navigation_links']->value) {?>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['navigation_links']->value, 'navigationLink');
$_smarty_tpl->tpl_vars['navigationLink']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['navigationLink']->value) {
$_smarty_tpl->tpl_vars['navigationLink']->do_else = false;
?>
								<li>
									<a class="navigation-link" href="<?php echo $_smarty_tpl->tpl_vars['navigationLink']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['navigationLink']->value['name'];?>
</a>
								</li>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php }?>
						<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_79218969668e4f36f2db582_49256113', 'displayDefaultNavigationHook', $this->tplIndex);
?>

					</ul>
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_157525667668e4f36f2e70a9_40851046', 'displayExternalNavigationHook', $this->tplIndex);
?>

				</div>
			</div>
		</div>
	</div>
<?php
}
}
/* {/block 'navigation_menu'} */
}
