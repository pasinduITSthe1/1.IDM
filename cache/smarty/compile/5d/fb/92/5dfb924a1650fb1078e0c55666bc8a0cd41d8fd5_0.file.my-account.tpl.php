<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:13
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\my-account.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2812894e3_30186965',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5dfb924a1650fb1078e0c55666bc8a0cd41d8fd5' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\my-account.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2812894e3_30186965 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_133939094068e4f2810fd411_69636576', 'my_account');
?>

<?php }
/* {block 'my_account_heading'} */
class Block_136512961168e4f281110cd7_97868033 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <h1 class="page-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My account'),$_smarty_tpl ) );?>
</h1>
        <?php if ((isset($_smarty_tpl->tpl_vars['account_created']->value))) {?>
            <p class="alert alert-success">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your account has been created.'),$_smarty_tpl ) );?>

            </p>
        <?php }?>
        <p class="info-account"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Welcome to your account. Here you can manage all of your personal information and orders.'),$_smarty_tpl ) );?>
</p>
    <?php
}
}
/* {/block 'my_account_heading'} */
/* {block 'my_account_tabs'} */
class Block_214651298768e4f28113c443_25701629 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <ul class="myaccount-link-list">
                    <li><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('address',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Address'),$_smarty_tpl ) );?>
"><i class="icon-building"></i><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Address'),$_smarty_tpl ) );?>
</span></a></li>
                    <li><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('history',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Bookings'),$_smarty_tpl ) );?>
"><i class="icon-list-ol"></i><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Bookings'),$_smarty_tpl ) );?>
</span></a></li>
                    <?php if ($_smarty_tpl->tpl_vars['refundAllowed']->value) {?>
                        <li><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('order-follow',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refund requests'),$_smarty_tpl ) );?>
"><i class="icon-refresh"></i><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refund requests'),$_smarty_tpl ) );?>
</span></a></li>
                    <?php }?>
                    <li><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('order-slip',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Credit slips'),$_smarty_tpl ) );?>
"><i class="icon-file-o"></i><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Credit slips'),$_smarty_tpl ) );?>
</span></a></li>
                    <li><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('identity',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Personal information'),$_smarty_tpl ) );?>
"><i class="icon-user"></i><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Personal information'),$_smarty_tpl ) );?>
</span></a></li>
                </ul>
            <?php
}
}
/* {/block 'my_account_tabs'} */
/* {block 'displayCustomerAccount'} */
class Block_121466649668e4f28120e011_52583336 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php if ($_smarty_tpl->tpl_vars['voucherAllowed']->value || (isset($_smarty_tpl->tpl_vars['HOOK_CUSTOMER_ACCOUNT']->value)) && $_smarty_tpl->tpl_vars['HOOK_CUSTOMER_ACCOUNT']->value != '') {?>
                <div class="col-xs-12 col-sm-6 col-lg-4">
                    <ul class="myaccount-link-list">
                        <?php if ($_smarty_tpl->tpl_vars['voucherAllowed']->value) {?>
                            <li><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('discount',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Vouchers'),$_smarty_tpl ) );?>
"><i class="icon-barcode"></i><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Vouchers'),$_smarty_tpl ) );?>
</span></a></li>
                        <?php }?>
                        <?php echo $_smarty_tpl->tpl_vars['HOOK_CUSTOMER_ACCOUNT']->value;?>

                    </ul>
                </div>
            <?php }?>
        <?php
}
}
/* {/block 'displayCustomerAccount'} */
/* {block 'displayCustomerAccountAfterTabs'} */
class Block_155756441168e4f28124f8a4_68084102 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCustomerAccountAfterTabs'),$_smarty_tpl ) );?>

    <?php
}
}
/* {/block 'displayCustomerAccountAfterTabs'} */
/* {block 'my_account_footer_links'} */
class Block_106332135768e4f281261ef5_36660019 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <ul class="footer_links clearfix">
        <li><a class="btn btn-default button button-small" href="<?php if ((isset($_smarty_tpl->tpl_vars['force_ssl']->value)) && $_smarty_tpl->tpl_vars['force_ssl']->value) {
echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;
} else {
echo $_smarty_tpl->tpl_vars['base_dir']->value;
}?>" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Home'),$_smarty_tpl ) );?>
"><span><i class="icon-chevron-left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Home'),$_smarty_tpl ) );?>
</span></a></li>
        </ul>
    <?php
}
}
/* {/block 'my_account_footer_links'} */
/* {block 'my_account'} */
class Block_133939094068e4f2810fd411_69636576 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'my_account' => 
  array (
    0 => 'Block_133939094068e4f2810fd411_69636576',
  ),
  'my_account_heading' => 
  array (
    0 => 'Block_136512961168e4f281110cd7_97868033',
  ),
  'my_account_tabs' => 
  array (
    0 => 'Block_214651298768e4f28113c443_25701629',
  ),
  'displayCustomerAccount' => 
  array (
    0 => 'Block_121466649668e4f28120e011_52583336',
  ),
  'displayCustomerAccountAfterTabs' => 
  array (
    0 => 'Block_155756441168e4f28124f8a4_68084102',
  ),
  'my_account_footer_links' => 
  array (
    0 => 'Block_106332135768e4f281261ef5_36660019',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My account'),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_136512961168e4f281110cd7_97868033', 'my_account_heading', $this->tplIndex);
?>

    <div class="row addresses-lists">
        <div class="col-xs-12 col-sm-6 col-lg-4">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_214651298768e4f28113c443_25701629', 'my_account_tabs', $this->tplIndex);
?>

        </div>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_121466649668e4f28120e011_52583336', 'displayCustomerAccount', $this->tplIndex);
?>

    </div>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_155756441168e4f28124f8a4_68084102', 'displayCustomerAccountAfterTabs', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_106332135768e4f281261ef5_36660019', 'my_account_footer_links', $this->tplIndex);
?>


<?php
}
}
/* {/block 'my_account'} */
}
