<?php
/* Smarty version 4.5.5, created on 2025-10-29 12:32:10
  from 'C:\wamp64\www\1.IDM\modules\wkhotelfeaturesblock\views\templates\hook\hotelfeaturescontent.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6901bbf22fa950_98283474',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae22fa88b11171843fb814e19c0e7128b9b2d1d9' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\wkhotelfeaturesblock\\views\\templates\\hook\\hotelfeaturescontent.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901bbf22fa950_98283474 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3908097376901bbf22473d7_53277765', 'hotel_features_block');
?>

<?php }
/* {block 'hotel_features_block_heading'} */
class Block_2094781146901bbf224e4b8_13993192 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <p class="home_block_heading"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['HOTEL_AMENITIES_HEADING']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                            <?php
}
}
/* {/block 'hotel_features_block_heading'} */
/* {block 'hotel_features_block_description'} */
class Block_10587246166901bbf2254318_30369123 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <p class="home_block_description"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['HOTEL_AMENITIES_DESCRIPTION']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                            <?php
}
}
/* {/block 'hotel_features_block_description'} */
/* {block 'hotel_features_images'} */
class Block_5358591076901bbf225c694_10400585 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <div class="homeAmenitiesBlock home_block_content">
                        <?php $_smarty_tpl->_assignInScope('amenityPosition', 0);?>
                        <?php $_smarty_tpl->_assignInScope('amenityIteration', 0);?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hotelAmenities']->value, 'amenity', false, NULL, 'amenityBlock', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['amenity']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['amenity']->value) {
$_smarty_tpl->tpl_vars['amenity']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_amenityBlock']->value['iteration']++;
?>

                            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_amenityBlock']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_amenityBlock']->value['iteration'] : null)%2 != 0) {?>
                                <div class="row margin-lr-0">
                                <?php if ($_smarty_tpl->tpl_vars['amenityPosition']->value) {?>
                                    <?php $_smarty_tpl->_assignInScope('amenityPosition', 0);?>
                                <?php } else { ?>
                                    <?php $_smarty_tpl->_assignInScope('amenityPosition', 1);?>
                                <?php }?>
                            <?php }?>
                                    <div class="col-md-6 padding-lr-0 hidden-xs hidden-sm">
                                        <div class="row margin-lr-0 amenity_content">
                                            <?php if ($_smarty_tpl->tpl_vars['amenityPosition']->value) {?>
                                                <div class="col-md-6 padding-lr-0">
                                                    <div class="amenity_img_primary">

                                                        <div class="amenity_img_secondary" style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['module_dir']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true)))."views/img/hotels_features_img/".((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['id_features_block'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true))).".jpg");?>
')">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 padding-lr-0 amenity_desc_cont">
                                                    <div class="amenity_desc_primary">
                                                        <div class="amenity_desc_secondary">
                                                            <p class="amenity_heading"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['feature_title'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                            <p class="amenity_description"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['feature_description'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                            <hr class="amenity_desc_hr" />
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-md-6 padding-lr-0 amenity_desc_cont">
                                                    <div class="amenity_desc_primary">
                                                        <div class="amenity_desc_secondary">
                                                            <p class="amenity_heading"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['feature_title'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                            <p class="amenity_description"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['feature_description'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                            <hr class="amenity_desc_hr" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 padding-lr-0">
                                                    <div class="amenity_img_primary">
                                                        <div class="amenity_img_secondary" style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['module_dir']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true)))."views/img/hotels_features_img/".((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['id_features_block'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true))).".jpg");?>
')">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 padding-lr-0 visible-sm">
                                        <div class="row margin-lr-0 amenity_content">
                                            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_amenityBlock']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_amenityBlock']->value['iteration'] : null)%2 != 0) {?>
                                                <div class="col-sm-6 padding-lr-0">
                                                    <div class="amenity_img_primary">
                                                        <div class="amenity_img_secondary" style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['module_dir']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true)))."views/img/hotels_features_img/".((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['id_features_block'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true))).".jpg");?>
')">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 padding-lr-0 amenity_desc_cont">
                                                    <div class="amenity_desc_primary">
                                                        <div class="amenity_desc_secondary">
                                                            <p class="amenity_heading"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['feature_title'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                            <p class="amenity_description"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['feature_description'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                            <hr class="amenity_desc_hr" />
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-sm-6 padding-lr-0 amenity_desc_cont">
                                                    <div class="amenity_desc_primary">
                                                        <div class="amenity_desc_secondary">
                                                            <p class="amenity_heading"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['feature_title'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                            <p class="amenity_description"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['feature_description'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                            <hr class="amenity_desc_hr" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 padding-lr-0">
                                                    <div class="amenity_img_primary">
                                                        <div class="amenity_img_secondary" style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['module_dir']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true)))."views/img/hotels_features_img/".((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['id_features_block'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true))).".jpg");?>
')">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 padding-lr-0 visible-xs">
                                        <div class="row margin-lr-0 amenity_content">
                                            <div class="col-xs-12 padding-lr-0">
                                                <div class="amenity_img_primary">
                                                    <div class="amenity_img_secondary" style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['module_dir']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true)))."views/img/hotels_features_img/".((string)(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['id_features_block'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true))).".jpg");?>
')">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 padding-lr-0 amenity_desc_cont">
                                                <div class="amenity_desc_primary">
                                                    <div class="amenity_desc_secondary">
                                                        <p class="amenity_heading"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['feature_title'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                        <p class="amenity_description"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['amenity']->value['feature_description'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                        <hr class="amenity_desc_hr" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_amenityBlock']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_amenityBlock']->value['iteration'] : null)%2 == 0) {?>
                                </div>
                            <?php }?>
                            <?php $_smarty_tpl->_assignInScope('amenityIteration', (isset($_smarty_tpl->tpl_vars['__smarty_foreach_amenityBlock']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_amenityBlock']->value['iteration'] : null));?>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php if ($_smarty_tpl->tpl_vars['amenityIteration']->value%2) {?>
                            </div>
                        <?php }?>
                    </div>
                <?php
}
}
/* {/block 'hotel_features_images'} */
/* {block 'hotel_features_block'} */
class Block_3908097376901bbf22473d7_53277765 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hotel_features_block' => 
  array (
    0 => 'Block_3908097376901bbf22473d7_53277765',
  ),
  'hotel_features_block_heading' => 
  array (
    0 => 'Block_2094781146901bbf224e4b8_13993192',
  ),
  'hotel_features_block_description' => 
  array (
    0 => 'Block_10587246166901bbf2254318_30369123',
  ),
  'hotel_features_images' => 
  array (
    0 => 'Block_5358591076901bbf225c694_10400585',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((isset($_smarty_tpl->tpl_vars['hotelAmenities']->value)) && $_smarty_tpl->tpl_vars['hotelAmenities']->value) {?>
        <div id="hotelAmenitiesBlock" class="row home_block_container">
            <div class="col-xs-12 col-sm-12 home_amenities_wrapper">
                <?php if ($_smarty_tpl->tpl_vars['HOTEL_AMENITIES_HEADING']->value && $_smarty_tpl->tpl_vars['HOTEL_AMENITIES_DESCRIPTION']->value) {?>
                    <div class="row home_block_desc_wrapper">
                        <div class="col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2094781146901bbf224e4b8_13993192', 'hotel_features_block_heading', $this->tplIndex);
?>

                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10587246166901bbf2254318_30369123', 'hotel_features_block_description', $this->tplIndex);
?>

                            <hr class="home_block_desc_line"/>
                        </div>
                    </div>
                <?php }?>
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5358591076901bbf225c694_10400585', 'hotel_features_images', $this->tplIndex);
?>

            </div>
            <hr class="home_block_seperator"/>
        </div>
    <?php }
}
}
/* {/block 'hotel_features_block'} */
}
