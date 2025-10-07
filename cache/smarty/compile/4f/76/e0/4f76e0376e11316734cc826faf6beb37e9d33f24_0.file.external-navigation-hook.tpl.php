<?php
/* Smarty version 4.5.5, created on 2025-10-07 16:33:11
  from 'C:\wamp64\www\1.IDM\modules\hotelreservationsystem\views\templates\hook\external-navigation-hook.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f36f6c3af8_43073187',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4f76e0376e11316734cc826faf6beb37e9d33f24' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\hotelreservationsystem\\views\\templates\\hook\\external-navigation-hook.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f36f6c3af8_43073187 (Smarty_Internal_Template $_smarty_tpl) {
if (($_smarty_tpl->tpl_vars['email']->value != '') || ($_smarty_tpl->tpl_vars['phone']->value != '')) {?>
    <ul class="nav nav-pills nav-stacked visible-xs wk-nav-style">
        <?php if ($_smarty_tpl->tpl_vars['email']->value != '') {?>
            <li>
                <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
">
                    <i class="icon-envelope-o"></i>
                    <?php echo $_smarty_tpl->tpl_vars['email']->value;?>

                </a>
            </li>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['phone']->value != '') {?>
            <li>
                <a href="tel:<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
">
                    <i class="icon-phone"></i>
                    <?php echo $_smarty_tpl->tpl_vars['phone']->value;?>

                </a>
            </li>
        <?php }?>
    </ul>
<?php }
}
}
