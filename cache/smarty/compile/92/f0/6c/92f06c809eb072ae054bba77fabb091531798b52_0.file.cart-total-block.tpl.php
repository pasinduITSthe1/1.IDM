<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:06
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\cart-total-block.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27aa25fc0_78127338',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92f06c809eb072ae054bba77fabb091531798b52' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\cart-total-block.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27aa25fc0_78127338 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>


<div class="col-sm-12 card cart_total_detail_block">
    <?php if ($_smarty_tpl->tpl_vars['total_rooms_wt']->value+$_smarty_tpl->tpl_vars['total_extra_demands_wt']->value+$_smarty_tpl->tpl_vars['total_additional_services_wt']->value+$_smarty_tpl->tpl_vars['total_additional_services_auto_add_wt']->value) {?>
        <p>
            <span>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total rooms cost'),$_smarty_tpl ) );?>

                <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
                    <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['priceDisplay']->value == 0) {?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax incl)'),$_smarty_tpl ) );?>

                    <?php } else { ?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax excl)'),$_smarty_tpl ) );?>

                    <?php }?>
                <?php }?>
            </span>
            <span class="cart_total_values">
                <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['priceDisplay']->value == 0) {?>
                    <?php $_smarty_tpl->_assignInScope('total_rooms_cost', ($_smarty_tpl->tpl_vars['total_rooms_wt']->value+$_smarty_tpl->tpl_vars['total_extra_demands_wt']->value+$_smarty_tpl->tpl_vars['total_additional_services_wt']->value+$_smarty_tpl->tpl_vars['total_additional_services_auto_add_wt']->value));?>
                <?php } else { ?>
                    <?php $_smarty_tpl->_assignInScope('total_rooms_cost', ($_smarty_tpl->tpl_vars['total_rooms']->value+$_smarty_tpl->tpl_vars['total_extra_demands']->value+$_smarty_tpl->tpl_vars['total_additional_services']->value+$_smarty_tpl->tpl_vars['total_additional_services_auto_add']->value));?>
                <?php }?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['total_rooms_cost']->value),$_smarty_tpl ) );?>

            </span>
        </p>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['total_standalone_service_products']->value) {?>
        <p>
            <span>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total products'),$_smarty_tpl ) );?>

                <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
                    <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['priceDisplay']->value == 0) {?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax incl)'),$_smarty_tpl ) );?>

                    <?php } else { ?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax excl)'),$_smarty_tpl ) );?>

                    <?php }?>
                <?php }?>
            </span>
            <span class="cart_total_values">
                <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['priceDisplay']->value == 0) {?>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['total_standalone_service_products_wt']->value),$_smarty_tpl ) );?>

                <?php } else { ?>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['total_standalone_service_products']->value),$_smarty_tpl ) );?>

                <?php }?>
            </span>
        </p>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['convenience_fee_wt']->value) {?>
        <p>
            <span>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Convenience Fees'),$_smarty_tpl ) );?>

                <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
                    <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['priceDisplay']->value == 0) {?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax incl)'),$_smarty_tpl ) );?>

                    <?php } else { ?>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(tax excl)'),$_smarty_tpl ) );?>

                    <?php }?>
                <?php }?>
            </span>
            <span class="cart_total_values">
            <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['priceDisplay']->value == 0) {?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['convenience_fee_wt']->value),$_smarty_tpl ) );?>

            <?php } else { ?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['convenience_fee']->value),$_smarty_tpl ) );?>

            <?php }?>
            </span>
        </p>
    <?php }?>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_113738723568e4f27a94e8d1_74392622', 'displayBeforeCartTotalTax');
?>

    <?php if ($_smarty_tpl->tpl_vars['show_taxes']->value) {?>
        <p class="cart_total_tax">
            <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total tax'),$_smarty_tpl ) );?>
</span>
            <span class="cart_total_values"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>($_smarty_tpl->tpl_vars['total_tax_without_discount']->value)),$_smarty_tpl ) );?>
</span>
        </p>
    <?php }?>
    <p class="total_discount_block <?php if ($_smarty_tpl->tpl_vars['total_discounts']->value == 0) {?>unvisible<?php }?>">
        <span>
            <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
                <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['priceDisplay']->value == 0) {?>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Discount (tax incl)'),$_smarty_tpl ) );?>

                <?php } else { ?>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Discount (tax excl)'),$_smarty_tpl ) );?>

                <?php }?>
            <?php } else { ?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Discount'),$_smarty_tpl ) );?>

            <?php }?>
        </span>
        <span class="cart_total_values">
            <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value && $_smarty_tpl->tpl_vars['priceDisplay']->value == 0) {?>
                <?php $_smarty_tpl->_assignInScope('total_discounts_negative', $_smarty_tpl->tpl_vars['total_discounts']->value*-1);?>
            <?php } else { ?>
                <?php $_smarty_tpl->_assignInScope('total_discounts_negative', $_smarty_tpl->tpl_vars['total_discounts_tax_exc']->value*-1);?>
            <?php }?>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['total_discounts_negative']->value),$_smarty_tpl ) );?>

        </span>
    </p>
        <hr>
        <p <?php if (!(isset($_smarty_tpl->tpl_vars['is_advance_payment']->value)) || !$_smarty_tpl->tpl_vars['is_advance_payment']->value) {?>class="cart_final_total_block"<?php }?>>
            <span class="strong"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total'),$_smarty_tpl ) );?>
</span>
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_135243305568e4f27a9bbaa8_23654806', 'displayCartTotalPriceLabelTotal');
?>

        <span class="cart_total_values <?php if ((isset($_smarty_tpl->tpl_vars['is_advance_payment']->value)) && $_smarty_tpl->tpl_vars['is_advance_payment']->value) {?> strong<?php }?>">
                <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value) {?>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['total_price']->value),$_smarty_tpl ) );?>

                <?php } else { ?>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['total_price_without_tax']->value),$_smarty_tpl ) );?>

                <?php }?>
            </span>
        </p>
        <?php if ((isset($_smarty_tpl->tpl_vars['is_advance_payment']->value)) && $_smarty_tpl->tpl_vars['is_advance_payment']->value) {?>
            <hr>
            <p>
                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Due Amount'),$_smarty_tpl ) );?>
</span>
                <span class="cart_total_values"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['dueAmount']->value),$_smarty_tpl ) );?>
</span>
            </p>
            <p class="cart_final_total_block">
                <span class="strong"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Partially Payable Total'),$_smarty_tpl ) );?>
</span>
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_57281423068e4f27aa07d07_96783968', 'displayCartTotalPriceLabelPartial');
?>

                <span class="cart_total_values"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['advPaymentAmount']->value),$_smarty_tpl ) );?>
</span>
            </p>
        <?php }?>
</div><?php }
/* {block 'displayBeforeCartTotalTax'} */
class Block_113738723568e4f27a94e8d1_74392622 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayBeforeCartTotalTax' => 
  array (
    0 => 'Block_113738723568e4f27a94e8d1_74392622',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayBeforeCartTotalTax'),$_smarty_tpl ) );?>

    <?php
}
}
/* {/block 'displayBeforeCartTotalTax'} */
/* {block 'displayCartTotalPriceLabelTotal'} */
class Block_135243305568e4f27a9bbaa8_23654806 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayCartTotalPriceLabelTotal' => 
  array (
    0 => 'Block_135243305568e4f27a9bbaa8_23654806',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayCartTotalPriceLabel",'type'=>'total'),$_smarty_tpl ) );?>

            <?php
}
}
/* {/block 'displayCartTotalPriceLabelTotal'} */
/* {block 'displayCartTotalPriceLabelPartial'} */
class Block_57281423068e4f27aa07d07_96783968 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayCartTotalPriceLabelPartial' => 
  array (
    0 => 'Block_57281423068e4f27aa07d07_96783968',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayCartTotalPriceLabel",'type'=>'partial'),$_smarty_tpl ) );?>

                <?php
}
}
/* {/block 'displayCartTotalPriceLabelPartial'} */
}
