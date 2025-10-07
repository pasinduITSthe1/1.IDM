<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:29
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_add_order_extra_services_tab_content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f291155698_21668198',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '206e0a25465eeda8c83274f8630946ad5b676e60' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_add_order_extra_services_tab_content.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f291155698_21668198 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="room_type_service_product_desc" class="tab-pane<?php if (!(isset($_smarty_tpl->tpl_vars['selectedRoomDemands']->value)) || !$_smarty_tpl->tpl_vars['selectedRoomDemands']->value) {?> active<?php }?>">
    <?php if ($_smarty_tpl->tpl_vars['customServiceAllowed']->value) {?>
        <div class="row">
            <button id="btn_new_room_service" class="btn btn-success pull-right"><i class="icon-plus-circle"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add a new service'),$_smarty_tpl ) );?>
</button>
            <button id="back_to_service_btn" class="btn btn-default"><i class="icon-arrow-left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Back'),$_smarty_tpl ) );?>
</button>
        </div>
        <hr>
    <?php }?>
    <?php if ((isset($_smarty_tpl->tpl_vars['serviceProducts']->value)) && $_smarty_tpl->tpl_vars['serviceProducts']->value) {?>
        <div id="room_type_services_desc">
            <?php $_smarty_tpl->_assignInScope('roomCount', 1);?>
            <div class="row room_demands_container">
                <div class="col-sm-12 room_demand_detail">
                    <?php if ((isset($_smarty_tpl->tpl_vars['serviceProducts']->value)) && $_smarty_tpl->tpl_vars['serviceProducts']->value) {?>
                        <form id="update_selected_room_services_form">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</th>
                                        <th class="fixed-width-sm"></th>
                                        <th class="fixed-width-sm"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity'),$_smarty_tpl ) );?>
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
                                        <?php if ((isset($_smarty_tpl->tpl_vars['selectedRoomServiceProduct']->value['selected_service'])) && $_smarty_tpl->tpl_vars['selectedRoomServiceProduct']->value['selected_service'] && (array_key_exists($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['selectedRoomServiceProduct']->value['selected_service']))) {?>
                                            <?php $_smarty_tpl->_assignInScope('serviceSelected', true);?>
                                            <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['product']) ? $_smarty_tpl->tpl_vars['product']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['price_tax_incl'] = $_smarty_tpl->tpl_vars['selectedRoomServiceProduct']->value['selected_service'][$_smarty_tpl->tpl_vars['product']->value['id_product']]['unit_price_tax_incl'];
$_smarty_tpl->_assignInScope('product', $_tmp_array);?>
                                            <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['product']) ? $_smarty_tpl->tpl_vars['product']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['price_tax_exc'] = $_smarty_tpl->tpl_vars['selectedRoomServiceProduct']->value['selected_service'][$_smarty_tpl->tpl_vars['product']->value['id_product']]['unit_price_tax_excl'];
$_smarty_tpl->_assignInScope('product', $_tmp_array);?>
                                        <?php } else { ?>
                                            <?php $_smarty_tpl->_assignInScope('serviceSelected', false);?>
                                        <?php }?>
                                        <tr class="room_demand_block">
                                            <td>
                                                <input data-id_cart_booking="<?php echo $_smarty_tpl->tpl_vars['selectedRoomServiceProduct']->value['id'];?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
" type="checkbox" class="change_room_type_service_product" <?php if ($_smarty_tpl->tpl_vars['serviceSelected']->value) {?>checked<?php }?>/>

                                                <input id="selected_service_product_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['serviceSelected']->value) {?>1<?php } else { ?>0<?php }?>" name="selected_service_product[<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
]"/>
                                            </td>
                                            <td>
                                                <p><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                                            </td>
                                            <td>
                                                <?php if ($_smarty_tpl->tpl_vars['product']->value['auto_add_to_cart'] && $_smarty_tpl->tpl_vars['product']->value['price_addition_type'] == Product::PRICE_ADDITION_TYPE_INDEPENDENT) {?>
                                                    <span class="badge badge-info label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Convenience fee'),$_smarty_tpl ) );?>
</span>
                                                <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['product']->value['auto_add_to_cart'] && $_smarty_tpl->tpl_vars['product']->value['price_addition_type'] == Product::PRICE_ADDITION_TYPE_WITH_ROOM) {?>
                                                    <span class="badge badge-info label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Auto added'),$_smarty_tpl ) );?>
</span>
                                                <?php }?>
                                            </td>
                                            <td>
                                                <?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
                                                    <div class="qty_container">
                                                        <input type="number" class="form-control room_type_service_product_qty qty" id="qty_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" name="service_qty[<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
]" data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" min="1" data-max-quantity="<?php echo $_smarty_tpl->tpl_vars['product']->value['max_quantity'];?>
" value="<?php if ($_smarty_tpl->tpl_vars['serviceSelected']->value) {
echo $_smarty_tpl->tpl_vars['selectedRoomServiceProduct']->value['selected_service'][$_smarty_tpl->tpl_vars['product']->value['id_product']]['quantity'];
} else { ?>1<?php }?>" name="service_qty[<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
]">

                                                        <p style="display:<?php if ($_smarty_tpl->tpl_vars['serviceSelected']->value && $_smarty_tpl->tpl_vars['selectedRoomServiceProduct']->value['selected_service'][$_smarty_tpl->tpl_vars['product']->value['id_product']]['quantity'] > $_smarty_tpl->tpl_vars['product']->value['max_quantity']) {?>block<?php } else { ?>none<?php }?>; margin-top: 4px;">
                                                            <span class="label label-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Maximum allowed quantity: %s','sprintf'=>$_smarty_tpl->tpl_vars['product']->value['max_quantity']),$_smarty_tpl ) );?>
</span>
                                                        </p>
                                                    </div>
                                                <?php } else { ?>
                                                    --
                                                <?php }?>
                                            </td>
                                            <td>
                                                <?php if (($_smarty_tpl->tpl_vars['product']->value['show_price'] && !(isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value))) || (isset($_smarty_tpl->tpl_vars['groups']->value))) {?>
                                                    <div id="service_cart_price_<?php echo $_smarty_tpl->tpl_vars['selectedRoomServiceProduct']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_input" class="input-group">
                                                        <span class="input-group-addon">
                                                            <?php echo $_smarty_tpl->tpl_vars['cartCurrency']->value->sign;?>

                                                        </span>
                                                        <input class="service_cart_price_input" id="service_cart_price_<?php echo $_smarty_tpl->tpl_vars['selectedRoomServiceProduct']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" type="text" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['price_tax_exc'];?>
" name="service_price[<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
]"/>
                                                        <?php if (Product::PRICE_CALCULATION_METHOD_PER_DAY == $_smarty_tpl->tpl_vars['product']->value['price_calculation_method']) {?>
                                                            <span class="input-group-addon"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'/ night'),$_smarty_tpl ) );?>
</span>
                                                        <?php }?>
                                                    </div>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </tbody>
                            </table>
                            <input type="hidden" name="id_hotel_cart_booking" value="<?php echo $_smarty_tpl->tpl_vars['id_hotel_cart_booking']->value;?>
">
                            <div class="modal-footer">
                                <button type="submit" id="update_selected_services" class="btn btn-primary"><i class="icon icon-save"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Update Services"),$_smarty_tpl ) );?>
</button>
                            </div>
                        </form>
                    <?php }?>
                </div>
            </div>
        </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['customServiceAllowed']->value) {?>
        <div id="add_new_room_services_block" class="row">
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
                            <span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['cartCurrency']->value->sign;?>
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
                <input type="hidden" name="id_hotel_cart_booking" value="<?php echo $_smarty_tpl->tpl_vars['id_hotel_cart_booking']->value;?>
">
                <div class="row form-group">
                    <div class="col-sm-12 help-block">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Note: If auto added service is enabled, then tax of the booking\'s room type will be applicable.'),$_smarty_tpl ) );?>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="save_new_service" class="btn btn-primary"><i class="icon icon-save"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Update Service"),$_smarty_tpl ) );?>
</button>
                </div>
            </form>
        </div>
    <?php }?>
</div>
<?php }
}
