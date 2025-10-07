<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:13
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\modules\cheque\views\templates\hook\payment_return.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2810266e7_16356740',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd9d719cd6d73739e0d6fbaf0063f5117d318cef6' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\modules\\cheque\\views\\templates\\hook\\payment_return.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2810266e7_16356740 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<?php if ($_smarty_tpl->tpl_vars['status']->value == 'ok') {?>
        <p class="alert alert-success"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your','mod'=>'cheque'),$_smarty_tpl ) );?>
 <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['cart_room_bookings']->value) > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'bookings have','mod'=>'cheque'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'booking has','mod'=>'cheque'),$_smarty_tpl ) );
}?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'been created successfully!','mod'=>'cheque'),$_smarty_tpl ) );?>
</p><br /><br />
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your check must include:','mod'=>'cheque'),$_smarty_tpl ) );?>
<br />
		- <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment amount.','mod'=>'cheque'),$_smarty_tpl ) );?>
 <span class="price"><strong><?php echo $_smarty_tpl->tpl_vars['total_to_pay']->value;?>
</strong></span>
		<br />- <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payable to the order of','mod'=>'cheque'),$_smarty_tpl ) );?>
 <strong><?php if ($_smarty_tpl->tpl_vars['chequeName']->value) {
echo $_smarty_tpl->tpl_vars['chequeName']->value;
} else { ?>___________<?php }?></strong>
		<br />- <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mail to','mod'=>'cheque'),$_smarty_tpl ) );?>
 <strong><?php if ($_smarty_tpl->tpl_vars['chequeAddress']->value) {
echo $_smarty_tpl->tpl_vars['chequeAddress']->value;
} else { ?>___________<?php }?></strong>
		<?php if (!(isset($_smarty_tpl->tpl_vars['reference']->value)) && (isset($_smarty_tpl->tpl_vars['id_order']->value)) && $_smarty_tpl->tpl_vars['id_order']->value) {?>
			<br /><br />- <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Do not forget to insert your order number #%d.','sprintf'=>$_smarty_tpl->tpl_vars['id_order']->value,'mod'=>'cheque'),$_smarty_tpl ) );?>

		<?php } else { ?>
			<br /><br />- <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Do not forget to insert your order reference %s.','sprintf'=>$_smarty_tpl->tpl_vars['reference']->value,'mod'=>'cheque'),$_smarty_tpl ) );?>

		<?php }?>
		<br />
		<br />
<?php } else { ?>
	<p class="alert alert-warning">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'We noticed a problem with your order. If you think this is an error, feel free to contact our','mod'=>'cheque'),$_smarty_tpl ) );?>

		<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('contact',true), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'customer service department.','mod'=>'cheque'),$_smarty_tpl ) );?>
</a>.
	</p>
<?php }
}
}
