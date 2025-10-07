<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:11
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\modules\blockcart\cartrow.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27fdee0c1_28972696',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7af1310b48d9abb224d0daddc33a5c401ed2ddd' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\modules\\blockcart\\cartrow.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27fdee0c1_28972696 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_assignInScope('productId', $_smarty_tpl->tpl_vars['product']->value['id_product']);
$_smarty_tpl->_assignInScope('productAttributeId', $_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
<dt data-id="cart_block_product_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']) {
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
} else { ?>0<?php }?>_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']) {
echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);
} else { ?>0<?php }?>_<?php if ((isset($_smarty_tpl->tpl_vars['hotel_wise_data']->value['id_hotel'])) && $_smarty_tpl->tpl_vars['hotel_wise_data']->value['id_hotel']) {
echo $_smarty_tpl->tpl_vars['hotel_wise_data']->value['id_hotel'];
} else { ?>0<?php }?>" class="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first'] : null)) {?>first_item<?php } elseif ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last'] : null)) {?>last_item<?php } else { ?>item<?php }?>">
    <a class="cart-images" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'cart_default');?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" /></a>
    <div class="cart-info">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_91464207968e4f27f7e9d11_00306510', 'blockcart_shopping_cart_product_name');
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_39252058368e4f27f854793_86961136', 'blockcart_shopping_cart_hotel_name');
?>

        <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['attributes_small']))) {?>
            <div class="product-atributes">
                <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value,$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category'],null,null,$_smarty_tpl->tpl_vars['product']->value['id_shop'],$_smarty_tpl->tpl_vars['product']->value['id_product_attribute']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product detail','mod'=>'blockcart'),$_smarty_tpl ) );?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['attributes_small'];?>
</a>
            </div>
        <?php }?>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_84870010868e4f27f8ddaf3_86362108', 'blockcart_shopping_cart_product_total_price');
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_170324764568e4f27f9a7490_09859069', 'blockcart_shopping_cart_product_quantity');
?>

    </div>
    <span class="remove_link">
        <?php if (!(isset($_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value])) && (!(isset($_smarty_tpl->tpl_vars['product']->value['is_gift'])) || !$_smarty_tpl->tpl_vars['product']->value['is_gift'])) {?>
            <a class="ajax_cart_block_remove_link" href="<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);
$_prefixVariable11=ob_get_clean();
ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
$_prefixVariable12=ob_get_clean();
ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);
$_prefixVariable13=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,NULL,"delete=1&id_product=".$_prefixVariable11."&ipa=".$_prefixVariable12."&id_address_delivery=".$_prefixVariable13."&token=".((string)$_smarty_tpl->tpl_vars['static_token']->value)), ENT_QUOTES, 'UTF-8', true);
if (!empty($_smarty_tpl->tpl_vars['hotel_wise_data']->value['id_hotel'])) {?>&id_hotel=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['hotel_wise_data']->value['id_hotel'], ENT_QUOTES, 'UTF-8', true);
}?>" rel="nofollow" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'remove this product from my cart','mod'=>'blockcart'),$_smarty_tpl ) );?>
">&nbsp;</a>
        <?php }?>
    </span>
    <div style="clear:both"></div>
    <?php if ($_smarty_tpl->tpl_vars['product']->value['booking_product']) {?>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_198860593768e4f27fa9a099_56085060', 'blockcart_shopping_cart_dates');
?>

    <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['hasOptions']) {?>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_191625988568e4f27fb605e2_83111365', 'blockcart_shopping_cart_options');
?>

    <?php }?>
</dt>
<?php if ((isset($_smarty_tpl->tpl_vars['product']->value['attributes_small']))) {?>
    <dd data-id="cart_block_combination_of_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);
if ($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']) {?>_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
}?>_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);?>
" class="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first'] : null)) {?>first_item<?php } elseif ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last'] : null)) {?>last_item<?php } else { ?>item<?php }?>">
<?php }?>
<!-- Customizable datas -->
<?php if ((isset($_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value][$_smarty_tpl->tpl_vars['product']->value['id_address_delivery']]))) {?>
    <?php if (!(isset($_smarty_tpl->tpl_vars['product']->value['attributes_small']))) {?>
        <dd data-id="cart_block_combination_of_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']) {
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
} else { ?>0<?php }?>_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']) {
echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);
} else { ?>0<?php }?>" class="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first'] : null)) {?>first_item<?php } elseif ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last'] : null)) {?>last_item<?php } else { ?>item<?php }?>">
    <?php }?>
    <ul class="cart_block_customizations" data-id="customization_<?php echo $_smarty_tpl->tpl_vars['productId']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['productAttributeId']->value;?>
">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value][$_smarty_tpl->tpl_vars['product']->value['id_address_delivery']], 'customization', false, 'id_customization', 'customizations', array (
));
$_smarty_tpl->tpl_vars['customization']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id_customization']->value => $_smarty_tpl->tpl_vars['customization']->value) {
$_smarty_tpl->tpl_vars['customization']->do_else = false;
?>
            <li name="customization">
                <div data-id="deleteCustomizableProduct_<?php echo intval($_smarty_tpl->tpl_vars['id_customization']->value);?>
_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);?>
" class="deleteCustomizableProduct">
                    <a class="ajax_cart_block_remove_link" href="<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);
$_prefixVariable14=ob_get_clean();
ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
$_prefixVariable15=ob_get_clean();
ob_start();
echo intval($_smarty_tpl->tpl_vars['id_customization']->value);
$_prefixVariable16=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,NULL,"delete=1&id_product=".$_prefixVariable14."&ipa=".$_prefixVariable15."&id_customization=".$_prefixVariable16."&token=".((string)$_smarty_tpl->tpl_vars['static_token']->value)), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow">&nbsp;</a>
                </div>
                <?php if ((isset($_smarty_tpl->tpl_vars['customization']->value['datas'][$_smarty_tpl->tpl_vars['CUSTOMIZE_TEXTFIELD']->value][0]))) {?>
                    <?php echo htmlspecialchars((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( smarty_modifier_replace($_smarty_tpl->tpl_vars['customization']->value['datas'][$_smarty_tpl->tpl_vars['CUSTOMIZE_TEXTFIELD']->value][0]['value'],"<br />"," "),28,'...' )), ENT_QUOTES, 'UTF-8', true);?>

                <?php } else { ?>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customization #%d:','sprintf'=>intval($_smarty_tpl->tpl_vars['id_customization']->value),'mod'=>'blockcart'),$_smarty_tpl ) );?>

                <?php }?>
            </li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
    <?php if (!(isset($_smarty_tpl->tpl_vars['product']->value['attributes_small']))) {?></dd><?php }
}
if ((isset($_smarty_tpl->tpl_vars['product']->value['attributes_small']))) {?></dd><?php }
}
/* {block 'blockcart_shopping_cart_product_name'} */
class Block_91464207968e4f27f7e9d11_00306510 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'blockcart_shopping_cart_product_name' => 
  array (
    0 => 'Block_91464207968e4f27f7e9d11_00306510',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <div class="product-name">
                            <a class="cart_block_product_name" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value,$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category'],null,null,$_smarty_tpl->tpl_vars['product']->value['id_shop'],$_smarty_tpl->tpl_vars['product']->value['id_product_attribute']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],30,'...',true )), ENT_QUOTES, 'UTF-8', true);?>
</a>
            </div>
        <?php
}
}
/* {/block 'blockcart_shopping_cart_product_name'} */
/* {block 'blockcart_shopping_cart_hotel_name'} */
class Block_39252058368e4f27f854793_86961136 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'blockcart_shopping_cart_hotel_name' => 
  array (
    0 => 'Block_39252058368e4f27f854793_86961136',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php if ($_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_HOTEL_STANDALONE || $_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_HOTEL_STANDALONE_AND_WITH_ROOM_TYPE) {?>
                <div class="hotel-name">
                    <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['hotel_wise_data']->value['hotel_name'], ENT_QUOTES, 'UTF-8', true);?>

                </div>
            <?php }?>
        <?php
}
}
/* {/block 'blockcart_shopping_cart_hotel_name'} */
/* {block 'displayProductPriceBlock'} */
class Block_81365659168e4f27f96ca91_18647683 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"price",'from'=>"blockcart"),$_smarty_tpl ) );?>

                            <?php
}
}
/* {/block 'displayProductPriceBlock'} */
/* {block 'blockcart_shopping_cart_product_total_price'} */
class Block_84870010868e4f27f8ddaf3_86362108 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'blockcart_shopping_cart_product_total_price' => 
  array (
    0 => 'Block_84870010868e4f27f8ddaf3_86362108',
  ),
  'displayProductPriceBlock' => 
  array (
    0 => 'Block_81365659168e4f27f96ca91_18647683',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <div class="cart-info-sec rm_product_info_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
">
                <span class="product_info_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price','mod'=>'blockcart'),$_smarty_tpl ) );?>
:</span>
                <span class="price product_info_data">
                    <?php if (!(isset($_smarty_tpl->tpl_vars['product']->value['is_gift'])) || !$_smarty_tpl->tpl_vars['product']->value['is_gift']) {?>
                        <?php if ($_smarty_tpl->tpl_vars['product']->value['booking_product']) {?>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0], array( array('p'=>((string)$_smarty_tpl->tpl_vars['product']->value['bookingData']['total_room_type_amount'])),$_smarty_tpl ) );?>

                        <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_HOTEL_STANDALONE || $_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_HOTEL_STANDALONE_AND_WITH_ROOM_TYPE) {?>
                            <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == (defined('PS_TAX_EXC') ? constant('PS_TAX_EXC') : null)) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0], array( array('p'=>((string)$_smarty_tpl->tpl_vars['hotel_wise_data']->value['total_price_tax_excl'])),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0], array( array('p'=>((string)$_smarty_tpl->tpl_vars['hotel_wise_data']->value['total_price_tax_incl'])),$_smarty_tpl ) );
}?>
                        <?php } else { ?>
                            <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == (defined('PS_TAX_EXC') ? constant('PS_TAX_EXC') : null)) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0], array( array('p'=>((string)$_smarty_tpl->tpl_vars['product']->value['total_price_tax_excl'])),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0], array( array('p'=>((string)$_smarty_tpl->tpl_vars['product']->value['total_price_tax_incl'])),$_smarty_tpl ) );
}?>
                        <?php }?>
                        <div id="hookDisplayProductPriceBlock-price">
                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_81365659168e4f27f96ca91_18647683', 'displayProductPriceBlock', $this->tplIndex);
?>

                        </div>
                    <?php } else { ?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Free!','mod'=>'blockcart'),$_smarty_tpl ) );?>

                    <?php }?>
                </span>
            </div>
        <?php
}
}
/* {/block 'blockcart_shopping_cart_product_total_price'} */
/* {block 'blockcart_shopping_cart_product_quantity'} */
class Block_170324764568e4f27f9a7490_09859069 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'blockcart_shopping_cart_product_quantity' => 
  array (
    0 => 'Block_170324764568e4f27f9a7490_09859069',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <div class="cart-info-sec rm_product_info_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
">
                <?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity'] || $_smarty_tpl->tpl_vars['product']->value['booking_product']) {?><span class="product_info_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Qty.','mod'=>'blockcart'),$_smarty_tpl ) );?>
:</span><?php }?>
                <span class="quantity-formated">
                    <?php if ($_smarty_tpl->tpl_vars['product']->value['booking_product']) {?>
                        <span class="quantity product_info_data"><?php echo $_smarty_tpl->tpl_vars['product']->value['bookingData']['total_num_rooms'];?>
</span>
                    <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
                        <?php if ($_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_HOTEL_STANDALONE || $_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_HOTEL_STANDALONE_AND_WITH_ROOM_TYPE) {?>
                            <span class="quantity product_info_data"><?php echo $_smarty_tpl->tpl_vars['hotel_wise_data']->value['total_qty'];?>
</span>
                        <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_STANDALONE) {?>
                            <span class="quantity product_info_data"><?php echo $_smarty_tpl->tpl_vars['product']->value['cart_quantity'];?>
</span>
                        <?php }?>
                    <?php }?>
                </span>
            </div>
        <?php
}
}
/* {/block 'blockcart_shopping_cart_product_quantity'} */
/* {block 'blockcart_shopping_cart_dates'} */
class Block_198860593768e4f27fa9a099_56085060 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'blockcart_shopping_cart_dates' => 
  array (
    0 => 'Block_198860593768e4f27fa9a099_56085060',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

            <div id="booking_dates_container_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" class="cart_prod_cont">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Duration','mod'=>'blockcart'),$_smarty_tpl ) );?>
</th>
                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Qty.','mod'=>'blockcart'),$_smarty_tpl ) );?>
</th>
                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price','mod'=>'blockcart'),$_smarty_tpl ) );?>
</th>
                                <th>&nbsp;<!-- <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove','mod'=>'blockcart'),$_smarty_tpl ) );?>
 --></th>
                            </tr>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['bookingData']['date_diff'], 'data_v', false, 'data_k1');
$_smarty_tpl->tpl_vars['data_v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data_k1']->value => $_smarty_tpl->tpl_vars['data_v']->value) {
$_smarty_tpl->tpl_vars['data_v']->do_else = false;
?>
                                <tr class="rooms_remove_container">
                                    <?php $_smarty_tpl->_assignInScope('is_full_date', ($_smarty_tpl->tpl_vars['show_full_date']->value && (smarty_modifier_date_format($_smarty_tpl->tpl_vars['data_v']->value['data_form'],'%D') == smarty_modifier_date_format($_smarty_tpl->tpl_vars['data_v']->value['data_to'],'%D'))));?>
                                    <td>
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['data_v']->value['data_form'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>
&nbsp;-&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['data_v']->value['data_to'],'full'=>$_smarty_tpl->tpl_vars['is_full_date']->value),$_smarty_tpl ) );?>

                                    </td>
                                    <td class="num_rooms_in_date"><?php echo $_smarty_tpl->tpl_vars['data_v']->value['num_rm'];?>
</td>
                                    <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['data_v']->value['amount']+$_smarty_tpl->tpl_vars['data_v']->value['demand_price'])),$_smarty_tpl ) );?>
</td>
                                    <td><a class="remove_rooms_from_cart_link" href="#" rm_price="<?php echo $_smarty_tpl->tpl_vars['data_v']->value['amount'];?>
" id_product="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" date_from="<?php echo $_smarty_tpl->tpl_vars['data_v']->value['data_form'];?>
" date_to="<?php echo $_smarty_tpl->tpl_vars['data_v']->value['data_to'];?>
" num_rooms="<?php echo $_smarty_tpl->tpl_vars['data_v']->value['num_rm'];?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'remove this room from my cart','mod'=>'blockcart'),$_smarty_tpl ) );?>
"></a></td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
}
}
/* {/block 'blockcart_shopping_cart_dates'} */
/* {block 'blockcart_shopping_cart_options'} */
class Block_191625988568e4f27fb605e2_83111365 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'blockcart_shopping_cart_options' => 
  array (
    0 => 'Block_191625988568e4f27fb605e2_83111365',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php if ($_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_HOTEL_STANDALONE || $_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_HOTEL_STANDALONE_AND_WITH_ROOM_TYPE) {?>
                <?php $_smarty_tpl->_assignInScope('options', $_smarty_tpl->tpl_vars['hotel_wise_data']->value['options']);?>
            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['selling_preference_type'] == Product::SELLING_PREFERENCE_STANDALONE) {?>
                <?php $_smarty_tpl->_assignInScope('options', $_smarty_tpl->tpl_vars['product']->value['options']);?>
            <?php }?>
            <div class="table-responsive cart_prod_cont">
                <table class="table">
                    <tbody>
                        <tr>
                            <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Variant','mod'=>'blockcart'),$_smarty_tpl ) );?>
</th>
                            <?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
                                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Qty.','mod'=>'blockcart'),$_smarty_tpl ) );?>
</th>
                            <?php }?>
                            <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price','mod'=>'blockcart'),$_smarty_tpl ) );?>
</th>
                            <th>&nbsp;</th>
                        </tr>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['options']->value, 'data_v');
$_smarty_tpl->tpl_vars['data_v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data_v']->value) {
$_smarty_tpl->tpl_vars['data_v']->do_else = false;
?>
                            <tr class="product_option_row">
                                <td><?php echo $_smarty_tpl->tpl_vars['data_v']->value['option_name'];?>
</td>
                                <?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
                                    <td><?php echo $_smarty_tpl->tpl_vars['data_v']->value['quantity'];?>
</td>
                                <?php }?>
                                <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['data_v']->value['total_price_tax_excl'])),$_smarty_tpl ) );?>
</td>
                                <td class="text-right"><a class="ajax_remove_product_option" href="#" id_product="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" id_hotel="<?php echo intval($_smarty_tpl->tpl_vars['data_v']->value['id_hotel']);?>
" id_product_option="<?php echo intval($_smarty_tpl->tpl_vars['data_v']->value['id_product_option']);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'remove this product from my cart','mod'=>'blockcart'),$_smarty_tpl ) );?>
">&nbsp;</a></td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
        <?php
}
}
/* {/block 'blockcart_shopping_cart_options'} */
}
