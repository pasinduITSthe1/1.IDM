<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:05
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\address.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f279a31d63_10328743',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b1877016888e658841c4912d2c1441af1cf0309a' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\address.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f279a31d63_10328743 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_97852672368e4f279169ad2_38785362', 'address');
?>

<?php }
/* {block 'address_heading'} */
class Block_179476587068e4f2793fe042_20575003 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<h1 class="page-subheading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Address'),$_smarty_tpl ) );?>
</h1>
		<?php
}
}
/* {/block 'address_heading'} */
/* {block 'errors'} */
class Block_169889663568e4f2794226c5_17187360 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
		<?php
}
}
/* {/block 'errors'} */
/* {block 'address_form'} */
class Block_139824167368e4f27968a6d8_28747997 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<form action="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('address',true), ENT_QUOTES, 'UTF-8', true);?>
" method="post" class="std" id="add_address">
				<!--h3 class="page-subheading"><?php if ((isset($_smarty_tpl->tpl_vars['id_address']->value))) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your address'),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'New address'),$_smarty_tpl ) );
}?></h3-->
				<?php $_smarty_tpl->_assignInScope('stateExist', false);?>
				<?php $_smarty_tpl->_assignInScope('postCodeExist', false);?>
				<?php $_smarty_tpl->_assignInScope('dniExist', false);?>
				<?php $_smarty_tpl->_assignInScope('homePhoneExist', false);?>
				<?php $_smarty_tpl->_assignInScope('mobilePhoneExist', false);?>
				<?php $_smarty_tpl->_assignInScope('atLeastOneExists', false);?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ordered_adr_fields']->value, 'field_name');
$_smarty_tpl->tpl_vars['field_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['field_name']->value) {
$_smarty_tpl->tpl_vars['field_name']->do_else = false;
?>
					<?php if ($_smarty_tpl->tpl_vars['field_name']->value == 'company') {?>
						<div class="form-group">
							<label for="company"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Company'),$_smarty_tpl ) );
if ((isset($_smarty_tpl->tpl_vars['required_fields']->value)) && in_array($_smarty_tpl->tpl_vars['field_name']->value,$_smarty_tpl->tpl_vars['required_fields']->value)) {?> <sup>*</sup><?php }?></label>
							<input class="form-control validate" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value[$_smarty_tpl->tpl_vars['field_name']->value]['validate'];?>
" type="text" id="company" name="company" value="<?php if ((isset($_POST['company']))) {
echo $_POST['company'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->company))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->company, ENT_QUOTES, 'UTF-8', true);
}
}?>" />
						</div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['field_name']->value == 'vat_number') {?>
						<div id="vat_area">
							<div id="vat_number">
								<div class="form-group">
									<label for="vat-number"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'VAT number'),$_smarty_tpl ) );
if ((isset($_smarty_tpl->tpl_vars['required_fields']->value)) && in_array($_smarty_tpl->tpl_vars['field_name']->value,$_smarty_tpl->tpl_vars['required_fields']->value)) {?> <sup>*</sup><?php }?></label>
									<input type="text" class="form-control validate" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value[$_smarty_tpl->tpl_vars['field_name']->value]['validate'];?>
" id="vat-number" name="vat_number" value="<?php if ((isset($_POST['vat_number']))) {
echo $_POST['vat_number'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->vat_number))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->vat_number, ENT_QUOTES, 'UTF-8', true);
}
}?>" />
								</div>
							</div>
						</div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['field_name']->value == 'dni') {?>
					<?php $_smarty_tpl->_assignInScope('dniExist', true);?>
					<div class="required form-group dni">
						<label for="dni"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Identification number'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
						<input class="form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value[$_smarty_tpl->tpl_vars['field_name']->value]['validate'];?>
" type="text" name="dni" id="dni" value="<?php if ((isset($_POST['dni']))) {
echo $_POST['dni'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->dni))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->dni, ENT_QUOTES, 'UTF-8', true);
}
}?>" />
						<span class="form_info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'DNI / NIF / NIE'),$_smarty_tpl ) );?>
</span>
					</div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['field_name']->value == 'firstname') {?>
						<div class="required form-group">
							<label for="firstname"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'First name'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
							<input class="is_required validate form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value[$_smarty_tpl->tpl_vars['field_name']->value]['validate'];?>
" type="text" name="firstname" id="firstname" value="<?php if ((isset($_POST['firstname']))) {
echo $_POST['firstname'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->firstname))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->firstname, ENT_QUOTES, 'UTF-8', true);
}
}?>" />
						</div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['field_name']->value == 'lastname') {?>
						<div class="required form-group">
							<label for="lastname"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last name'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
							<input class="is_required validate form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value[$_smarty_tpl->tpl_vars['field_name']->value]['validate'];?>
" type="text" id="lastname" name="lastname" value="<?php if ((isset($_POST['lastname']))) {
echo $_POST['lastname'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->lastname))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->lastname, ENT_QUOTES, 'UTF-8', true);
}
}?>" />
						</div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['field_name']->value == 'address1') {?>
						<div class="required form-group">
							<label for="address1"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Address'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
							<input class="is_required validate form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value[$_smarty_tpl->tpl_vars['field_name']->value]['validate'];?>
" type="text" id="address1" name="address1" value="<?php if ((isset($_POST['address1']))) {
echo $_POST['address1'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->address1))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->address1, ENT_QUOTES, 'UTF-8', true);
}
}?>" />
						</div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['field_name']->value == 'address2') {?>
						<div class="required form-group">
							<label for="address2"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Address (Line 2)'),$_smarty_tpl ) );
if ((isset($_smarty_tpl->tpl_vars['required_fields']->value)) && in_array($_smarty_tpl->tpl_vars['field_name']->value,$_smarty_tpl->tpl_vars['required_fields']->value)) {?> <sup>*</sup><?php }?></label>
							<input class="validate form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value[$_smarty_tpl->tpl_vars['field_name']->value]['validate'];?>
" type="text" id="address2" name="address2" value="<?php if ((isset($_POST['address2']))) {
echo $_POST['address2'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->address2))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->address2, ENT_QUOTES, 'UTF-8', true);
}
}?>" />
						</div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['field_name']->value == 'postcode') {?>
						<?php $_smarty_tpl->_assignInScope('postCodeExist', true);?>
						<div class="required postcode form-group unvisible">
							<label for="postcode"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Zip/Postal Code'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
							<input class="is_required validate form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value[$_smarty_tpl->tpl_vars['field_name']->value]['validate'];?>
" type="text" id="postcode" name="postcode" value="<?php if ((isset($_POST['postcode']))) {
echo $_POST['postcode'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->postcode))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->postcode, ENT_QUOTES, 'UTF-8', true);
}
}?>" />
						</div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['field_name']->value == 'city') {?>
						<div class="required form-group">
							<label for="city"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'City'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
							<input class="is_required validate form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value[$_smarty_tpl->tpl_vars['field_name']->value]['validate'];?>
" type="text" name="city" id="city" value="<?php if ((isset($_POST['city']))) {
echo $_POST['city'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->city))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->city, ENT_QUOTES, 'UTF-8', true);
}
}?>" maxlength="64" />
						</div>
											<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['field_name']->value == 'Country:name' || $_smarty_tpl->tpl_vars['field_name']->value == 'country' || $_smarty_tpl->tpl_vars['field_name']->value == 'Country:iso_code') {?>
						<div class="required form-group">
							<label for="id_country"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Country'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
							<select id="id_country" class="form-control" name="id_country"><?php echo $_smarty_tpl->tpl_vars['countries_list']->value;?>
</select>
						</div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['field_name']->value == 'State:name') {?>
						<?php $_smarty_tpl->_assignInScope('stateExist', true);?>
						<div class="required id_state form-group">
							<label for="id_state"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'State'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
							<select name="id_state" id="id_state" class="form-control">
								<option value="">-</option>
							</select>
						</div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['field_name']->value == 'phone') {?>
						<?php $_smarty_tpl->_assignInScope('homePhoneExist', true);?>
						<div class="form-group phone-number">
							<label for="phone"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Home phone'),$_smarty_tpl ) );
if ((isset($_smarty_tpl->tpl_vars['one_phone_at_least']->value)) && $_smarty_tpl->tpl_vars['one_phone_at_least']->value) {?> <sup>**</sup><?php }?></label>
							<input class="<?php if ((isset($_smarty_tpl->tpl_vars['one_phone_at_least']->value)) && $_smarty_tpl->tpl_vars['one_phone_at_least']->value) {?>is_required<?php }?> validate form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value['phone']['validate'];?>
" type="tel" id="phone" name="phone" value="<?php if ((isset($_POST['phone']))) {
echo $_POST['phone'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->phone))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->phone, ENT_QUOTES, 'UTF-8', true);
}
}?>"  />
						</div>
						<?php if ((isset($_smarty_tpl->tpl_vars['one_phone_at_least']->value)) && $_smarty_tpl->tpl_vars['one_phone_at_least']->value) {?>
							<?php $_smarty_tpl->_assignInScope('atLeastOneExists', true);?>
							<p class="inline-infos required">** <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You must register at least one phone number.'),$_smarty_tpl ) );?>
</p>
						<?php }?>
						<div class="clearfix"></div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['field_name']->value == 'phone_mobile') {?>
						<?php $_smarty_tpl->_assignInScope('mobilePhoneExist', true);?>
						<div class="<?php if ((isset($_smarty_tpl->tpl_vars['one_phone_at_least']->value)) && $_smarty_tpl->tpl_vars['one_phone_at_least']->value) {?>required <?php }?>form-group">
							<label for="phone_mobile"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mobile phone'),$_smarty_tpl ) );
if ((isset($_smarty_tpl->tpl_vars['one_phone_at_least']->value)) && $_smarty_tpl->tpl_vars['one_phone_at_least']->value) {?> <sup>**</sup><?php }?></label>
							<input class="validate form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value['phone_mobile']['validate'];?>
" type="tel" id="phone_mobile" name="phone_mobile" value="<?php if ((isset($_POST['phone_mobile']))) {
echo $_POST['phone_mobile'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->phone_mobile))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->phone_mobile, ENT_QUOTES, 'UTF-8', true);
}
}?>" />
						</div>
					<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<?php if (!$_smarty_tpl->tpl_vars['postCodeExist']->value) {?>
					<div class="required postcode form-group unvisible">
						<label for="postcode"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Zip/Postal Code'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
						<input class="is_required validate form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value['postcode']['validate'];?>
" type="text" id="postcode" name="postcode" value="<?php if ((isset($_POST['postcode']))) {
echo $_POST['postcode'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->postcode))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->postcode, ENT_QUOTES, 'UTF-8', true);
}
}?>" />
					</div>
				<?php }?>
				<?php if (!$_smarty_tpl->tpl_vars['stateExist']->value) {?>
					<div class="required id_state form-group unvisible">
						<label for="id_state"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'State'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
						<select name="id_state" id="id_state" class="form-control">
							<option value="">-</option>
						</select>
					</div>
				<?php }?>
				<?php if (!$_smarty_tpl->tpl_vars['dniExist']->value) {?>
					<div class="required dni form-group unvisible">
						<label for="dni"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Identification number'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
						<input class="is_required form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value['dni']['validate'];?>
" type="text" name="dni" id="dni" value="<?php if ((isset($_POST['dni']))) {
echo $_POST['dni'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->dni))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->dni, ENT_QUOTES, 'UTF-8', true);
}
}?>" />
						<span class="form_info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'DNI / NIF / NIE'),$_smarty_tpl ) );?>
</span>
					</div>
				<?php }?>
				<div class="form-group">
					<label for="other"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Additional information'),$_smarty_tpl ) );?>
</label>
					<textarea class="validate form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value['other']['validate'];?>
" id="other" name="other" cols="26" rows="3" ><?php if ((isset($_POST['other']))) {
echo $_POST['other'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->other))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->other, ENT_QUOTES, 'UTF-8', true);
}
}?></textarea>
				</div>
				<?php if (!$_smarty_tpl->tpl_vars['homePhoneExist']->value) {?>
					<div class="form-group phone-number">
						<label for="phone"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Home phone'),$_smarty_tpl ) );?>
</label>
						<input class="<?php if ((isset($_smarty_tpl->tpl_vars['one_phone_at_least']->value)) && $_smarty_tpl->tpl_vars['one_phone_at_least']->value) {?>is_required<?php }?> validate form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value['phone']['validate'];?>
" type="tel" id="phone" name="phone" value="<?php if ((isset($_POST['phone']))) {
echo $_POST['phone'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->phone))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->phone, ENT_QUOTES, 'UTF-8', true);
}
}?>"  />
					</div>
				<?php }?>
				<?php if ((isset($_smarty_tpl->tpl_vars['one_phone_at_least']->value)) && $_smarty_tpl->tpl_vars['one_phone_at_least']->value && !$_smarty_tpl->tpl_vars['atLeastOneExists']->value) {?>
					<p class="inline-infos required"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You must register at least one phone number.'),$_smarty_tpl ) );?>
</p>
				<?php }?>
				<div class="clearfix"></div>
				<?php if (!$_smarty_tpl->tpl_vars['mobilePhoneExist']->value) {?>
					<div class="<?php if ((isset($_smarty_tpl->tpl_vars['one_phone_at_least']->value)) && $_smarty_tpl->tpl_vars['one_phone_at_least']->value) {?>required <?php }?>form-group">
						<label for="phone_mobile"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mobile phone'),$_smarty_tpl ) );
if ((isset($_smarty_tpl->tpl_vars['one_phone_at_least']->value)) && $_smarty_tpl->tpl_vars['one_phone_at_least']->value) {?> <sup>**</sup><?php }?></label>
						<input class="validate form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value['phone_mobile']['validate'];?>
" type="tel" id="phone_mobile" name="phone_mobile" value="<?php if ((isset($_POST['phone_mobile']))) {
echo $_POST['phone_mobile'];
} else {
if ((isset($_smarty_tpl->tpl_vars['address']->value->phone_mobile))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->phone_mobile, ENT_QUOTES, 'UTF-8', true);
}
}?>" />
					</div>
				<?php }?>
				<div class="required form-group" id="adress_alias">
					<label for="alias"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please assign an address title for future reference.'),$_smarty_tpl ) );?>
 <sup>*</sup></label>
					<input type="text" id="alias" class="is_required validate form-control" data-validate="<?php echo $_smarty_tpl->tpl_vars['address_validation']->value['alias']['validate'];?>
" name="alias" value="<?php if ((isset($_POST['alias']))) {
echo $_POST['alias'];
} elseif ((isset($_smarty_tpl->tpl_vars['address']->value->alias))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->alias, ENT_QUOTES, 'UTF-8', true);
} elseif (!$_smarty_tpl->tpl_vars['select_address']->value) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My address'),$_smarty_tpl ) );
}?>" />

					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayGDPRConsent','moduleName'=>'addressform'),$_smarty_tpl ) );?>

				</div>
				<p class="submit2">
					<?php if ((isset($_smarty_tpl->tpl_vars['id_address']->value))) {?><input type="hidden" name="id_address" value="<?php echo intval($_smarty_tpl->tpl_vars['id_address']->value);?>
" /><?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['back']->value))) {?><input type="hidden" name="back" value="<?php echo $_smarty_tpl->tpl_vars['back']->value;?>
" /><?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['mod']->value))) {?><input type="hidden" name="mod" value="<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
" /><?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['select_address']->value))) {?><input type="hidden" name="select_address" value="<?php echo intval($_smarty_tpl->tpl_vars['select_address']->value);?>
" /><?php }?>
					<input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
					<button type="submit" name="submitAddress" id="submitAddress" class="btn btn-default button button-medium">
						<span>
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save'),$_smarty_tpl ) );?>

							<i class="icon-chevron-right right"></i>
						</span>
					</button>
				</p>
			</form>
		<?php
}
}
/* {/block 'address_form'} */
/* {block 'address_footer_links'} */
class Block_27610174068e4f2799e0185_61603877 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<ul class="footer_links clearfix">
			<li>
				<a class="btn btn-defaul button button-small" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
">
					<span><i class="icon-chevron-left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Back to My account'),$_smarty_tpl ) );?>
</span>
				</a>
			</li>
		</ul>
	<?php
}
}
/* {/block 'address_footer_links'} */
/* {block 'adderss_js_vars'} */
class Block_40443749268e4f2799ec269_29490212 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php if ((isset($_POST['id_state'])) && $_POST['id_state']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('idSelectedState'=>intval($_POST['id_state'])),$_smarty_tpl ) );
} elseif ((isset($_smarty_tpl->tpl_vars['address']->value->id_state)) && $_smarty_tpl->tpl_vars['address']->value->id_state) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('idSelectedState'=>intval($_smarty_tpl->tpl_vars['address']->value->id_state)),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('idSelectedState'=>false),$_smarty_tpl ) );
}
if ((isset($_POST['id_country'])) && $_POST['id_country']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('idSelectedCountry'=>intval($_POST['id_country'])),$_smarty_tpl ) );
} elseif ((isset($_smarty_tpl->tpl_vars['address']->value->id_country)) && $_smarty_tpl->tpl_vars['address']->value->id_country) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('idSelectedCountry'=>intval($_smarty_tpl->tpl_vars['address']->value->id_country)),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('idSelectedCountry'=>false),$_smarty_tpl ) );
}
if ((isset($_smarty_tpl->tpl_vars['countries']->value))) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0], array( array('countries'=>$_smarty_tpl->tpl_vars['countries']->value),$_smarty_tpl ) );
}?>
	<?php
}
}
/* {/block 'adderss_js_vars'} */
/* {block 'address'} */
class Block_97852672368e4f279169ad2_38785362 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'address' => 
  array (
    0 => 'Block_97852672368e4f279169ad2_38785362',
  ),
  'address_heading' => 
  array (
    0 => 'Block_179476587068e4f2793fe042_20575003',
  ),
  'errors' => 
  array (
    0 => 'Block_169889663568e4f2794226c5_17187360',
  ),
  'address_form' => 
  array (
    0 => 'Block_139824167368e4f27968a6d8_28747997',
  ),
  'address_footer_links' => 
  array (
    0 => 'Block_27610174068e4f2799e0185_61603877',
  ),
  'adderss_js_vars' => 
  array (
    0 => 'Block_40443749268e4f2799ec269_29490212',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);?>
		<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My account'),$_smarty_tpl ) );?>

		</a>
		<span class="navigation-pipe">
			<?php echo $_smarty_tpl->tpl_vars['navigationPipe']->value;?>

		</span>
		<span class="navigation_page">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Address'),$_smarty_tpl ) );?>

		</span>
	<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php if ((isset($_GET['updated'])) && $_GET['updated']) {?>
		<p class="alert alert-success">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your address has been successfully updated.'),$_smarty_tpl ) );?>

		</p>
	<?php }?>
	<div class="box">
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_179476587068e4f2793fe042_20575003', 'address_heading', $this->tplIndex);
?>

		<p class="info-title">
			<?php if ((isset($_smarty_tpl->tpl_vars['id_address']->value)) && ((isset($_POST['alias'])) || (isset($_smarty_tpl->tpl_vars['address']->value->alias)))) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Modify address'),$_smarty_tpl ) );?>

				<?php if ((isset($_POST['alias']))) {?>
					"<?php echo $_POST['alias'];?>
"
				<?php } else { ?>
					<?php if ((isset($_smarty_tpl->tpl_vars['address']->value->alias))) {?>"<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['address']->value->alias, ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>
				<?php }?>
			<?php } else { ?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To add an address, please fill out the form below.'),$_smarty_tpl ) );?>

			<?php }?>
		</p>
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_169889663568e4f2794226c5_17187360', 'errors', $this->tplIndex);
?>

		<p class="required"><sup>*</sup><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Required field'),$_smarty_tpl ) );?>
</p>
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_139824167368e4f27968a6d8_28747997', 'address_form', $this->tplIndex);
?>

	</div>
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_27610174068e4f2799e0185_61603877', 'address_footer_links', $this->tplIndex);
?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_40443749268e4f2799ec269_29490212', 'adderss_js_vars', $this->tplIndex);
?>

<?php
}
}
/* {/block 'address'} */
}
