<?php
/* Smarty version 4.5.5, created on 2025-10-07 16:33:16
  from 'C:\wamp64\www\1.IDM\modules\wkroomsearchblock\views\templates\hook\searchForm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f374958bd5_66826312',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5ac027a7374c4bf4bc36f0f9c62c0a97d4c50172' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\wkroomsearchblock\\views\\templates\\hook\\searchForm.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f374958bd5_66826312 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<form method="POST" id="search_hotel_block_form">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displaySearchFormFieldsBefore'),$_smarty_tpl ) );?>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_59125722168e4f374796a24_98618731', "search_form_fields_wrapper");
?>

</form>
<?php }
/* {block 'search_form_location'} */
class Block_186740318868e4f374799441_09292116 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <?php if ((isset($_smarty_tpl->tpl_vars['location_enabled']->value)) && $_smarty_tpl->tpl_vars['location_enabled']->value) {?>
                    <div class="form-group grid-item area-4" style="grid-column: span 4;">
                        <div class="dropdown">
                            <input type="text" class="form-control header-rmsearch-input input-location" id="hotel_location" name="hotel_location" autocomplete="off" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hotel Location','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
" <?php if ((isset($_smarty_tpl->tpl_vars['search_data']->value['location']))) {?>value="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['search_data']->value['location'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>>
                            <input hidden="hidden" name="location_category_id" id="location_category_id" <?php if ((isset($_smarty_tpl->tpl_vars['search_data']->value['location_category_id']))) {?>value="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['search_data']->value['location_category_id'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>>
                            <ul class="location_search_results_ul dropdown-menu"></ul>
                        </div>
                    </div>
                <?php }?>
            <?php
}
}
/* {/block 'search_form_location'} */
/* {block 'search_form_hotel'} */
class Block_59615436868e4f3747b7563_38105390 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <?php if (count($_smarty_tpl->tpl_vars['hotels_info']->value) <= 1 && !$_smarty_tpl->tpl_vars['show_hotel_name']->value) {?>
                    <input type="hidden" id="max_order_date" name="max_order_date" value="<?php if ((isset($_smarty_tpl->tpl_vars['hotels_info']->value[0]['max_order_date']))) {
echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['hotels_info']->value[0]['max_order_date'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);
}?>">
                    <input type="hidden" id="min_booking_offset" name="min_booking_offset" value="<?php if ((isset($_smarty_tpl->tpl_vars['hotels_info']->value[0]['min_booking_offset']))) {
echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['hotels_info']->value[0]['min_booking_offset'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);
}?>">
                    <input type="hidden" id="hotel_cat_id" name="hotel_cat_id" value="<?php echo $_smarty_tpl->tpl_vars['hotels_info']->value[0]['id_category'];?>
">
                    <input type="hidden" id="id_hotel" name="id_hotel" value="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['hotels_info']->value[0]['id'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
">
                    <input type="hidden" id="htl_name" class="form-control header-rmsearch-input" value="<?php echo $_smarty_tpl->tpl_vars['hotels_info']->value[0]['hotel_name'];?>
" readonly>
                <?php } else { ?>
                    <div class="form-group grid-item area-5" style="grid-column: span 5;">
                        <input type="hidden" id="hotel_cat_id" name="hotel_cat_id" <?php if ((isset($_smarty_tpl->tpl_vars['search_data']->value))) {?>value="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['search_data']->value['htl_dtl']['id_category'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>>
                        <input type="hidden" id="id_hotel" name="id_hotel" <?php if ((isset($_smarty_tpl->tpl_vars['search_data']->value))) {?>value="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['search_data']->value['htl_dtl']['id'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>>
                        <input type="hidden" id="max_order_date" name="max_order_date" value="<?php if ((isset($_smarty_tpl->tpl_vars['max_order_date']->value))) {
echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['max_order_date']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);
}?>">
                        <input type="hidden" id="min_booking_offset" name="min_booking_offset" value="<?php if ((isset($_smarty_tpl->tpl_vars['min_booking_offset']->value))) {
echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['min_booking_offset']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);
}?>">

                        <div class="hotel-selector-wrap <?php if ((isset($_smarty_tpl->tpl_vars['language_is_rtl']->value)) && $_smarty_tpl->tpl_vars['language_is_rtl']->value) {?>rtl<?php }?>">
                            <select name="id_hotel" class="chosen header-rmsearch-input" data-placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select Hotel','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
" id="id_hotel_button">
                                <option value=""></option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hotels_info']->value, 'name_val');
$_smarty_tpl->tpl_vars['name_val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['name_val']->value) {
$_smarty_tpl->tpl_vars['name_val']->do_else = false;
?>
                                    <option class="search_result_li" value="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['name_val']->value['id'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" data-id-hotel="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['name_val']->value['id'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" data-hotel-cat-id="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['name_val']->value['id_category'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" data-max_order_date="<?php echo $_smarty_tpl->tpl_vars['name_val']->value['max_order_date'];?>
" data-min_booking_offset="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['name_val']->value['min_booking_offset'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" <?php if ((isset($_smarty_tpl->tpl_vars['search_data']->value)) && $_smarty_tpl->tpl_vars['name_val']->value['id'] == $_smarty_tpl->tpl_vars['search_data']->value['htl_dtl']['id']) {?>selected<?php }?>><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['name_val']->value['hotel_name'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>
                <?php }?>
            <?php
}
}
/* {/block 'search_form_hotel'} */
/* {block 'search_form_dates'} */
class Block_197894738868e4f374831bd6_54146931 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <?php if ((isset($_smarty_tpl->tpl_vars['multiple_dates_input']->value)) && $_smarty_tpl->tpl_vars['multiple_dates_input']->value) {?>
                    <div class="grid-item area-5 multi-date" id="daterange_value" style="grid-column: span 5;">
                        <div class="form-group">
                            <input type="hidden" id="check_in_time" name="check_in_time" <?php if ((isset($_smarty_tpl->tpl_vars['search_data']->value['date_from']))) {?>value="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['search_data']->value['date_from'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>>
                            <div class="form-control header-rmsearch-input input-date" autocomplete="off" id="daterange_value_from" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-in','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-in','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</span></div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="check_out_time" name="check_out_time" <?php if ((isset($_smarty_tpl->tpl_vars['search_data']->value['date_to']))) {?>value="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['search_data']->value['date_to'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>>
                            <div class="form-control header-rmsearch-input input-date" autocomplete="off" id="daterange_value_to" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-out','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-out','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</span></div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="form-group grid-item area-5" style="grid-column: span 5;">
                        <input type="hidden" id="check_in_time" name="check_in_time" <?php if ((isset($_smarty_tpl->tpl_vars['search_data']->value['date_from']))) {?>value="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['search_data']->value['date_from'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>>
                        <input type="hidden" id="check_out_time" name="check_out_time" <?php if ((isset($_smarty_tpl->tpl_vars['search_data']->value['date_to']))) {?>value="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['search_data']->value['date_to'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>>
                        <div class="form-control header-rmsearch-input input-date" id="daterange_value"  autocomplete="off" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-in - Check-out','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
" tabindex="-1"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-in','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
 &nbsp;<i class="icon icon-minus"></i>&nbsp; <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check-out','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</span></div>
                    </div>
                <?php }?>
            <?php
}
}
/* {/block 'search_form_dates'} */
/* {block 'search_form_occupancy'} */
class Block_39145328568e4f374878c25_26045067 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

                <?php if ((isset($_smarty_tpl->tpl_vars['is_occupancy_wise_search']->value)) && $_smarty_tpl->tpl_vars['is_occupancy_wise_search']->value) {?>
                    <div class="form-group grid-item area-4" style="grid-column: span 4;">
                        <div class="dropdown">
                            <button class="form-control input-occupancy header-rmsearch-input <?php if ((isset($_smarty_tpl->tpl_vars['error']->value)) && $_smarty_tpl->tpl_vars['error']->value == 1) {?>error_border<?php }?>" type="button" data-toggle="dropdown" id="guest_occupancy">
                                <span class="pull-left"><?php if (((isset($_smarty_tpl->tpl_vars['search_data']->value['occupancy_adults'])) && $_smarty_tpl->tpl_vars['search_data']->value['occupancy_adults'])) {
echo $_smarty_tpl->tpl_vars['search_data']->value['occupancy_adults'];?>
 <?php if ($_smarty_tpl->tpl_vars['search_data']->value['occupancy_adults'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adult','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );
}?>, <?php if ((isset($_smarty_tpl->tpl_vars['search_data']->value['occupancy_children'])) && $_smarty_tpl->tpl_vars['search_data']->value['occupancy_children']) {
echo $_smarty_tpl->tpl_vars['search_data']->value['occupancy_children'];?>
 <?php if ($_smarty_tpl->tpl_vars['search_data']->value['occupancy_children'] > 1) {?>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );
}?>, <?php }
echo smarty_modifier_count($_smarty_tpl->tpl_vars['search_data']->value['occupancies']);?>
 <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['search_data']->value['occupancies']) > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rooms','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );
}
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 Adult, 1 Room','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );
}?></span>
                            </button>
                            <div id="search_occupancy_wrapper" class="dropdown-menu">
                                <div id="occupancy_inner_wrapper">
                                    <?php if ((isset($_smarty_tpl->tpl_vars['search_data']->value['occupancies'])) && $_smarty_tpl->tpl_vars['search_data']->value['occupancies']) {?>
                                        <?php $_smarty_tpl->_assignInScope('countRoom', 1);?>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['search_data']->value['occupancies'], 'occupancy', false, 'key', 'occupancyInfo', array (
  'first' => true,
  'index' => true,
));
$_smarty_tpl->tpl_vars['occupancy']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['occupancy']->value) {
$_smarty_tpl->tpl_vars['occupancy']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_occupancyInfo']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_occupancyInfo']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_occupancyInfo']->value['index'];
?>
                                            <div class="occupancy-room-block">
                                                <div class="occupancy_info_head"><span class="room_num_wrapper"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
 - <?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['countRoom']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 </span><?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_occupancyInfo']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_occupancyInfo']->value['first'] : null)) {?><a class="remove-room-link pull-right" href="#"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</a><?php }?></div>
                                                <div class="occupancy_info_block" occ_block_index="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['key']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
">
                                                    <div class="row">
                                                        <div class="form-group occupancy_count_block col-sm-5 col-xs-6">
                                                            <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</label>
                                                            <div>
                                                                <input type="hidden" class="num_occupancy num_adults room_occupancies" name="occupancy[<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['key']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
][adults]" value="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['occupancy']->value['adults'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
">
                                                                <div class="occupancy_count pull-left">
                                                                    <span><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['occupancy']->value['adults'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</span>
                                                                </div>
                                                                <div class="qty_direction pull-left">
                                                                    <a href="#" data-field-qty="qty" class="btn btn-default occupancy_quantity_up">
                                                                        <span><i class="icon-plus"></i></span>
                                                                    </a>
                                                                    <a href="#" data-field-qty="qty" class="btn btn-default occupancy_quantity_down">
                                                                        <span><i class="icon-minus"></i></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group occupancy_count_block col-sm-7 col-xs-6">
                                                            <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</label>
                                                            <div class="clearfix">
                                                                <input type="hidden" class="num_occupancy num_children room_occupancies" name="occupancy[<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['key']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
][children]" value="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['occupancy']->value['children'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
">
                                                                <div class="occupancy_count pull-left">
                                                                    <span><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['occupancy']->value['children'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</span>
                                                                </div>
                                                                <div class="qty_direction pull-left">
                                                                    <a href="#" data-field-qty="qty" class="btn btn-default occupancy_quantity_up">
                                                                        <span><i class="icon-plus"></i></span>
                                                                    </a>
                                                                    <a href="#" data-field-qty="qty" class="btn btn-default occupancy_quantity_down">
                                                                        <span><i class="icon-minus"></i></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <p class="label-desc-txt">(<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Below','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
  <?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['max_child_age']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'years','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
)</p>
                                                        </div>
                                                    </div>
                                                    <p style="display:none;"><span class="text-danger occupancy-input-errors"></span></p>

                                                    <div class="row">
                                                        <div class="form-group children_age_info_block col-sm-12" <?php if ((isset($_smarty_tpl->tpl_vars['occupancy']->value['child_ages'])) && $_smarty_tpl->tpl_vars['occupancy']->value['child_ages']) {?>style="display:block;"<?php }?>>
                                                            <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All Children','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</label>
                                                            <div class="children_ages">
                                                                <?php if ((isset($_smarty_tpl->tpl_vars['occupancy']->value['child_ages'])) && $_smarty_tpl->tpl_vars['occupancy']->value['child_ages']) {?>
                                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['occupancy']->value['child_ages'], 'childAge');
$_smarty_tpl->tpl_vars['childAge']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['childAge']->value) {
$_smarty_tpl->tpl_vars['childAge']->do_else = false;
?>
                                                                        <div>
                                                                            <select class="guest_child_age room_occupancies" name="occupancy[<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['key']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
][child_ages][]">
                                                                                <option value="-1" <?php if ($_smarty_tpl->tpl_vars['childAge']->value == -1) {?>selected<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select 1','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</option>
                                                                                <option value="0" <?php if ($_smarty_tpl->tpl_vars['childAge']->value == 0) {?>selected<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Under 1','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
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
                                                                        </div>
                                                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="occupancy-info-separator">
                                            </div>
                                            <?php $_smarty_tpl->_assignInScope('countRoom', $_smarty_tpl->tpl_vars['countRoom']->value+1);?>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    <?php } else { ?>
                                        <div class="occupancy-room-block">
                                            <div class="occupancy_info_head"><span class="room_num_wrapper"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room - 1','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</span></div>
                                            <div class="occupancy_info_block" occ_block_index="0">
                                                <div class="row">
                                                    <div class="form-group occupancy_count_block col-sm-5 col-xs-6">
                                                        <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</label>
                                                        <div>
                                                            <input type="hidden" class="num_occupancy num_adults room_occupancies" name="occupancy[0][adults]" value="1">
                                                            <div class="occupancy_count pull-left">
                                                                <span>1</span>
                                                            </div>
                                                            <div class="qty_direction pull-left">
                                                                <a href="#" data-field-qty="qty" class="btn btn-default occupancy_quantity_up">
                                                                    <span>
                                                                        <i class="icon-plus"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="#" data-field-qty="qty" class="btn btn-default occupancy_quantity_down">
                                                                    <span>
                                                                        <i class="icon-minus"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group occupancy_count_block col-sm-7 col-xs-6">
                                                        <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</label>
                                                        <div class="clearfix">
                                                            <input type="hidden" class="num_occupancy num_children room_occupancies" name="occupancy[0][children]" value="0">
                                                            <div class="occupancy_count pull-left">
                                                                <span>0</span>
                                                            </div>
                                                            <div class="qty_direction pull-left">
                                                                <a href="#" data-field-qty="qty" class="btn btn-default occupancy_quantity_up">
                                                                    <span>
                                                                        <i class="icon-plus"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="#" data-field-qty="qty" class="btn btn-default occupancy_quantity_down">
                                                                    <span>
                                                                        <i class="icon-minus"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <p class="label-desc-txt">(<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Below','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
  <?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['max_child_age']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'years','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
)</p>
                                                    </div>
                                                </div>
                                                <p style="display:none;"><span class="text-danger occupancy-input-errors"></span></p>
                                                <div class="row">
                                                    <div class="form-group children_age_info_block col-sm-12">
                                                        <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All Children','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</label>
                                                        <div class="children_ages">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="occupancy-info-separator">
                                        </div>
                                    <?php }?>
                                </div>
                                <div class="occupancy_block_actions">
                                    <span id="add_new_occupancy">
                                        <a class="add_new_occupancy_btn" href="#"><i class="icon-plus"></i> <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add Room','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</span></a>
                                    </span>
                                    <span>
                                        <button class="submit_occupancy_btn btn btn-primary"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Done','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
            <?php
}
}
/* {/block 'search_form_occupancy'} */
/* {block 'search_form_submit'} */
class Block_204483651568e4f374952fd4_72766149 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <div class="form-group grid-item search_room_submit_block area-4" style="grid-column: span 4;">
                    <button type="submit" class="btn btn btn-primary" name="search_room_submit" id="search_room_submit">
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search Rooms','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</span>
                    </button>
                </div>
            <?php
}
}
/* {/block 'search_form_submit'} */
/* {block "search_form_fields_wrapper"} */
class Block_59125722168e4f374796a24_98618731 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'search_form_fields_wrapper' => 
  array (
    0 => 'Block_59125722168e4f374796a24_98618731',
  ),
  'search_form_location' => 
  array (
    0 => 'Block_186740318868e4f374799441_09292116',
  ),
  'search_form_hotel' => 
  array (
    0 => 'Block_59615436868e4f3747b7563_38105390',
  ),
  'search_form_dates' => 
  array (
    0 => 'Block_197894738868e4f374831bd6_54146931',
  ),
  'search_form_occupancy' => 
  array (
    0 => 'Block_39145328568e4f374878c25_26045067',
  ),
  'search_form_submit' => 
  array (
    0 => 'Block_204483651568e4f374952fd4_72766149',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <div class="grid" id="search_form_fields_wrapper" style="grid-template-columns: repeat(<?php echo $_smarty_tpl->tpl_vars['total_columns']->value;?>
, 1fr);">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_186740318868e4f374799441_09292116', 'search_form_location', $this->tplIndex);
?>

            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_59615436868e4f3747b7563_38105390', 'search_form_hotel', $this->tplIndex);
?>


            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_197894738868e4f374831bd6_54146931', 'search_form_dates', $this->tplIndex);
?>


            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_39145328568e4f374878c25_26045067', 'search_form_occupancy', $this->tplIndex);
?>

            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_204483651568e4f374952fd4_72766149', 'search_form_submit', $this->tplIndex);
?>

        </div>
    <?php
}
}
/* {/block "search_form_fields_wrapper"} */
}
