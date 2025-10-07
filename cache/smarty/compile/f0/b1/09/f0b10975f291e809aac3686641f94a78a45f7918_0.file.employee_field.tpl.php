<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:16
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\logs\employee_field.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f28472d1e4_87312409',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f0b10975f291e809aac3686641f94a78a45f7918' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\logs\\employee_field.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f28472d1e4_87312409 (Smarty_Internal_Template $_smarty_tpl) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['employee_name']->value, ENT_QUOTES, 'UTF-8', true);?>

<br />
(<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['employee_email']->value, ENT_QUOTES, 'UTF-8', true);?>
)
<?php }
}
