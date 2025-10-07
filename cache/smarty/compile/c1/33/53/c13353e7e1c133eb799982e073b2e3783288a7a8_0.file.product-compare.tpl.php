<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:23
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\product-compare.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f28ba4a7e8_88265291',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c13353e7e1c133eb799982e073b2e3783288a7a8' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\product-compare.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f28ba4a7e8_88265291 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['comparator_max_item']->value) {?>
	<form method="post" action="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('products-comparison'), ENT_QUOTES, 'UTF-8', true);?>
" class="compare-form">
		<button type="submit" class="btn btn-default button button-medium bt_compare bt_compare<?php if ((isset($_smarty_tpl->tpl_vars['paginationId']->value))) {?>_<?php echo $_smarty_tpl->tpl_vars['paginationId']->value;
}?>" disabled="disabled">
			<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Compare'),$_smarty_tpl ) );?>
 (<strong class="total-compare-val"><?php echo count($_smarty_tpl->tpl_vars['compared_products']->value);?>
</strong>)<i class="icon-chevron-right right"></i></span>
		</button>
		<input type="hidden" name="compare_product_count" class="compare_product_count" value="<?php echo count($_smarty_tpl->tpl_vars['compared_products']->value);?>
" />
		<input type="hidden" name="compare_product_list" class="compare_product_list" value="" />
	</form>
	<?php if (!(isset($_smarty_tpl->tpl_vars['paginationId']->value)) || $_smarty_tpl->tpl_vars['paginationId']->value == '') {?>
		<?php $_block_plugin129 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin129, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'min_item'));
$_block_repeat=true;
echo $_block_plugin129->addJsDefL(array('name'=>'min_item'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please select at least one product','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin129->addJsDefL(array('name'=>'min_item'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin130 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin130, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'max_item'));
$_block_repeat=true;
echo $_block_plugin130->addJsDefL(array('name'=>'max_item'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You cannot add more than %d product(s) to the product comparison','sprintf'=>$_smarty_tpl->tpl_vars['comparator_max_item']->value,'js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin130->addJsDefL(array('name'=>'max_item'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('comparator_max_item'=>$_smarty_tpl->tpl_vars['comparator_max_item']->value),$_smarty_tpl ) );?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('comparedProductsIds'=>$_smarty_tpl->tpl_vars['compared_products']->value),$_smarty_tpl ) );?>

	<?php }
}
}
}
