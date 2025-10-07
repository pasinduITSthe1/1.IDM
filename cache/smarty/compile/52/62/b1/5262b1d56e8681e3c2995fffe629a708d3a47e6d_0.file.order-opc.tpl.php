<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:21
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\order-opc.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2894fb249_99897993',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5262b1d56e8681e3c2995fffe629a708d3a47e6d' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\order-opc.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./order-opc-edit-guest-info.tpl' => 1,
  ),
),false)) {
function content_68e4f2894fb249_99897993 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5161370368e4f288c12a30_07986986', 'order_opc');
?>

<?php }
/* {block 'order_opc_heading'} */
class Block_173062148868e4f288c48320_25650323 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

							<h2 class="page-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your booking cart'),$_smarty_tpl ) );?>
</h2>
						<?php
}
}
/* {/block 'order_opc_heading'} */
/* {block 'errors'} */
class Block_197190546868e4f288c6dfd3_20465036 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

										<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
									<?php
}
}
/* {/block 'errors'} */
/* {block 'order_opc_rooms_summary_heading'} */
class Block_39952362768e4f288cbc7e0_08932444 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																	<h5 class="accordion-header" data-toggle="collapse" data-target="#collapse-shopping-cart" aria-expanded="true" aria-controls="collapse-shopping-cart">
																		<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rooms & Price Summary'),$_smarty_tpl ) );?>
</span>
																		<i class="icon-angle-left pull-right accordion-left-arrow <?php if ($_smarty_tpl->tpl_vars['step']->value->step_is_current) {?>hidden<?php }?>"></i>
																	</h5>
																<?php
}
}
/* {/block 'order_opc_rooms_summary_heading'} */
/* {block 'shopping_cart'} */
class Block_82135951368e4f288ce7721_33224981 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																			<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./shopping-cart.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
																		<?php
}
}
/* {/block 'shopping_cart'} */
/* {block 'order_opc_rooms_summary'} */
class Block_117412700468e4f288cae721_29934766 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

														<div class="card">
															<div class="card-header" id="shopping-cart-summary-head">
																<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_39952362768e4f288cbc7e0_08932444', 'order_opc_rooms_summary_heading', $this->tplIndex);
?>

															</div>
															<?php if ($_smarty_tpl->tpl_vars['step']->value->step_is_reachable) {?>
																<div id="collapse-shopping-cart" class="opc-collapse <?php if (!$_smarty_tpl->tpl_vars['step']->value->step_is_current) {?>collapse<?php }?>" aria-labelledby="shopping-cart-head" data-parent="#oprder-opc-accordion">
																	<div class="card-body">
																																				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_82135951368e4f288ce7721_33224981', 'shopping_cart', $this->tplIndex);
?>

																	</div>
																</div>
															<?php }?>
														</div>
													<?php
}
}
/* {/block 'order_opc_rooms_summary'} */
/* {block 'order_opc_guest_information_heading'} */
class Block_141919575368e4f288d1b066_60307393 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																	<h5 class="accordion-header" data-toggle="collapse" data-target="#collapse-guest-info" aria-expanded="true" aria-controls="collapse-guest-info">
																		<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Guest Information'),$_smarty_tpl ) );?>
</span>
																		<i class="icon-angle-left pull-right accordion-left-arrow <?php if ($_smarty_tpl->tpl_vars['step']->value->step_is_current) {?>hidden<?php }?>"></i>
																	</h5>
																<?php
}
}
/* {/block 'order_opc_guest_information_heading'} */
/* {block 'order_opc_guest_detail_form'} */
class Block_116583871468e4f288d4e923_69649213 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

																						<form id="customer_guest_detail_form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order-opc',null,null);?>
">
																							<input type="hidden" name="submitGuestDetails" value="1">
																							<p class="checkbox">
																								<input type="checkbox" name="customer_guest_detail" id="customer_guest_detail" value="1" <?php if ($_smarty_tpl->tpl_vars['id_customer_guest_detail']->value) {?>checked="checked"<?php }?>/>
																								<label for="customer_guest_detail" id="customer_guest_detail_txt"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Booking for someone else?'),$_smarty_tpl ) );?>
</label>
																							</p>
																							<?php if ((isset($_smarty_tpl->tpl_vars['customerGuestDetailErrors']->value)) && $_smarty_tpl->tpl_vars['customerGuestDetailErrors']->value) {?>
																								<div class="alert alert-danger" id="customer_guest_detail_errors">
																									<p><?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['customerGuestDetailErrors']->value) > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There are %d errors','sprintf'=>smarty_modifier_count($_smarty_tpl->tpl_vars['customerGuestDetailErrors']->value)),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There is %d error','sprintf'=>smarty_modifier_count($_smarty_tpl->tpl_vars['customerGuestDetailErrors']->value)),$_smarty_tpl ) );
}?></p>
																									<ol>
																										<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customerGuestDetailErrors']->value, 'customerGuestDetailError', false, 'k');
$_smarty_tpl->tpl_vars['customerGuestDetailError']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['customerGuestDetailError']->value) {
$_smarty_tpl->tpl_vars['customerGuestDetailError']->do_else = false;
?>
																											<li><?php echo $_smarty_tpl->tpl_vars['customerGuestDetailError']->value;?>
</li>
																										<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
																									</ol>
																								</div>
																							<?php }?>
																							<div id="customer-guest-detail-container" <?php if (!$_smarty_tpl->tpl_vars['id_customer_guest_detail']->value) {?>style="display: none;"<?php }?>>
																								<div class="row">
																									<div class="required clearfix gender-line col-sm-2">
																										<label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Social title'),$_smarty_tpl ) );?>
</label>
																										<select name="customer_guest_detail_gender" id="customer_guest_detail_gender">
																											<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['genders']->value, 'gender', false, 'k');
$_smarty_tpl->tpl_vars['gender']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['gender']->value) {
$_smarty_tpl->tpl_vars['gender']->do_else = false;
?>
																												<option value="<?php echo $_smarty_tpl->tpl_vars['gender']->value->id_gender;?>
"<?php if ((isset($_POST['customer_guest_detail_gender'])) && $_POST['customer_guest_detail_gender'] == $_smarty_tpl->tpl_vars['gender']->value->id_gender || ((isset($_smarty_tpl->tpl_vars['customer_guest_detail']->value)) && $_smarty_tpl->tpl_vars['customer_guest_detail']->value['id_gender'] == $_smarty_tpl->tpl_vars['gender']->value->id_gender)) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['gender']->value->name;?>
</option>
																											<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
																										</select>
																									</div>
																									<div class="required form-group col-sm-5">
																										<label for="firstname"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
																										<input type="text" class="text form-control validate is_required" id="customer_guest_detail_firstname" name="customer_guest_detail_firstname" data-validate="isName" data-maxSize="32"<?php if ((isset($_POST['customer_guest_detail_firstname'])) && $_POST['customer_guest_detail_firstname']) {?>  value="<?php echo $_POST['customer_guest_detail_firstname'];?>
"<?php } elseif ((isset($_smarty_tpl->tpl_vars['customer_guest_detail']->value)) && $_smarty_tpl->tpl_vars['customer_guest_detail']->value['firstname']) {?> value="<?php echo $_smarty_tpl->tpl_vars['customer_guest_detail']->value['firstname'];?>
"<?php }?>/>
																									</div>
																									<div class="required form-group col-sm-5">
																										<label for="lastname"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
																										<input type="text" class="form-control validate is_required" id="customer_guest_detail_lastname" name="customer_guest_detail_lastname" data-validate="isName" data-maxSize="32"<?php if ((isset($_POST['customer_guest_detail_lastname'])) && $_POST['customer_guest_detail_lastname']) {?>  value="<?php echo $_POST['customer_guest_detail_lastname'];?>
"<?php } elseif ((isset($_smarty_tpl->tpl_vars['customer_guest_detail']->value)) && $_smarty_tpl->tpl_vars['customer_guest_detail']->value['lastname']) {?> value="<?php echo $_smarty_tpl->tpl_vars['customer_guest_detail']->value['lastname'];?>
"<?php }?>/>
																									</div>
																								</div>
																								<div class="row">
																									<div class="required text form-group col-sm-6">
																										<label for="email"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
																										<input type="email" class="text form-control validate is_required" id="customer_guest_detail_email" name="customer_guest_detail_email" data-validate="isEmail" data-maxSize="128"<?php if ((isset($_POST['customer_guest_detail_email'])) && $_POST['customer_guest_detail_email']) {?>  value="<?php echo $_POST['customer_guest_detail_email'];?>
"<?php } elseif ((isset($_smarty_tpl->tpl_vars['customer_guest_detail']->value)) && $_smarty_tpl->tpl_vars['customer_guest_detail']->value['email']) {?> value="<?php echo $_smarty_tpl->tpl_vars['customer_guest_detail']->value['email'];?>
"<?php }?>/>
																									</div>
																								</div>
																								<div class="row">
																									<div class="<?php if ((isset($_smarty_tpl->tpl_vars['one_phone_at_least']->value)) && $_smarty_tpl->tpl_vars['one_phone_at_least']->value) {?>required <?php }?>form-group col-sm-6">
																										<label for="phone_mobile"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mobile phone'),$_smarty_tpl ) );
if ((isset($_smarty_tpl->tpl_vars['one_phone_at_least']->value)) && $_smarty_tpl->tpl_vars['one_phone_at_least']->value) {?> <sup>**</sup><?php }?></label>
																										<input type="text" class="text form-control validate is_required" name="customer_guest_detail_phone" id="customer_guest_detail_phone" data-validate="isPhoneNumber" data-maxSize="32"<?php if ((isset($_POST['customer_guest_detail_phone'])) && $_POST['customer_guest_detail_phone']) {?>  value="<?php echo $_POST['customer_guest_detail_phone'];?>
"<?php } elseif ((isset($_smarty_tpl->tpl_vars['customer_guest_detail']->value)) && $_smarty_tpl->tpl_vars['customer_guest_detail']->value['phone']) {?> value="<?php echo $_smarty_tpl->tpl_vars['customer_guest_detail']->value['phone'];?>
"<?php }?>/>
																									</div>
																								</div>
																							</div>
																						</form>
																					<?php
}
}
/* {/block 'order_opc_guest_detail_form'} */
/* {block 'order_opc_guest_detail'} */
class Block_130669311068e4f288f1aee8_34753529 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																					<div id="checkout-guest-info-block"  <?php if ($_smarty_tpl->tpl_vars['id_customer_guest_detail']->value) {?>style="display: none;"<?php }?>>
																						<div class="row margin-btm-10">
																							<div class="col-sm-3 col-xs-5 info-head"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</div>
																							<div class="col-sm-9 col-xs-7 info-value">
																								<?php if ($_smarty_tpl->tpl_vars['isGuest']->value) {?>
																									<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['guestInformations']->value['customer_firstname'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['guestInformations']->value['customer_lastname'], ENT_QUOTES, 'UTF-8', true);?>

																								<?php } else { ?>
																									<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['guestInformations']->value['firstname'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['guestInformations']->value['lastname'], ENT_QUOTES, 'UTF-8', true);?>

																								<?php }?>
																							</div>
																						</div>
																						<div class="row margin-btm-10">
																							<div class="col-sm-3 col-xs-5 info-head"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email'),$_smarty_tpl ) );?>
</div>
																							<div class="col-sm-9 col-xs-7 info-value"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['guestInformations']->value['email'], ENT_QUOTES, 'UTF-8', true);?>
</div>
																						</div>
																						<?php ob_start();
echo $_smarty_tpl->tpl_vars['guestInformations']->value['phone'];
$_prefixVariable40 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['guestInformations']->value['phone'];
$_prefixVariable41 = ob_get_clean();
if (((isset($_prefixVariable40)) && $_prefixVariable41)) {?>
																							<div class="row margin-btm-10">
																								<div class="col-sm-3 col-xs-5 info-head">
																									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Phone Number'),$_smarty_tpl ) );?>

																								</div>
																								<div class="col-sm-9 col-xs-7 info-value">
																									<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['guestInformations']->value['phone'], ENT_QUOTES, 'UTF-8', true);?>

																								</div>
																							</div>
																						<?php }?>
																					</div>
																				<?php
}
}
/* {/block 'order_opc_guest_detail'} */
/* {block 'order_opc_guest_detail_proceed_action'} */
class Block_47012024768e4f289079a00_10950422 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																						<hr>
																						<div class="row">
																							<div class="col-sm-12 proceed_btn_block">
																								<a class="btn btn-default button button-medium pull-right submit-guest-details" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order-opc',null,null,array('proceed_to_payment'=>1));?>
" title="Proceed to Payment" rel="nofollow">
																									<span>
																										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Proceed'),$_smarty_tpl ) );?>

																									</span>
																								</a>
																								<?php if ($_smarty_tpl->tpl_vars['isGuest']->value) {?>
																									<a class="btn btn-default btn-edit-guest-info pull-right" href="#" rel="nofollow">
																										<span>
																											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit'),$_smarty_tpl ) );?>

																										</span>
																									</a>
																								<?php }?>
																							</div>
																						</div>
																					<?php
}
}
/* {/block 'order_opc_guest_detail_proceed_action'} */
/* {block 'order_opc_new_account'} */
class Block_60705296968e4f2890a4f49_07788765 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																					<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-opc-new-account.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
																				<?php
}
}
/* {/block 'order_opc_new_account'} */
/* {block 'order_opc_edit_guest_info'} */
class Block_187756684068e4f2890c7f35_10266636 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																					<?php $_smarty_tpl->_subTemplateRender("file:./order-opc-edit-guest-info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
																				<?php
}
}
/* {/block 'order_opc_edit_guest_info'} */
/* {block 'order_opc_guest_detail_wrapper'} */
class Block_13531700468e4f288d3a417_11051743 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																	<div id="collapse-guest-info" class="opc-collapse <?php if (!$_smarty_tpl->tpl_vars['step']->value->step_is_current) {?>collapse<?php }?>" aria-labelledby="guest-info-head" data-parent="#oprder-opc-accordion">
																		<div class="card-body">
																			<?php if ($_smarty_tpl->tpl_vars['is_logged']->value || $_smarty_tpl->tpl_vars['isGuest']->value) {?>
																				<?php if ($_smarty_tpl->tpl_vars['is_logged']->value) {?>
																					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_116583871468e4f288d4e923_69649213', 'order_opc_guest_detail_form', $this->tplIndex);
?>

																				<?php }?>
																				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_130669311068e4f288f1aee8_34753529', 'order_opc_guest_detail', $this->tplIndex);
?>


																																								<?php if (!$_smarty_tpl->tpl_vars['orderRestrictErr']->value) {?>
																					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_47012024768e4f289079a00_10950422', 'order_opc_guest_detail_proceed_action', $this->tplIndex);
?>

																				<?php }?>
																			<?php } else { ?>
																				<!-- Create account / Guest account / Login block -->
																				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_60705296968e4f2890a4f49_07788765', 'order_opc_new_account', $this->tplIndex);
?>

																			<?php }?>
																		</div>
																		<?php if ($_smarty_tpl->tpl_vars['is_logged']->value || $_smarty_tpl->tpl_vars['isGuest']->value) {?>
																			<div class="card-body hidden" id="order-opc-edit-guest-info">
																				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_187756684068e4f2890c7f35_10266636', 'order_opc_edit_guest_info', $this->tplIndex);
?>

																			</div>
																		<?php }?>
																	</div>
																<?php
}
}
/* {/block 'order_opc_guest_detail_wrapper'} */
/* {block 'order_opc_guest_information'} */
class Block_133368106768e4f288d0ed86_53664900 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

														<div class="card" id="guest-info-block">
															<div class="card-header" id="guest-info-head">
																<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_141919575368e4f288d1b066_60307393', 'order_opc_guest_information_heading', $this->tplIndex);
?>

															</div>
															<?php if ($_smarty_tpl->tpl_vars['step']->value->step_is_reachable) {?>
																<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13531700468e4f288d3a417_11051743', 'order_opc_guest_detail_wrapper', $this->tplIndex);
?>

															<?php }?>
														</div>
													<?php
}
}
/* {/block 'order_opc_guest_information'} */
/* {block 'order_opc_payment_heading'} */
class Block_31949571268e4f2890f4ae0_60014643 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																	<h5 class="accordion-header" data-toggle="collapse" data-target="#collapse-order-payment" aria-expanded="true" aria-controls="collapse-order-payment">
																		<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment Information'),$_smarty_tpl ) );?>
</span>
																		<i class="icon-angle-left pull-right accordion-left-arrow <?php if ($_smarty_tpl->tpl_vars['step']->value->step_is_current) {?>hidden<?php }?>"></i>
																	</h5>
																<?php
}
}
/* {/block 'order_opc_payment_heading'} */
/* {block 'order_payment'} */
class Block_39847162568e4f28910d6a9_79477394 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																			<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-payment.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
																		<?php
}
}
/* {/block 'order_payment'} */
/* {block 'order_opc_payment'} */
class Block_21295965668e4f2890f2756_39437455 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																												<div class="card">
															<div class="card-header" id="order-payment-head">
																<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_31949571268e4f2890f4ae0_60014643', 'order_opc_payment_heading', $this->tplIndex);
?>

															</div>
															<?php if ($_smarty_tpl->tpl_vars['step']->value->step_is_reachable) {?>
																<div id="collapse-order-payment" class="opc-collapse <?php if (!$_smarty_tpl->tpl_vars['step']->value->step_is_current) {?>collapse<?php }?>" aria-labelledby="order-payment-head" data-parent="#oprder-opc-accordion">
																	<div class="card-body">
																		<!-- Payment -->
																		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_39847162568e4f28910d6a9_79477394', 'order_payment', $this->tplIndex);
?>

																		<!-- END Payment -->
																	</div>
																</div>
															<?php }?>
														</div>
													<?php
}
}
/* {/block 'order_opc_payment'} */
/* {block 'order_opc_left_column'} */
class Block_162613569468e4f288c5c219_74757678 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<div class="col-md-8">
            						<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_197190546868e4f288c6dfd3_20465036', 'errors', $this->tplIndex);
?>


																		<div class="accordion" id="oprder-opc-accordion">
										<input type="hidden" name="opc_id_address_delivery" value="<?php echo $_smarty_tpl->tpl_vars['cart']->value->id_address_delivery;?>
" id="opc_id_address_delivery" />
										<input type="hidden" name="opc_id_address_invoice" value="<?php echo $_smarty_tpl->tpl_vars['cart']->value->id_address_invoice;?>
" id="opc_id_address_invoice" />
										<?php if ((isset($_smarty_tpl->tpl_vars['checkout_process_steps']->value)) && $_smarty_tpl->tpl_vars['checkout_process_steps']->value) {?>
											<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['checkout_process_steps']->value, 'step');
$_smarty_tpl->tpl_vars['step']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['step']->value) {
$_smarty_tpl->tpl_vars['step']->do_else = false;
?>
												<?php if ($_smarty_tpl->tpl_vars['step']->value->step_key == 'checkout_rooms_summary') {?>
													<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_117412700468e4f288cae721_29934766', 'order_opc_rooms_summary', $this->tplIndex);
?>

																								<?php } elseif ($_smarty_tpl->tpl_vars['step']->value->step_key == 'checkout_customer') {?>
													<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_133368106768e4f288d0ed86_53664900', 'order_opc_guest_information', $this->tplIndex);
?>

												<?php } elseif ($_smarty_tpl->tpl_vars['step']->value->step_key == 'checkout_payment') {?>
													<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21295965668e4f2890f2756_39437455', 'order_opc_payment', $this->tplIndex);
?>

												<?php }?>
											<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
										<?php }?>
									</div>
								</div>
							<?php
}
}
/* {/block 'order_opc_left_column'} */
/* {block 'order_opc_cart_total_detail'} */
class Block_119365838868e4f2891365a6_11403313 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																				<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./cart-total-block.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
									<?php
}
}
/* {/block 'order_opc_cart_total_detail'} */
/* {block 'order_opc_vouchers'} */
class Block_42625514868e4f289146c33_02508364 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																				<?php if ($_smarty_tpl->tpl_vars['voucherAllowed']->value) {?>
																						<div class="col-sm-12 card cart_voucher_detail_block">
												<p class="cart_voucher_head"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Apply Coupon'),$_smarty_tpl ) );?>
</p>
												<p><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Have promocode ?'),$_smarty_tpl ) );?>
</span></p>
																								<?php if (sizeof($_smarty_tpl->tpl_vars['discounts']->value)) {?>
													<div class="row">
														<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['discounts']->value, 'discount', true);
$_smarty_tpl->tpl_vars['discount']->iteration = 0;
$_smarty_tpl->tpl_vars['discount']->index = -1;
$_smarty_tpl->tpl_vars['discount']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['discount']->value) {
$_smarty_tpl->tpl_vars['discount']->do_else = false;
$_smarty_tpl->tpl_vars['discount']->iteration++;
$_smarty_tpl->tpl_vars['discount']->index++;
$_smarty_tpl->tpl_vars['discount']->first = !$_smarty_tpl->tpl_vars['discount']->index;
$_smarty_tpl->tpl_vars['discount']->last = $_smarty_tpl->tpl_vars['discount']->iteration === $_smarty_tpl->tpl_vars['discount']->total;
$__foreach_discount_127_saved = $_smarty_tpl->tpl_vars['discount'];
?>
															<div class="col-sm-12 margin-btm-10 cart_discount <?php if ($_smarty_tpl->tpl_vars['discount']->last) {?>last_item<?php } elseif ($_smarty_tpl->tpl_vars['discount']->first) {?>first_item<?php } else { ?>item<?php }?>" id="cart_discount_<?php echo $_smarty_tpl->tpl_vars['discount']->value['id_discount'];?>
">
																<span class="cart_discount_name">
																	<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['discount']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

																	<?php if (strlen($_smarty_tpl->tpl_vars['discount']->value['code'])) {?>
																		<a
																			href="<?php if ($_smarty_tpl->tpl_vars['opc']->value) {
echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order-opc',true);
} else {
echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true);
}?>?deleteDiscount=<?php echo $_smarty_tpl->tpl_vars['discount']->value['id_discount'];?>
"
																			class="price_discount_delete pull-right"
																			title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete'),$_smarty_tpl ) );?>
">
																			<i class="icon-times"></i>
																		</a>
																	<?php }?>
																</span>
																<span class="voucher_apply_state pull-right">
																	<img src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
/icon/form-ok-circle.svg" /> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Applied'),$_smarty_tpl ) );?>

																</span>
															</div>
														<?php
$_smarty_tpl->tpl_vars['discount'] = $__foreach_discount_127_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
													</div>
													<hr class="seperator">
												<?php }?>
												<div class="row margin-btm-20">
																										<form action="<?php if ($_smarty_tpl->tpl_vars['opc']->value) {
echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order-opc',true);
} else {
echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true);
}?>" method="post" id="voucher">
														<div class="col-sm-8 col-xs-12 col-md-12 col-lg-8">
															<input type="text" class="discount_name form-control" id="discount_name" name="discount_name" value="<?php if ((isset($_smarty_tpl->tpl_vars['discount_name']->value)) && $_smarty_tpl->tpl_vars['discount_name']->value) {
echo $_smarty_tpl->tpl_vars['discount_name']->value;
}?>" />
															<input type="hidden" name="submitDiscount" />
														</div>
														<div class="col-sm-4 col-xs-12 col-md-12 col-lg-4 submit_discount_div">
															<button type="submit" name="submitAddDiscount" class="opc-button-small opc-btn-primary">
																<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Apply'),$_smarty_tpl ) );?>
</span>
															</button>
														</div>
													</form>
												</div>

																								<?php if ($_smarty_tpl->tpl_vars['displayVouchers']->value) {?>
													<p class="cart_voucher_head"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Available Coupons'),$_smarty_tpl ) );?>
</p>
													<div class="row avail_vouchers_block">
														<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['displayVouchers']->value, 'voucher', false, 'key', 'availVoucher', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['voucher']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['voucher']->value) {
$_smarty_tpl->tpl_vars['voucher']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_availVoucher']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_availVoucher']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_availVoucher']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_availVoucher']->value['total'];
?>
															<div class="col-xs-12">
																<p class="avail_voucher_name">
																<span class="voucher_name" data-code="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['voucher']->value['code'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['voucher']->value['code'], ENT_QUOTES, 'UTF-8', true);?>
 -</span>&nbsp;<?php echo $_smarty_tpl->tpl_vars['voucher']->value['name'];?>

																</p>
																<?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_availVoucher']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_availVoucher']->value['last'] : null)) {?>
																	<hr class="seperator">
																<?php }?>
															</div>
														<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
													</div>
												<?php }?>
											</div>
										<?php }?>
																			<?php
}
}
/* {/block 'order_opc_vouchers'} */
/* {block 'displayCartRightColumn'} */
class Block_180969119268e4f28923a2d9_45199192 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayCartRightColumn"),$_smarty_tpl ) );?>

									<?php
}
}
/* {/block 'displayCartRightColumn'} */
/* {block 'order_opc_right_column'} */
class Block_52017974168e4f289134341_48928521 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<div class="col-md-4">
									<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_119365838868e4f2891365a6_11403313', 'order_opc_cart_total_detail', $this->tplIndex);
?>

									<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_42625514868e4f289146c33_02508364', 'order_opc_vouchers', $this->tplIndex);
?>

									<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_180969119268e4f28923a2d9_45199192', 'displayCartRightColumn', $this->tplIndex);
?>

								</div>
							<?php
}
}
/* {/block 'order_opc_right_column'} */
/* {block 'order_opc_heading'} */
class Block_132736871668e4f2892592c5_49558880 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<h2 class="page-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your booking cart'),$_smarty_tpl ) );?>
</h2>
							<?php
}
}
/* {/block 'order_opc_heading'} */
/* {block 'errors'} */
class Block_178049065768e4f289266fa9_25555490 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
							<?php
}
}
/* {/block 'errors'} */
/* {block 'order_opc_js_vars'} */
class Block_127485620368e4f289279f33_90049554 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('imgDir'=>$_smarty_tpl->tpl_vars['img_dir']->value),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('authenticationUrl'=>preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['link']->value->getPageLink("authentication",true))),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('orderOpcUrl'=>preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['link']->value->getPageLink("order-opc",true))),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('guestTrackingUrl'=>preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['link']->value->getPageLink("guest-tracking",true))),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('addressUrl'=>preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['link']->value->getPageLink("address",true,NULL,"back=".((string)$_smarty_tpl->tpl_vars['back_order_page']->value)))),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('orderProcess'=>'order-opc'),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('guestCheckoutEnabled'=>intval($_smarty_tpl->tpl_vars['PS_GUEST_CHECKOUT_ENABLED']->value)),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('displayPrice'=>$_smarty_tpl->tpl_vars['priceDisplay']->value),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('taxEnabled'=>$_smarty_tpl->tpl_vars['use_taxes']->value),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('conditionEnabled'=>intval($_smarty_tpl->tpl_vars['conditions']->value)),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('errorCarrier'=>addcslashes($_smarty_tpl->tpl_vars['errorCarrier']->value,'\'')),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('errorTOS'=>addcslashes($_smarty_tpl->tpl_vars['errorTOS']->value,'\'')),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('checkedCarrier'=>intval($_smarty_tpl->tpl_vars['checked']->value)),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('addresses'=>array()),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('isVirtualCart'=>intval($_smarty_tpl->tpl_vars['isVirtualCart']->value)),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('isPaymentStep'=>intval($_smarty_tpl->tpl_vars['isPaymentStep']->value)),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('PS_REGISTRATION_PROCESS_TYPE'=>intval($_smarty_tpl->tpl_vars['PS_REGISTRATION_PROCESS_TYPE']->value)),$_smarty_tpl ) );
$_block_plugin103 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin103, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtWithTax'));
$_block_repeat=true;
echo $_block_plugin103->addJsDefL(array('name'=>'txtWithTax'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax incl.)','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin103->addJsDefL(array('name'=>'txtWithTax'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin104 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin104, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtWithoutTax'));
$_block_repeat=true;
echo $_block_plugin104->addJsDefL(array('name'=>'txtWithoutTax'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax excl.)','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin104->addJsDefL(array('name'=>'txtWithoutTax'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin105 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin105, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtHasBeenSelected'));
$_block_repeat=true;
echo $_block_plugin105->addJsDefL(array('name'=>'txtHasBeenSelected'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'has been selected','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin105->addJsDefL(array('name'=>'txtHasBeenSelected'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin106 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin106, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtNoCarrierIsSelected'));
$_block_repeat=true;
echo $_block_plugin106->addJsDefL(array('name'=>'txtNoCarrierIsSelected'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No carrier has been selected','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin106->addJsDefL(array('name'=>'txtNoCarrierIsSelected'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin107 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin107, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtNoCarrierIsNeeded'));
$_block_repeat=true;
echo $_block_plugin107->addJsDefL(array('name'=>'txtNoCarrierIsNeeded'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No carrier is needed for this order','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin107->addJsDefL(array('name'=>'txtNoCarrierIsNeeded'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin108 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin108, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtConditionsIsNotNeeded'));
$_block_repeat=true;
echo $_block_plugin108->addJsDefL(array('name'=>'txtConditionsIsNotNeeded'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You do not need to accept the Terms of Service for this order.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin108->addJsDefL(array('name'=>'txtConditionsIsNotNeeded'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin109 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin109, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtTOSIsAccepted'));
$_block_repeat=true;
echo $_block_plugin109->addJsDefL(array('name'=>'txtTOSIsAccepted'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The service terms have been accepted','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin109->addJsDefL(array('name'=>'txtTOSIsAccepted'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin110 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin110, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtTOSIsNotAccepted'));
$_block_repeat=true;
echo $_block_plugin110->addJsDefL(array('name'=>'txtTOSIsNotAccepted'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The service terms have not been accepted','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin110->addJsDefL(array('name'=>'txtTOSIsNotAccepted'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin111 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin111, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtThereis'));
$_block_repeat=true;
echo $_block_plugin111->addJsDefL(array('name'=>'txtThereis'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There is','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin111->addJsDefL(array('name'=>'txtThereis'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin112 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin112, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtErrors'));
$_block_repeat=true;
echo $_block_plugin112->addJsDefL(array('name'=>'txtErrors'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Error(s)','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin112->addJsDefL(array('name'=>'txtErrors'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin113 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin113, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtDeliveryAddress'));
$_block_repeat=true;
echo $_block_plugin113->addJsDefL(array('name'=>'txtDeliveryAddress'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delivery address','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin113->addJsDefL(array('name'=>'txtDeliveryAddress'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin114 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin114, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtInvoiceAddress'));
$_block_repeat=true;
echo $_block_plugin114->addJsDefL(array('name'=>'txtInvoiceAddress'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invoice address','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin114->addJsDefL(array('name'=>'txtInvoiceAddress'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin115 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin115, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtModifyMyAddress'));
$_block_repeat=true;
echo $_block_plugin115->addJsDefL(array('name'=>'txtModifyMyAddress'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Modify my address','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin115->addJsDefL(array('name'=>'txtModifyMyAddress'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin116 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin116, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtInstantCheckout'));
$_block_repeat=true;
echo $_block_plugin116->addJsDefL(array('name'=>'txtInstantCheckout'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Instant checkout','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin116->addJsDefL(array('name'=>'txtInstantCheckout'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin117 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin117, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtSelectAnAddressFirst'));
$_block_repeat=true;
echo $_block_plugin117->addJsDefL(array('name'=>'txtSelectAnAddressFirst'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please start by selecting an address.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin117->addJsDefL(array('name'=>'txtSelectAnAddressFirst'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin118 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin118, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtFree'));
$_block_repeat=true;
echo $_block_plugin118->addJsDefL(array('name'=>'txtFree'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Free','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin118->addJsDefL(array('name'=>'txtFree'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', null, null);
if ($_smarty_tpl->tpl_vars['back']->value) {?>&mod=<?php echo urlencode($_smarty_tpl->tpl_vars['back']->value);
}
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'addressUrl', null, null);
echo preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('address',true,NULL,((('back=').($_smarty_tpl->tpl_vars['back_order_page']->value)).('?step=1')).($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'default'))));
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('addressUrl'=>$_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'addressUrl')),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', null, null);
echo urlencode('&multi-shipping=1');
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('addressMultishippingUrl'=>($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'addressUrl')).($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'default'))),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'addressUrlAdd', null, null);
echo ($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'addressUrl')).('&id_address=');
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('addressUrlAdd'=>$_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'addressUrlAdd')),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('opc'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'boolval' ][ 0 ], array( $_smarty_tpl->tpl_vars['opc']->value ))),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', null, null);?><h3 class="page-subheading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your billing address','js'=>1),$_smarty_tpl ) );?>
</h3><?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
$_block_plugin119 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin119, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'titleInvoice'));
$_block_repeat=true;
echo $_block_plugin119->addJsDefL(array('name'=>'titleInvoice'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo addcslashes($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'default'),'\'');
$_block_repeat=false;
echo $_block_plugin119->addJsDefL(array('name'=>'titleInvoice'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', null, null);?><h3 class="page-subheading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your delivery address','js'=>1),$_smarty_tpl ) );?>
</h3><?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
$_block_plugin120 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin120, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'titleDelivery'));
$_block_repeat=true;
echo $_block_plugin120->addJsDefL(array('name'=>'titleDelivery'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo addcslashes($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'default'),'\'');
$_block_repeat=false;
echo $_block_plugin120->addJsDefL(array('name'=>'titleDelivery'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', null, null);?><a class="button button-small btn btn-default" href="<?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'addressUrlAdd');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Update','js'=>1),$_smarty_tpl ) );?>
"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Update','js'=>1),$_smarty_tpl ) );?>
<i class="icon-chevron-right right"></i></span></a><?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
$_block_plugin121 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin121, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'liUpdate'));
$_block_repeat=true;
echo $_block_plugin121->addJsDefL(array('name'=>'liUpdate'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo addcslashes($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'default'),'\'');
$_block_repeat=false;
echo $_block_plugin121->addJsDefL(array('name'=>'liUpdate'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin122 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin122, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtExtraDemandSucc'));
$_block_repeat=true;
echo $_block_plugin122->addJsDefL(array('name'=>'txtExtraDemandSucc'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Updated Successfully','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin122->addJsDefL(array('name'=>'txtExtraDemandSucc'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin123 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin123, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtMaxQuantityAdded'));
$_block_repeat=true;
echo $_block_plugin123->addJsDefL(array('name'=>'txtMaxQuantityAdded'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Maximum quantity of service added','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin123->addJsDefL(array('name'=>'txtMaxQuantityAdded'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin124 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin124, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtExtraDemandErr'));
$_block_repeat=true;
echo $_block_plugin124->addJsDefL(array('name'=>'txtExtraDemandErr'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Some error occurred while updating demands','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin124->addJsDefL(array('name'=>'txtExtraDemandErr'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
						<?php
}
}
/* {/block 'order_opc_js_vars'} */
/* {block 'order_opc'} */
class Block_5161370368e4f288c12a30_07986986 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_opc' => 
  array (
    0 => 'Block_5161370368e4f288c12a30_07986986',
  ),
  'order_opc_heading' => 
  array (
    0 => 'Block_173062148868e4f288c48320_25650323',
    1 => 'Block_132736871668e4f2892592c5_49558880',
  ),
  'order_opc_left_column' => 
  array (
    0 => 'Block_162613569468e4f288c5c219_74757678',
  ),
  'errors' => 
  array (
    0 => 'Block_197190546868e4f288c6dfd3_20465036',
    1 => 'Block_178049065768e4f289266fa9_25555490',
  ),
  'order_opc_rooms_summary' => 
  array (
    0 => 'Block_117412700468e4f288cae721_29934766',
  ),
  'order_opc_rooms_summary_heading' => 
  array (
    0 => 'Block_39952362768e4f288cbc7e0_08932444',
  ),
  'shopping_cart' => 
  array (
    0 => 'Block_82135951368e4f288ce7721_33224981',
  ),
  'order_opc_guest_information' => 
  array (
    0 => 'Block_133368106768e4f288d0ed86_53664900',
  ),
  'order_opc_guest_information_heading' => 
  array (
    0 => 'Block_141919575368e4f288d1b066_60307393',
  ),
  'order_opc_guest_detail_wrapper' => 
  array (
    0 => 'Block_13531700468e4f288d3a417_11051743',
  ),
  'order_opc_guest_detail_form' => 
  array (
    0 => 'Block_116583871468e4f288d4e923_69649213',
  ),
  'order_opc_guest_detail' => 
  array (
    0 => 'Block_130669311068e4f288f1aee8_34753529',
  ),
  'order_opc_guest_detail_proceed_action' => 
  array (
    0 => 'Block_47012024768e4f289079a00_10950422',
  ),
  'order_opc_new_account' => 
  array (
    0 => 'Block_60705296968e4f2890a4f49_07788765',
  ),
  'order_opc_edit_guest_info' => 
  array (
    0 => 'Block_187756684068e4f2890c7f35_10266636',
  ),
  'order_opc_payment' => 
  array (
    0 => 'Block_21295965668e4f2890f2756_39437455',
  ),
  'order_opc_payment_heading' => 
  array (
    0 => 'Block_31949571268e4f2890f4ae0_60014643',
  ),
  'order_payment' => 
  array (
    0 => 'Block_39847162568e4f28910d6a9_79477394',
  ),
  'order_opc_right_column' => 
  array (
    0 => 'Block_52017974168e4f289134341_48928521',
  ),
  'order_opc_cart_total_detail' => 
  array (
    0 => 'Block_119365838868e4f2891365a6_11403313',
  ),
  'order_opc_vouchers' => 
  array (
    0 => 'Block_42625514868e4f289146c33_02508364',
  ),
  'displayCartRightColumn' => 
  array (
    0 => 'Block_180969119268e4f28923a2d9_45199192',
  ),
  'order_opc_js_vars' => 
  array (
    0 => 'Block_127485620368e4f289279f33_90049554',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ($_smarty_tpl->tpl_vars['opc']->value) {?>
		<?php $_smarty_tpl->_assignInScope('back_order_page', "order-opc.php");?>
		<?php } else { ?>
		<?php $_smarty_tpl->_assignInScope('back_order_page', "order.php");?>
	<?php }?>

	<section id="wrapper">
		<div class="container">
			<section id="content">
				<div class="row">
					<?php if ($_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
						<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your booking cart'),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
						<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_173062148868e4f288c48320_25650323', 'order_opc_heading', $this->tplIndex);
?>


						<p class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The hotel is currently not accepting any bookings.'),$_smarty_tpl ) );?>
</p>
					<?php } else { ?>
						<?php if ($_smarty_tpl->tpl_vars['productNumber']->value) {?>

							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_162613569468e4f288c5c219_74757678', 'order_opc_left_column', $this->tplIndex);
?>

							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_52017974168e4f289134341_48928521', 'order_opc_right_column', $this->tplIndex);
?>

						<?php } else { ?>
							<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your booking cart'),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_132736871668e4f2892592c5_49558880', 'order_opc_heading', $this->tplIndex);
?>

							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_178049065768e4f289266fa9_25555490', 'errors', $this->tplIndex);
?>


							<p class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You have not added any rooms or products to your cart yet.'),$_smarty_tpl ) );?>
</p>
						<?php }?>
						<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_127485620368e4f289279f33_90049554', 'order_opc_js_vars', $this->tplIndex);
?>

					<?php }?>
				</div>
			</section>
		</div>
	</section>
<?php
}
}
/* {/block 'order_opc'} */
}
