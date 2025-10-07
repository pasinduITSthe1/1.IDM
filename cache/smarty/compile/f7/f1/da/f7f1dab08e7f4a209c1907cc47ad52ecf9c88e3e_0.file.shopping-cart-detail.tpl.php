<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:28
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\shopping-cart-detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2907f8357_07168031',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7f1dab08e7f4a209c1907cc47ad52ecf9c88e3e' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\shopping-cart-detail.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2907f8357_07168031 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<div class="order-detail-content">
    <?php if ((isset($_smarty_tpl->tpl_vars['cart_htl_data']->value)) && $_smarty_tpl->tpl_vars['cart_htl_data']->value) {?>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_37399683268e4f28fe3f665_54165527', 'shopping_cart_heading');
?>

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart_htl_data']->value, 'data_v', false, 'data_k');
$_smarty_tpl->tpl_vars['data_v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data_k']->value => $_smarty_tpl->tpl_vars['data_v']->value) {
$_smarty_tpl->tpl_vars['data_v']->do_else = false;
?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data_v']->value['date_diff'], 'rm_v', false, 'rm_k');
$_smarty_tpl->tpl_vars['rm_v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rm_k']->value => $_smarty_tpl->tpl_vars['rm_v']->value) {
$_smarty_tpl->tpl_vars['rm_v']->do_else = false;
?>
                <div class="row cart_product_line">
                    <div class="col-sm-2 product-img-block">
                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_34654584768e4f28fe68052_30489472', 'shopping_cart_room_type_cover_image');
?>

                    </div>
                    <div class="col-sm-10">
                        <div class="room-info-container">
                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_55483117368e4f28fec7498_07050248', 'shopping_cart_room_type_cover_image_mobile');
?>

                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_88823835168e4f28fee51a0_58731610', 'shopping_cart_room_detail');
?>

                        </div>
                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_182855886568e4f290016af0_98940637', 'shopping_cart_room_type_features');
?>

                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_87718737168e4f290043cb4_49021070', 'shopping_cart_room_type_booking_information');
?>

                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_60347530168e4f29014fbb4_13897184', 'shopping_cart_room_type_price_detail');
?>

                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_187440920368e4f2902b6b93_19389594', 'displayCartProductContentAfter');
?>

                    </div>
                </div>
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_192904729668e4f2902c84c9_39157047', 'displayCartProductAfter');
?>

                <hr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_115089877768e4f2902dae03_33021167', 'displayAfterShoppingCartRoomsSummary');
?>

    <?php if (((isset($_smarty_tpl->tpl_vars['hotel_products']->value)) && $_smarty_tpl->tpl_vars['hotel_products']->value) || ((isset($_smarty_tpl->tpl_vars['standalone_products']->value)) && $_smarty_tpl->tpl_vars['standalone_products']->value)) {?>
        <p class="cart_section_title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product information'),$_smarty_tpl ) );?>
</p>
    <?php }?>
    <?php if ((isset($_smarty_tpl->tpl_vars['hotel_products']->value)) && $_smarty_tpl->tpl_vars['hotel_products']->value) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hotel_products']->value, 'product', false, 'data_k');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data_k']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
            <div class="row cart_product_line">
                <div class="col-sm-2 product-img-block">
                    <p>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['product']->value['cover_img'];?>
" class="img-responsive" />
                        </a>
                    </p>

                    <p class="product_remove_block">
                        <a id="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_option']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_product_option'];
} else { ?>0<?php }?>_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_hotel']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_hotel'];
} else { ?>0<?php }?>" class="cart_quantity_delete" href="<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);
$_prefixVariable57=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,NULL,"delete=1&amp;id_product=".$_prefixVariable57."&amp;token=".((string)$_smarty_tpl->tpl_vars['token_cart']->value)), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete'),$_smarty_tpl ) );?>
">
                            <i class="icon-trash"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove'),$_smarty_tpl ) );?>

                        </a>
                                            </p>
                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_141906367368e4f29036b071_68253946', 'displayCartProductImageAfter');
?>

                </div>
                <div class="col-sm-10">
                    <div class="product-info-container">
                        <div class="product-xs-img">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['product']->value['cover_img'];?>
" class="img-responsive" />
                            </a>
                        </div>
                        <div class="product-xs-info">
                            <p class="product-name">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['product']->value['name'];
if ((isset($_smarty_tpl->tpl_vars['product']->value['option_name'])) && $_smarty_tpl->tpl_vars['product']->value['option_name']) {?> : <?php echo $_smarty_tpl->tpl_vars['product']->value['option_name'];
}?>
                                </a>
                                <a class="btn btn-default pull-right product-xs-remove" href="<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);
$_prefixVariable58=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,NULL,"delete=1&amp;id_product=".$_prefixVariable58."&amp;ipa=0&amp;id_address_delivery=".((string)$_smarty_tpl->tpl_vars['product']->value['id_address_delivery'])."&amp;token=".((string)$_smarty_tpl->tpl_vars['token_cart']->value)), ENT_QUOTES, 'UTF-8', true);?>
"><i class="icon-trash"></i></a>
                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_204959478068e4f2903dc022_80907043', 'displayCartProductNameAfter');
?>

                            </p>

                            <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['hotel_info']['location']))) {?>
                                <p class="hotel-location">
                                    <i class="icon-map-marker"></i> &nbsp;<?php echo $_smarty_tpl->tpl_vars['product']->value['hotel_info']['location'];?>

                                </p>
                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_26155475668e4f2903fcc94_39997954', 'displayCartProductHotelLocationAfter');
?>

                            <?php }?>
                        </div>
                    </div>
                    <div class="row product_price_detail_block">
                        <div class="col-sm-7">
                            <div class="price_block col-xs-7">
                                <p class="total_price">
                                    <span>
                                        <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['product']->value['unit_price_tax_excl'])),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['product']->value['unit_price_tax_incl'])),$_smarty_tpl ) );
}?>
                                    </span>
                                </p>
                                <p class="total_price_detial">
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit price'),$_smarty_tpl ) );?>
 <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {
if ($_smarty_tpl->tpl_vars['priceDisplay']->value) {?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Excl.'),$_smarty_tpl ) );?>
 <?php } else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Incl.)'),$_smarty_tpl ) );
}?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'all taxes.)'),$_smarty_tpl ) );
}?>
                                </p>
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
                                <div class="col-xs-5">
                                    <div class="quantity_cont">
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['quantity'];?>
" name="quantity_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_option']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_product_option'];
} else { ?>0<?php }?>_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_hotel']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_hotel'];
} else { ?>0<?php }?>_hidden" />
                                        <input size="2" type="text" autocomplete="off" class="cart_quantity_input grey" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['quantity'];?>
"  name="quantity_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_option']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_product_option'];
} else { ?>0<?php }?>_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_hotel']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_hotel'];
} else { ?>0<?php }?>" />
                                        <div class="cart_quantity_button">
                                            <a rel="nofollow" class="cart_quantity_up btn btn-default" id="cart_quantity_up_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_option']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_product_option'];
} else { ?>0<?php }?>_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_hotel']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_hotel'];
} else { ?>0<?php }?>" href="<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);
$_prefixVariable59=ob_get_clean();
ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
$_prefixVariable60=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,NULL,"add=1&amp;id_product=".$_prefixVariable59."&amp;ipa=".$_prefixVariable60."&amp;id_address_delivery=0&amp;token=".((string)$_smarty_tpl->tpl_vars['token_cart']->value)), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add'),$_smarty_tpl ) );?>
"><span><i class="icon-plus"></i></span></a>
                                            <?php if ($_smarty_tpl->tpl_vars['product']->value['minimal_quantity'] < ($_smarty_tpl->tpl_vars['product']->value['quantity'])) {?>
                                                <a rel="nofollow" class="cart_quantity_down btn btn-default" id="cart_quantity_down_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_option']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_product_option'];
} else { ?>0<?php }?>_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_hotel']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_hotel'];
} else { ?>0<?php }?>" href="<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);
$_prefixVariable61=ob_get_clean();
ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
$_prefixVariable62=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,NULL,"add=1&amp;id_product=".$_prefixVariable61."&amp;ipa=".$_prefixVariable62."&amp;id_address_delivery=0&amp;op=down&amp;token=".((string)$_smarty_tpl->tpl_vars['token_cart']->value)), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Subtract'),$_smarty_tpl ) );?>
">
                                                    <span><i class="icon-minus"></i></span>
                                                </a>
                                            <?php } else { ?>
                                                <a class="cart_quantity_down btn btn-default disabled" href="#" id="cart_quantity_down_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_option']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_product_option'];
} else { ?>0<?php }?>_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_hotel']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_hotel'];
} else { ?>0<?php }?>" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You must purchase a minimum of %d of this product.','sprintf'=>1),$_smarty_tpl ) );?>
">
                                                    <span><i class="icon-minus"></i></span>
                                                </a>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                        <div class="col-sm-5">
                            <div class="total_price_block col-xs-12">
                                <p class="total_price">
                                    <span>
                                        <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['product']->value['total_price_tax_excl'])),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['product']->value['total_price_tax_incl'])),$_smarty_tpl ) );
}?>
                                    </span>
                                </p>
                                <p class="total_price_detial">
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total price'),$_smarty_tpl ) );?>
 <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {
if ($_smarty_tpl->tpl_vars['priceDisplay']->value) {?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Excl.'),$_smarty_tpl ) );?>
 <?php } else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Incl.)'),$_smarty_tpl ) );
}?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'all taxes.)'),$_smarty_tpl ) );
}?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
    <?php if ((isset($_smarty_tpl->tpl_vars['standalone_products']->value)) && $_smarty_tpl->tpl_vars['standalone_products']->value) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['standalone_products']->value, 'product', false, 'data_k');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['data_k']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
            <div class="row cart_product_line">
                <div class="col-sm-2 product-img-block">
                    <p>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['product']->value['cover_img'];?>
" class="img-responsive" />
                        </a>
                    </p>

                    <p class="product_remove_block">
                        <a id="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_option']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_product_option'];
} else { ?>0<?php }?>_0" class="cart_quantity_delete" href="<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);
$_prefixVariable63=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,NULL,"delete=1&amp;id_product=".$_prefixVariable63."&amp;token=".((string)$_smarty_tpl->tpl_vars['token_cart']->value)), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete'),$_smarty_tpl ) );?>
">
                            <i class="icon-trash"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove'),$_smarty_tpl ) );?>

                        </a>
                                            </p>
                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_30659065168e4f2905fa838_40643800', 'displayCartProductImageAfter');
?>


                </div>
                <div class="col-sm-10">
                    <div class="product-info-container">
                        <div class="product-xs-img">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['product']->value['cover_img'];?>
" class="img-responsive" />
                            </a>
                        </div>
                        <div class="product-xs-info">
                            <p class="product-name">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['product']->value['name'];
if ((isset($_smarty_tpl->tpl_vars['product']->value['option_name'])) && $_smarty_tpl->tpl_vars['product']->value['option_name']) {?> : <?php echo $_smarty_tpl->tpl_vars['product']->value['option_name'];
}?>
                                </a>
                                <a class="btn btn-default pull-right product-xs-remove" href="<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);
$_prefixVariable64=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,NULL,"delete=1&amp;id_product=".$_prefixVariable64."&amp;token=".((string)$_smarty_tpl->tpl_vars['token_cart']->value)), ENT_QUOTES, 'UTF-8', true);?>
"><i class="icon-trash"></i></a>
                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_58425627868e4f2906550e7_54714927', 'displayCartProductNameAfter');
?>

                            </p>
                        </div>
                    </div>
                    <div class="row product_price_detail_block">
                        <div class="col-sm-7">
                            <div class="price_block col-xs-7">
                                <p class="total_price">
                                    <span>
                                        <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['product']->value['unit_price_tax_excl'])),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['product']->value['unit_price_tax_incl'])),$_smarty_tpl ) );
}?>
                                    </span>
                                </p>
                                <p class="total_price_detial">
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit price'),$_smarty_tpl ) );?>
 <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {
if ($_smarty_tpl->tpl_vars['priceDisplay']->value) {?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Excl.'),$_smarty_tpl ) );?>
 <?php } else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Incl.)'),$_smarty_tpl ) );
}?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'all taxes.)'),$_smarty_tpl ) );
}?>
                                </p>
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
                                <div class="col-xs-5">
                                    <div class="quantity_cont">
                                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['quantity'];?>
" name="quantity_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_option']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_product_option'];
} else { ?>0<?php }?>_0_hidden" />
                                        <input size="2" type="text" autocomplete="off" class="cart_quantity_input grey" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['quantity'];?>
"  name="quantity_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_option']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_product_option'];
} else { ?>0<?php }?>_0" />
                                        <div class="cart_quantity_button">
                                            <a rel="nofollow" class="cart_quantity_up btn btn-default" id="cart_quantity_up_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_option']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_product_option'];
} else { ?>0<?php }?>_0" href="<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);
$_prefixVariable65=ob_get_clean();
ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
$_prefixVariable66=ob_get_clean();
ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);
$_prefixVariable67=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,NULL,"add=1&amp;id_product=".$_prefixVariable65."&amp;ipa=".$_prefixVariable66."&amp;id_address_delivery=".$_prefixVariable67."&amp;token=".((string)$_smarty_tpl->tpl_vars['token_cart']->value)), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add'),$_smarty_tpl ) );?>
"><span><i class="icon-plus"></i></span></a>
                                            <?php if ($_smarty_tpl->tpl_vars['product']->value['minimal_quantity'] < ($_smarty_tpl->tpl_vars['product']->value['quantity'])) {?>
                                                <a rel="nofollow" class="cart_quantity_down btn btn-default" id="cart_quantity_down_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_option']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_product_option'];
} else { ?>0<?php }?>_0" href="<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);
$_prefixVariable68=ob_get_clean();
ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);
$_prefixVariable69=ob_get_clean();
ob_start();
echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);
$_prefixVariable70=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,NULL,"add=1&amp;id_product=".$_prefixVariable68."&amp;ipa=".$_prefixVariable69."&amp;id_address_delivery=".$_prefixVariable70."&amp;op=down&amp;token=".((string)$_smarty_tpl->tpl_vars['token_cart']->value)), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Subtract'),$_smarty_tpl ) );?>
">
                                                    <span><i class="icon-minus"></i></span>
                                                </a>
                                            <?php } else { ?>
                                                <a class="cart_quantity_down btn btn-default disabled" href="#" id="cart_quantity_down_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_option']) {
echo $_smarty_tpl->tpl_vars['product']->value['id_product_option'];
} else { ?>0<?php }?>_0" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You must purchase a minimum of %d of this product.','sprintf'=>$_smarty_tpl->tpl_vars['product']->value['minimal_quantity']),$_smarty_tpl ) );?>
">
                                                    <span><i class="icon-minus"></i></span>
                                                </a>
                                            <?php }?>

                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                        <div class="col-sm-5">
                            <div class="total_price_block col-xs-12">
                                <p class="total_price">
                                    <span>
                                        <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['product']->value['total_price_tax_excl'])),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['product']->value['total_price_tax_incl'])),$_smarty_tpl ) );
}?>
                                    </span>
                                </p>
                                <p class="total_price_detial">
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total price'),$_smarty_tpl ) );?>
 <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {
if ($_smarty_tpl->tpl_vars['priceDisplay']->value) {?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Excl.'),$_smarty_tpl ) );?>
 <?php } else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Incl.)'),$_smarty_tpl ) );
}?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'all taxes.)'),$_smarty_tpl ) );
}?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_145583251568e4f2907ad344_20666495', 'displayCartProductContainerBottom');
?>

            </div>
            <hr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>

        <?php if (!$_smarty_tpl->tpl_vars['orderRestrictErr']->value) {?>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_212832893668e4f2907ca3e9_55967491', 'shopping_cart_proceed_action');
?>

    <?php }?>
</div>
<?php }
/* {block 'shopping_cart_heading'} */
class Block_37399683268e4f28fe3f665_54165527 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'shopping_cart_heading' => 
  array (
    0 => 'Block_37399683268e4f28fe3f665_54165527',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <p class="cart_section_title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'rooms information'),$_smarty_tpl ) );?>
</p>
        <?php
}
}
/* {/block 'shopping_cart_heading'} */
/* {block 'displayCartRoomImageAfter'} */
class Block_195567599968e4f28fea2590_94143908 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCartRoomImageAfter','id_product'=>$_smarty_tpl->tpl_vars['data_v']->value['id_product']),$_smarty_tpl ) );?>

                            <?php
}
}
/* {/block 'displayCartRoomImageAfter'} */
/* {block 'shopping_cart_room_type_cover_image'} */
class Block_34654584768e4f28fe68052_30489472 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'shopping_cart_room_type_cover_image' => 
  array (
    0 => 'Block_34654584768e4f28fe68052_30489472',
  ),
  'displayCartRoomImageAfter' => 
  array (
    0 => 'Block_195567599968e4f28fea2590_94143908',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <p>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['data_v']->value['id_product']);?>
">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['data_v']->value['cover_img'];?>
" class="img-responsive" />
                                </a>
                            </p>
                            <p class="room_remove_block">
                                <a class="cart_room_delete" href="<?php echo $_smarty_tpl->tpl_vars['rm_v']->value['link'];?>
" data-id_product="<?php echo $_smarty_tpl->tpl_vars['data_v']->value['id_product'];?>
" data-date_from="<?php echo $_smarty_tpl->tpl_vars['rm_v']->value['data_form'];?>
" data-date_to="<?php echo $_smarty_tpl->tpl_vars['rm_v']->value['data_to'];?>
" data-qty="<?php echo $_smarty_tpl->tpl_vars['rm_v']->value['num_rm'];?>
"><i class="icon-trash"></i> &nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove'),$_smarty_tpl ) );?>
</a>
                            </p>
                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_195567599968e4f28fea2590_94143908', 'displayCartRoomImageAfter', $this->tplIndex);
?>

                        <?php
}
}
/* {/block 'shopping_cart_room_type_cover_image'} */
/* {block 'shopping_cart_room_type_cover_image_mobile'} */
class Block_55483117368e4f28fec7498_07050248 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'shopping_cart_room_type_cover_image_mobile' => 
  array (
    0 => 'Block_55483117368e4f28fec7498_07050248',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <div class="product-xs-img">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['data_v']->value['id_product']);?>
">
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['data_v']->value['cover_img'];?>
" class="img-responsive" />
                                    </a>
                                </div>
                            <?php
}
}
/* {/block 'shopping_cart_room_type_cover_image_mobile'} */
/* {block 'displayCartRoomTypeNameAfter'} */
class Block_67927262568e4f28ff13ed5_61772833 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCartRoomTypeNameAfter','id_product'=>$_smarty_tpl->tpl_vars['data_v']->value['id_product']),$_smarty_tpl ) );?>

                                            <?php
}
}
/* {/block 'displayCartRoomTypeNameAfter'} */
/* {block 'shopping_cart_room_type_name'} */
class Block_210261337968e4f28fef0318_34271534 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                        <p class="product-name">
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['data_v']->value['id_product']);?>
">
                                                <?php echo $_smarty_tpl->tpl_vars['data_v']->value['name'];?>

                                            </a>
                                            <a class="btn btn-default pull-right product-xs-remove" href="<?php echo $_smarty_tpl->tpl_vars['rm_v']->value['link'];?>
"><i class="icon-trash"></i></a>
                                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_67927262568e4f28ff13ed5_61772833', 'displayCartRoomTypeNameAfter', $this->tplIndex);
?>

                                        </p>
                                    <?php
}
}
/* {/block 'shopping_cart_room_type_name'} */
/* {block 'shopping_cart_room_type_hotel_location'} */
class Block_30569843968e4f28ff28bd2_15024392 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                        <?php if ((isset($_smarty_tpl->tpl_vars['data_v']->value['hotel_info']['location']))) {?>
                                            <p class="hotel-location">
                                                <i class="icon-map-marker"></i> &nbsp;<?php echo $_smarty_tpl->tpl_vars['data_v']->value['hotel_info']['location'];?>

                                            </p>
                                        <?php }?>
                                    <?php
}
}
/* {/block 'shopping_cart_room_type_hotel_location'} */
/* {block 'displayCartRoomTypeInfo'} */
class Block_135433777068e4f2900041d5_57175822 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCartRoomTypeInfo','id_product'=>$_smarty_tpl->tpl_vars['data_v']->value['id_product']),$_smarty_tpl ) );?>

                                    <?php
}
}
/* {/block 'displayCartRoomTypeInfo'} */
/* {block 'shopping_cart_room_detail'} */
class Block_88823835168e4f28fee51a0_58731610 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'shopping_cart_room_detail' => 
  array (
    0 => 'Block_88823835168e4f28fee51a0_58731610',
  ),
  'shopping_cart_room_type_name' => 
  array (
    0 => 'Block_210261337968e4f28fef0318_34271534',
  ),
  'displayCartRoomTypeNameAfter' => 
  array (
    0 => 'Block_67927262568e4f28ff13ed5_61772833',
  ),
  'shopping_cart_room_type_hotel_location' => 
  array (
    0 => 'Block_30569843968e4f28ff28bd2_15024392',
  ),
  'displayCartRoomTypeInfo' => 
  array (
    0 => 'Block_135433777068e4f2900041d5_57175822',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <div class="product-xs-info">
                                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_210261337968e4f28fef0318_34271534', 'shopping_cart_room_type_name', $this->tplIndex);
?>

                                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_30569843968e4f28ff28bd2_15024392', 'shopping_cart_room_type_hotel_location', $this->tplIndex);
?>

                                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_135433777068e4f2900041d5_57175822', 'displayCartRoomTypeInfo', $this->tplIndex);
?>

                                </div>
                            <?php
}
}
/* {/block 'shopping_cart_room_detail'} */
/* {block 'shopping_cart_room_type_features'} */
class Block_182855886568e4f290016af0_98940637 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'shopping_cart_room_type_features' => 
  array (
    0 => 'Block_182855886568e4f290016af0_98940637',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <?php if ((isset($_smarty_tpl->tpl_vars['data_v']->value['hotel_info']['room_features']))) {?>
                                <div class="room-type-features">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data_v']->value['hotel_info']['room_features'], 'feature');
$_smarty_tpl->tpl_vars['feature']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['feature']->value) {
$_smarty_tpl->tpl_vars['feature']->do_else = false;
?>
                                    <span class="room-type-feature">
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['THEME_DIR']->value;?>
img/icon/form-ok-circle.svg" /> <?php echo $_smarty_tpl->tpl_vars['feature']->value['name'];?>

                                    </span>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </div>
                            <?php }?>
                        <?php
}
}
/* {/block 'shopping_cart_room_type_features'} */
/* {block 'shopping_cart_room_type_booking_information'} */
class Block_87718737168e4f290043cb4_49021070 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'shopping_cart_room_type_booking_information' => 
  array (
    0 => 'Block_87718737168e4f290043cb4_49021070',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

                            <?php $_smarty_tpl->_assignInScope('is_full_date', ($_smarty_tpl->tpl_vars['show_full_date']->value && (smarty_modifier_date_format($_smarty_tpl->tpl_vars['rm_v']->value['data_form'],'%D') == smarty_modifier_date_format($_smarty_tpl->tpl_vars['rm_v']->value['data_to'],'%D'))));?>
                            <div class="room_duration_block">
                                <div class="col-sm-3 col-xs-6">
                                    <p class="room_duration_block_head"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'CHECK IN'),$_smarty_tpl ) );?>
</p>
                                    <p class="room_duration_block_value"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rm_v']->value['data_form'],"%d %b, %a");
if ($_smarty_tpl->tpl_vars['is_full_date']->value) {?> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rm_v']->value['data_form'],"%H:%M");
}?></p>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <p class="room_duration_block_head"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'CHECK OUT'),$_smarty_tpl ) );?>
</p>
                                    <p class="room_duration_block_value"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rm_v']->value['data_to'],"%d %b, %a");
if ($_smarty_tpl->tpl_vars['is_full_date']->value) {?> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rm_v']->value['data_to'],"%H:%M");
}?></p>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <p class="room_duration_block_head"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'OCCUPANCY'),$_smarty_tpl ) );?>
</p>
                                    <p class="room_duration_block_value">
                                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['rm_v']->value['adults'];
$_prefixVariable55 = ob_get_clean();
if ($_prefixVariable55 <= 9) {?>0<?php echo $_smarty_tpl->tpl_vars['rm_v']->value['adults'];
} else {
echo $_smarty_tpl->tpl_vars['rm_v']->value['adults'];
}?> <?php if ($_smarty_tpl->tpl_vars['rm_v']->value['adults'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adults'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Adult'),$_smarty_tpl ) );
}
if ($_smarty_tpl->tpl_vars['rm_v']->value['children']) {?>, <?php if ($_smarty_tpl->tpl_vars['rm_v']->value['children'] <= 9) {?>0<?php echo $_smarty_tpl->tpl_vars['rm_v']->value['children'];
} else {
echo $_smarty_tpl->tpl_vars['rm_v']->value['children'];
}?> <?php if ($_smarty_tpl->tpl_vars['rm_v']->value['children'] > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Children'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Child'),$_smarty_tpl ) );
}
}?>, <?php ob_start();
echo $_smarty_tpl->tpl_vars['rm_v']->value['num_rm'];
$_prefixVariable56 = ob_get_clean();
if ($_prefixVariable56 <= 9) {?>0<?php }
echo $_smarty_tpl->tpl_vars['rm_v']->value['num_rm'];
if ($_smarty_tpl->tpl_vars['rm_v']->value['num_rm'] > 1) {?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rooms'),$_smarty_tpl ) );
} else { ?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room'),$_smarty_tpl ) );
}?>
                                    </p>
                                </div>
                            </div>
                        <?php
}
}
/* {/block 'shopping_cart_room_type_booking_information'} */
/* {block 'shopping_cart_room_type_and_service_price'} */
class Block_54679362868e4f290151b43_75035799 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                    <div class="col-sm-7 margin-btm-sm-10">
                                        <?php if ($_smarty_tpl->tpl_vars['rm_v']->value['amount'] && (isset($_smarty_tpl->tpl_vars['rm_v']->value['total_price_without_discount'])) && $_smarty_tpl->tpl_vars['rm_v']->value['total_price_without_discount'] > $_smarty_tpl->tpl_vars['rm_v']->value['amount']) {?>
                                            <span class="room_type_old_price">
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>floatval($_smarty_tpl->tpl_vars['rm_v']->value['total_price_without_discount'])),$_smarty_tpl ) );?>

                                            </span>
                                        <?php }?>
                                        <div class="row">
                                            <div class="<?php if (((isset($_smarty_tpl->tpl_vars['data_v']->value['extra_demands'])) && $_smarty_tpl->tpl_vars['data_v']->value['extra_demands']) || ((isset($_smarty_tpl->tpl_vars['data_v']->value['service_products'])) && $_smarty_tpl->tpl_vars['data_v']->value['service_products'])) {?>col-xs-6 plus-sign<?php } else { ?>col-xs-12<?php }?>">
                                                <div class="price_block">
                                                    <p class="total_price">
                                                        <span>
                                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['rm_v']->value['amount'])),$_smarty_tpl ) );?>

                                                        </span>
                                                        <?php if ((($_smarty_tpl->tpl_vars['rm_v']->value['amount']-$_smarty_tpl->tpl_vars['rm_v']->value['amount_without_auto_add']) > 0) && (in_array($_smarty_tpl->tpl_vars['data_v']->value['id_product'],$_smarty_tpl->tpl_vars['discounted_products']->value) || $_smarty_tpl->tpl_vars['PS_ROOM_PRICE_AUTO_ADD_BREAKDOWN']->value)) {?>
                                                            <span class="room-price-detail">
                                                                <img src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
icon/icon-info.svg" />
                                                            </span>
                                                            <div class="room-price-detail-container" style="display: none;">
                                                                <div class="room-price-detail-tooltip-cont">
                                                                    <div><label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Room price'),$_smarty_tpl ) );?>
</label> : <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['rm_v']->value['amount_without_auto_add'])),$_smarty_tpl ) );?>
</div>
                                                                    <div><label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Additional charges'),$_smarty_tpl ) );?>
</label> : <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['rm_v']->value['amount']-$_smarty_tpl->tpl_vars['rm_v']->value['amount_without_auto_add'])),$_smarty_tpl ) );?>
</div>
                                                                </div>
                                                            </div>
                                                        <?php }?>
                                                    </p>
                                                    <p class="total_price_detial">
                                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total rooms price'),$_smarty_tpl ) );?>
 <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {
if ($_smarty_tpl->tpl_vars['priceDisplay']->value) {?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Excl.'),$_smarty_tpl ) );?>
 <?php } else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Incl.)'),$_smarty_tpl ) );
}?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'all taxes.)'),$_smarty_tpl ) );
}?>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php if (((isset($_smarty_tpl->tpl_vars['data_v']->value['extra_demands'])) && $_smarty_tpl->tpl_vars['data_v']->value['extra_demands']) || ((isset($_smarty_tpl->tpl_vars['data_v']->value['service_products'])) && $_smarty_tpl->tpl_vars['data_v']->value['service_products'])) {?>
                                                <div class="col-xs-6">
                                                    <div class="demand_price_block">
                                                        <p class="demand_total_price">
                                                            <span>
                                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['rm_v']->value['demand_price']),$_smarty_tpl ) );?>

                                                            </span>
                                                        </p>
                                                        <p class="total_price_detial">
                                                            <a data-date_from="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['rm_v']->value['data_form'], ENT_QUOTES, 'UTF-8', true);?>
" data-date_to="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['rm_v']->value['data_to'], ENT_QUOTES, 'UTF-8', true);?>
" data-id_product="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['data_v']->value['id_product'], ENT_QUOTES, 'UTF-8', true);?>
" data-action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order-opc');?>
" class="open_rooms_extra_services_panel" href="#rooms_type_extra_services_form">
                                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Extra Services'),$_smarty_tpl ) );?>

                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                <?php
}
}
/* {/block 'shopping_cart_room_type_and_service_price'} */
/* {block 'shopping_cart_room_type_total_price'} */
class Block_24646185768e4f290278c49_96538180 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                    <div class="col-sm-5">
                                        <div class="total_price_block col-xs-12">
                                            <p class="total_price">
                                                <span>
                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['rm_v']->value['amount']+$_smarty_tpl->tpl_vars['rm_v']->value['demand_price'])),$_smarty_tpl ) );?>

                                                </span>
                                            </p>
                                            <p class="total_price_detial">
                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total price for'),$_smarty_tpl ) );?>
 <?php echo $_smarty_tpl->tpl_vars['rm_v']->value['num_days'];?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Night(s) stay'),$_smarty_tpl ) );
if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {
if ($_smarty_tpl->tpl_vars['priceDisplay']->value) {?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Excl.'),$_smarty_tpl ) );?>
 <?php } else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Incl.'),$_smarty_tpl ) );
}?> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'all taxes.)'),$_smarty_tpl ) );
}?>
                                            </p>
                                        </div>
                                    </div>
                                <?php
}
}
/* {/block 'shopping_cart_room_type_total_price'} */
/* {block 'shopping_cart_room_type_price_detail'} */
class Block_60347530168e4f29014fbb4_13897184 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'shopping_cart_room_type_price_detail' => 
  array (
    0 => 'Block_60347530168e4f29014fbb4_13897184',
  ),
  'shopping_cart_room_type_and_service_price' => 
  array (
    0 => 'Block_54679362868e4f290151b43_75035799',
  ),
  'shopping_cart_room_type_total_price' => 
  array (
    0 => 'Block_24646185768e4f290278c49_96538180',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <div class="row room_price_detail_block">
                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_54679362868e4f290151b43_75035799', 'shopping_cart_room_type_and_service_price', $this->tplIndex);
?>

                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_24646185768e4f290278c49_96538180', 'shopping_cart_room_type_total_price', $this->tplIndex);
?>

                            </div>
                        <?php
}
}
/* {/block 'shopping_cart_room_type_price_detail'} */
/* {block 'displayCartProductContentAfter'} */
class Block_187440920368e4f2902b6b93_19389594 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayCartProductContentAfter' => 
  array (
    0 => 'Block_187440920368e4f2902b6b93_19389594',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCartProductContentAfter','cart_detail'=>$_smarty_tpl->tpl_vars['data_v']->value,'key'=>$_smarty_tpl->tpl_vars['rm_k']->value),$_smarty_tpl ) );?>

                        <?php
}
}
/* {/block 'displayCartProductContentAfter'} */
/* {block 'displayCartProductAfter'} */
class Block_192904729668e4f2902c84c9_39157047 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayCartProductAfter' => 
  array (
    0 => 'Block_192904729668e4f2902c84c9_39157047',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCartProductAfter','cart_detail'=>$_smarty_tpl->tpl_vars['data_v']->value,'key'=>$_smarty_tpl->tpl_vars['rm_k']->value),$_smarty_tpl ) );?>

                <?php
}
}
/* {/block 'displayCartProductAfter'} */
/* {block 'displayAfterShoppingCartRoomsSummary'} */
class Block_115089877768e4f2902dae03_33021167 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayAfterShoppingCartRoomsSummary' => 
  array (
    0 => 'Block_115089877768e4f2902dae03_33021167',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayAfterShoppingCartRoomsSummary"),$_smarty_tpl ) );?>

	<?php
}
}
/* {/block 'displayAfterShoppingCartRoomsSummary'} */
/* {block 'displayCartProductImageAfter'} */
class Block_141906367368e4f29036b071_68253946 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayCartProductImageAfter' => 
  array (
    0 => 'Block_141906367368e4f29036b071_68253946',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCartProductImageAfter','id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product']),$_smarty_tpl ) );?>

                    <?php
}
}
/* {/block 'displayCartProductImageAfter'} */
/* {block 'displayCartProductNameAfter'} */
class Block_204959478068e4f2903dc022_80907043 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayCartProductNameAfter' => 
  array (
    0 => 'Block_204959478068e4f2903dc022_80907043',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCartProductNameAfter','id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product']),$_smarty_tpl ) );?>

                                <?php
}
}
/* {/block 'displayCartProductNameAfter'} */
/* {block 'displayCartProductHotelLocationAfter'} */
class Block_26155475668e4f2903fcc94_39997954 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayCartProductHotelLocationAfter' => 
  array (
    0 => 'Block_26155475668e4f2903fcc94_39997954',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCartProductHotelLocationAfter','id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product']),$_smarty_tpl ) );?>

                                <?php
}
}
/* {/block 'displayCartProductHotelLocationAfter'} */
/* {block 'displayCartProductImageAfter'} */
class Block_30659065168e4f2905fa838_40643800 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayCartProductImageAfter' => 
  array (
    0 => 'Block_30659065168e4f2905fa838_40643800',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCartProductImageAfter','id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product']),$_smarty_tpl ) );?>

                    <?php
}
}
/* {/block 'displayCartProductImageAfter'} */
/* {block 'displayCartProductNameAfter'} */
class Block_58425627868e4f2906550e7_54714927 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayCartProductNameAfter' => 
  array (
    0 => 'Block_58425627868e4f2906550e7_54714927',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCartProductNameAfter','id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product']),$_smarty_tpl ) );?>

                                <?php
}
}
/* {/block 'displayCartProductNameAfter'} */
/* {block 'displayCartProductContainerBottom'} */
class Block_145583251568e4f2907ad344_20666495 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayCartProductContainerBottom' => 
  array (
    0 => 'Block_145583251568e4f2907ad344_20666495',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCartProductContainerBottom','id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product']),$_smarty_tpl ) );?>

                <?php
}
}
/* {/block 'displayCartProductContainerBottom'} */
/* {block 'shopping_cart_proceed_action'} */
class Block_212832893668e4f2907ca3e9_55967491 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'shopping_cart_proceed_action' => 
  array (
    0 => 'Block_212832893668e4f2907ca3e9_55967491',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <div class="row">
                <div class="col-sm-12 proceed_btn_block">
                    <a class="btn btn-default button button-medium pull-right" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order-opc',null,null,array('proceed_to_customer_dtl'=>1));?>
" title="Proceed to checkout" rel="nofollow">
                        <span>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Proceed'),$_smarty_tpl ) );?>

                        </span>
                    </a>
                </div>
            </div>
        <?php
}
}
/* {/block 'shopping_cart_proceed_action'} */
}
