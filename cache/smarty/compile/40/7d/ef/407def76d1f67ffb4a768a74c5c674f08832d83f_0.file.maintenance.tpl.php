<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:09
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\maintenance.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27daaf4a8_70123962',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '407def76d1f67ffb4a768a74c5c674f08832d83f' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\maintenance.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27daaf4a8_70123962 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.regex_replace.php','function'=>'smarty_modifier_regex_replace',),));
?>

<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['language_code']->value, ENT_QUOTES, 'UTF-8', true);?>
">

<head>
	<meta charset="utf-8">
	<title><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true);?>
</title>
	<?php if ((isset($_smarty_tpl->tpl_vars['meta_description']->value))) {?>
		<meta name="description" content="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['meta_description']->value, ENT_QUOTES, 'UTF-8', true);?>
">
	<?php }?>
	<?php if ((isset($_smarty_tpl->tpl_vars['meta_keywords']->value))) {?>
		<meta name="keywords" content="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['meta_keywords']->value, ENT_QUOTES, 'UTF-8', true);?>
">
	<?php }?>
	<meta name="robots" content="<?php if ((isset($_smarty_tpl->tpl_vars['nobots']->value))) {?>no<?php }?>index,follow">
	<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['favicon_url']->value;?>
">
	<link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
maintenance.css" rel="stylesheet">
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
js/jquery/jquery-1.11.0.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
maintenance.js"><?php echo '</script'; ?>
>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:600' rel='stylesheet'>
</head>

<body>
	<div id="maintenance">
		<div class="header-container<?php if (count($_smarty_tpl->tpl_vars['languages']->value) > 1) {?> multilang<?php }?>">
			<div class="logo-container">
				<img src="<?php echo $_smarty_tpl->tpl_vars['logo_url']->value;?>
" alt="logo" />
			</div>
			<?php if (count($_smarty_tpl->tpl_vars['languages']->value) > 1) {?>
				<div class="language-selector-wrap">
					<div class="dropdown">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
							<?php if ($_smarty_tpl->tpl_vars['language']->value['iso_code'] == $_smarty_tpl->tpl_vars['lang_iso']->value) {?>
								<button class="dropdown-toggle" type="button" data-toggle="dropdown">
									<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['language']->value['name'],'/\s\(.*\)$/','');?>

									<span class="caret"></span>
								</button>
							<?php }?>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

						<ul class="dropdown-menu">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
								<li <?php if ($_smarty_tpl->tpl_vars['language']->value['iso_code'] == $_smarty_tpl->tpl_vars['lang_iso']->value) {?>class="disabled"<?php }?>>
									<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getLanguageLink($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
">
										<span><?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['language']->value['name'],'/\s\(.*\)$/','');?>
</span>
									</a>
								</li>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</ul>
					</div>
				</div>
			<?php }?>
		</div>
		<div class="margin-l-r">
			<?php if ((isset($_smarty_tpl->tpl_vars['errors']->value)) && $_smarty_tpl->tpl_vars['errors']->value) {?>
				<div class="alert alert-danger">
					<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Error!'),$_smarty_tpl ) );?>
</strong>
					<ol>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'error', false, 'k');
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
?>
							<li><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</li>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</ol>
				</div>
			<?php }?>
		</div>
		<div class="containter">
			<div class="left">
				<div class="">
					<img class="" src="<?php echo $_smarty_tpl->tpl_vars['img_ps_dir']->value;?>
maintenance_banner.png"></img>
				</div>
			</div>
			<div class="right">
				<h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'We\'ll be back soon.'),$_smarty_tpl ) );?>
</h2>
				<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'We are currently updating our site and will be back really soon.'),$_smarty_tpl ) );?>
</p>
				<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Thanks for your patience!'),$_smarty_tpl ) );?>
</p>
				<?php if ((isset($_smarty_tpl->tpl_vars['allowEmployee']->value)) && $_smarty_tpl->tpl_vars['allowEmployee']->value) {?>
					<div>
						<p class="clicker blue" tabindex="1"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Are you a member?'),$_smarty_tpl ) );?>
</p>
						<div class="login-form-wrap" <?php if (!(isset($_POST['SubmitLogin']))) {?>style="display:none;"<?php }?>>
							<form action="" method="post">
								<div class="form_content clearfix">
									<div class="form-group form-ok">
										<label class="" for="email"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email address'),$_smarty_tpl ) );?>
</label>
										<br>
										<input class="form-control" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email'),$_smarty_tpl ) );?>
" type="email" id="email" name="email" <?php if ((isset($_POST['SubmitLogin']))) {?>value="<?php echo htmlspecialchars((string)$_POST['email'], ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>>
									</div>
									<div class="form-group form-ok">
										<label class="" for="passwd"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password'),$_smarty_tpl ) );?>
</label>
										<br>
										<input class="form-control" type="password" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Password'),$_smarty_tpl ) );?>
" id="passwd" name="passwd" value="">
									</div>
									<button type="submit" id="SubmitLogin" name="SubmitLogin" class="btn btn-primary">
										<span>
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in'),$_smarty_tpl ) );?>

										</span>
									</button>
									<button type="button" id="cancelLogin" name="cancelLogin"
										class="btn btn-primary cancel-login">
										<span>
											<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel'),$_smarty_tpl ) );?>

										</span>
									</button>
								</div>
							</form>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
</body>

</html><?php }
}
