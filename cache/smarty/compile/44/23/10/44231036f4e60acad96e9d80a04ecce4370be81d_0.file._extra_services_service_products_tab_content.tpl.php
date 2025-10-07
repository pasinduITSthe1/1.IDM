<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:30
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_extra_services_service_products_tab_content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f292ce2a36_98345263',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '44231036f4e60acad96e9d80a04ecce4370be81d' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_extra_services_service_products_tab_content.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f292ce2a36_98345263 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="room_type_service_product_desc" class="tab-pane <?php if ((isset($_smarty_tpl->tpl_vars['show_active']->value)) && $_smarty_tpl->tpl_vars['show_active']->value) {?>active<?php }?> extra-services-container">
	<?php if ((isset($_smarty_tpl->tpl_vars['orderEdit']->value)) && $_smarty_tpl->tpl_vars['orderEdit']->value) {?>

		<div class="col-sm-12 facility_nav_btn">
            <?php if ($_smarty_tpl->tpl_vars['customServiceAllowed']->value) {?>
                <button id="btn_new_room_service" class="btn btn-success pull-right"><i class="icon-plus-circle"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add a new service'),$_smarty_tpl ) );?>
</button>
            <?php }?>
			<button id="btn_new_existing_room_service" class="btn btn-success"><i class="icon-plus-circle"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add existing service'),$_smarty_tpl ) );?>
</button>
			<button id="back_to_service_btn" class="btn btn-default"><i class="icon-arrow-left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Back'),$_smarty_tpl ) );?>
</button>
            <hr>
		</div>


				<div class="col-sm-12 room_ordered_services table-responsive">
            <form id="update_selected_room_services_form">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</th>
                            <th class="fixed-width-sm"></th>
                            <th class="fixed-width-sm text-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity'),$_smarty_tpl ) );?>
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
                        <?php if ((isset($_smarty_tpl->tpl_vars['additionalServices']->value)) && $_smarty_tpl->tpl_vars['additionalServices']->value) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['additionalServices']->value['additional_services'], 'service');
$_smarty_tpl->tpl_vars['service']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['service']->value) {
$_smarty_tpl->tpl_vars['service']->do_else = false;
?>
                                <tr class="room_demand_block" data-id_service_product_order_detail="<?php echo $_smarty_tpl->tpl_vars['service']->value['id_service_product_order_detail'];?>
">
                                    <td>
                                        <div><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                                        <input value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service']->value['id_service_product_order_detail'], ENT_QUOTES, 'UTF-8', true);?>
" name="id_service_product_order_detail[]" type="hidden"/>
                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['service']->value['product_auto_add'] && $_smarty_tpl->tpl_vars['service']->value['product_price_addition_type'] == Product::PRICE_ADDITION_TYPE_WITH_ROOM) {?>
                                            <span class="badge badge-info label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Auto added'),$_smarty_tpl ) );?>
</span><br>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['service']->value['product_auto_add'] && $_smarty_tpl->tpl_vars['service']->value['product_price_addition_type'] == Product::PRICE_ADDITION_TYPE_INDEPENDENT) {?>
                                            <span class="badge badge-info label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Convenience fee'),$_smarty_tpl ) );?>
</span>
                                        <?php }?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($_smarty_tpl->tpl_vars['service']->value['allow_multiple_quantity']) {?>
                                            <div class="qty_container">
                                                <input type="number" class="form-control qty" min="1" data-id_product="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service']->value['quantity'], ENT_QUOTES, 'UTF-8', true);?>
" name="service_qty[<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service']->value['id_service_product_order_detail'], ENT_QUOTES, 'UTF-8', true);?>
]">
                                                <?php if ($_smarty_tpl->tpl_vars['service']->value['max_quantity']) {?>
                                                    <p style="display:<?php if ($_smarty_tpl->tpl_vars['service']->value['quantity'] > $_smarty_tpl->tpl_vars['service']->value['max_quantity']) {?>block<?php } else { ?>none<?php }?>; margin-top: 4px;">
                                                        <span class="label label-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Maximum allowed quantity: %s','sprintf'=>$_smarty_tpl->tpl_vars['service']->value['max_quantity']),$_smarty_tpl ) );?>
</span>
                                                    </p>
                                                <?php }?>
                                            </div>
                                        <?php } else { ?>
                                            --
                                        <?php }?>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currencySign']->value;?>
</span>
                                            <input type="text" class="form-control unit_price" value="<?php echo Tools::ps_round($_smarty_tpl->tpl_vars['service']->value['unit_price_tax_excl'],2);?>
" data-id-product="<?php echo $_smarty_tpl->tpl_vars['service']->value['id_product'];?>
" name="service_price[<?php echo $_smarty_tpl->tpl_vars['service']->value['id_service_product_order_detail'];?>
]">
                                            <?php if (Product::PRICE_CALCULATION_METHOD_PER_DAY == $_smarty_tpl->tpl_vars['service']->value['price_calculation_method']) {?>
                                                <span class="input-group-addon"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'/ night'),$_smarty_tpl ) );?>
</span>
                                            <?php }?>
                                        </div>
                                    </td>
                                    <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>htmlspecialchars((string)$_smarty_tpl->tpl_vars['service']->value['total_price_tax_excl'], ENT_QUOTES, 'UTF-8', true),'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value),$_smarty_tpl ) );?>
</td>
                                    <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>htmlspecialchars((string)$_smarty_tpl->tpl_vars['service']->value['total_price_tax_incl'], ENT_QUOTES, 'UTF-8', true),'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value),$_smarty_tpl ) );?>
</td>
                                    <td class="text-right"><a class="btn btn-danger pull-right del_room_additional_service" data-id_service_product_order_detail="<?php echo $_smarty_tpl->tpl_vars['service']->value['id_service_product_order_detail'];?>
" href="#"><i class="icon-trash"></i></a></td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="3">
                                    <i class="icon-warning"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No services added yet.'),$_smarty_tpl ) );?>

                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>

                <div class="modal-footer">
                    <button type="submit" id="update_selected_services" class="btn btn-primary"><i class="icon icon-save"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Update Services"),$_smarty_tpl ) );?>
</button>
                </div>
            </form>
		</div>

        		<form id="add_existing_room_services_form" class="col-sm-12 room_services_container">
			<div class="room_demand_detail">
				<?php if ((isset($_smarty_tpl->tpl_vars['serviceProducts']->value)) && $_smarty_tpl->tpl_vars['serviceProducts']->value) {?>
					<table class="table">
						<thead>
							<tr>
								<th></th>
								<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</th>
								<th class="fixed-width-sm"> </th>
								<th class="fixed-width-sm text-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity'),$_smarty_tpl ) );?>
</th>
								<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit Price (tax excl.)'),$_smarty_tpl ) );?>
</th>
							</tr>
						</thead>
						<tbody>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['serviceProducts']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
								<tr class="room_demand_block">
									<td>
										<input data-id_booking_detail="<?php echo $_smarty_tpl->tpl_vars['id_booking_detail']->value;?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
" name="selected_service[]" type="checkbox" class="id_room_type_service"/>
									</td>
									<td>
										<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

									</td>
									<td class="text-center">
										<?php if ($_smarty_tpl->tpl_vars['product']->value['auto_add_to_cart'] && $_smarty_tpl->tpl_vars['product']->value['price_addition_type'] == Product::PRICE_ADDITION_TYPE_WITH_ROOM) {?>
											<span class="badge badge-info label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Auto added'),$_smarty_tpl ) );?>
</span><br>
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['product']->value['auto_add_to_cart'] && $_smarty_tpl->tpl_vars['product']->value['price_addition_type'] == Product::PRICE_ADDITION_TYPE_INDEPENDENT) {?>
											<span class="badge badge-info label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Convenience fee'),$_smarty_tpl ) );?>
</span>
										<?php }?>
									</td>
									<td class="text-center">
										<?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
											<div class="qty_container">
												<input type="number" class="form-control qty" min="1" id="qty_<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
" name="service_qty[<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
]" data-id-product="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
" value="1">
											</div>
										<?php } else { ?>
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'--'),$_smarty_tpl ) );?>

										<?php }?>
									</td>
									<td class="text-right">
										<div class="input-group">
											<span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currencySign']->value;?>
</span>
											<input type="text" class="form-control unit_price" name="service_price[<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
]" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['price_tax_exc'];?>
" data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
">
											<?php if (Product::PRICE_CALCULATION_METHOD_PER_DAY == $_smarty_tpl->tpl_vars['product']->value['price_calculation_method']) {?>
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
                        <button type="submit" id="save_service_service" class="btn btn-primary"><i class="icon icon-save"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Update Services"),$_smarty_tpl ) );?>
</button>
                    </div>
				<?php } else { ?>
					<i class="icon-warning"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No services available to add to this room.'),$_smarty_tpl ) );?>

				<?php }?>
			</div>
			<input type="hidden" name="id_booking_detail" value="<?php echo $_smarty_tpl->tpl_vars['id_booking_detail']->value;?>
">
		</form>

        <?php if ($_smarty_tpl->tpl_vars['customServiceAllowed']->value) {?>
            <form id="add_new_room_services_form" class="col-sm-12 room_services_container">
                <div class="row form-group">
                    <div class="col-sm-6">
                        <label class="control-label required"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</label>
                        <input type="text" class="form-control" name="new_service_name"/>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label required"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price(tax excl.)'),$_smarty_tpl ) );?>
</label>
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currencySign']->value;?>
</span>
                            <input type="text" class="form-control" name="new_service_price"/>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price calculation method'),$_smarty_tpl ) );?>
</label>
                        <select class="form-control" name="new_service_price_calc_method">
                            <option value="<?php echo Product::PRICE_CALCULATION_METHOD_PER_BOOKING;?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add price once for the booking range'),$_smarty_tpl ) );?>
</option>
                            <option value="<?php echo Product::PRICE_CALCULATION_METHOD_PER_DAY;?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add price for each day of booking'),$_smarty_tpl ) );?>
</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Auto added service'),$_smarty_tpl ) );?>
</label>
                        <div>
                            <span class="switch prestashop-switch fixed-width-lg">
                                <input type="radio" name="new_service_auto_added" id="new_service_auto_added_on" value="1"/>
                                <label for="new_service_auto_added_on" class="radioCheck">
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes'),$_smarty_tpl ) );?>

                                </label>
                                <input type="radio" name="new_service_auto_added" id="new_service_auto_added_off" value="0" checked="checked"/>
                                <label for="new_service_auto_added_off" class="radioCheck">
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No'),$_smarty_tpl ) );?>

                                </label>
                                <a class="slide-button btn"></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div id="new_service_price_tax_rule_container" class="col-sm-6">
                        <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tax rule'),$_smarty_tpl ) );?>
</label>
                        <select name="new_service_price_tax_rule_group">
                            <option value="0"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No Tax'),$_smarty_tpl ) );?>
</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['taxRulesGroups']->value, 'taxRuleGroup');
$_smarty_tpl->tpl_vars['taxRuleGroup']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['taxRuleGroup']->value) {
$_smarty_tpl->tpl_vars['taxRuleGroup']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['taxRuleGroup']->value['id_tax_rules_group'];?>
"><?php echo $_smarty_tpl->tpl_vars['taxRuleGroup']->value['name'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    <div id="new_service_price_addition_type_container" class="col-sm-6" style="display:none;">
                        <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price display preference'),$_smarty_tpl ) );?>
</label>
                        <select name="new_service_price_addition_type" id="new_service_price_addition_type">
                            <option value="<?php echo Product::PRICE_ADDITION_TYPE_WITH_ROOM;?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add price in room price'),$_smarty_tpl ) );?>
</option>
                            <option value="<?php echo Product::PRICE_ADDITION_TYPE_INDEPENDENT;?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add price as convenience Fee'),$_smarty_tpl ) );?>
</option>
                        </select>
                    </div>
                    <div id="new_service_qty_container" class="col-sm-6">
                        <label class="control-label required"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity'),$_smarty_tpl ) );?>
</label>
                        <input type="number" class="form-control qty" min="1" name="new_service_qty" value="1">
                    </div>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['roomTypeTaxRuleGroupExist']->value) {?>
                    <div class="row form-group">
                        <div class="col-sm-12 help-block">
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Note: If auto added service is enabled, then tax of the booking\'s room type will be applicable.'),$_smarty_tpl ) );?>

                        </div>
                    </div>
                <?php }?>
                <input type="hidden" name="id_booking_detail" value="<?php echo $_smarty_tpl->tpl_vars['id_booking_detail']->value;?>
">
                <input type="hidden" id="room_type_tax_rule_group_exist" name="room_type_tax_rule_group_exist" value="<?php echo $_smarty_tpl->tpl_vars['roomTypeTaxRuleGroupExist']->value;?>
">
                <div class="modal-footer">
                    <button type="submit" id="save_new_service" class="btn btn-primary"><i class="icon icon-save"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Update Service"),$_smarty_tpl ) );?>
</button>
                </div>
            </form>
        <?php }?>

	<?php } elseif ((isset($_smarty_tpl->tpl_vars['additionalServices']->value)) && $_smarty_tpl->tpl_vars['additionalServices']->value) {?>
		<table class="table room_demand_detail">
			<thead>
				<tr>
					<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'ID'),$_smarty_tpl ) );?>
</th>
					<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</th>
					<th></th>
					<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit Price (tax excl.)'),$_smarty_tpl ) );?>
</th>
					<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Price (tax excl.)'),$_smarty_tpl ) );?>
</th>
					<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Price (tax incl.)'),$_smarty_tpl ) );?>
</th>
				</tr>
			</thead>
			</tbody>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['additionalServices']->value['additional_services'], 'service');
$_smarty_tpl->tpl_vars['service']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['service']->value) {
$_smarty_tpl->tpl_vars['service']->do_else = false;
?>
					<tr class="room_demand_block">
						<td>
							<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service']->value['id_product'], ENT_QUOTES, 'UTF-8', true);
if (!$_smarty_tpl->tpl_vars['service']->value['product_deleted']) {?> <a target="blank" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminNormalProducts'), ENT_QUOTES, 'UTF-8', true);?>
&amp;id_product=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
&amp;updateproduct"><i class="icon-external-link-sign"></i></a><?php }?>
						</td>
						<td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
						<td>
							<?php if ($_smarty_tpl->tpl_vars['service']->value['product_auto_add'] && $_smarty_tpl->tpl_vars['service']->value['product_price_addition_type'] == Product::PRICE_ADDITION_TYPE_INDEPENDENT) {?>
								<span class="badge badge-info label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Convenience fee'),$_smarty_tpl ) );?>
</span>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['service']->value['product_auto_add'] && $_smarty_tpl->tpl_vars['service']->value['product_price_addition_type'] == Product::PRICE_ADDITION_TYPE_WITH_ROOM) {?>
								<span class="badge badge-info label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Auto added'),$_smarty_tpl ) );?>
</span>
							<?php }?>
						</td>
						<td>
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['service']->value['unit_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value),$_smarty_tpl ) );?>

							<?php if ($_smarty_tpl->tpl_vars['service']->value['price_calculation_method'] == Product::PRICE_CALCULATION_METHOD_PER_DAY) {?>
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'/ night'),$_smarty_tpl ) );?>

							<?php }?>
						</td>
						<td>
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['service']->value['total_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value),$_smarty_tpl ) );?>

						</td>
                        <td>
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['service']->value['total_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['orderCurrency']->value),$_smarty_tpl ) );?>

						</td>
					</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</tbody>
		</table>
	<?php } else { ?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No services selected!'),$_smarty_tpl ) );?>

	<?php }?>
</div>
<?php }
}
