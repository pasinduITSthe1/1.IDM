<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:23
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\product-list-colors.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f28bbe0943_85205759',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6e8d735dcda1188ee459f75145c9c72e53678c84' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\product-list-colors.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f28bbe0943_85205759 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['colors_list']->value))) {?>
<ul class="color_to_pick_list clearfix">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['colors_list']->value, 'color');
$_smarty_tpl->tpl_vars['color']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['color']->value) {
$_smarty_tpl->tpl_vars['color']->do_else = false;
?>
		<?php if ((isset($_smarty_tpl->tpl_vars['col_img_dir']->value))) {?>
			<?php $_smarty_tpl->_assignInScope('img_color_exists', file_exists((($_smarty_tpl->tpl_vars['col_img_dir']->value).($_smarty_tpl->tpl_vars['color']->value['id_attribute'])).('.jpg')));?>
			<li>
				<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['color']->value['id_product'],null,null,null,null,null,$_smarty_tpl->tpl_vars['color']->value['id_product_attribute'],Configuration::get('PS_REWRITING_SETTINGS'),false,true), ENT_QUOTES, 'UTF-8', true);?>
" id="color_<?php echo intval($_smarty_tpl->tpl_vars['color']->value['id_product_attribute']);?>
" class="color_pick"<?php if (!$_smarty_tpl->tpl_vars['img_color_exists']->value && (isset($_smarty_tpl->tpl_vars['color']->value['color'])) && $_smarty_tpl->tpl_vars['color']->value['color']) {?> style="background:<?php echo $_smarty_tpl->tpl_vars['color']->value['color'];?>
;"<?php }?>>
					<?php if ($_smarty_tpl->tpl_vars['img_color_exists']->value) {?>
						<img src="<?php echo $_smarty_tpl->tpl_vars['img_col_dir']->value;
echo intval($_smarty_tpl->tpl_vars['color']->value['id_attribute']);?>
.jpg" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['color']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['color']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" width="20" height="20" />
					<?php }?>
				</a>
			</li>
		<?php }?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>
<?php }
}
}
