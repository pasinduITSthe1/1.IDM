<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:06
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\breadcrumb.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27a7e8784_29023165',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '47e9eec52a77f007fb902d44117a4e72da5b8815' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\breadcrumb.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27a7e8784_29023165 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),1=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.regex_replace.php','function'=>'smarty_modifier_regex_replace',),));
?>

<!-- Breadcrumb -->
<?php if ((($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'path') !== null ))) {
$_smarty_tpl->_assignInScope('path', $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'path'));
}?>
<div class="breadcrumb clearfix">
	<a class="home" href="<?php if ((isset($_smarty_tpl->tpl_vars['force_ssl']->value)) && $_smarty_tpl->tpl_vars['force_ssl']->value) {
echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;
} else {
echo $_smarty_tpl->tpl_vars['base_dir']->value;
}?>" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Return to Home'),$_smarty_tpl ) );?>
"><i class="icon-home"></i></a>
	<?php if ((isset($_smarty_tpl->tpl_vars['path']->value)) && $_smarty_tpl->tpl_vars['path']->value) {?>
		<span class="navigation-pipe"<?php if ((isset($_smarty_tpl->tpl_vars['category']->value)) && (isset($_smarty_tpl->tpl_vars['category']->value->id_category)) && $_smarty_tpl->tpl_vars['category']->value->id_category == (int)Configuration::get('PS_ROOT_CATEGORY')) {?> style="display:none;"<?php }?>><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['navigationPipe']->value, ENT_QUOTES, 'UTF-8', true);?>
</span>
		<?php if (strpos($_smarty_tpl->tpl_vars['path']->value,'span') !== false) {?>
			<span class="navigation_page"><?php echo smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['path']->value,'<a ','<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" '),'data-gg="">','><span itemprop="title">'),'</a>','</span></a></span>');?>
</span>
		<?php } else { ?>
			<?php echo $_smarty_tpl->tpl_vars['path']->value;?>

		<?php }?>
	<?php }?>
</div>
<?php if ((isset($_GET['search_query'])) && (isset($_GET['results'])) && $_GET['results'] > 1 && (isset($_SERVER['HTTP_REFERER']))) {?>
<div class="pull-right">
	<strong>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', null, null);
if ((isset($_GET['HTTP_REFERER'])) && $_GET['HTTP_REFERER']) {
echo $_GET['HTTP_REFERER'];
} elseif ((isset($_SERVER['HTTP_REFERER'])) && $_SERVER['HTTP_REFERER']) {
echo $_SERVER['HTTP_REFERER'];
}
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<a href="<?php echo smarty_modifier_regex_replace(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'secureReferrer' ][ 0 ], array( htmlspecialchars((string)$_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'default'), ENT_QUOTES, 'UTF-8', true) )),'/[\?|&]content_only=1/','');?>
" name="back">
			<i class="icon-chevron-left left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Back to Search results for "%s" (%d other results)','sprintf'=>array($_GET['search_query'],$_GET['results'])),$_smarty_tpl ) );?>

		</a>
	</strong>
</div>
<?php }?>
<!-- /Breadcrumb -->
<?php }
}
