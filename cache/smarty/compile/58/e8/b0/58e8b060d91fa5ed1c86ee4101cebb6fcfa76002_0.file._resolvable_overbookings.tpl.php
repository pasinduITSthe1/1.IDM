<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:33
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\_resolvable_overbookings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f295a74c22_47971643',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '58e8b060d91fa5ed1c86ee4101cebb6fcfa76002' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\_resolvable_overbookings.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f295a74c22_47971643 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<?php if ((isset($_smarty_tpl->tpl_vars['resolvableOverBookings']->value)) && $_smarty_tpl->tpl_vars['resolvableOverBookings']->value) {?>
    <div class="panel">
        <div class="panel-heading">
            <i class="icon-refresh"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Resolvable Overbookings'),$_smarty_tpl ) );?>

        </div>
        <div class="panel-content">
            <?php if ((isset($_GET['resolvable_overbooked_orders'])) && $_GET['resolvable_overbooked_orders']) {?>
                <div class="alert alert-warning">
                    <b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Orders with resolvable overbookings are filtered.'),$_smarty_tpl ) );?>
  <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'), ENT_QUOTES, 'UTF-8', true);?>
" class="btn btn-warning"><i class="icon-refresh"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'See all orders'),$_smarty_tpl ) );?>
</a></b>
                </div>
            <?php }?>
            <div class="alert alert-info">
                <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Some overbookings are now available to be resolved. You can directly resolve overbookings from below list as per your choice.'),$_smarty_tpl ) );?>
</p>
                <?php if (!(isset($_GET['resolvable_overbooked_orders'])) || !$_GET['resolvable_overbooked_orders']) {?>
                    <br>
                    <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You can also filter orders which overbookings are now available to be resolved.'),$_smarty_tpl ) );?>
  <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'), ENT_QUOTES, 'UTF-8', true);?>
&amp;resolvable_overbooked_orders=1" class="btn btn-default"><i class="icon-search"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Filter orders with resolvable overbookings'),$_smarty_tpl ) );?>
</a></p>
                <?php }?>
            </div>
            <div class="table-responsive form-group">
                <table class="table table-striped">
                    <tr>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room No.'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room type'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hotel'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duration'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Resolve'),$_smarty_tpl ) );?>
</th>
                    </tr>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['resolvableOverBookings']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
                        <?php if (!$_smarty_tpl->tpl_vars['data']->value['is_refunded']) {?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['data']->value['room_num'];?>
</td>
                                <td>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminProducts');?>
&amp;id_product=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
&amp;updateproduct"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['room_type_name'], ENT_QUOTES, 'UTF-8', true);?>
</a>
                                </td>
                                <td>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminAddHotel');?>
&amp;id=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['id_hotel'], ENT_QUOTES, 'UTF-8', true);?>
&amp;updatehtl_branch_info" target="_blank"><span><?php echo $_smarty_tpl->tpl_vars['data']->value['hotel_name'];?>
</span></a>
                                </td>
                                <?php $_smarty_tpl->_assignInScope('is_full_date', ($_smarty_tpl->tpl_vars['show_full_date']->value && (smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['date_from'],'%D') == smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['date_to'],'%D'))));?>
                                <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['date_from'], ENT_QUOTES, 'UTF-8', true),'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To'),$_smarty_tpl ) );?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['date_to'], ENT_QUOTES, 'UTF-8', true),'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>
</td>
                                <td>
                                    <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'), ENT_QUOTES, 'UTF-8', true);?>
&amp;vieworder&amp;id_order=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['id_order'], ENT_QUOTES, 'UTF-8', true);?>
">#<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['id_order'], ENT_QUOTES, 'UTF-8', true);?>
</a>
                                </td>
                                <td>
                                    <?php if ((isset($_smarty_tpl->tpl_vars['data']->value['booked_room_info'])) && $_smarty_tpl->tpl_vars['data']->value['booked_room_info']) {?>
                                        <span class="badge badge-information"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Already booked'),$_smarty_tpl ) );?>
</span>
                                    <?php } else { ?>
                                        <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'), ENT_QUOTES, 'UTF-8', true);?>
&amp;resolve_overbooking=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
" class="btn btn-default resolve_overbooking" id_htl_booking="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
"><i class="icon-refresh"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Resolve'),$_smarty_tpl ) );?>
</a>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php }?>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </table>
            </div>
        </div>
    </div>

<?php }
}
}
