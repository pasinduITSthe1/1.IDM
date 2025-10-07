<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:21
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\order-payment-advanced.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2897e1654_36942871',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '01de25377c424065dcc1c206720ab7724126dc44' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\order-payment-advanced.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2897e1654_36942871 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php if (!(isset($_smarty_tpl->tpl_vars['addresses_style']->value))) {?>
    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['addresses_style']) ? $_smarty_tpl->tpl_vars['addresses_style']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['company'] = 'address_company';
$_smarty_tpl->_assignInScope('addresses_style', $_tmp_array);?>
    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['addresses_style']) ? $_smarty_tpl->tpl_vars['addresses_style']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['firstname'] = 'address_name';
$_smarty_tpl->_assignInScope('addresses_style', $_tmp_array);?>
    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['addresses_style']) ? $_smarty_tpl->tpl_vars['addresses_style']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['lastname'] = 'address_name';
$_smarty_tpl->_assignInScope('addresses_style', $_tmp_array);?>
    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['addresses_style']) ? $_smarty_tpl->tpl_vars['addresses_style']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['address1'] = 'address_address1';
$_smarty_tpl->_assignInScope('addresses_style', $_tmp_array);?>
    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['addresses_style']) ? $_smarty_tpl->tpl_vars['addresses_style']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['address2'] = 'address_address2';
$_smarty_tpl->_assignInScope('addresses_style', $_tmp_array);?>
    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['addresses_style']) ? $_smarty_tpl->tpl_vars['addresses_style']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['city'] = 'address_city';
$_smarty_tpl->_assignInScope('addresses_style', $_tmp_array);?>
    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['addresses_style']) ? $_smarty_tpl->tpl_vars['addresses_style']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['country'] = 'address_country';
$_smarty_tpl->_assignInScope('addresses_style', $_tmp_array);?>
    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['addresses_style']) ? $_smarty_tpl->tpl_vars['addresses_style']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['phone'] = 'address_phone';
$_smarty_tpl->_assignInScope('addresses_style', $_tmp_array);?>
    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['addresses_style']) ? $_smarty_tpl->tpl_vars['addresses_style']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['phone_mobile'] = 'address_phone_mobile';
$_smarty_tpl->_assignInScope('addresses_style', $_tmp_array);?>
    <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['addresses_style']) ? $_smarty_tpl->tpl_vars['addresses_style']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['alias'] = 'address_title';
$_smarty_tpl->_assignInScope('addresses_style', $_tmp_array);
}
$_smarty_tpl->_assignInScope('have_non_virtual_products', false);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
    <?php if ($_smarty_tpl->tpl_vars['product']->value['is_virtual'] == 0) {?>
        <?php $_smarty_tpl->_assignInScope('have_non_virtual_products', true);?>
        <?php break 1;?>
    <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<?php $_block_plugin125 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin125, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtProduct'));
$_block_repeat=true;
echo $_block_plugin125->addJsDefL(array('name'=>'txtProduct'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin125->addJsDefL(array('name'=>'txtProduct'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin126 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin126, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'txtProducts'));
$_block_repeat=true;
echo $_block_plugin126->addJsDefL(array('name'=>'txtProducts'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Products','js'=>1),$_smarty_tpl ) );
$_block_repeat=false;
echo $_block_plugin126->addJsDefL(array('name'=>'txtProducts'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your shopping cart'),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

<?php if ($_smarty_tpl->tpl_vars['productNumber']->value == 0) {?>
<p class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your shopping cart is empty.'),$_smarty_tpl ) );?>
</p>
<?php } elseif ($_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
<p class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This store has not accepted your new order.'),$_smarty_tpl ) );?>
</p>
<?php } else { ?>
    <p id="emptyCartWarning" class="alert alert-warning unvisible"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your shopping cart is empty.'),$_smarty_tpl ) );?>
</p>
    <h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment Options'),$_smarty_tpl ) );?>
</h2>
    <!-- HOOK_ADVANCED_PAYMENT -->
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_65351508368e4f28968f8c7_49135279', 'advancedPaymentOptions');
?>

    <!-- end HOOK_ADVANCED_PAYMENT -->

    <?php if ($_smarty_tpl->tpl_vars['opc']->value) {?>
        <!-- Carrier -->
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19114134568e4f28974dbf7_53405048', 'order_carrier_advanced');
?>

        <!-- END Carrier -->
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['is_logged']->value && !$_smarty_tpl->tpl_vars['is_guest']->value) {?>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_153640813868e4f289770f50_62360135', 'order_address_advanced');
?>

    <?php } elseif ($_smarty_tpl->tpl_vars['opc']->value) {?>
        <!-- Create account / Guest account / Login block -->
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_170169609868e4f289783c81_79696440', 'order_opc_new_account_advanced');
?>

        <!-- END Create account / Guest account / Login block -->
    <?php }?>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_192737171668e4f289791811_63430193', 'order_payment_advanced_terms_and_conditions');
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_50004691568e4f2897ced29_25824239', 'shopping_cart_advanced');
?>

<?php }
}
/* {block 'advancedPaymentOptions'} */
class Block_65351508368e4f28968f8c7_49135279 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'advancedPaymentOptions' => 
  array (
    0 => 'Block_65351508368e4f28968f8c7_49135279',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <div id="HOOK_ADVANCED_PAYMENT">
            <div class="row">
            <!-- Should get a collection of "PaymentOption" object -->
            <?php $_smarty_tpl->_assignInScope('adv_payment_empty', true);?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['HOOK_ADVANCED_PAYMENT']->value, 'pay_option', false, 'key');
$_smarty_tpl->tpl_vars['pay_option']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['pay_option']->value) {
$_smarty_tpl->tpl_vars['pay_option']->do_else = false;
?>
                <?php if ($_smarty_tpl->tpl_vars['pay_option']->value) {?>
                    <?php $_smarty_tpl->_assignInScope('adv_payment_empty', false);?>
                <?php }?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php if ($_smarty_tpl->tpl_vars['HOOK_ADVANCED_PAYMENT']->value && !$_smarty_tpl->tpl_vars['adv_payment_empty']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['HOOK_ADVANCED_PAYMENT']->value, 'advanced_payment_opt_list');
$_smarty_tpl->tpl_vars['advanced_payment_opt_list']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['advanced_payment_opt_list']->value) {
$_smarty_tpl->tpl_vars['advanced_payment_opt_list']->do_else = false;
?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['advanced_payment_opt_list']->value, 'paymentOption');
$_smarty_tpl->tpl_vars['paymentOption']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['paymentOption']->value) {
$_smarty_tpl->tpl_vars['paymentOption']->do_else = false;
?>
                        <div class="col-xs-12 col-md-6">
                            <p class="payment_module pointer-box">
                                <a class="payment_module_adv">
                                    <img class="payment_option_logo" src="<?php echo $_smarty_tpl->tpl_vars['paymentOption']->value->getLogo();?>
"/>
                                    <span class="payment_option_cta">
                                        <?php echo $_smarty_tpl->tpl_vars['paymentOption']->value->getCallToActionText();?>

                                    </span>
                                    <span class="pull-right payment_option_selected">
                                        <i class="icon-check"></i>
                                    </span>
                                </a>

                            </p>
                            <div class="payment_option_form">
                                <?php if ($_smarty_tpl->tpl_vars['paymentOption']->value->getForm()) {?>
                                    <?php echo $_smarty_tpl->tpl_vars['paymentOption']->value->getForm();?>

                                <?php } else { ?>
                                    <form method="<?php if ($_smarty_tpl->tpl_vars['paymentOption']->value->getMethod()) {
echo $_smarty_tpl->tpl_vars['paymentOption']->value->getMethod();
} else { ?>POST<?php }?>" action="<?php echo $_smarty_tpl->tpl_vars['paymentOption']->value->getAction();?>
">
                                        <?php if ($_smarty_tpl->tpl_vars['paymentOption']->value->getInputs()) {?>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['paymentOption']->value->getInputs(), 'value', false, 'name');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['name']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                                                <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
">
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        <?php }?>
                                    </form>
                                <?php }?>
                            </div>
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
            <?php } else { ?>
            <div class="col-xs-12 col-md-12">
                <p class="alert alert-warning "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Unable to find any available payment option for your cart. Please contact us if the problem persists'),$_smarty_tpl ) );?>
</p>
            </div>
            <?php }?>
        </div>
    <?php
}
}
/* {/block 'advancedPaymentOptions'} */
/* {block 'order_carrier_advanced'} */
class Block_19114134568e4f28974dbf7_53405048 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_carrier_advanced' => 
  array (
    0 => 'Block_19114134568e4f28974dbf7_53405048',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-carrier-advanced.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        <?php
}
}
/* {/block 'order_carrier_advanced'} */
/* {block 'order_address_advanced'} */
class Block_153640813868e4f289770f50_62360135 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_address_advanced' => 
  array (
    0 => 'Block_153640813868e4f289770f50_62360135',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-address-advanced.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        <?php
}
}
/* {/block 'order_address_advanced'} */
/* {block 'order_opc_new_account_advanced'} */
class Block_170169609868e4f289783c81_79696440 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_opc_new_account_advanced' => 
  array (
    0 => 'Block_170169609868e4f289783c81_79696440',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-opc-new-account-advanced.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        <?php
}
}
/* {/block 'order_opc_new_account_advanced'} */
/* {block 'order_payment_advanced_terms_and_conditions'} */
class Block_192737171668e4f289791811_63430193 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_payment_advanced_terms_and_conditions' => 
  array (
    0 => 'Block_192737171668e4f289791811_63430193',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <!-- TNC -->
        <?php if ($_smarty_tpl->tpl_vars['conditions']->value && $_smarty_tpl->tpl_vars['cms_id']->value) {?>
            <?php if ($_smarty_tpl->tpl_vars['override_tos_display']->value) {?>
                <?php echo $_smarty_tpl->tpl_vars['override_tos_display']->value;?>

            <?php } else { ?>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Terms and Conditions'),$_smarty_tpl ) );?>
</h2>
                        <div class="box">
                            <p class="checkbox">
                                <input type="checkbox" name="cgv" id="cgv" value="1" <?php if ($_smarty_tpl->tpl_vars['checkedTOS']->value) {?>checked="checked"<?php }?> />
                                <label for="cgv"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'I agree to the terms of service and will adhere to them unconditionally.'),$_smarty_tpl ) );?>
</label>
                                <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link_conditions']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="iframe" rel="nofollow"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Read the Terms of Service)'),$_smarty_tpl ) );?>
</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php }?>
        <?php }?>
        <!-- end TNC -->
    <?php
}
}
/* {/block 'order_payment_advanced_terms_and_conditions'} */
/* {block 'shopping_cart_advanced'} */
class Block_50004691568e4f2897ced29_25824239 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'shopping_cart_advanced' => 
  array (
    0 => 'Block_50004691568e4f2897ced29_25824239',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./shopping-cart-advanced.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    <?php
}
}
/* {/block 'shopping_cart_advanced'} */
}
