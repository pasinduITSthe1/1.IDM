<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:42
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\slip\_display_voucher_link.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29ee56fd0_93131606',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6d97960f4e8f2f2df473c7550a63ae2affba79cd' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\slip\\_display_voucher_link.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29ee56fd0_93131606 (Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php if ($_smarty_tpl->tpl_vars['id_cart_rule']->value) {?>
    <a class="btn btn-link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminCartRules'), ENT_QUOTES, 'UTF-8', true);?>
&updatecart_rule&id_cart_rule=<?php echo $_smarty_tpl->tpl_vars['id_cart_rule']->value;?>
" target="_blank">
        #<?php echo $_smarty_tpl->tpl_vars['id_cart_rule']->value;?>

    </a>
<?php } else { ?>
    <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminSlip'), ENT_QUOTES, 'UTF-8', true);?>
&generateVoucher=1&id_order_slip=<?php echo $_smarty_tpl->tpl_vars['row']->value['id_order_slip'];?>
" class="btn btn-default" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Generate voucher for credit slip'),$_smarty_tpl ) );?>
">
        <i class="icon-refresh"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Generate Voucher'),$_smarty_tpl ) );?>

    </a>
<?php }
}
}
