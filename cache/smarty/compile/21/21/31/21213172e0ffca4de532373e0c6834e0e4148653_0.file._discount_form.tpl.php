<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:29
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_discount_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2919fa985_52136805',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '21213172e0ffca4de532373e0c6834e0e4148653' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_discount_form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2919fa985_52136805 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal-body">
    <form id="order_discount_form" action="<?php echo $_smarty_tpl->tpl_vars['current_index']->value;?>
&amp;vieworder&amp;token=<?php echo htmlspecialchars((string)$_GET['token'], ENT_QUOTES, 'UTF-8', true);?>
&amp;id_order=<?php echo intval($_smarty_tpl->tpl_vars['order']->value->id);?>
" method="post">
        <div class="form-group">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</label>
            <input class="form-control" type="text" name="discount_name" value="" />
        </div>

        <div class="form-group row">
            <div class="col-sm-6">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Type'),$_smarty_tpl ) );?>
</label>
                <select class="form-control" name="discount_type" id="discount_type">
                    <option value="1"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Percent'),$_smarty_tpl ) );?>
</option>
                    <option value="2"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Amount'),$_smarty_tpl ) );?>
</option>
                </select>
            </div>
            <div class="col-sm-6" id="discount_value_field">
                <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Value'),$_smarty_tpl ) );?>
</label>
                <div>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span id="discount_currency_sign" style="display: none;"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</span>
                            <span id="discount_percent_symbol">%</span>
                        </div>
                        <input class="form-control" type="text" name="discount_value"/>
                    </div>
                    <p class="text-muted" id="discount_value_help" style="display: none;">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This value must include taxes.'),$_smarty_tpl ) );?>

                    </p>
                </div>
            </div>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['order']->value->hasInvoice()) {?>
            <div class="row"  style="display: none;">
                <div class="col-sm-12">
                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invoice'),$_smarty_tpl ) );?>
</label>
                    <select name="discount_invoice">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['invoices_collection']->value, 'invoice');
$_smarty_tpl->tpl_vars['invoice']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['invoice']->value) {
$_smarty_tpl->tpl_vars['invoice']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['invoice']->value->id;?>
" selected="selected">
                            <?php echo $_smarty_tpl->tpl_vars['invoice']->value->getInvoiceNumberFormatted($_smarty_tpl->tpl_vars['current_id_lang']->value);?>
 - <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['invoice']->value->total_paid_tax_incl,'currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency),$_smarty_tpl ) );?>

                        </option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p class="checkbox">
                        <label class="control-label" for="discount_all_invoices">
                            <input type="checkbox" name="discount_all_invoices" id="discount_all_invoices" value="1" />
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Apply on all invoices'),$_smarty_tpl ) );?>

                        </label>
                    </p>
                    <p class="help-block">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If you chooses to create this discount for all invoices, only one discount will be created per order invoice.'),$_smarty_tpl ) );?>

                    </p>
                </div>
            </div>
        <?php }?>
        <button class="btn btn-default" type="submit" name="submitNewVoucher" style="display:none" id="submitNewVoucher"></button>
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
