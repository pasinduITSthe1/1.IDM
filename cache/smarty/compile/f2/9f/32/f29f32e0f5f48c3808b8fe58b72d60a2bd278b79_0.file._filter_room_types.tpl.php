<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:32
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\_filter_room_types.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f294708c00_84440537',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f29f32e0f5f48c3808b8fe58b72d60a2bd278b79' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\_filter_room_types.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f294708c00_84440537 (Smarty_Internal_Template $_smarty_tpl) {
if (is_array($_smarty_tpl->tpl_vars['room_types_info']->value) && count($_smarty_tpl->tpl_vars['room_types_info']->value)) {?>
    <option value="" selected="selected">-</option>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['room_types_info']->value, 'room_type');
$_smarty_tpl->tpl_vars['room_type']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['room_type']->value) {
$_smarty_tpl->tpl_vars['room_type']->do_else = false;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['room_type']->value['id_product'];?>
"><?php echo $_smarty_tpl->tpl_vars['room_type']->value['room_type'];?>
, <?php echo $_smarty_tpl->tpl_vars['room_type']->value['hotel_name'];?>
</option>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
}
