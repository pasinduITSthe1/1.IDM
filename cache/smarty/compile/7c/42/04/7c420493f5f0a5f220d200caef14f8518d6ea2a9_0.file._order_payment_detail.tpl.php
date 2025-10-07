<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:30
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_order_payment_detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f292df3132_79961718',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7c420493f5f0a5f220d200caef14f8518d6ea2a9' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_order_payment_detail.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f292df3132_79961718 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal-body">
    <div class="form-group row">
        <div class="col-sm-6">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment Date'),$_smarty_tpl ) );?>
</label>
            <b><div id="payment_date"></div></b>
        </div>
        <div class="col-sm-6">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment Method'),$_smarty_tpl ) );?>
</label>
            <b><div id="payment_method"></div></b>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment Source'),$_smarty_tpl ) );?>
</label>
            <b><div id="payment_source"></div></b>
        </div>
        <div class="col-sm-6">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Transaction Id'),$_smarty_tpl ) );?>
</label>
            <b><div id="transaction_id"></div></b>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Amount'),$_smarty_tpl ) );?>
</label>
            <b><div id="amount"></div></b>
        </div>
        <div class="col-sm-6">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invoice'),$_smarty_tpl ) );?>
</label>
            <b><div id="invoice_number"></div></b>
        </div>
    </div>
    
    <?php if ((isset($_smarty_tpl->tpl_vars['loaderImg']->value)) && $_smarty_tpl->tpl_vars['loaderImg']->value) {?>
        <div class="loading_overlay">
            <img src='<?php echo $_smarty_tpl->tpl_vars['loaderImg']->value;?>
' class="loading-img"/>
        </div>
    <?php }?>
</div>
<?php }
}
