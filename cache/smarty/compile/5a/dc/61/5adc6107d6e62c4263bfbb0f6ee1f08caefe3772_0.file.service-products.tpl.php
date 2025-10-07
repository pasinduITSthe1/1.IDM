<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:32
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\_partials\service-products.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f294e9ab74_32753990',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5adc6107d6e62c4263bfbb0f6ee1f08caefe3772' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\_partials\\service-products.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f294e9ab74_32753990 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php if ((isset($_smarty_tpl->tpl_vars['service_products_exists']->value)) && $_smarty_tpl->tpl_vars['service_products_exists']->value) {?>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_47291784668e4f294da1b82_22051148', 'service_products_tabs');
?>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_213964727468e4f294de0fd0_64788503', 'service_products_tabs_content');
?>

<?php }
}
/* {block 'service_products_tabs'} */
class Block_47291784668e4f294da1b82_22051148 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'service_products_tabs' => 
  array (
    0 => 'Block_47291784668e4f294da1b82_22051148',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <ul class="nav nav-tabs product_description_tabs">
            <?php if (!$_smarty_tpl->tpl_vars['PS_SERVICE_PRODUCT_CATEGORY_FILTER']->value) {?>
                <li class="active"><a href="#all_products" class="idTabHrefShort" data-toggle="tab"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Services'),$_smarty_tpl ) );?>
</a></li>
            <?php } else { ?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['service_products_by_category']->value, 'category');
$_smarty_tpl->tpl_vars['category']->iteration = 0;
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
$_smarty_tpl->tpl_vars['category']->iteration++;
$__foreach_category_214_saved = $_smarty_tpl->tpl_vars['category'];
?>
                    <li <?php if ($_smarty_tpl->tpl_vars['category']->iteration == 1) {?>class="active"<?php }?>><a class="idTabHrefShort" href="#category_<?php echo $_smarty_tpl->tpl_vars['category']->value['id_category'];?>
" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</a></li>
                <?php
$_smarty_tpl->tpl_vars['category'] = $__foreach_category_214_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
        </ul>
    <?php
}
}
/* {/block 'service_products_tabs'} */
/* {block 'service_products_list'} */
class Block_204389371768e4f294e070a5_70021292 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."_partials/service-products-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('service_products'=>$_smarty_tpl->tpl_vars['service_product_category']->value['products'],'group'=>$_smarty_tpl->tpl_vars['service_product_category']->value['id_category'],'init'=>true,'product'=>$_smarty_tpl->tpl_vars['product']->value), 0, true);
?>
                                    <?php
}
}
/* {/block 'service_products_list'} */
/* {block 'service_products_list'} */
class Block_129273251668e4f294e5c804_83546110 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."_partials/service-products-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('service_products'=>$_smarty_tpl->tpl_vars['service_products']->value,'group'=>'all','init'=>true,'product'=>$_smarty_tpl->tpl_vars['product']->value), 0, true);
?>
                            <?php
}
}
/* {/block 'service_products_list'} */
/* {block 'service_products_tabs_content'} */
class Block_213964727468e4f294de0fd0_64788503 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'service_products_tabs_content' => 
  array (
    0 => 'Block_213964727468e4f294de0fd0_64788503',
  ),
  'service_products_list' => 
  array (
    0 => 'Block_204389371768e4f294e070a5_70021292',
    1 => 'Block_129273251668e4f294e5c804_83546110',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <div class="card">
            <div class="row">
                <div class="col-sm-12 tab-content">
                    <?php if ($_smarty_tpl->tpl_vars['PS_SERVICE_PRODUCT_CATEGORY_FILTER']->value) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['service_products_by_category']->value, 'service_product_category');
$_smarty_tpl->tpl_vars['service_product_category']->iteration = 0;
$_smarty_tpl->tpl_vars['service_product_category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['service_product_category']->value) {
$_smarty_tpl->tpl_vars['service_product_category']->do_else = false;
$_smarty_tpl->tpl_vars['service_product_category']->iteration++;
$__foreach_service_product_category_215_saved = $_smarty_tpl->tpl_vars['service_product_category'];
?>
                            <div class="tab-pane <?php if ($_smarty_tpl->tpl_vars['service_product_category']->iteration == 1) {?>active<?php }?>" id="category_<?php echo $_smarty_tpl->tpl_vars['service_product_category']->value['id_category'];?>
">
                                <ul class="product-list">
                                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_204389371768e4f294e070a5_70021292', 'service_products_list', $this->tplIndex);
?>

                                </ul>
                                <?php if (RoomTypeServiceProduct::WK_NUM_RESULTS < $_smarty_tpl->tpl_vars['service_product_category']->value['num_products']) {?>
                                    <div class="show_more_btn_container">
                                        <button class="btn btn-default get-service-products" data-id_category="<?php echo $_smarty_tpl->tpl_vars['service_product_category']->value['id_category'];?>
" data-page="2" data-num_total="<?php echo $_smarty_tpl->tpl_vars['service_product_category']->value['num_products'];?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Show More'),$_smarty_tpl ) );?>
</button>
                                    </div>
                                <?php }?>
                            </div>
                        <?php
$_smarty_tpl->tpl_vars['service_product_category'] = $__foreach_service_product_category_215_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php } else { ?>
                        <ul class="product-list">
                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_129273251668e4f294e5c804_83546110', 'service_products_list', $this->tplIndex);
?>

                        </ul>
                        <?php if (RoomTypeServiceProduct::WK_NUM_RESULTS < $_smarty_tpl->tpl_vars['num_total_service_products']->value) {?>
                            <div class="show_more_btn_container">
                                <button class="btn btn-default get-service-products" data-page="2" data-num_total="<?php echo $_smarty_tpl->tpl_vars['num_total_service_products']->value;?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Show More'),$_smarty_tpl ) );?>
</button>
                            </div>
                        <?php }?>
                    <?php }?>
                </div>
            </div>
        </div>
    <?php
}
}
/* {/block 'service_products_tabs_content'} */
}
