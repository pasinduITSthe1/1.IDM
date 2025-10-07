<?php
/* Smarty version 4.5.5, created on 2025-10-07 16:33:15
  from 'C:\wamp64\www\1.IDM\modules\hotelreservationsystem\views\templates\hook\display-nav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f3733bec14_35103628',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '732cbba1f0af5c496e116b4daed6b5587545c414' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\hotelreservationsystem\\views\\templates\\hook\\display-nav.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f3733bec14_35103628 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['email']->value != '') {?>
    <div class="contact-item">
        <i class="icon-envelope-o"></i>
        <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['email']->value;?>
</a>
    </div>
<?php }
if ($_smarty_tpl->tpl_vars['phone']->value != '') {?>
    <div class="contact-item">
        <i class="icon-phone"></i>
        <a href="tel:<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
</a>
    </div>
<?php }
}
}
