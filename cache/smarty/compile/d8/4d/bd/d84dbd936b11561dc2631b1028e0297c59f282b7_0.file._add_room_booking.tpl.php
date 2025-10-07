<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:29
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_add_room_booking.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29146a233_91440483',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd84dbd936b11561dc2631b1028e0297c59f282b7' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_add_room_booking.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29146a233_91440483 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal-body">
    <div id="new_room">
        <input type="hidden" id="add_product_product_id" name="add_product[product_id]" value="0" />
        <div class="form-group">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room Type:'),$_smarty_tpl ) );?>
</label>
            <div class="input-group">
                <input type="text" id="add_product_product_name" class="form-control" value="" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter the name of the room type'),$_smarty_tpl ) );?>
" />
                <div class="input-group-addon">
                    <i class="icon-search"></i>
                </div>
            </div>
        </div>
        <div class="add_room_fields bookingDuration" style="display:none;">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayAdminOrderAddRoomFormFieldsBefore'),$_smarty_tpl ) );?>

            <div class="row form-group">
                <div class="col-sm-6 room_check_in_div">
                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-In'),$_smarty_tpl ) );?>
</label>
                    <div class="input-group">
                        <input type="text" class="form-control add_room_date_from" name="add_product[date_from]" readonly />
                        <div class="input-group-addon"><i class="icon-calendar"></i></div>
                    </div>
                </div>
                <div class="col-sm-6 room_check_out_div">
                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-Out'),$_smarty_tpl ) );?>
</label>
                    <div class="input-group">
                        <input type="text" class="form-control add_room_date_to" name="add_product[date_to]" readonly/>
                        <div class="input-group-addon"><i class="icon-calendar"></i></div>
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
                        <input class="form-control" type="text" name="add_product[product_price_tax_excl]" id="add_product_product_price_tax_excl" value=""  disabled="disabled"/>
                        <?php if (!($_smarty_tpl->tpl_vars['currency']->value->format%2)) {?><div class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div><?php }?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price (tax incl.)'),$_smarty_tpl ) );?>
</label>
                    <div class="input-group">
                        <?php if ($_smarty_tpl->tpl_vars['currency']->value->format%2) {?><div class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div><?php }?>
                        <input class="form-control" type="text" name="add_product[product_price_tax_incl]" id="add_product_product_price_tax_incl" value=""  disabled="disabled"/>
                        <?php if (!($_smarty_tpl->tpl_vars['currency']->value->format%2)) {?><div class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div><?php }?>
                    </div>
                </div>
            </div>

            <div class="productQuantity">
                <?php if ($_smarty_tpl->tpl_vars['order']->value->with_occupancy) {?>
                    <div class="booking_occupancy form-group row">
                        <div class="col-sm-6">
                            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Occupancy'),$_smarty_tpl ) );?>
</label>
                            <div class="dropdown">
                                <button class="booking_guest_occupancy btn btn-default btn-left btn-block input-occupancy disabled form-control" type="button">
                                    <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select occupancy'),$_smarty_tpl ) );?>
</span>
                                </button>
                                <input type="hidden" class="max_avail_type_qty" value="">
                                <div class="dropdown-menu booking_occupancy_wrapper well well-sm">
                                    <div class="booking_occupancy_inner">
                                        <input type="hidden" class="max_adults" value="">
                                        <input type="hidden" class="max_children" value="">
                                        <input type="hidden" class="max_guests" value="">
                                        <div class="occupancy_info_block row" occ_block_index="0">
                                            <div class="occupancy_info_head col-sm-12"><label class="room_num_wrapper"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room - 1'),$_smarty_tpl ) );?>
</label></div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="form-group col-xs-6 occupancy_count_block">
                                                        <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );?>
</label>
                                                        <input type="number" class="form-control num_occupancy num_adults" name="occupancy[0][adults]" value="1" min="1">
                                                    </div>
                                                    <div class="form-group col-xs-6 occupancy_count_block">
                                                        <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );?>
 <span class="label-desc-txt"></span></label>
                                                        <input type="number" class="form-control num_occupancy num_children" name="occupancy[0][children]" value="0" min="0">
                                                        (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Below'),$_smarty_tpl ) );?>
  <?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['max_child_age']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'years'),$_smarty_tpl ) );?>
)
                                                    </div>
                                                </div>
                                                <div class="row children_age_info_block" style="display:none">
                                                    <div class="form-group col-sm-12">
                                                        <label class=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All Children'),$_smarty_tpl ) );?>
</label>
                                                        <div class="">
                                                            <div class="row children_ages">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="occupancy-info-separator col-sm-12">
                                        </div>
                                    </div>
                                    <div class="add_occupancy_block">
                                        <a class="add_new_occupancy_btn" href="#"><i class="icon-plus"></i> <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add Room'),$_smarty_tpl ) );?>
</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No. of rooms'),$_smarty_tpl ) );?>
</label>
                            <input type="number" class="form-control" name="add_product[product_quantity]" id="add_product_product_quantity" value="1" disabled="disabled" min="1"/>
                        </div>
                    </div>
                <?php }?>
            </div>

            <?php if ((isset($_smarty_tpl->tpl_vars['invoices_collection']->value)) && sizeof($_smarty_tpl->tpl_vars['invoices_collection']->value)) {?>
                <div class="form-group" style="display: none;">
                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invoice'),$_smarty_tpl ) );?>
</label>
                    <select class="form-control" name="add_product[invoice]" id="add_product_product_invoice" disabled="disabled">
                        <optgroup class="existing" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Existing'),$_smarty_tpl ) );?>
">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['invoices_collection']->value, 'invoice');
$_smarty_tpl->tpl_vars['invoice']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['invoice']->value) {
$_smarty_tpl->tpl_vars['invoice']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['invoice']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['invoice']->value->getInvoiceNumberFormatted($_smarty_tpl->tpl_vars['current_id_lang']->value);?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </optgroup>
                        <optgroup label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'New'),$_smarty_tpl ) );?>
">
                            <option value="0"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Create a new invoice'),$_smarty_tpl ) );?>
</option>
                        </optgroup>
                    </select>
                </div>
            <?php }?>
        </div>
        <button type="button" class="btn btn-default" id="submitAddRoom" disabled="disabled" style="display:none;"></button>
    </div>

    <?php if ((isset($_smarty_tpl->tpl_vars['loaderImg']->value)) && $_smarty_tpl->tpl_vars['loaderImg']->value) {?>
        <div class="loading_overlay">
            <img src='<?php echo $_smarty_tpl->tpl_vars['loaderImg']->value;?>
' class="loading-img"/>
        </div>
    <?php }?>
</div>
<?php }
}
