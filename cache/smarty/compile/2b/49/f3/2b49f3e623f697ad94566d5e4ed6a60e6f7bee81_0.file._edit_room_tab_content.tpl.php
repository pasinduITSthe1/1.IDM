<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:30
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_edit_room_tab_content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2922d14c9_98980889',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b49f3e623f697ad94566d5e4ed6a60e6f7bee81' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_edit_room_tab_content.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2922d14c9_98980889 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="edit_room_tab" class="tab-pane active">
    <input type="hidden" name="id_order" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_order'];?>
" />
    <input type="hidden" name="id_room" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_room'];?>
" />
    <input type="hidden" name="id_product" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_product'];?>
" />
    <input type="hidden" name="id_hotel" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_hotel'];?>
" />
    <input type="hidden" name="date_from" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['date_from'];?>
" />
    <input type="hidden" name="date_to" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['date_to'];?>
" />
    <input type="hidden" name="id_order_detail" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_order_detail'];?>
" />
    <input type="hidden" name="product_price_tax_excl" value="<?php echo Tools::ps_round($_smarty_tpl->tpl_vars['data']->value['original_unit_price_tax_excl'],'_PS_PRICE_COMPUTE_PRECISION_');?>
" />
    <input type="hidden" name="product_price_tax_incl" value="<?php echo Tools::ps_round($_smarty_tpl->tpl_vars['data']->value['original_unit_price_tax_incl'],'_PS_PRICE_COMPUTE_PRECISION_');?>
" />

    <?php if ((isset($_smarty_tpl->tpl_vars['data']->value['id_status'])) && ($_smarty_tpl->tpl_vars['data']->value['id_status'] != HotelBookingDetail::STATUS_ALLOTED)) {?>
        <div class="alert alert-info">
            <?php if ($_smarty_tpl->tpl_vars['data']->value['id_status'] == HotelBookingDetail::STATUS_CHECKED_IN) {?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The check-in date cannot be changed as the booking has already been checked in.'),$_smarty_tpl ) );?>

            <?php } elseif (HotelBookingDetail::STATUS_CHECKED_OUT) {?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The check-in and check-out date cannot be changed as the booking has already been checked out.'),$_smarty_tpl ) );?>

            <?php }?>
        </div>
    <?php }?>
    <div class="edit_room_fields">
        <div class="row form-group">
            <div class="col-sm-6 room_check_in_div">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-In'),$_smarty_tpl ) );?>
</label>
                <div class="input-group">
                    <input type="hidden" class="edit_product_date_from_actual" name="edit_product[date_from]"/>
                    <?php if ((isset($_smarty_tpl->tpl_vars['refundReqBookings']->value)) && $_smarty_tpl->tpl_vars['refundReqBookings']->value && in_array($_smarty_tpl->tpl_vars['data']->value['id'],$_smarty_tpl->tpl_vars['refundReqBookings']->value) && $_smarty_tpl->tpl_vars['data']->value['is_refunded']) {?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['data']->value['date_from']),$_smarty_tpl ) );?>

                    <?php } else { ?>
                        <input type="text" class="form-control edit_product_date_from" readonly <?php if ((isset($_smarty_tpl->tpl_vars['data']->value['id_status'])) && ($_smarty_tpl->tpl_vars['data']->value['id_status'] != HotelBookingDetail::STATUS_ALLOTED)) {?>disabled<?php }?>/>
                        <div class="input-group-addon"><i class="icon-calendar"></i></div>
                    <?php }?>
                </div>
            </div>
            <div class="col-sm-6 room_check_out_div">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-Out'),$_smarty_tpl ) );?>
</label>
                <div class="input-group">
                    <input type="hidden" class="edit_product_date_to_actual" name="edit_product[date_to]"/>
                    <?php if ((isset($_smarty_tpl->tpl_vars['refundReqBookings']->value)) && $_smarty_tpl->tpl_vars['refundReqBookings']->value && in_array($_smarty_tpl->tpl_vars['data']->value['id'],$_smarty_tpl->tpl_vars['refundReqBookings']->value) && $_smarty_tpl->tpl_vars['data']->value['is_refunded']) {?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['data']->value['date_to']),$_smarty_tpl ) );?>

                    <?php } else { ?>
                    <input type="text" class="form-control edit_product_date_to" readonly <?php if ((isset($_smarty_tpl->tpl_vars['data']->value['id_status'])) && ($_smarty_tpl->tpl_vars['data']->value['id_status'] == HotelBookingDetail::STATUS_CHECKED_OUT)) {?>disabled<?php }?>/>
                        <div class="input-group-addon"><i class="icon-calendar"></i></div>
                    <?php }?>
                </div>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-sm-6">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price (tax excl.)'),$_smarty_tpl ) );?>
</label>
                <div class="input-group">
                    <?php if ($_smarty_tpl->tpl_vars['currency']->value->format%2) {?><div class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div><?php }?>
                    <input class="form-control room_unit_price" type="text" name="room_unit_price" value=""/>
                    <?php if (!($_smarty_tpl->tpl_vars['currency']->value->format%2)) {?><div class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div><?php }?>
                </div>
            </div>
            <div class="col-sm-6">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Occupancy'),$_smarty_tpl ) );?>
</label>
                <div class="booking_occupancy_edit">
                    <div class="dropdown">
                        <button class="form-control booking_guest_occupancy btn btn-default btn-left btn-block input-occupancy" type="button">
                            <span>
                                <?php if ($_smarty_tpl->tpl_vars['data']->value['adults']) {
echo $_smarty_tpl->tpl_vars['data']->value['adults'];
}?> <?php if ($_smarty_tpl->tpl_vars['data']->value['adults'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adult'),$_smarty_tpl ) );
}
ob_start();
echo $_smarty_tpl->tpl_vars['data']->value['children'];
$_prefixVariable16 = ob_get_clean();
if ($_prefixVariable16) {?>, <?php echo $_smarty_tpl->tpl_vars['data']->value['children'];?>
 <?php if ($_smarty_tpl->tpl_vars['data']->value['children'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );
}
}?>
                            </span>
                        </button>
                        <div class="dropdown-menu booking_occupancy_wrapper fixed-width-xxl well well-sm">
                            <div class="booking_occupancy_inner">
                            <input type="hidden" class="max_adults" value="<?php if ((isset($_smarty_tpl->tpl_vars['data']->value['room_type_info']))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['room_type_info']['max_adults'], ENT_QUOTES, 'UTF-8', true);
}?>">
                            <input type="hidden" class="max_children" value="<?php if ((isset($_smarty_tpl->tpl_vars['data']->value['room_type_info']))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['room_type_info']['max_children'], ENT_QUOTES, 'UTF-8', true);
}?>">
                            <input type="hidden" class="max_guests" value="<?php if ((isset($_smarty_tpl->tpl_vars['data']->value['room_type_info']))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['room_type_info']['max_guests'], ENT_QUOTES, 'UTF-8', true);
}?>">
                                <div class="occupancy_info_block" occ_block_index="0">
                                    <div class="occupancy_info_head col-sm-12"><span class="room_num_wrapper"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room - 1'),$_smarty_tpl ) );?>
</span></div>
                                    <div class="row">
                                        <div class="col-xs-6 occupancy_count_block">
                                            <div class="col-sm-12">
                                                <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );?>
</label>
                                                <input type="number" class="form-control num_occupancy num_adults" name="occupancy[0][adults]" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['adults'];?>
" min="1"  max="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['room_type_info']['max_adults'], ENT_QUOTES, 'UTF-8', true);?>
">
                                            </div>
                                        </div>
                                        <div class="col-xs-6 occupancy_count_block">
                                            <div class="col-sm-12">
                                                <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );?>
 <span class="label-desc-txt"></span></label>
                                                <input type="number" class="form-control num_occupancy num_children" name="occupancy[0][children]" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['children'];?>
" min="0" max="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['room_type_info']['max_children'], ENT_QUOTES, 'UTF-8', true);?>
">
                                                (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Below'),$_smarty_tpl ) );?>
  <?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['max_child_age']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'years'),$_smarty_tpl ) );?>
)
                                            </div>
                                        </div>
                                    </div>

                                    <p style="display:none;"><span class="text-danger occupancy-input-errors"></span></p>
                                    <div class="row children_age_info_block" <?php if (!(isset($_smarty_tpl->tpl_vars['data']->value['child_ages'])) || !$_smarty_tpl->tpl_vars['data']->value['child_ages']) {?>style="display:none"<?php }?>>
                                        <div class="col-sm-12">
                                            <label class="col-sm-12"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All Children'),$_smarty_tpl ) );?>
</label>
                                            <div class="col-sm-12">
                                                <div class="row children_ages">
                                                    <?php if ((isset($_smarty_tpl->tpl_vars['data']->value['child_ages'])) && $_smarty_tpl->tpl_vars['data']->value['child_ages']) {?>
                                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['child_ages'], 'childAge');
$_smarty_tpl->tpl_vars['childAge']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['childAge']->value) {
$_smarty_tpl->tpl_vars['childAge']->do_else = false;
?>
                                                            <p class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                                                <select class="guest_child_age room_occupancies" name="occupancy[0][child_ages][]">
                                                                    <option value="-1" <?php if ($_smarty_tpl->tpl_vars['childAge']->value == -1) {?>selected<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select age'),$_smarty_tpl ) );?>
</option>
                                                                    <option value="0" <?php if ($_smarty_tpl->tpl_vars['childAge']->value == 0) {?>selected<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Under 1'),$_smarty_tpl ) );?>
</option>
                                                                    <?php
$_smarty_tpl->tpl_vars['age'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['age']->step = 1;$_smarty_tpl->tpl_vars['age']->total = (int) ceil(($_smarty_tpl->tpl_vars['age']->step > 0 ? ($_smarty_tpl->tpl_vars['max_child_age']->value-1)+1 - (1) : 1-(($_smarty_tpl->tpl_vars['max_child_age']->value-1))+1)/abs($_smarty_tpl->tpl_vars['age']->step));
if ($_smarty_tpl->tpl_vars['age']->total > 0) {
for ($_smarty_tpl->tpl_vars['age']->value = 1, $_smarty_tpl->tpl_vars['age']->iteration = 1;$_smarty_tpl->tpl_vars['age']->iteration <= $_smarty_tpl->tpl_vars['age']->total;$_smarty_tpl->tpl_vars['age']->value += $_smarty_tpl->tpl_vars['age']->step, $_smarty_tpl->tpl_vars['age']->iteration++) {
$_smarty_tpl->tpl_vars['age']->first = $_smarty_tpl->tpl_vars['age']->iteration === 1;$_smarty_tpl->tpl_vars['age']->last = $_smarty_tpl->tpl_vars['age']->iteration === $_smarty_tpl->tpl_vars['age']->total;?>
                                                                        <option value="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['age']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['childAge']->value == $_smarty_tpl->tpl_vars['age']->value) {?>selected<?php }?>><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['age']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</option>
                                                                    <?php }
}
?>
                                                                </select>
                                                            </p>
                                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product_invoice" style="display: none;">
            <select name="product_invoice" class="edit_product_invoice">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['invoices_collection']->value, 'invoice');
$_smarty_tpl->tpl_vars['invoice']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['invoice']->value) {
$_smarty_tpl->tpl_vars['invoice']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['invoice']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['invoice']->value->id == $_smarty_tpl->tpl_vars['data']->value['id_order_invoice']) {?>selected="selected"<?php }?>>
                        #<?php echo Configuration::get('PS_INVOICE_PREFIX',$_smarty_tpl->tpl_vars['current_id_lang']->value,null,$_smarty_tpl->tpl_vars['order']->value->id_shop);
echo sprintf('%06d',$_smarty_tpl->tpl_vars['invoice']->value->number);?>

                    </option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="submitRoomChange" class="btn btn-primary"><i class="icon icon-bed"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Update Rooms"),$_smarty_tpl ) );?>
</button>
    </div>
</div><?php }
}
