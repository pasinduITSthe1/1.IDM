<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:24
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\normal_products\options.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f28c66a2a1_28886954',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fda1de53ed749d7ad472bd5aa96fe7b708e1d75e' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\normal_products\\options.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f28c66a2a1_28886954 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="product-options" class="panel product-tab">
	<input type="hidden" name="submitted_tabs[]" value="Options" />
	<h3 class="tab"> <i class="icon-info"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Options'),$_smarty_tpl ) );?>
</h3>

    <div class="table-responsive">
        <table id="product_options_table" class="table table-striped">
            <thead>
                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name'),$_smarty_tpl ) );?>
</th>
                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price Impact'),$_smarty_tpl ) );?>
</th>
                <th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Action'),$_smarty_tpl ) );?>
</th>
            </thead>
            <tbody>
                <?php if ($_smarty_tpl->tpl_vars['serviceProductOptions']->value) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['serviceProductOptions']->value, 'productOption');
$_smarty_tpl->tpl_vars['productOption']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['productOption']->value) {
$_smarty_tpl->tpl_vars['productOption']->do_else = false;
?>
                        <tr>
                            <td>
                                <input class="form-control" type="text" name="product_option_name[]" value="<?php echo $_smarty_tpl->tpl_vars['productOption']->value['name'];?>
">
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</span>
                                    <input type="text" name="product_option_price[]" value="<?php echo $_smarty_tpl->tpl_vars['productOption']->value['price_impact'];?>
"/>
                                    <input type="hidden" name="product_option_id[]" value="<?php echo $_smarty_tpl->tpl_vars['productOption']->value['id_product_option'];?>
"/>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="btn btn-default delete_product_option" data-id_product_option="<?php echo $_smarty_tpl->tpl_vars['productOption']->value['id_product_option'];?>
"><i class="icon-trash"></i></a>
                            </td>
                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php }?>
                <tr>
                    <td>
                        <input class="form-control" type="text" name="product_option_name[]">
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</span>
                            <input type="text" name="product_option_price[]" value=""/>
                            <input type="hidden" name="product_option_id[]" value="0"/>
                        </div>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="form-control" type="text" name="product_option_name[]">
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['currency']->value->prefix;
echo $_smarty_tpl->tpl_vars['currency']->value->suffix;?>
</span>
                            <input type="text" name="product_option_price[]" value=""/>
                        </div>
                    </td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

	<div class="panel-footer">
		<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminNormalProducts'), ENT_QUOTES, 'UTF-8', true);
if ((isset($_REQUEST['page'])) && $_REQUEST['page'] > 1) {?>&amp;submitFilterproduct=<?php echo intval($_REQUEST['page']);
}?>" class="btn btn-default"><i class="process-icon-cancel"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel'),$_smarty_tpl ) );?>
</a>
		<button type="submit" name="submitAddproduct" class="btn btn-default pull-right" disabled="disabled"><i class="process-icon-loading"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save'),$_smarty_tpl ) );?>
</button>
		<button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right" disabled="disabled"><i class="process-icon-loading"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save and stay'),$_smarty_tpl ) );?>
</button>
	</div>
</div>


<?php echo '<script'; ?>
>
    var service_product_link = "<?php echo $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminNormalProducts');?>
";
    var option_delete_success_txt = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product option is deleted successfully','js'=>1),$_smarty_tpl ) );?>
';
    $(document).ready(function() {
        $(document).on('click', '.delete_product_option', function(e){
            e.preventDefault();
            var $current = $(this);
            var id_product_option = $(this).attr('data-id_product_option');
            $.ajax({
                url: service_product_link,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    ajax:true,
                    action:'deleteServiceProductOption',
                    id_product_option: id_product_option,
                },
                success: function (response) {
                    if (response.hasError) {
                        showErrorMessage(response.error);
                    } else {
                        $current.closest('tr').remove();
                        showSuccessMessage(option_delete_success_txt);
                    }
                }
            });
        });
    });
<?php echo '</script'; ?>
><?php }
}
