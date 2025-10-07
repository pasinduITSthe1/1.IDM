<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:29
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_edit_product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f291cc4fd9_37970714',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ab790f14b9edcf19456d88f83891d315e3a10c40' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_edit_product.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f291cc4fd9_37970714 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal-body">
    <div id="edit_product">
        <input type="hidden" id="edit_product_product_id" name="edit_product[product_id]" value="<?php echo $_smarty_tpl->tpl_vars['ServiceProductOrderDetail']->value->id_product;?>
" />
        <input type="hidden" id="edit_product_id_service_product_order_detail" name="edit_product[id_service_product_order_detail]" value="<?php echo $_smarty_tpl->tpl_vars['ServiceProductOrderDetail']->value->id;?>
" />
        <input type="hidden" id="edit_product_id_order" name="id_order" value="<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
" />
        <div class="edit_product_fields">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayAdminOrderEditProductFieldsBefore'),$_smarty_tpl ) );?>

            <div class="row form-group">
                <div class="col-sm-6">
                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit Price (tax excl.)'),$_smarty_tpl ) );?>
</label>
                    <div class="input-group">
                        <?php if ($_smarty_tpl->tpl_vars['currency']->value->format%2) {?><div class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div><?php }?>
                        <input class="form-control" type="text" name="edit_product[product_price_tax_excl]" id="edit_product_product_price_tax_excl" value="<?php echo $_smarty_tpl->tpl_vars['ServiceProductOrderDetail']->value->unit_price_tax_excl;?>
"/>
                        <?php if (!($_smarty_tpl->tpl_vars['currency']->value->format%2)) {?><div class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div><?php }?>
                    </div>
                </div>
                <div class="productQuantity col-sm-6" <?php if (!$_smarty_tpl->tpl_vars['objProduct']->value->allow_multiple_quantity) {?> style="display:none" <?php }?>>
                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity'),$_smarty_tpl ) );?>
</label>
                    <input type="number" class="form-control" name="edit_product[product_quantity]" id="edit_product_product_quantity" value="<?php echo $_smarty_tpl->tpl_vars['ServiceProductOrderDetail']->value->quantity;?>
" min="1"/>
                </div>
            </div>

            <div class="product_invoice" style="display: none;">
                <select name="product_invoice" class="edit_product_invoice">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['invoices_collection']->value, 'invoice');
$_smarty_tpl->tpl_vars['invoice']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['invoice']->value) {
$_smarty_tpl->tpl_vars['invoice']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['invoice']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['invoice']->value->id == $_smarty_tpl->tpl_vars['data']->value['id_order_invoice']) {?>selected="selected"<?php }?>>
                            #<?php echo Configuration::get('PS_INVOICE_PREFIX',$_smarty_tpl->tpl_vars['current_id_lang']->value,null,$_smarty_tpl->tpl_vars['order']->value->id_shop);
echo sprintf('%06d',$_smarty_tpl->tpl_vars['invoice']->value->number);?>

                        </option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
        </div>
        <button type="button" class="btn btn-default" id="submitAddProduct" disabled="disabled" style="display:none;"></button>
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
