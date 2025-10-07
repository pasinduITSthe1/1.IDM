<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:12
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\modules\cheque\views\templates\hook\payment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f280db19a8_81347734',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0bb81ced599e624ce7daad8326544a763b46ffc0' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\modules\\cheque\\views\\templates\\hook\\payment.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f280db19a8_81347734 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row">
	<div class="col-xs-12">
        <p class="payment_module">
            <a class="cheque" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getModuleLink('cheque','payment',array(),true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Pay by check.','mod'=>'cheque'),$_smarty_tpl ) );?>
">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Pay by check','mod'=>'cheque'),$_smarty_tpl ) );?>
 <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(order processing will be longer)','mod'=>'cheque'),$_smarty_tpl ) );?>
</span>
            </a>
        </p>
    </div>
</div>
<?php }
}
