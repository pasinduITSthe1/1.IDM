<?php
/* Smarty version 4.5.5, created on 2025-10-29 12:32:27
  from 'C:\wamp64\www\1.IDM\modules\wktestimonialblock\views\templates\hook\wktestimonialblock.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6901bc0328b413_23214243',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f5484d8f95b9fb8c7e36c86146e1dad1bafee20' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\wktestimonialblock\\views\\templates\\hook\\wktestimonialblock.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901bc0328b413_23214243 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5394846546901bc03281e14_54990948', 'testimonial_block');
?>

<?php }
/* {block 'testimonial_block_heading'} */
class Block_302158676901bc032835f5_92907941 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <p class="home_block_heading"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['HOTEL_TESIMONIAL_BLOCK_HEADING']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                            <?php
}
}
/* {/block 'testimonial_block_heading'} */
/* {block 'testimonial_block_description'} */
class Block_7947854826901bc03284b69_86661469 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <p class="home_block_description"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['HOTEL_TESIMONIAL_BLOCK_CONTENT']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                            <?php
}
}
/* {/block 'testimonial_block_description'} */
/* {block 'testimonial_block_content'} */
class Block_11233041466901bc03286009_61658624 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <div class="row home_block_content htlTestemonial-owlCarousel">
                        <div class="col-sm-12 col-xs-12">
                            <div class="owl-carousel">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['testimonials_data']->value, 'tesimonial');
$_smarty_tpl->tpl_vars['tesimonial']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tesimonial']->value) {
$_smarty_tpl->tpl_vars['tesimonial']->do_else = false;
?>
                                    <div class="row">
                                        <div class='col-xs-4 col-sm-offset-1 col-sm-2'>
                                            <img src="<?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['module_dir']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
views/img/icon-double-codes.png" class="img-responsive">
                                        </div>
                                        <div class='col-xs-12 col-sm-7'>
                                            <div class="row">
                                                <div class="col-sm-12 testimonialContentContainer">
                                                    <p class="testimonialContentText"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['tesimonial']->value['testimonial_content'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 testimonialPersonDetail">
                                                    <img width="60px" src="<?php echo $_smarty_tpl->tpl_vars['tesimonial']->value['img_url'];?>
" class="testimonialPersonImg">
                                                    <p class="testimonialPersonName"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['tesimonial']->value['name'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                    <p class="testimonialPersonDesig"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['tesimonial']->value['designation'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </div>
                        </div>
                    </div>
                <?php
}
}
/* {/block 'testimonial_block_content'} */
/* {block 'testimonial_block'} */
class Block_5394846546901bc03281e14_54990948 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'testimonial_block' => 
  array (
    0 => 'Block_5394846546901bc03281e14_54990948',
  ),
  'testimonial_block_heading' => 
  array (
    0 => 'Block_302158676901bc032835f5_92907941',
  ),
  'testimonial_block_description' => 
  array (
    0 => 'Block_7947854826901bc03284b69_86661469',
  ),
  'testimonial_block_content' => 
  array (
    0 => 'Block_11233041466901bc03286009_61658624',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((isset($_smarty_tpl->tpl_vars['testimonials_data']->value)) && $_smarty_tpl->tpl_vars['testimonials_data']->value) {?>
        <div id="hotelTestimonialBlock" class="row home_block_container">
            <div class="col-xs-12 col-sm-12">
                <?php if ($_smarty_tpl->tpl_vars['HOTEL_TESIMONIAL_BLOCK_HEADING']->value && $_smarty_tpl->tpl_vars['HOTEL_TESIMONIAL_BLOCK_CONTENT']->value) {?>
                    <div class="row home_block_desc_wrapper">
                        <div class="col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_302158676901bc032835f5_92907941', 'testimonial_block_heading', $this->tplIndex);
?>

                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7947854826901bc03284b69_86661469', 'testimonial_block_description', $this->tplIndex);
?>

                            <hr class="home_block_desc_line"/>
                        </div>
                    </div>
                <?php }?>
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11233041466901bc03286009_61658624', 'testimonial_block_content', $this->tplIndex);
?>

            </div>
        </div>
    <?php }
}
}
/* {/block 'testimonial_block'} */
}
