<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:16
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\localization\content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2841298e3_04875673',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c63e2695307b96271a9a7a3a694911c5d205e0f6' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\localization\\content.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2841298e3_04875673 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['localization_form']->value))) {
echo $_smarty_tpl->tpl_vars['localization_form']->value;
}
if ((isset($_smarty_tpl->tpl_vars['localization_options']->value))) {
echo $_smarty_tpl->tpl_vars['localization_options']->value;
}
echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function() {
		$('#PS_CURRENCY_DEFAULT').change(function(e) {
			alert('Before changing default currency, we strongly recommend that you enable maintenance mode from Preferences > Maintenance page because any change in default currency requires manual adjustment of price of each room type.');
		});
	});
<?php echo '</script'; ?>
><?php }
}
