<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:32
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\_partials\order-standalone-service-detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29404c048_37716460',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '705cce2c9bff40e70cf40ebbac101d63f9d19533' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\_partials\\order-standalone-service-detail.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29404c048_37716460 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>


<div class="product-detail" data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
">
    <div class="row">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_37019824568e4f293e439a6_27074758', 'order_standalone_product_image');
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_105066233668e4f293e84a03_11682829', 'order_standalone_product_detail');
?>

    </div>
</div><?php }
/* {block 'order_standalone_product_image'} */
class Block_37019824568e4f293e439a6_27074758 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_standalone_product_image' => 
  array (
    0 => 'Block_37019824568e4f293e439a6_27074758',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <div class="col-xs-3 col-sm-2">
                <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" target="_blank">
                    <img class="img img-responsive img-room-type" src="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['cover_img'], ENT_QUOTES, 'UTF-8', true);?>
" />
                </a>
            </div>
        <?php
}
}
/* {/block 'order_standalone_product_image'} */
/* {block 'order_standalone_product_detail'} */
class Block_105066233668e4f293e84a03_11682829 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_standalone_product_detail' => 
  array (
    0 => 'Block_105066233668e4f293e84a03_11682829',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <div class="col-xs-9 col-sm-10 info-wrap">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" target="_blank" class="product-name">
                            <h3><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);
if ($_smarty_tpl->tpl_vars['product']->value['option_name']) {?> : <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['product']->value['option_name'], ENT_QUOTES, 'UTF-8', true);
}?></h3>
                        </a>
                        <?php if ($_smarty_tpl->tpl_vars['product']->value['is_refunded'] || $_smarty_tpl->tpl_vars['product']->value['is_cancelled']) {?>
                            <div class="num-refunded-rooms">
                                <?php if ($_smarty_tpl->tpl_vars['product']->value['is_cancelled']) {?>
                                    <span class="badge badge-danger">
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancelled'),$_smarty_tpl ) );?>

                                    </span>
                                <?php } else { ?>
                                    <span class="badge badge-danger">
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refunded'),$_smarty_tpl ) );?>

                                    </span>
                                <?php }?>
                            </div>
                        <?php }?>
                    </div>
                    <div class="col-xs-12">
                        <div class="description-list">
                            <dl class="">
                                <div class="row">
                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="row">
                                                <dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity'),$_smarty_tpl ) );?>
</dt>
                                                <dd class="col-xs-7"><?php echo $_smarty_tpl->tpl_vars['product']->value['quantity'];?>
</dd>
                                            </div>
                                        </div>
                                    <?php }?>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="row">
                                            <dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unit Price'),$_smarty_tpl ) );?>
</dt>
                                            <dd class="col-xs-7">
                                                <?php if ($_smarty_tpl->tpl_vars['group_use_tax']->value) {?>
                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['unit_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl ) );?>

                                                <?php } else { ?>
                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['unit_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl ) );?>

                                                <?php }?>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['allow_multiple_quantity']) {?>
                                        <div class="col-xs-12 col-md-6">
                                        </div>
                                    <?php }?>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="row">
                                            <dt class="col-xs-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Pricing'),$_smarty_tpl ) );?>
</dt>
                                            <dd class="col-xs-7">
                                                <?php if ($_smarty_tpl->tpl_vars['group_use_tax']->value) {?>
                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_price_tax_incl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl ) );?>

                                                <?php } else { ?>
                                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPriceWithCurrency'][0], array( array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_price_tax_excl'],'currency'=>$_smarty_tpl->tpl_vars['currency']->value),$_smarty_tpl ) );?>

                                                <?php }?>
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        <?php
}
}
/* {/block 'order_standalone_product_detail'} */
}
