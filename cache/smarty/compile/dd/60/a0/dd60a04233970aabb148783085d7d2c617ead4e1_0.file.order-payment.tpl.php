<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:22
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\order-payment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f28a1c8557_30139389',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dd60a04233970aabb148783085d7d2c617ead4e1' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\order-payment.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f28a1c8557_30139389 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
	<?php $_block_plugin127 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin127, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtProduct'));
$_block_repeat=true;
echo $_block_plugin127->addJsDefL(array('name'=>'txtProduct'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'product','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin127->addJsDefL(array('name'=>'txtProduct'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php $_block_plugin128 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin128, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtProducts'));
$_block_repeat=true;
echo $_block_plugin128->addJsDefL(array('name'=>'txtProducts'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'products','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin128->addJsDefL(array('name'=>'txtProducts'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your payment method'),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<h1 class="page-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please choose your payment method'),$_smarty_tpl ) );?>

		<?php if (!(isset($_smarty_tpl->tpl_vars['empty']->value)) && !$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
			<span class="heading-counter"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your shopping cart contains:'),$_smarty_tpl ) );?>

				<span id="summary_products_quantity"><?php echo $_smarty_tpl->tpl_vars['productNumber']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['productNumber']->value == 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'product'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'products'),$_smarty_tpl ) );
}?></span>
			</span>
		<?php }?>
	</h1>
<?php }?>

<?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
	<?php $_smarty_tpl->_assignInScope('current_step', 'payment');?>
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_213151036768e4f28a17a396_15215749', 'order_steps');
?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_67159328568e4f28a18d968_26864487', 'errors');
?>

<?php } else { ?>
	<div id="opc_payment_methods" class="opc-main-block">
		<div id="opc_payment_methods-overlay" class="opc-overlay" style="display: none;"></div>
<?php }
if ($_smarty_tpl->tpl_vars['advanced_payment_api']->value) {?>
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16536862768e4f28a1ade20_69735755', 'order_payment_advanced');
?>

<?php } else { ?>
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_149614556168e4f28a1b5f48_93805862', 'order_payment_classic');
?>

<?php }
}
/* {block 'order_steps'} */
class Block_213151036768e4f28a17a396_15215749 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_steps' => 
  array (
    0 => 'Block_213151036768e4f28a17a396_15215749',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-steps.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php
}
}
/* {/block 'order_steps'} */
/* {block 'errors'} */
class Block_67159328568e4f28a18d968_26864487 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'errors' => 
  array (
    0 => 'Block_67159328568e4f28a18d968_26864487',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php
}
}
/* {/block 'errors'} */
/* {block 'order_payment_advanced'} */
class Block_16536862768e4f28a1ade20_69735755 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_payment_advanced' => 
  array (
    0 => 'Block_16536862768e4f28a1ade20_69735755',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-payment-advanced.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php
}
}
/* {/block 'order_payment_advanced'} */
/* {block 'order_payment_classic'} */
class Block_149614556168e4f28a1b5f48_93805862 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_payment_classic' => 
  array (
    0 => 'Block_149614556168e4f28a1b5f48_93805862',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-payment-classic.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php
}
}
/* {/block 'order_payment_classic'} */
}
