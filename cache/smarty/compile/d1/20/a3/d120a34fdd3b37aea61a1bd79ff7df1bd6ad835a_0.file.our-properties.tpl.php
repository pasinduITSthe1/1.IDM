<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:23
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\our-properties.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f28b086679_40442521',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd120a34fdd3b37aea61a1bd79ff7df1bd6ad835a' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\our-properties.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f28b086679_40442521 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_60475027868e4f28addee12_50069916', 'our_properties');
?>

<?php }
/* {block 'our_properties_list_title'} */
class Block_199904005068e4f28ae022d5_60671265 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<div class="title-container">
				<h1 class="text-center our-properties-header"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Our Properties'),$_smarty_tpl ) );?>
</h1>
				<div class="text-center our-properties-desc">
					<p><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['WK_HTL_SHORT_DESC']->value, ENT_QUOTES, 'UTF-8', true);?>
</p>
				</div>
			</div>
		<?php
}
}
/* {/block 'our_properties_list_title'} */
/* {block 'displayPropertiesLocationBefore'} */
class Block_73159733468e4f28ae1a222_65610805 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayPropertiesLocationBefore'),$_smarty_tpl ) );?>

		<?php
}
}
/* {/block 'displayPropertiesLocationBefore'} */
/* {block 'our_properties_location'} */
class Block_29598187068e4f28ae2e168_18812724 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php if ((isset($_smarty_tpl->tpl_vars['hotelLocationArray']->value)) && $_smarty_tpl->tpl_vars['hotelLocationArray']->value && (isset($_smarty_tpl->tpl_vars['displayHotelMap']->value)) && $_smarty_tpl->tpl_vars['displayHotelMap']->value) {?>
				<div class="margin-top-20 margin-btm-20">
					<div class="col-xs-12 col-sm-12" id="googleMapWrapper">
						<div id="map"></div>
					</div>
				</div>
			<?php }?>
			<div style="clear:both;"></div>
		<?php
}
}
/* {/block 'our_properties_location'} */
/* {block 'displayPropertiesLocationAfter'} */
class Block_150549002468e4f28ae4ee69_74009124 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayPropertiesLocationAfter'),$_smarty_tpl ) );?>

		<?php
}
}
/* {/block 'displayPropertiesLocationAfter'} */
/* {block 'displayPropertiesListBefore'} */
class Block_120217910468e4f28ae549d1_07252514 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayPropertiesListBefore'),$_smarty_tpl ) );?>

		<?php
}
}
/* {/block 'displayPropertiesListBefore'} */
/* {block 'our_properties_list'} */
class Block_171532157268e4f28ae61646_29428359 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

				<div class="row hotels-container">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hotelsInfo']->value, 'hotel');
$_smarty_tpl->tpl_vars['hotel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['hotel']->value) {
$_smarty_tpl->tpl_vars['hotel']->do_else = false;
?>
						<div class="<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['hotelsInfo']->value) != 1) {?>col-md-6 col-xs-12<?php } else { ?>col-md-6 col-md-offset-3<?php }?> margin-btm-30">
							<div class="hotel-address-container">
								<div class="col-xs-5">
									<img class="htl-img" style="width:100%" src="<?php echo $_smarty_tpl->tpl_vars['hotel']->value['image_url'];?>
">
								</div>
								<div class="col-xs-7">
									<p class="hotel-name"><span><?php echo $_smarty_tpl->tpl_vars['hotel']->value['hotel_name'];?>
</span></p>
									<p class="hotel-branch-info-value"><span class="htl-map-icon"></span><?php echo $_smarty_tpl->tpl_vars['hotel']->value['address'];?>
, <?php echo $_smarty_tpl->tpl_vars['hotel']->value['city'];?>
, <?php ob_start();
echo $_smarty_tpl->tpl_vars['hotel']->value['state_name'];
$_prefixVariable48 = ob_get_clean();
if ($_prefixVariable48) {
echo $_smarty_tpl->tpl_vars['hotel']->value['state_name'];?>
,<?php }?> <?php echo $_smarty_tpl->tpl_vars['hotel']->value['country_name'];?>
, <?php echo $_smarty_tpl->tpl_vars['hotel']->value['postcode'];?>
</p>
									<p class="hotel-branch-info-value">
										<span class="htl-address-icon htl-phone-icon"></span><?php echo $_smarty_tpl->tpl_vars['hotel']->value['phone'];?>

									</p>
									<p class="hotel-branch-info-value">
										<span class="htl-address-icon htl-email-icon"></span><?php echo $_smarty_tpl->tpl_vars['hotel']->value['email'];?>

									</p>
									<div class="hotel-branch-info-actions">
										<a href="<?php echo $_smarty_tpl->tpl_vars['hotel']->value['view_rooms_link'];?>
" target="_blank" class="btn btn-primary view_rooms_btn col-sm-6 col-xs-12"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View Rooms'),$_smarty_tpl ) );?>
</a>
										<?php if (($_smarty_tpl->tpl_vars['hotel']->value['latitude'] != 0 || $_smarty_tpl->tpl_vars['hotel']->value['longitude'] != 0) && $_smarty_tpl->tpl_vars['viewOnMap']->value) {?>
											<a class="btn htl-map-direction-btn col-sm-6 col-xs-12" href="http://maps.google.com/maps?daddr=(<?php echo $_smarty_tpl->tpl_vars['hotel']->value['latitude'];?>
,<?php echo $_smarty_tpl->tpl_vars['hotel']->value['longitude'];?>
)" target="_blank"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View on map'),$_smarty_tpl ) );?>
</a>
										<?php }?>
									</div>
								</div>
							</div>
						</div>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</div>
			<?php
}
}
/* {/block 'our_properties_list'} */
/* {block 'displayPropertiesListAfter'} */
class Block_105807221168e4f28af25089_27997849 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayPropertiesListAfter'),$_smarty_tpl ) );?>

			<?php
}
}
/* {/block 'displayPropertiesListAfter'} */
/* {block 'our_properties'} */
class Block_60475027868e4f28addee12_50069916 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'our_properties' => 
  array (
    0 => 'Block_60475027868e4f28addee12_50069916',
  ),
  'our_properties_list_title' => 
  array (
    0 => 'Block_199904005068e4f28ae022d5_60671265',
  ),
  'displayPropertiesLocationBefore' => 
  array (
    0 => 'Block_73159733468e4f28ae1a222_65610805',
  ),
  'our_properties_location' => 
  array (
    0 => 'Block_29598187068e4f28ae2e168_18812724',
  ),
  'displayPropertiesLocationAfter' => 
  array (
    0 => 'Block_150549002468e4f28ae4ee69_74009124',
  ),
  'displayPropertiesListBefore' => 
  array (
    0 => 'Block_120217910468e4f28ae549d1_07252514',
  ),
  'our_properties_list' => 
  array (
    0 => 'Block_171532157268e4f28ae61646_29428359',
  ),
  'displayPropertiesListAfter' => 
  array (
    0 => 'Block_105807221168e4f28af25089_27997849',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Our Properties'),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php if ((isset($_smarty_tpl->tpl_vars['hotelsInfo']->value)) && $_smarty_tpl->tpl_vars['hotelsInfo']->value) {?>
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_199904005068e4f28ae022d5_60671265', 'our_properties_list_title', $this->tplIndex);
?>


		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_73159733468e4f28ae1a222_65610805', 'displayPropertiesLocationBefore', $this->tplIndex);
?>


		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_29598187068e4f28ae2e168_18812724', 'our_properties_location', $this->tplIndex);
?>


		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_150549002468e4f28ae4ee69_74009124', 'displayPropertiesLocationAfter', $this->tplIndex);
?>


		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_120217910468e4f28ae549d1_07252514', 'displayPropertiesListBefore', $this->tplIndex);
?>


		<div class="properties-page">
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_171532157268e4f28ae61646_29428359', 'our_properties_list', $this->tplIndex);
?>


			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_105807221168e4f28af25089_27997849', 'displayPropertiesListAfter', $this->tplIndex);
?>


			<?php if (((isset($_smarty_tpl->tpl_vars['pageLimit']->value))) && $_smarty_tpl->tpl_vars['pageLimit']->value > 1) {?>
				<form id="our-properties-list" method="post" action="<?php echo $_smarty_tpl->tpl_vars['currentPageUrl']->value;?>
">
					<input type="hidden" value="" name="pagination" id="pagination"/>
				</form>
				<div class="row pagination-container">
					<ul class="pagination">
						<?php if (!(isset($_smarty_tpl->tpl_vars['pagination']->value[1]))) {?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['currentIndex']->value;?>
" data-pagination="1">1</a></li>
							<?php if (!(isset($_smarty_tpl->tpl_vars['pagination']->value[2]))) {?>
								<li><span disabled>...</span></li>
							<?php }?>
						<?php }?>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pagination']->value, 'page');
$_smarty_tpl->tpl_vars['page']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->do_else = false;
?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['currentIndex']->value;?>
" data-pagination="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['currentPage']->value) {?>class="active"<?php }?>><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a></li>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php if (!(isset($_smarty_tpl->tpl_vars['pagination']->value[$_smarty_tpl->tpl_vars['pageLimit']->value]))) {?>
							<?php if (!(isset($_smarty_tpl->tpl_vars['pagination']->value[$_smarty_tpl->tpl_vars['pageLimit']->value-1]))) {?>
								<li><span disabled>...</span></li>
							<?php }?>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['currentIndex']->value;?>
" data-pagination="<?php echo $_smarty_tpl->tpl_vars['pageLimit']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pageLimit']->value;?>
</a></li>
						<?php }?>
					</ul>
				</div>
			<?php }?>
		</div>
	<?php } else { ?>
		<div class="text-center empty-properties-container">
			<div class="row">
				<div class="empty-properties-image-container"></div>
			</div>
			<div class="row">
				<h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No Hotel Found!!'),$_smarty_tpl ) );?>
</h2>
			</div>
		</div>
	<?php }
}
}
/* {/block 'our_properties'} */
}
