<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:19
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\modules_catalog\content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f287a74ab0_22886791',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '257b97e6b2092e8137dfaea37acc83cd03fffe15' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\modules_catalog\\content.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:recomended-banner.tpl' => 1,
    'file:controllers/modules_catalog/page.tpl' => 1,
  ),
),false)) {
function content_68e4f287a74ab0_22886791 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>
<div id="ajaxBox" style="display:none"></div>

<?php $_smarty_tpl->_subTemplateRender('file:recomended-banner.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
	<div class="col-lg-12">
		<?php $_smarty_tpl->_subTemplateRender('file:controllers/modules_catalog/page.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	</div>
</div><?php }
}
