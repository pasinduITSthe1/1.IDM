<?php
/* Smarty version 4.5.5, created on 2025-10-29 12:33:21
  from 'C:\wamp64\www\1.IDM\modules\wkhotelroom\views\templates\hook\hotelRoomDisplayBlock.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6901bc39b724f2_09030859',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e565d722f2ff8747e0364e3edf7a9af1df3f72c' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\wkhotelroom\\views\\templates\\hook\\hotelRoomDisplayBlock.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901bc39b724f2_09030859 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19589826706901bc39ae8619_63221301', 'hotel_room_block');
?>

<?php }
/* {block 'hotel_room_block_heading'} */
class Block_15121706736901bc39ae9d46_10061730 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <p class="home_block_heading"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['HOTEL_ROOM_DISPLAY_HEADING']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                            <?php
}
}
/* {/block 'hotel_room_block_heading'} */
/* {block 'hotel_room_block_description'} */
class Block_7413579016901bc39aec369_15295303 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <p class="home_block_description"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['HOTEL_ROOM_DISPLAY_DESCRIPTION']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                            <?php
}
}
/* {/block 'hotel_room_block_description'} */
/* {block 'hotel_room_block_room_type_image'} */
class Block_3341000106901bc39b00914_89048703 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                                <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['roomDisplay']->value['id_product']), ENT_QUOTES, 'UTF-8', true);?>
">
                                                    <img src="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['roomDisplay']->value['image'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['roomDisplay']->value['name'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
" class="img-responsive width-100">
                                                </a>
                                            <?php
}
}
/* {/block 'hotel_room_block_room_type_image'} */
/* {block 'displayHotelRoomsBlockImageAfter'} */
class Block_4765727036901bc39b17588_41461590 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayHotelRoomsBlockImageAfter','room_type'=>$_smarty_tpl->tpl_vars['roomDisplay']->value),$_smarty_tpl ) );?>

                                            <?php
}
}
/* {/block 'displayHotelRoomsBlockImageAfter'} */
/* {block 'hotel_room_block_room_type_description'} */
class Block_741959836901bc39b1dd10_05737642 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                                    <div class="row margin-lr-0">
                                                        <p class="htlRoomTypeNameText pull-left"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['roomDisplay']->value['name'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                        <?php if ($_smarty_tpl->tpl_vars['roomDisplay']->value['show_price'] && !(isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)) && !$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
                                                            <p class="htlRoomTypePriceText pull-right">
                                                                <?php if ($_smarty_tpl->tpl_vars['roomDisplay']->value['feature_price_diff'] >= 0) {?>
                                                                    <span class="wk_roomType_price <?php if ($_smarty_tpl->tpl_vars['roomDisplay']->value['feature_price_diff'] > 0) {?>room_type_old_price<?php }?>"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['roomDisplay']->value['price_without_reduction']),$_smarty_tpl ) );?>
</span>
                                                                <?php }?>
                                                                <?php if ($_smarty_tpl->tpl_vars['roomDisplay']->value['feature_price_diff']) {?>
                                                                    <span class="wk_roomType_price"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['roomDisplay']->value['feature_price']),$_smarty_tpl ) );?>
</span>
                                                                <?php }?>
                                                                <span class="wk_roomType_price_type">
                                                                    /&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Per Night','mod'=>'wkhotelroom'),$_smarty_tpl ) );?>

                                                                </span>
                                                            </p>
                                                        <?php }?>
                                                    </div>
                                                    <div class="row margin-lr-0 htlRoomTypeDescText htlRoomTypeDescTextContainer"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['roomDisplay']->value['description'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                                                    <div class="row htlRoomTypeDescOriginal" hidden><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['roomDisplay']->value['description'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                                                    <div class="htlRoomTypeDescExtras"><span class='htlRoomTypeDescReadmore'>...<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Read More.','mod'=>'wkhotelroom'),$_smarty_tpl ) );?>
</span><span class='htlRoomTypeDescReadless'>...<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Read Less.','mod'=>'wkhotelroom'),$_smarty_tpl ) );?>
</span></div>
                                                <?php
}
}
/* {/block 'hotel_room_block_room_type_description'} */
/* {block 'hotel_room_block_action'} */
class Block_18845148116901bc39b4d987_68173585 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                                    <div class="row margin-lr-0">
                                                        <a class="btn htlRoomTypeBookNow" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['roomDisplay']->value['id_product']), ENT_QUOTES, 'UTF-8', true);?>
"><span><?php if (!(isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)) && !$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'book now','mod'=>'wkhotelroom'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View','mod'=>'wkhotelroom'),$_smarty_tpl ) );
}?></span></a>
                                                    </div>
                                                <?php
}
}
/* {/block 'hotel_room_block_action'} */
/* {block 'hotel_room_block_content'} */
class Block_405794626901bc39af4480_10284996 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <div class="row home_block_content">
                        <div class="col-sm-12 col-xs-12">
                            <?php $_smarty_tpl->_assignInScope('htlRoomBlockIteration', 0);?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hotelRoomDisplay']->value, 'roomDisplay', false, NULL, 'htlRoom', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['roomDisplay']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['roomDisplay']->value) {
$_smarty_tpl->tpl_vars['roomDisplay']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_htlRoom']->value['iteration']++;
?>
                                <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_htlRoom']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_htlRoom']->value['iteration'] : null)%2) {?>
                                    <div class="row">
                                <?php }?>
                                        <div class="col-sm-12 col-md-6 margin-btm-30">
                                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3341000106901bc39b00914_89048703', 'hotel_room_block_room_type_image', $this->tplIndex);
?>

                                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4765727036901bc39b17588_41461590', 'displayHotelRoomsBlockImageAfter', $this->tplIndex);
?>

                                            <div class="hotelRoomDescContainer">
                                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_741959836901bc39b1dd10_05737642', 'hotel_room_block_room_type_description', $this->tplIndex);
?>

                                                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18845148116901bc39b4d987_68173585', 'hotel_room_block_action', $this->tplIndex);
?>

                                            </div>
                                        </div>
                                <?php if (!((isset($_smarty_tpl->tpl_vars['__smarty_foreach_htlRoom']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_htlRoom']->value['iteration'] : null)%2)) {?>
                                    </div>
                                <?php }?>
                                <?php $_smarty_tpl->_assignInScope('htlRoomBlockIteration', (isset($_smarty_tpl->tpl_vars['__smarty_foreach_htlRoom']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_htlRoom']->value['iteration'] : null));?>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <?php if ($_smarty_tpl->tpl_vars['htlRoomBlockIteration']->value%2) {?>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                <?php
}
}
/* {/block 'hotel_room_block_content'} */
/* {block 'hotel_room_block'} */
class Block_19589826706901bc39ae8619_63221301 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hotel_room_block' => 
  array (
    0 => 'Block_19589826706901bc39ae8619_63221301',
  ),
  'hotel_room_block_heading' => 
  array (
    0 => 'Block_15121706736901bc39ae9d46_10061730',
  ),
  'hotel_room_block_description' => 
  array (
    0 => 'Block_7413579016901bc39aec369_15295303',
  ),
  'hotel_room_block_content' => 
  array (
    0 => 'Block_405794626901bc39af4480_10284996',
  ),
  'hotel_room_block_room_type_image' => 
  array (
    0 => 'Block_3341000106901bc39b00914_89048703',
  ),
  'displayHotelRoomsBlockImageAfter' => 
  array (
    0 => 'Block_4765727036901bc39b17588_41461590',
  ),
  'hotel_room_block_room_type_description' => 
  array (
    0 => 'Block_741959836901bc39b1dd10_05737642',
  ),
  'hotel_room_block_action' => 
  array (
    0 => 'Block_18845148116901bc39b4d987_68173585',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((isset($_smarty_tpl->tpl_vars['hotelRoomDisplay']->value)) && $_smarty_tpl->tpl_vars['hotelRoomDisplay']->value) {?>
        <div id="hotelRoomsBlock" class="row home_block_container">
            <div class="col-xs-12 col-sm-12">
                <?php if ($_smarty_tpl->tpl_vars['HOTEL_ROOM_DISPLAY_HEADING']->value && $_smarty_tpl->tpl_vars['HOTEL_ROOM_DISPLAY_DESCRIPTION']->value) {?>
                    <div class="row home_block_desc_wrapper">
                        <div class="col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15121706736901bc39ae9d46_10061730', 'hotel_room_block_heading', $this->tplIndex);
?>

                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7413579016901bc39aec369_15295303', 'hotel_room_block_description', $this->tplIndex);
?>

                            <hr class="home_block_desc_line"/>
                        </div>
                    </div>
                <?php }?>
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_405794626901bc39af4480_10284996', 'hotel_room_block_content', $this->tplIndex);
?>

            </div>
            <hr class="home_block_seperator"/>
        </div>
    <?php }
}
}
/* {/block 'hotel_room_block'} */
}
