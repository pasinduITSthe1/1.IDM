<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:12
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\modules\blockuserinfo\nav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f280931af5_96216968',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '085e1227aefa576b93821f84dbec960b06e75d9d' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\modules\\blockuserinfo\\nav.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f280931af5_96216968 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_138998670268e4f280856df8_42618084', 'user_navigation');
?>

<?php }
/* {block 'displayUserNavigationList'} */
class Block_136225641368e4f2808dfbe7_23263526 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayUserNavigationList'),$_smarty_tpl ) );?>

                        <?php
}
}
/* {/block 'displayUserNavigationList'} */
/* {block 'user_navigation'} */
class Block_138998670268e4f280856df8_42618084 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'user_navigation' => 
  array (
    0 => 'Block_138998670268e4f280856df8_42618084',
  ),
  'displayUserNavigationList' => 
  array (
    0 => 'Block_136225641368e4f2808dfbe7_23263526',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if (!(isset($_smarty_tpl->tpl_vars['ajaxCustomerLogin']->value))) {?>
        <div class="header-top-item header_user_info hidden-xs">
    <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
            <ul class="navbar-nav hidden-xs">
                <li class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="user_info_acc" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="account_user_name hide_xs"><?php echo $_smarty_tpl->tpl_vars['cookie']->value->customer_firstname;?>
</span>
                        <span class="account_user_name visi_xs"><i class="icon-user"></i></span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="user_info_acc">
                        <li><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View my customer account','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Accounts','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</a></li>
                        <li><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('history',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Bookings','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Bookings','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</a></li>
                        <li><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,NULL,"mylogout=1&token=".((string)$_smarty_tpl->tpl_vars['static_token']->value)), ENT_QUOTES, 'UTF-8', true);?>
"  title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log me out','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Logout','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</a></li>
                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_136225641368e4f2808dfbe7_23263526', 'displayUserNavigationList', $this->tplIndex);
?>

                    </ul>
                </li>
            </ul>
        <?php } else { ?>
            <a class="header-top-link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in to your customer account','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
">
                <span class="hide_xs"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign in','mod'=>'blockuserinfo'),$_smarty_tpl ) );?>
</span>
                <span class="visi_xs"><i class="icon-user"></i></span>
            </a>
        <?php }?>
    <?php if (!(isset($_smarty_tpl->tpl_vars['ajaxCustomerLogin']->value))) {?>
        </div>
    <?php }
}
}
/* {/block 'user_navigation'} */
}
