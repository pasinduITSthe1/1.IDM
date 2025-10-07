<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:29
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\orders\modals\_booking_documents.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f291577346_44401951',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '91413355dd86c861733420820c4c56ca404179d6' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\orders\\modals\\_booking_documents.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f291577346_44401951 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-left errors-wrap"></div>
            <div class="documents-list form-group">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Preview'),$_smarty_tpl ) );?>
</th>
                            <th class="text-left"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Title'),$_smarty_tpl ) );?>
</th>
                            <th class="text-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Upload Date'),$_smarty_tpl ) );?>
</th>
                            <th class="text-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Actions'),$_smarty_tpl ) );?>
</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['can_edit']->value) {?>
                <hr>
                <div class="well add-new-document-form" style="margin-top: 10px;">
                    <form class="form-horizontal" id="form-add-new-document" method="post" action="#">
                        <input type="hidden" name="id_htl_booking" value="0">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label">
                                    <span class="label-tooltip" data-toggle="tooltip" title="" data-original-title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Write the title for the document. Invalid characters <>;=#{}'),$_smarty_tpl ) );?>
">
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Title'),$_smarty_tpl ) );?>

                                    </span>
                                </label>
                                <input class="form-control" type="text" name="title" value="" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'eg. passport, driving license'),$_smarty_tpl ) );?>
" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="control-label required">
                                    <span class="label-tooltip" data-toggle="tooltip" title="" data-original-title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Choose the document file to be uploaded.'),$_smarty_tpl ) );?>
">
                                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'File'),$_smarty_tpl ) );?>

                                    </span>
                                </label>
                                <div class="input-file-wrap"></div>
                                <div class="input-group">
                                    <input class="form-control file-name" type="text" readonly="">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary btn-add-file">
                                            <i class="icon-folder-open"></i>
                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add file'),$_smarty_tpl ) );?>

                                        </button>
                                    </span>
                                </div>
                                <p class="text-left" style="margin-top: 4px; font-style: italic;">
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Upload a PDF or an image file. Allowed image formats: .gif, .jpg, .jpeg and .png'),$_smarty_tpl ) );?>

                                </p>
                            </div>
                        </div>
                        <button class="btn btn-primary pull-right upload" type="submit" name="uploadDocument" id="uploadDocument" style="display:none;">
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Upload'),$_smarty_tpl ) );?>

                        </button>
                    </form>
                </div>
            <?php }?>
        </div>
    </div>

    <?php if ((isset($_smarty_tpl->tpl_vars['loaderImg']->value)) && $_smarty_tpl->tpl_vars['loaderImg']->value) {?>
        <div class="loading_overlay">
            <img src='<?php echo $_smarty_tpl->tpl_vars['loaderImg']->value;?>
' class="loading-img"/>
        </div>
    <?php }?>
</div>
<?php }
}
