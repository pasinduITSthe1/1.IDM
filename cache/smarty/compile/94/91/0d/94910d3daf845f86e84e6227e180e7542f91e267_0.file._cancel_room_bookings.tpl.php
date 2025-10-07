<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:29
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_cancel_room_bookings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2918889a3_99207416',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '94910d3daf845f86e84e6227e180e7542f91e267' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_cancel_room_bookings.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2918889a3_99207416 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),1=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<div class="modal-body">
    <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['bookingOrderInfo']->value) > 0 || smarty_modifier_count($_smarty_tpl->tpl_vars['serviceProducts']->value) > 0) {?>
        <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['bookingOrderInfo']->value) > 0 && smarty_modifier_count($_smarty_tpl->tpl_vars['serviceProducts']->value) > 0) {?>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#refund_rooms_tab" role="tab" data-toggle="tab"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rooms'),$_smarty_tpl ) );?>
</a>
                </li>
                <li role="presentation">
                    <a href="#refund_products_tab" aria-controls="products" role="tab" data-toggle="tab"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Products'),$_smarty_tpl ) );?>
</a>
                </li>
            </ul>
        <?php }?>

        <form id="order_refund_form" action="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&amp;vieworder&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);?>
&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
" method="post">
            <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['bookingOrderInfo']->value) > 0 && smarty_modifier_count($_smarty_tpl->tpl_vars['serviceProducts']->value) > 0) {?>
                <div class="form-group tab-content clearfix">
            <?php }?>
                <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['bookingOrderInfo']->value)) {?>
                    <div id="refund_rooms_tab" class="form-group table-responsive tab-pane active">
                        <table class="table" id="customer_cart_details">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room No.'),$_smarty_tpl ) );?>
</th>
                                    <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room Type'),$_smarty_tpl ) );?>
</th>
                                    <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hotel Name'),$_smarty_tpl ) );?>
</th>
                                    <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duration'),$_smarty_tpl ) );?>
</th>
                                    <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Price (Tax incl.)'),$_smarty_tpl ) );?>
</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bookingOrderInfo']->value, 'bookingInfo');
$_smarty_tpl->tpl_vars['bookingInfo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['bookingInfo']->value) {
$_smarty_tpl->tpl_vars['bookingInfo']->do_else = false;
?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="id_htl_booking[]" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['bookingInfo']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
"/>
                                        </td>
                                        <td><b><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['bookingInfo']->value['room_num'], ENT_QUOTES, 'UTF-8', true);?>
</b></td>
                                        <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['bookingInfo']->value['room_type_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                                        <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['bookingInfo']->value['hotel_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                                        <?php $_smarty_tpl->_assignInScope('is_full_date', ($_smarty_tpl->tpl_vars['show_full_date']->value && (smarty_modifier_date_format($_smarty_tpl->tpl_vars['bookingInfo']->value['date_from'],'%D') == smarty_modifier_date_format($_smarty_tpl->tpl_vars['bookingInfo']->value['date_to'],'%D'))));?>
                                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['bookingInfo']->value['date_from'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>
 - <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['bookingInfo']->value['date_to'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>
</span></td>
                                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['bookingInfo']->value['total_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</td>
                                    </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>
                <?php }?>
                <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['serviceProducts']->value)) {?>
                    <div id="refund_products_tab" class="form-group table-responsive tab-pane">
                        <table class="table" id="customer_cart_product_details">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</th>
                                    <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity'),$_smarty_tpl ) );?>
</th>
                                    <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Price (Tax incl.)'),$_smarty_tpl ) );?>
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
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="id_service_product_order_detail[]" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['id_service_product_order_detail'], ENT_QUOTES, 'UTF-8', true);?>
"/>
                                        </td>
                                        <td><b><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);
if ($_smarty_tpl->tpl_vars['product']->value['option_name']) {?> : <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['option_name'], ENT_QUOTES, 'UTF-8', true);
}?></b></td>
                                        <td><?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['quantity'], ENT_QUOTES, 'UTF-8', true);
} else { ?>--<?php }?></td>
                                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</td>
                                    </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>
                <?php }?>
            <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['bookingOrderInfo']->value) > 0 && smarty_modifier_count($_smarty_tpl->tpl_vars['serviceProducts']->value) > 0) {?>
                </div>
            <?php }?>
            <div class="form-group">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reason to Cancel'),$_smarty_tpl ) );?>
</label>
                <textarea rows="3" class="textarea-autosize cancellation_reason" name="cancellation_reason"></textarea>
            </div>

            <button style="display: none;" type="submit" name="initiateRefund" class="btn btn-primary" id="initiateRefund">
                <?php if ($_smarty_tpl->tpl_vars['order']->value->hasBeenPaid()) {?><i class="icon-undo"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Initiate Refund'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Submit'),$_smarty_tpl ) );
}?>
            </button>

        </form>
    <?php } else { ?>
        <div class="list-empty">
            <div class="list-empty-msg">
                <i class="icon-warning-sign list-empty-icon"></i>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No room bookings found to cancel'),$_smarty_tpl ) );?>

            </div>
        </div>
    <?php }?>

    <?php if ((isset($_smarty_tpl->tpl_vars['loaderImg']->value)) && $_smarty_tpl->tpl_vars['loaderImg']->value) {?>
        <div class="loading_overlay">
            <img src='<?php echo $_smarty_tpl->tpl_vars['loaderImg']->value;?>
' class="loading-img"/>
        </div>
    <?php }?>
</div>
<?php }
}
