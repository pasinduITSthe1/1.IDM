<?php
/* Smarty version 4.5.5, created on 2025-10-07 16:33:12
  from 'C:\wamp64\www\1.IDM\modules\blockuserinfo\nav-xs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f3701d6df6_52929776',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12c59e49d8194e157da64f41df4fea3ebeda6dd0' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\blockuserinfo\\nav-xs.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f3701d6df6_52929776 (Smarty_Internal_Template $_smarty_tpl) {
?>
<ul class="nav nav-pills nav-stacked visible-xs wk-nav-style">
	<?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
		<li>
			<a class="navigation-link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('history',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Bookings','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Bookings','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</a>
		</li>
		<li>
			<a class="navigation-link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View my customer account','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Accounts Settings','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</a>
		</li>
		<li>
			<a class="navigation-link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,NULL,"mylogout=1&token=".((string)$_smarty_tpl->tpl_vars['static_token']->value)), ENT_QUOTES, 'UTF-8', true);?>
"  title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log me out','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign Out','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</a>
		</li>
	<?php } else { ?>
		<li>
			<a class="navigation-link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in to your customer account','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign in','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</a>
		</li>
	<?php }?>
</ul><?php }
}
