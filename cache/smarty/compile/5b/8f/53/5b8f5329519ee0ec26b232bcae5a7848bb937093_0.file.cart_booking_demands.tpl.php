<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:30
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\_partials\cart_booking_demands.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f292b896a7_04285798',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5b8f5329519ee0ec26b232bcae5a7848bb937093' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\_partials\\cart_booking_demands.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f292b896a7_04285798 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_202980097968e4f2926a4806_10146997', 'cart_booking_demands');
?>

<?php }
/* {block 'cart_booking_demands_tabs'} */
class Block_8594375768e4f2926c5897_63857485 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<ul class="nav nav-tabs">
					<?php if ((isset($_smarty_tpl->tpl_vars['selectedRoomDemands']->value)) && $_smarty_tpl->tpl_vars['selectedRoomDemands']->value) {?>
						<li class="active"><a href="#room_type_demands_desc" data-toggle="tab"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Facilities'),$_smarty_tpl ) );?>
</a></li>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['roomTypeServiceProducts']->value)) && $_smarty_tpl->tpl_vars['roomTypeServiceProducts']->value) {?>
						<li <?php if (!(isset($_smarty_tpl->tpl_vars['selectedRoomDemands']->value)) || !$_smarty_tpl->tpl_vars['selectedRoomDemands']->value) {?> class="active"<?php }?>><a href="#room_type_service_product_desc" data-toggle="tab"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Services'),$_smarty_tpl ) );?>
</a></li>
					<?php }?>
				</ul>
			<?php
}
}
/* {/block 'cart_booking_demands_tabs'} */
/* {block 'cart_booking_demands_tab_content'} */
class Block_201915424968e4f2927058d8_00381721 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<?php if ((isset($_smarty_tpl->tpl_vars['selectedRoomDemands']->value)) && $_smarty_tpl->tpl_vars['selectedRoomDemands']->value) {?>
							<div id="room_type_demands_desc" class="tab-pane active">
								<div class="rooms_extra_demands_head">
									<p class="rooms_extra_demands_text"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add below facilities to the rooms for better hotel experience'),$_smarty_tpl ) );?>
</p>
								</div>
								<?php $_smarty_tpl->_assignInScope('roomCount', 1);?>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['selectedRoomDemands']->value, 'roomDemand', false, 'key');
$_smarty_tpl->tpl_vars['roomDemand']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['roomDemand']->value) {
$_smarty_tpl->tpl_vars['roomDemand']->do_else = false;
?>
									<div class="card accordion">
										<div class="row accordion-section">
											<div class="col-sm-12 demand_header">
												<a class="accordion-section-title <?php if ($_smarty_tpl->tpl_vars['roomCount']->value == 1) {?>active<?php }?>" href="#accordion_demand_<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true);?>
">
													<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room'),$_smarty_tpl ) );?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['roomCount']->value, ENT_QUOTES, 'UTF-8', true);?>
&nbsp;
													<span>(<?php ob_start();
echo $_smarty_tpl->tpl_vars['roomDemand']->value['adults'];
$_prefixVariable80 = ob_get_clean();
if ($_prefixVariable80 <= 9) {?>0<?php echo $_smarty_tpl->tpl_vars['roomDemand']->value['adults'];
} else {
echo $_smarty_tpl->tpl_vars['roomDemand']->value['adults'];
}?> <?php if ($_smarty_tpl->tpl_vars['roomDemand']->value['adults'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adult'),$_smarty_tpl ) );
}?>, <?php ob_start();
echo $_smarty_tpl->tpl_vars['roomDemand']->value['children'];
$_prefixVariable81 = ob_get_clean();
if ($_prefixVariable81 <= 9) {?>0<?php echo $_smarty_tpl->tpl_vars['roomDemand']->value['children'];
} else {
echo $_smarty_tpl->tpl_vars['roomDemand']->value['children'];
}?> <?php if ($_smarty_tpl->tpl_vars['roomDemand']->value['children'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );
}?>)</span>
												</a>
											</div>
											<div id="accordion_demand_<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="room_demand_detail col-sm-12 accordion-section-content <?php if ($_smarty_tpl->tpl_vars['roomCount']->value == 1) {?>open<?php }?>" <?php if ($_smarty_tpl->tpl_vars['roomCount']->value == 1) {?>style="display: block;"<?php }?>>
												<?php if ((isset($_smarty_tpl->tpl_vars['roomTypeDemands']->value)) && $_smarty_tpl->tpl_vars['roomTypeDemands']->value) {?>
													<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['roomTypeDemands']->value, 'demand', false, 'idGlobalDemand');
$_smarty_tpl->tpl_vars['demand']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['idGlobalDemand']->value => $_smarty_tpl->tpl_vars['demand']->value) {
$_smarty_tpl->tpl_vars['demand']->do_else = false;
?>
														<div class="row room_demand_block">
															<div class="col-xs-8">
																<div class="row">
																	<div class="col-xs-2">
																		<p class="checkbox">
																			<input id_cart_booking="<?php echo $_smarty_tpl->tpl_vars['roomDemand']->value['id'];?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['idGlobalDemand']->value, ENT_QUOTES, 'UTF-8', true);?>
" type="checkbox" class="id_room_type_demand" <?php if ((isset($_smarty_tpl->tpl_vars['roomDemand']->value['selected_global_demands'])) && $_smarty_tpl->tpl_vars['roomDemand']->value['selected_global_demands'] && (in_array($_smarty_tpl->tpl_vars['idGlobalDemand']->value,$_smarty_tpl->tpl_vars['roomDemand']->value['selected_global_demands']))) {?>checked<?php }?> />
																		</p>
																	</div>
																	<div class="col-xs-10 demand_adv_option_block">
																			<p><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['demand']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</p>
																			<?php if ((isset($_smarty_tpl->tpl_vars['demand']->value['adv_option'])) && $_smarty_tpl->tpl_vars['demand']->value['adv_option']) {?>
																				<select class="id_option">
																					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['demand']->value['adv_option'], 'option', false, 'idOption');
$_smarty_tpl->tpl_vars['option']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['idOption']->value => $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->do_else = false;
?>
																						<?php $_smarty_tpl->_assignInScope('demand_key', ((string)$_smarty_tpl->tpl_vars['idGlobalDemand']->value)."-".((string)$_smarty_tpl->tpl_vars['idOption']->value));?>
																						<option optionPrice="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['option']->value['price'], ENT_QUOTES, 'UTF-8', true);?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['idOption']->value, ENT_QUOTES, 'UTF-8', true);?>
" <?php if ((isset($_smarty_tpl->tpl_vars['roomDemand']->value['extra_demands'][$_smarty_tpl->tpl_vars['demand_key']->value]))) {?>selected<?php }?> key="<?php echo $_smarty_tpl->tpl_vars['demand_key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['option']->value['name'];?>
</option>
																						<?php if ((isset($_smarty_tpl->tpl_vars['roomDemand']->value['extra_demands'][$_smarty_tpl->tpl_vars['demand_key']->value]))) {?>
																							<?php $_smarty_tpl->_assignInScope('selected_adv_option', ((string)$_smarty_tpl->tpl_vars['idOption']->value));?>
																						<?php }?>
																					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
																				</select>
																			<?php } else { ?>
																				<input type="hidden" class="id_option" value="0" />
																			<?php }?>
																		</div>
																	</div>
																</div>
																<div class="col-xs-4">
																	<p class="pull-right">
																		<span class="extra_demand_option_price"><?php if ((isset($_smarty_tpl->tpl_vars['selected_adv_option']->value)) && (isset($_smarty_tpl->tpl_vars['demand']->value['adv_option'][$_smarty_tpl->tpl_vars['selected_adv_option']->value]['price']))) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>htmlspecialchars((string)$_smarty_tpl->tpl_vars['demand']->value['adv_option'][$_smarty_tpl->tpl_vars['selected_adv_option']->value]['price'], ENT_QUOTES, 'UTF-8', true)),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>htmlspecialchars((string)$_smarty_tpl->tpl_vars['demand']->value['price'], ENT_QUOTES, 'UTF-8', true)),$_smarty_tpl ) );
}?></span><?php if ($_smarty_tpl->tpl_vars['demand']->value['price_calc_method'] == HotelRoomTypeGlobalDemand::WK_PRICE_CALC_METHOD_EACH_DAY) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'/Night'),$_smarty_tpl ) );
}?>
																	</p>
																</div>
															</div>
														<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
													<?php }?>
											</div>
										</div>
									</div>
									<?php $_smarty_tpl->_assignInScope('roomCount', $_smarty_tpl->tpl_vars['roomCount']->value+1);?>
								<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</div>
						<?php }?>
					<?php
}
}
/* {/block 'cart_booking_demands_tab_content'} */
/* {block 'cart_booking_services_tab_content'} */
class Block_27024145668e4f292932f68_50787290 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<?php if ((isset($_smarty_tpl->tpl_vars['roomTypeServiceProducts']->value)) && $_smarty_tpl->tpl_vars['roomTypeServiceProducts']->value) {?>
							<div id="room_type_service_product_desc" class="tab-pane<?php if (!(isset($_smarty_tpl->tpl_vars['selectedRoomDemands']->value)) || !$_smarty_tpl->tpl_vars['selectedRoomDemands']->value) {?> active<?php }?>">
								<div class="rooms_extra_demands_head">
									<p class="rooms_extra_demands_text"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add below services to the rooms for better hotel experience'),$_smarty_tpl ) );?>
</p>
								</div>
								<?php $_smarty_tpl->_assignInScope('roomCount', 1);?>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cartRooms']->value, 'cartRoom', false, 'key');
$_smarty_tpl->tpl_vars['cartRoom']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['cartRoom']->value) {
$_smarty_tpl->tpl_vars['cartRoom']->do_else = false;
?>
									<div class="card accordion">
										<div class="row accordion-section">
											<div class="col-sm-12 demand_header">
												<a class="accordion-section-title <?php if ($_smarty_tpl->tpl_vars['roomCount']->value == 1) {?>active<?php }?>" href="#accordion_service_<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true);?>
">
													<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room'),$_smarty_tpl ) );?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['roomCount']->value, ENT_QUOTES, 'UTF-8', true);?>
&nbsp;
													<span>(<?php ob_start();
echo $_smarty_tpl->tpl_vars['cartRoom']->value['adults'];
$_prefixVariable82 = ob_get_clean();
if ($_prefixVariable82 <= 9) {?>0<?php echo $_smarty_tpl->tpl_vars['cartRoom']->value['adults'];
} else {
echo $_smarty_tpl->tpl_vars['cartRoom']->value['adults'];
}?> <?php if ($_smarty_tpl->tpl_vars['cartRoom']->value['adults'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adult'),$_smarty_tpl ) );
}?>, <?php ob_start();
echo $_smarty_tpl->tpl_vars['cartRoom']->value['children'];
$_prefixVariable83 = ob_get_clean();
if ($_prefixVariable83 <= 9) {?>0<?php echo $_smarty_tpl->tpl_vars['cartRoom']->value['children'];
} else {
echo $_smarty_tpl->tpl_vars['cartRoom']->value['children'];
}?> <?php if ($_smarty_tpl->tpl_vars['cartRoom']->value['children'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );
}?>)</span>
												</a>
											</div>
											<div id="accordion_service_<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true);?>
" class=" col-sm-12 room_demand_detail accordion-section-content <?php if ($_smarty_tpl->tpl_vars['roomCount']->value == 1) {?>open<?php }?>" <?php if ($_smarty_tpl->tpl_vars['roomCount']->value == 1) {?>style="display: block;"<?php }?>>
												<?php if ((isset($_smarty_tpl->tpl_vars['roomTypeServiceProducts']->value)) && $_smarty_tpl->tpl_vars['roomTypeServiceProducts']->value) {?>
													<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['roomTypeServiceProducts']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
														<?php if ((isset($_smarty_tpl->tpl_vars['cartRoom']->value['selected_service'])) && $_smarty_tpl->tpl_vars['cartRoom']->value['selected_service'] && (array_key_exists($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['cartRoom']->value['selected_service']))) {?>
															<?php $_smarty_tpl->_assignInScope('serviceSelected', true);?>
															<?php $_tmp_array = isset($_smarty_tpl->tpl_vars['product']) ? $_smarty_tpl->tpl_vars['product']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['price_tax_incl'] = $_smarty_tpl->tpl_vars['cartRoom']->value['selected_service'][$_smarty_tpl->tpl_vars['product']->value['id_product']]['unit_price_tax_incl'];
$_smarty_tpl->_assignInScope('product', $_tmp_array);?>
															<?php $_tmp_array = isset($_smarty_tpl->tpl_vars['product']) ? $_smarty_tpl->tpl_vars['product']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['price_tax_exc'] = $_smarty_tpl->tpl_vars['cartRoom']->value['selected_service'][$_smarty_tpl->tpl_vars['product']->value['id_product']]['unit_price_tax_excl'];
$_smarty_tpl->_assignInScope('product', $_tmp_array);?>
														<?php } else { ?>
															<?php $_smarty_tpl->_assignInScope('serviceSelected', false);?>
														<?php }?>
														<div class="row room_demand_block">
															<div class="col-xs-8">
																<div class="row">
																	<div class="col-xs-2">
																		<?php if ($_smarty_tpl->tpl_vars['product']->value['available_for_order']) {?>
																			<p class="checkbox">
																				<input data-id_cart_booking="<?php echo $_smarty_tpl->tpl_vars['cartRoom']->value['id'];?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
" type="checkbox" class="change_room_type_service_product" <?php if ($_smarty_tpl->tpl_vars['serviceSelected']->value) {?>checked<?php }?> />
																			</p>
																		<?php }?>
																	</div>
																	<div class="col-xs-10">
																		<p><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</p>
																		<?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
																			<div class="qty_container">
																				<input type="text" class="form-control qty" id="qty_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" name="room_service_product_qty_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" data-max_quantity="<?php echo $_smarty_tpl->tpl_vars['product']->value['max_quantity'];?>
" value="<?php if ($_smarty_tpl->tpl_vars['serviceSelected']->value) {
echo $_smarty_tpl->tpl_vars['cartRoom']->value['selected_service'][$_smarty_tpl->tpl_vars['product']->value['id_product']]['quantity'];
} else { ?>1<?php }?>">
																				<input type="hidden" class="qty_hidden" id="qty_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_hidden" value="<?php if ($_smarty_tpl->tpl_vars['serviceSelected']->value) {
echo $_smarty_tpl->tpl_vars['cartRoom']->value['selected_service'][$_smarty_tpl->tpl_vars['product']->value['id_product']]['quantity'];
} else { ?>0<?php }?>">
																				<div class="qty_controls">
																					<a href="#" class="qty_up"><span><i class="icon-plus"></i></span></a>
																					<a href="#" class="qty_down"><span><i class="icon-minus"></i></span></a>
																				</div>
																			</div>
																		<?php }?>
																	</div>
																</div>
															</div>
															<div class="col-xs-4">
																<?php if (($_smarty_tpl->tpl_vars['product']->value['show_price'] && !(isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value))) || (isset($_smarty_tpl->tpl_vars['groups']->value))) {?>
																	<span class="pull-right"><?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_incl']),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_exc']),$_smarty_tpl ) );
}
if ($_smarty_tpl->tpl_vars['product']->value['price_calculation_method'] == Product::PRICE_CALCULATION_METHOD_PER_DAY) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'/Night'),$_smarty_tpl ) );
}?></span>

																<?php }?>
															</div>
														</div>
													<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
												<?php }?>
											</div>
										</div>
									</div>
									<?php $_smarty_tpl->_assignInScope('roomCount', $_smarty_tpl->tpl_vars['roomCount']->value+1);?>
								<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							<div>
						<?php }?>
					<?php
}
}
/* {/block 'cart_booking_services_tab_content'} */
/* {block 'cart_booking_demands_tabs_content'} */
class Block_187939280068e4f292703744_44510225 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<div class="tab-content">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_201915424968e4f2927058d8_00381721', 'cart_booking_demands_tab_content', $this->tplIndex);
?>


					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_27024145668e4f292932f68_50787290', 'cart_booking_services_tab_content', $this->tplIndex);
?>

				</div>
			<?php
}
}
/* {/block 'cart_booking_demands_tabs_content'} */
/* {block 'cart_booking_demands'} */
class Block_202980097968e4f2926a4806_10146997 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'cart_booking_demands' => 
  array (
    0 => 'Block_202980097968e4f2926a4806_10146997',
  ),
  'cart_booking_demands_tabs' => 
  array (
    0 => 'Block_8594375768e4f2926c5897_63857485',
  ),
  'cart_booking_demands_tabs_content' => 
  array (
    0 => 'Block_187939280068e4f292703744_44510225',
  ),
  'cart_booking_demands_tab_content' => 
  array (
    0 => 'Block_201915424968e4f2927058d8_00381721',
  ),
  'cart_booking_services_tab_content' => 
  array (
    0 => 'Block_27024145668e4f292932f68_50787290',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<section>
		<?php if (((isset($_smarty_tpl->tpl_vars['selectedRoomDemands']->value)) && $_smarty_tpl->tpl_vars['selectedRoomDemands']->value) || ((isset($_smarty_tpl->tpl_vars['roomTypeServiceProducts']->value)) && $_smarty_tpl->tpl_vars['roomTypeServiceProducts']->value)) {?>
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8594375768e4f2926c5897_63857485', 'cart_booking_demands_tabs', $this->tplIndex);
?>

			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_187939280068e4f292703744_44510225', 'cart_booking_demands_tabs_content', $this->tplIndex);
?>

		<?php }?>
	</section>
<?php
}
}
/* {/block 'cart_booking_demands'} */
}
