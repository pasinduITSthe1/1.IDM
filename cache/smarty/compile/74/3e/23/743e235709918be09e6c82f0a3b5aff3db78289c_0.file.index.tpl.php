<?php
/* Smarty version 4.5.5, created on 2025-10-29 12:32:29
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6901bc051cd195_48007421',
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
function content_6901bc051cd195_48007421 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14457513596901bc051c0243_14393705', 'displayHomeTabContent');
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8660765836901bc051c5042_09801322', 'displayHome');
?>

<?php }
/* {block 'displayHomeTab'} */
class Block_4663111386901bc051c25b2_34781821 extends Smarty_Internal_Block
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
class Block_14457513596901bc051c0243_14393705 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayHomeTabContent' => 
  array (
    0 => 'Block_14457513596901bc051c0243_14393705',
  ),
  'displayHomeTab' => 
  array (
    0 => 'Block_4663111386901bc051c25b2_34781821',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ((isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)) && trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)) {?>
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4663111386901bc051c25b2_34781821', 'displayHomeTab', $this->tplIndex);
?>

		<div class="tab-content"><?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value;?>
</div>
	<?php }
}
}
/* {/block 'displayHomeTabContent'} */
/* {block 'displayHome'} */
class Block_8660765836901bc051c5042_09801322 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayHome' => 
  array (
    0 => 'Block_8660765836901bc051c5042_09801322',
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
