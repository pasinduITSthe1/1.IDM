<?php
/* Smarty version 4.5.5, created on 2025-10-29 12:32:09
  from 'C:\wamp64\www\1.IDM\modules\wkabouthotelblock\views\templates\hook\hotelInteriorBlock.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6901bbf19102c7_61931519',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0f190a4f47ea7ad63023c3d866c986bc079b46b7' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\wkabouthotelblock\\views\\templates\\hook\\hotelInteriorBlock.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901bbf19102c7_61931519 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18427447156901bbf17b9cc6_75585741', 'hotel_interior_block');
?>

<?php }
/* {block 'hotel_interior_block_heading'} */
class Block_4504435346901bbf17bba42_84192270 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <p class="home_block_heading"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['HOTEL_INTERIOR_HEADING']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                            <?php
}
}
/* {/block 'hotel_interior_block_heading'} */
/* {block 'hotel_interior_block_description'} */
class Block_20691518976901bbf17bd7a5_09025444 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <p class="home_block_description"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['HOTEL_INTERIOR_DESCRIPTION']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                            <?php
}
}
/* {/block 'hotel_interior_block_description'} */
/* {block 'displayInteriorExtraContent'} */
class Block_5853708936901bbf17bf825_07763328 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayInteriorExtraContent"),$_smarty_tpl ) );?>

                            <?php
}
}
/* {/block 'displayInteriorExtraContent'} */
/* {block 'hotel_interior_images'} */
class Block_5218961136901bbf17c4689_67916737 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <div class="row home_block_content htlInterior-owlCarousel">
                        <div class="col-sm-12 col-xs-12">
                            <div class="owl-carousel owl-theme">
                                <?php $_smarty_tpl->_assignInScope('intImgIteration', 0);?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['InteriorImg']->value, 'img_name', false, NULL, 'intImg', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['img_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['img_name']->value) {
$_smarty_tpl->tpl_vars['img_name']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_intImg']->value['iteration']++;
?>
                                    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_intImg']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_intImg']->value['iteration'] : null)%3 == 1) {?>
                                    <div class="interiorImgWrapper">
                                    <?php }?>
                                        <div class="interiorbox" data-fancybox-group="interiorGallery" rel="interiorGallery" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['module_dir']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true)))."views/img/hotel_interior/".((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['img_name']->value['name'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true))).".jpg");?>
" title="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['img_name']->value['display_name'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
">
                                            <div class="interiorboxInner">
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['module_dir']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true)))."views/img/hotel_interior/".((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['img_name']->value['name'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true))).".jpg");?>
" class="interiorImg" alt="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['img_name']->value['display_name'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
">
                                            </div>
                                            <div class="interiorHoverBlockWrapper">
                                                <div class="interiorHoverPrimaryBlock">
                                                    <div class="interiorHoverSecondaryBlock">
                                                        <i class="icon-search-plus"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_intImg']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_intImg']->value['iteration'] : null)%3 == 0) {?>
                                    </div>
                                    <?php }?>
                                    <?php $_smarty_tpl->_assignInScope('intImgIteration', (isset($_smarty_tpl->tpl_vars['__smarty_foreach_intImg']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_intImg']->value['iteration'] : null));?>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                <?php if ($_smarty_tpl->tpl_vars['intImgIteration']->value%3) {?>
                                    <?php $_smarty_tpl->_assignInScope('intImgLeft', 3-($_smarty_tpl->tpl_vars['intImgIteration']->value%3));?>
                                    <?php
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? $_smarty_tpl->tpl_vars['intImgLeft']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['intImgLeft']->value)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = 1, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration === 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration === $_smarty_tpl->tpl_vars['foo']->total;?>
                                        <div class="interiorbox">
                                            <div class="interiorboxInner">
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['module_dir']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true)))."views/img/Default-Image.png");?>
" class="interiorImg" alt="Default Image">
                                            </div>
                                        </div>
                                    <?php }
}
?>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                <?php
}
}
/* {/block 'hotel_interior_images'} */
/* {block 'hotel_interior_block'} */
class Block_18427447156901bbf17b9cc6_75585741 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hotel_interior_block' => 
  array (
    0 => 'Block_18427447156901bbf17b9cc6_75585741',
  ),
  'hotel_interior_block_heading' => 
  array (
    0 => 'Block_4504435346901bbf17bba42_84192270',
  ),
  'hotel_interior_block_description' => 
  array (
    0 => 'Block_20691518976901bbf17bd7a5_09025444',
  ),
  'displayInteriorExtraContent' => 
  array (
    0 => 'Block_5853708936901bbf17bf825_07763328',
  ),
  'hotel_interior_images' => 
  array (
    0 => 'Block_5218961136901bbf17c4689_67916737',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((isset($_smarty_tpl->tpl_vars['InteriorImg']->value)) && $_smarty_tpl->tpl_vars['InteriorImg']->value) {?>
        <div id="hotelInteriorBlock" class="row home_block_container">
            <div class="col-xs-12 col-sm-12">
                <?php if ($_smarty_tpl->tpl_vars['HOTEL_INTERIOR_HEADING']->value && $_smarty_tpl->tpl_vars['HOTEL_INTERIOR_DESCRIPTION']->value) {?>
                    <div class="row home_block_desc_wrapper">
                        <div class="col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4504435346901bbf17bba42_84192270', 'hotel_interior_block_heading', $this->tplIndex);
?>

                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20691518976901bbf17bd7a5_09025444', 'hotel_interior_block_description', $this->tplIndex);
?>

                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5853708936901bbf17bf825_07763328', 'displayInteriorExtraContent', $this->tplIndex);
?>

                            <hr class="home_block_desc_line"/>
                        </div>
                    </div>
                <?php }?>
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5218961136901bbf17c4689_67916737', 'hotel_interior_images', $this->tplIndex);
?>

            </div>
            <hr class="home_block_seperator"/>
        </div>
    <?php }
}
}
/* {/block 'hotel_interior_block'} */
}
