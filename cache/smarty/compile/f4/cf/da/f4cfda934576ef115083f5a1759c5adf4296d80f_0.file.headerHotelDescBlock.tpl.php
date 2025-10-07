<?php
/* Smarty version 4.5.5, created on 2025-10-07 16:33:15
  from 'C:\wamp64\www\1.IDM\modules\hotelreservationsystem\views\templates\hook\headerHotelDescBlock.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f373e67760_41450649',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f4cfda934576ef115083f5a1759c5adf4296d80f' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\hotelreservationsystem\\views\\templates\\hook\\headerHotelDescBlock.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f373e67760_41450649 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_184881269268e4f373e4ffd5_21669368', 'header_hotel_block');
?>

<?php }
/* {block 'header_hotel_chain_name'} */
class Block_132481077068e4f373e54072_25942656 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

									<h1 class="header-hotel-name"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['WK_HTL_CHAIN_NAME']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</h1>
								<?php
}
}
/* {/block 'header_hotel_chain_name'} */
/* {block 'header_hotel_description'} */
class Block_130532420668e4f373e5b236_83563014 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

									<p class="header-hotel-desc"><?php echo htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['WK_HTL_TAG_LINE']->value, 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true);?>
</p>
								<?php
}
}
/* {/block 'header_hotel_description'} */
/* {block 'displayAfterHeaderHotelDesc'} */
class Block_49500893668e4f373e61c55_65955660 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayAfterHeaderHotelDesc"),$_smarty_tpl ) );?>

					<?php
}
}
/* {/block 'displayAfterHeaderHotelDesc'} */
/* {block 'header_hotel_block'} */
class Block_184881269268e4f373e4ffd5_21669368 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_hotel_block' => 
  array (
    0 => 'Block_184881269268e4f373e4ffd5_21669368',
  ),
  'header_hotel_chain_name' => 
  array (
    0 => 'Block_132481077068e4f373e54072_25942656',
  ),
  'header_hotel_description' => 
  array (
    0 => 'Block_130532420668e4f373e5b236_83563014',
  ),
  'displayAfterHeaderHotelDesc' => 
  array (
    0 => 'Block_49500893668e4f373e61c55_65955660',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div class="header-desc-container">
		<div class="header-desc-wrapper">
			<div class="header-desc-primary">
				<div class="container">
					<div class="row">
						<div class="col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
							<p class="header-desc-welcome"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Welcome To','mod'=>'hotelreservationsystem'),$_smarty_tpl ) );?>
</p>
							<hr class="heasder-desc-hr-first"/>
							<div class="header-desc-inner-wrapper">
								<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_132481077068e4f373e54072_25942656', 'header_hotel_chain_name', $this->tplIndex);
?>

								<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_130532420668e4f373e5b236_83563014', 'header_hotel_description', $this->tplIndex);
?>

								<hr class="heasder-desc-hr-second"/>
							</div>
						</div>
					</div>
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_49500893668e4f373e61c55_65955660', 'displayAfterHeaderHotelDesc', $this->tplIndex);
?>

				</div>
			</div>
		</div>
	</div>
<?php
}
}
/* {/block 'header_hotel_block'} */
}
