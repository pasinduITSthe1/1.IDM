<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:33
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\_product_line.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2957b38e2_03991058',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f2381fa43abeac88e8466902ffbb8345a178f103' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\_product_line.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2957b38e2_03991058 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),1=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<tr class="product-line-row" data-id_htl_booking="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
" data-id_room="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_room'];?>
" data-id_product="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_product'];?>
" data-id_hotel="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_hotel'];?>
" data-date_from="<?php echo $_smarty_tpl->tpl_vars['data']->value['date_from'];?>
" data-date_to="<?php echo $_smarty_tpl->tpl_vars['data']->value['date_to'];?>
" data-product_price="<?php echo $_smarty_tpl->tpl_vars['data']->value['unit_amt_tax_incl'];?>
" data-id_order_detail="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_order_detail'];?>
">
	<td>
        <p><?php echo $_smarty_tpl->tpl_vars['data']->value['room_num'];?>
</p>
        <?php if ($_smarty_tpl->tpl_vars['data']->value['is_back_order']) {?>
            <span class="overbooked_room"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'overbooked'),$_smarty_tpl ) );?>
</span>
        <?php }?>
    </td>
	<td><img src="<?php echo $_smarty_tpl->tpl_vars['data']->value['image_link'];?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room image'),$_smarty_tpl ) );?>
"></td>
	<td>
        <p><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminProducts'), ENT_QUOTES, 'UTF-8', true);?>
&amp;id_product=<?php echo $_smarty_tpl->tpl_vars['data']->value['id_product'];?>
&amp;updateproduct" target="_blank"><span><?php echo $_smarty_tpl->tpl_vars['data']->value['room_type'];?>
</span></a></p>
    </td>
	<td>
		<?php $_smarty_tpl->_assignInScope('is_full_date', ($_smarty_tpl->tpl_vars['show_full_date']->value && (smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['date_from'],'%D') == smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['date_to'],'%D'))));?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['data']->value['date_from'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>
 - <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['data']->value['date_to'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>

	</td>
	<td>
		<?php if ($_smarty_tpl->tpl_vars['data']->value['children']) {?>
			<div class="dropdown">
				<a  data-toggle="dropdown">
					<span><?php if ($_smarty_tpl->tpl_vars['data']->value['adults']) {
echo $_smarty_tpl->tpl_vars['data']->value['adults'];
}?> <?php if ($_smarty_tpl->tpl_vars['data']->value['adults'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adult'),$_smarty_tpl ) );
}
ob_start();
echo $_smarty_tpl->tpl_vars['data']->value['children'];
$_prefixVariable20 = ob_get_clean();
if ($_prefixVariable20) {?>, <?php echo $_smarty_tpl->tpl_vars['data']->value['children'];?>
 <?php if ($_smarty_tpl->tpl_vars['data']->value['children'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );
}
}?></span>
				</a>
				<div class="dropdown-menu well well-sm">
					<label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children Ages'),$_smarty_tpl ) );?>
</label>
					<?php if ((isset($_smarty_tpl->tpl_vars['data']->value['child_ages'])) && $_smarty_tpl->tpl_vars['data']->value['child_ages']) {?>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['child_ages'], 'childAge');
$_smarty_tpl->tpl_vars['childAge']->iteration = 0;
$_smarty_tpl->tpl_vars['childAge']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['childAge']->value) {
$_smarty_tpl->tpl_vars['childAge']->do_else = false;
$_smarty_tpl->tpl_vars['childAge']->iteration++;
$__foreach_childAge_246_saved = $_smarty_tpl->tpl_vars['childAge'];
?>
							<p class="">
								<?php if ($_smarty_tpl->tpl_vars['childAge']->value == 0) {?>
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child %s : Under 1','sprintf'=>array($_smarty_tpl->tpl_vars['childAge']->iteration)),$_smarty_tpl ) );?>

                                <?php } else { ?>
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child %s : %s','sprintf'=>array($_smarty_tpl->tpl_vars['childAge']->iteration,$_smarty_tpl->tpl_vars['childAge']->value)),$_smarty_tpl ) );?>
 <?php if ($_smarty_tpl->tpl_vars['childAge']->value > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'years'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'year'),$_smarty_tpl ) );
}?>
                                <?php }?>
							</p>
						<?php
$_smarty_tpl->tpl_vars['childAge'] = $__foreach_childAge_246_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<?php }?>
				</div>
			</div>
		<?php } else { ?>
			<?php if ($_smarty_tpl->tpl_vars['data']->value['adults']) {
echo $_smarty_tpl->tpl_vars['data']->value['adults'];
}?> <?php if ($_smarty_tpl->tpl_vars['data']->value['adults'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adult'),$_smarty_tpl ) );
}
ob_start();
echo $_smarty_tpl->tpl_vars['data']->value['children'];
$_prefixVariable21 = ob_get_clean();
if ($_prefixVariable21) {?>, <?php echo $_smarty_tpl->tpl_vars['data']->value['children'];?>
 <?php if ($_smarty_tpl->tpl_vars['data']->value['children'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );
}
}?>
		<?php }?>
	</td>
	<td>
		<p>
			<span class="room_type_current_price">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['data']->value['total_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

			</span>
		</p>
		<p class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Per day price:'),$_smarty_tpl ) );?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['data']->value['paid_unit_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</p>
	</td>
	<td>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['data']->value['extra_demands_price_te']+$_smarty_tpl->tpl_vars['data']->value['additional_services_price_te']+$_smarty_tpl->tpl_vars['data']->value['convenience_fee_te']+$_smarty_tpl->tpl_vars['data']->value['additional_services_price_auto_add_te']),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

		<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['data']->value['extra_demands']) || smarty_modifier_count($_smarty_tpl->tpl_vars['data']->value['additional_services'])) {?>
			<a class="open_room_extra_services" href="#" date_from="<?php echo $_smarty_tpl->tpl_vars['data']->value['date_from'];?>
" date_to="<?php echo $_smarty_tpl->tpl_vars['data']->value['date_to'];?>
" id_product="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_product'];?>
" id_room="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_room'];?>
" id_order="<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
" id_htl_booking="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
				<i class="icon icon-lg icon-info-circle"></i>
			</a>
		<?php }?>
	</td>
	<td>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['data']->value['total_room_tax']),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

	</td>
	<td>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPriceWithCurrency'][0], array( array('price'=>($_smarty_tpl->tpl_vars['data']->value['total_room_price_ti']),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

	</td>
	<?php if (((isset($_smarty_tpl->tpl_vars['refundReqBookings']->value)) && $_smarty_tpl->tpl_vars['refundReqBookings']->value)) {?>
		<td>
            <?php if (in_array($_smarty_tpl->tpl_vars['data']->value['id'],$_smarty_tpl->tpl_vars['refundReqBookings']->value)) {?>
			    <?php if ($_smarty_tpl->tpl_vars['data']->value['is_cancelled']) {?>
				    <span class="badge badge-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancelled'),$_smarty_tpl ) );?>
</span>
			    <?php } elseif ((isset($_smarty_tpl->tpl_vars['data']->value['refund_info'])) && (!$_smarty_tpl->tpl_vars['data']->value['refund_info']['refunded'] || $_smarty_tpl->tpl_vars['data']->value['refund_info']['id_customization'])) {?>
				    <span class="badge" style="background-color:<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['refund_info']['color'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['refund_info']['name'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                <?php } else { ?>
	    			<span>--</span>
                <?php }?>
			<?php } else { ?>
                <span>--</span>
            <?php }?>
		</td>
		<td>
			<?php if ($_smarty_tpl->tpl_vars['data']->value['is_refunded'] && (isset($_smarty_tpl->tpl_vars['data']->value['refund_info'])) && $_smarty_tpl->tpl_vars['data']->value['refund_info']) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['data']->value['refund_info']['refunded_amount'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

            <?php } else { ?>
				--
			<?php }?>
		</td>
	<?php }?>
	<?php if (($_smarty_tpl->tpl_vars['can_edit']->value && !$_smarty_tpl->tpl_vars['order']->value->hasBeenDelivered())) {?>
		<td class="product_action">
            <div class="btn-group">
                <?php if ((isset($_smarty_tpl->tpl_vars['refundReqBookings']->value)) && $_smarty_tpl->tpl_vars['refundReqBookings']->value && in_array($_smarty_tpl->tpl_vars['data']->value['id'],$_smarty_tpl->tpl_vars['refundReqBookings']->value) && $_smarty_tpl->tpl_vars['data']->value['is_cancelled']) {?>
                    <button href="#" class="btn btn-default delete_room_line">
                        <i class="icon-trash"></i>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete'),$_smarty_tpl ) );?>

                    </button>
                <?php } else { ?>
                    <button href="#" class="btn btn-default edit_room_change_link" data-product_line_data="<?php echo htmlspecialchars((string)json_encode($_smarty_tpl->tpl_vars['data']->value), ENT_QUOTES, 'UTF-8', true);?>
">
                        <i class="icon-pencil"></i>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit'),$_smarty_tpl ) );?>

                    </button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="#" class="room_reallocate_swap" id="reallocate_room_<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-room_type_name="<?php echo $_smarty_tpl->tpl_vars['data']->value['room_type_name'];?>
" data-toggle="modal" data-target="#mySwappigModal" data-id_htl_booking="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-id_order="<?php echo $_smarty_tpl->tpl_vars['data']->value['id_order'];?>
" data-room_num='<?php echo $_smarty_tpl->tpl_vars['data']->value['room_num'];?>
' data-id_room_type='<?php echo $_smarty_tpl->tpl_vars['data']->value['id_product'];?>
' data-cust_name='<?php echo $_smarty_tpl->tpl_vars['data']->value['alloted_cust_name'];?>
' data-cust_email='<?php echo $_smarty_tpl->tpl_vars['data']->value['alloted_cust_email'];?>
' data-avail_rm_swap='<?php echo json_encode($_smarty_tpl->tpl_vars['data']->value['avail_rooms_to_swap']);?>
' data-avail_realloc_room_types='<?php echo json_encode($_smarty_tpl->tpl_vars['data']->value['avail_room_types_to_realloc']);?>
' data-allotment_type='<?php echo $_smarty_tpl->tpl_vars['data']->value['booking_type'];?>
' data-allotment_type_label='<?php if ($_smarty_tpl->tpl_vars['data']->value['booking_type'] == $_smarty_tpl->tpl_vars['ALLOTMENT_MANUAL']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Manual'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Auto'),$_smarty_tpl ) );
}?>' data-comment='<?php echo $_smarty_tpl->tpl_vars['data']->value['comment'];?>
'>
                                <i class="icon-refresh"></i>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reallocate/Swap Room'),$_smarty_tpl ) );?>

                            </a>
                        </li>
                        <li>
                            <a href="#" class="delete_room_line">
                                <i class="icon-trash"></i>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete'),$_smarty_tpl ) );?>

                            </a>
                        </li>
                    </ul>
                <?php }?>
			</div>
		</td>
	<?php }?>
</tr><?php }
}
