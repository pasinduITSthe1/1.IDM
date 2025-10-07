<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:32
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\_partials\service-products-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f294c95204_52793072',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '27bc637c24f51be72e42290b60d1ff2ab07853b7' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\_partials\\service-products-list.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f294c95204_52793072 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['service_products']->value, 'service_product');
$_smarty_tpl->tpl_vars['service_product']->index = -1;
$_smarty_tpl->tpl_vars['service_product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['service_product']->value) {
$_smarty_tpl->tpl_vars['service_product']->do_else = false;
$_smarty_tpl->tpl_vars['service_product']->index++;
$_smarty_tpl->tpl_vars['service_product']->first = !$_smarty_tpl->tpl_vars['service_product']->index;
$__foreach_service_product_213_saved = $_smarty_tpl->tpl_vars['service_product'];
?>
    <?php if (!($_smarty_tpl->tpl_vars['service_product']->first && (isset($_smarty_tpl->tpl_vars['init']->value)) && $_smarty_tpl->tpl_vars['init']->value == true)) {?>
        <hr>
    <?php }?>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_32064884468e4f294c8ad30_45269860', 'service_products_list_row');
?>

<?php
$_smarty_tpl->tpl_vars['service_product'] = $__foreach_service_product_213_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
/* {block 'service_products_list_row'} */
class Block_32064884468e4f294c8ad30_45269860 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'service_products_list_row' => 
  array (
    0 => 'Block_32064884468e4f294c8ad30_45269860',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."_partials/service-products-list-row.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('service_product'=>$_smarty_tpl->tpl_vars['service_product']->value,'product'=>$_smarty_tpl->tpl_vars['product']->value), 0, true);
?>
    <?php
}
}
/* {/block 'service_products_list_row'} */
}
