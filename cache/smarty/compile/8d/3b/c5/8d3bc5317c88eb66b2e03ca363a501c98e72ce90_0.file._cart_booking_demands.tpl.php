<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:31
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\_cart_booking_demands.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f293aa0a57_60750056',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8d3bc5317c88eb66b2e03ca363a501c98e72ce90' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\_cart_booking_demands.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:controllers/orders/modals/_add_order_extra_services_tab_content.tpl' => 1,
  ),
),false)) {
function content_68e4f293aa0a57_60750056 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal" tabindex="-1" role="dialog" id="rooms_type_extra_demands">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="icon-remove-sign"></i></button>
                <h4 class="modal-title"><i class="icon icon-bed"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room Services'),$_smarty_tpl ) );?>
</h4>
            </div>
			<div class="modal-body" id="rooms_extra_demands">
                <ul class="nav nav-tabs" role="tablist">
					<?php if ((isset($_smarty_tpl->tpl_vars['selectedRoomDemands']->value)) && $_smarty_tpl->tpl_vars['selectedRoomDemands']->value) {?>
						<li role="presentation" class="active"><a href="#room_type_demands_desc" aria-controls="facilities" role="tab" data-toggle="tab"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Facilities'),$_smarty_tpl ) );?>
</a></li>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['serviceProducts']->value)) && $_smarty_tpl->tpl_vars['serviceProducts']->value) {?>
						<li role="presentation" <?php if (!(isset($_smarty_tpl->tpl_vars['selectedRoomDemands']->value)) || !$_smarty_tpl->tpl_vars['selectedRoomDemands']->value) {?>class="active"<?php }?>><a href="#room_type_service_product_desc" aria-controls="services" role="tab" data-toggle="tab"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Services'),$_smarty_tpl ) );?>
</a></li>
					<?php }?>
				</ul>
				<div class="tab-content">
					<?php if ((isset($_smarty_tpl->tpl_vars['selectedRoomDemands']->value)) && $_smarty_tpl->tpl_vars['selectedRoomDemands']->value) {?>
						<div id="room_type_demands_desc" class="tab-pane active">
							<div id="room_type_demands_desc">
								<?php if ((isset($_smarty_tpl->tpl_vars['selectedRoomDemands']->value)) && $_smarty_tpl->tpl_vars['selectedRoomDemands']->value) {?>
									<?php $_smarty_tpl->_assignInScope('roomCount', 1);?>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['selectedRoomDemands']->value, 'roomDemand', false, 'key');
$_smarty_tpl->tpl_vars['roomDemand']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['roomDemand']->value) {
$_smarty_tpl->tpl_vars['roomDemand']->do_else = false;
?>
										<div class="row room_demands_container">
											<div class="col-sm-12 room_demand_detail">
												<?php if ((isset($_smarty_tpl->tpl_vars['roomTypeDemands']->value)) && $_smarty_tpl->tpl_vars['roomTypeDemands']->value) {?>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</th>
                                                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Options'),$_smarty_tpl ) );?>
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
                                                                    <td class="demand_adv_option_block">
                                                                        <p><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['demand']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</p>
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
                                                                            --
                                                                            <input type="hidden" class="id_option" value="0" />
                                                                        <?php }?>
                                                                    </td>
                                                                    <td>
                                                                        <span class="extra_demand_option_price">
                                                                            <?php if ((isset($_smarty_tpl->tpl_vars['selected_adv_option']->value)) && (isset($_smarty_tpl->tpl_vars['demand']->value['adv_option'][$_smarty_tpl->tpl_vars['selected_adv_option']->value]['price_tax_excl']))) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>htmlspecialchars((string)$_smarty_tpl->tpl_vars['demand']->value['adv_option'][$_smarty_tpl->tpl_vars['selected_adv_option']->value]['price_tax_excl'], ENT_QUOTES, 'UTF-8', true)),$_smarty_tpl ) );
} elseif ((isset($_smarty_tpl->tpl_vars['demand']->value['adv_option'])) && $_smarty_tpl->tpl_vars['demand']->value['adv_option']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['demand']->value['adv_option'][key($_smarty_tpl->tpl_vars['demand']->value['adv_option'])]['price_tax_excl']),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>htmlspecialchars((string)$_smarty_tpl->tpl_vars['demand']->value['price_tax_excl'], ENT_QUOTES, 'UTF-8', true)),$_smarty_tpl ) );
}?>
                                                                        </span>
                                                                        <?php if ($_smarty_tpl->tpl_vars['demand']->value['price_calc_method'] == HotelRoomTypeGlobalDemand::WK_PRICE_CALC_METHOD_EACH_DAY) {?>
                                                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'/ night'),$_smarty_tpl ) );?>

                                                                        <?php }?>
                                                                    </td>
                                                                </tr>
                                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                        </tbody>
                                                    </table>
												<?php }?>
											</div>
										</div>
										<?php $_smarty_tpl->_assignInScope('roomCount', $_smarty_tpl->tpl_vars['roomCount']->value+1);?>
									<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								<?php }?>
							</div>
						</div>
					<?php }?>

                    <?php $_smarty_tpl->_subTemplateRender('file:controllers/orders/modals/_add_order_extra_services_tab_content.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
				</div>
                <?php if ((isset($_smarty_tpl->tpl_vars['loaderImg']->value)) && $_smarty_tpl->tpl_vars['loaderImg']->value) {?>
                    <div class="loading_overlay">
                        <img src='<?php echo $_smarty_tpl->tpl_vars['loaderImg']->value;?>
' class="loading-img"/>
                    </div>
                <?php }?>
			</div>
		</div>
	</div>
</div>
<?php }
}
