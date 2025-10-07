<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:28
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\helpers\view\view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f290dd3233_81397463',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6d582ef4d035a228f62a785f4215a342961650e3' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\helpers\\view\\view.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:controllers/orders/_overbookings.tpl' => 1,
    'file:controllers/orders/_documents.tpl' => 1,
    'file:controllers/orders/_rooms_informaion_table.tpl' => 1,
    'file:controllers/orders/_hotel_service_products_table.tpl' => 1,
    'file:controllers/orders/_standalone_service_products_table.tpl' => 1,
  ),
),false)) {
function content_68e4f290dd3233_81397463 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_128523061568e4f28f608f52_92937071', 'pageTitle');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_186945306268e4f28f66ebd2_64743383', "override_tpl");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/view/view.tpl");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "page_header_toolbar.tpl");
}
/* {block 'pageTitle'} */
class Block_128523061568e4f28f608f52_92937071 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'pageTitle' => 
  array (
    0 => 'Block_128523061568e4f28f608f52_92937071',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <h2 class="order_page_title page-title">
        <?php if (is_array($_smarty_tpl->tpl_vars['title']->value)) {
echo preg_replace('!<[^>]*?>!', ' ', (string) end($_smarty_tpl->tpl_vars['title']->value));
} else {
echo preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['title']->value);
}?>
        <?php if ($_smarty_tpl->tpl_vars['currentState']->value->id == Configuration::get('PS_OS_REFUND')) {?>
            <span class="toolbar_order_status_badge badge badge-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refunded'),$_smarty_tpl ) );?>
</span>
        <?php } elseif ($_smarty_tpl->tpl_vars['currentState']->value->id == Configuration::get('PS_OS_CANCELED')) {?>
            <span class="toolbar_order_status_badge badge badge-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancelled'),$_smarty_tpl ) );?>
</span>
        <?php } else { ?>
            <span class="toolbar_order_status_badge badge badge-success"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Booked'),$_smarty_tpl ) );?>
</span>
        <?php }?>
    </h2>
<?php
}
}
/* {/block 'pageTitle'} */
/* {block "override_tpl"} */
class Block_186945306268e4f28f66ebd2_64743383 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'override_tpl' => 
  array (
    0 => 'Block_186945306268e4f28f66ebd2_64743383',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),1=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),2=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.implode.php','function'=>'smarty_modifier_implode',),3=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.regex_replace.php','function'=>'smarty_modifier_regex_replace',),));
?>

	<?php echo '<script'; ?>
 type="text/javascript">
	var admin_order_tab_link = "<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'));?>
";
    var rooms_reallocation_url = "<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'));?>
";
	var id_order = <?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
;
	var id_lang = <?php echo $_smarty_tpl->tpl_vars['current_id_lang']->value;?>
;
	var id_currency = <?php echo $_smarty_tpl->tpl_vars['order']->value->id_currency;?>
;
	var id_customer = <?php echo intval($_smarty_tpl->tpl_vars['order']->value->id_customer);?>
;
	<?php $_smarty_tpl->_assignInScope('PS_TAX_ADDRESS_TYPE', Configuration::get('PS_TAX_ADDRESS_TYPE'));?>
	var id_address = <?php echo $_smarty_tpl->tpl_vars['order']->value->{$_smarty_tpl->tpl_vars['PS_TAX_ADDRESS_TYPE']->value};?>
;
	var currency_sign = "<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
";
	var currency_format = "<?php echo $_smarty_tpl->tpl_vars['currency']->value->format;?>
";
	var currency_blank = "<?php echo $_smarty_tpl->tpl_vars['currency']->value->blank;?>
";
	var priceDisplayPrecision = <?php echo intval((defined('_PS_PRICE_DISPLAY_PRECISION_') ? constant('_PS_PRICE_DISPLAY_PRECISION_') : null));?>
;
	var use_taxes = <?php if ($_smarty_tpl->tpl_vars['order']->value->getTaxCalculationMethod() == (defined('PS_TAX_INC') ? constant('PS_TAX_INC') : null)) {?>true<?php } else { ?>false<?php }?>;
	var stock_management = <?php echo intval($_smarty_tpl->tpl_vars['stock_management']->value);?>
;
	var txt_add_product_stock_issue = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Are you sure you want to add this quantity?','js'=>1),$_smarty_tpl ) );?>
";
	var txt_add_product_new_invoice = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Are you sure you want to create a new invoice?','js'=>1),$_smarty_tpl ) );?>
";
	var txt_add_product_no_product = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Error: No product has been selected','js'=>1),$_smarty_tpl ) );?>
";
	var txt_add_product_no_product_quantity = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Error: Quantity of products must be set','js'=>1),$_smarty_tpl ) );?>
";
	var txt_add_product_no_product_price = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Error: Product price must be set','js'=>1),$_smarty_tpl ) );?>
";
	var txt_confirm = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Are you sure?','js'=>1),$_smarty_tpl ) );?>
";
	var statesShipped = new Array();
	var has_voucher = <?php if (count($_smarty_tpl->tpl_vars['discounts']->value)) {?>1<?php } else { ?>0<?php }?>;
    var allowBackdateOrder = <?php if ($_smarty_tpl->tpl_vars['allowBackdateOrder']->value) {
echo $_smarty_tpl->tpl_vars['allowBackdateOrder']->value;
} else { ?>false<?php }?>;
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['states']->value, 'state');
$_smarty_tpl->tpl_vars['state']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->do_else = false;
?>
		<?php if (((isset($_smarty_tpl->tpl_vars['currentState']->value->shipped)) && !$_smarty_tpl->tpl_vars['currentState']->value->shipped && $_smarty_tpl->tpl_vars['state']->value['shipped'])) {?>
			statesShipped.push(<?php echo $_smarty_tpl->tpl_vars['state']->value['id_order_state'];?>
);
		<?php }?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	var order_discount_price = <?php if (($_smarty_tpl->tpl_vars['order']->value->getTaxCalculationMethod() == (defined('PS_TAX_EXC') ? constant('PS_TAX_EXC') : null))) {?>
									<?php echo $_smarty_tpl->tpl_vars['order']->value->total_discounts_tax_excl;?>

								<?php } else { ?>
									<?php echo $_smarty_tpl->tpl_vars['order']->value->total_discounts_tax_incl;?>

								<?php }?>;

	var errorRefund = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Error. You cannot refund a negative amount.'),$_smarty_tpl ) );?>
";
	<?php echo '</script'; ?>
>

	<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayInvoice",'id_order'=>$_smarty_tpl->tpl_vars['order']->value->id),$_smarty_tpl ) );
$_prefixVariable13 = ob_get_clean();
$_smarty_tpl->_assignInScope('hook_invoice', $_prefixVariable13);?>
	<?php if (($_smarty_tpl->tpl_vars['hook_invoice']->value)) {?>
	<div><?php echo $_smarty_tpl->tpl_vars['hook_invoice']->value;?>
</div>
	<?php }?>

    <div id="order_detail_view">
                <?php $_smarty_tpl->_subTemplateRender('file:controllers/orders/_overbookings.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <div class="row">
            <div class="col-lg-7">
                <?php if ((isset($_smarty_tpl->tpl_vars['htl_booking_order_data']->value)) && $_smarty_tpl->tpl_vars['htl_booking_order_data']->value) {?>
                    <div class="panel">
                        <div class="panel-heading order_status_heading">
                            <i class="icon-bed"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rooms Status'),$_smarty_tpl ) );?>

                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-lg-12 table-responsive" id="room_status_info_wrapper">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room'),$_smarty_tpl ) );?>
</th>
                                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duration'),$_smarty_tpl ) );?>
</th>
                                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-In'),$_smarty_tpl ) );?>
</th>
                                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-Out'),$_smarty_tpl ) );?>
</th>
                                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Allotment'),$_smarty_tpl ) );?>
</th>
                                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Action'),$_smarty_tpl ) );?>
</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ((isset($_smarty_tpl->tpl_vars['htl_booking_order_data']->value)) && $_smarty_tpl->tpl_vars['htl_booking_order_data']->value) {?>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['htl_booking_order_data']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $_smarty_tpl->tpl_vars['data']->value['room_num'];?>
<br>
                                                            <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminProducts'), ENT_QUOTES, 'UTF-8', true);?>
&amp;id_product=<?php echo $_smarty_tpl->tpl_vars['data']->value['id_product'];?>
&amp;updateproduct" target="_blank"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['room_type_name'], ENT_QUOTES, 'UTF-8', true);?>
</a>
                                                        </td>
                                                        <td>
                                                            <?php $_smarty_tpl->_assignInScope('is_full_date', ($_smarty_tpl->tpl_vars['show_full_date']->value && (smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['date_from'],'%D') == smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['date_to'],'%D'))));?>
                                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['data']->value['date_from'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>
 - <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['data']->value['date_to'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>

                                                        </td>
                                                        <td>
                                                            <?php if (($_smarty_tpl->tpl_vars['data']->value['id_status'] == $_smarty_tpl->tpl_vars['hotel_order_status']->value['STATUS_CHECKED_IN']['id_status']) || ($_smarty_tpl->tpl_vars['data']->value['id_status'] == $_smarty_tpl->tpl_vars['hotel_order_status']->value['STATUS_CHECKED_OUT']['id_status'])) {?>
                                                                <span class="text-danger room_status"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Checked in on'),$_smarty_tpl ) );?>
<br><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['data']->value['check_in'],'full'=>1),$_smarty_tpl ) );?>
</span>
                                                            <?php } else { ?>
                                                                --
                                                            <?php }?>
                                                        </td>
                                                        <td>
                                                            <?php if ($_smarty_tpl->tpl_vars['data']->value['id_status'] == $_smarty_tpl->tpl_vars['hotel_order_status']->value['STATUS_CHECKED_OUT']['id_status']) {?>
                                                                <span class="text-success room_status"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Checked out on'),$_smarty_tpl ) );?>
<br><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['data']->value['check_out'],'full'=>1),$_smarty_tpl ) );?>
</span>
                                                            <?php } else { ?>
                                                                --
                                                            <?php }?>
                                                        </td>
                                                        <td>
                                                            <?php if ($_smarty_tpl->tpl_vars['data']->value['booking_type'] == $_smarty_tpl->tpl_vars['ALLOTMENT_MANUAL']->value) {?>
                                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Manual'),$_smarty_tpl ) );?>
 &nbsp;<?php if ($_smarty_tpl->tpl_vars['data']->value['comment'] != '') {?><a class="manual_allotment_comment" href="#" data-id_hotel_booking_detail="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><i class="icon-info-circle"></i></a><?php }?>
                                                            <?php } else { ?>
                                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Auto'),$_smarty_tpl ) );?>

                                                            <?php }?>
                                                        </td>
                                                        <td>
                                                            <a title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Upload/Check guest documents'),$_smarty_tpl ) );?>
" class="btn btn-default" href="#" onclick="BookingDocumentsModal.init(<?php echo intval($_smarty_tpl->tpl_vars['data']->value['id']);?>
, this); return false;">
                                                                <span class="badge badge-info"><?php if ($_smarty_tpl->tpl_vars['data']->value['num_checkin_documents'] > 0) {
echo $_smarty_tpl->tpl_vars['data']->value['num_checkin_documents'];
} else { ?>0<?php }?></span> <i class="icon-file-text"></i>
                                                            </a>

                                                            <?php if ((isset($_smarty_tpl->tpl_vars['refundReqBookings']->value)) && $_smarty_tpl->tpl_vars['refundReqBookings']->value && in_array($_smarty_tpl->tpl_vars['data']->value['id'],$_smarty_tpl->tpl_vars['refundReqBookings']->value) && $_smarty_tpl->tpl_vars['data']->value['is_refunded']) {?>
                                                                <span class="badge badge-danger"><?php if ($_smarty_tpl->tpl_vars['data']->value['is_cancelled']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancelled'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refunded'),$_smarty_tpl ) );
}?></span>
                                                            <?php } elseif ($_smarty_tpl->tpl_vars['can_edit']->value) {?>
                                                                <a class="open_room_status_form btn btn-default" href="#" data-id_hotel_booking_detail="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-id_order="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_order'];?>
" data-id_status="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_status'];?>
" data-id_room="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_room'];?>
" data-date_from="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['date_from'],"%Y-%m-%d");?>
" data-date_to="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['date_to'],"%Y-%m-%d");?>
" data-check_in_time="<?php echo $_smarty_tpl->tpl_vars['data']->value['check_in_time'];?>
" data-check_out_time="<?php echo $_smarty_tpl->tpl_vars['data']->value['check_out_time'];?>
">
                                                                    <i class="icon-pencil"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit'),$_smarty_tpl ) );?>

                                                                </a>
                                                            <?php }?>
                                                        </td>
                                                    </tr>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td class="list-empty hidden-print" colspan="6">
                                                        <div class="list-empty-msg">
                                                            <i class="icon-warning-sign list-empty-icon"></i>
                                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No rooms found'),$_smarty_tpl ) );?>

                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
                <div class="panel">
                    <div class="panel-heading">
                        <i class="icon-file"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order'),$_smarty_tpl ) );?>

                        <span class="badge"><?php echo $_smarty_tpl->tpl_vars['order']->value->reference;?>
</span>
                        <span class="badge"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"#"),$_smarty_tpl ) );
echo $_smarty_tpl->tpl_vars['order']->value->id;?>
</span>
                        <div class="panel-heading-action">
                            <div class="btn-group">
                                <a class="btn btn-default<?php if (!$_smarty_tpl->tpl_vars['previousOrder']->value) {?> disabled<?php }?>" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'), ENT_QUOTES, 'UTF-8', true);?>
&amp;vieworder&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['previousOrder']->value);?>
">
                                    <i class="icon-backward"></i>
                                </a>
                                <a class="btn btn-default<?php if (!$_smarty_tpl->tpl_vars['nextOrder']->value) {?> disabled<?php }?>" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'), ENT_QUOTES, 'UTF-8', true);?>
&amp;vieworder&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['nextOrder']->value);?>
">
                                    <i class="icon-forward"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Tab nav -->
                    <ul class="nav nav-tabs" id="tabOrder">
                        <?php echo $_smarty_tpl->tpl_vars['HOOK_TAB_ORDER']->value;?>

                        <li class="active">
                            <a  href="#status">
                                <i class="icon-time"></i>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status'),$_smarty_tpl ) );?>
 <span class="badge"><?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['history']->value);?>
</span>
                            </a>
                        </li>
                        <li>
                            <a  href="#documents">
                                <i class="icon-file-text"></i>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Documents'),$_smarty_tpl ) );?>
 <span class="badge"><?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['order']->value->getDocuments());?>
</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab content -->
                    <div class="tab-content panel">
                        <?php echo $_smarty_tpl->tpl_vars['HOOK_CONTENT_ORDER']->value;?>

                        <!-- Tab status -->
                        <div class="tab-pane active" id="status">
                            <h4 class="visible-print"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status'),$_smarty_tpl ) );?>
 <span class="badge">(<?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['history']->value);?>
)</span></h4>
                            <!-- History of status -->
                            <div class="table-responsive">
                                <table class="table history-status row-margin-bottom">
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['history']->value, 'row', false, 'key');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
                                            <?php if (($_smarty_tpl->tpl_vars['key']->value == 0)) {?>
                                                <tr>
                                                    <td style="background-color:<?php echo $_smarty_tpl->tpl_vars['row']->value['color'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)$_smarty_tpl->tpl_vars['img_dir']->value)."os/".((string)(intval($_smarty_tpl->tpl_vars['row']->value['id_order_state']))).".gif");?>
" width="16" height="16" alt="<?php if (!empty($_smarty_tpl->tpl_vars['row']->value['ostate_name'])) {
echo stripslashes($_smarty_tpl->tpl_vars['row']->value['ostate_name']);
}?>" /></td>                                                     <td style="background-color:<?php echo $_smarty_tpl->tpl_vars['row']->value['color'];?>
;color:<?php echo $_smarty_tpl->tpl_vars['row']->value['text-color'];?>
"><?php if (!empty($_smarty_tpl->tpl_vars['row']->value['ostate_name'])) {
echo stripslashes($_smarty_tpl->tpl_vars['row']->value['ostate_name']);
}?></td>
                                                    <td style="background-color:<?php echo $_smarty_tpl->tpl_vars['row']->value['color'];?>
;color:<?php echo $_smarty_tpl->tpl_vars['row']->value['text-color'];?>
"><?php if ($_smarty_tpl->tpl_vars['row']->value['employee_lastname']) {
echo stripslashes($_smarty_tpl->tpl_vars['row']->value['employee_firstname']);?>
 <?php echo stripslashes($_smarty_tpl->tpl_vars['row']->value['employee_lastname']);
}?></td>
                                                    <td style="background-color:<?php echo $_smarty_tpl->tpl_vars['row']->value['color'];?>
;color:<?php echo $_smarty_tpl->tpl_vars['row']->value['text-color'];?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['row']->value['date_add'],'full'=>true),$_smarty_tpl ) );?>
</td>

                                                    <?php if ($_smarty_tpl->tpl_vars['can_edit']->value) {?>
                                                        <td style="background-color:<?php echo $_smarty_tpl->tpl_vars['row']->value['color'];?>
;color:<?php echo $_smarty_tpl->tpl_vars['row']->value['text-color'];?>
" class="text-right">
                                                            <?php if (intval($_smarty_tpl->tpl_vars['row']->value['send_email'])) {?>
                                                                <a class="btn btn-default" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'), ENT_QUOTES, 'UTF-8', true);?>
&amp;vieworder&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
&amp;sendStateEmail=<?php echo intval($_smarty_tpl->tpl_vars['row']->value['id_order_state']);?>
&amp;id_order_history=<?php echo intval($_smarty_tpl->tpl_vars['row']->value['id_order_history']);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Resend this email to the customer'),$_smarty_tpl ) );?>
">
                                                                    <i class="icon-mail-reply"></i>
                                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Resend email'),$_smarty_tpl ) );?>

                                                                </a>
                                                            <?php }?>
                                                        </td>
                                                    <?php }?>
                                                </tr>
                                            <?php } else { ?>
                                                <tr>
                                                    <td><img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)$_smarty_tpl->tpl_vars['img_dir']->value)."os/".((string)(intval($_smarty_tpl->tpl_vars['row']->value['id_order_state']))).".gif");?>
" width="16" height="16" /></td>
                                                    <td><?php if (!empty($_smarty_tpl->tpl_vars['row']->value['ostate_name'])) {
echo stripslashes($_smarty_tpl->tpl_vars['row']->value['ostate_name']);
}?></td>
                                                    <td><?php if ($_smarty_tpl->tpl_vars['row']->value['employee_lastname']) {
echo stripslashes($_smarty_tpl->tpl_vars['row']->value['employee_firstname']);?>
 <?php echo stripslashes($_smarty_tpl->tpl_vars['row']->value['employee_lastname']);
} else { ?>&nbsp;<?php }?></td>
                                                    <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['row']->value['date_add'],'full'=>true),$_smarty_tpl ) );?>
</td>
                                                    <?php if ($_smarty_tpl->tpl_vars['can_edit']->value) {?>
                                                        <td class="text-right">
                                                            <?php if (intval($_smarty_tpl->tpl_vars['row']->value['send_email'])) {?>
                                                                <a  href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'), ENT_QUOTES, 'UTF-8', true);?>
&amp;vieworder&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
&amp;sendStateEmail=<?php echo intval($_smarty_tpl->tpl_vars['row']->value['id_order_state']);?>
&amp;id_order_history=<?php echo intval($_smarty_tpl->tpl_vars['row']->value['id_order_history']);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Resend this email to the customer'),$_smarty_tpl ) );?>
">
                                                                    <i class="icon-mail-reply"></i>
                                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Resend email'),$_smarty_tpl ) );?>

                                                                </a>
                                                            <?php }?>
                                                        </td>
                                                    <?php }?>
                                                </tr>
                                            <?php }?>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Change status form -->
                                                        <?php if ($_smarty_tpl->tpl_vars['can_edit']->value && (!(isset($_smarty_tpl->tpl_vars['currentState']->value)) || ((isset($_smarty_tpl->tpl_vars['currentState']->value)) && ($_smarty_tpl->tpl_vars['currentState']->value->id != Configuration::get('PS_OS_REFUND') && $_smarty_tpl->tpl_vars['currentState']->value->id != Configuration::get('PS_OS_CANCELED'))))) {?>
                                <form action="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['currentIndex']->value, ENT_QUOTES, 'UTF-8', true);?>
&amp;vieworder&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
&amp;token=<?php echo $_GET['token'];?>
" method="post" class="form-horizontal well hidden-print">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <select id="id_order_state" class="chosen form-control" name="id_order_state">
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['states']->value, 'state');
$_smarty_tpl->tpl_vars['state']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->do_else = false;
?>
                                                    <option value="<?php echo intval($_smarty_tpl->tpl_vars['state']->value['id_order_state']);?>
"<?php if ((isset($_smarty_tpl->tpl_vars['currentState']->value)) && $_smarty_tpl->tpl_vars['state']->value['id_order_state'] == $_smarty_tpl->tpl_vars['currentState']->value->id) {?> selected="selected" disabled="disabled"<?php } elseif (($_smarty_tpl->tpl_vars['state']->value['id_order_state'] == Configuration::get('PS_OS_REFUND') && ($_smarty_tpl->tpl_vars['total_paid']->value <= 0 && !smarty_modifier_count($_smarty_tpl->tpl_vars['discounts']->value)))) {?> disabled="disabled"<?php } elseif (($_smarty_tpl->tpl_vars['state']->value['id_order_state'] == Configuration::get('PS_OS_CANCELED') && ($_smarty_tpl->tpl_vars['totalRefundedRooms']->value || smarty_modifier_count($_smarty_tpl->tpl_vars['discounts']->value) || $_smarty_tpl->tpl_vars['total_paid']->value > 0))) {?> disabled="disabled"<?php } elseif (($_smarty_tpl->tpl_vars['state']->value['id_order_state'] == Configuration::get('PS_OS_OVERBOOKING_PAID') || $_smarty_tpl->tpl_vars['state']->value['id_order_state'] == Configuration::get('PS_OS_OVERBOOKING_UNPAID') || $_smarty_tpl->tpl_vars['state']->value['id_order_state'] == Configuration::get('PS_OS_OVERBOOKING_PARTIAL_PAID')) && (!(isset($_smarty_tpl->tpl_vars['orderOverBookings']->value)) || !$_smarty_tpl->tpl_vars['orderOverBookings']->value)) {?> disabled="disabled"<?php }?>><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['state']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</option>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            </select>
                                            <input type="hidden" name="id_order" value="<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
" />
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="submit" name="submitState" class="btn btn-primary">
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Update status'),$_smarty_tpl ) );?>

                                            </button>
                                        </div>
                                    </div>
                                </form>
                            <?php }?>
                        </div>
                        <!-- Tab documents -->
                        <div class="tab-pane" id="documents">
                            <h4 class="visible-print"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Documents'),$_smarty_tpl ) );?>
 <span class="badge">(<?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['order']->value->getDocuments());?>
)</span></h4>
                                                        <?php $_smarty_tpl->_subTemplateRender('file:controllers/orders/_documents.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                        </div>
                    </div>
                    <?php echo '<script'; ?>
>
                        $('#tabOrder a').click(function (e) {
                            e.preventDefault()
                            $(this).tab('show')
                        })
                    <?php echo '</script'; ?>
>
                    <hr />
                    <!-- Tab nav -->
                                        <?php echo '<script'; ?>
>
                        $('#myTab a').click(function (e) {
                            e.preventDefault()
                            $(this).tab('show')
                        })
                    <?php echo '</script'; ?>
>
                </div>
                <!-- Payments block -->
                <div id="form_add_payment_panel" class="panel">
                    <div class="panel-heading">
                        <i class="icon-credit-card"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Payment"),$_smarty_tpl ) );?>
 <span class="badge"><?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['order']->value->getOrderPayments());?>
</span>
                    </div>
                    <?php if (count($_smarty_tpl->tpl_vars['order']->value->getOrderPayments()) > 0) {?>
                        <p class="alert alert-danger"<?php if (round($_smarty_tpl->tpl_vars['order']->value->total_paid_tax_incl,2) == round($_smarty_tpl->tpl_vars['total_paid']->value,2) || ((isset($_smarty_tpl->tpl_vars['currentState']->value)) && $_smarty_tpl->tpl_vars['currentState']->value->id == 6)) {?> style="display: none;"<?php }?>>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Warning'),$_smarty_tpl ) );?>

                            <strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['total_paid']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</strong>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'paid instead of'),$_smarty_tpl ) );?>

                            <strong class="total_paid"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['order']->value->total_paid_tax_incl,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</strong>
                                                    </p>
                    <?php }?>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><span class="title_box "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Date'),$_smarty_tpl ) );?>
</span></th>
                                        <th><span class="title_box "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment method'),$_smarty_tpl ) );?>
</span></th>
                                        <th><span class="title_box "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment source'),$_smarty_tpl ) );?>
</span></th>
                                        <th><span class="title_box "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Transaction ID'),$_smarty_tpl ) );?>
</span></th>
                                        <th><span class="title_box "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Amount'),$_smarty_tpl ) );?>
</span></th>
                                        <th><span class="title_box "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invoice'),$_smarty_tpl ) );?>
</span></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order_payment_detail']->value, 'payment');
$_smarty_tpl->tpl_vars['payment']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['payment']->value) {
$_smarty_tpl->tpl_vars['payment']->do_else = false;
?>
                                        <tr>
                                            <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['payment']->value['date_add'],'full'=>true),$_smarty_tpl ) );?>
</td>
                                            <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['payment']->value['payment_method'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                                            <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['payment_types']->value[$_smarty_tpl->tpl_vars['payment']->value['payment_type']]['name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                                            <td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['payment']->value['transaction_id'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                                            <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['payment']->value['real_paid_amount'],'currency'=>$_smarty_tpl->tpl_vars['payment']->value['id_currency']),$_smarty_tpl ) );?>
</td>
                                            <td><?php if ((isset($_smarty_tpl->tpl_vars['payment']->value['invoice_number']))) {
echo $_smarty_tpl->tpl_vars['payment']->value['invoice_number'];
} else { ?>--<?php }?></td>
                                            <td class="actions">
                                                <a class="open_payment_information btn btn-default" href="#" data-card_number="<?php if ($_smarty_tpl->tpl_vars['payment']->value['card_number']) {
echo $_smarty_tpl->tpl_vars['payment']->value['card_number'];
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Not defined'),$_smarty_tpl ) );
}?>"  data-card_brand="<?php if ($_smarty_tpl->tpl_vars['payment']->value['card_brand']) {
echo $_smarty_tpl->tpl_vars['payment']->value['card_brand'];
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Not defined'),$_smarty_tpl ) );
}?>"  data-card_expiration="<?php if ($_smarty_tpl->tpl_vars['payment']->value['card_expiration']) {
echo $_smarty_tpl->tpl_vars['payment']->value['card_expiration'];
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Not defined'),$_smarty_tpl ) );
}?>"  data-card_holder="<?php if ($_smarty_tpl->tpl_vars['payment']->value['card_holder']) {
echo $_smarty_tpl->tpl_vars['payment']->value['card_holder'];
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Not defined'),$_smarty_tpl ) );
}?>" data-payment_date="<?php if ($_smarty_tpl->tpl_vars['payment']->value['date_add']) {
echo $_smarty_tpl->tpl_vars['payment']->value['date_add'];
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Not defined'),$_smarty_tpl ) );
}?>" data-payment_method="<?php if ($_smarty_tpl->tpl_vars['payment']->value['payment_method']) {
echo $_smarty_tpl->tpl_vars['payment']->value['payment_method'];
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Not defined'),$_smarty_tpl ) );
}?>" data-payment_source="<?php if ($_smarty_tpl->tpl_vars['payment_types']->value[$_smarty_tpl->tpl_vars['payment']->value['payment_type']]['name']) {
echo $_smarty_tpl->tpl_vars['payment_types']->value[$_smarty_tpl->tpl_vars['payment']->value['payment_type']]['name'];
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Not defined'),$_smarty_tpl ) );
}?>" data-transaction_id="<?php if ($_smarty_tpl->tpl_vars['payment']->value['transaction_id']) {
echo $_smarty_tpl->tpl_vars['payment']->value['transaction_id'];
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Not defined'),$_smarty_tpl ) );
}?>" data-amount="<?php if ($_smarty_tpl->tpl_vars['payment']->value['amount']) {
ob_start();
echo $_smarty_tpl->tpl_vars['payment']->value['id_currency'];
$_prefixVariable14 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['payment']->value['amount'];
$_prefixVariable15 = ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('currency'=>$_prefixVariable14,'price'=>$_prefixVariable15),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Not defined'),$_smarty_tpl ) );
}?>" data-invoice_number="<?php if ((isset($_smarty_tpl->tpl_vars['payment']->value['invoice_number'])) && $_smarty_tpl->tpl_vars['payment']->value['invoice_number']) {
echo $_smarty_tpl->tpl_vars['payment']->value['invoice_number'];
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Not defined'),$_smarty_tpl ) );
}?>"><i class="icon-search"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Details'),$_smarty_tpl ) );?>
</a>
                                            </td>
                                        </tr>
                                    <?php
}
if ($_smarty_tpl->tpl_vars['payment']->do_else) {
?>
                                        <tr>
                                            <td class="list-empty hidden-print" colspan="6">
                                                <div class="list-empty-msg">
                                                    <i class="icon-warning-sign list-empty-icon"></i>
                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No payment records'),$_smarty_tpl ) );?>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['can_edit']->value) {?>
                        <div class="form-group">
                            <button class="btn btn-primary add_new_payment" id="add_new_payment">
                                <i class="icon-plus-sign"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add new payment'),$_smarty_tpl ) );?>

                            </button>
                        </div>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['can_edit']->value && (!$_smarty_tpl->tpl_vars['order']->value->valid && sizeof($_smarty_tpl->tpl_vars['currencies']->value) > 1)) {?>
                        <form class="form-horizontal well" method="post" action="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['currentIndex']->value, ENT_QUOTES, 'UTF-8', true);?>
&amp;vieworder&amp;id_order=<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);?>
">
                            <div class="form-group">
                                <label class="control-label col-lg-2 col-md-3 text-left"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Change currency'),$_smarty_tpl ) );?>
</label>
                                <div class="col-lg-4 col-md-5">
                                    <select name="new_currency">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currencies']->value, 'currency_change');
$_smarty_tpl->tpl_vars['currency_change']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['currency_change']->value) {
$_smarty_tpl->tpl_vars['currency_change']->do_else = false;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['currency_change']->value['id_currency'] != $_smarty_tpl->tpl_vars['order']->value->id_currency) {?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['currency_change']->value['id_currency'];?>
"><?php echo $_smarty_tpl->tpl_vars['currency_change']->value['name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['currency_change']->value['sign'];?>
</option>
                                        <?php }?>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-4">
                                    <button type="submit" class="btn btn-primary" name="submitChangeCurrency"><i class="icon-refresh"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Change Currencly'),$_smarty_tpl ) );?>
</button>
                                </div>
                            </div>
                            <p class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Do not forget to update your exchange rate before making this change.'),$_smarty_tpl ) );?>
</p>
                        </form>
                    <?php }?>
                </div>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayAdminOrderLeft",'id_order'=>$_smarty_tpl->tpl_vars['order']->value->id),$_smarty_tpl ) );?>

            </div>
            <div class="col-lg-5">
                                <?php if ($_smarty_tpl->tpl_vars['customerGuestDetail']->value) {?>
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="icon icon-user"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Traveller detail'),$_smarty_tpl ) );?>

                             <?php if ($_smarty_tpl->tpl_vars['can_edit']->value) {?>
                                <button id="edit_guest_details" class="btn btn-primary pull-right" type="button" >
                                    <i class="icon-pencil"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit'),$_smarty_tpl ) );?>

                                </button>
                            <?php }?>
                        </div>
                        <div class="row">
                            <div class="col-xs-12" id="customer-guest-details">
                                <dl class="list-detail col-sm-6">
                                    <label class="label-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Title'),$_smarty_tpl ) );?>
</label>
                                    <dd class="gender_name"><?php echo $_smarty_tpl->tpl_vars['customerGuestDetail']->value->gender->name;?>
</dd>
                                </dl>
                                <dl class="list-detail col-sm-6">
                                    <label class="label-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</label>
                                    <dd class="guest_name"><?php echo $_smarty_tpl->tpl_vars['customerGuestDetail']->value->firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['customerGuestDetail']->value->lastname;?>
</dd>
                                </dl>
                                <dl class="list-detail col-sm-6">
                                    <label class="label-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email'),$_smarty_tpl ) );?>
</label>
                                    <dd class="guest_email"><a  href="mailto:<?php echo $_smarty_tpl->tpl_vars['customerGuestDetail']->value->email;?>
"><i class="icon-envelope-o"></i> <?php echo $_smarty_tpl->tpl_vars['customerGuestDetail']->value->email;?>
</a></dd>
                                </dl>
                                <dl class="list-detail col-sm-6">
                                    <label class="label-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Phone'),$_smarty_tpl ) );?>
</label>
                                    <dd class="guest_phone"><a  href="tel:<?php echo $_smarty_tpl->tpl_vars['customerGuestDetail']->value->phone;?>
"><i class="icon-phone"></i> <?php echo $_smarty_tpl->tpl_vars['customerGuestDetail']->value->phone;?>
</a></dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                <?php }?>

                <!-- Customer informations -->
                <div class="panel panel-customer">
                    <?php if ($_smarty_tpl->tpl_vars['customer']->value->id) {?>
                        <div class="panel-heading">
                            <i class="icon-user"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customer'),$_smarty_tpl ) );?>
 <span class="badge"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'#'),$_smarty_tpl ) );
echo $_smarty_tpl->tpl_vars['customer']->value->id;?>
</span>
                            <a href="?tab=AdminCustomers&amp;id_customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value->id;?>
&amp;viewcustomer&amp;token=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0], array( array('tab'=>'AdminCustomers'),$_smarty_tpl ) );?>
" class="pull-right"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View customer details'),$_smarty_tpl ) );?>
</a>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 customer_info">
                                <?php if (($_smarty_tpl->tpl_vars['customer']->value->isGuest())) {?>
                                    <p class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This booking has been created by a guest.'),$_smarty_tpl ) );?>
</p>
                                    <?php if ((!Customer::customerExists($_smarty_tpl->tpl_vars['customer']->value->email))) {?>
                                        <dl class="list-detail col-sm-12">
                                            <label class="label-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Guest info'),$_smarty_tpl ) );?>
</label>

                                            <dd><i class="icon-user"></i> &nbsp;<b><a  href="?tab=AdminCustomers&amp;id_customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value->id;?>
&amp;viewcustomer&amp;token=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0], array( array('tab'=>'AdminCustomers'),$_smarty_tpl ) );?>
"><?php echo $_smarty_tpl->tpl_vars['customer']->value->firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value->lastname;?>
</a></b></dd>
                                            <dd><i class="icon-envelope"></i>  &nbsp;<b><a  href="mailto:<?php echo $_smarty_tpl->tpl_vars['customer']->value->email;?>
"><?php echo $_smarty_tpl->tpl_vars['customer']->value->email;?>
</a></b></dd>
                                            <?php if ($_smarty_tpl->tpl_vars['customer']->value->phone) {?>
                                                <dd><i class="icon-phone"></i>  &nbsp;<b><a  href="tel:<?php echo $_smarty_tpl->tpl_vars['customer']->value->phone;?>
"><?php echo $_smarty_tpl->tpl_vars['customer']->value->phone;?>
</a></b></dd>
                                            <?php }?>
                                        </dl>
                                        <form method="post" action="index.php?tab=AdminCustomers&amp;id_customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value->id;?>
&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
&amp;token=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0], array( array('tab'=>'AdminCustomers'),$_smarty_tpl ) );?>
">
                                            <input type="hidden" name="id_lang" value="<?php echo $_smarty_tpl->tpl_vars['order']->value->id_lang;?>
" />

                                            <?php if ($_smarty_tpl->tpl_vars['can_edit']->value) {?>
                                                <button class="btn btn-primary" type="submit" name="submitGuestToCustomer"><i class='icon-refresh'></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Transform this guest into a customer'),$_smarty_tpl ) );?>
</button>
                                                <p class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This feature will generate a random password and send an email to the customer.'),$_smarty_tpl ) );?>
</p>
                                            <?php }?>
                                        </form>
                                    <?php } else { ?>
                                        <div class="alert alert-warning">
                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'A registered customer account has already claimed this email address'),$_smarty_tpl ) );?>

                                        </div>
                                    <?php }?>
                                <?php } else { ?>
                                    <dl class="list-detail col-sm-6">
                                        <label class="label-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customer'),$_smarty_tpl ) );?>
</label>

                                        <dd><i class="icon-user"></i> &nbsp;<b><a  href="?tab=AdminCustomers&amp;id_customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value->id;?>
&amp;viewcustomer&amp;token=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0], array( array('tab'=>'AdminCustomers'),$_smarty_tpl ) );?>
"><?php echo $_smarty_tpl->tpl_vars['customer']->value->firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value->lastname;?>
</a></b></dd>
                                        <dd><i class="icon-envelope"></i>  &nbsp;<b><a  href="mailto:<?php echo $_smarty_tpl->tpl_vars['customer']->value->email;?>
"><?php echo $_smarty_tpl->tpl_vars['customer']->value->email;?>
</a></b></dd>
                                        <?php if ($_smarty_tpl->tpl_vars['customer']->value->phone) {?>
                                            <dd><i class="icon-phone"></i>  &nbsp;<b><a  href="tel:<?php echo $_smarty_tpl->tpl_vars['customer']->value->phone;?>
"><?php echo $_smarty_tpl->tpl_vars['customer']->value->phone;?>
</a></b></dd>
                                        <?php }?>
                                    </dl>
                                    <dl class="list-detail col-sm-6">
                                        <label class="label-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customer Info'),$_smarty_tpl ) );?>
</label>

                                        <dd><b><i class="icon-calendar"></i> &nbsp; <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['customer']->value->date_add,"%d %b, %Y");?>
</b> (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Member since'),$_smarty_tpl ) );?>
)</dd>
                                        <dd><b><i class="icon-list"></i> &nbsp; <?php echo intval($_smarty_tpl->tpl_vars['customerStats']->value['nb_orders']);?>
</b> (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total valid order placed'),$_smarty_tpl ) );?>
)</dd>
                                        <dd><b><i class="icon-credit-card"></i> &nbsp; <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>Tools::ps_round(Tools::convertPrice(floatval($_smarty_tpl->tpl_vars['customerStats']->value['total_spent']),$_smarty_tpl->tpl_vars['currency']->value),'_PS_PRICE_DISPLAY_PRECISION_'),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</b> (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total spent since registration'),$_smarty_tpl ) );?>
)</dd>
                                        <?php if (Configuration::get('PS_B2B_ENABLE')) {?>
                                            <dd><b><?php echo $_smarty_tpl->tpl_vars['customer']->value->siret;?>
</b> (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Siret'),$_smarty_tpl ) );?>
)</dd>
                                            <dd><b><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['customer']->value->ape,"%d %b, %Y");?>
</b> (<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'APE'),$_smarty_tpl ) );?>
)</dd>
                                        <?php }?>
                                    </dl>
                                <?php }?>
                            </div>

                            <div class="col-xs-12">
                                <div class="panel panel-sm">
                                    <div class="panel-heading">
                                        <i class="icon-eye-slash"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Private note'),$_smarty_tpl ) );?>

                                    </div>
                                    <form id="customer_note" class="form-horizontal" action="ajax.php" method="post" onsubmit="saveCustomerNote(<?php echo $_smarty_tpl->tpl_vars['customer']->value->id;?>
);return false;" >
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <textarea rows="3" name="note" id="noteContent" class="textarea-autosize" onkeyup="$(this).val().length > 0 ? $('#submitCustomerNote').removeAttr('disabled') : $('#submitCustomerNote').attr('disabled', 'disabled')"><?php echo $_smarty_tpl->tpl_vars['customer']->value->note;?>
</textarea>
                                            </div>
                                        </div>
                                        <?php if ($_smarty_tpl->tpl_vars['can_edit']->value) {?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <button type="submit" id="submitCustomerNote" class="btn btn-primary pull-right" disabled="disabled">
                                                        <i class="icon-save"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add Note'),$_smarty_tpl ) );?>

                                                    </button>
                                                </div>
                                            </div>
                                        <?php }?>
                                        <span id="note_feedback"></span>
                                    </form>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "TaxMethod", null, null);?>
                                    <?php if (($_smarty_tpl->tpl_vars['order']->value->getTaxCalculationMethod() == (defined('PS_TAX_EXC') ? constant('PS_TAX_EXC') : null))) {?>
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tax excluded'),$_smarty_tpl ) );?>

                                    <?php } else { ?>
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tax included'),$_smarty_tpl ) );?>

                                    <?php }?>
                                <?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
                                <div class="alert alert-warning">
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'For this customer group, prices are displayed as: [1]%s[/1]','sprintf'=>array($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'TaxMethod')),'tags'=>array('<strong>')),$_smarty_tpl ) );?>

                                    <?php if (!$_smarty_tpl->tpl_vars['refund_allowed']->value) {?>
                                        <br/><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refunds are disabled'),$_smarty_tpl ) );?>
</strong>
                                    <?php }?>
                                </div>
                            </div>
                        </div>

                    <?php }?>
                </div>

                <div class="panel panel-guest_address">
                    <div class="panel-heading">
                        <span class="panel-title"><i class="icon icon-envelope"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customer Address'),$_smarty_tpl ) );?>
</span>
                        <?php if ($_smarty_tpl->tpl_vars['can_edit']->value) {?>
                            <?php if ($_smarty_tpl->tpl_vars['idOrderAddressInvoice']->value) {?>
                                <button id="edit_guest_address" class="btn btn-primary pull-right fancybox" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminAddresses');?>
&amp;id_address=<?php echo $_smarty_tpl->tpl_vars['idOrderAddressInvoice']->value;?>
&amp;updateaddress&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
&amp;address_type=2&amp;realedit=1&amp;liteDisplaying=1&amp;submitFormAjax=1#">
                                    <i class="icon-pencil"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit'),$_smarty_tpl ) );?>

                                </button>
                                <?php if ((!$_smarty_tpl->tpl_vars['idCurrentAddress']->value || ($_smarty_tpl->tpl_vars['idCurrentAddress']->value != $_smarty_tpl->tpl_vars['idOrderAddressInvoice']->value)) || $_smarty_tpl->tpl_vars['ordersWithDiffInvAddr']->value) {?>
                                    <div class="guest_address_actions dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="icon-ellipsis-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <?php if ($_smarty_tpl->tpl_vars['ordersWithDiffInvAddr']->value) {?>
                                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&amp;vieworder&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);?>
&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
&amp;action=set_old_orders_address"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Set for all orders'),$_smarty_tpl ) );?>
</a></li>
                                            <?php }?>
                                            <?php if (!$_smarty_tpl->tpl_vars['idCurrentAddress']->value || ($_smarty_tpl->tpl_vars['idCurrentAddress']->value != $_smarty_tpl->tpl_vars['idOrderAddressInvoice']->value)) {?>
                                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&amp;vieworder&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);?>
&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
&amp;action=set_address_current_address"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Set as current address'),$_smarty_tpl ) );?>
</a></li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                <?php }?>
                            <?php } else { ?>
                                <button id="add_guest_address" class="btn btn-primary pull-right fancybox" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminAddresses');?>
&amp;addaddress&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
&amp;address_type=2&amp;id_customer=<?php echo $_smarty_tpl->tpl_vars['order']->value->id_customer;?>
&amp;liteDisplaying=1&amp;submitFormAjax=1#">
                                    <i class="icon-plus-circle"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add Address'),$_smarty_tpl ) );?>

                                </button>
                                <?php if ($_smarty_tpl->tpl_vars['idCurrentAddress']->value) {?>
                                    <div class="guest_address_actions dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="icon-ellipsis-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&amp;vieworder&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);?>
&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
&amp;action=set_order_active_address"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Set current address for this order'),$_smarty_tpl ) );?>
</a></li>
                                        </ul>
                                    </div>
                                <?php }?>
                            <?php }?>
                        <?php }?>
                    </div>
                    <div class="row">
                        <?php if ($_smarty_tpl->tpl_vars['guestFormattedAddress']->value) {?>
                            <?php echo $_smarty_tpl->tpl_vars['guestFormattedAddress']->value;?>

                        <?php } else { ?>
                            <div class="list-empty">
                                <div class="list-empty-msg">
                                    <i class="icon-warning-sign list-empty-icon"></i>
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Guest address not found.'),$_smarty_tpl ) );?>

                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>

                                <?php if ((isset($_smarty_tpl->tpl_vars['messages']->value)) && $_smarty_tpl->tpl_vars['messages']->value) {?>
                    <div class="panel order-notes">
                        <div class="panel-heading">
                            <i class="icon-undo"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order Private Notes'),$_smarty_tpl ) );?>

                        </div>
                        <div class="panel-content">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'message', false, NULL, 'customerMessage', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['message']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_customerMessage']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_customerMessage']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_customerMessage']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_customerMessage']->value['total'];
?>
                                <div class="message-body">
                                    <p class="message-item-text">
                                        <?php echo nl2br((string) htmlspecialchars((string)$_smarty_tpl->tpl_vars['message']->value['message'], ENT_QUOTES, 'UTF-8', true), (bool) 1);?>

                                    </p>
                                    <p>
                                        <?php if ((htmlspecialchars((string)$_smarty_tpl->tpl_vars['message']->value['elastname'], ENT_QUOTES, 'UTF-8', true))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['message']->value['efirstname'], ENT_QUOTES, 'UTF-8', true);?>

                                            <span><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['message']->value['elastname'], ENT_QUOTES, 'UTF-8', true);
} else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['message']->value['cfirstname'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['message']->value['clastname'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                                        <?php }?>,
                                        <span class="message-date">&nbsp;<i class="icon-calendar"></i>
                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['message']->value['date_add']),$_smarty_tpl ) );?>

                                        </span>
                                        <?php if (($_smarty_tpl->tpl_vars['message']->value['private'] == 1)) {?>
                                            <span class="badge badge-info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Private'),$_smarty_tpl ) );?>
</span>
                                        <?php }?>
                                    </p>
                                </div>
                                <?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_customerMessage']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_customerMessage']->value['last'] : null)) {?><hr/><?php }?>
                                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </div>
                    </div>
                <?php }?>

                <div class="panel panel-refund-request">
                    <div class="panel-heading">
                        <i class="icon-undo"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refund Requests'),$_smarty_tpl ) );?>

                    </div>
                    <div class="panel-content">
                        <?php if (is_array($_smarty_tpl->tpl_vars['returns']->value) && count($_smarty_tpl->tpl_vars['returns']->value)) {?>
                            <div class=table-responsive>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Request ID'),$_smarty_tpl ) );?>
</th>
                                            <?php if ((isset($_smarty_tpl->tpl_vars['refundReqBookings']->value)) && $_smarty_tpl->tpl_vars['refundReqBookings']->value) {?>
                                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Rooms'),$_smarty_tpl ) );?>
</th>
                                            <?php }?>
                                            <?php if ((isset($_smarty_tpl->tpl_vars['refundReqProducts']->value)) && $_smarty_tpl->tpl_vars['refundReqProducts']->value) {?>
                                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Products'),$_smarty_tpl ) );?>
</th>
                                            <?php }?>
                                            <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Requested Date'),$_smarty_tpl ) );?>
</th>
                                            <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status'),$_smarty_tpl ) );?>
</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['returns']->value, 'return_info');
$_smarty_tpl->tpl_vars['return_info']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['return_info']->value) {
$_smarty_tpl->tpl_vars['return_info']->do_else = false;
?>
                                            <tr>
                                                <td>
                                                    <a  href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrderRefundRequests');?>
&vieworder_return&id_order_return=<?php echo $_smarty_tpl->tpl_vars['return_info']->value['id_order_return'];?>
" target="_blank">#<?php echo $_smarty_tpl->tpl_vars['return_info']->value['id_order_return'];?>
</a>
                                                </td>
                                                <?php if ((isset($_smarty_tpl->tpl_vars['refundReqBookings']->value)) && $_smarty_tpl->tpl_vars['refundReqBookings']->value) {?>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['return_info']->value['total_rooms'];?>
</td>
                                                <?php }?>
                                                <?php if ((isset($_smarty_tpl->tpl_vars['refundReqProducts']->value)) && $_smarty_tpl->tpl_vars['refundReqProducts']->value) {?>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['return_info']->value['total_products'];?>
</td>
                                                <?php }?>
                                                <td>
                                                    <?php echo $_smarty_tpl->tpl_vars['return_info']->value['date_add'];?>

                                                </td>
                                                <td>
                                                    <span class="badge" style="background-color:<?php echo $_smarty_tpl->tpl_vars['return_info']->value['state_color'];?>
"><?php echo $_smarty_tpl->tpl_vars['return_info']->value['state_name'];?>
</span>
                                                    <?php if ($_smarty_tpl->tpl_vars['return_info']->value['refunded_amount'] > 0) {?>
                                                        &nbsp;<span class="badge badge-success refunded_amount"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['return_info']->value['refunded_amount'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</span>
                                                    <?php }?>
                                                </td>
                                            </tr>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="list-empty">
                                <div class="list-empty-msg">
                                    <i class="icon-warning-sign list-empty-icon"></i>
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No refund requests created.'),$_smarty_tpl ) );?>

                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
                <?php if (is_array($_smarty_tpl->tpl_vars['applicable_refund_policies']->value) && count($_smarty_tpl->tpl_vars['applicable_refund_policies']->value)) {?>
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="icon-remove-sign"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancellation Policies'),$_smarty_tpl ) );?>

                        </div>
                        <div class="panel-content">
                            <?php if (is_array($_smarty_tpl->tpl_vars['applicable_refund_policies']->value) && count($_smarty_tpl->tpl_vars['applicable_refund_policies']->value)) {?>
                                <ul>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['applicable_refund_policies']->value, 'applicable_refund_policy');
$_smarty_tpl->tpl_vars['applicable_refund_policy']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['applicable_refund_policy']->value) {
$_smarty_tpl->tpl_vars['applicable_refund_policy']->do_else = false;
?>
                                        <li class="form-group">
                                            <a  href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrderRefundRules'), ENT_QUOTES, 'UTF-8', true);?>
&id_refund_rule=<?php echo $_smarty_tpl->tpl_vars['applicable_refund_policy']->value['id_refund_rule'];?>
&updatehtl_order_refund_rules" target="_blank">
                                                <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['applicable_refund_policy']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
 &nbsp;<i class="icon icon-external-link-square"></i>
                                            </a>
                                        </li>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </ul>
                            <?php } else { ?>
                                <div class="list-empty">
                                    <div class="list-empty-msg">
                                        <i class="icon-warning-sign list-empty-icon"></i>
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No cancellation policies applicable.'),$_smarty_tpl ) );?>

                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                <?php }?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayAdminOrderRight",'id_order'=>$_smarty_tpl->tpl_vars['order']->value->id),$_smarty_tpl ) );?>

            </div>
        </div>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayAdminOrder",'id_order'=>$_smarty_tpl->tpl_vars['order']->value->id),$_smarty_tpl ) );?>

        <div class="row" id="start_products">
            <div class="col-lg-12">
                <form class="container-command-top-spacing" action="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&amp;vieworder&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);?>
&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
" method="post" onsubmit="return orderDeleteProduct('<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This product cannot be returned.'),$_smarty_tpl ) );?>
', '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity to cancel is greater than quantity available.'),$_smarty_tpl ) );?>
');">
                    <input type="hidden" name="id_order" value="<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
" />
                    <div style="display: none">
                        <input type="hidden" value="<?php echo smarty_modifier_implode($_smarty_tpl->tpl_vars['order']->value->getWarehouseList());?>
" id="warehouse_list" />
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['hotel_booking']->value) {?>
                        <div class="panel">
                            <div class="panel-heading">
                                <i class="icon-bed"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rooms Booking Detail'),$_smarty_tpl ) );?>
 <span class="badge"><?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['order_detail_data']->value);?>
</span>
                                <?php if ($_smarty_tpl->tpl_vars['can_edit']->value && (!$_smarty_tpl->tpl_vars['order']->value->hasBeenDelivered() && $_smarty_tpl->tpl_vars['currentState']->value->id != Configuration::get('PS_OS_REFUND') && $_smarty_tpl->tpl_vars['currentState']->value->id != Configuration::get('PS_OS_CANCELED'))) {?>
                                    <button type="button" id="add_room" class="btn btn-primary pull-right">
                                        <i class="icon-plus-sign"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add Rooms'),$_smarty_tpl ) );?>

                                    </button>
                                <?php }?>
                            </div>
                                                        <?php $_smarty_tpl->_subTemplateRender('file:controllers/orders/_rooms_informaion_table.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                            <?php if (($_smarty_tpl->tpl_vars['order']->value->getTaxCalculationMethod() == (defined('PS_TAX_EXC') ? constant('PS_TAX_EXC') : null))) {?>
                                <input type="hidden" name="TaxMethod" value="0">
                            <?php } else { ?>
                                <input type="hidden" name="TaxMethod" value="1">
                            <?php }?>
                        </div>

                        <?php if ($_smarty_tpl->tpl_vars['hotel_service_products']->value || $_smarty_tpl->tpl_vars['hotelStandaloneProducts']->value || $_smarty_tpl->tpl_vars['standaloneProducts']->value) {?>
                            <div class="panel">
                                <div class="panel-heading">
                                    <i class="icon-bed"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Products Detail'),$_smarty_tpl ) );?>
 <span class="badge"><?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['hotel_service_products']->value);?>
</span>
                                    <?php if ($_smarty_tpl->tpl_vars['can_edit']->value && (!$_smarty_tpl->tpl_vars['order']->value->hasBeenDelivered() && $_smarty_tpl->tpl_vars['currentState']->value->id != Configuration::get('PS_OS_REFUND') && $_smarty_tpl->tpl_vars['currentState']->value->id != Configuration::get('PS_OS_CANCELED'))) {?>
                                        <button type="button" id="add_product" class="btn btn-primary pull-right">
                                            <i class="icon-plus-sign"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add Product'),$_smarty_tpl ) );?>

                                        </button>
                                    <?php }?>
                                </div>
                                <?php $_smarty_tpl->_subTemplateRender('file:controllers/orders/_hotel_service_products_table.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                                <?php if (($_smarty_tpl->tpl_vars['order']->value->getTaxCalculationMethod() == (defined('PS_TAX_EXC') ? constant('PS_TAX_EXC') : null))) {?>
                                    <input type="hidden" name="TaxMethod" value="0">
                                <?php } else { ?>
                                    <input type="hidden" name="TaxMethod" value="1">
                                <?php }?>
                            </div>
                        <?php }?>
                    <?php } else { ?>
                        <?php if ($_smarty_tpl->tpl_vars['standalone_service_products']->value || $_smarty_tpl->tpl_vars['standaloneProducts']->value) {?>
                            <div class="panel">
                                <div class="panel-heading">
                                    <i class="icon-bed"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Products Detail'),$_smarty_tpl ) );?>
 <span class="badge"><?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['standalone_service_products']->value);?>
</span>
                                    <?php if ($_smarty_tpl->tpl_vars['can_edit']->value && (!$_smarty_tpl->tpl_vars['order']->value->hasBeenDelivered() && $_smarty_tpl->tpl_vars['currentState']->value->id != Configuration::get('PS_OS_REFUND') && $_smarty_tpl->tpl_vars['currentState']->value->id != Configuration::get('PS_OS_CANCELED'))) {?>
                                        <button type="button" id="add_product" class="btn btn-primary pull-right">
                                            <i class="icon-plus-sign"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add Product'),$_smarty_tpl ) );?>

                                        </button>
                                    <?php }?>
                                </div>
                                <?php $_smarty_tpl->_subTemplateRender('file:controllers/orders/_standalone_service_products_table.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                                <?php if (($_smarty_tpl->tpl_vars['order']->value->getTaxCalculationMethod() == (defined('PS_TAX_EXC') ? constant('PS_TAX_EXC') : null))) {?>
                                    <input type="hidden" name="TaxMethod" value="0">
                                <?php } else { ?>
                                    <input type="hidden" name="TaxMethod" value="1">
                                <?php }?>
                            </div>
                        <?php }?>
                    <?php }?>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-12 pull-right">
                <div class="panel panel-total">
                    <div class="table-responsive">
                        <table class="table" id="order-details-price">
                                                        <?php if (($_smarty_tpl->tpl_vars['order']->value->getTaxCalculationMethod() == (defined('PS_TAX_EXC') ? constant('PS_TAX_EXC') : null))) {?>
                                <?php $_smarty_tpl->_assignInScope('order_product_price', ($_smarty_tpl->tpl_vars['order']->value->total_products));?>
                                <?php $_smarty_tpl->_assignInScope('order_discount_price', $_smarty_tpl->tpl_vars['order']->value->total_discounts_tax_excl);?>
                                <?php $_smarty_tpl->_assignInScope('order_wrapping_price', $_smarty_tpl->tpl_vars['order']->value->total_wrapping_tax_excl);?>
                                <?php $_smarty_tpl->_assignInScope('order_shipping_price', $_smarty_tpl->tpl_vars['order']->value->total_shipping_tax_excl);?>
                            <?php } else { ?>
                                <?php $_smarty_tpl->_assignInScope('order_product_price', $_smarty_tpl->tpl_vars['order']->value->total_products_wt);?>
                                <?php $_smarty_tpl->_assignInScope('order_discount_price', $_smarty_tpl->tpl_vars['order']->value->total_discounts_tax_incl);?>
                                <?php $_smarty_tpl->_assignInScope('order_wrapping_price', $_smarty_tpl->tpl_vars['order']->value->total_wrapping_tax_incl);?>
                                <?php $_smarty_tpl->_assignInScope('order_shipping_price', $_smarty_tpl->tpl_vars['order']->value->total_shipping_tax_incl);?>
                            <?php }?>

                                                        
                                                        <?php $_smarty_tpl->_assignInScope('total_rooms_price_tax_excl', $_smarty_tpl->tpl_vars['order']->value->getTotalProductsWithoutTaxes(false,true));?>
                            <?php $_smarty_tpl->_assignInScope('total_rooms_price_tax_incl', $_smarty_tpl->tpl_vars['order']->value->getTotalProductsWithTaxes(false,true));?>

                                                        <?php $_smarty_tpl->_assignInScope('total_products_price_tax_excl', ($_smarty_tpl->tpl_vars['order']->value->getTotalProductsWithoutTaxes(false,false,Product::SELLING_PREFERENCE_HOTEL_STANDALONE)+$_smarty_tpl->tpl_vars['order']->value->getTotalProductsWithoutTaxes(false,false,Product::SELLING_PREFERENCE_STANDALONE)));?>
                            <?php $_smarty_tpl->_assignInScope('total_products_price_tax_incl', ($_smarty_tpl->tpl_vars['order']->value->getTotalProductsWithTaxes(false,false,Product::SELLING_PREFERENCE_HOTEL_STANDALONE)+$_smarty_tpl->tpl_vars['order']->value->getTotalProductsWithTaxes(false,false,Product::SELLING_PREFERENCE_STANDALONE)));?>

                                                        <?php $_smarty_tpl->_assignInScope('total_room_services_and_demands_tax_excl', ($_smarty_tpl->tpl_vars['order']->value->getTotalProductsWithoutTaxes(false,false,Product::SELLING_PREFERENCE_WITH_ROOM_TYPE)+$_smarty_tpl->tpl_vars['totalDemandsPriceTE']->value));?>
                            <?php $_smarty_tpl->_assignInScope('total_room_services_and_demands_tax_incl', ($_smarty_tpl->tpl_vars['order']->value->getTotalProductsWithTaxes(false,false,Product::SELLING_PREFERENCE_WITH_ROOM_TYPE)+$_smarty_tpl->tpl_vars['totalDemandsPriceTI']->value));?>

                                                        <?php $_smarty_tpl->_assignInScope('total_convenience_fee_tax_excl', $_smarty_tpl->tpl_vars['order']->value->getTotalProductsWithoutTaxes(false,false,Product::SELLING_PREFERENCE_WITH_ROOM_TYPE,1,Product::PRICE_ADDITION_TYPE_INDEPENDENT));?>
                            <?php $_smarty_tpl->_assignInScope('total_convenience_fee_tax_incl', $_smarty_tpl->tpl_vars['order']->value->getTotalProductsWithTaxes(false,false,Product::SELLING_PREFERENCE_WITH_ROOM_TYPE,1,Product::PRICE_ADDITION_TYPE_INDEPENDENT));?>

                            <?php $_smarty_tpl->_assignInScope('order_total_price_tax_excl', ($_smarty_tpl->tpl_vars['total_rooms_price_tax_excl']->value+$_smarty_tpl->tpl_vars['total_room_services_and_demands_tax_excl']->value+$_smarty_tpl->tpl_vars['total_products_price_tax_excl']->value));?>
                            <?php $_smarty_tpl->_assignInScope('order_total_price_tax_incl', ($_smarty_tpl->tpl_vars['total_rooms_price_tax_incl']->value+$_smarty_tpl->tpl_vars['total_room_services_and_demands_tax_incl']->value+$_smarty_tpl->tpl_vars['total_products_price_tax_incl']->value));?>

                            <?php if ($_smarty_tpl->tpl_vars['total_rooms_price_tax_excl']->value) {?>
                                <tr id="total_products">
                                    <td class="text-right"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Rooms Cost (Tax excl.)'),$_smarty_tpl ) );?>
</td>
                                    <td class="amount text-right nowrap">
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['total_rooms_price_tax_excl']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

                                    </td>
                                    <td class="partial_refund_fields current-edit" style="display:none;"></td>
                                </tr>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['total_products_price_tax_excl']->value > 0) {?>
                                <tr id="total_products">
                                    <td class="text-right"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total products (Tax excl.)'),$_smarty_tpl ) );?>
</td>
                                    <td class="amount text-right nowrap">
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['total_products_price_tax_excl']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

                                    </td>
                                    <td class="partial_refund_fields current-edit" style="display:none;"></td>
                                </tr>
                            <?php }?>
                            <?php if ((isset($_smarty_tpl->tpl_vars['total_room_services_and_demands_tax_excl']->value)) && $_smarty_tpl->tpl_vars['total_room_services_and_demands_tax_excl']->value > 0) {?>
                                <tr id="total_products">
                                    <td class="text-right"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Extra services (Tax excl.)'),$_smarty_tpl ) );?>
</td>
                                    <td class="amount text-right nowrap">
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['total_room_services_and_demands_tax_excl']->value-$_smarty_tpl->tpl_vars['total_convenience_fee_tax_excl']->value),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

                                    </td>
                                    <td class="partial_refund_fields current-edit" style="display:none;"></td>
                                </tr>
                            <?php }?>
                            <?php if ((isset($_smarty_tpl->tpl_vars['total_convenience_fee_tax_excl']->value)) && $_smarty_tpl->tpl_vars['total_convenience_fee_tax_excl']->value > 0) {?>
                                <tr id="total_products">
                                    <td class="text-right">
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Convenience Fee (Tax excl.)'),$_smarty_tpl ) );?>

                                        <?php if ((isset($_smarty_tpl->tpl_vars['order_convenience_fee_services']->value)) && count($_smarty_tpl->tpl_vars['order_convenience_fee_services']->value)) {?>
                                            <span role="button" id="view_convenience_services" class="pull-left"><i class="icon-angle-down icon-bold"></i><i class="icon-angle-up icon-bold" style="display:none;"></i></span>
                                        <?php }?>
                                    </td>
                                    <td class="amount text-right nowrap">
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['total_convenience_fee_tax_excl']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

                                    </td>
                                    <td class="partial_refund_fields current-edit" style="display:none;"></td>
                                </tr>
                                <?php if ((isset($_smarty_tpl->tpl_vars['order_convenience_fee_services']->value)) && count($_smarty_tpl->tpl_vars['order_convenience_fee_services']->value)) {?>
                                    <tr id="convenience_services" style="display:none;">
                                        <td colspan="3" class="panel">
                                            <table class="table table-responsive">
                                                <tbody>
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order_convenience_fee_services']->value, 'service');
$_smarty_tpl->tpl_vars['service']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['service']->value) {
$_smarty_tpl->tpl_vars['service']->do_else = false;
?>
                                                        <tr>
                                                            <td class="text-left"><span><?php echo $_smarty_tpl->tpl_vars['service']->value['name'];?>
</span></td>
                                                            <td class="text-right"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['service']->value['total_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</span></td>
                                                        </tr>
                                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                <?php }?>
                            <?php }?>
                                                        <tr id="total_taxes">
                                <td class="text-right">
                                    <strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Taxes'),$_smarty_tpl ) );?>
 </strong>
                                    <?php if (($_smarty_tpl->tpl_vars['order_total_price_tax_incl']->value-$_smarty_tpl->tpl_vars['order_total_price_tax_excl']->value) > 0) {?>
                                        <span role="button" id="view_order_tax_details" class="pull-left"><i class="icon-angle-down icon-bold"></i><i class="icon-angle-up icon-bold" style="display:none;"></i></span>
                                    <?php }?>
                                </td>
                                <td class="amount text-right nowrap" ><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['order_total_price_tax_incl']->value-$_smarty_tpl->tpl_vars['order_total_price_tax_excl']->value),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</strong>
                                </td>
                                <td class="partial_refund_fields current-edit" style="display:none;"></td>
                            </tr>
                            <?php if (($_smarty_tpl->tpl_vars['order_total_price_tax_incl']->value-$_smarty_tpl->tpl_vars['order_total_price_tax_excl']->value) > 0) {?>
                                <tr id="order_tax_details" style="display:none;">
                                    <td colspan="3" class="panel">
                                        <table class="table table-responsive">
                                            <tbody>
                                                <?php if ($_smarty_tpl->tpl_vars['total_rooms_price_tax_excl']->value) {?>
                                                    <tr>
                                                        <td class="text-left"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Rooms Tax'),$_smarty_tpl ) );?>
</td>
                                                        <td class="text-right">
                                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['total_rooms_price_tax_incl']->value-$_smarty_tpl->tpl_vars['total_rooms_price_tax_excl']->value),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

                                                        </td>
                                                    </tr>
                                                <?php }?>
                                                <?php if ((isset($_smarty_tpl->tpl_vars['total_room_services_and_demands_tax_incl']->value)) && (($_smarty_tpl->tpl_vars['total_room_services_and_demands_tax_incl']->value-$_smarty_tpl->tpl_vars['total_room_services_and_demands_tax_excl']->value)-($_smarty_tpl->tpl_vars['total_convenience_fee_tax_incl']->value-$_smarty_tpl->tpl_vars['total_convenience_fee_tax_excl']->value)) > 0) {?>
                                                    <tr>
                                                        <td class="text-left"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Extra services Tax'),$_smarty_tpl ) );?>
</td>
                                                        <td class="text-right nowrap">
                                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>(($_smarty_tpl->tpl_vars['total_room_services_and_demands_tax_incl']->value-$_smarty_tpl->tpl_vars['total_room_services_and_demands_tax_excl']->value)-($_smarty_tpl->tpl_vars['total_convenience_fee_tax_incl']->value-$_smarty_tpl->tpl_vars['total_convenience_fee_tax_excl']->value)),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

                                                        </td>
                                                        <td class="partial_refund_fields current-edit" style="display:none;"></td>
                                                    </tr>
                                                <?php }?>
                                                <?php if (($_smarty_tpl->tpl_vars['total_products_price_tax_incl']->value-$_smarty_tpl->tpl_vars['total_products_price_tax_excl']->value) > 0) {?>
                                                    <tr id="total_products">
                                                        <td class="text-left"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Products Tax'),$_smarty_tpl ) );?>
</td>
                                                        <td class="amount text-right nowrap">
                                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['total_products_price_tax_incl']->value-$_smarty_tpl->tpl_vars['total_products_price_tax_excl']->value),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

                                                        </td>
                                                        <td class="partial_refund_fields current-edit" style="display:none;"></td>
                                                    </tr>
                                                <?php }?>
                                                <?php if ((isset($_smarty_tpl->tpl_vars['total_convenience_fee_tax_excl']->value)) && $_smarty_tpl->tpl_vars['total_convenience_fee_tax_excl']->value > 0) {?>
                                                    <tr id="total_products">
                                                        <td class="text-left"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Convenience Fee Tax'),$_smarty_tpl ) );?>
</td>
                                                        <td class="amount text-right nowrap">
                                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['total_convenience_fee_tax_incl']->value-$_smarty_tpl->tpl_vars['total_convenience_fee_tax_excl']->value),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

                                                        </td>
                                                        <td class="partial_refund_fields current-edit" style="display:none;"></td>
                                                    </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php }?>
                                                        <tr id="total_discounts" <?php if ($_smarty_tpl->tpl_vars['order']->value->total_discounts_tax_incl == 0) {?>style="display: none;"<?php }?>>
                                <td class="text-right"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Booking Amount'),$_smarty_tpl ) );?>
</strong></td>
                                <td class="amount text-right nowrap">
                                    <strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['order_total_price_tax_incl']->value),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</strong>
                                </td>
                                <td class="partial_refund_fields current-edit" style="display:none;"></td>
                            </tr>
                            <tr id="total_discounts" <?php if ($_smarty_tpl->tpl_vars['order']->value->total_discounts_tax_incl == 0) {?>style="display: none;"<?php }?>>
                                <td class="text-right"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Discounts'),$_smarty_tpl ) );?>
</strong></td>
                                <td class="amount text-right nowrap">
                                    <strong>-<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['order']->value->total_discounts_tax_incl,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</strong>
                                </td>
                                <td class="partial_refund_fields current-edit" style="display:none;"></td>
                            </tr>
                            <tr id="total_wrapping" <?php if ($_smarty_tpl->tpl_vars['order']->value->total_wrapping_tax_incl == 0) {?>style="display: none;"<?php }?>>
                                <td class="text-right"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Wrapping'),$_smarty_tpl ) );?>
</td>
                                <td class="amount text-right nowrap">
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['order_wrapping_price']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

                                </td>
                                <td class="partial_refund_fields current-edit" style="display:none;"></td>
                            </tr>
                            <tr id="total_order">
                                <td class="text-right"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Final Booking Total'),$_smarty_tpl ) );?>
</strong></td>
                                <td class="amount text-right nowrap">
                                    <strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['order']->value->total_paid_tax_incl,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</strong>
                                </td>
                                <td class="partial_refund_fields current-edit" style="display:none;"></td>
                            </tr>

                            <?php if (((isset($_smarty_tpl->tpl_vars['refundReqBookings']->value)) && $_smarty_tpl->tpl_vars['refundReqBookings']->value) || ((isset($_smarty_tpl->tpl_vars['refundReqProducts']->value)) && $_smarty_tpl->tpl_vars['refundReqProducts']->value)) {?>
                                <tr id="total_order">
                                    <td class="text-right"><strong>* <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refunded Amount'),$_smarty_tpl ) );?>
</strong></td>
                                    <td class="amount text-right nowrap">
                                        <strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['refundedAmount']->value,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</strong>
                                    </td>
                                    <td class="partial_refund_fields current-edit" style="display:none;"></td>
                                </tr>
                            <?php }?>

                            <tr>
                                <td class="text-right"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Due Amount'),$_smarty_tpl ) );?>
</strong></td>
                                <td class="amount text-right nowrap">
                                    <strong>
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>($_smarty_tpl->tpl_vars['order']->value->total_paid_tax_incl-$_smarty_tpl->tpl_vars['order']->value->total_paid_real)),$_smarty_tpl ) );?>

                                    </strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

                        <div class="col-lg-4 col-sm-6 col-xs-12 pull-right">
                <div class="panel panel-vouchers">
                    <div class="panel-heading">
                        <span><i class="icon-tag"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Voucher'),$_smarty_tpl ) );?>
</span>
                        <?php if ($_smarty_tpl->tpl_vars['can_edit']->value && $_smarty_tpl->tpl_vars['order']->value->total_paid > 0) {?>
                            <button id="add_voucher" class="btn btn-primary pull-right" type="button" >
                                <i class="icon-ticket"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add new voucher'),$_smarty_tpl ) );?>

                            </button>
                        <?php }?>
                    </div>
                    <div class="panel-content">
                        <?php if (sizeof($_smarty_tpl->tpl_vars['discounts']->value)) {?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <span class="title_box "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Voucher name'),$_smarty_tpl ) );?>
</span>
                                            </th>
                                            <th>
                                                <span class="title_box "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Value'),$_smarty_tpl ) );?>
</span>
                                            </th>
                                            <?php if ($_smarty_tpl->tpl_vars['can_edit']->value) {?>
                                                <th class="text-center">
                                                    <span class="title_box "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete'),$_smarty_tpl ) );?>
</span>
                                                </th>
                                            <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['discounts']->value, 'discount');
$_smarty_tpl->tpl_vars['discount']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['discount']->value) {
$_smarty_tpl->tpl_vars['discount']->do_else = false;
?>
                                            <tr>
                                                <td><?php echo $_smarty_tpl->tpl_vars['discount']->value['name'];?>
</td>
                                                <td>
                                                <?php if ($_smarty_tpl->tpl_vars['discount']->value['value'] != 0.00) {?>
                                                    -
                                                <?php }?>
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

                                                </td>
                                                <?php if ($_smarty_tpl->tpl_vars['can_edit']->value) {?>
                                                    <td class="text-center">
                                                        <a class="btn btn-default delete-voucher" href="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&amp;submitDeleteVoucher&amp;id_order_cart_rule=<?php echo $_smarty_tpl->tpl_vars['discount']->value['id_order_cart_rule'];?>
&amp;id_order=<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);?>
"><i class="icon-trash"></i></a>
                                                    </td>
                                                <?php }?>
                                            </tr>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="list-empty">
                                <div class="list-empty-msg">
                                    <i class="icon-warning-sign list-empty-icon"></i>
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No vouchers created.'),$_smarty_tpl ) );?>

                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>

            <!-- linked orders block -->
            <?php if (count($_smarty_tpl->tpl_vars['order']->value->getBrother()) > 0) {?>
                <div class="col-lg-4 col-sm-6 col-xs-12 pull-right">
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="icon-link"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Linked orders'),$_smarty_tpl ) );?>

                        </div>
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order no. '),$_smarty_tpl ) );?>

                                            </th>
                                            <th>
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status'),$_smarty_tpl ) );?>

                                            </th>
                                            <th>
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Amount'),$_smarty_tpl ) );?>

                                            </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order']->value->getBrother(), 'brother_order');
$_smarty_tpl->tpl_vars['brother_order']->index = -1;
$_smarty_tpl->tpl_vars['brother_order']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['brother_order']->value) {
$_smarty_tpl->tpl_vars['brother_order']->do_else = false;
$_smarty_tpl->tpl_vars['brother_order']->index++;
$_smarty_tpl->tpl_vars['brother_order']->first = !$_smarty_tpl->tpl_vars['brother_order']->index;
$__foreach_brother_order_203_saved = $_smarty_tpl->tpl_vars['brother_order'];
?>
                                        <tr>
                                            <td>
                                                <a  href="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&amp;vieworder&amp;id_order=<?php echo $_smarty_tpl->tpl_vars['brother_order']->value->id;?>
&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);?>
">#<?php echo $_smarty_tpl->tpl_vars['brother_order']->value->id;?>
</a>
                                            </td>
                                            <td>
                                                <?php echo $_smarty_tpl->tpl_vars['brother_order']->value->getCurrentOrderState()->name[$_smarty_tpl->tpl_vars['current_id_lang']->value];?>

                                            </td>
                                            <td>
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['brother_order']->value->total_paid_tax_incl,'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

                                            </td>
                                            <td>
                                                <a  href="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&amp;vieworder&amp;id_order=<?php echo $_smarty_tpl->tpl_vars['brother_order']->value->id;?>
&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);?>
">
                                                    <i class="icon-eye-open"></i>
                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'See the order'),$_smarty_tpl ) );?>

                                                </a>
                                            </td>
                                        </tr>
                                        <?php
$_smarty_tpl->tpl_vars['brother_order'] = $__foreach_brother_order_203_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>

            <div class="col-lg-4 col-sm-6 col-xs-12 hidden-print">
                <div class="panel">
                    <div class="panel-heading">
                        <i class="icon-envelope"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Messages'),$_smarty_tpl ) );?>
 <span class="badge"><?php echo sizeof($_smarty_tpl->tpl_vars['customer_thread_message']->value);?>
</span>
                        <?php if ($_smarty_tpl->tpl_vars['id_customer_thread']->value) {?>
                            <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminCustomerThreads'), ENT_QUOTES, 'UTF-8', true);?>
&amp;viewcustomer_thread&id_customer_thread=<?php echo intval($_smarty_tpl->tpl_vars['id_customer_thread']->value);?>
" class="pull-right "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Show all messages'),$_smarty_tpl ) );?>
</a>
                        <?php } else { ?>
                            <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminCustomerThreads'), ENT_QUOTES, 'UTF-8', true);?>
" class="pull-right"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Show all messages'),$_smarty_tpl ) );?>
</a>
                        <?php }?>
                    </div>
                    <div id="messages">
                        <?php if ($_smarty_tpl->tpl_vars['can_edit']->value) {?>
                            <form action="<?php echo htmlspecialchars((string)$_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8', true);?>
&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);?>
" method="post" onsubmit="if (getE('visibility').checked == true) return confirm('<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Do you want to send this message to the customer?'),$_smarty_tpl ) );?>
');">
                                <div id="message" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Choose a standard message'),$_smarty_tpl ) );?>
</label>
                                        <p>
                                            <select class="chosen form-control" name="order_message" id="order_message" onchange="orderOverwriteMessage(this, '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Do you want to overwrite your existing message?'),$_smarty_tpl ) );?>
')">
                                                <option value="0" selected="selected">-</option>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['orderMessages']->value, 'orderMessage');
$_smarty_tpl->tpl_vars['orderMessage']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['orderMessage']->value) {
$_smarty_tpl->tpl_vars['orderMessage']->do_else = false;
?>
                                                <option value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['orderMessage']->value['message'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->tpl_vars['orderMessage']->value['name'];?>
</option>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            </select>
                                        </p>
                                        <div>
                                            <a  href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrderMessage'), ENT_QUOTES, 'UTF-8', true);?>
">
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Configure predefined messages'),$_smarty_tpl ) );?>

                                                <i class="icon-external-link"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Message'),$_smarty_tpl ) );?>
</label>
                                        <textarea rows="3" id="txt_msg" class="textarea-autosize" name="message"><?php echo htmlspecialchars((string)Tools::getValue('message'), ENT_QUOTES, 'UTF-8', true);?>
</textarea>
                                    </div>

                                <div class="form-group">
                                        <p class="checkbox">
                                            <label class="control-label" for="visibility">
                                                <input type="checkbox" name="visibility" id="visibility" value="1" />
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Display Message to Customer?'),$_smarty_tpl ) );?>

                                            </label>
                                        </p>
                                    </div>
                                    <input type="hidden" name="id_order" value="<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
" />
                                    <input type="hidden" name="id_customer" value="<?php echo $_smarty_tpl->tpl_vars['order']->value->id_customer;?>
" />

                                    <div class="row">
                                        <button type="submit" id="submitMessage" class="btn btn-primary pull-right" name="submitMessage">
                                            <i class="icon-paper-plane"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send Message'),$_smarty_tpl ) );?>

                                        </button>
                                    </div>
                                </div>
                            </form>
                        <?php } else { ?>
                            <div class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You do not have permission to edit this order.'),$_smarty_tpl ) );?>
</div>
                        <?php }?>
                    </div>
                </div>
            </div>

            <!-- Sources block -->
            <?php if ((sizeof($_smarty_tpl->tpl_vars['sources']->value))) {?>
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <i class="icon-globe"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sources'),$_smarty_tpl ) );?>
 <span class="badge"><?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['sources']->value);?>
</span>
                        </div>
                        <ul <?php if (sizeof($_smarty_tpl->tpl_vars['sources']->value) > 3) {?>style="height: 200px; overflow-y: scroll;"<?php }?>>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sources']->value, 'source');
$_smarty_tpl->tpl_vars['source']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['source']->value) {
$_smarty_tpl->tpl_vars['source']->do_else = false;
?>
                            <li class="form-group">
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'From'),$_smarty_tpl ) );?>
 <?php if ($_smarty_tpl->tpl_vars['source']->value['http_referer'] != '') {?><a  href="<?php echo $_smarty_tpl->tpl_vars['source']->value['http_referer'];?>
"><?php echo smarty_modifier_regex_replace(parse_url($_smarty_tpl->tpl_vars['source']->value['http_referer'],(defined('PHP_URL_HOST') ? constant('PHP_URL_HOST') : null)),'/^www./','');?>
</a><?php } else { ?>-<?php }?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To'),$_smarty_tpl ) );?>
 <a  href="http://<?php echo $_smarty_tpl->tpl_vars['source']->value['request_uri'];?>
"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['source']->value['request_uri'],100,'...' ));?>
</a> <br />
                                <?php if ($_smarty_tpl->tpl_vars['source']->value['keywords']) {?><b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Keywords'),$_smarty_tpl ) );?>
</b>: <?php echo $_smarty_tpl->tpl_vars['source']->value['keywords'];?>
<br /><?php }?>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['source']->value['date_add'],'full'=>true),$_smarty_tpl ) );?>
<br />
                            </li>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>

    <?php $_block_plugin19 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin19, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'no_rm_avail_txt'));
$_block_repeat=true;
echo $_block_plugin19->addJsDefL(array('name'=>'no_rm_avail_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No room available.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin19->addJsDefL(array('name'=>'no_rm_avail_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin20 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin20, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'no_realloc_rm_avail_txt'));
$_block_repeat=true;
echo $_block_plugin20->addJsDefL(array('name'=>'no_realloc_rm_avail_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No room available for reallocation.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin20->addJsDefL(array('name'=>'no_realloc_rm_avail_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin21 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin21, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'no_realloc_rm_type_avail_txt'));
$_block_repeat=true;
echo $_block_plugin21->addJsDefL(array('name'=>'no_realloc_rm_type_avail_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No room type available for reallocation.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin21->addJsDefL(array('name'=>'no_realloc_rm_type_avail_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin22 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin22, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'no_swap_rm_avail_txt'));
$_block_repeat=true;
echo $_block_plugin22->addJsDefL(array('name'=>'no_swap_rm_avail_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No room available for swap.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin22->addJsDefL(array('name'=>'no_swap_rm_avail_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin23 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin23, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'slct_rm_type_err'));
$_block_repeat=true;
echo $_block_plugin23->addJsDefL(array('name'=>'slct_rm_type_err'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please select a room type first.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin23->addJsDefL(array('name'=>'slct_rm_type_err'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin24 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin24, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'slct_rm_err'));
$_block_repeat=true;
echo $_block_plugin24->addJsDefL(array('name'=>'slct_rm_err'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please select a room first.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin24->addJsDefL(array('name'=>'slct_rm_err'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin25 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin25, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtExtraDemandSucc'));
$_block_repeat=true;
echo $_block_plugin25->addJsDefL(array('name'=>'txtExtraDemandSucc'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Updated Successfully','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin25->addJsDefL(array('name'=>'txtExtraDemandSucc'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin26 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin26, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'atleastSelectTxt'));
$_block_repeat=true;
echo $_block_plugin26->addJsDefL(array('name'=>'atleastSelectTxt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select at least one facility to update.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin26->addJsDefL(array('name'=>'atleastSelectTxt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin27 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin27, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtSomeErr'));
$_block_repeat=true;
echo $_block_plugin27->addJsDefL(array('name'=>'txtSomeErr'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Some error occurred. Please try again.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin27->addJsDefL(array('name'=>'txtSomeErr'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin28 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin28, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtDeleteSucc'));
$_block_repeat=true;
echo $_block_plugin28->addJsDefL(array('name'=>'txtDeleteSucc'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Deleted successfully','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin28->addJsDefL(array('name'=>'txtDeleteSucc'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin29 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin29, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtInvalidDemandVal'));
$_block_repeat=true;
echo $_block_plugin29->addJsDefL(array('name'=>'txtInvalidDemandVal'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invalid demand value found','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin29->addJsDefL(array('name'=>'txtInvalidDemandVal'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin30 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin30, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'select_age_txt'));
$_block_repeat=true;
echo $_block_plugin30->addJsDefL(array('name'=>'select_age_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select age','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin30->addJsDefL(array('name'=>'select_age_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin31 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin31, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'under_1_age'));
$_block_repeat=true;
echo $_block_plugin31->addJsDefL(array('name'=>'under_1_age'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Under 1','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin31->addJsDefL(array('name'=>'under_1_age'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin32 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin32, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'room_txt'));
$_block_repeat=true;
echo $_block_plugin32->addJsDefL(array('name'=>'room_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin32->addJsDefL(array('name'=>'room_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin33 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin33, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'rooms_txt'));
$_block_repeat=true;
echo $_block_plugin33->addJsDefL(array('name'=>'rooms_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rooms','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin33->addJsDefL(array('name'=>'rooms_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin34 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin34, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'remove_txt'));
$_block_repeat=true;
echo $_block_plugin34->addJsDefL(array('name'=>'remove_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin34->addJsDefL(array('name'=>'remove_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin35 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin35, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'adult_txt'));
$_block_repeat=true;
echo $_block_plugin35->addJsDefL(array('name'=>'adult_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adult','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin35->addJsDefL(array('name'=>'adult_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin36 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin36, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'adults_txt'));
$_block_repeat=true;
echo $_block_plugin36->addJsDefL(array('name'=>'adults_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin36->addJsDefL(array('name'=>'adults_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin37 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin37, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'child_txt'));
$_block_repeat=true;
echo $_block_plugin37->addJsDefL(array('name'=>'child_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin37->addJsDefL(array('name'=>'child_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin38 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin38, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'children_txt'));
$_block_repeat=true;
echo $_block_plugin38->addJsDefL(array('name'=>'children_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin38->addJsDefL(array('name'=>'children_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin39 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin39, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'below_txt'));
$_block_repeat=true;
echo $_block_plugin39->addJsDefL(array('name'=>'below_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Below','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin39->addJsDefL(array('name'=>'below_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin40 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin40, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'years_txt'));
$_block_repeat=true;
echo $_block_plugin40->addJsDefL(array('name'=>'years_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'years','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin40->addJsDefL(array('name'=>'years_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin41 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin41, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'all_children_txt'));
$_block_repeat=true;
echo $_block_plugin41->addJsDefL(array('name'=>'all_children_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All Children','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin41->addJsDefL(array('name'=>'all_children_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin42 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin42, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'max_occupancy_reached_txt'));
$_block_repeat=true;
echo $_block_plugin42->addJsDefL(array('name'=>'max_occupancy_reached_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Maximum room occupancy reached','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin42->addJsDefL(array('name'=>'max_occupancy_reached_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin43 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin43, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'max_adults_txt'));
$_block_repeat=true;
echo $_block_plugin43->addJsDefL(array('name'=>'max_adults_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Maximum adult occupancy reached','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin43->addJsDefL(array('name'=>'max_adults_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin44 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin44, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'max_children_txt'));
$_block_repeat=true;
echo $_block_plugin44->addJsDefL(array('name'=>'max_children_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Maximum children occupancy reached','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin44->addJsDefL(array('name'=>'max_children_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin45 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin45, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'no_children_allowed_txt'));
$_block_repeat=true;
echo $_block_plugin45->addJsDefL(array('name'=>'no_children_allowed_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Only adults can be accommodated','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin45->addJsDefL(array('name'=>'no_children_allowed_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin46 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin46, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'invalid_occupancy_txt'));
$_block_repeat=true;
echo $_block_plugin46->addJsDefL(array('name'=>'invalid_occupancy_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invalid occupancy(adults/children) found.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin46->addJsDefL(array('name'=>'invalid_occupancy_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin47 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin47, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'select_room_txt'));
$_block_repeat=true;
echo $_block_plugin47->addJsDefL(array('name'=>'select_room_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select room','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin47->addJsDefL(array('name'=>'select_room_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('max_child_age'=>preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['max_child_age']->value)),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('max_child_in_room'=>preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['max_child_in_room']->value)),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('ROOM_STATUS_CHECKED_IN'=>preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['ROOM_STATUS_CHECKED_IN']->value)),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('ROOM_STATUS_CHECKED_OUT'=>preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['ROOM_STATUS_CHECKED_OUT']->value)),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('ALLOTMENT_MANUAL'=>preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['ALLOTMENT_MANUAL']->value)),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('PS_OS_CANCELED'=>preg_replace("%(?<!\\\\)'%", "\'", (string)Configuration::get('PS_OS_CANCELED'))),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('PS_OS_REFUND'=>preg_replace("%(?<!\\\\)'%", "\'", (string)Configuration::get('PS_OS_REFUND'))),$_smarty_tpl ) );
$_block_plugin48 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin48, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txt_booking_document_upload_success'));
$_block_repeat=true;
echo $_block_plugin48->addJsDefL(array('name'=>'txt_booking_document_upload_success'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Document uploaded successfully.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin48->addJsDefL(array('name'=>'txt_booking_document_upload_success'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin49 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin49, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txt_booking_document_delete_confirm'));
$_block_repeat=true;
echo $_block_plugin49->addJsDefL(array('name'=>'txt_booking_document_delete_confirm'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Are you sure?','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin49->addJsDefL(array('name'=>'txt_booking_document_delete_confirm'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin50 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin50, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txt_booking_document_delete_success'));
$_block_repeat=true;
echo $_block_plugin50->addJsDefL(array('name'=>'txt_booking_document_delete_success'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Document deleted successfully.','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin50->addJsDefL(array('name'=>'txt_booking_document_delete_success'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin51 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin51, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'error_found_txt'));
$_block_repeat=true;
echo $_block_plugin51->addJsDefL(array('name'=>'error_found_txt'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Errors found','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin51->addJsDefL(array('name'=>'error_found_txt'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
/* {/block "override_tpl"} */
}
