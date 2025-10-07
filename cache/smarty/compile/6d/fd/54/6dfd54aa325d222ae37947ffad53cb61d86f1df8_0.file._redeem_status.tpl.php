<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:43
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\slip\_redeem_status.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29f0276a9_72727802',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6dfd54aa325d222ae37947ffad53cb61d86f1df8' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\slip\\_redeem_status.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29f0276a9_72727802 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['redeem_status']->value == OrderSlip::REDEEM_STATUS_REDEEMED) {?>
    <span class="badge badge-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Redeemed'),$_smarty_tpl ) );?>
</span>
<?php } else { ?>
    <span class="badge badge-success"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Active'),$_smarty_tpl ) );?>
</span>
<?php }
}
}
