<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:42
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\slip\modal_confirm_update.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29edc9f67_58450193',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '752f6ad5828c6d3b35e0433cd91687e620886874' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\slip\\modal_confirm_update.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29edc9f67_58450193 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove-sign"></i></button>
    <h4 class="modal-title"><i class="icon icon-exclamation-triangle"></i>&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Confirm Update'),$_smarty_tpl ) );?>
</h4>
    <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This action is irreversable, Are you sure you want to change the status?'),$_smarty_tpl ) );?>
</p>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-6">
            <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Credit Slip'),$_smarty_tpl ) );?>
</label>
            <p class="control-value">
                <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminCartRules');?>
&updatecart_rule&id_cart_rule=<?php echo $_smarty_tpl->tpl_vars['orderSlip']->value->id;?>
" target="_blank">#<?php echo $_smarty_tpl->tpl_vars['orderSlip']->value->id;?>
</a>
            </p>
        </div>
        <div class="col-sm-6">
            <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Amount'),$_smarty_tpl ) );?>
</label>
            <p class="control-value"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['orderSlip']->value->amount,'currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency),$_smarty_tpl ) );?>
</p>
        </div>
        <div class="col-sm-6">
            <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customer'),$_smarty_tpl ) );?>
</label>
            <p class="control-value">
                <?php echo $_smarty_tpl->tpl_vars['customer']->value->firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value->lastname;?>
 (<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminCustomers');?>
&viewcustomer&id_customer=<?php echo $_smarty_tpl->tpl_vars['customer']->value->id;?>
" target="_blank">#<?php echo $_smarty_tpl->tpl_vars['customer']->value->id;?>
</a>)
            </p>
        </div>
        <div class="col-sm-6">
            <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order'),$_smarty_tpl ) );?>
</label>
            <p class="control-value">
                <?php echo $_smarty_tpl->tpl_vars['order']->value->reference;?>
 (<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrders');?>
&vieworder&id_order=<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
" target="_blank">#<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
</a>)
            </p>
        </div>
    </div>
</div><?php }
}
