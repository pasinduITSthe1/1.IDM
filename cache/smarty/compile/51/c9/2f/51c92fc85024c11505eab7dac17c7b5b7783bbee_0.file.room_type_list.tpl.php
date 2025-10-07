<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:32
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\_partials\room_type_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2946e6076_27786534',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51c92fc85024c11505eab7dac17c7b5b7783bbee' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\_partials\\room_type_list.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./occupancy_field.tpl' => 1,
    'file:./quantity_field.tpl' => 1,
  ),
),false)) {
function content_68e4f2946e6076_27786534 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_125620174968e4f294243df3_28787660', 'displayRoomTypeListBefore');
?>

<?php if (!empty($_smarty_tpl->tpl_vars['booking_data']->value['rm_data']) && ((isset($_smarty_tpl->tpl_vars['booking_data']->value['stats'])) && $_smarty_tpl->tpl_vars['booking_data']->value['stats']['num_avail'] || !empty($_smarty_tpl->tpl_vars['display_all_room_types']->value))) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['booking_data']->value['rm_data'], 'room_v', false, 'room_k');
$_smarty_tpl->tpl_vars['room_v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['room_k']->value => $_smarty_tpl->tpl_vars['room_v']->value) {
$_smarty_tpl->tpl_vars['room_v']->do_else = false;
?>
		<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['room_v']->value['data']['available']) || !empty($_smarty_tpl->tpl_vars['display_all_room_types']->value)) {?>
			<div class="col-sm-12 room_cont" data-id-product="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['room_v']->value['id_product'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
">
				<div class="row">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_117265319568e4f2942c7705_02555748', 'room_type_list_room_image');
?>

					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_115761662768e4f294308258_29091246', 'room_type_list_room_detail');
?>

				</div>
			</div>
		<?php }?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>
	<div class="noRoomsAvailAlert">
		<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No room available for this hotel!'),$_smarty_tpl ) );?>
</span>
	</div>
<?php }?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_127405593768e4f2946e0443_55620102', 'displayRoomTypeListAfter');
?>

<?php }
/* {block 'displayRoomTypeListBefore'} */
class Block_125620174968e4f294243df3_28787660 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayRoomTypeListBefore' => 
  array (
    0 => 'Block_125620174968e4f294243df3_28787660',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRoomTypeListBefore'),$_smarty_tpl ) );?>

<?php
}
}
/* {/block 'displayRoomTypeListBefore'} */
/* {block 'displayRoomTypeListImageAfter'} */
class Block_30691659168e4f2942f34e7_76851987 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRoomTypeListImageAfter','product'=>$_smarty_tpl->tpl_vars['room_v']->value),$_smarty_tpl ) );?>

								<?php
}
}
/* {/block 'displayRoomTypeListImageAfter'} */
/* {block 'room_type_list_room_image'} */
class Block_117265319568e4f2942c7705_02555748 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'room_type_list_room_image' => 
  array (
    0 => 'Block_117265319568e4f2942c7705_02555748',
  ),
  'displayRoomTypeListImageAfter' => 
  array (
    0 => 'Block_30691659168e4f2942f34e7_76851987',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<div class="col-sm-4">
								<a href="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['room_v']->value['product_link'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
">
								<img src="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['room_v']->value['image'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" class="img-responsive room-type-image">
								<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_30691659168e4f2942f34e7_76851987', 'displayRoomTypeListImageAfter', $this->tplIndex);
?>

							</a>
						</div>
					<?php
}
}
/* {/block 'room_type_list_room_image'} */
/* {block 'room_type_list_room_quantity'} */
class Block_193620162968e4f294318238_17233729 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<div class="row">
									<p class="rm_heading col-sm-12 col-md-7"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['room_v']->value['name'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
									<?php if (!(isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)) && !$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value && !$_smarty_tpl->tpl_vars['order_date_restrict']->value) {?>
										<p class="rm_left col-sm-12 col-md-5" <?php if (!empty($_smarty_tpl->tpl_vars['display_all_room_types']->value) || $_smarty_tpl->tpl_vars['room_v']->value['room_left'] > $_smarty_tpl->tpl_vars['warning_num']->value) {?> style="display:none"<?php }?>>
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hurry!'),$_smarty_tpl ) );?>
 <span class="remain_rm_qty"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['room_v']->value['room_left'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'rooms left'),$_smarty_tpl ) );?>

										</p>
									<?php }?>
								</div>
							<?php
}
}
/* {/block 'room_type_list_room_quantity'} */
/* {block 'room_type_list_room_description'} */
class Block_180540939068e4f2943792b0_77614316 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<div class="rm_desc"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['room_v']->value['description_short'],190,'',true ));?>
&nbsp;<a class="view_more" href="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['room_v']->value['product_link'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View More'),$_smarty_tpl ) );?>
....</a></div>
							<?php
}
}
/* {/block 'room_type_list_room_description'} */
/* {block 'room_type_list_room_features'} */
class Block_3304230468e4f2943aea46_76318707 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

										<div class="col-sm-12 col-md-5 col-lg-6">
											<?php if (!empty($_smarty_tpl->tpl_vars['room_v']->value['feature'])) {?>
												<p class="rm_amenities_cont">
													<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['room_v']->value['feature'], 'feat_v', false, 'feat_k');
$_smarty_tpl->tpl_vars['feat_v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['feat_k']->value => $_smarty_tpl->tpl_vars['feat_v']->value) {
$_smarty_tpl->tpl_vars['feat_v']->do_else = false;
?>
														<img title="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['feat_v']->value['name'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" src="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)$_smarty_tpl->tpl_vars['feat_img_dir']->value).((string)$_smarty_tpl->tpl_vars['feat_v']->value['value'])), 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" class="rm_amen">
													<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
												</p>
											<?php }?>
										</div>
									<?php
}
}
/* {/block 'room_type_list_room_features'} */
/* {block 'room_type_list_room_max_guests_mobile'} */
class Block_58091023968e4f29440f291_06723810 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

										<div class="col-sm-12 hidden-md hidden-lg">
											<p class="capa_txt"><span><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['room_v']->value['max_guests'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Max guests:'),$_smarty_tpl ) );?>
</span><span class="capa_data"> <?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['room_v']->value['max_adults'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );?>
, <?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['room_v']->value['max_children'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 <?php if ($_smarty_tpl->tpl_vars['room_v']->value['children'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );
}?></span></p>
										</div>
									<?php
}
}
/* {/block 'room_type_list_room_max_guests_mobile'} */
/* {block 'room_type_list_room_price'} */
class Block_105468243868e4f294480829_98230752 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

										<div class="col-sm-12 col-md-7 col-lg-6">
											<?php if (!(isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)) && !$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value && !$_smarty_tpl->tpl_vars['order_date_restrict']->value && (!(isset($_smarty_tpl->tpl_vars['display_all_room_types']->value)) || !$_smarty_tpl->tpl_vars['display_all_room_types']->value)) {?>
												<p class="rm_price_cont">
													<?php if ($_smarty_tpl->tpl_vars['room_v']->value['feature_price_diff'] >= 0) {?>
														<span class="rm_price_val <?php if ($_smarty_tpl->tpl_vars['room_v']->value['feature_price_diff'] > 0) {?>room_type_old_price<?php }?>">
															<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>floatVal($_smarty_tpl->tpl_vars['room_v']->value['price_without_reduction'])),$_smarty_tpl ) );?>

														</span>
													<?php }?>
													<?php if ($_smarty_tpl->tpl_vars['room_v']->value['feature_price_diff']) {?>
														<span class="rm_price_val">
															<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>floatVal($_smarty_tpl->tpl_vars['room_v']->value['feature_price'])),$_smarty_tpl ) );?>

														</span>
													<?php }?>
													<span class="rm_price_txt">/<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Per Night'),$_smarty_tpl ) );?>
</span>
												</p>
											<?php }?>
										</div>
									<?php
}
}
/* {/block 'room_type_list_room_price'} */
/* {block 'room_type_list_room_max_guests'} */
class Block_98861771168e4f294525b57_31587750 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

										<div class="col-sm-12 col-md-6 col-lg-4 visible-md visible-lg">
											<div class="capa_txt"><span><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['room_v']->value['max_guests'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Max guests:'),$_smarty_tpl ) );?>
</span><br><span class="capa_data"> <?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['room_v']->value['max_adults'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );?>
, <?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['room_v']->value['max_children'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 <?php if ($_smarty_tpl->tpl_vars['room_v']->value['children'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );
}?></span></div>
										</div>
									<?php
}
}
/* {/block 'room_type_list_room_max_guests'} */
/* {block 'occupancy_field'} */
class Block_117848052768e4f2945c31c6_27152081 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																	<?php $_smarty_tpl->_subTemplateRender("file:./occupancy_field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('room_type_info'=>$_smarty_tpl->tpl_vars['room_v']->value,'total_available_rooms'=>$_smarty_tpl->tpl_vars['room_v']->value['room_left']), 0, true);
?>
																<?php
}
}
/* {/block 'occupancy_field'} */
/* {block 'quantity_field'} */
class Block_149411359568e4f2945ef122_33906416 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

																	<?php $_smarty_tpl->_subTemplateRender("file:./quantity_field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('total_available_rooms'=>$_smarty_tpl->tpl_vars['room_v']->value['room_left']), 0, true);
?>
																<?php
}
}
/* {/block 'quantity_field'} */
/* {block 'room_type_list_room_book_now_button'} */
class Block_163169379668e4f294609304_18571948 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

															<div>
																<a cat_rm_check_in="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['booking_date_from']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" cat_rm_check_out="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['booking_date_to']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" href="" rm_product_id="<?php echo $_smarty_tpl->tpl_vars['room_v']->value['id_product'];?>
" cat_rm_book_nm_days="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['num_days']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" data-id-product-attribute="0" data-id-product="<?php echo intval($_smarty_tpl->tpl_vars['room_v']->value['id_product']);?>
" class="btn btn-default button button-medium ajax_add_to_cart_button"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Book Now'),$_smarty_tpl ) );?>
</span></a>
															</div>
														<?php
}
}
/* {/block 'room_type_list_room_book_now_button'} */
/* {block 'room_type_list_room_price'} */
class Block_140146557868e4f29466d171_30196665 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

														<div class="rm_price_cont">
															<?php if ($_smarty_tpl->tpl_vars['room_v']->value['feature_price_diff'] >= 0) {?>
																<span class="rm_price_val <?php if ($_smarty_tpl->tpl_vars['room_v']->value['feature_price_diff'] > 0) {?>room_type_old_price<?php }?>">
																	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>floatVal($_smarty_tpl->tpl_vars['room_v']->value['price_without_reduction'])),$_smarty_tpl ) );?>

																</span>
															<?php }?>
															<?php if ($_smarty_tpl->tpl_vars['room_v']->value['feature_price_diff']) {?>
																<span class="rm_price_val">
																	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>floatVal($_smarty_tpl->tpl_vars['room_v']->value['feature_price'])),$_smarty_tpl ) );?>

																</span>
															<?php }?>
															<span class="rm_price_txt">/<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Per Night'),$_smarty_tpl ) );?>
</span>
														</div>
													<?php
}
}
/* {/block 'room_type_list_room_price'} */
/* {block 'room_type_list_room_booking_fields'} */
class Block_61203418168e4f29458f574_01327947 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

											<?php if (!(isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)) && !$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value && !$_smarty_tpl->tpl_vars['order_date_restrict']->value) {?>
												<?php if ((!(isset($_smarty_tpl->tpl_vars['display_all_room_types']->value)) || !$_smarty_tpl->tpl_vars['display_all_room_types']->value)) {?>
													<div class="booking_room_fields">
														<?php if ((isset($_smarty_tpl->tpl_vars['occupancy_required_for_booking']->value)) && $_smarty_tpl->tpl_vars['occupancy_required_for_booking']->value) {?>
															<div class="booking_guest_occupancy_conatiner">
																<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_117848052768e4f2945c31c6_27152081', 'occupancy_field', $this->tplIndex);
?>

															</div>
														<?php } else { ?>
															<div>
																<label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Qty:'),$_smarty_tpl ) );?>
</label>
																<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_149411359568e4f2945ef122_33906416', 'quantity_field', $this->tplIndex);
?>

															</div>
														<?php }?>
														<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_163169379668e4f294609304_18571948', 'room_type_list_room_book_now_button', $this->tplIndex);
?>

													</div>
												<?php } else { ?>
													<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_140146557868e4f29466d171_30196665', 'room_type_list_room_price', $this->tplIndex);
?>

												<?php }?>
											<?php }?>
										<?php
}
}
/* {/block 'room_type_list_room_booking_fields'} */
/* {block 'room_type_list_room_detail'} */
class Block_115761662768e4f294308258_29091246 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'room_type_list_room_detail' => 
  array (
    0 => 'Block_115761662768e4f294308258_29091246',
  ),
  'room_type_list_room_quantity' => 
  array (
    0 => 'Block_193620162968e4f294318238_17233729',
  ),
  'room_type_list_room_description' => 
  array (
    0 => 'Block_180540939068e4f2943792b0_77614316',
  ),
  'room_type_list_room_features' => 
  array (
    0 => 'Block_3304230468e4f2943aea46_76318707',
  ),
  'room_type_list_room_max_guests_mobile' => 
  array (
    0 => 'Block_58091023968e4f29440f291_06723810',
  ),
  'room_type_list_room_price' => 
  array (
    0 => 'Block_105468243868e4f294480829_98230752',
    1 => 'Block_140146557868e4f29466d171_30196665',
  ),
  'room_type_list_room_max_guests' => 
  array (
    0 => 'Block_98861771168e4f294525b57_31587750',
  ),
  'room_type_list_room_booking_fields' => 
  array (
    0 => 'Block_61203418168e4f29458f574_01327947',
  ),
  'occupancy_field' => 
  array (
    0 => 'Block_117848052768e4f2945c31c6_27152081',
  ),
  'quantity_field' => 
  array (
    0 => 'Block_149411359568e4f2945ef122_33906416',
  ),
  'room_type_list_room_book_now_button' => 
  array (
    0 => 'Block_163169379668e4f294609304_18571948',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<div class="col-sm-8 room_info_cont">
							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_193620162968e4f294318238_17233729', 'room_type_list_room_quantity', $this->tplIndex);
?>

							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_180540939068e4f2943792b0_77614316', 'room_type_list_room_description', $this->tplIndex);
?>

							<div class="room_features_cont">
								<div class="row">
									<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3304230468e4f2943aea46_76318707', 'room_type_list_room_features', $this->tplIndex);
?>

									<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_58091023968e4f29440f291_06723810', 'room_type_list_room_max_guests_mobile', $this->tplIndex);
?>

									<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_105468243868e4f294480829_98230752', 'room_type_list_room_price', $this->tplIndex);
?>

								</div>
								<div class="row room_type_list_actions">
									<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_98861771168e4f294525b57_31587750', 'room_type_list_room_max_guests', $this->tplIndex);
?>

									<div class="col-sm-12 col-md-6 col-lg-8">
										<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_61203418168e4f29458f574_01327947', 'room_type_list_room_booking_fields', $this->tplIndex);
?>

									</div>
								</div>
							</div>
						</div>
					<?php
}
}
/* {/block 'room_type_list_room_detail'} */
/* {block 'displayRoomTypeListAfter'} */
class Block_127405593768e4f2946e0443_55620102 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayRoomTypeListAfter' => 
  array (
    0 => 'Block_127405593768e4f2946e0443_55620102',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRoomTypeListAfter'),$_smarty_tpl ) );?>

<?php
}
}
/* {/block 'displayRoomTypeListAfter'} */
}
