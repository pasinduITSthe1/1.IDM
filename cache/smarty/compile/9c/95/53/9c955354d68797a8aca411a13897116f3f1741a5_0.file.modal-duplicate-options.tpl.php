<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:39
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\products\modal-duplicate-options.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29bca6a81_08577055',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9c955354d68797a8aca411a13897116f3f1741a5' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\products\\modal-duplicate-options.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29bca6a81_08577055 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['hotels_info']->value))) {?>
    <div class="modal-body text-center">
        <div class="row">
            <div class="col-lg-12">
                <form class="defaultForm form-horizontal duplicate-options" action="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" method="post" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="id_product" value="0" id="duplicate_id_product">
                    <div class="form-group">
                        <label class="control-label col-lg-3">
                            <span class="label-tooltip" data-toggle="tooltip" data-html="true"
                                title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Select hotel to assign duplicated room type to."),$_smarty_tpl ) );?>
">
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Select hotel"),$_smarty_tpl ) );?>

                            </span>
                        </label>
                        <div class="col-lg-9">
                            <select name="id_hotel" class="fixed-width-xl" id="duplicate_id_hotel">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hotels_info']->value, 'hotel');
$_smarty_tpl->tpl_vars['hotel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['hotel']->value) {
$_smarty_tpl->tpl_vars['hotel']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['hotel']->value['id_hotel'];?>
">
                                        <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['hotel']->value['hotel_name'], ENT_QUOTES, 'UTF-8', true);?>
 - <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['hotel']->value['city'], ENT_QUOTES, 'UTF-8', true);?>

                                    </option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">
                            <span class="label-tooltip" data-toggle="tooltip" data-html="true"
                                title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Choose whether to copy images to duplicated room type."),$_smarty_tpl ) );?>
">
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Duplicate images"),$_smarty_tpl ) );?>

                            </span>
                        </label>
                        <div class="col-lg-9">
                            <span class="switch prestashop-switch fixed-width-lg">
                                <input type="radio" name="noimage" id="noimage_on" value="0"
                                    <?php if (intval($_smarty_tpl->tpl_vars['duplicate_images']->value)) {?>checked="checked"<?php }?>>
                                <label for="noimage_on"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Yes"),$_smarty_tpl ) );?>
</label>
                                <input type="radio" name="noimage" id="noimage_off" value="1"
                                    <?php if (!intval($_smarty_tpl->tpl_vars['duplicate_images']->value)) {?>checked="checked"<?php }?>>
                                <label for="noimage_off"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"No"),$_smarty_tpl ) );?>
</label>
                                <a class="slide-button btn"></a>
                            </span>
                        </div>
                    </div>
                    <input type="hidden" name="submitDuplicate" value="1">
                </form>
            </div>
        </div>
    </div>
<?php }
}
}
