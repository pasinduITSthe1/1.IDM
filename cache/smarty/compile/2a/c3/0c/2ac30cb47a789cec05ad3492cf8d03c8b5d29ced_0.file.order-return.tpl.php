<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:22
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\order-return.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f28a6abd61_85151616',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2ac30cb47a789cec05ad3492cf8d03c8b5d29ced' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\order-return.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./errors.tpl' => 1,
  ),
),false)) {
function content_68e4f28a6abd61_85151616 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_111767125568e4f28a299928_48094636', 'order_return');
?>

<?php }
/* {block 'errors'} */
class Block_191804704068e4f28a2e7651_06335743 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_smarty_tpl->_subTemplateRender("file:./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	<?php
}
}
/* {/block 'errors'} */
/* {block 'order_return_heading'} */
class Block_99764308568e4f28a2f8647_25730604 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<h1 class="page-heading bottom-indent">
				<i class="icon-tasks"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refund Requests'),$_smarty_tpl ) );?>

			</h1>
		<?php
}
}
/* {/block 'order_return_heading'} */
/* {block 'order_return_detail'} */
class Block_103016656068e4f28a30a013_72859371 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

			<?php if ($_smarty_tpl->tpl_vars['refundReqBookings']->value) {?>
                <?php if ((isset($_smarty_tpl->tpl_vars['refundReqProducts']->value)) && $_smarty_tpl->tpl_vars['refundReqProducts']->value) {?>
                    <h1 class="page-subheading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rooms refund requests'),$_smarty_tpl ) );?>
</h1>
                <?php }?>
				<div class="table-responsive wk-datatable-wrapper">
					<table class="table table-bordered">
						<tr>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rooms'),$_smarty_tpl ) );?>
</th>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room type'),$_smarty_tpl ) );?>
</th>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hotel'),$_smarty_tpl ) );?>
</th>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duration'),$_smarty_tpl ) );?>
</th>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total rooms price (tax incl.)'),$_smarty_tpl ) );?>
</th>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Extra services price (tax incl.)'),$_smarty_tpl ) );?>
</th>
							<?php if ($_smarty_tpl->tpl_vars['isRefundCompleted']->value) {?>
								<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refund amount'),$_smarty_tpl ) );?>
</th>
								<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refund Status'),$_smarty_tpl ) );?>
</th>
							<?php }?>
						</tr>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['refundReqBookings']->value, 'booking', false, NULL, 'refundRequest', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['booking']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['booking']->value) {
$_smarty_tpl->tpl_vars['booking']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_refundRequest']->value['iteration']++;
?>
							<tr>
								<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room'),$_smarty_tpl ) );?>
 - <?php echo sprintf('%02d',(isset($_smarty_tpl->tpl_vars['__smarty_foreach_refundRequest']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_refundRequest']->value['iteration'] : null));?>
</td>
								<td><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['booking']->value['room_type_name'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</td>
								<td><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['booking']->value['hotel_name'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</td>
								<?php $_smarty_tpl->_assignInScope('is_full_date', ($_smarty_tpl->tpl_vars['show_full_date']->value && (smarty_modifier_date_format($_smarty_tpl->tpl_vars['booking']->value['date_from'],'%D') == smarty_modifier_date_format($_smarty_tpl->tpl_vars['booking']->value['date_to'],'%D'))));?>
								<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['booking']->value['date_from'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To'),$_smarty_tpl ) );?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['booking']->value['date_to'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>
</td>
								<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['booking']->value['total_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value['id']),$_smarty_tpl ) );?>
</td>
								<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['booking']->value['extra_service_total_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value['id']),$_smarty_tpl ) );?>
</td>
								<?php if ($_smarty_tpl->tpl_vars['isRefundCompleted']->value) {?>
									<td>
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['booking']->value['refunded_amount'],'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value['id']),$_smarty_tpl ) );?>

									</td>
									<td>
										<?php if ($_smarty_tpl->tpl_vars['booking']->value['is_cancelled']) {?>
											<span class="badge badge-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancelled','mod'=>'hotelreservationsystem'),$_smarty_tpl ) );?>
</span>
																				<?php } elseif ($_smarty_tpl->tpl_vars['booking']->value['id_customization']) {?>
											<span class="badge badge-success"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refunded','mod'=>'hotelreservationsystem'),$_smarty_tpl ) );?>
</span>
										<?php } else { ?>
											<span class="badge badge-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Denied','mod'=>'hotelreservationsystem'),$_smarty_tpl ) );?>
</span>
										<?php }?>
									</td>
								<?php }?>
							</tr>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</table>
				</div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['refundReqProducts']->value) {?>
                <h1 class="page-subheading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Products refund requests'),$_smarty_tpl ) );?>
</h1>
				<div class="table-responsive wk-datatable-wrapper">
					<table class="table table-bordered">
						<tr>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product name'),$_smarty_tpl ) );?>
</th>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity'),$_smarty_tpl ) );?>
</th>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total price (tax incl.)'),$_smarty_tpl ) );?>
</th>
							<?php if ($_smarty_tpl->tpl_vars['isRefundCompleted']->value) {?>
								<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refund amount'),$_smarty_tpl ) );?>
</th>
								<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refund Status'),$_smarty_tpl ) );?>
</th>
							<?php }?>
						</tr>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['refundReqProducts']->value, 'product', false, NULL, 'refundRequest', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_refundRequest']->value['iteration']++;
?>
							<tr>
								<td><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['product']->value['name'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);
if ((isset($_smarty_tpl->tpl_vars['product']->value['option_name'])) && $_smarty_tpl->tpl_vars['product']->value['option_name']) {?> : <?php echo $_smarty_tpl->tpl_vars['product']->value['option_name'];
}?></td>
								<td><?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {
echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['product']->value['quantity'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);
} else { ?>--<?php }?></td>
								<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value['id']),$_smarty_tpl ) );?>
</td>
								<?php if ($_smarty_tpl->tpl_vars['isRefundCompleted']->value) {?>
									<td>
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['refunded_amount'],'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value['id']),$_smarty_tpl ) );?>

									</td>
									<td>
										<?php if ($_smarty_tpl->tpl_vars['product']->value['is_cancelled']) {?>
											<span class="badge badge-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancelled','mod'=>'hotelreservationsystem'),$_smarty_tpl ) );?>
</span>
																				<?php } elseif ($_smarty_tpl->tpl_vars['product']->value['id_customization']) {?>
											<span class="badge badge-success"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refunded','mod'=>'hotelreservationsystem'),$_smarty_tpl ) );?>
</span>
										<?php } else { ?>
											<span class="badge badge-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Denied','mod'=>'hotelreservationsystem'),$_smarty_tpl ) );?>
</span>
										<?php }?>
									</td>
								<?php }?>
							</tr>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</table>
				</div>
			<?php }?>
		<?php
}
}
/* {/block 'order_return_detail'} */
/* {block 'order_return_current_status'} */
class Block_92240205668e4f28a5113b3_01830868 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

			<div class="form-group row">
				<div class="col-md-2 col-sm-3">
					<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Current refund state'),$_smarty_tpl ) );?>
 </strong>
				</div>
				<div class="col-sm-9 col-md-10">
						<span class="badge wk-badge" style="background-color:<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['currentStateInfo']->value['color'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['currentStateInfo']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

					</span>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-2 col-sm-3">
					<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Way of payment'),$_smarty_tpl ) );?>
 </strong>
				</div>
				<div class="col-sm-9 col-md-10">
					<?php if ($_smarty_tpl->tpl_vars['orderInfo']->value['is_advance_payment']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Advance Payment'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Full Payment'),$_smarty_tpl ) );
}?>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-2 col-sm-3">
					<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total order amount'),$_smarty_tpl ) );?>
 </strong>
				</div>
				<div class="col-sm-9 col-md-10">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['orderInfo']->value['total_paid_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['orderInfo']->value['id_currency']),$_smarty_tpl ) );?>

				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-2 col-sm-3">
					<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Request date'),$_smarty_tpl ) );?>
 </strong>
				</div>
				<div class="col-sm-9 col-md-10">
					<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['orderReturnInfo']->value['date_add'],"%d-%m-%Y %I:%M %p");?>

				</div>
			</div>

			<?php if ($_smarty_tpl->tpl_vars['currentStateInfo']->value['refunded']) {?>
				<div class="form-group row">
					<div class="col-md-2 col-sm-3">
						<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refunded amount','mod'=>'hotelreservationsystem'),$_smarty_tpl ) );?>
</strong>
					</div>
					<div class="col-sm-9 col-md-10">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['orderReturnInfo']->value['refunded_amount'],'currency'=>$_smarty_tpl->tpl_vars['orderInfo']->value['id_currency']),$_smarty_tpl ) );?>

					</div>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['orderReturnInfo']->value['payment_mode'] != '' && $_smarty_tpl->tpl_vars['orderReturnInfo']->value['id_transaction'] != '') {?>
					<div class="form-group row">
						<div class="col-md-2 col-sm-3">
							<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment mode','mod'=>'hotelreservationsystem'),$_smarty_tpl ) );?>
</strong>
						</div>
						<div class="col-sm-9 col-md-10">
							<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['orderReturnInfo']->value['payment_mode'], ENT_QUOTES, 'UTF-8', true);?>

						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2 col-sm-3">
							<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Transaction ID','mod'=>'hotelreservationsystem'),$_smarty_tpl ) );?>
</strong>
						</div>
						<div class="col-sm-9 col-md-10">
							<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['orderReturnInfo']->value['id_transaction'], ENT_QUOTES, 'UTF-8', true);?>

						</div>
					</div>
				<?php }?>
				<?php if ((isset($_smarty_tpl->tpl_vars['orderReturnInfo']->value['return_type']))) {?>
					<?php if ($_smarty_tpl->tpl_vars['orderReturnInfo']->value['return_type'] == OrderReturn::RETURN_TYPE_CART_RULE) {?>
						<div class="form-group row">
							<div class="col-md-2 col-sm-3">
								<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Voucher','mod'=>'hotelreservationsystem'),$_smarty_tpl ) );?>
</strong>
							</div>
							<div class="col-sm-9 col-md-10">
								<a class="link" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('discount');?>
" target="_blank">
									<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['voucher']->value, ENT_QUOTES, 'UTF-8', true);?>

								</a>
							</div>
						</div>
					<?php } elseif ($_smarty_tpl->tpl_vars['orderReturnInfo']->value['return_type'] == OrderReturn::RETURN_TYPE_ORDER_SLIP) {?>
						<div class="form-group row">
							<div class="col-md-2 col-sm-3">
								<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Credit Slip','mod'=>'hotelreservationsystem'),$_smarty_tpl ) );?>
</strong>
							</div>
							<div class="col-sm-9 col-md-10">
								<a class="link" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order-slip');?>
" target="_blank">
									#<?php echo Configuration::get('PS_CREDIT_SLIP_PREFIX',$_smarty_tpl->tpl_vars['lang_id']->value);
echo sprintf("%06d",$_smarty_tpl->tpl_vars['orderReturnInfo']->value['id_return_type']);?>

								</a>
							</div>
						</div>
					<?php }?>
				<?php }?>
			<?php }?>
		<?php
}
}
/* {/block 'order_return_current_status'} */
/* {block 'order_return_footer_links'} */
class Block_71624992168e4f28a661f37_71300362 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<ul class="footer_links clearfix">
			<li><a class="btn btn-default button button-small" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
"><span><i class="icon-chevron-left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Back to your account'),$_smarty_tpl ) );?>
</span></a></li>
			<li><a class="btn btn-default button button-small" href="<?php if ((isset($_smarty_tpl->tpl_vars['force_ssl']->value)) && $_smarty_tpl->tpl_vars['force_ssl']->value) {
echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;
} else {
echo $_smarty_tpl->tpl_vars['base_dir']->value;
}?>"><span><i class="icon-chevron-left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Home'),$_smarty_tpl ) );?>
</span></a></li>
		</ul>
	<?php
}
}
/* {/block 'order_return_footer_links'} */
/* {block 'order_return'} */
class Block_111767125568e4f28a299928_48094636 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_return' => 
  array (
    0 => 'Block_111767125568e4f28a299928_48094636',
  ),
  'errors' => 
  array (
    0 => 'Block_191804704068e4f28a2e7651_06335743',
  ),
  'order_return_heading' => 
  array (
    0 => 'Block_99764308568e4f28a2f8647_25730604',
  ),
  'order_return_detail' => 
  array (
    0 => 'Block_103016656068e4f28a30a013_72859371',
  ),
  'order_return_current_status' => 
  array (
    0 => 'Block_92240205668e4f28a5113b3_01830868',
  ),
  'order_return_footer_links' => 
  array (
    0 => 'Block_71624992168e4f28a661f37_71300362',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);?>
		<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My account'),$_smarty_tpl ) );?>

		</a>
		<span class="navigation-pipe">
			<?php echo $_smarty_tpl->tpl_vars['navigationPipe']->value;?>

		</span>
		<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('order-follow',true), ENT_QUOTES, 'UTF-8', true);?>
">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refund requests'),$_smarty_tpl ) );?>

		</a>
		<span class="navigation-pipe">
			<?php echo $_smarty_tpl->tpl_vars['navigationPipe']->value;?>

		</span>
		<span class="navigation_page">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refund detail'),$_smarty_tpl ) );?>

		</span>
	<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_191804704068e4f28a2e7651_06335743', 'errors', $this->tplIndex);
?>

	<div class="panel card">
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_99764308568e4f28a2f8647_25730604', 'order_return_heading', $this->tplIndex);
?>

		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_103016656068e4f28a30a013_72859371', 'order_return_detail', $this->tplIndex);
?>


		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_92240205668e4f28a5113b3_01830868', 'order_return_current_status', $this->tplIndex);
?>

	</div>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_71624992168e4f28a661f37_71300362', 'order_return_footer_links', $this->tplIndex);
?>

<?php
}
}
/* {/block 'order_return'} */
}
