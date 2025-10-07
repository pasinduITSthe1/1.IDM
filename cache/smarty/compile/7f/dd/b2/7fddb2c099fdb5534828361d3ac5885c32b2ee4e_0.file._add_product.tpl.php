<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:29
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_add_product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2912bf6a4_00724490',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7fddb2c099fdb5534828361d3ac5885c32b2ee4e' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_add_product.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2912bf6a4_00724490 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal-body">
    <div id="new_product">
        <input type="hidden" id="add_product_product_id" name="add_product[product_id]" value="0" />
        <div class="form-group">
            <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product:'),$_smarty_tpl ) );?>
</label>
            <div class="input-group">
                <input type="text" id="add_product_product_name" class="form-control" value="" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter the name of the product'),$_smarty_tpl ) );?>
" />
                <div class="input-group-addon">
                    <i class="icon-search"></i>
                </div>
            </div>
        </div>
        <div class="add_product_fields" style="display:none;">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayAdminOrderAddRoomFormFieldsBefore'),$_smarty_tpl ) );?>

            <div class="row">
                <div class="productOptions form-group col-sm-6" style="display: none;">
                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Variant'),$_smarty_tpl ) );?>
</label>
                    <select name="add_product[product_option]" id="add_product_product_option">
                    </select>
                </div>
                <div class="productQuantity form-group col-sm-6">
                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity'),$_smarty_tpl ) );?>
</label>
                    <input type="number" class="form-control" name="add_product[product_quantity]" id="add_product_product_quantity" value="1" disabled="disabled" min="1"/>
                </div>
                <div class="col-sm-6 form-group">
                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price (tax excl.)'),$_smarty_tpl ) );?>
</label>
                    <div class="input-group">
                        <?php if ($_smarty_tpl->tpl_vars['currency']->value->format%2) {?><div class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div><?php }?>
                        <input class="form-control" type="text" name="add_product[product_price_tax_excl]" id="add_product_product_price_tax_excl" value=""  disabled="disabled"/>
                        <?php if (!($_smarty_tpl->tpl_vars['currency']->value->format%2)) {?><div class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div><?php }?>
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price (tax incl.)'),$_smarty_tpl ) );?>
</label>
                    <div class="input-group">
                        <?php if ($_smarty_tpl->tpl_vars['currency']->value->format%2) {?><div class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div><?php }?>
                        <input class="form-control" type="text" name="add_product[product_price_tax_incl]" id="add_product_product_price_tax_incl" value=""  disabled="disabled"/>
                        <?php if (!($_smarty_tpl->tpl_vars['currency']->value->format%2)) {?><div class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div><?php }?>
                    </div>
                </div>
                <?php if (sizeof($_smarty_tpl->tpl_vars['invoices_collection']->value)) {?>
                    <div class="col-sm-6 form-group" style="display: none;">
                        <label class="control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invoice'),$_smarty_tpl ) );?>
</label>
                        <select class="form-control" name="add_product[invoice]" id="add_product_product_invoice" disabled="disabled">
                            <optgroup class="existing" label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Existing'),$_smarty_tpl ) );?>
">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['invoices_collection']->value, 'invoice');
$_smarty_tpl->tpl_vars['invoice']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['invoice']->value) {
$_smarty_tpl->tpl_vars['invoice']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['invoice']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['invoice']->value->getInvoiceNumberFormatted($_smarty_tpl->tpl_vars['current_id_lang']->value);?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </optgroup>
                            <optgroup label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'New'),$_smarty_tpl ) );?>
">
                                <option value="0"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Create a new invoice'),$_smarty_tpl ) );?>
</option>
                            </optgroup>
                        </select>
                    </div>
                <?php }?>
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
