<?php
/* Smarty version 4.5.5, created on 2025-10-28 17:20:45
  from 'C:\wamp64\www\1.IDM\admin134miqa0b\themes\default\template\page_header_toolbar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6900ae15113bb7_29732471',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '232e1d7da661a5313b9c644ff6127d75d27018b6' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin134miqa0b\\themes\\default\\template\\page_header_toolbar.tpl',
      1 => 1759835419,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6900ae15113bb7_29732471 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php if (!(isset($_smarty_tpl->tpl_vars['title']->value)) && (isset($_smarty_tpl->tpl_vars['page_header_toolbar_title']->value))) {?>
	<?php $_smarty_tpl->_assignInScope('title', $_smarty_tpl->tpl_vars['page_header_toolbar_title']->value);
}
if ((isset($_smarty_tpl->tpl_vars['page_header_toolbar_btn']->value))) {?>
	<?php $_smarty_tpl->_assignInScope('toolbar_btn', $_smarty_tpl->tpl_vars['page_header_toolbar_btn']->value);
}?>

<div class="bootstrap">
	<div class="page-head">
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10021040606900ae14ece4a4_13892794', 'pageTitle');
?>


		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8181201236900ae150386f1_65065824', 'pageBreadcrumb');
?>

		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3670825766900ae15069a63_88623103', 'toolbarBox');
?>

	</div>
</div>
<?php }
/* {block 'pageTitle'} */
class Block_10021040606900ae14ece4a4_13892794 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'pageTitle' => 
  array (
    0 => 'Block_10021040606900ae14ece4a4_13892794',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<h2 class="page-title">
						<?php if (is_array($_smarty_tpl->tpl_vars['title']->value)) {
echo preg_replace('!<[^>]*?>!', ' ', (string) end($_smarty_tpl->tpl_vars['title']->value));
} else {
echo preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['title']->value);
}?>
		</h2>
		<?php
}
}
/* {/block 'pageTitle'} */
/* {block 'pageBreadcrumb'} */
class Block_8181201236900ae150386f1_65065824 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'pageBreadcrumb' => 
  array (
    0 => 'Block_8181201236900ae150386f1_65065824',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<ul class="breadcrumb page-breadcrumb">
						<?php if ($_smarty_tpl->tpl_vars['breadcrumbs2']->value['container']['name'] != '') {?>
				<li class="breadcrumb-container">
					<?php if ($_smarty_tpl->tpl_vars['breadcrumbs2']->value['container']['href'] != '') {?><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['breadcrumbs2']->value['container']['href'], ENT_QUOTES, 'UTF-8', true);?>
"><?php }?>
					<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['breadcrumbs2']->value['container']['name'], ENT_QUOTES, 'UTF-8', true);?>

					<?php if ($_smarty_tpl->tpl_vars['breadcrumbs2']->value['container']['href'] != '') {?></a><?php }?>
				</li>
			<?php }?>

						<?php if ($_smarty_tpl->tpl_vars['breadcrumbs2']->value['tab']['name'] != '' && $_smarty_tpl->tpl_vars['breadcrumbs2']->value['container']['name'] != $_smarty_tpl->tpl_vars['breadcrumbs2']->value['tab']['name']) {?>
				<li class="breadcrumb-current">
					<?php if ($_smarty_tpl->tpl_vars['breadcrumbs2']->value['tab']['href'] != '') {?><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['breadcrumbs2']->value['tab']['href'], ENT_QUOTES, 'UTF-8', true);?>
"><?php }?>
					<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['breadcrumbs2']->value['tab']['name'], ENT_QUOTES, 'UTF-8', true);?>

					<?php if ($_smarty_tpl->tpl_vars['breadcrumbs2']->value['tab']['href'] != '') {?></a><?php }?>
				</li>
			<?php }?>

									</ul>
		<?php
}
}
/* {/block 'pageBreadcrumb'} */
/* {block 'toolbarBox'} */
class Block_3670825766900ae15069a63_88623103 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'toolbarBox' => 
  array (
    0 => 'Block_3670825766900ae15069a63_88623103',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<div class="page-bar toolbarBox">
			<div class="btn-toolbar">
				<a href="#" class="toolbar_btn dropdown-toolbar navbar-toggle" data-toggle="collapse" data-target="#toolbar-nav"><i class="process-icon-dropdown"></i><div><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Menu'),$_smarty_tpl ) );?>
</div></a>
				<ul id="toolbar-nav" class="nav nav-pills pull-right collapse navbar-collapse">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['toolbar_btn']->value, 'btn', false, 'k');
$_smarty_tpl->tpl_vars['btn']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['btn']->value) {
$_smarty_tpl->tpl_vars['btn']->do_else = false;
?>
					<?php if ($_smarty_tpl->tpl_vars['k']->value != 'back' && $_smarty_tpl->tpl_vars['k']->value != 'modules-list') {?>
					<li>
						<a id="page-header-desc-<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
-<?php if ((isset($_smarty_tpl->tpl_vars['btn']->value['imgclass']))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['btn']->value['imgclass'], ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->tpl_vars['k']->value;
}?>" class="toolbar_btn <?php if ((isset($_smarty_tpl->tpl_vars['btn']->value['target'])) && $_smarty_tpl->tpl_vars['btn']->value['target']) {?> _blank<?php }?> pointer"<?php if ((isset($_smarty_tpl->tpl_vars['btn']->value['href']))) {?> href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['btn']->value['href'], ENT_QUOTES, 'UTF-8', true);?>
"<?php }?> title="<?php if ((isset($_smarty_tpl->tpl_vars['btn']->value['help']))) {
echo $_smarty_tpl->tpl_vars['btn']->value['help'];
} else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['btn']->value['desc'], ENT_QUOTES, 'UTF-8', true);
}?>"<?php if ((isset($_smarty_tpl->tpl_vars['btn']->value['js'])) && $_smarty_tpl->tpl_vars['btn']->value['js']) {?> onclick="<?php echo $_smarty_tpl->tpl_vars['btn']->value['js'];?>
"<?php }
if ((isset($_smarty_tpl->tpl_vars['btn']->value['modal_target'])) && $_smarty_tpl->tpl_vars['btn']->value['modal_target']) {?> data-target="<?php echo $_smarty_tpl->tpl_vars['btn']->value['modal_target'];?>
" data-toggle="modal"<?php }
if ((isset($_smarty_tpl->tpl_vars['btn']->value['help']))) {?> data-toggle="tooltip" data-placement="bottom"<?php }?>>
							<i class="<?php if ((isset($_smarty_tpl->tpl_vars['btn']->value['icon']))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['btn']->value['icon'], ENT_QUOTES, 'UTF-8', true);
} else { ?>process-icon-<?php if ((isset($_smarty_tpl->tpl_vars['btn']->value['imgclass']))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['btn']->value['imgclass'], ENT_QUOTES, 'UTF-8', true);
} else {
echo $_smarty_tpl->tpl_vars['k']->value;
}
}
if ((isset($_smarty_tpl->tpl_vars['btn']->value['class']))) {?> <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['btn']->value['class'], ENT_QUOTES, 'UTF-8', true);
}?>"></i>
							<span<?php if ((isset($_smarty_tpl->tpl_vars['btn']->value['force_desc'])) && $_smarty_tpl->tpl_vars['btn']->value['force_desc'] == true) {?> class="locked"<?php }?>><?php echo $_smarty_tpl->tpl_vars['btn']->value['desc'];?>
</span>
						</a>
					</li>
					<?php }?>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<?php if ((isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']))) {?>
					<li>
						<a id="page-header-desc-<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
-<?php if ((isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['imgclass']))) {
echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['imgclass'];
} else { ?>modules-list<?php }?>" class="toolbar_btn<?php if ((isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['class']))) {?> <?php echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['class'];
}
if ((isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['target'])) && $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['target']) {?> _blank<?php }?>" <?php if ((isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['href']))) {?>href="<?php echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['href'];?>
"<?php }?> title="<?php echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['desc'];?>
"<?php if ((isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['js'])) && $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['js']) {?> onclick="<?php echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['js'];?>
"<?php }?>>
							<i class="<?php if ((isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['icon']))) {
echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['icon'];
} else { ?>process-icon-<?php if ((isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['imgclass']))) {
echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['imgclass'];
} else { ?>modules-list<?php }
}?>"></i>
							<span<?php if ((isset($_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['force_desc'])) && $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['force_desc'] == true) {?> class="locked"<?php }?>><?php echo $_smarty_tpl->tpl_vars['toolbar_btn']->value['modules-list']['desc'];?>
</span>
						</a>
					</li>
					<?php }?>
									</ul>
				<?php echo '<script'; ?>
 type="text/javascript">
				//<![CDATA[
					var modules_list_loaded = false;
					<?php if ((isset($_smarty_tpl->tpl_vars['tab_modules_open']->value)) && $_smarty_tpl->tpl_vars['tab_modules_open']->value) {?>
						$(function() {
								$('#modules_list_container').modal('show');
								openModulesList();

						});
					<?php }?>
					$('.process-icon-modules-list').parent('a').unbind().bind('click', async function (){
						let loggedIn = await checkIfEmployeeIsLoggedIn();

						if (loggedIn) {
							$('#modules_list_container').modal('show');
							openModulesList();
						} else {
							window.location = window.location.pathname;
						}
					});
				//]]>
				<?php echo '</script'; ?>
>
			</div>
		</div>
		<?php
}
}
/* {/block 'toolbarBox'} */
}
