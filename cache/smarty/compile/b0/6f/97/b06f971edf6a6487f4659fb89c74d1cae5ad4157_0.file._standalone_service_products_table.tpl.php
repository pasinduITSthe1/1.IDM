<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:34
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\_standalone_service_products_table.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2963d8988_89442363',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b06f971edf6a6487f4659fb89c74d1cae5ad4157' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\_standalone_service_products_table.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2963d8988_89442363 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="row">
    <div class="col-lg-12">
        <table class="table" id="customer_products_details">
            <thead>
                <tr>
                    <th><span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Image'),$_smarty_tpl ) );?>
</th>
                    <th><span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</span></th>
                    <th><span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity'),$_smarty_tpl ) );?>
</span></th>
                    <th><span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price (Tax excl.)'),$_smarty_tpl ) );?>
</span></th>
                    <th><span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Tax'),$_smarty_tpl ) );?>
</span></th>
                    <th><span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Price (Tax incl.)'),$_smarty_tpl ) );?>
</span></th>
                    <?php if ((isset($_smarty_tpl->tpl_vars['refundReqProducts']->value)) && $_smarty_tpl->tpl_vars['refundReqProducts']->value) {?>
                        <th><span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refund State'),$_smarty_tpl ) );?>
</span></th>
                        <th><span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refunded amount'),$_smarty_tpl ) );?>
</span></th>
                    <?php }?>
                    <?php if (($_smarty_tpl->tpl_vars['can_edit']->value)) {?>
                        <th><span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Actions'),$_smarty_tpl ) );?>
</th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <?php if ($_smarty_tpl->tpl_vars['standalone_service_products']->value) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['standalone_service_products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                                                <?php if (($_smarty_tpl->tpl_vars['order']->value->getTaxCalculationMethod() == (defined('PS_TAX_EXC') ? constant('PS_TAX_EXC') : null))) {?>
                            <?php $_smarty_tpl->_assignInScope('product_price', ($_smarty_tpl->tpl_vars['product']->value['unit_price_tax_excl']));?>
                        <?php } else { ?>
                            <?php $_smarty_tpl->_assignInScope('product_price', $_smarty_tpl->tpl_vars['product']->value['unit_price_tax_incl']);?>
                        <?php }?>
                        <tr class="product-line-row" data-id_product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" data-id_order_detail="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_order_detail'];?>
" data-id_service_product_order_detail="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_service_product_order_detail'];?>
">
                            <td>
                                <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['image_link'])) && $_smarty_tpl->tpl_vars['product']->value['image_link']) {?>
                                    <img class="img img-responsive" src="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['image_link'], ENT_QUOTES, 'UTF-8', true);?>
" />
                                <?php }?>
                            </td>
                            <td>
                                <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminNormalProducts'), ENT_QUOTES, 'UTF-8', true);?>
&amp;id_product=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
&amp;updateproduct">
                                    <span class="productName"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];
if ($_smarty_tpl->tpl_vars['product']->value['option_name']) {?> : <?php echo $_smarty_tpl->tpl_vars['product']->value['option_name'];
}?></span><br />
                                </a>
                            </td>
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?><span class=""><?php echo (int)$_smarty_tpl->tpl_vars['product']->value['quantity'];?>
</span><?php } else { ?>--<?php }?>
                            </td>
                            <td class="unit_price_tax_excl">
                                <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</p>
                                <p class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit price'),$_smarty_tpl ) );?>
 : <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['unit_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</p>
                            </td>
                            <td>
                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['product']->value['total_price_tax_incl']-$_smarty_tpl->tpl_vars['product']->value['total_price_tax_excl']),'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</span>
                            </td>
                            <td>
                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>
</span>
                            </td>
                            <?php if (((isset($_smarty_tpl->tpl_vars['refundReqProducts']->value)) && $_smarty_tpl->tpl_vars['refundReqProducts']->value)) {?>
                                <td>
                                    <?php if (in_array($_smarty_tpl->tpl_vars['product']->value['id_service_product_order_detail'],$_smarty_tpl->tpl_vars['refundReqProducts']->value)) {?>
                                        <?php if ($_smarty_tpl->tpl_vars['product']->value['is_cancelled']) {?>
                                            <span class="badge badge-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancelled'),$_smarty_tpl ) );?>
</span>
                                        <?php } elseif ((isset($_smarty_tpl->tpl_vars['product']->value['refund_info'])) && (!$_smarty_tpl->tpl_vars['product']->value['refund_info']['refunded'] || $_smarty_tpl->tpl_vars['product']->value['refund_info']['id_customization'])) {?>
                                            <span class="badge" style="background-color:<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['refund_info']['color'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['refund_info']['name'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                                        <?php } else { ?>
                                            <span>--</span>
                                        <?php }?>
                                    <?php } else { ?>
                                        <span>--</span>
                                    <?php }?>
                                </td>
                                <td>
                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['is_refunded'] && (isset($_smarty_tpl->tpl_vars['product']->value['refund_info'])) && $_smarty_tpl->tpl_vars['product']->value['refund_info']) {?>
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['refund_info']['refunded_amount'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );?>

                                    <?php } else { ?>
                                        --
                                    <?php }?>
                                </td>
                            <?php }?>
                            <?php if (($_smarty_tpl->tpl_vars['can_edit']->value && !$_smarty_tpl->tpl_vars['order']->value->hasBeenDelivered())) {?>
                                <td class="room_invoice" style="display: none;">
                                <?php if (sizeof($_smarty_tpl->tpl_vars['invoices_collection']->value)) {?>
                                <select name="product_invoice" class="edit_product_invoice">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['invoices_collection']->value, 'invoice');
$_smarty_tpl->tpl_vars['invoice']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['invoice']->value) {
$_smarty_tpl->tpl_vars['invoice']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['invoice']->value->id;?>
" >
                                        #<?php echo Configuration::get('PS_INVOICE_PREFIX',$_smarty_tpl->tpl_vars['current_id_lang']->value,null,$_smarty_tpl->tpl_vars['order']->value->id_shop);
echo sprintf('%06d',$_smarty_tpl->tpl_vars['invoice']->value->number);?>

                                    </option>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select>
                                <?php } else { ?>
                                &nbsp;
                                <?php }?>
                                </td>
                                <td class="product_action">
                                                                        <?php if ((isset($_smarty_tpl->tpl_vars['refundReqProducts']->value)) && $_smarty_tpl->tpl_vars['refundReqProducts']->value && in_array($_smarty_tpl->tpl_vars['product']->value['id_service_product_order_detail'],$_smarty_tpl->tpl_vars['refundReqProducts']->value) && $_smarty_tpl->tpl_vars['product']->value['is_cancelled']) {?>
                                        <button href="#" class="btn btn-default delete_product_line">
                                            <i class="icon-trash"></i>
                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete'),$_smarty_tpl ) );?>

                                        </button>
                                    <?php } else { ?>
                                        <div class="btn-group">
                                                                                        <button type="button" class="btn btn-default edit_product_change_link" data-product_line_data="<?php echo htmlspecialchars((string)json_encode($_smarty_tpl->tpl_vars['product']->value), ENT_QUOTES, 'UTF-8', true);?>
">
                                                <i class="icon-pencil"></i>
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit'),$_smarty_tpl ) );?>

                                            </button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="#" class="delete_product_line">
                                                        <i class="icon-trash"></i>
                                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete'),$_smarty_tpl ) );?>

                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php }?>
                                                                                                        </td>
                            <?php }?>
                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php } else { ?>
                    <tr>
                        <?php $_smarty_tpl->_assignInScope('colspan', 6);?>
                        <?php if ((isset($_smarty_tpl->tpl_vars['refundReqProducts']->value)) && $_smarty_tpl->tpl_vars['refundReqProducts']->value) {?>
                            <?php $_smarty_tpl->_assignInScope('colspan', ($_smarty_tpl->tpl_vars['colspan']->value+2));?>
                        <?php }?>
                        <?php if (($_smarty_tpl->tpl_vars['can_edit']->value)) {?>
                            <?php $_smarty_tpl->_assignInScope('colspan', ($_smarty_tpl->tpl_vars['colspan']->value+1));?>
                        <?php }?>
                        <td class="list-empty hidden-print" colspan="<?php echo $_smarty_tpl->tpl_vars['colspan']->value;?>
">
                            <div class="list-empty-msg">
                                <i class="icon-warning-sign list-empty-icon"></i>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No products added yet'),$_smarty_tpl ) );?>

                            </div>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div><?php }
}
