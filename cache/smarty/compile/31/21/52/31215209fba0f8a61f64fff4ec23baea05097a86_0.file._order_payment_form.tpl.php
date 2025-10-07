<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:31
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_order_payment_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2930641a8_40434661',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31215209fba0f8a61f64fff4ec23baea05097a86' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_order_payment_form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2930641a8_40434661 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal-body">
    <form id="form_add_payment" method="post" action="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&amp;vieworder&amp;id_order=<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);?>
">
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Date'),$_smarty_tpl ) );?>
</label>
                <div class="input-group">
                    <input type="text" name="payment_date" class="datepicker" value="<?php echo date('Y-m-d');?>
" />
                    <div class="input-group-addon">
                        <i class="icon-calendar-o"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment method'),$_smarty_tpl ) );?>
</label>
                <div>
                    <input name="payment_method" list="payment_method" class="form-control payment_method">
                    <datalist id="payment_method">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payment_methods']->value, 'payment_method');
$_smarty_tpl->tpl_vars['payment_method']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['payment_method']->value) {
$_smarty_tpl->tpl_vars['payment_method']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['payment_method']->value;?>
">
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </datalist>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment source'),$_smarty_tpl ) );?>
</label>
                <select name="payment_type" class="payment_type form-control">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payment_types']->value, 'payment_type');
$_smarty_tpl->tpl_vars['payment_type']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['payment_type']->value) {
$_smarty_tpl->tpl_vars['payment_type']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['payment_type']->value['value'];?>
"><?php echo $_smarty_tpl->tpl_vars['payment_type']->value['name'];?>
</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
            <div class="col-sm-6">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Transaction ID'),$_smarty_tpl ) );?>
</label>
                <input type="text" name="payment_transaction_id" value="" class="form-control"/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Amount'),$_smarty_tpl ) );?>
</label>
                <input type="text" name="payment_amount" value="" class="form-control" />
            </div>
            <div class="col-sm-6">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Currency'),$_smarty_tpl ) );?>
</label>
                <select name="payment_currency" class="payment_currency form-control pull-left">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currencies']->value, 'current_currency');
$_smarty_tpl->tpl_vars['current_currency']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['current_currency']->value) {
$_smarty_tpl->tpl_vars['current_currency']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['current_currency']->value['id_currency'];?>
"<?php if ($_smarty_tpl->tpl_vars['current_currency']->value['id_currency'] == $_smarty_tpl->tpl_vars['currency']->value->id) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['current_currency']->value['sign'];?>
</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
        </div>
        <?php if (count($_smarty_tpl->tpl_vars['invoices_collection']->value) > 0) {?>
            <div class="form-group row" style="display: none;">
                <div class="col-sm-6">
                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invoice'),$_smarty_tpl ) );?>
</label>
                    <select name="payment_invoice" id="payment_invoice">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['invoices_collection']->value, 'invoice');
$_smarty_tpl->tpl_vars['invoice']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['invoice']->value) {
$_smarty_tpl->tpl_vars['invoice']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['invoice']->value->id;?>
" selected="selected"><?php echo $_smarty_tpl->tpl_vars['invoice']->value->getInvoiceNumberFormatted($_smarty_tpl->tpl_vars['current_id_lang']->value,$_smarty_tpl->tpl_vars['order']->value->id_shop);?>
</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
            </div>
        <?php }?>
        <button style="display:none" class="btn btn-primary pull-right" type="submit" name="submitAddPayment" id="submitAddPayment">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add payment'),$_smarty_tpl ) );?>

        </button>
    </form>

    <?php if ((isset($_smarty_tpl->tpl_vars['loaderImg']->value)) && $_smarty_tpl->tpl_vars['loaderImg']->value) {?>
        <div class="loading_overlay">
            <img src='<?php echo $_smarty_tpl->tpl_vars['loaderImg']->value;?>
' class="loading-img"/>
        </div>
    <?php }?>
</div>
<?php }
}
