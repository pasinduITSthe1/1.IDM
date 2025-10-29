<?php
/* Smarty version 4.5.5, created on 2025-10-29 12:33:18
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\modules\blockcart\blockcart.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6901bc366c9541_71699227',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f18d5c5fe7e1934a7c3f6fdf004a13faaaee054' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\modules\\blockcart\\blockcart.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./cartrow.tpl' => 2,
  ),
),false)) {
function content_6901bc366c9541_71699227 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4416177806901bc36337c29_93515364', 'blockcart');
?>

<?php }
/* {block 'blockcart_shopping_cart_products'} */
class Block_418429956901bc363e92d7_94451154 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

										<?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
											<dl class="products">
												<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product', false, 'data_k', 'myLoop', array (
));
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data_k']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
																									<?php if ($_smarty_tpl->tpl_vars['product']->value['booking_product'] || ($_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_STANDALONE) || ($_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_HOTEL_STANDALONE) || ($_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_HOTEL_STANDALONE_AND_WITH_ROOM_TYPE)) {?>
														<?php if ($_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_HOTEL_STANDALONE || $_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_HOTEL_STANDALONE_AND_WITH_ROOM_TYPE) {?>
                                                            <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['hotel_wise_data'])) && $_smarty_tpl->tpl_vars['product']->value['hotel_wise_data']) {?>
                                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['hotel_wise_data'], 'hotel_wise_data');
$_smarty_tpl->tpl_vars['hotel_wise_data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['hotel_wise_data']->value) {
$_smarty_tpl->tpl_vars['hotel_wise_data']->do_else = false;
?>
                                                                    <?php $_smarty_tpl->_subTemplateRender("file:./cartrow.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('hotel_wise_data'=>$_smarty_tpl->tpl_vars['hotel_wise_data']->value), 0, true);
?>
                                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                            <?php }?>
														<?php } else { ?>
															<?php $_smarty_tpl->_subTemplateRender("file:./cartrow.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('hotel_wise_data'=>false), 0, true);
?>
														<?php }?>
													<?php }?>
												<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
											</dl>
										<?php }?>
									<?php
}
}
/* {/block 'blockcart_shopping_cart_products'} */
/* {block 'blockcart_shopping_cart_discounts'} */
class Block_7001590616901bc3644bda0_62094602 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

										<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['discounts']->value) > 0) {?>
											<table class="vouchers<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['discounts']->value) == 0) {?> unvisible<?php }?>">
												<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['discounts']->value, 'discount');
$_smarty_tpl->tpl_vars['discount']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['discount']->value) {
$_smarty_tpl->tpl_vars['discount']->do_else = false;
?>
													<?php if ($_smarty_tpl->tpl_vars['discount']->value['value_real'] > 0) {?>
														<tr class="bloc_cart_voucher" data-id="bloc_cart_voucher_<?php echo intval($_smarty_tpl->tpl_vars['discount']->value['id_discount']);?>
">
															<td class="quantity">1x</td>
															<td class="name" title="<?php echo $_smarty_tpl->tpl_vars['discount']->value['description'];?>
">
																<?php echo htmlspecialchars((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['discount']->value['name'],18,'...' )), ENT_QUOTES, 'UTF-8', true);?>

															</td>
															<td class="price">
																-<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_tax_exc']),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_real']),$_smarty_tpl ) );
}?>
															</td>
															<td class="delete">
																<?php if (strlen($_smarty_tpl->tpl_vars['discount']->value['code'])) {?>
																	<a class="delete_voucher" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink(((string)$_smarty_tpl->tpl_vars['order_process']->value),true);?>
?deleteDiscount=<?php echo intval($_smarty_tpl->tpl_vars['discount']->value['id_discount']);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete','mod'=>'blockcart'),$_smarty_tpl ) );?>
" rel="nofollow">
																		<i class="icon-remove-sign"></i>
																	</a>
																<?php }?>
															</td>
														</tr>
													<?php }?>
												<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
											</table>
										<?php }?>
									<?php
}
}
/* {/block 'blockcart_shopping_cart_discounts'} */
/* {block 'blockcart_shopping_cart_total_tax'} */
class Block_1542766846901bc364cd443_39902226 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

												<?php if ($_smarty_tpl->tpl_vars['show_tax']->value && $_smarty_tpl->tpl_vars['use_tax']->value) {?>
													<div class="cart-prices-line">
														<span class="price cart_block_tax_cost ajax_cart_tax_cost"><?php echo $_smarty_tpl->tpl_vars['tax_cost']->value;?>
</span>
														<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tax','mod'=>'blockcart'),$_smarty_tpl ) );?>
</span>
													</div>
												<?php }?>
											<?php
}
}
/* {/block 'blockcart_shopping_cart_total_tax'} */
/* {block 'blockcart_shopping_cart_total_convenience_fee'} */
class Block_16130010816901bc364d8b52_92789538 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

												<?php if ((isset($_smarty_tpl->tpl_vars['total_convenience_fee']->value))) {?>
													<div class="cart-prices-line">
														<span class="price cart_block_convenience_fee ajax_cart_convenience_fee"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['total_convenience_fee']->value),$_smarty_tpl ) );?>
</span>
														<span class="price"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Convenience Fees','mod'=>'blockcart'),$_smarty_tpl ) );?>
</strong>
													</div>
												<?php }?>
											<?php
}
}
/* {/block 'blockcart_shopping_cart_total_convenience_fee'} */
/* {block 'blockcart_shopping_cart_total'} */
class Block_2628085716901bc364e2f26_48584989 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

												<div class="cart-prices-line last-line">
													<span class="price cart_block_total ajax_block_cart_total" total_cart_price="<?php echo $_smarty_tpl->tpl_vars['totalToPay']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['total']->value;?>
</span>
													<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total','mod'=>'blockcart'),$_smarty_tpl ) );?>
</span>
												</div>
												<?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['display_tax_label']->value == 1 && $_smarty_tpl->tpl_vars['show_tax']->value) {?>
													<p>
													<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 0) {?>
														<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Prices are tax included','mod'=>'blockcart'),$_smarty_tpl ) );?>

													<?php } elseif ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
														<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Prices are tax excluded','mod'=>'blockcart'),$_smarty_tpl ) );?>

													<?php }?>
													</p>
												<?php }?>
											<?php
}
}
/* {/block 'blockcart_shopping_cart_total'} */
/* {block 'blockcart_shopping_cart_prices'} */
class Block_4099609636901bc3648d681_50882975 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

										<div class="cart-prices">
											<!-- <div class="cart-prices-line first-line">
												<span class="price cart_block_shipping_cost ajax_cart_shipping_cost<?php if (!($_smarty_tpl->tpl_vars['page_name']->value == 'order-opc') && $_smarty_tpl->tpl_vars['shipping_cost_float']->value == 0 && (!(isset($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) || !$_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) {?> unvisible<?php }?>">
													<?php if ($_smarty_tpl->tpl_vars['shipping_cost_float']->value == 0) {?>
														<?php if (!($_smarty_tpl->tpl_vars['page_name']->value == 'order-opc') && (!(isset($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) || !$_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To be determined','mod'=>'blockcart'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Free shipping!','mod'=>'blockcart'),$_smarty_tpl ) );
}?>
													<?php } else { ?>
														<?php echo $_smarty_tpl->tpl_vars['shipping_cost']->value;?>

													<?php }?>
												</span>
												<span<?php if (!($_smarty_tpl->tpl_vars['page_name']->value == 'order-opc') && $_smarty_tpl->tpl_vars['shipping_cost_float']->value == 0 && (!(isset($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) || !$_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) {?> class="unvisible"<?php }?>>
													<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shipping','mod'=>'blockcart'),$_smarty_tpl ) );?>

												</span>
											</div>
											<?php if ($_smarty_tpl->tpl_vars['show_wrapping']->value) {?>
												<div class="cart-prices-line">
													<?php $_smarty_tpl->_assignInScope('cart_flag', constant('Cart::ONLY_WRAPPING'));?>
													<span class="price cart_block_wrapping_cost">
														<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
															<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false,$_smarty_tpl->tpl_vars['cart_flag']->value)),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(true,$_smarty_tpl->tpl_vars['cart_flag']->value)),$_smarty_tpl ) );?>

														<?php }?>
													</span>
													<span>
														<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Wrapping','mod'=>'blockcart'),$_smarty_tpl ) );?>

													</span>
											</div>
											<?php }?> --><!-- commented by webkul unnecessary data -->
											<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1542766846901bc364cd443_39902226', 'blockcart_shopping_cart_total_tax', $this->tplIndex);
?>

											<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16130010816901bc364d8b52_92789538', 'blockcart_shopping_cart_total_convenience_fee', $this->tplIndex);
?>

											<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2628085716901bc364e2f26_48584989', 'blockcart_shopping_cart_total', $this->tplIndex);
?>

										</div>
									<?php
}
}
/* {/block 'blockcart_shopping_cart_prices'} */
/* {block 'blockcart_shopping_cart_checkout_action'} */
class Block_1242127476901bc364fa5c7_95638427 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

										<p class="cart-buttons">
											<a id="button_order_cart" class="btn btn-default button button-small" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink(((string)$_smarty_tpl->tpl_vars['order_process']->value),true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check out','mod'=>'blockcart'),$_smarty_tpl ) );?>
" rel="nofollow">
												<span>
													<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check out','mod'=>'blockcart'),$_smarty_tpl ) );?>
<i class="icon-chevron-right right"></i>
												</span>
											</a>
										</p>
									<?php
}
}
/* {/block 'blockcart_shopping_cart_checkout_action'} */
/* {block 'blockcart_shopping_cart_content'} */
class Block_11163326896901bc363d84a3_95436608 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
						<div class="cart_block block exclusive">
							<div class="block_content">
								<!-- block list of products -->
								<div class="cart_block_list<?php if ((isset($_smarty_tpl->tpl_vars['blockcart_top']->value)) && !$_smarty_tpl->tpl_vars['blockcart_top']->value) {
if ((isset($_smarty_tpl->tpl_vars['colapseExpandStatus']->value)) && $_smarty_tpl->tpl_vars['colapseExpandStatus']->value == 'expanded' || !$_smarty_tpl->tpl_vars['ajax_allowed']->value || !(isset($_smarty_tpl->tpl_vars['colapseExpandStatus']->value))) {?> expanded<?php } else { ?> collapsed unvisible<?php }
}?>">
									<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_418429956901bc363e92d7_94451154', 'blockcart_shopping_cart_products', $this->tplIndex);
?>

									<p class="cart_block_no_products<?php if ($_smarty_tpl->tpl_vars['products']->value) {?> unvisible<?php }?>">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No products','mod'=>'blockcart'),$_smarty_tpl ) );?>

									</p>
									<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7001590616901bc3644bda0_62094602', 'blockcart_shopping_cart_discounts', $this->tplIndex);
?>

									<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4099609636901bc3648d681_50882975', 'blockcart_shopping_cart_prices', $this->tplIndex);
?>

									<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1242127476901bc364fa5c7_95638427', 'blockcart_shopping_cart_checkout_action', $this->tplIndex);
?>

								</div>
							</div>
						</div><!-- .cart_block -->
					<?php }?>
				<?php
}
}
/* {/block 'blockcart_shopping_cart_content'} */
/* {block 'blockcart_shopping_cart'} */
class Block_15389219016901bc36354121_91441752 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<div class="shopping_cart">
				<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink($_smarty_tpl->tpl_vars['order_process']->value,true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View my booking cart','mod'=>'blockcart'),$_smarty_tpl ) );?>
" rel="nofollow">
					<!-- <b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cart','mod'=>'blockcart'),$_smarty_tpl ) );?>
</b> -->
					<span class="badge badge_style ajax_cart_quantity<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value == 0) {?> unvisible<?php }?>"><?php echo $_smarty_tpl->tpl_vars['total_products_in_cart']->value;?>
</span>
					<!-- <span class="ajax_cart_product_txt<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value != 1) {?> unvisible<?php }?>"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rooms','mod'=>'blockcart'),$_smarty_tpl ) );?>
</span> -->
					<!-- <span class="ajax_cart_product_txt_s<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value < 2) {?> unvisible<?php }?>"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rooms','mod'=>'blockcart'),$_smarty_tpl ) );?>
</span> -->
					<span class="ajax_cart_total<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value == 0) {?> unvisible<?php }?>">
						<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value > 0) {?>
							<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
								<?php $_smarty_tpl->_assignInScope('blockcart_cart_flag', constant('Cart::BOTH_WITHOUT_SHIPPING'));?>
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false,$_smarty_tpl->tpl_vars['blockcart_cart_flag']->value)),$_smarty_tpl ) );?>

							<?php } else { ?>
								<?php $_smarty_tpl->_assignInScope('blockcart_cart_flag', constant('Cart::BOTH_WITHOUT_SHIPPING'));?>
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(true,$_smarty_tpl->tpl_vars['blockcart_cart_flag']->value)),$_smarty_tpl ) );?>

							<?php }?>
						<?php }?>
					</span>
					<span class="badge badge_style ajax_cart_no_product<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value > 0) {?> unvisible<?php }?>">0</span>
					<?php if ($_smarty_tpl->tpl_vars['ajax_allowed']->value && (isset($_smarty_tpl->tpl_vars['blockcart_top']->value)) && !$_smarty_tpl->tpl_vars['blockcart_top']->value) {?>
						<span class="block_cart_expand<?php if (!(isset($_smarty_tpl->tpl_vars['colapseExpandStatus']->value)) || ((isset($_smarty_tpl->tpl_vars['colapseExpandStatus']->value)) && $_smarty_tpl->tpl_vars['colapseExpandStatus']->value == 'expanded')) {?> unvisible<?php }?>">&nbsp;</span>
						<span class="block_cart_collapse<?php if ((isset($_smarty_tpl->tpl_vars['colapseExpandStatus']->value)) && $_smarty_tpl->tpl_vars['colapseExpandStatus']->value == 'collapsed') {?> unvisible<?php }?>">&nbsp;</span>
					<?php }?>
				</a>
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11163326896901bc363d84a3_95436608', 'blockcart_shopping_cart_content', $this->tplIndex);
?>

			</div>
		<?php
}
}
/* {/block 'blockcart_shopping_cart'} */
/* {block 'blockcart_layer_cart_left_heading'} */
class Block_12285738006901bc3652a2a2_04739871 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<h2 class="layer_cart_room_txt">
									<i class="icon-check"></i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room successfully added to your cart','mod'=>'blockcart'),$_smarty_tpl ) );?>

								</h2>
								<h2 class="layer_cart_product_txt">
									<i class="icon-check"></i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product successfully added to your cart','mod'=>'blockcart'),$_smarty_tpl ) );?>

								</h2>
							<?php
}
}
/* {/block 'blockcart_layer_cart_left_heading'} */
/* {block 'blockcart_layer_cart_product_image'} */
class Block_16550153866901bc365307e3_81165482 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<div class="product-image-container layer_cart_img">
								</div>
							<?php
}
}
/* {/block 'blockcart_layer_cart_product_image'} */
/* {block 'blockcart_layer_cart_product_info'} */
class Block_8619372226901bc36532ed7_32016076 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<div class="layer_cart_product_info">
									<span id="layer_cart_product_title" class="product-name"></span>
									<span id="layer_cart_product_attributes"></span>
									<div class="layer_cart_room_txt">
										<strong class="dark"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Time Duration','mod'=>'blockcart'),$_smarty_tpl ) );?>
 &nbsp;-&nbsp;</strong>
										<span id="layer_cart_product_time_duration"></span>
									</div>
									<div>
										<strong class="dark layer_cart_product_txt"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hotel Name','mod'=>'blockcart'),$_smarty_tpl ) );?>
 &nbsp;-&nbsp;</strong>
										<span id="layer_cart_product_hotel_name"></span>
									</div>
									<div>
										<strong class="dark layer_cart_product_txt"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit Price','mod'=>'blockcart'),$_smarty_tpl ) );?>
 &nbsp;-&nbsp;</strong>
										<span id="layer_cart_product_unit_price"></span>
									</div>
									<div>
										<strong class="dark layer_cart_room_txt"><?php if ((isset($_smarty_tpl->tpl_vars['occupancy_required_for_booking']->value)) && $_smarty_tpl->tpl_vars['occupancy_required_for_booking']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room occupancy','mod'=>'blockcart'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rooms quantity added','mod'=>'blockcart'),$_smarty_tpl ) );
}?> &nbsp;-&nbsp;</strong>
										<strong class="dark layer_cart_product_txt"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity','mod'=>'blockcart'),$_smarty_tpl ) );?>
 &nbsp;-&nbsp;</strong>
										<span id="layer_cart_product_quantity"></span>
									</div>
									<div>
										<strong class="dark layer_cart_room_txt"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room type cost','mod'=>'blockcart'),$_smarty_tpl ) );?>
 &nbsp;-&nbsp;</strong>
										<strong class="dark layer_cart_product_txt"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total','mod'=>'blockcart'),$_smarty_tpl ) );?>
 &nbsp;-&nbsp;</strong>
										<span id="layer_cart_product_price"></span>
									</div>
								</div>
							<?php
}
}
/* {/block 'blockcart_layer_cart_product_info'} */
/* {block 'blockcart_layer_cart_left'} */
class Block_15508264786901bc36528964_19837334 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<div class="layer_cart_product col-xs-12 col-md-6">
							<span class="cross" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Close window','mod'=>'blockcart'),$_smarty_tpl ) );?>
"></span>
							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12285738006901bc3652a2a2_04739871', 'blockcart_layer_cart_left_heading', $this->tplIndex);
?>

							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16550153866901bc365307e3_81165482', 'blockcart_layer_cart_product_image', $this->tplIndex);
?>

							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8619372226901bc36532ed7_32016076', 'blockcart_layer_cart_product_info', $this->tplIndex);
?>

						</div>
					<?php
}
}
/* {/block 'blockcart_layer_cart_left'} */
/* {block 'blockcart_layer_cart_right_heading'} */
class Block_4831386836901bc3654aaf7_55525922 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<h2>
									<!-- Plural Case [both cases are needed because page may be updated in Javascript] -->
									<span class="ajax_cart_product_txt_s <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value < 2) {?> unvisible<?php }?>">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There are [1]%d[/1] item(s) in your cart.','mod'=>'blockcart','sprintf'=>array($_smarty_tpl->tpl_vars['cart_qties']->value),'tags'=>array('<span class="ajax_cart_quantity">')),$_smarty_tpl ) );?>

									</span>

									<!-- Singular Case [both cases are needed because page may be updated in Javascript] -->
									<span class="ajax_cart_product_txt <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value > 1) {?> unvisible<?php }?>">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 item in your cart.','mod'=>'blockcart'),$_smarty_tpl ) );?>

									</span>
								</h2>
							<?php
}
}
/* {/block 'blockcart_layer_cart_right_heading'} */
/* {block 'blockcart_layer_cart_room_total_price'} */
class Block_4775987386901bc365618e7_94896414 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<div class="layer_cart_row">
									<strong class="dark">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Rooms Cost in cart','mod'=>'blockcart'),$_smarty_tpl ) );?>

										<?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
											<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax excl.)','mod'=>'blockcart'),$_smarty_tpl ) );?>

											<?php } else { ?>
												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax incl.)','mod'=>'blockcart'),$_smarty_tpl ) );?>

											<?php }?>
										<?php }?>
									</strong>
									<span class="ajax_block_room_total pull-right">
										<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value > 0) {?>
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false,Cart::ONLY_PRODUCTS)),$_smarty_tpl ) );?>

										<?php }?>
									</span>
								</div>
							<?php
}
}
/* {/block 'blockcart_layer_cart_room_total_price'} */
/* {block 'blockcart_layer_cart_product_total_price'} */
class Block_19969314386901bc3657e278_75083295 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<div class="layer_cart_row">
									<strong class="dark">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Product Cost in cart','mod'=>'blockcart'),$_smarty_tpl ) );?>

										<?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
											<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax excl.)','mod'=>'blockcart'),$_smarty_tpl ) );?>

											<?php } else { ?>
												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax incl.)','mod'=>'blockcart'),$_smarty_tpl ) );?>

											<?php }?>
										<?php }?>
									</strong>
									<span class="ajax_block_product_total pull-right">
										<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value > 0) {?>
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false,Cart::ONLY_PRODUCTS)),$_smarty_tpl ) );?>

										<?php }?>
									</span>
								</div>
							<?php
}
}
/* {/block 'blockcart_layer_cart_product_total_price'} */
/* {block 'blockcart_layer_cart_total_convenience_fee'} */
class Block_781839906901bc365db3b8_58212370 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<?php if ((isset($_smarty_tpl->tpl_vars['total_convenience_fee']->value))) {?>
									<div class="layer_cart_row">
										<strong class="dark">
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Convenience Fees','mod'=>'blockcart'),$_smarty_tpl ) );?>

											<?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
												<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
													<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax excl.)','mod'=>'blockcart'),$_smarty_tpl ) );?>

												<?php } else { ?>
													<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax incl.)','mod'=>'blockcart'),$_smarty_tpl ) );?>

												<?php }?>
											<?php }?>
										</strong>
										<span class="price ajax_cart_convenience_fee pull-right"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['total_convenience_fee']->value),$_smarty_tpl ) );?>
</span>
									</div>
								<?php }?>
							<?php
}
}
/* {/block 'blockcart_layer_cart_total_convenience_fee'} */
/* {block 'blockcart_layer_cart_total_tax'} */
class Block_16654415096901bc365ef2a6_50074373 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<?php if ($_smarty_tpl->tpl_vars['show_tax']->value && $_smarty_tpl->tpl_vars['use_tax']->value) {?>
									<div class="layer_cart_row">
										<strong class="dark"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tax','mod'=>'blockcart'),$_smarty_tpl ) );?>
</strong>
										<span class="price cart_block_tax_cost ajax_cart_tax_cost pull-right"><?php echo $_smarty_tpl->tpl_vars['tax_cost']->value;?>
</span>
									</div>
								<?php }?>
							<?php
}
}
/* {/block 'blockcart_layer_cart_total_tax'} */
/* {block 'blockcart_layer_cart_actions'} */
class Block_6375070086901bc36614511_90697365 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

									<div class="button-container">
										<span class="continue btn btn-default button exclusive-medium" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Continue browsing','mod'=>'blockcart'),$_smarty_tpl ) );?>
">
											<span>
												<i class="icon-chevron-left left"></i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Continue browsing','mod'=>'blockcart'),$_smarty_tpl ) );?>

											</span>
										</span>
										<a class="btn btn-default button button-medium"	href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink(((string)$_smarty_tpl->tpl_vars['order_process']->value),true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Proceed to checkout','mod'=>'blockcart'),$_smarty_tpl ) );?>
" rel="nofollow">
											<span>
												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Proceed to checkout','mod'=>'blockcart'),$_smarty_tpl ) );?>
<i class="icon-chevron-right right"></i>
											</span>
										</a>
									</div>
								<?php
}
}
/* {/block 'blockcart_layer_cart_actions'} */
/* {block 'blockcart_layer_cart_total_price'} */
class Block_12049458306901bc365f7ef5_02637796 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<div class="layer_cart_row">
									<strong class="dark">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total','mod'=>'blockcart'),$_smarty_tpl ) );?>

										<?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
											<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax excl.)','mod'=>'blockcart'),$_smarty_tpl ) );?>

											<?php } else { ?>
												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax incl.)','mod'=>'blockcart'),$_smarty_tpl ) );?>

											<?php }?>
										<?php }?>
									</strong>
									<span class="ajax_block_cart_total pull-right">
										<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value > 0) {?>
											<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false)),$_smarty_tpl ) );?>

											<?php } else { ?>
												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(true)),$_smarty_tpl ) );?>

											<?php }?>
										<?php }?>
									</span>
								</div>
								<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6375070086901bc36614511_90697365', 'blockcart_layer_cart_actions', $this->tplIndex);
?>

							<?php
}
}
/* {/block 'blockcart_layer_cart_total_price'} */
/* {block 'blockcart_layer_cart_right'} */
class Block_621415066901bc36549080_96547450 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<div class="layer_cart_cart col-xs-12 col-md-6">
							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4831386836901bc3654aaf7_55525922', 'blockcart_layer_cart_right_heading', $this->tplIndex);
?>


							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4775987386901bc365618e7_94896414', 'blockcart_layer_cart_room_total_price', $this->tplIndex);
?>

							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19969314386901bc3657e278_75083295', 'blockcart_layer_cart_product_total_price', $this->tplIndex);
?>


							<!-- <?php if ($_smarty_tpl->tpl_vars['show_wrapping']->value) {?>
								<div class="layer_cart_row">
									<strong class="dark">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Wrapping','mod'=>'blockcart'),$_smarty_tpl ) );?>

										<?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['display_tax_label']->value && $_smarty_tpl->tpl_vars['show_tax']->value) {?>
											<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax excl.)','mod'=>'blockcart'),$_smarty_tpl ) );?>

											<?php } else { ?>
												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax incl.)','mod'=>'blockcart'),$_smarty_tpl ) );?>

											<?php }?>
										<?php }?>
									</strong>
									<span class="price cart_block_wrapping_cost">
										<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false,Cart::ONLY_WRAPPING)),$_smarty_tpl ) );?>

										<?php } else { ?>
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(true,Cart::ONLY_WRAPPING)),$_smarty_tpl ) );?>

										<?php }?>
									</span>
								</div>
							<?php }?> -->
							<!-- <div class="layer_cart_row">
								<strong class="dark<?php if ($_smarty_tpl->tpl_vars['shipping_cost_float']->value == 0 && (!(isset($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) || !$_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) {?> unvisible<?php }?>">
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total shipping','mod'=>'blockcart'),$_smarty_tpl ) );?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {
if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax excl.)','mod'=>'blockcart'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax incl.)','mod'=>'blockcart'),$_smarty_tpl ) );
}
}?>
								</strong>
								<span class="ajax_cart_shipping_cost<?php if ($_smarty_tpl->tpl_vars['shipping_cost_float']->value == 0 && (!(isset($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) || !$_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) {?> unvisible<?php }?>">
									<?php if ($_smarty_tpl->tpl_vars['shipping_cost_float']->value == 0) {?>
										<?php if ((!(isset($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) || !$_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To be determined','mod'=>'blockcart'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Free shipping!','mod'=>'blockcart'),$_smarty_tpl ) );
}?>
									<?php } else { ?>
										<?php echo $_smarty_tpl->tpl_vars['shipping_cost']->value;?>

									<?php }?>
								</span>
							</div> -->
							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_781839906901bc365db3b8_58212370', 'blockcart_layer_cart_total_convenience_fee', $this->tplIndex);
?>

							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16654415096901bc365ef2a6_50074373', 'blockcart_layer_cart_total_tax', $this->tplIndex);
?>

							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12049458306901bc365f7ef5_02637796', 'blockcart_layer_cart_total_price', $this->tplIndex);
?>

						</div>
					<?php
}
}
/* {/block 'blockcart_layer_cart_right'} */
/* {block 'blockcart_layer_cart'} */
class Block_16095280806901bc36523600_36120149 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value && $_smarty_tpl->tpl_vars['active_overlay']->value == 1) {?>
			<div id="layer_cart">
				<div class="clearfix">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15508264786901bc36528964_19837334', 'blockcart_layer_cart_left', $this->tplIndex);
?>

					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_621415066901bc36549080_96547450', 'blockcart_layer_cart_right', $this->tplIndex);
?>

				</div>
				<div class="crossseling"></div>
			</div> <!-- #layer_cart -->
			<div class="layer_cart_overlay"></div>
		<?php }?>
	<?php
}
}
/* {/block 'blockcart_layer_cart'} */
/* {block 'blockcart_js_vars'} */
class Block_15054085916901bc36630b02_17442075 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'someErrorCondition'));
$_block_repeat=true;
echo $_block_plugin1->addJsDefL(array('name'=>'someErrorCondition'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Some Error occured.Please try again.','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin1->addJsDefL(array('name'=>'someErrorCondition'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('CUSTOMIZE_TEXTFIELD'=>$_smarty_tpl->tpl_vars['CUSTOMIZE_TEXTFIELD']->value),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('img_dir'=>preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['img_dir']->value)),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('generated_date'=>intval(time())),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('ajax_allowed'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'boolval' ][ 0 ], array( $_smarty_tpl->tpl_vars['ajax_allowed']->value ))),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('hasDeliveryAddress'=>((isset($_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)) && $_smarty_tpl->tpl_vars['cart']->value->id_address_delivery)),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('SELLING_PREFERENCE_WITH_ROOM_TYPE'=>Product::SELLING_PREFERENCE_WITH_ROOM_TYPE),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('SELLING_PREFERENCE_STANDALONE'=>Product::SELLING_PREFERENCE_STANDALONE),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('SELLING_PREFERENCE_HOTEL_STANDALONE'=>Product::SELLING_PREFERENCE_HOTEL_STANDALONE),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('SELLING_PREFERENCE_HOTEL_STANDALONE_AND_WITH_ROOM_TYPE'=>Product::SELLING_PREFERENCE_HOTEL_STANDALONE_AND_WITH_ROOM_TYPE),$_smarty_tpl ) );
$_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'customizationIdMessage'));
$_block_repeat=true;
echo $_block_plugin2->addJsDefL(array('name'=>'customizationIdMessage'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customization #','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin2->addJsDefL(array('name'=>'customizationIdMessage'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'removingLinkText'));
$_block_repeat=true;
echo $_block_plugin3->addJsDefL(array('name'=>'removingLinkText'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'remove this product from my cart','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin3->addJsDefL(array('name'=>'removingLinkText'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'freeShippingTranslation'));
$_block_repeat=true;
echo $_block_plugin4->addJsDefL(array('name'=>'freeShippingTranslation'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Free shipping!','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin4->addJsDefL(array('name'=>'freeShippingTranslation'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'freeProductTranslation'));
$_block_repeat=true;
echo $_block_plugin5->addJsDefL(array('name'=>'freeProductTranslation'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Free!','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin5->addJsDefL(array('name'=>'freeProductTranslation'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'delete_txt'));
$_block_repeat=true;
echo $_block_plugin6->addJsDefL(array('name'=>'delete_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin6->addJsDefL(array('name'=>'delete_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'toBeDetermined'));
$_block_repeat=true;
echo $_block_plugin7->addJsDefL(array('name'=>'toBeDetermined'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To be determined','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin7->addJsDefL(array('name'=>'toBeDetermined'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('module_dir'=>$_smarty_tpl->tpl_vars['module_dir']->value),$_smarty_tpl ) );?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('currency_sign'=>$_smarty_tpl->tpl_vars['currency']->value->sign),$_smarty_tpl ) );?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('room_warning_num'=>$_smarty_tpl->tpl_vars['warning_num']->value),$_smarty_tpl ) );?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('currency_format'=>$_smarty_tpl->tpl_vars['currency']->value->format),$_smarty_tpl ) );?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('currency_blank'=>$_smarty_tpl->tpl_vars['currency']->value->blank),$_smarty_tpl ) );?>

		<?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'adults_txt'));
$_block_repeat=true;
echo $_block_plugin8->addJsDefL(array('name'=>'adults_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin8->addJsDefL(array('name'=>'adults_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'children_txt'));
$_block_repeat=true;
echo $_block_plugin9->addJsDefL(array('name'=>'children_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin9->addJsDefL(array('name'=>'children_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'price_txt'));
$_block_repeat=true;
echo $_block_plugin10->addJsDefL(array('name'=>'price_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin10->addJsDefL(array('name'=>'price_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'total_qty_txt'));
$_block_repeat=true;
echo $_block_plugin11->addJsDefL(array('name'=>'total_qty_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Qty.','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin11->addJsDefL(array('name'=>'total_qty_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin12, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'variant_txt'));
$_block_repeat=true;
echo $_block_plugin12->addJsDefL(array('name'=>'variant_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Variant','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin12->addJsDefL(array('name'=>'variant_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin13 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin13, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'qty_txt'));
$_block_repeat=true;
echo $_block_plugin13->addJsDefL(array('name'=>'qty_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Qty','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin13->addJsDefL(array('name'=>'qty_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin14 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin14, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'duration_txt'));
$_block_repeat=true;
echo $_block_plugin14->addJsDefL(array('name'=>'duration_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duration','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin14->addJsDefL(array('name'=>'duration_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin15 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin15, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'capacity_txt'));
$_block_repeat=true;
echo $_block_plugin15->addJsDefL(array('name'=>'capacity_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Capacity','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin15->addJsDefL(array('name'=>'capacity_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin16 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin16, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'remove_rm_title'));
$_block_repeat=true;
echo $_block_plugin16->addJsDefL(array('name'=>'remove_rm_title'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove this room from my cart','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin16->addJsDefL(array('name'=>'remove_rm_title'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin17 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin17, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'no_internet_txt'));
$_block_repeat=true;
echo $_block_plugin17->addJsDefL(array('name'=>'no_internet_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No internet. Please check your internet connection.','mod'=>'blockcart','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin17->addJsDefL(array('name'=>'no_internet_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('rm_avail_process_lnk'=>$_smarty_tpl->tpl_vars['link']->value->getModuleLink('blockcart','checkroomavailabilityajaxprocess')),$_smarty_tpl ) );?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('pagename'=>$_smarty_tpl->tpl_vars['current_page']->value),$_smarty_tpl ) );?>

		
	<?php
}
}
/* {/block 'blockcart_js_vars'} */
/* {block 'blockcart'} */
class Block_4416177806901bc36337c29_93515364 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'blockcart' => 
  array (
    0 => 'Block_4416177806901bc36337c29_93515364',
  ),
  'blockcart_shopping_cart' => 
  array (
    0 => 'Block_15389219016901bc36354121_91441752',
  ),
  'blockcart_shopping_cart_content' => 
  array (
    0 => 'Block_11163326896901bc363d84a3_95436608',
  ),
  'blockcart_shopping_cart_products' => 
  array (
    0 => 'Block_418429956901bc363e92d7_94451154',
  ),
  'blockcart_shopping_cart_discounts' => 
  array (
    0 => 'Block_7001590616901bc3644bda0_62094602',
  ),
  'blockcart_shopping_cart_prices' => 
  array (
    0 => 'Block_4099609636901bc3648d681_50882975',
  ),
  'blockcart_shopping_cart_total_tax' => 
  array (
    0 => 'Block_1542766846901bc364cd443_39902226',
  ),
  'blockcart_shopping_cart_total_convenience_fee' => 
  array (
    0 => 'Block_16130010816901bc364d8b52_92789538',
  ),
  'blockcart_shopping_cart_total' => 
  array (
    0 => 'Block_2628085716901bc364e2f26_48584989',
  ),
  'blockcart_shopping_cart_checkout_action' => 
  array (
    0 => 'Block_1242127476901bc364fa5c7_95638427',
  ),
  'blockcart_layer_cart' => 
  array (
    0 => 'Block_16095280806901bc36523600_36120149',
  ),
  'blockcart_layer_cart_left' => 
  array (
    0 => 'Block_15508264786901bc36528964_19837334',
  ),
  'blockcart_layer_cart_left_heading' => 
  array (
    0 => 'Block_12285738006901bc3652a2a2_04739871',
  ),
  'blockcart_layer_cart_product_image' => 
  array (
    0 => 'Block_16550153866901bc365307e3_81165482',
  ),
  'blockcart_layer_cart_product_info' => 
  array (
    0 => 'Block_8619372226901bc36532ed7_32016076',
  ),
  'blockcart_layer_cart_right' => 
  array (
    0 => 'Block_621415066901bc36549080_96547450',
  ),
  'blockcart_layer_cart_right_heading' => 
  array (
    0 => 'Block_4831386836901bc3654aaf7_55525922',
  ),
  'blockcart_layer_cart_room_total_price' => 
  array (
    0 => 'Block_4775987386901bc365618e7_94896414',
  ),
  'blockcart_layer_cart_product_total_price' => 
  array (
    0 => 'Block_19969314386901bc3657e278_75083295',
  ),
  'blockcart_layer_cart_total_convenience_fee' => 
  array (
    0 => 'Block_781839906901bc365db3b8_58212370',
  ),
  'blockcart_layer_cart_total_tax' => 
  array (
    0 => 'Block_16654415096901bc365ef2a6_50074373',
  ),
  'blockcart_layer_cart_total_price' => 
  array (
    0 => 'Block_12049458306901bc365f7ef5_02637796',
  ),
  'blockcart_layer_cart_actions' => 
  array (
    0 => 'Block_6375070086901bc36614511_90697365',
  ),
  'blockcart_js_vars' => 
  array (
    0 => 'Block_15054085916901bc36630b02_17442075',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\function.counter.php','function'=>'smarty_function_counter',),));
?>

	<!-- MODULE Block cart -->
	<?php if ((isset($_smarty_tpl->tpl_vars['blockcart_top']->value)) && $_smarty_tpl->tpl_vars['blockcart_top']->value) {?>
	<div class="header-top-item <?php if ($_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>header_user_catalog<?php }?>">
	<?php }?>
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15389219016901bc36354121_91441752', 'blockcart_shopping_cart', $this->tplIndex);
?>

	<?php if ((isset($_smarty_tpl->tpl_vars['blockcart_top']->value)) && $_smarty_tpl->tpl_vars['blockcart_top']->value) {?>
	</div>
	<?php }?>
	<?php echo smarty_function_counter(array('name'=>'active_overlay','assign'=>'active_overlay'),$_smarty_tpl);?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16095280806901bc36523600_36120149', 'blockcart_layer_cart', $this->tplIndex);
?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15054085916901bc36630b02_17442075', 'blockcart_js_vars', $this->tplIndex);
?>

	<?php
}
}
/* {/block 'blockcart'} */
}
