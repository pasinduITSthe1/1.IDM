<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:16
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\order-confirmation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f284d0e205_08747851',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'de956ffbbeb2f7683e626a3857a58abe66b920d6' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\order-confirmation.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f284d0e205_08747851 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_165546833668e4f2842d3590_71555607', 'order_confirmation');
?>

<?php }
/* {block 'order_confirmation_heading'} */
class Block_191929766568e4f2842e7629_32574497 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<h1 class="page-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Booking confirmation'),$_smarty_tpl ) );?>
 : <span class="bold"><?php echo $_smarty_tpl->tpl_vars['order']->value->reference;?>
</span></h1>
	<?php
}
}
/* {/block 'order_confirmation_heading'} */
/* {block 'order_steps'} */
class Block_24867460868e4f2842fe2b7_55831471 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-steps.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php
}
}
/* {/block 'order_steps'} */
/* {block 'errors'} */
class Block_149244297568e4f284313ef1_98468120 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php
}
}
/* {/block 'errors'} */
/* {block 'displayOrderConfirmation'} */
class Block_201896826368e4f284323047_35729241 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php echo $_smarty_tpl->tpl_vars['HOOK_ORDER_CONFIRMATION']->value;?>

	<?php
}
}
/* {/block 'displayOrderConfirmation'} */
/* {block 'displayPaymentReturn'} */
class Block_168032103868e4f284336b26_92910240 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <?php echo $_smarty_tpl->tpl_vars['HOOK_PAYMENT_RETURN']->value;?>

                <?php
}
}
/* {/block 'displayPaymentReturn'} */
/* {block 'order_hotel_product_image'} */
class Block_106129145968e4f2846e8d91_58161461 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																<div class="col-xs-3 col-sm-2">
																	<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['product_name'], ENT_QUOTES, 'UTF-8', true);?>
" target="_blank">
																		<img class="img img-responsive img-room-type" src="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['cover_img'], ENT_QUOTES, 'UTF-8', true);?>
" />
																	</a>
																</div>
															<?php
}
}
/* {/block 'order_hotel_product_image'} */
/* {block 'order_hotel_product_detail'} */
class Block_54899022468e4f284723837_78767118 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																<div class="col-xs-9 col-sm-10 info-wrap">
																	<div class="row">
																		<div class="col-xs-12">
																			<p class="product-name">
																				<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['product_name'], ENT_QUOTES, 'UTF-8', true);?>
" target="_blank" class="product-name">
																					<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['product_name'], ENT_QUOTES, 'UTF-8', true);
if ((isset($_smarty_tpl->tpl_vars['product']->value['option_name'])) && $_smarty_tpl->tpl_vars['product']->value['option_name']) {?> : <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['option_name'], ENT_QUOTES, 'UTF-8', true);
}?>
																				</a>
																			</p>
                                                                            <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['hotel_location']))) {?>
                                                                                <p class="hotel-location">
                                                                                    <i class="icon-map-marker"></i> &nbsp;<?php echo $_smarty_tpl->tpl_vars['product']->value['hotel_location'];?>

                                                                                </p>
                                                                            <?php }?>
																		</div>
																		<div class="col-xs-12">
																			<div class="description-list">
																				<dl class="">
																					<div class="row">
																						<?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
																							<div class="col-xs-12 col-md-6">
																								<div class="row">
																									<dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity'),$_smarty_tpl ) );?>
</dt>
																									<dd class="col-xs-7"><?php echo $_smarty_tpl->tpl_vars['product']->value['product_quantity'];?>
</dd>
																								</div>
																							</div>
																						<?php }?>
																						<div class="col-xs-12 col-md-6">
																							<div class="row">
																								<dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit Price'),$_smarty_tpl ) );?>
</dt>
																								<dd class="col-xs-7">
																									<?php if ($_smarty_tpl->tpl_vars['group_use_tax']->value) {?>
																										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['unit_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl ) );?>

																									<?php } else { ?>
																										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['unit_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl ) );?>

																									<?php }?>
																								</dd>
																							</div>
																						</div>
																					</div>
																					<div class="row">
																						<?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
																							<div class="col-xs-12 col-md-6">
																							</div>
																						<?php }?>
																						<div class="col-xs-12 col-md-6">
																							<div class="row">
																								<dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Pricing'),$_smarty_tpl ) );?>
</dt>
																								<dd class="col-xs-7">
																									<?php if ($_smarty_tpl->tpl_vars['group_use_tax']->value) {?>
																										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl ) );?>

																									<?php } else { ?>
																										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl ) );?>

																									<?php }?>
																								</dd>
																							</div>
																						</div>
																					</div>
																				</dl>
																			</div>
																		</div>
																	</div>
																</div>
															<?php
}
}
/* {/block 'order_hotel_product_detail'} */
/* {block 'order_hotel_product_image'} */
class Block_125332686168e4f284820c22_27908376 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																<div class="col-xs-3 col-sm-2">
																	<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['product_name'], ENT_QUOTES, 'UTF-8', true);?>
" target="_blank">
																		<img class="img img-responsive img-room-type" src="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['cover_img'], ENT_QUOTES, 'UTF-8', true);?>
" />
																	</a>
																</div>
															<?php
}
}
/* {/block 'order_hotel_product_image'} */
/* {block 'order_hotel_product_detail'} */
class Block_71534159668e4f284860e96_68783856 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																<div class="col-xs-9 col-sm-10 info-wrap">
																	<div class="row">
																		<div class="col-xs-12">
																			<p class="product-name">
																				<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['product_name'], ENT_QUOTES, 'UTF-8', true);?>
" target="_blank" class="product-name">
																					<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['product_name'], ENT_QUOTES, 'UTF-8', true);
if ((isset($_smarty_tpl->tpl_vars['product']->value['option_name'])) && $_smarty_tpl->tpl_vars['product']->value['option_name']) {?> : <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['option_name'], ENT_QUOTES, 'UTF-8', true);
}?>
																				</a>
																			</p>
																		</div>
																		<div class="col-xs-12">
																			<div class="description-list">
																				<dl class="">
																					<div class="row">
																						<?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
																							<div class="col-xs-12 col-md-6">
																								<div class="row">
																									<dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity'),$_smarty_tpl ) );?>
</dt>
																									<dd class="col-xs-7"><?php echo $_smarty_tpl->tpl_vars['product']->value['product_quantity'];?>
</dd>
																								</div>
																							</div>
																						<?php }?>
																						<div class="col-xs-12 col-md-6">
																							<div class="row">
																								<dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit Price'),$_smarty_tpl ) );?>
</dt>
																								<dd class="col-xs-7">
																									<?php if ($_smarty_tpl->tpl_vars['group_use_tax']->value) {?>
																										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['unit_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl ) );?>

																									<?php } else { ?>
																										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['unit_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl ) );?>

																									<?php }?>
																								</dd>
																							</div>
																						</div>
																					</div>
																					<div class="row">
																						<?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
																							<div class="col-xs-12 col-md-6">
																							</div>
																						<?php }?>
																						<div class="col-xs-12 col-md-6">
																							<div class="row">
																								<dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Pricing'),$_smarty_tpl ) );?>
</dt>
																								<dd class="col-xs-7">
																									<?php if ($_smarty_tpl->tpl_vars['group_use_tax']->value) {?>
																										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl ) );?>

																									<?php } else { ?>
																										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl ) );?>

																									<?php }?>
																								</dd>
																							</div>
																						</div>
																					</div>
																				</dl>
																			</div>
																		</div>
																	</div>
																</div>
															<?php
}
}
/* {/block 'order_hotel_product_detail'} */
/* {block 'displayOrderDetailPaymentDetailsRow'} */
class Block_169509588768e4f284a0e471_67802514 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

												<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayOrderDetailPaymentDetailsRow','id_order'=>$_smarty_tpl->tpl_vars['order']->value->id),$_smarty_tpl ) );?>

											<?php
}
}
/* {/block 'displayOrderDetailPaymentDetailsRow'} */
/* {block 'order_detail_payment_details'} */
class Block_142054496568e4f28493e116_35326262 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

									<div class="card">
										<div class="card-header">
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment Details'),$_smarty_tpl ) );?>

										</div>
										<div class="card-body">
											<div class="row">
												<label class="col-xs-6 title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment Method'),$_smarty_tpl ) );?>
</label>
												<div class="col-xs-6 text-right value payment-method">
																											<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['order']->value->payment, ENT_QUOTES, 'UTF-8', true);?>

																									</div>
											</div>
											<br>
											<div class="row">
												<label class="col-xs-6 title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status'),$_smarty_tpl ) );?>
</label>
												<div class="col-xs-6 text-right value status">
													<?php if ((isset($_smarty_tpl->tpl_vars['order_history']->value[0])) && $_smarty_tpl->tpl_vars['order_history']->value[0]) {?>
														<span<?php if ((isset($_smarty_tpl->tpl_vars['order_history']->value[0]['color'])) && $_smarty_tpl->tpl_vars['order_history']->value[0]['color']) {?> style="background-color:<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['order_history']->value[0]['color'], ENT_QUOTES, 'UTF-8', true);?>
30; border: 1px solid <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['order_history']->value[0]['color'], ENT_QUOTES, 'UTF-8', true);?>
;" <?php }?> class="label">
															<?php if (in_array($_smarty_tpl->tpl_vars['order_history']->value[0]['id_order_state'],$_smarty_tpl->tpl_vars['overbooking_order_states']->value)) {?>
																<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order Not Confirmed'),$_smarty_tpl ) );?>

															<?php } else { ?>
																<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['order_history']->value[0]['ostate_name'], ENT_QUOTES, 'UTF-8', true);?>

															<?php }?>
														</span>
													<?php } else { ?>
														<span class="processing"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Processing'),$_smarty_tpl ) );?>
</span>
													<?php }?>
												</div>
											</div>

											<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_169509588768e4f284a0e471_67802514', 'displayOrderDetailPaymentDetailsRow', $this->tplIndex);
?>

										</div>
									</div>
								<?php
}
}
/* {/block 'order_detail_payment_details'} */
/* {block 'order_detail_payment_summary'} */
class Block_210336830568e4f284a26412_94940711 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

									<div class="card">
										<div class="card-header">
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment Summary'),$_smarty_tpl ) );?>

										</div>
										<div class="card-body">
											<div class="prices-breakdown-table">
												<table class="table table-sm table-responsive table-summary">
													<tbody>
														<?php if ((isset($_smarty_tpl->tpl_vars['cart_htl_data']->value))) {?>
															<tr class="item">
																<td>
																	<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Rooms Cost'),$_smarty_tpl ) );?>
 <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['display_tax_label']->value == 1) {
if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax excl.)'),$_smarty_tpl ) );
} elseif ($_smarty_tpl->tpl_vars['priceDisplay']->value == 0) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax incl.)'),$_smarty_tpl ) );
}?> <?php }?></strong>
																</td>
																<td class="text-right">
																	<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value && $_smarty_tpl->tpl_vars['use_tax']->value) {?>
																		<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_rooms_te']+$_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_services_te']+$_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_auto_add_services_te']+$_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_demands_price_te']),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>
</span>
																	<?php } else { ?>
																		<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_rooms_ti']+$_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_services_ti']+$_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_auto_add_services_ti']+$_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_demands_price_ti']),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>
</span>
																	<?php }?>
																</td>
															</tr>
														<?php }?>
														<?php if (((isset($_smarty_tpl->tpl_vars['cart_standalone_service_products']->value)) && $_smarty_tpl->tpl_vars['cart_standalone_service_products']->value) || ((isset($_smarty_tpl->tpl_vars['cart_hotel_service_products']->value)) && $_smarty_tpl->tpl_vars['cart_hotel_service_products']->value)) {?>
															<tr class="item">
																<td>
																	<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total products cost'),$_smarty_tpl ) );?>
 <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['display_tax_label']->value == 1) {
if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax excl.)'),$_smarty_tpl ) );
} elseif ($_smarty_tpl->tpl_vars['priceDisplay']->value == 0) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax incl.)'),$_smarty_tpl ) );
}?> <?php }?></strong>
																</td>
																<td class="text-right">
																	<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value && $_smarty_tpl->tpl_vars['use_tax']->value) {?>
																		<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_standalone_products_te'],'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>
</span>
																	<?php } else { ?>
																		<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_standalone_products_ti'],'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>
</span>
																	<?php }?>
																</td>
															</tr>
														<?php }?>
														<?php if ($_smarty_tpl->tpl_vars['order']->value->total_wrapping > 0) {?>
															<tr class="item">
																<td>
																	<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total gift wrapping cost'),$_smarty_tpl ) );?>
</strong>
																</td>
																<td class="text-right">
																	<span class="price-wrapping"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_wrapping']*-1),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>
</span>
																</td>
															</tr>
														<?php }?>
														<?php if ($_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_convenience_fee_te'] || $_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_convenience_fee_ti']) {?>
															<tr class="item">
																<td>
																	<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Convenience Fees'),$_smarty_tpl ) );?>
 <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['display_tax_label']->value == 1) {
if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax excl.)'),$_smarty_tpl ) );
} elseif ($_smarty_tpl->tpl_vars['priceDisplay']->value == 0) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax incl.)'),$_smarty_tpl ) );
}?> <?php }?></strong>
																</td>
																<td class="text-right">
																	<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value && $_smarty_tpl->tpl_vars['use_tax']->value) {?>
																		<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_convenience_fee_te']),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>
</span>
																	<?php } else { ?>
																		<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_convenience_fee_ti']),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>
</span>
																	<?php }?>
																</td>
															</tr>
														<?php }?>
														<tr class="item">
															<td>
																<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Tax'),$_smarty_tpl ) );?>
</strong>
															</td>
															<td class="text-right">
																<span class="price-discount"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_tax_without_discount'],'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value,'convert'=>1),$_smarty_tpl ) );?>
</span>
															</td>
														</tr>
														<?php if ($_smarty_tpl->tpl_vars['order']->value->total_discounts > 0) {?>
															<tr class="item">
																<td>
																	<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Vouchers'),$_smarty_tpl ) );?>
</strong>
																</td>
																<td class="text-right">
																	<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value && $_smarty_tpl->tpl_vars['use_tax']->value) {?>
																		<span class="price-discount"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_discounts_te']*-1),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value,'convert'=>1),$_smarty_tpl ) );?>
</span>
																	<?php } else { ?>
																		<span class="price-discount"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_discounts']*-1),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value,'convert'=>1),$_smarty_tpl ) );?>
</span>
																	<?php }?>
																</td>
															</tr>
														<?php }?>
														<tr class="totalprice item">
															<td>
																<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Final Booking Total'),$_smarty_tpl ) );?>
</strong>
															</td>
															<td class="text-right">
																<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_paid'],'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>
</span>
															</td>
														</tr>
														<?php if ($_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_paid'] > $_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_paid_real']) {?>
															<tr class="item">
																<td>
																	<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Due Amount'),$_smarty_tpl ) );?>
</strong>
																</td>
																<td class="text-right">
																	<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_paid']-$_smarty_tpl->tpl_vars['orderTotalInfo']->value['total_paid_real']),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>
</span>
																</td>
															</tr>
														<?php }?>


													</tbody>
												</table>
											</div>
										</div>
									</div>
								<?php
}
}
/* {/block 'order_detail_payment_summary'} */
/* {block 'order_details'} */
class Block_212685851068e4f2843ed432_39490142 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

					<div id="order-detail-content" class="">
						<div class="row">
							<div class="col-md-8 order-product-summary">
								<?php if ((isset($_smarty_tpl->tpl_vars['cart_htl_data']->value))) {?>
									<div class="card">
										<div class="card-header"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room Details'),$_smarty_tpl ) );?>
</div>
										<div class="card-body">
											<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart_htl_data']->value, 'data_v', false, 'data_k');
$_smarty_tpl->tpl_vars['data_v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data_k']->value => $_smarty_tpl->tpl_vars['data_v']->value) {
$_smarty_tpl->tpl_vars['data_v']->do_else = false;
?>
												<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data_v']->value['date_diff'], 'rm_v', false, 'rm_k');
$_smarty_tpl->tpl_vars['rm_v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rm_k']->value => $_smarty_tpl->tpl_vars['rm_v']->value) {
$_smarty_tpl->tpl_vars['rm_v']->do_else = false;
?>
													<div class="product-detail" data-id-product="<?php echo $_smarty_tpl->tpl_vars['data_v']->value['id_product'];?>
" data-date-diff="<?php echo $_smarty_tpl->tpl_vars['rm_k']->value;?>
">
														<div class="row">
															<div class="col-xs-3 col-sm-2">
																<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['data_v']->value['id_product']);?>
">
																	<img src="<?php echo $_smarty_tpl->tpl_vars['data_v']->value['cover_img'];?>
" class="img-responsive"/>
																</a>
															</div>
															<div class="col-xs-9 col-sm-10">
																<div class="row">
																	<div class="col-xs-12">
																		<p class="product-name">
																			<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['data_v']->value['id_product']);?>
">
																				<?php echo $_smarty_tpl->tpl_vars['data_v']->value['name'];?>

																			</a>
																		</p>
																	</div>
																</div>

																<div class="row">
																	<?php $_smarty_tpl->_assignInScope('is_full_date', ($_smarty_tpl->tpl_vars['show_full_date']->value && (smarty_modifier_date_format($_smarty_tpl->tpl_vars['rm_v']->value['data_form'],'%D') == smarty_modifier_date_format($_smarty_tpl->tpl_vars['rm_v']->value['data_to'],'%D'))));?>
																	<div class="col-xs-12 col-md-6">
																		<div class="row">
																			<dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-in'),$_smarty_tpl ) );?>
</dt>
																			<dd class="col-xs-7"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['rm_v']->value['data_form'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>
</dd>
																		</div>
																	</div>
																	<div class="col-xs-12 col-md-6">
																		<div class="row">
																			<dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-out'),$_smarty_tpl ) );?>
</dt>
																			<dd class="col-xs-7"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['rm_v']->value['data_to'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>
</dd>
																		</div>
																	</div>
																</div>

																<div class="row">
																	<div class="col-xs-12 col-md-6">
																		<div class="row">
																			<dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rooms'),$_smarty_tpl ) );?>
</dt>
																			<dd class="col-xs-7"><?php echo sprintf('%02d',$_smarty_tpl->tpl_vars['rm_v']->value['num_rm']);?>
</dd>
																		</div>
																	</div>
																	<div class="col-xs-12 col-md-6">
																		<div class="row">
																			<dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Guests'),$_smarty_tpl ) );?>
</dt>
																			<dd class="col-xs-7">
																				<?php echo sprintf('%02d',$_smarty_tpl->tpl_vars['rm_v']->value['adults']);?>
 <?php if ($_smarty_tpl->tpl_vars['rm_v']->value['adults'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adult'),$_smarty_tpl ) );
}
if ($_smarty_tpl->tpl_vars['rm_v']->value['children']) {?>, <?php echo sprintf('%02d',$_smarty_tpl->tpl_vars['rm_v']->value['children']);?>
 <?php if ($_smarty_tpl->tpl_vars['rm_v']->value['children'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );
}
}?>
																			</dd>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xs-12 col-md-6">
																		<div class="row">
																			<dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Extra Services'),$_smarty_tpl ) );?>
</dt>
																			<dd class="col-xs-7">
																				<?php if (((isset($_smarty_tpl->tpl_vars['rm_v']->value['extra_demands'])) && $_smarty_tpl->tpl_vars['rm_v']->value['extra_demands']) || (isset($_smarty_tpl->tpl_vars['rm_v']->value['additional_services'])) && $_smarty_tpl->tpl_vars['rm_v']->value['additional_services']) {?>
																						<a data-date_from="<?php echo $_smarty_tpl->tpl_vars['rm_v']->value['data_form'];?>
" data-date_to="<?php echo $_smarty_tpl->tpl_vars['rm_v']->value['data_to'];?>
" data-id_product="<?php echo $_smarty_tpl->tpl_vars['data_v']->value['id_product'];?>
" data-id_order="<?php echo $_smarty_tpl->tpl_vars['data_v']->value['id_order'];?>
" data-action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order-detail');?>
" class="open_rooms_extra_services_panel" href="#rooms_type_extra_services_form">
																				<?php }?>
																				<?php if ($_smarty_tpl->tpl_vars['group_use_tax']->value) {?>
																					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['rm_v']->value['extra_demands_price_ti']+$_smarty_tpl->tpl_vars['rm_v']->value['additional_services_price_ti']),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>

																				<?php } else { ?>
																					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['rm_v']->value['extra_demands_price_te']+$_smarty_tpl->tpl_vars['rm_v']->value['additional_services_price_te']),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>

																				<?php }?>
																				<?php if (((isset($_smarty_tpl->tpl_vars['rm_v']->value['extra_demands'])) && $_smarty_tpl->tpl_vars['rm_v']->value['extra_demands']) || (isset($_smarty_tpl->tpl_vars['rm_v']->value['additional_services'])) && $_smarty_tpl->tpl_vars['rm_v']->value['additional_services']) {?>
																					</a>
																				<?php }?>
																			</dd>
																		</div>
																	</div>
																	<div class="col-xs-12 col-md-6">
																		<div class="row">
																			<dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Price'),$_smarty_tpl ) );?>
</dt>
																			<dd class="col-xs-7">
																				<?php if ($_smarty_tpl->tpl_vars['group_use_tax']->value) {?>
																					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['rm_v']->value['amount_tax_incl']+$_smarty_tpl->tpl_vars['rm_v']->value['extra_demands_price_ti']+$_smarty_tpl->tpl_vars['rm_v']->value['additional_services_price_ti']+$_smarty_tpl->tpl_vars['rm_v']->value['additional_services_price_auto_add_ti']),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>

																				<?php } else { ?>
																					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['rm_v']->value['amount_tax_excl']+$_smarty_tpl->tpl_vars['rm_v']->value['extra_demands_price_te']+$_smarty_tpl->tpl_vars['rm_v']->value['additional_services_price_te']+$_smarty_tpl->tpl_vars['rm_v']->value['additional_services_price_auto_add_te']),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>

																				<?php }?>
																				<?php if (((isset($_smarty_tpl->tpl_vars['rm_v']->value['extra_demands'])) && $_smarty_tpl->tpl_vars['rm_v']->value['extra_demands']) || (isset($_smarty_tpl->tpl_vars['rm_v']->value['additional_services'])) && $_smarty_tpl->tpl_vars['rm_v']->value['additional_services']) {?>
																					<span class="order-price-info">
																						<img src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
icon/icon-info.svg" />
																					</span>
																					<div class="price-info-container" style="display:none">
																						<div class="price-info-tooltip-cont">
																							<div class="list-row">
																								<div>
																									<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room cost'),$_smarty_tpl ) );?>
 : </p>
																								</div>
																								<div class="text-right">
																									<p>
																										<?php if ($_smarty_tpl->tpl_vars['group_use_tax']->value) {?>
																											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['rm_v']->value['amount_tax_incl']+$_smarty_tpl->tpl_vars['rm_v']->value['additional_services_price_auto_add_ti']),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>

																										<?php } else { ?>
																											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['rm_v']->value['amount_tax_excl']+$_smarty_tpl->tpl_vars['rm_v']->value['additional_services_price_auto_add_te']),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>

																										<?php }?>
																									</p>
																								</div>
																							</div>
																							<div class="list-row">
																								<div>
																									<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Service cost'),$_smarty_tpl ) );?>
 : </p>
																								</div>
																								<div class="text-right">
																									<p>
																										<?php if ($_smarty_tpl->tpl_vars['group_use_tax']->value) {?>
																											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['rm_v']->value['extra_demands_price_ti']+$_smarty_tpl->tpl_vars['rm_v']->value['additional_services_price_ti']),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>

																										<?php } else { ?>
																											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['rm_v']->value['extra_demands_price_te']+$_smarty_tpl->tpl_vars['rm_v']->value['additional_services_price_te']),'currency'=>$_smarty_tpl->tpl_vars['objOrderCurrency']->value),$_smarty_tpl ) );?>

																										<?php }?>
																									</p>
																								</div>
																							</div>
																						</div>
																					</div>
																				<?php }?>
																			</dd>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
											<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
										</div>
									</div>
								<?php }?>
								<?php if ((isset($_smarty_tpl->tpl_vars['cart_standalone_service_products']->value)) || (isset($_smarty_tpl->tpl_vars['cart_hotel_service_products']->value))) {?>
									<div class="card">
										<div class="card-header"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product Details'),$_smarty_tpl ) );?>
</div>
										<div class="card-body">
											<?php if ((isset($_smarty_tpl->tpl_vars['cart_hotel_service_products']->value))) {?>
												<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart_hotel_service_products']->value, 'product', false, 'data_k');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data_k']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
													<div class="product-detail" data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
">
														<div class="row">
															<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_106129145968e4f2846e8d91_58161461', 'order_hotel_product_image', $this->tplIndex);
?>

															<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_54899022468e4f284723837_78767118', 'order_hotel_product_detail', $this->tplIndex);
?>

														</div>
													</div>
												<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
											<?php }?>
											<?php if ((isset($_smarty_tpl->tpl_vars['cart_standalone_service_products']->value))) {?>
												<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart_standalone_service_products']->value, 'product', false, 'data_k');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data_k']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
													<div class="product-detail" data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
">
														<div class="row">
															<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_125332686168e4f284820c22_27908376', 'order_hotel_product_image', $this->tplIndex);
?>

															<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_71534159668e4f284860e96_68783856', 'order_hotel_product_detail', $this->tplIndex);
?>

														</div>
													</div>
												<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
											<?php }?>
										</div>
									</div>
								<?php }?>
							</div>
							<div class="col-md-4">
								<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_142054496568e4f28493e116_35326262', 'order_detail_payment_details', $this->tplIndex);
?>

								<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_210336830568e4f284a26412_94940711', 'order_detail_payment_summary', $this->tplIndex);
?>

							</div>
						</div>
					</div>
				<?php
}
}
/* {/block 'order_details'} */
/* {block 'order_confirmation_room_extra_services'} */
class Block_204478441368e4f284c95a38_59139837 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<div style="display:none;" id="rooms_extra_services">
					</div>
	<?php
}
}
/* {/block 'order_confirmation_room_extra_services'} */
/* {block 'order_confirmation_js_vars'} */
class Block_183371683868e4f284c999f5_29753089 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('historyUrl'=>preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['link']->value->getPageLink("orderdetail",true))),$_smarty_tpl ) );
$_block_plugin68 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin68, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'req_sent_msg'));
$_block_repeat=true;
echo $_block_plugin68->addJsDefL(array('name'=>'req_sent_msg'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Request Sent..','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin68->addJsDefL(array('name'=>'req_sent_msg'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin69 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin69, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'wait_stage_msg'));
$_block_repeat=true;
echo $_block_plugin69->addJsDefL(array('name'=>'wait_stage_msg'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Waiting','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin69->addJsDefL(array('name'=>'wait_stage_msg'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin70 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin70, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'pending_state_msg'));
$_block_repeat=true;
echo $_block_plugin70->addJsDefL(array('name'=>'pending_state_msg'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Pending...','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin70->addJsDefL(array('name'=>'pending_state_msg'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin71 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin71, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'mail_sending_err'));
$_block_repeat=true;
echo $_block_plugin71->addJsDefL(array('name'=>'mail_sending_err'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Some error occurred while sending mail to the customer','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin71->addJsDefL(array('name'=>'mail_sending_err'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin72 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin72, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'refund_request_sending_error'));
$_block_repeat=true;
echo $_block_plugin72->addJsDefL(array('name'=>'refund_request_sending_error'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Some error occurred while processing request for order cancellation.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin72->addJsDefL(array('name'=>'refund_request_sending_error'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php
}
}
/* {/block 'order_confirmation_js_vars'} */
/* {block 'order_confirmation'} */
class Block_165546833668e4f2842d3590_71555607 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_confirmation' => 
  array (
    0 => 'Block_165546833668e4f2842d3590_71555607',
  ),
  'order_confirmation_heading' => 
  array (
    0 => 'Block_191929766568e4f2842e7629_32574497',
  ),
  'order_steps' => 
  array (
    0 => 'Block_24867460868e4f2842fe2b7_55831471',
  ),
  'errors' => 
  array (
    0 => 'Block_149244297568e4f284313ef1_98468120',
  ),
  'displayOrderConfirmation' => 
  array (
    0 => 'Block_201896826368e4f284323047_35729241',
  ),
  'displayPaymentReturn' => 
  array (
    0 => 'Block_168032103868e4f284336b26_92910240',
  ),
  'order_details' => 
  array (
    0 => 'Block_212685851068e4f2843ed432_39490142',
  ),
  'order_hotel_product_image' => 
  array (
    0 => 'Block_106129145968e4f2846e8d91_58161461',
    1 => 'Block_125332686168e4f284820c22_27908376',
  ),
  'order_hotel_product_detail' => 
  array (
    0 => 'Block_54899022468e4f284723837_78767118',
    1 => 'Block_71534159668e4f284860e96_68783856',
  ),
  'order_detail_payment_details' => 
  array (
    0 => 'Block_142054496568e4f28493e116_35326262',
  ),
  'displayOrderDetailPaymentDetailsRow' => 
  array (
    0 => 'Block_169509588768e4f284a0e471_67802514',
  ),
  'order_detail_payment_summary' => 
  array (
    0 => 'Block_210336830568e4f284a26412_94940711',
  ),
  'order_confirmation_room_extra_services' => 
  array (
    0 => 'Block_204478441368e4f284c95a38_59139837',
  ),
  'order_confirmation_js_vars' => 
  array (
    0 => 'Block_183371683868e4f284c999f5_29753089',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order confirmation'),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_191929766568e4f2842e7629_32574497', 'order_confirmation_heading', $this->tplIndex);
?>


	<?php $_smarty_tpl->_assignInScope('current_step', 'payment');?>
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_24867460868e4f2842fe2b7_55831471', 'order_steps', $this->tplIndex);
?>


	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_149244297568e4f284313ef1_98468120', 'errors', $this->tplIndex);
?>


	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_201896826368e4f284323047_35729241', 'displayOrderConfirmation', $this->tplIndex);
?>


	<div class="order-confirmation-column">
        <?php if ($_smarty_tpl->tpl_vars['HOOK_PAYMENT_RETURN']->value) {?>
            <div class="card">
                <div class="card-body">
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_168032103868e4f284336b26_92910240', 'displayPaymentReturn', $this->tplIndex);
?>

                </div>
            </div>
        <?php }?>
		<?php if ((isset($_smarty_tpl->tpl_vars['order']->value->id)) && $_smarty_tpl->tpl_vars['order']->value->id) {?>
			<?php if ($_smarty_tpl->tpl_vars['is_guest']->value) {?>
				<p class="cart_navigation exclusive">
				<a class="button-exclusive btn btn-default" href="<?php ob_start();
echo urlencode($_smarty_tpl->tpl_vars['reference_order']->value);
$_prefixVariable34=ob_get_clean();
ob_start();
echo urlencode($_smarty_tpl->tpl_vars['email']->value);
$_prefixVariable35=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('guest-tracking',true,NULL,"id_order=".$_prefixVariable34."&email=".$_prefixVariable35), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Follow my order'),$_smarty_tpl ) );?>
"><i class="icon-chevron-left"></i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Follow my order'),$_smarty_tpl ) );?>
</a>
				</p>
			<?php } else { ?>
				<?php if ((isset($_smarty_tpl->tpl_vars['is_free_order']->value)) && $_smarty_tpl->tpl_vars['is_free_order']->value) {?>
					<p class="alert alert-success"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your'),$_smarty_tpl ) );?>
 <?php if ($_smarty_tpl->tpl_vars['total_rooms_booked']->value > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'bookings have'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'booking has'),$_smarty_tpl ) );
}?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'been created successfully!'),$_smarty_tpl ) );?>
</p><br />
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['any_back_order']->value) {?>
					<?php if ($_smarty_tpl->tpl_vars['shw_bo_msg']->value) {?>
						<br>
						<p class="back_o_msg"><strong><sup>*</sup><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Some of your rooms are on back order. Please read the following message for rooms with status on backorder'),$_smarty_tpl ) );?>
</strong></p>
						<p>
							-&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['back_ord_msg']->value;?>

						</p>
					<?php }?>
				<?php }?>
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_212685851068e4f2843ed432_39490142', 'order_details', $this->tplIndex);
?>

				<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'An email has been sent with this information.'),$_smarty_tpl ) );?>

					<br /><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your booking has been received successfully and we are looking forward to welcoming you.'),$_smarty_tpl ) );?>
</strong>
					<br /><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If you have questions, comments or concerns, please contact our'),$_smarty_tpl ) );?>
 <a class="cust_serv_lnk" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('contact',true), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'expert customer support team.'),$_smarty_tpl ) );?>
</a>
				</p>
				<p class="cart_navigation exclusive">
					<a class="btn" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('history',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Go to your order history page'),$_smarty_tpl ) );?>
"><i class="icon-chevron-left"></i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View your order history'),$_smarty_tpl ) );?>
</a>
				</p>
			<?php }?>
		<?php }?>
	</div>

		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_204478441368e4f284c95a38_59139837', 'order_confirmation_room_extra_services', $this->tplIndex);
?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_183371683868e4f284c999f5_29753089', 'order_confirmation_js_vars', $this->tplIndex);
?>

<?php
}
}
/* {/block 'order_confirmation'} */
}
