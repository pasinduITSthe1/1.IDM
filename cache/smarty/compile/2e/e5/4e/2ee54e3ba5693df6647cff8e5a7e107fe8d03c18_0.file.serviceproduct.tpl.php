<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:40
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\products\serviceproduct.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29cc041b3_91496423',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2ee54e3ba5693df6647cff8e5a7e107fe8d03c18' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\products\\serviceproduct.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29cc041b3_91496423 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['product']->value->id))) {?>
    <div id="product-configuration" class="panel product-tab">
		<input type="hidden" name="submitted_tabs[]" value="ServiceProduct" />
		<h3 class="tab"> <i class="icon-AdminAdmin"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Service Products'),$_smarty_tpl ) );?>
</h3>

        <?php if (((isset($_smarty_tpl->tpl_vars['associated_service_products']->value)) && $_smarty_tpl->tpl_vars['associated_service_products']->value) || ((isset($_smarty_tpl->tpl_vars['unassociated_service_products']->value)) && $_smarty_tpl->tpl_vars['unassociated_service_products']->value)) {?>
            <div class="from-group table-responsive-row clearfix">
                <table class="table hotel-roomtype-link-table">
                    <thead>
                        <tr class="nodrag nodrop">
                            <th class="text-center">
                                <input type="checkbox" class="bulk-service-products-status">
                            </th>
                            <th class="col-sm-1">
                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'ID'),$_smarty_tpl ) );?>
</span>
                            </th>
                            <th class="col-sm-2">
                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</span>
                            </th>
                            <th class="text-center">
                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Auto Add to Cart'),$_smarty_tpl ) );?>
</span>
                            </th>
                            <th>
                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Position'),$_smarty_tpl ) );?>
</span>
                            </th>
                            <th>
                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price'),$_smarty_tpl ) );?>
</span>
                            </th>
                            <th>
                                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tax rule'),$_smarty_tpl ) );?>
</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['associated_service_products']->value, 'service_product');
$_smarty_tpl->tpl_vars['service_product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['service_product']->value) {
$_smarty_tpl->tpl_vars['service_product']->do_else = false;
?>
                            <tr id='room_type_service_product_<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service_product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
' position="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service_product']->value['association_info']['position'], ENT_QUOTES, 'UTF-8', true);?>
" id_product='<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service_product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
' id_element="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" data-roomtype_url="<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminProducts',true));?>
">
                                <?php $_smarty_tpl->_assignInScope('inputs_prefix', "service_product_".((string)$_smarty_tpl->tpl_vars['service_product']->value['id_product'])."_");?>
                                <input type="hidden" name="available_service_products[]" value="<?php echo $_smarty_tpl->tpl_vars['service_product']->value['id_product'];?>
">

                                <td class="text-center">
                                    <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['inputs_prefix']->value;?>
associated" class="is-associated" checked>
                                </td>
                                <td class="col-sm-1">
                                    <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service_product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>

                                    <a target="blank" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminNormalProducts'), ENT_QUOTES, 'UTF-8', true);?>
&amp;id_product=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service_product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
&amp;updateproduct">
                                        <i class="icon-external-link-sign"></i>
                                    </a>
                                </td>
                                <td><?php echo $_smarty_tpl->tpl_vars['service_product']->value['name'];?>
</td>
                                <td class="text-center">
                                    <span <?php if ($_smarty_tpl->tpl_vars['service_product']->value['auto_add_to_cart']) {?>class="badge badge-success"<?php }?>>
                                        <?php if ($_smarty_tpl->tpl_vars['service_product']->value['auto_add_to_cart']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No'),$_smarty_tpl ) );
}?>
                                    </span>
                                </td>
                                <td class="pointer dragHandle center positionImage">
                                    <div class="dragGroup">
                                        <div class="positions">
                                            <?php echo $_smarty_tpl->tpl_vars['service_product']->value['association_info']['position']+1;?>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fixed-width-xl">
                                        <div class="input-group">
                                            <span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</span>
                                            <?php $_smarty_tpl->_assignInScope('price_value', 0);?>
                                            <?php if ((isset($_POST[((string)$_smarty_tpl->tpl_vars['inputs_prefix']->value)."price"]))) {?>
                                                <?php $_smarty_tpl->_assignInScope('price_value', $_POST[((string)$_smarty_tpl->tpl_vars['inputs_prefix']->value)."price"]);?>
                                            <?php } else { ?>
                                                <?php if ((isset($_smarty_tpl->tpl_vars['service_product']->value['association_info']['custom_price']))) {?>
                                                    <?php $_smarty_tpl->_assignInScope('price_value', $_smarty_tpl->tpl_vars['service_product']->value['association_info']['custom_price']);?>
                                                <?php } elseif ((isset($_smarty_tpl->tpl_vars['service_product']->value['association_info']['default_price']))) {?>
                                                    <?php $_smarty_tpl->_assignInScope('price_value', $_smarty_tpl->tpl_vars['service_product']->value['association_info']['default_price']);?>
                                                <?php }?>
                                            <?php }?>
                                            <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['inputs_prefix']->value;?>
price" value="<?php echo $_smarty_tpl->tpl_vars['price_value']->value;?>
" data-id_product="<?php echo $_smarty_tpl->tpl_vars['service_product']->value['id_product'];?>
">
                                        </div>
                                    </div>
                                    <div class="help-block">
                                        <?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['service_product']->value['association_info']['default_price'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );
$_prefixVariable32 = ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Default price: %s','sprintf'=>$_prefixVariable32),$_smarty_tpl ) );?>

                                    </div>
                                </td>
                                <td>
                                    <?php if ($_smarty_tpl->tpl_vars['service_product']->value['association_info']['auto_add_to_cart'] && $_smarty_tpl->tpl_vars['service_product']->value['association_info']['price_addition_type'] == Product::PRICE_ADDITION_TYPE_WITH_ROOM) {?>
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'-'),$_smarty_tpl ) );?>

                                    <?php } else { ?>
                                        <div class="fixed-width-xl">
                                            <select class="service_product_id_tax_rules_group" name="<?php echo $_smarty_tpl->tpl_vars['inputs_prefix']->value;?>
id_tax_rules_group">
                                                <option value="0"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No Tax'),$_smarty_tpl ) );?>
</option>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tax_rules_groups']->value, 'tax_rules_group');
$_smarty_tpl->tpl_vars['tax_rules_group']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tax_rules_group']->value) {
$_smarty_tpl->tpl_vars['tax_rules_group']->do_else = false;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['tax_rules_group']->value['id_tax_rules_group'];?>
" <?php if ($_smarty_tpl->tpl_vars['service_product']->value['association_info']['id_tax_rules_group'] == $_smarty_tpl->tpl_vars['tax_rules_group']->value['id_tax_rules_group']) {?>selected="selected"<?php }?> >
                                                        <?php echo smarty_modifier_htmlentitiesUTF8($_smarty_tpl->tpl_vars['tax_rules_group']->value['name']);?>

                                                    </option>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            </select>
                                        </div>
                                        <div class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Default tax rule: %s','sprintf'=>$_smarty_tpl->tpl_vars['service_product']->value['association_info']['default_tax_rules_group_name']),$_smarty_tpl ) );?>
</div>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['unassociated_service_products']->value, 'service_product');
$_smarty_tpl->tpl_vars['service_product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['service_product']->value) {
$_smarty_tpl->tpl_vars['service_product']->do_else = false;
?>
                            <tr class="nodrop nodrag">
                                <?php $_smarty_tpl->_assignInScope('inputs_prefix', "service_product_".((string)$_smarty_tpl->tpl_vars['service_product']->value['id_product'])."_");?>
                                <input type="hidden" name="available_service_products[]" value="<?php echo $_smarty_tpl->tpl_vars['service_product']->value['id_product'];?>
">

                                <td class="text-center">
                                    <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['inputs_prefix']->value;?>
associated" class="is-associated" <?php if ((isset($_POST[((string)$_smarty_tpl->tpl_vars['inputs_prefix']->value)."associated"])) && in_array($_POST[((string)$_smarty_tpl->tpl_vars['inputs_prefix']->value)."associated"],array('on','true','1'))) {?>checked<?php }?>>
                                </td>
                                <td class="col-sm-1"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service_product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
 <a target="blank" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminNormalProducts'), ENT_QUOTES, 'UTF-8', true);?>
&amp;id_product=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service_product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
&amp;updateproduct"><i class="icon-external-link-sign"></i></a></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['service_product']->value['name'];?>
</td>
                                <td class="text-center"><span <?php if ($_smarty_tpl->tpl_vars['service_product']->value['auto_add_to_cart']) {?>class="badge badge-success"<?php }?>><?php if ($_smarty_tpl->tpl_vars['service_product']->value['auto_add_to_cart']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No'),$_smarty_tpl ) );
}?></span></td>
                                <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'--'),$_smarty_tpl ) );?>
</td>
                                <td>
                                    <div class="fixed-width-xl">
                                        <div class="input-group">
                                            <span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</span>
                                            <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['inputs_prefix']->value;?>
price" data-id_product="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['service_product']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
" value="<?php if ((isset($_POST[((string)$_smarty_tpl->tpl_vars['inputs_prefix']->value)."price"])) && $_POST[((string)$_smarty_tpl->tpl_vars['inputs_prefix']->value)."price"]) {
echo $_POST[((string)$_smarty_tpl->tpl_vars['inputs_prefix']->value)."price"];
} else {
echo $_smarty_tpl->tpl_vars['service_product']->value['price'];
}?>">
                                        </div>
                                    </div>
                                    <div class="help-block">
                                        <?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['service_product']->value['price'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value->id),$_smarty_tpl ) );
$_prefixVariable33 = ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Default price: %s','sprintf'=>$_prefixVariable33),$_smarty_tpl ) );?>

                                    </div>
                                </td>
                                <td>
                                    <?php if ($_smarty_tpl->tpl_vars['service_product']->value['auto_add_to_cart'] && $_smarty_tpl->tpl_vars['service_product']->value['price_addition_type'] == Product::PRICE_ADDITION_TYPE_WITH_ROOM) {?>
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'-'),$_smarty_tpl ) );?>

                                    <?php } else { ?>
                                        <div class="fixed-width-xl">
                                            <select class="service_product_id_tax_rules_group" name="<?php echo $_smarty_tpl->tpl_vars['inputs_prefix']->value;?>
id_tax_rules_group">
                                                <option value="0"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No Tax'),$_smarty_tpl ) );?>
</option>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tax_rules_groups']->value, 'tax_rules_group');
$_smarty_tpl->tpl_vars['tax_rules_group']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tax_rules_group']->value) {
$_smarty_tpl->tpl_vars['tax_rules_group']->do_else = false;
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['tax_rules_group']->value['id_tax_rules_group'];?>
" <?php if ((isset($_POST[((string)$_smarty_tpl->tpl_vars['inputs_prefix']->value)."id_tax_rules_group"]))) {
if ($_smarty_tpl->tpl_vars['tax_rules_group']->value['id_tax_rules_group'] == $_POST[((string)$_smarty_tpl->tpl_vars['inputs_prefix']->value)."id_tax_rules_group"]) {
}
} elseif ($_smarty_tpl->tpl_vars['tax_rules_group']->value['id_tax_rules_group'] == $_smarty_tpl->tpl_vars['service_product']->value['id_tax_rules_group']) {?>selected<?php }?>>
                                                        <?php echo smarty_modifier_htmlentitiesUTF8($_smarty_tpl->tpl_vars['tax_rules_group']->value['name']);?>

                                                    </option>
                                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                            </select>
                                        </div>
                                        <div class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Default tax rule: %s','sprintf'=>$_smarty_tpl->tpl_vars['service_product']->value['tax_rules_group_name']),$_smarty_tpl ) );?>
</div>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminProducts'), ENT_QUOTES, 'UTF-8', true);
if ((isset($_REQUEST['page'])) && $_REQUEST['page'] > 1) {?>&amp;submitFilterproduct=<?php echo intval($_REQUEST['page']);
}?>" class="btn btn-default">
                    <i class="process-icon-cancel"></i>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel'),$_smarty_tpl ) );?>

                </a>
                <button type="submit" name="submitAddproduct" class="btn btn-default pull-right" disabled="disabled">
                    <i class="process-icon-loading"></i>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save'),$_smarty_tpl ) );?>

                </button>
                <button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right"  disabled="disabled">
                    <i class="process-icon-loading"></i>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save and stay'),$_smarty_tpl ) );?>

                </button>
            </div>
        <?php } else { ?>
            <div class="alert alert-info">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No services are attached with this room type'),$_smarty_tpl ) );?>

            </div>
        <?php }?>
    </div>
<?php }
}
}
