<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:30
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\_partials\hotel_images.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f292c99db6_86579106',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ab399038402c8e81f38d90f89d1e8c58cc23da18' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\_partials\\hotel_images.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f292c99db6_86579106 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_51699954768e4f292c562d8_76378246', 'hotel_images');
?>

<?php }
/* {block 'hotel_images'} */
class Block_51699954768e4f292c562d8_76378246 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hotel_images' => 
  array (
    0 => 'Block_51699954768e4f292c562d8_76378246',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if (is_array($_smarty_tpl->tpl_vars['hotel_images']->value) && count($_smarty_tpl->tpl_vars['hotel_images']->value)) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hotel_images']->value, 'hotel_image');
$_smarty_tpl->tpl_vars['hotel_image']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['hotel_image']->value) {
$_smarty_tpl->tpl_vars['hotel_image']->do_else = false;
?>
            <div class="col-sm-4 image-item">
                <a class="hotel-images-fancybox" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['hotel_image']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
">
                    <img class="img img-responsive" src="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['hotel_image']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
">
                </a>
            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }
}
}
/* {/block 'hotel_images'} */
}
