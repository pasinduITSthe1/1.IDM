<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:33
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\_print_pdf_icon.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2952f26f0_14364942',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '059ff636db642fa15b08c0fcf3e92f1b1274b8d5' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\_print_pdf_icon.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2952f26f0_14364942 (Smarty_Internal_Template $_smarty_tpl) {
?>
<span class="btn-group-action">
	<span class="btn-group">
	<?php if (Configuration::get('PS_INVOICE') && $_smarty_tpl->tpl_vars['order']->value->invoice_number) {?>
		<a class="btn btn-default _blank" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminPdf'), ENT_QUOTES, 'UTF-8', true);?>
&amp;submitAction=generateInvoicePDF&amp;id_order=<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
">
			<i class="icon-file-text"></i>
		</a>
	<?php }?>
			</span>
</span>
<?php }
}
