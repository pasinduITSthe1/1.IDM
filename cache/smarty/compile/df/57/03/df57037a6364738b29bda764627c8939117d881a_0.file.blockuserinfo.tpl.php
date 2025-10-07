<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:12
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\modules\blockuserinfo\blockuserinfo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2807ae2e2_94288608',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df57037a6364738b29bda764627c8939117d881a' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\modules\\blockuserinfo\\blockuserinfo.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2807ae2e2_94288608 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- Block user information module HEADER -->
<div id="header_user" <?php if ($_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>class="header_user_catalog"<?php }?>>
	<ul id="header_nav">
		<?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
		<li id="shopping_cart">
			<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink($_smarty_tpl->tpl_vars['order_process']->value,true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View my shopping cart','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
" rel="nofollow"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cart','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>

			<span class="ajax_cart_quantity<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value == 0) {?> hidden<?php }?>"><?php echo $_smarty_tpl->tpl_vars['cart_qties']->value;?>
</span>
			<span class="ajax_cart_product_txt<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value != 1) {?> hidden<?php }?>"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</span>
			<span class="ajax_cart_product_txt_s<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value < 2) {?> hidden<?php }?>"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Products','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</span>
			<span class="ajax_cart_total<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value == 0) {?> hidden<?php }?>">
				<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value > 0) {?>
					<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value == 1) {?>
						<?php $_smarty_tpl->_assignInScope('blockuser_cart_flag', constant('Cart::BOTH_WITHOUT_SHIPPING'));?>
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false,$_smarty_tpl->tpl_vars['blockuser_cart_flag']->value)),$_smarty_tpl ) );?>

					<?php } else { ?>
						<?php $_smarty_tpl->_assignInScope('blockuser_cart_flag', constant('Cart::BOTH_WITHOUT_SHIPPING'));?>
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(true,$_smarty_tpl->tpl_vars['blockuser_cart_flag']->value)),$_smarty_tpl ) );?>

					<?php }?>
				<?php }?>
			</span>
			<span class="ajax_cart_no_product<?php if ($_smarty_tpl->tpl_vars['cart_qties']->value > 0) {?> hidden<?php }?>"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(empty)','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</span>
			</a>
		</li>
		<?php }?>
		<li id="your_account"><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View my customer account','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
" rel="nofollow"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your Account','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</a></li>
	</ul>
	<p id="header_user_info">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Welcome','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>

		<?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
			<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View my customer account','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
" class="account" rel="nofollow"><span><?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_lastname;?>
</span></a>
			<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,NULL,"mylogout=1&token=".((string)$_smarty_tpl->tpl_vars['static_token']->value)), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log me out','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
" class="logout" rel="nofollow"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign out','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</a>
		<?php } else { ?>
			<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in to your customer account','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
" class="login" rel="nofollow"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign in','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</a>
		<?php }?>
	</p>
</div>
<!-- /Block user information module HEADER -->
<?php }
}
