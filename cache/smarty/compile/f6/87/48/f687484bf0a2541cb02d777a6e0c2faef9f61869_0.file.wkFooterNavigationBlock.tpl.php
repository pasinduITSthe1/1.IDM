<?php
/* Smarty version 4.5.5, created on 2025-10-07 16:33:14
  from 'C:\wamp64\www\1.IDM\modules\blocknavigationmenu\views\templates\hook\wkFooterNavigationBlock.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f372f2c616_10345109',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f687484bf0a2541cb02d777a6e0c2faef9f61869' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\blocknavigationmenu\\views\\templates\\hook\\wkFooterNavigationBlock.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f372f2c616_10345109 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_201200246868e4f372f15798_77333874', 'footer_navigation');
?>

<?php }
/* {block 'displayFooterExploreSectionHook'} */
class Block_6340865168e4f372f24934_88784399 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayFooterExploreSectionHook"),$_smarty_tpl ) );?>

						<?php
}
}
/* {/block 'displayFooterExploreSectionHook'} */
/* {block 'footer_navigation'} */
class Block_201200246868e4f372f15798_77333874 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer_navigation' => 
  array (
    0 => 'Block_201200246868e4f372f15798_77333874',
  ),
  'displayFooterExploreSectionHook' => 
  array (
    0 => 'Block_6340865168e4f372f24934_88784399',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ((isset($_smarty_tpl->tpl_vars['navigation_links']->value)) && $_smarty_tpl->tpl_vars['navigation_links']->value) {?>
		<div class="col-sm-3">
			<div class="row">
				<section class="col-xs-12 col-sm-12">
					<div class="row margin-lr-0 footer-section-heading">
						<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Explore','mod'=>'blocknavigationmenu'),$_smarty_tpl ) );?>
</p>
						<hr/>
					</div>
					<div class="row margin-lr-0">
						<ul class="footer-navigation-section">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['navigation_links']->value, 'navigationLink');
$_smarty_tpl->tpl_vars['navigationLink']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['navigationLink']->value) {
$_smarty_tpl->tpl_vars['navigationLink']->do_else = false;
?>
							<li class="item">
								<a title="<?php echo $_smarty_tpl->tpl_vars['navigationLink']->value['name'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['navigationLink']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['navigationLink']->value['name'];?>
</a>
							</li>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6340865168e4f372f24934_88784399', 'displayFooterExploreSectionHook', $this->tplIndex);
?>

						</ul>
					</div>
				</section>
			</div>
		</div>
	<?php }
}
}
/* {/block 'footer_navigation'} */
}
