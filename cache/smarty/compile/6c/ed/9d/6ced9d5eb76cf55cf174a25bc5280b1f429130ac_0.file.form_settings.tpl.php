<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:41
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\referrers\form_settings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29d0b7d57_64262689',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6ced9d5eb76cf55cf174a25bc5280b1f429130ac' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\referrers\\form_settings.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29d0b7d57_64262689 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row">
	<div class="col-lg-6">
			<form action="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['current']->value, ENT_QUOTES, 'UTF-8', true);?>
&amp;token=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['token']->value, ENT_QUOTES, 'UTF-8', true);?>
" method="post" id="refresh_index_form" name="refresh_index_form" class="form-horizontal">
				<div class="panel">
					<h3>
						<i class="icon-fullscreen"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Indexing'),$_smarty_tpl ) );?>

					</h3>
					<div class="alert alert-info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There is a huge quantity of data, so each connection corresponding to a referrer is indexed. You can also refresh this index by clicking the "Refresh index" button. This process may take a while, and it\'s only needed if you modified or added a referrer, or if you want changes to be retroactive.'),$_smarty_tpl ) );?>
</div>
					<button type="submit" class="btn btn-default" name="submitRefreshIndex" id="submitRefreshIndex">
						<i class="icon-refresh"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refresh index'),$_smarty_tpl ) );?>

					</button>
				</div>
			</form>
		</div>
		<div class="col-lg-6">
			<form action="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['current']->value, ENT_QUOTES, 'UTF-8', true);?>
&amp;token=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['token']->value, ENT_QUOTES, 'UTF-8', true);?>
" method="post" id="refresh_cache_form" name="refresh_cache_form" class="form-horizontal">
				<div class="panel">
					<h3>
						<i class="icon-briefcase"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cache'),$_smarty_tpl ) );?>

					</h3>
					<div class="alert alert-info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your data is cached in order to sort it and filter it. You can refresh the cache by clicking on the "Refresh cache" button.'),$_smarty_tpl ) );?>
</div>
					<button type="submit" class="btn btn-default" name="submitRefreshCache" id="submitRefreshCache">
						<i class="icon-refresh"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refresh cache'),$_smarty_tpl ) );?>

					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="settings_referrers" class="row">
	<div class="col-lg-3">
		<form action="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['current']->value, ENT_QUOTES, 'UTF-8', true);?>
&amp;token=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['token']->value, ENT_QUOTES, 'UTF-8', true);?>
" method="post" id="settings_form" name="settings_form" class="form-horizontal">
			<div class="panel">
				<h3>
					<i class="icon-cog"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Settings'),$_smarty_tpl ) );?>

				</h3>
				<div class="alert alert-info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Direct traffic can be quite resource-intensive. You should consider enabling it only if you have a strong need for it.'),$_smarty_tpl ) );?>
</div>
				<div class="form-group">
					<label class="control-label col-lg-6"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save direct traffic?'),$_smarty_tpl ) );?>
</label>
					<div class="col-lg-6">
						<div class="row">
							<div class="input-group fixed-width-md">
								<span class="switch prestashop-switch">
									<input type="radio" name="tracking_dt" id="tracking_dt_on" value="1" <?php if ($_smarty_tpl->tpl_vars['tracking_dt']->value) {?>checked="checked"<?php }?> />
									<label class="t" for="tracking_dt_on">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes'),$_smarty_tpl ) );?>

									</label>
									<input type="radio" name="tracking_dt" id="tracking_dt_off" value="0" <?php if (!$_smarty_tpl->tpl_vars['tracking_dt']->value) {?>checked="checked"<?php }?>  />
									<label class="t" for="tracking_dt_off">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No'),$_smarty_tpl ) );?>

									</label>
									<a class="slide-button btn"></a>
								</span>
							</div>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-default" name="submitSettings" id="submitSettings">
					<i class="icon-save"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save'),$_smarty_tpl ) );?>

				</button>
			</div>
		</form>
	</div>
	<?php if ($_smarty_tpl->tpl_vars['statsdata_name']->value) {?>
		<div class="col-lg-3">
			<div class="panel">
				<div class="alert alert-info">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"The module '%s' must be activated and configured in order to have all the statistics.",'sprintf'=>$_smarty_tpl->tpl_vars['statsdata_name']->value),$_smarty_tpl ) );?>

				</div>
			</div>
		</div>
	<?php }?>
	</div>


	
<?php }
}
