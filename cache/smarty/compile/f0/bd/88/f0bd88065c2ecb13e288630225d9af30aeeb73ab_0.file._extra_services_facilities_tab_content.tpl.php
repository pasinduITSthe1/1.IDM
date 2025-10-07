<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:30
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_extra_services_facilities_tab_content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2927ab4d2_04186300',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f0bd88065c2ecb13e288630225d9af30aeeb73ab' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_extra_services_facilities_tab_content.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2927ab4d2_04186300 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="room_type_demands_desc" class="tab-pane <?php if (((isset($_smarty_tpl->tpl_vars['show_active']->value)) && $_smarty_tpl->tpl_vars['show_active']->value) || (!(isset($_smarty_tpl->tpl_vars['orderEdit']->value)) || !$_smarty_tpl->tpl_vars['orderEdit']->value)) {?>active<?php }?> extra-services-container">
	<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['id_booking_detail']->value;?>
" id="id_htl_booking">
	<?php if ((isset($_smarty_tpl->tpl_vars['orderEdit']->value)) && $_smarty_tpl->tpl_vars['orderEdit']->value) {?>
		<p class="col-sm-12 facility_nav_btn">
			<button id="btn_new_room_demand" class="btn btn-success"><i class="icon-plus"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add new facility'),$_smarty_tpl ) );?>
</button>
			<button id="back_to_demands_btn" class="btn btn-default"><i class="icon-arrow-left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Back'),$_smarty_tpl ) );?>
</button>
		</p>

				<div class="col-sm-12 room_ordered_demands table-responsive">
			<table class="table">
					<thead>
						<tr>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</th>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit Price (tax excl.)'),$_smarty_tpl ) );?>
</th>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Price (tax excl.)'),$_smarty_tpl ) );?>
</th>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Price (tax incl.)'),$_smarty_tpl ) );?>
</th>
							<th class="text-right"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Action'),$_smarty_tpl ) );?>
</th>
						</tr>
					</thead>
				<tbody>
					<?php if ((isset($_smarty_tpl->tpl_vars['extraDemands']->value)) && $_smarty_tpl->tpl_vars['extraDemands']->value) {?>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['extraDemands']->value, 'roomDemand');
$_smarty_tpl->tpl_vars['roomDemand']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['roomDemand']->value) {
$_smarty_tpl->tpl_vars['roomDemand']->do_else = false;
?>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['roomDemand']->value['extra_demands'], 'demand');
$_smarty_tpl->tpl_vars['demand']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['demand']->value) {
$_smarty_tpl->tpl_vars['demand']->do_else = false;
?>
								<tr data-id_booking_demand="<?php echo $_smarty_tpl->tpl_vars['demand']->value['id_booking_demand'];?>
">
									<td><?php echo $_smarty_tpl->tpl_vars['demand']->value['name'];?>
</td>
									<td>
										<div class="input-group">
											<span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currencySign']->value;?>
</span>
											<input type="text" class="form-control unit_price" value="<?php echo $_smarty_tpl->tpl_vars['demand']->value['unit_price_tax_excl'];?>
">
											<?php if ($_smarty_tpl->tpl_vars['demand']->value['price_calc_method'] == HotelRoomTypeGlobalDemand::WK_PRICE_CALC_METHOD_EACH_DAY) {?>
												<span class="input-group-addon"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'/ night'),$_smarty_tpl ) );?>
</span>
											<?php }?>
										</div>
									</td>
									<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['demand']->value['total_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value),$_smarty_tpl ) );?>
</td>
									<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['demand']->value['total_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value),$_smarty_tpl ) );?>
</td>
									<td class="text-right"><a class="btn btn-danger pull-right del-order-room-demand" href="#" id_booking_demand="<?php echo $_smarty_tpl->tpl_vars['demand']->value['id_booking_demand'];?>
"><i class="icon-trash"></i></a></td>
								</tr>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<?php } else { ?>
						<tr>
							<td colspan="4">
								<i class="icon-warning"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No facilities added yet.'),$_smarty_tpl ) );?>

							</td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		</div>

				<div class="col-sm-12 room_demands_container">
			<div class="room_demand_detail">
				<?php if ((isset($_smarty_tpl->tpl_vars['roomTypeDemands']->value)) && $_smarty_tpl->tpl_vars['roomTypeDemands']->value) {?>
					<table class="table">
						<thead>
							<tr>
								<th></th>
								<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</th>
								<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Option'),$_smarty_tpl ) );?>
</th>
								<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit Price (tax excl.)'),$_smarty_tpl ) );?>
</th>
							</tr>
						</thead>
						<tbody>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['roomTypeDemands']->value, 'demand', false, 'idGlobalDemand');
$_smarty_tpl->tpl_vars['demand']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['idGlobalDemand']->value => $_smarty_tpl->tpl_vars['demand']->value) {
$_smarty_tpl->tpl_vars['demand']->do_else = false;
?>
								<tr class="room_demand_block">
									<td>
										<input id_cart_booking="<?php echo $_smarty_tpl->tpl_vars['roomDemand']->value['id'];?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['idGlobalDemand']->value, ENT_QUOTES, 'UTF-8', true);?>
" type="checkbox" class="id_room_type_demand" <?php if ((isset($_smarty_tpl->tpl_vars['roomDemand']->value['selected_global_demands'])) && $_smarty_tpl->tpl_vars['roomDemand']->value['selected_global_demands'] && (in_array($_smarty_tpl->tpl_vars['idGlobalDemand']->value,$_smarty_tpl->tpl_vars['roomDemand']->value['selected_global_demands']))) {?>checked<?php }?> />
									</td>
									<td>
										<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['demand']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

									</td>
									<td class="demand_adv_option_block">
										<?php if ((isset($_smarty_tpl->tpl_vars['demand']->value['adv_option'])) && $_smarty_tpl->tpl_vars['demand']->value['adv_option']) {?>
											<select class="id_option">
												<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['demand']->value['adv_option'], 'option', false, 'idOption');
$_smarty_tpl->tpl_vars['option']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['idOption']->value => $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->do_else = false;
?>
													<?php $_smarty_tpl->_assignInScope('demand_key', ((string)$_smarty_tpl->tpl_vars['idGlobalDemand']->value)."-".((string)$_smarty_tpl->tpl_vars['idOption']->value));?>
													<option optionPrice="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['option']->value['price_tax_excl'], ENT_QUOTES, 'UTF-8', true);?>
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
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'--'),$_smarty_tpl ) );?>

											<input type="hidden" class="id_option" value="0" />
										<?php }?>
									</td>
									<td>
										<div class="input-group">
											<span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currencySign']->value;?>
</span>
											<?php if ((isset($_smarty_tpl->tpl_vars['selected_adv_option']->value)) && (isset($_smarty_tpl->tpl_vars['demand']->value['adv_option'][$_smarty_tpl->tpl_vars['selected_adv_option']->value]['price_tax_excl']))) {?>
												<?php $_smarty_tpl->_assignInScope('demand_price', $_smarty_tpl->tpl_vars['demand']->value['adv_option'][$_smarty_tpl->tpl_vars['selected_adv_option']->value]['price_tax_excl']);?>
											<?php } elseif ((isset($_smarty_tpl->tpl_vars['demand']->value['adv_option'])) && $_smarty_tpl->tpl_vars['demand']->value['adv_option']) {?>
												<?php $_smarty_tpl->_assignInScope('demand_price', $_smarty_tpl->tpl_vars['demand']->value['adv_option'][key($_smarty_tpl->tpl_vars['demand']->value['adv_option'])]['price_tax_excl']);?>
											<?php } else { ?>
												<?php $_smarty_tpl->_assignInScope('demand_price', $_smarty_tpl->tpl_vars['demand']->value['price_tax_excl']);?>
											<?php }?>
											<input type="text" class="form-control unit_price" value="<?php echo $_smarty_tpl->tpl_vars['demand_price']->value;?>
" data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
">
											<?php if ($_smarty_tpl->tpl_vars['demand']->value['price_calc_method'] == HotelRoomTypeGlobalDemand::WK_PRICE_CALC_METHOD_EACH_DAY) {?>
												<span class="input-group-addon"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'/ night'),$_smarty_tpl ) );?>
</span>
											<?php }?>
										</div>
									</td>
								</tr>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</tbody>
					</table>

                    <div class="modal-footer">
                        <button type="button" id="save_room_demands" class="btn btn-primary"><i class="icon icon-save"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Update Facilities"),$_smarty_tpl ) );?>
</button>
                    </div>
				<?php } else { ?>
                    <i class="icon-warning"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No facilities available for this room.'),$_smarty_tpl ) );?>

				<?php }?>
			</div>
		</div>
	<?php } else { ?>
        <div class="room_demand_detail">
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit Price (tax excl.)'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Price (tax excl.)'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Price (tax incl.)'),$_smarty_tpl ) );?>
</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ((isset($_smarty_tpl->tpl_vars['extraDemands']->value)) && $_smarty_tpl->tpl_vars['extraDemands']->value) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['extraDemands']->value, 'roomDemand');
$_smarty_tpl->tpl_vars['roomDemand']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['roomDemand']->value) {
$_smarty_tpl->tpl_vars['roomDemand']->do_else = false;
?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['roomDemand']->value['extra_demands'], 'demand');
$_smarty_tpl->tpl_vars['demand']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['demand']->value) {
$_smarty_tpl->tpl_vars['demand']->do_else = false;
?>
                                <tr class="room_demand_block">
                                    <td><?php echo $_smarty_tpl->tpl_vars['demand']->value['name'];?>
</td>
                                    <td>
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['demand']->value['unit_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value),$_smarty_tpl ) );?>

                                        <?php if ($_smarty_tpl->tpl_vars['demand']->value['price_calc_method'] == HotelRoomTypeGlobalDemand::WK_PRICE_CALC_METHOD_EACH_DAY) {?>
                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'/ night'),$_smarty_tpl ) );?>

                                        <?php }?>
                                    </td>
                                    <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['demand']->value['total_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value),$_smarty_tpl ) );?>
</td>
                                    <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['demand']->value['total_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value),$_smarty_tpl ) );?>
</td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="3">
                                <i class="icon-warning"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No facilities added yet.'),$_smarty_tpl ) );?>

                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
	<?php }?>
</div><?php }
}
