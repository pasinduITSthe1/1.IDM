<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:09
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\cart_rules\modal_confirm_delete.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27d04c706_10594867',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ca99d3fad1922a01a628d61094827fd129029d7' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\cart_rules\\modal_confirm_delete.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27d04c706_10594867 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><i class="icon-remove-sign"></i></button>
    <h4 class="modal-title"><i class="icon icon-exclamation-triangle"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Confirm Delete'),$_smarty_tpl ) );?>
</h4>
    <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Are you sure, you want to delete this cart rule?'),$_smarty_tpl ) );?>
</p>
</div>
<?php if ((isset($_smarty_tpl->tpl_vars['cartRule']->value))) {?>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-4">
                <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Voucher'),$_smarty_tpl ) );?>
</label>
                <p class="control-value">
                    <?php echo $_smarty_tpl->tpl_vars['cartRule']->value->code;?>
 (<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminCartRules');?>
&updatecart_rule&id_cart_rule=<?php echo $_smarty_tpl->tpl_vars['cartRule']->value->id;?>
" target="_blank">#<?php echo $_smarty_tpl->tpl_vars['cartRule']->value->id;?>
</a>)
                </p>
            </div>
            <div class="col-sm-4">
                <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reason'),$_smarty_tpl ) );?>
</label>
                <p class="control-value">
                    <?php if ($_smarty_tpl->tpl_vars['generatedBy']->value == CartRule::GENERATED_BY_REFUND) {?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Generated against refund'),$_smarty_tpl ) );?>

                        (<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminOrderRefundRequests');?>
&vieworder_return&id_order_return=<?php echo $_smarty_tpl->tpl_vars['generatedById']->value;?>
" target="_blank">#<?php echo $_smarty_tpl->tpl_vars['generatedById']->value;?>
</a>)
                    <?php } elseif ($_smarty_tpl->tpl_vars['generatedBy']->value == CartRule::GENERATED_BY_ORDER_SLIP) {?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Generated against credit slip'),$_smarty_tpl ) );?>

                        (<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminPdf');?>
&submitAction=generateOrderSlipPDF&id_order_slip=<?php echo $_smarty_tpl->tpl_vars['generatedById']->value;?>
" target="_blank">#<?php echo $_smarty_tpl->tpl_vars['generatedById']->value;?>
</a>)
                    <?php }?>
                </p>
            </div>
            <div class="col-sm-4">
                <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Amount'),$_smarty_tpl ) );?>
</label>
                <p class="control-value"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['cartRule']->value->reduction_amount,'currency'=>$_smarty_tpl->tpl_vars['cartRule']->value->reduction_currency),$_smarty_tpl ) );?>
</p>
            </div>
            <div class="col-sm-4">
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
            <div class="col-sm-4">
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
            <?php if (!$_smarty_tpl->tpl_vars['cartRule']->value->quantity) {?>
                <div class="col-sm-4">
                    <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status'),$_smarty_tpl ) );?>
</label>
                    <p class="control-value">
                        <span class="badge badge-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Used'),$_smarty_tpl ) );?>
</span>
                    </p>
                </div>
            <?php }?>
        </div>
    </div>
<?php }
}
}
