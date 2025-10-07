<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:23
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\password.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f28b81b523_67790429',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f85e3c109f3c04da47c77284a0326f3b443eba55' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\password.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f28b81b523_67790429 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_39018354768e4f28b6de9f9_17890912', 'password');
?>

<?php }
/* {block 'password_heading'} */
class Block_51298946768e4f28b715480_64703952 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<h1 class="page-subheading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Forgot your password?'),$_smarty_tpl ) );?>
</h1>
	<?php
}
}
/* {/block 'password_heading'} */
/* {block 'errors'} */
class Block_154162810868e4f28b725380_38486315 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php
}
}
/* {/block 'errors'} */
/* {block 'displayForgotPasswordFormFieldsAfter'} */
class Block_60536992768e4f28b7d8381_82236829 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayForgotPasswordFormFieldsAfter'),$_smarty_tpl ) );?>

				<?php
}
}
/* {/block 'displayForgotPasswordFormFieldsAfter'} */
/* {block 'password_form_action'} */
class Block_29265535168e4f28b7ec010_69089877 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<p class="submit">
						<button type="submit" class="btn button button-medium"><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Retrieve Password'),$_smarty_tpl ) );?>
&nbsp;<i class="icon-chevron-right right"></i></span></button>
					</p>
				<?php
}
}
/* {/block 'password_form_action'} */
/* {block 'password_form'} */
class Block_25402503968e4f28b7a0a29_98819606 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<form action="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['request_uri']->value, ENT_QUOTES, 'UTF-8', true);?>
" method="post" class="std" id="form_forgotpassword">
			<fieldset>
				<div class="form-group">
					<label for="email"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email address'),$_smarty_tpl ) );?>
</label>
					<input class="form-control" type="email" id="email" name="email" value="<?php if ((isset($_POST['email']))) {
echo stripslashes(htmlspecialchars((string)$_POST['email'], ENT_QUOTES, 'UTF-8', true));
}?>" />
				</div>
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_60536992768e4f28b7d8381_82236829', 'displayForgotPasswordFormFieldsAfter', $this->tplIndex);
?>

				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_29265535168e4f28b7ec010_69089877', 'password_form_action', $this->tplIndex);
?>

			</fieldset>
		</form>
	<?php
}
}
/* {/block 'password_form'} */
/* {block 'password'} */
class Block_39018354768e4f28b6de9f9_17890912 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'password' => 
  array (
    0 => 'Block_39018354768e4f28b6de9f9_17890912',
  ),
  'password_heading' => 
  array (
    0 => 'Block_51298946768e4f28b715480_64703952',
  ),
  'errors' => 
  array (
    0 => 'Block_154162810868e4f28b725380_38486315',
  ),
  'password_form' => 
  array (
    0 => 'Block_25402503968e4f28b7a0a29_98819606',
  ),
  'displayForgotPasswordFormFieldsAfter' => 
  array (
    0 => 'Block_60536992768e4f28b7d8381_82236829',
  ),
  'password_form_action' => 
  array (
    0 => 'Block_29265535168e4f28b7ec010_69089877',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);?><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Authentication'),$_smarty_tpl ) );?>
" rel="nofollow"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Authentication'),$_smarty_tpl ) );?>
</a><span class="navigation-pipe"><?php echo $_smarty_tpl->tpl_vars['navigationPipe']->value;?>
</span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Forgot your password'),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<div class="box">
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_51298946768e4f28b715480_64703952', 'password_heading', $this->tplIndex);
?>


	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_154162810868e4f28b725380_38486315', 'errors', $this->tplIndex);
?>


	<?php if ((isset($_smarty_tpl->tpl_vars['confirmation']->value)) && $_smarty_tpl->tpl_vars['confirmation']->value == 1) {?>
	<p class="alert alert-success"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your password has been successfully reset and a confirmation has been sent to your email address:'),$_smarty_tpl ) );?>
 <?php if ((isset($_smarty_tpl->tpl_vars['customer_email']->value))) {
echo stripslashes(htmlspecialchars((string)$_smarty_tpl->tpl_vars['customer_email']->value, ENT_QUOTES, 'UTF-8', true));
}?></p>
	<?php } elseif ((isset($_smarty_tpl->tpl_vars['confirmation']->value)) && $_smarty_tpl->tpl_vars['confirmation']->value == 2) {?>
	<p class="alert alert-success"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'A confirmation email has been sent to your address:'),$_smarty_tpl ) );?>
 <?php if ((isset($_smarty_tpl->tpl_vars['customer_email']->value))) {
echo stripslashes(htmlspecialchars((string)$_smarty_tpl->tpl_vars['customer_email']->value, ENT_QUOTES, 'UTF-8', true));
}?></p>
	<?php } else { ?>
	<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please enter the email address you used to register. We will then send you a new password. '),$_smarty_tpl ) );?>
</p>
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_25402503968e4f28b7a0a29_98819606', 'password_form', $this->tplIndex);
?>

	<?php }?>
	</div>
	<ul class="clearfix footer_links">
		<li><a class="btn button button-small" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Back to Login'),$_smarty_tpl ) );?>
" rel="nofollow"><span><i class="icon-chevron-left"></i>&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Back to Login'),$_smarty_tpl ) );?>
</span></a></li>
	</ul>
<?php
}
}
/* {/block 'password'} */
}
