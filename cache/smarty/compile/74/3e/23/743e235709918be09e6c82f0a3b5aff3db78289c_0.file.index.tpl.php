<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:09
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27d6ad0d7_91641048',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '743e235709918be09e6c82f0a3b5aff3db78289c' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\index.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27d6ad0d7_91641048 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_100273293668e4f27d652927_92959492', 'displayHomeTabContent');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_88198080268e4f27d6991e3_52605632', 'displayHome');
?>

<?php }
/* {block 'displayHomeTab'} */
class Block_73429760568e4f27d6661e8_32756011 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php if ((isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)) && trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)) {?>
				<ul id="home-page-tabs" class="nav nav-tabs clearfix">
					<?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value;?>

				</ul>
			<?php }?>
		<?php
}
}
/* {/block 'displayHomeTab'} */
/* {block 'displayHomeTabContent'} */
class Block_100273293668e4f27d652927_92959492 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayHomeTabContent' => 
  array (
    0 => 'Block_100273293668e4f27d652927_92959492',
  ),
  'displayHomeTab' => 
  array (
    0 => 'Block_73429760568e4f27d6661e8_32756011',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ((isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)) && trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)) {?>
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_73429760568e4f27d6661e8_32756011', 'displayHomeTab', $this->tplIndex);
?>

		<div class="tab-content"><?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value;?>
</div>
	<?php }
}
}
/* {/block 'displayHomeTabContent'} */
/* {block 'displayHome'} */
class Block_88198080268e4f27d6991e3_52605632 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayHome' => 
  array (
    0 => 'Block_88198080268e4f27d6991e3_52605632',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ((isset($_smarty_tpl->tpl_vars['HOOK_HOME']->value)) && trim($_smarty_tpl->tpl_vars['HOOK_HOME']->value)) {?>
		<div class="clearfix"><?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>
</div>
	<?php }
}
}
/* {/block 'displayHome'} */
}
