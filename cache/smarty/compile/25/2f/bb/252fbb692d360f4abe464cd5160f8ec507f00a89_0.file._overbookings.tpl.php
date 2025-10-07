<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:33
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\_overbookings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2951ceb93_67516348',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '252fbb692d360f4abe464cd5160f8ec507f00a89' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\_overbookings.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2951ceb93_67516348 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

<?php if ((isset($_smarty_tpl->tpl_vars['orderOverBookings']->value)) && $_smarty_tpl->tpl_vars['orderOverBookings']->value) {?>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <i class="icon-warning"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Overbookings found in this order !!'),$_smarty_tpl ) );?>

        </div>
        <div class="panel-content">
            <div class="table-responsive form-group">
                <table class="table table-striped">
                    <tr>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room No.'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room type.'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duration'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Occupancy'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Confirmed booking order'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reallocate/Swap'),$_smarty_tpl ) );?>
</th>
                        <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Resolve'),$_smarty_tpl ) );?>
</th>
                    </tr>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['orderOverBookings']->value, 'data');
$_smarty_tpl->tpl_vars['data']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->do_else = false;
?>
                        <?php if (!$_smarty_tpl->tpl_vars['data']->value['is_refunded']) {?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['data']->value['room_num'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['data']->value['room_type_name'];?>
</td>
                                <?php $_smarty_tpl->_assignInScope('is_full_date', ($_smarty_tpl->tpl_vars['show_full_date']->value && (smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['date_from'],'%D') == smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['date_to'],'%D'))));?>
                                <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['data']->value['date_from'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To'),$_smarty_tpl ) );?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['data']->value['date_to'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>
</td>
                                <td>
                                    <?php if ($_smarty_tpl->tpl_vars['order']->value->with_occupancy && $_smarty_tpl->tpl_vars['data']->value['children']) {?>
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
$_prefixVariable18 = ob_get_clean();
if ($_prefixVariable18) {?>, <?php echo $_smarty_tpl->tpl_vars['data']->value['children'];?>
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
$__foreach_childAge_245_saved = $_smarty_tpl->tpl_vars['childAge'];
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
$_smarty_tpl->tpl_vars['childAge'] = $__foreach_childAge_245_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                                <?php }?>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <span><?php if ($_smarty_tpl->tpl_vars['data']->value['adults']) {
echo $_smarty_tpl->tpl_vars['data']->value['adults'];
}?> <?php if ($_smarty_tpl->tpl_vars['data']->value['adults'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adult'),$_smarty_tpl ) );
}
ob_start();
echo $_smarty_tpl->tpl_vars['data']->value['children'];
$_prefixVariable19 = ob_get_clean();
if ($_prefixVariable19) {?>, <?php echo $_smarty_tpl->tpl_vars['data']->value['children'];?>
 <?php if ($_smarty_tpl->tpl_vars['data']->value['children'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );
}
}?></span>
                                    <?php }?>
                                </td>
                                <td>
                                    <?php if ((isset($_smarty_tpl->tpl_vars['data']->value['booked_room_info']['id_order'])) && $_smarty_tpl->tpl_vars['data']->value['booked_room_info']['id_order']) {?>
                                        <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'), ENT_QUOTES, 'UTF-8', true);?>
&amp;vieworder&amp;id_order=<?php echo $_smarty_tpl->tpl_vars['data']->value['booked_room_info']['id_order'];?>
">#<?php echo $_smarty_tpl->tpl_vars['data']->value['booked_room_info']['id_order'];?>
</a>
                                    <?php } else { ?>
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'N/A'),$_smarty_tpl ) );?>

                                    <?php }?>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-default reallocate_overbooking" id_htl_booking="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><i class="icon-refresh"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reallocate/Swap Room'),$_smarty_tpl ) );?>
</a>
                                </td>
                                <td>
                                    <?php if ((isset($_smarty_tpl->tpl_vars['data']->value['booked_room_info'])) && $_smarty_tpl->tpl_vars['data']->value['booked_room_info']) {?>
                                        <span class="badge badge-information"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Already booked'),$_smarty_tpl ) );?>
</span>
                                    <?php } else { ?>
                                        <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders'), ENT_QUOTES, 'UTF-8', true);?>
&amp;vieworder&amp;id_order=<?php echo $_smarty_tpl->tpl_vars['data']->value['id_order'];?>
&amp;resolve_overbooking=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" class="btn btn-default resolve_overbooking" id_htl_booking="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
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

            <div class="help-block">
                <p>- <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You can resolve room overbooking with \'Resolve\' column only when the overbooked room is now free for booked duration.'),$_smarty_tpl ) );?>
</p>
                <p>- <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You can also reallocate an overbooked room with an available room to resolve room\'s overbooking.'),$_smarty_tpl ) );?>
</p>
            </div>
        </div>
    </div>
<?php }
}
}
