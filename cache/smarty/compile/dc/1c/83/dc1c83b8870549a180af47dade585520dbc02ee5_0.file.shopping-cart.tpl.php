<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:29
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\shopping-cart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29108a719_40793160',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dc1c83b8870549a180af47dade585520dbc02ee5' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\shopping-cart.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29108a719_40793160 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your shopping cart'),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>


<?php if ((isset($_smarty_tpl->tpl_vars['account_created']->value))) {?>
	<p class="alert alert-success">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your account has been created.'),$_smarty_tpl ) );?>

	</p>
<?php }?>

<?php $_smarty_tpl->_assignInScope('current_step', 'summary');
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_139663935168e4f290f19448_10761629', 'errors');
?>


<?php if ((isset($_smarty_tpl->tpl_vars['empty']->value))) {?>
	<p class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your shopping cart is empty.'),$_smarty_tpl ) );?>
</p>
<?php } elseif ($_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
	<p class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This store has not accepted your new order.'),$_smarty_tpl ) );?>
</p>
<?php } else { ?>
	<p id="emptyCartWarning" class="alert alert-warning unvisible"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your shopping cart is empty.'),$_smarty_tpl ) );?>
</p>
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_198794735668e4f290f410f3_70409405', 'displayBeforeShoppingCartBlock');
?>


	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_143314926968e4f2910113b6_26881590', 'shopping_cart_detail');
?>


	<?php if ($_smarty_tpl->tpl_vars['show_option_allow_separate_package']->value) {?>
	<p>
		<label for="allow_seperated_package" class="checkbox inline">
			<input type="checkbox" name="allow_seperated_package" id="allow_seperated_package" <?php if ($_smarty_tpl->tpl_vars['cart']->value->allow_seperated_package) {?>checked="checked"<?php }?> autocomplete="off"/>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send available products first'),$_smarty_tpl ) );?>

		</label>
	</p>
	<?php }?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_46853746468e4f2910349d5_50059678', 'displayShoppingCartFooter');
?>


	<div class="clear"></div>
	<div class="cart_navigation_extra">
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_170666470168e4f291041175_39791419', 'displayShoppingCart');
?>

	</div>
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_116701519868e4f29104df91_54743105', 'shopping_cart_js_vars');
?>

<?php }?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_109994590668e4f29107da76_69091909', 'shopping_cart_extra_services');
?>

<?php }
/* {block 'errors'} */
class Block_139663935168e4f290f19448_10761629 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'errors' => 
  array (
    0 => 'Block_139663935168e4f290f19448_10761629',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-steps.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
/* {/block 'errors'} */
/* {block 'displayBeforeShoppingCartBlock'} */
class Block_198794735668e4f290f410f3_70409405 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayBeforeShoppingCartBlock' => 
  array (
    0 => 'Block_198794735668e4f290f410f3_70409405',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayBeforeShoppingCartBlock"),$_smarty_tpl ) );?>

	<?php
}
}
/* {/block 'displayBeforeShoppingCartBlock'} */
/* {block 'shopping_cart_detail'} */
class Block_143314926968e4f2910113b6_26881590 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'shopping_cart_detail' => 
  array (
    0 => 'Block_143314926968e4f2910113b6_26881590',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./shopping-cart-detail.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php
}
}
/* {/block 'shopping_cart_detail'} */
/* {block 'displayShoppingCartFooter'} */
class Block_46853746468e4f2910349d5_50059678 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayShoppingCartFooter' => 
  array (
    0 => 'Block_46853746468e4f2910349d5_50059678',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<div id="HOOK_SHOPPING_CART"><?php echo $_smarty_tpl->tpl_vars['HOOK_SHOPPING_CART']->value;?>
</div>
	<?php
}
}
/* {/block 'displayShoppingCartFooter'} */
/* {block 'displayShoppingCart'} */
class Block_170666470168e4f291041175_39791419 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayShoppingCart' => 
  array (
    0 => 'Block_170666470168e4f291041175_39791419',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<div id="HOOK_SHOPPING_CART_EXTRA"><?php if ((isset($_smarty_tpl->tpl_vars['HOOK_SHOPPING_CART_EXTRA']->value))) {
echo $_smarty_tpl->tpl_vars['HOOK_SHOPPING_CART_EXTRA']->value;
}?></div>
		<?php
}
}
/* {/block 'displayShoppingCart'} */
/* {block 'shopping_cart_js_vars'} */
class Block_116701519868e4f29104df91_54743105 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'shopping_cart_js_vars' => 
  array (
    0 => 'Block_116701519868e4f29104df91_54743105',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('deliveryAddress'=>intval($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)),$_smarty_tpl ) );
$_block_plugin157 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin157, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtProduct'));
$_block_repeat=true;
echo $_block_plugin157->addJsDefL(array('name'=>'txtProduct'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'product','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin157->addJsDefL(array('name'=>'txtProduct'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin158 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin158, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtProducts'));
$_block_repeat=true;
echo $_block_plugin158->addJsDefL(array('name'=>'txtProducts'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'products','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin158->addJsDefL(array('name'=>'txtProducts'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php
}
}
/* {/block 'shopping_cart_js_vars'} */
/* {block 'shopping_cart_extra_services'} */
class Block_109994590668e4f29107da76_69091909 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'shopping_cart_extra_services' => 
  array (
    0 => 'Block_109994590668e4f29107da76_69091909',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div style="display:none;" id="rooms_extra_services">
	</div>
<?php
}
}
/* {/block 'shopping_cart_extra_services'} */
}
