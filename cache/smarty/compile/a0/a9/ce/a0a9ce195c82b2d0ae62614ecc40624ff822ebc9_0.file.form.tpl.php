<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:21
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\normal_products\helpers\form\form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2895a1025_46211343',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a0a9ce195c82b2d0ae62614ecc40624ff822ebc9' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\normal_products\\helpers\\form\\form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2895a1025_46211343 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_111463707268e4f2893a53c6_23733250', "autoload_tinyMCE");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_135251577868e4f2893c4119_09557892', "defaultForm");
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/form/form.tpl");
}
/* {block "autoload_tinyMCE"} */
class Block_111463707268e4f2893a53c6_23733250 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'autoload_tinyMCE' => 
  array (
    0 => 'Block_111463707268e4f2893a53c6_23733250',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	// Execute when tab Informations has finished loading
	tabs_manager.onLoad('Informations', function(){
		tinySetup({
			editor_selector :"autoload_rte",
			setup : function(ed) {
				ed.on('init', function(ed)
				{
					if (typeof ProductMultishop.load_tinymce[ed.target.id] != 'undefined')
					{
						if (typeof ProductMultishop.load_tinymce[ed.target.id])
							tinyMCE.get(ed.target.id).hide();
						else
							tinyMCE.get(ed.target.id).show();
					}
				});

				ed.on('keydown', function(ed, e) {
					tinyMCE.triggerSave();
					textarea = $('#'+tinymce.activeEditor.id);
					var max = textarea.parent('div').find('span.counter').data('max');
					if (max != 'none')
					{
						count = tinyMCE.activeEditor.getBody().textContent.length;
						rest = max - count;
						if (rest < 0)
							textarea.parent('div').find('span.counter').html('<span style="color:red;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Maximum'),$_smarty_tpl ) );?>
 '+ max +' <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'characters'),$_smarty_tpl ) );?>
 : '+rest+'</span>');
						else
							textarea.parent('div').find('span.counter').html(' ');
					}
				});
			}
		});
	});
<?php
}
}
/* {/block "autoload_tinyMCE"} */
/* {block "defaultForm"} */
class Block_135251577868e4f2893c4119_09557892 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'defaultForm' => 
  array (
    0 => 'Block_135251577868e4f2893c4119_09557892',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div class="row">
		<div class="productTabs col-lg-2 col-md-3">
			<div class="list-group">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_tabs']->value, 'tab', false, 'numStep');
$_smarty_tpl->tpl_vars['tab']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['numStep']->value => $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->do_else = false;
?>
				<?php if ($_smarty_tpl->tpl_vars['tab']->value['name'] != "Pack") {?>
					<a class="list-group-item <?php if ($_smarty_tpl->tpl_vars['tab']->value['selected']) {?>active<?php }?>" id="link-<?php echo $_smarty_tpl->tpl_vars['tab']->value['id'];?>
" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['tab']->value['href'], ENT_QUOTES, 'UTF-8', true);?>
&amp;updateproduct"><?php echo $_smarty_tpl->tpl_vars['tab']->value['name'];?>
</a>
				<?php }?>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</div>
		</div>
		<?php echo '<script'; ?>
 type="text/javascript">
			var id_product = <?php if ((isset($_smarty_tpl->tpl_vars['product']->value->id))) {
echo intval($_smarty_tpl->tpl_vars['product']->value->id);
} else { ?>0<?php }?>;
			var id_lang_default = <?php echo intval($_smarty_tpl->tpl_vars['id_lang_default']->value);?>
;
			var product_type_pack = <?php echo intval(Product::PTYPE_PACK);?>
;
			var product_type_virtual = <?php echo intval(Product::PTYPE_VIRTUAL);?>
;
			var product_type_simple = <?php echo intval(Product::PTYPE_SIMPLE);?>
;

			var SELLING_PREFERENCE_WITH_ROOM_TYPE = <?php echo intval(Product::SELLING_PREFERENCE_WITH_ROOM_TYPE);?>
;
			var SELLING_PREFERENCE_HOTEL_STANDALONE = <?php echo intval(Product::SELLING_PREFERENCE_HOTEL_STANDALONE);?>
;
			var SELLING_PREFERENCE_HOTEL_STANDALONE_AND_WITH_ROOM_TYPE = <?php echo intval(Product::SELLING_PREFERENCE_HOTEL_STANDALONE_AND_WITH_ROOM_TYPE);?>
;
			var SELLING_PREFERENCE_STANDALONE = <?php echo intval(Product::SELLING_PREFERENCE_STANDALONE);?>
;

			var price_addition_type_with_room = <?php echo intval(Product::PRICE_ADDITION_TYPE_WITH_ROOM);?>
;
			var price_addition_type_independent = <?php echo intval(Product::PRICE_ADDITION_TYPE_INDEPENDENT);?>
;


			var has_combinations = <?php echo intval($_smarty_tpl->tpl_vars['has_combinations']->value);?>
;

			var empty_pack_msg = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This pack is empty. You will need to add at least one product to the pack before you can save.','js'=>1),$_smarty_tpl ) );?>
';
			var empty_name_msg = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The product name is empty. You will at least need to enter a name for the default language before you can save the product.','js'=>1),$_smarty_tpl ) );?>
';
			var empty_link_rewrite_msg = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The friendly URL is empty. You will at least need to enter a friendly URL for the default language before you can save the product.','slashes'=>1),$_smarty_tpl ) );?>
';
			var reload_tab_title = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Confirmation','slashes'=>1),$_smarty_tpl ) );?>
';
			var reload_tab_description = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'A server error occurred while loading the tabs: some tabs could not be loaded.','js'=>1),$_smarty_tpl ) );?>
'+'\n'+'<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please try again by refreshing the page.','js'=>1),$_smarty_tpl ) );?>
'+'\n'+'<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If you are still encountering this problem, please check your server logs or contact your hosting provider for assistance.','js'=>1),$_smarty_tpl ) );?>
';

			$('#product-tab-content-wait').show();
			var post_data = <?php echo $_smarty_tpl->tpl_vars['post_data']->value;?>
;
			var save_error = <?php if ($_smarty_tpl->tpl_vars['save_error']->value) {?>true<?php } else { ?>false<?php }?>;
			var error_heading_msg = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Error','js'=>1),$_smarty_tpl ) );?>
';
			var error_continue_msg = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Continue','js'=>1),$_smarty_tpl ) );?>
';

			var product_type = <?php echo $_smarty_tpl->tpl_vars['product_type']->value;?>
;
						<?php if ((isset($_smarty_tpl->tpl_vars['display_multishop_checkboxes']->value)) && $_smarty_tpl->tpl_vars['display_multishop_checkboxes']->value) {?>
				var display_multishop_checkboxes = true;
			<?php } else { ?>
				var display_multishop_checkboxes = false;
			<?php }?>

			var tabs_to_preload = new Array();
			var mod_evasive = <?php if ((isset($_smarty_tpl->tpl_vars['mod_evasive']->value)) && $_smarty_tpl->tpl_vars['mod_evasive']->value) {?>true<?php } else { ?>false<?php }?>;
			var mod_security = <?php if ((isset($_smarty_tpl->tpl_vars['mod_security']->value)) && $_smarty_tpl->tpl_vars['mod_security']->value) {?>true<?php } else { ?>false<?php }?>;

			$(document).ready(function()
			{
				
				
								$(".productTabs a").click(function(e){
					e.preventDefault();
					// currentId is the current product tab id
					currentId = false;
					if ($(".productTabs a.active").length)
						currentId = $(".productTabs a.active").attr('id').substr(5);
					// id is the wanted producttab id
					id = $(this).attr('id').substr(5);

					// Update submit button value
					var split_position = id.indexOf('-') + 1;
					var btn_name = id.substr(split_position);

					if ((btn_name == 'VirtualProduct' || btn_name == 'Pack') && $('#name_' + id_lang_default).val() == '')
					{
						alert(missing_product_name);
						$('#name_' + id_lang_default).focus();
						return false;
					}

					$('#key_tab').val(btn_name);

					if ($(this).attr("id") != $(".productTabs a.active ").attr('id'))
					{
						$(".productTabs a").removeClass('active');
						$("#product-tab-content-"+currentId).hide();
					}

					// if the tab has not already been loaded, load it now
					tabs_manager.display(id, true);

					tabs_manager.onLoad(id, function(){
						$("#product-tab-content-"+id).show(0, function(){
							$(this).trigger('displayed');
						});
						$("#link-"+id).addClass('active');
					});

					var languages = new Array();
					if (btn_name == "Combinations")
					{
						$('#desc-product-new').hide();
						$('#desc-product-newCombination').show();
						populate_attrs();
					}
					else if (btn_name == "Attachments")
					{
						handleSaveButtons();
					}
					else
					{
						$('#desc-product-newCombination').hide();
						// if pack is enabled, save button are visible only if pack is valid
						if ($("input[name='id_product']").val() != 0 || btn_name != 'Informations')
							handleSaveButtons();
					}

					$('.label-tooltip').tooltip();
				});

				$(".productTabs a.active").click();

				// disable save if Associations tab is not loaded
				if ($('#product-tab-content-Associations').hasClass('not-loaded'))
					disableSave();

				tabs_manager.onLoad('Associations', function(){
					if ($("input[name='id_product']").val() != 0)
						handleSaveButtons();
				});

				$('.confirm_leave').live('click', function(){
					// Double quotes are necessary when the translated string has single quotes
					return confirm("<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You will lose all unsaved modifications. Are you sure that you want to proceed?','js'=>1),$_smarty_tpl ) );?>
");
				});

				$('#toolbar-footer').appendTo($('#product-tab-content-Informations').children('.product-tab'));

				$('.product-tab-content').on('displayed', function(e) {
					$('#toolbar-footer').appendTo($(this).children('.product-tab'));
				});

			});

			// Listen to the load event that is fired each time an ajax call to load a tab has completed
			$(window).bind("load", function() {
								var tabs_to_preload = new Array();
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tabs_preloaded']->value, 'value', false, 'tab_name');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tab_name']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
										<?php if ((is_numeric($_smarty_tpl->tpl_vars['value']->value))) {?>
						if ($("#product-tab-content-"+'<?php echo $_smarty_tpl->tpl_vars['tab_name']->value;?>
').hasClass('not-loaded'))
							tabs_to_preload.push('<?php echo $_smarty_tpl->tpl_vars['tab_name']->value;?>
');
					<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				tabs_manager.tabs_to_preload = tabs_to_preload.slice(0);
				tabs_manager.displayBulk(tabs_to_preload);
				$('.productTabs').show();
				$('#product-tab-content-wait').hide();

				function checkIfProductTypeIsPack() {
					var typeIsPack = $('#pack_product').is(':checked');
					if (typeIsPack && $('#inputPackItems').val()=='' ) {
						$('.pack-empty-warning').removeClass('alert-warning').addClass('alert-danger');
						$('#curPackItemName').select2('open');
					}
					return typeIsPack;
				}
			});
		<?php echo '</script'; ?>
>

		<?php echo '<script'; ?>
 type="text/javascript">
			// <![CDATA[
				ThickboxI18nImage = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Image'),$_smarty_tpl ) );?>
";
				ThickboxI18nOf = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'of'),$_smarty_tpl ) );?>
";
				ThickboxI18nClose = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Close'),$_smarty_tpl ) );?>
";
				ThickboxI18nOrEscKey = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(or "Esc")'),$_smarty_tpl ) );?>
";
				ThickboxI18nNext = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Next >'),$_smarty_tpl ) );?>
";
				ThickboxI18nPrev = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'< Previous'),$_smarty_tpl ) );?>
";
				tb_pathToImage = "../img/loadingAnimation.gif";
			//]]>
		<?php echo '</script'; ?>
>

		<div id="product-tab-content-wait" style="display:none">
			<div id="loading"><i class="icon-refresh icon-spin"></i>&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Loading...'),$_smarty_tpl ) );?>
</div>
		</div>

		<form id="product_form" class="form-horizontal col-lg-10 col-md-9" action="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['form_action']->value, ENT_QUOTES, 'UTF-8', true);?>
" method="post" enctype="multipart/form-data" name="product" novalidate>
			<input type="hidden" name="id_product" value="<?php echo $_smarty_tpl->tpl_vars['id_product']->value;?>
" />
						<!-- changed input field to make product virtual by default -->
			<input type="hidden" id="is_virtual" name="is_virtual" value="1"/>

			<?php if ((isset($_REQUEST['page'])) && $_REQUEST['page'] > 1) {?>
				<input type="hidden" id="page" name="page" value="<?php echo intval($_REQUEST['page']);?>
" />
			<?php }?>
			<?php if (!$_smarty_tpl->tpl_vars['product']->value->active && $_smarty_tpl->tpl_vars['product']->value->isAssociatedToShop()) {?>
			<div class="alert alert-info draft">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your product will be saved as a draft.'),$_smarty_tpl ) );?>

				<a href="#" class="btn btn-default" onclick="submitAddProduct()" ><i class="icon-save"></i>&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save'),$_smarty_tpl ) );?>
</a>
				<input type="hidden" name="submitAddProduct" id="submitAddProduct" />
			</div>
			<?php }?>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_tabs']->value, 'tab', false, 'numStep');
$_smarty_tpl->tpl_vars['tab']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['numStep']->value => $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->do_else = false;
?>
				<?php if ($_smarty_tpl->tpl_vars['tab']->value['id'] != "Pack") {?>
				<div id="product-tab-content-<?php echo $_smarty_tpl->tpl_vars['tab']->value['id'];?>
" class="<?php if (!$_smarty_tpl->tpl_vars['tab']->value['selected']) {?>not-loaded<?php }?> product-tab-content" <?php if (!$_smarty_tpl->tpl_vars['tab']->value['selected']) {?>style="display:none"<?php }?>>
					<?php if ($_smarty_tpl->tpl_vars['tab']->value['selected']) {?>
						<?php echo $_smarty_tpl->tpl_vars['custom_form']->value;?>

					<?php }?>
				</div>
				<?php }?>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<input type="hidden" name="id_product_attribute" id="id_product_attribute" value="0" />
			<input type="hidden" name="key_tab" id="key_tab" value="Informations" />
		</form>
	</div>

<?php
}
}
/* {/block "defaultForm"} */
}
