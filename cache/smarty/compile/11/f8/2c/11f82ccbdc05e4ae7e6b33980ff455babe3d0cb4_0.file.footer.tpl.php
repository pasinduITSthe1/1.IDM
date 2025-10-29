<?php
/* Smarty version 4.5.5, created on 2025-10-29 12:32:34
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6901bc0a2bae92_91716201',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11f82ccbdc05e4ae7e6b33980ff455babe3d0cb4' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\footer.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901bc0a2bae92_91716201 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
if (!(isset($_smarty_tpl->tpl_vars['content_only']->value)) || !$_smarty_tpl->tpl_vars['content_only']->value) {?>
					</div><!-- #center_column -->
					<?php if ((isset($_smarty_tpl->tpl_vars['right_column_size']->value)) && !empty($_smarty_tpl->tpl_vars['right_column_size']->value)) {?>
						<div id="right_column" class="col-xs-12 col-sm-<?php echo intval($_smarty_tpl->tpl_vars['right_column_size']->value);?>
 column"><?php echo $_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value;?>
</div>
					<?php }?>
					</div><!-- .row -->
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4449576816901bc0a2a0960_64723617', 'displayColumnsBottom');
?>

				</div><!-- #columns -->
			</div><!-- .columns-container -->
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14855533646901bc0a2a53b5_82813469', 'displayFooter');
?>

		</div><!-- #page -->
<?php }
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5628795246901bc0a2b63c5_16890547', 'global');
?>

	</body>
</html>
<?php }
/* {block 'displayColumnsBottom'} */
class Block_4449576816901bc0a2a0960_64723617 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayColumnsBottom' => 
  array (
    0 => 'Block_4449576816901bc0a2a0960_64723617',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayColumnsBottom'),$_smarty_tpl ) );?>

					<?php
}
}
/* {/block 'displayColumnsBottom'} */
/* {block 'displayFooterBefore'} */
class Block_8033146016901bc0a2a9474_90607863 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterBefore'),$_smarty_tpl ) );?>

					<?php
}
}
/* {/block 'displayFooterBefore'} */
/* {block 'displayAfterDefautlFooterHook'} */
class Block_4243041886901bc0a2ae865_00522116 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayAfterDefautlFooterHook"),$_smarty_tpl ) );?>

						<?php
}
}
/* {/block 'displayAfterDefautlFooterHook'} */
/* {block 'displayFooter'} */
class Block_14855533646901bc0a2a53b5_82813469 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'displayFooter' => 
  array (
    0 => 'Block_14855533646901bc0a2a53b5_82813469',
  ),
  'displayFooterBefore' => 
  array (
    0 => 'Block_8033146016901bc0a2a9474_90607863',
  ),
  'displayAfterDefautlFooterHook' => 
  array (
    0 => 'Block_4243041886901bc0a2ae865_00522116',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<?php if ((isset($_smarty_tpl->tpl_vars['HOOK_FOOTER']->value))) {?>
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8033146016901bc0a2a9474_90607863', 'displayFooterBefore', $this->tplIndex);
?>

					<!-- Footer -->
					<div class="footer-container">
						<footer id="footer"  class="container">
							<div class="row margin-btm-50"><?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>
</div>
						</footer>
						<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4243041886901bc0a2ae865_00522116', 'displayAfterDefautlFooterHook', $this->tplIndex);
?>

					</div><!-- #footer -->
				<?php }?>
			<?php
}
}
/* {/block 'displayFooter'} */
/* {block 'global'} */
class Block_5628795246901bc0a2b63c5_16890547 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'global' => 
  array (
    0 => 'Block_5628795246901bc0a2b63c5_16890547',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./global.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
}
/* {/block 'global'} */
}
