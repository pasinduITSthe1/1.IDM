<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:32
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\_filter_hotel_rooms.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2945d9ba7_15636236',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b38f57bbad45075582c8ac4276abca80122de56' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\_filter_hotel_rooms.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2945d9ba7_15636236 (Smarty_Internal_Template $_smarty_tpl) {
if (is_array($_smarty_tpl->tpl_vars['hotel_rooms_info']->value) && count($_smarty_tpl->tpl_vars['hotel_rooms_info']->value)) {?>
    <option value="" selected="selected">-</option>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hotel_rooms_info']->value, 'hotel_room');
$_smarty_tpl->tpl_vars['hotel_room']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['hotel_room']->value) {
$_smarty_tpl->tpl_vars['hotel_room']->do_else = false;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['hotel_room']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['hotel_room']->value['room_num'];?>
, <?php echo $_smarty_tpl->tpl_vars['hotel_room']->value['room_type_name'];?>
, <?php echo $_smarty_tpl->tpl_vars['hotel_room']->value['hotel_name'];?>
</option>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
}
