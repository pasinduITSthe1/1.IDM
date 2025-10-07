<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:33
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\_select_payment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f295cc83d7_51832504',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e51a706c573d29ea8155a7850ce7930012e9150e' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\_select_payment.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f295cc83d7_51832504 (Smarty_Internal_Template $_smarty_tpl) {
?>
<datalist id="payment_module_name_list">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payment_modules']->value, 'payment_module');
$_smarty_tpl->tpl_vars['payment_module']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['payment_module']->value) {
$_smarty_tpl->tpl_vars['payment_module']->do_else = false;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['payment_module']->value->displayName;?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['payment_module']->value->name;?>
" data-payment-type="<?php echo $_smarty_tpl->tpl_vars['payment_module']->value->payment_type;?>
">
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</datalist>
<?php }
}
