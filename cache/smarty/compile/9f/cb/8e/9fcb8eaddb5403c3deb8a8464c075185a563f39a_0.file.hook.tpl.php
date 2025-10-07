<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:09
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\hook.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27d161e52_08927891',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9fcb8eaddb5403c3deb8a8464c075185a563f39a' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\hook.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27d161e52_08927891 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['htmlitems']->value)) && $_smarty_tpl->tpl_vars['htmlitems']->value) {?>
<div id="htmlcontent_<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['hook']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
"<?php if ($_smarty_tpl->tpl_vars['hook']->value == 'footer') {?> class="footer-block col-xs-12 col-sm-4"<?php }?>>
	<ul class="htmlcontent-home clearfix row">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['htmlitems']->value, 'hItem', false, NULL, 'items', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['hItem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['hItem']->value) {
$_smarty_tpl->tpl_vars['hItem']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration']++;
?>
			<?php if ($_smarty_tpl->tpl_vars['hook']->value == 'left' || $_smarty_tpl->tpl_vars['hook']->value == 'right') {?>
				<li class="htmlcontent-item-<?php echo htmlentities(mb_convert_encoding((string)(isset($_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration'] : null), 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 col-xs-12">
			<?php } else { ?>
				<li class="htmlcontent-item-<?php echo htmlentities(mb_convert_encoding((string)(isset($_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_items']->value['iteration'] : null), 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
 col-xs-12">
			<?php }?>
					<!-- <?php if ($_smarty_tpl->tpl_vars['hItem']->value['url']) {?>
						<a href="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['hItem']->value['url'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" class="item-link"<?php if ($_smarty_tpl->tpl_vars['hItem']->value['target'] == 1) {?> onclick="return !window.open(this.href);"<?php }?> title="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['hItem']->value['title'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
">
					<?php }?> -->
						<?php if ($_smarty_tpl->tpl_vars['hItem']->value['image']) {?>
						<div class="outer-image-content-div col-sm-5" <?php if ($_smarty_tpl->tpl_vars['hItem']->value['description_side'] == 'right') {?>style="right:0;"<?php }?>>
							<div class="des_head"><?php echo $_smarty_tpl->tpl_vars['hItem']->value['url'];?>
</div>
							<div class="des_content"><?php echo $_smarty_tpl->tpl_vars['hItem']->value['html'];?>
</div>
							<div><a target="blank" class="btn btn-default btn_view_details" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['hItem']->value['url']);?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View Details','mod'=>'themeconfigurator'),$_smarty_tpl ) );?>
</a></div>
						</div>
						<div class="inner-image-div">
							<img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)$_smarty_tpl->tpl_vars['module_dir']->value)."img/".((string)$_smarty_tpl->tpl_vars['hItem']->value['image']));?>
" class="item-img <?php if ($_smarty_tpl->tpl_vars['hook']->value == 'left' || $_smarty_tpl->tpl_vars['hook']->value == 'right') {?>img-responsive<?php }?>" title="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['hItem']->value['title'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['hItem']->value['title'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" width="<?php if ($_smarty_tpl->tpl_vars['hItem']->value['image_w']) {
echo intval($_smarty_tpl->tpl_vars['hItem']->value['image_w']);
} else { ?>100%<?php }?>" height="<?php if ($_smarty_tpl->tpl_vars['hItem']->value['image_h']) {
echo intval($_smarty_tpl->tpl_vars['hItem']->value['image_h']);
} else { ?>100%<?php }?>"/>
						</div>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['hItem']->value['title'] && $_smarty_tpl->tpl_vars['hItem']->value['title_use'] == 1) {?>
							<h3 class="item-title"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['hItem']->value['title'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</h3>
						<?php }?>
<!-- 						<?php if ($_smarty_tpl->tpl_vars['hItem']->value['html']) {?>
							<div class="item-html">
								<?php echo $_smarty_tpl->tpl_vars['hItem']->value['html'];?>
 <i class="icon-double-angle-right"></i>
							</div>
						<?php }?> -->
					<!-- <?php if ($_smarty_tpl->tpl_vars['hItem']->value['url']) {?>
						</a>
					<?php }?> -->
				</li>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</ul>
</div>
<?php }
}
}
