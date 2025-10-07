<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:30
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\_partials\booking-form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2925cedc5_79419707',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57b3d6e12a033fd4f99fd0e4702a458802ce0e98' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\_partials\\booking-form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./occupancy_field.tpl' => 1,
    'file:./quantity_field.tpl' => 1,
  ),
),false)) {
function content_68e4f2925cedc5_79419707 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<div class="booking-form card">
    <div class="booking_room_fields">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_63080033768e4f291ec1317_73438842', 'booking_form_content');
?>

    </div>
</div>
<?php }
/* {block 'product_hidden_fields'} */
class Block_134281962868e4f291ec3564_94803480 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <p class="hidden">
                        <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['static_token']->value;?>
" />
                        <input type="hidden" name="id_product" value="<?php echo intval($_smarty_tpl->tpl_vars['product']->value->id);?>
" id="product_page_product_id" />
                        <input type="hidden" name="booking_product" value="<?php echo intval($_smarty_tpl->tpl_vars['product']->value->booking_product);?>
" id="product_page_booking_product" />
                        <input type="hidden" name="add" value="1" />
                        <input type="hidden" name="id_product_attribute" id="idCombination" value="" />
                    </p>
                <?php
}
}
/* {/block 'product_hidden_fields'} */
/* {block 'booking_form_hotel_location'} */
class Block_11380144068e4f291eecf39_27690655 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <?php if ((isset($_smarty_tpl->tpl_vars['id_hotel']->value)) && $_smarty_tpl->tpl_vars['id_hotel']->value) {?>
                        <div class="form-group htl_location_block">
                            <label for="" class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hotel Location'),$_smarty_tpl ) );?>
</label>
                            <p><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['hotel_location']->value, ENT_QUOTES, 'UTF-8', true);?>
</p>
                        </div>
                    <?php }?>
                <?php
}
}
/* {/block 'booking_form_hotel_location'} */
/* {block 'booking_form_dates'} */
class Block_2071222768e4f292012555_94794687 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                    <div class="form-group col-sm-12">
                                        <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check In - Check Out'),$_smarty_tpl ) );?>
</label>
                                        <div class="form-control input-date" id="room_date_range"  autocomplete="off" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-in - Check-out'),$_smarty_tpl ) );?>
"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-in'),$_smarty_tpl ) );?>
 &nbsp;<i class="icon icon-minus"></i>&nbsp; <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-out'),$_smarty_tpl ) );?>
</span></div>
                                        <input type="hidden" class="input-date" name="room_check_in" id="room_check_in" value="<?php if ((isset($_smarty_tpl->tpl_vars['date_from']->value))) {
echo $_smarty_tpl->tpl_vars['date_from']->value;
}?>" />
                                        <input type="hidden" class="input-date" name="room_check_out" id="room_check_out" value="<?php if ((isset($_smarty_tpl->tpl_vars['date_to']->value))) {
echo $_smarty_tpl->tpl_vars['date_to']->value;
}?>" />
                                    </div>
                                <?php
}
}
/* {/block 'booking_form_dates'} */
/* {block 'occupancy_field'} */
class Block_168870899068e4f29206d3c4_20073772 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                                    <?php $_smarty_tpl->_subTemplateRender("file:./occupancy_field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                                <?php
}
}
/* {/block 'occupancy_field'} */
/* {block 'quantity_field'} */
class Block_57484278968e4f292090017_81382734 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                                    <?php $_smarty_tpl->_subTemplateRender("file:./quantity_field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                                                <?php
}
}
/* {/block 'quantity_field'} */
/* {block 'booking_form_quantity_wrapper'} */
class Block_93274109368e4f292050542_79321491 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                    <div class="row">
                                        <div class="form-group col-sm-12"<?php if (!$_smarty_tpl->tpl_vars['product']->value->available_for_order || $_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?> style="display: none;"<?php }?>>
                                            <?php if ((isset($_smarty_tpl->tpl_vars['occupancy_required_for_booking']->value)) && $_smarty_tpl->tpl_vars['occupancy_required_for_booking']->value) {?>
                                                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Guests'),$_smarty_tpl ) );?>
</label>
                                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_168870899068e4f29206d3c4_20073772', 'occupancy_field', $this->tplIndex);
?>

                                            <?php } else { ?>
                                                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No. of Rooms'),$_smarty_tpl ) );?>
</label>
                                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_57484278968e4f292090017_81382734', 'quantity_field', $this->tplIndex);
?>

                                            <?php }?>
                                        </div>
                                    </div>
                                <?php
}
}
/* {/block 'booking_form_quantity_wrapper'} */
/* {block 'booking_form_price_information'} */
class Block_190071255568e4f2920a4600_01763232 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                    <?php if (((isset($_smarty_tpl->tpl_vars['has_room_type_demands']->value)) && $_smarty_tpl->tpl_vars['has_room_type_demands']->value) || ((isset($_smarty_tpl->tpl_vars['service_products_exists']->value)) && $_smarty_tpl->tpl_vars['service_products_exists']->value)) {?>
                                        <hr class="separator-hr-mg-10">
                                        <div class="row price_desc_block">
                                            <div class="col-sm-6">
                                                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room Price'),$_smarty_tpl ) );?>
</label>
                                                    <p>
                                                        <span class="total_price_block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>floatval($_smarty_tpl->tpl_vars['rooms_price']->value)),$_smarty_tpl ) );?>
</span>
                                                        <span class="pull-right plus-sign">+</span>
                                                    </p>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Extra Services'),$_smarty_tpl ) );?>
</label>
                                                <p class="extra_demands_price_block">
                                                    <?php if ((isset($_smarty_tpl->tpl_vars['demands_price']->value))) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['demands_price']->value),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>0),$_smarty_tpl ) );
}?>
                                                    <?php if (((isset($_smarty_tpl->tpl_vars['selected_demands']->value)) && $_smarty_tpl->tpl_vars['selected_demands']->value) || ((isset($_smarty_tpl->tpl_vars['selected_service_product']->value)) && $_smarty_tpl->tpl_vars['selected_service_product']->value)) {?>
                                                        <span class="services-info">
                                                            <img src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
icon/icon-info.svg" />
                                                        </span>
                                                    <?php }?>
                                                </p>
                                                <?php if (((isset($_smarty_tpl->tpl_vars['selected_demands']->value)) && $_smarty_tpl->tpl_vars['selected_demands']->value) || ((isset($_smarty_tpl->tpl_vars['selected_service_product']->value)) && $_smarty_tpl->tpl_vars['selected_service_product']->value)) {?>
                                                    <div class="services-info-container" style="display: none;">
                                                        <div class="services-info-tooltip-cont">
                                                            <?php if ((isset($_smarty_tpl->tpl_vars['selected_service_product']->value)) && $_smarty_tpl->tpl_vars['selected_service_product']->value) {?>
                                                                <div class="extra-service-panel">
                                                                    <p class="panel_title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Selected services'),$_smarty_tpl ) );?>
 <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Per room)'),$_smarty_tpl ) );?>
</span></p>
                                                                    <div class="services-list">
                                                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['selected_service_product']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                                                                            <div class="services-list-row">
                                                                                <div>
                                                                                    <?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>

                                                                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
                                                                                        <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'qty'),$_smarty_tpl ) );?>
: <?php echo $_smarty_tpl->tpl_vars['product']->value['quantity'];?>
</p>
                                                                                    <?php }?>
                                                                                </div>
                                                                                <div class="text-right">
                                                                                    <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl ) );?>
</p>
                                                                                    <a class="btn btn-sm btn-default remove_roomtype_product" data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
"><i class="icon-trash"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                    </div>
                                                                </div>
                                                            <?php }?>
                                                            <?php if ((isset($_smarty_tpl->tpl_vars['selected_demands']->value)) && $_smarty_tpl->tpl_vars['selected_demands']->value) {?>
                                                                <div class="extra-service-panel">
                                                                    <p class="panel_title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Selected facilities'),$_smarty_tpl ) );?>
 <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Per room)'),$_smarty_tpl ) );?>
</span></p>
                                                                    <div class="services-list">
                                                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['selected_demands']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                                                                            <div class="services-list-row">
                                                                                <div>
                                                                                    <?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>

                                                                                    <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['advance_option'])) && $_smarty_tpl->tpl_vars['product']->value['advance_option']) {?>
                                                                                        <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Option:'),$_smarty_tpl ) );?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value['advance_option']['name'];?>
</p>
                                                                                    <?php }?>
                                                                                </div>
                                                                                <div class="text-right">
                                                                                    <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl ) );?>
</p>
                                                                                    <a class="btn btn-sm btn-default remove_roomtype_demand" data-id_global_demand="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_global_demand'];?>
"><i class="icon-trash"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                    </div>
                                                                </div>
                                                            <?php }?>
                                                            <hr>
                                                            <div class="extra-service-panel">
                                                                <div class="summary-row">
                                                                    <div><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total price per room'),$_smarty_tpl ) );?>
</div>
                                                                    <div><p class="service_price"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['demands_price_per_room']->value),$_smarty_tpl ) );?>
</p></div>
                                                                </div>
                                                                <div class="summary-row">
                                                                    <div><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total price:'),$_smarty_tpl ) );?>
</div>
                                                                    <div><p class="service_price"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['demands_price']->value),$_smarty_tpl ) );?>
</p></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <hr class="separator-hr-mg-10 form-group">
                                    <?php }?>
                                <?php
}
}
/* {/block 'booking_form_price_information'} */
/* {block 'booking_form_total_price'} */
class Block_206693511968e4f2921f36f6_21566955 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                                <div class="total_price_block col-xs-7 form-group">
                                                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total'),$_smarty_tpl ) );?>
</label>
                                                    <p>
                                                        <?php if ($_smarty_tpl->tpl_vars['total_price']->value && $_smarty_tpl->tpl_vars['total_price_without_discount']->value > $_smarty_tpl->tpl_vars['total_price']->value) {?>
                                                            <span class="room_type_old_price">
                                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>floatval($_smarty_tpl->tpl_vars['total_price_without_discount']->value)),$_smarty_tpl ) );?>

                                                            </span>
                                                        <?php }?>
                                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>floatval($_smarty_tpl->tpl_vars['total_price']->value)),$_smarty_tpl ) );?>

                                                    </p>
                                                </div>
                                            <?php
}
}
/* {/block 'booking_form_total_price'} */
/* {block 'booking_form_available_quantity'} */
class Block_24049129668e4f292226564_05946110 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                                <?php if ($_smarty_tpl->tpl_vars['total_available_rooms']->value <= $_smarty_tpl->tpl_vars['warning_count']->value) {?>
                                                    <div class="col-xs-5 form-group text-right num_quantity_alert">
                                                        <span class="num_searched_avail_rooms">
                                                            <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['total_available_rooms']->value, ENT_QUOTES, 'UTF-8', true);?>

                                                        </span>
                                                        <?php if ($_smarty_tpl->tpl_vars['total_available_rooms']->value > 1) {?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'rooms left!'),$_smarty_tpl ) );?>
 <?php } else { ?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'room left!'),$_smarty_tpl ) );?>
 <?php }?>
                                                    </div>
                                                <?php }?>
                                            <?php
}
}
/* {/block 'booking_form_available_quantity'} */
/* {block 'booking_form_book_now_button'} */
class Block_129821441368e4f2922c5711_85503380 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                                    <p id="add_to_cart" class="buttons_bottom_block no-print">
                                                        <button type="submit" name="Submit" class="exclusive book_now_submit">
                                                            <span>
                                                                <?php if ((isset($_smarty_tpl->tpl_vars['content_only']->value)) && $_smarty_tpl->tpl_vars['content_only']->value && ((isset($_smarty_tpl->tpl_vars['product']->value->customization_required)) && $_smarty_tpl->tpl_vars['product']->value->customization_required)) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customize'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Book Now'),$_smarty_tpl ) );
}?>
                                                            </span>
                                                            <span id="booking_action_loader"></span>
                                                        </button>
                                                    </p>
                                                <?php
}
}
/* {/block 'booking_form_book_now_button'} */
/* {block 'booking_form_actions'} */
class Block_116649898968e4f2921f1867_59173799 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                    <div id="booking_action_block">
                                        <div class="row">
                                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_206693511968e4f2921f36f6_21566955', 'booking_form_total_price', $this->tplIndex);
?>

                                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_24049129668e4f292226564_05946110', 'booking_form_available_quantity', $this->tplIndex);
?>

                                        </div>
                                        <div>
                                            <?php if ((!$_smarty_tpl->tpl_vars['allow_oosp']->value && $_smarty_tpl->tpl_vars['product']->value->quantity <= 0) || !$_smarty_tpl->tpl_vars['product']->value->available_for_order || ((isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)) && $_smarty_tpl->tpl_vars['restricted_country_mode']->value) || $_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value || $_smarty_tpl->tpl_vars['order_date_restrict']->value) {?>
                                            <?php } else { ?>
                                                <div id="additional_products" class="hidden">
                                                    <?php if ((isset($_smarty_tpl->tpl_vars['selected_service_product']->value)) && $_smarty_tpl->tpl_vars['selected_service_product']->value) {?>
                                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['selected_service_product']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                                                            <input type="hidded" id="service_product_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" name="service_product[<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
][]" class="service_product" data-id_product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['quantity'];?>
">
                                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                    <?php }?>
                                                </div>
                                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_129821441368e4f2922c5711_85503380', 'booking_form_book_now_button', $this->tplIndex);
?>

                                            <?php }?>
                                        </div>
                                    </div>
                                <?php
}
}
/* {/block 'booking_form_actions'} */
/* {block 'booking_form_associated_hotels'} */
class Block_182406139068e4f292304102_42327415 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <?php if ((isset($_smarty_tpl->tpl_vars['associated_hotels']->value)) && $_smarty_tpl->tpl_vars['associated_hotels']->value) {?>
                                <div class="form-group">
                                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select Hotel'),$_smarty_tpl ) );?>
</label>
                                    <select class="chosen input-hotel" name="service_id_hotel" id="service_id_hotel">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['associated_hotels']->value, 'hotel');
$_smarty_tpl->tpl_vars['hotel']->index = -1;
$_smarty_tpl->tpl_vars['hotel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['hotel']->value) {
$_smarty_tpl->tpl_vars['hotel']->do_else = false;
$_smarty_tpl->tpl_vars['hotel']->index++;
$_smarty_tpl->tpl_vars['hotel']->first = !$_smarty_tpl->tpl_vars['hotel']->index;
$__foreach_hotel_196_saved = $_smarty_tpl->tpl_vars['hotel'];
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['hotel']->value['id_hotel'];?>
" <?php if ((isset($_smarty_tpl->tpl_vars['service_id_hotel']->value)) && $_smarty_tpl->tpl_vars['service_id_hotel']->value == $_smarty_tpl->tpl_vars['hotel']->value['id_hotel']) {?>selected<?php } elseif ($_smarty_tpl->tpl_vars['hotel']->first) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['hotel']->value['name'];?>
</option>
                                        <?php
$_smarty_tpl->tpl_vars['hotel'] = $__foreach_hotel_196_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </select>
                                </div>
                            <?php }?>
                        <?php
}
}
/* {/block 'booking_form_associated_hotels'} */
/* {block 'booking_form_product_option'} */
class Block_36341371368e4f292368c79_05240944 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <?php if ((isset($_smarty_tpl->tpl_vars['product_option']->value)) && $_smarty_tpl->tpl_vars['product_option']->value) {?>
                                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Variants'),$_smarty_tpl ) );?>
</label>
                                <hr>
                                <div class="product-options-block">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_option']->value, 'option');
$_smarty_tpl->tpl_vars['option']->index = -1;
$_smarty_tpl->tpl_vars['option']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->do_else = false;
$_smarty_tpl->tpl_vars['option']->index++;
$_smarty_tpl->tpl_vars['option']->first = !$_smarty_tpl->tpl_vars['option']->index;
$__foreach_option_197_saved = $_smarty_tpl->tpl_vars['option'];
?>
                                        <div class="form-group">
                                            <label for="id_product_option<?php echo $_smarty_tpl->tpl_vars['option']->value['id_product_option'];?>
" class="top">
                                                <input type="radio" name="id_product_option" id="id_product_option<?php echo $_smarty_tpl->tpl_vars['option']->value['id_product_option'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['option']->value['id_product_option'];?>
" <?php if ((isset($_smarty_tpl->tpl_vars['id_product_option']->value)) && $_smarty_tpl->tpl_vars['id_product_option']->value == $_smarty_tpl->tpl_vars['option']->value['id_product_option']) {?>checked="checked"<?php } elseif ($_smarty_tpl->tpl_vars['option']->first) {?>checked="checked"<?php }?>/>
                                                <?php echo $_smarty_tpl->tpl_vars['option']->value['name'];?>

                                                <span class="pull-right"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['option']->value['price']),$_smarty_tpl ) );?>
</span>
                                            </label>
                                        </div>
                                        <hr>
                                    <?php
$_smarty_tpl->tpl_vars['option'] = $__foreach_option_197_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </div>
                            <?php }?>
                        <?php
}
}
/* {/block 'booking_form_product_option'} */
/* {block 'booking_form_service_product_quantity'} */
class Block_189267835968e4f2923cd848_66677035 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <?php $_smarty_tpl->_assignInScope('is_out_of_stock', false);?>
                            <?php $_smarty_tpl->_assignInScope('max_qty_reached', false);?>
                            <?php if ((!$_smarty_tpl->tpl_vars['allow_oosp']->value && $_smarty_tpl->tpl_vars['product']->value->quantity <= 0) || !$_smarty_tpl->tpl_vars['product']->value->available_for_order || ((isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)) && $_smarty_tpl->tpl_vars['restricted_country_mode']->value) || $_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
                                <?php $_smarty_tpl->_assignInScope('is_out_of_stock', true);?>
                            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value->allow_multiple_quantity && !$_smarty_tpl->tpl_vars['product']->value->max_quantity) {?>
                                <?php $_smarty_tpl->_assignInScope('max_qty_reached', true);?>
                            <?php }?>

                            <?php if ($_smarty_tpl->tpl_vars['product']->value->allow_multiple_quantity) {?>
                                <div class="row">
                                    <div class="form-group col-sm-6" id="quantity_wanted_p"<?php if ($_smarty_tpl->tpl_vars['is_out_of_stock']->value || $_smarty_tpl->tpl_vars['max_qty_reached']->value) {?> style="display: none;"<?php }?>>
                                        <label for="quantity_wanted_p"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity'),$_smarty_tpl ) );?>
</label>
                                        
                                            <div class="qty_container">
                                                <input type="hidden" class="stock_qty" id="stock_qty" name="stock_qty" data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" data-stock_quantity="<?php echo $_smarty_tpl->tpl_vars['product']->value->quantity;?>
" data-allow_oosp="<?php echo $_smarty_tpl->tpl_vars['allow_oosp']->value;?>
" >
                                                <input type="hidden" class="service_product_qty" id="service_product_qty" name="service_product_qty" data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" data-cart_quantity="<?php if ((isset($_smarty_tpl->tpl_vars['product']->value->cart_quantity)) && $_smarty_tpl->tpl_vars['product']->value->cart_quantity) {
echo $_smarty_tpl->tpl_vars['product']->value->cart_quantity;
} else { ?>0<?php }?>" data-max_quantity="<?php if ((isset($_smarty_tpl->tpl_vars['product']->value->max_quantity))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value->max_quantity, ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->tpl_vars['product']->value->quantity;
}?>" value="<?php if ((isset($_smarty_tpl->tpl_vars['quantity']->value))) {
echo intval($_smarty_tpl->tpl_vars['quantity']->value);
} else {
if ($_smarty_tpl->tpl_vars['product']->value->minimal_quantity > 1) {
echo $_smarty_tpl->tpl_vars['product']->value->minimal_quantity;
} else { ?>1<?php }
}?>">
                                                <div class="qty_count pull-left">
                                                    <span><?php if ((isset($_smarty_tpl->tpl_vars['quantity']->value))) {
echo intval($_smarty_tpl->tpl_vars['quantity']->value);
} else {
if ($_smarty_tpl->tpl_vars['product']->value->minimal_quantity > 1) {
echo $_smarty_tpl->tpl_vars['product']->value->minimal_quantity;
} else { ?>1<?php }
}?></span>
                                                </div>
                                                <div class="qty_direction pull-left">
                                                    <a href="#" class="btn btn-default quantity_up service_product_qty_up"><span><i class="icon-plus"></i></span></a>
                                                    <a href="#" class="btn btn-default quantity_down service_product_qty_down"><span><i class="icon-minus"></i></span></a>
                                                </div>
                                            </div>
                                        <span class="clearfix"></span>
                                    </div>
                                </div>
                                <?php if (!$_smarty_tpl->tpl_vars['is_out_of_stock']->value && !$_smarty_tpl->tpl_vars['max_qty_reached']->value) {?>
                                    <hr class="separator-hr-mg-10">
                                <?php }?>
                            <?php } else { ?>
                                <input type="hidden" class="service_product_qty" id="service_product_qty" name="service_product_qty" data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" data-max_quantity="1" value="1">
                            <?php }?>
                        <?php
}
}
/* {/block 'booking_form_service_product_quantity'} */
/* {block 'booking_form_total_price'} */
class Block_135942445568e4f29253b472_20313590 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                        <div class="total_price_block col-xs-7 form-group">
                                            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price'),$_smarty_tpl ) );?>
</label>
                                            <p>
                                                <?php if ($_smarty_tpl->tpl_vars['service_price']->value && $_smarty_tpl->tpl_vars['service_price_without_reduction']->value > $_smarty_tpl->tpl_vars['service_price']->value) {?>
                                                    <span class="room_type_old_price">
                                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>floatval($_smarty_tpl->tpl_vars['service_price_without_reduction']->value)),$_smarty_tpl ) );?>

                                                    </span>
                                                <?php }?>
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['service_price']->value),$_smarty_tpl ) );?>

                                            </p>
                                        </div>
                                    <?php
}
}
/* {/block 'booking_form_total_price'} */
/* {block 'booking_form_available_quantity'} */
class Block_50606574768e4f292562c40_03306157 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                                                            <?php
}
}
/* {/block 'booking_form_available_quantity'} */
/* {block 'booking_form_book_now_button'} */
class Block_14264779768e4f292587891_27946368 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                                <p id="add_to_cart" class="buttons_bottom_block no-print">
                                                    <button type="submit" name="Submit" class="exclusive book_now_submit">
                                                        <span>
                                                            <?php if ((isset($_smarty_tpl->tpl_vars['content_only']->value)) && $_smarty_tpl->tpl_vars['content_only']->value && ((isset($_smarty_tpl->tpl_vars['product']->value->customization_required)) && $_smarty_tpl->tpl_vars['product']->value->customization_required)) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customize'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Book Now'),$_smarty_tpl ) );
}?>
                                                        </span>
                                                        <span id="booking_action_loader"></span>
                                                    </button>
                                                </p>
                                        <?php
}
}
/* {/block 'booking_form_book_now_button'} */
/* {block 'booking_form_actions'} */
class Block_82808092868e4f292539292_29875682 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <div id="booking_action_block">
                                <div class="row">
                                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_135942445568e4f29253b472_20313590', 'booking_form_total_price', $this->tplIndex);
?>

                                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_50606574768e4f292562c40_03306157', 'booking_form_available_quantity', $this->tplIndex);
?>

                                </div>
                                <div>
                                   <?php if ($_smarty_tpl->tpl_vars['is_out_of_stock']->value) {?>
                                        <div class="sold_out_alert">
                                            <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product is out of stock!'),$_smarty_tpl ) );?>
</span>
                                        </div>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['max_qty_reached']->value) {?>
                                        <div class="sold_out_alert">
                                            <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Max. quantity reached for cart!'),$_smarty_tpl ) );?>
</span>
                                        </div>
                                    <?php } else { ?>
                                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14264779768e4f292587891_27946368', 'booking_form_book_now_button', $this->tplIndex);
?>

                                    <?php }?>
                                </div>
                            </div>
                        <?php
}
}
/* {/block 'booking_form_actions'} */
/* {block 'booking_form_content'} */
class Block_63080033768e4f291ec1317_73438842 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'booking_form_content' => 
  array (
    0 => 'Block_63080033768e4f291ec1317_73438842',
  ),
  'product_hidden_fields' => 
  array (
    0 => 'Block_134281962868e4f291ec3564_94803480',
  ),
  'booking_form_hotel_location' => 
  array (
    0 => 'Block_11380144068e4f291eecf39_27690655',
  ),
  'booking_form_dates' => 
  array (
    0 => 'Block_2071222768e4f292012555_94794687',
  ),
  'booking_form_quantity_wrapper' => 
  array (
    0 => 'Block_93274109368e4f292050542_79321491',
  ),
  'occupancy_field' => 
  array (
    0 => 'Block_168870899068e4f29206d3c4_20073772',
  ),
  'quantity_field' => 
  array (
    0 => 'Block_57484278968e4f292090017_81382734',
  ),
  'booking_form_price_information' => 
  array (
    0 => 'Block_190071255568e4f2920a4600_01763232',
  ),
  'booking_form_actions' => 
  array (
    0 => 'Block_116649898968e4f2921f1867_59173799',
    1 => 'Block_82808092868e4f292539292_29875682',
  ),
  'booking_form_total_price' => 
  array (
    0 => 'Block_206693511968e4f2921f36f6_21566955',
    1 => 'Block_135942445568e4f29253b472_20313590',
  ),
  'booking_form_available_quantity' => 
  array (
    0 => 'Block_24049129668e4f292226564_05946110',
    1 => 'Block_50606574768e4f292562c40_03306157',
  ),
  'booking_form_book_now_button' => 
  array (
    0 => 'Block_129821441368e4f2922c5711_85503380',
    1 => 'Block_14264779768e4f292587891_27946368',
  ),
  'booking_form_associated_hotels' => 
  array (
    0 => 'Block_182406139068e4f292304102_42327415',
  ),
  'booking_form_product_option' => 
  array (
    0 => 'Block_36341371368e4f292368c79_05240944',
  ),
  'booking_form_service_product_quantity' => 
  array (
    0 => 'Block_189267835968e4f2923cd848_66677035',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <form id="booking-form" action="" method="post">
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_134281962868e4f291ec3564_94803480', 'product_hidden_fields', $this->tplIndex);
?>

                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11380144068e4f291eecf39_27690655', 'booking_form_hotel_location', $this->tplIndex);
?>

                <?php if ($_smarty_tpl->tpl_vars['product']->value->show_price && !(isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)) && !$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
                                        <?php if ($_smarty_tpl->tpl_vars['product']->value->booking_product) {?>
                        <?php if (!$_smarty_tpl->tpl_vars['order_date_restrict']->value) {?>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayRoomTypeBookingFormFieldsBefore','id_product'=>$_smarty_tpl->tpl_vars['product']->value->id,'id_hotel'=>$_smarty_tpl->tpl_vars['id_hotel']->value),$_smarty_tpl ) );?>

                            <div class="row">
                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2071222768e4f292012555_94794687', 'booking_form_dates', $this->tplIndex);
?>

                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['total_available_rooms']->value > 0) {?>
                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_93274109368e4f292050542_79321491', 'booking_form_quantity_wrapper', $this->tplIndex);
?>

                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_190071255568e4f2920a4600_01763232', 'booking_form_price_information', $this->tplIndex);
?>

                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_116649898968e4f2921f1867_59173799', 'booking_form_actions', $this->tplIndex);
?>

                            <?php } else { ?>
                                <div class="sold_out_alert">
                                    <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All rooms sold out!'),$_smarty_tpl ) );?>
</span>
                                </div>
                            <?php }?>
                        <?php }?>
                    <?php } else { ?>
                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_182406139068e4f292304102_42327415', 'booking_form_associated_hotels', $this->tplIndex);
?>

                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_36341371368e4f292368c79_05240944', 'booking_form_product_option', $this->tplIndex);
?>

                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_189267835968e4f2923cd848_66677035', 'booking_form_service_product_quantity', $this->tplIndex);
?>

                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_82808092868e4f292539292_29875682', 'booking_form_actions', $this->tplIndex);
?>

                    <?php }?>
                <?php }?>
                            </form>
        <?php
}
}
/* {/block 'booking_form_content'} */
}
