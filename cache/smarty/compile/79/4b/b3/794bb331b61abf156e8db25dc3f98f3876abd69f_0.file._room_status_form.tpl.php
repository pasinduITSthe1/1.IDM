<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:31
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_room_status_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2934d3259_47961500',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '794bb331b61abf156e8db25dc3f98f3876abd69f' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_room_status_form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2934d3259_47961500 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal-body">
    <form action="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&amp;vieworder&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);?>
&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
" method="post" class="room_status_info_form">
        <div class="form-group">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status'),$_smarty_tpl ) );?>
</label>
            <select name="booking_order_status" class="form-control booking_order_status margin-bottom-5">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hotel_order_status']->value, 'state');
$_smarty_tpl->tpl_vars['state']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->do_else = false;
?>
                    <option value="<?php echo intval($_smarty_tpl->tpl_vars['state']->value['id_status']);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['state']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
        </div>
        <div class="form-group" style="display:none;">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Date'),$_smarty_tpl ) );?>
</label>
            <div class="input-group">
                <input type="text" name="status_date" class="room_status_date wk-input-date" value="" />
                <div class="input-group-addon">
                    <i class="icon-calendar-o"></i>
                </div>
            </div>

            <input type="hidden" id="room_status_id_hotel_booking_detail" name="id_hotel_booking_detail" />
            <input type="hidden" id="room_status_date_from" name="date_from" />
            <input type="hidden" id="room_status_date_to" name="date_to" />
            <input type="hidden" id="room_status_id_room" name="id_room" />
            <input type="hidden" id="room_status_id_order" name="id_order" />
        </div>

        <button class="btn btn-primary" type="submit" name="submitbookingOrderStatus" style="display:none" id="submitbookingOrderStatus"></button>
    </form>

    <?php if ((isset($_smarty_tpl->tpl_vars['loaderImg']->value)) && $_smarty_tpl->tpl_vars['loaderImg']->value) {?>
        <div class="loading_overlay">
            <img src='<?php echo $_smarty_tpl->tpl_vars['loaderImg']->value;?>
' class="loading-img"/>
        </div>
    <?php }?>
</div>
<?php }
}
