<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:53
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\recomended-banner.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a92b5538_04835475',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9990687989b016693d61d77c99bccf5770fdddc6' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\recomended-banner.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a92b5538_04835475 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="recommendation-wrapper-skeleton" style="display:none">
    <?php echo '<script'; ?>
>
        loadRecommendation();
    <?php echo '</script'; ?>
>
    <div class="col-sm-12">
        <div class="banner panel">
            <div class="row">
                <div class="col-sm-12">
                    <div class="skeleton-loading-pulse loading-container-bar"></div>
                    <div class="loading-container-bar"></div>
                    <div class="skeleton-loading-pulse loading-container-bar"></div>
                    <div class="loading-container-bar"></div>
                    <div class="skeleton-loading-pulse loading-container-bar"></div>
                    <div class="loading-container-bar"></div>
                    <div class="skeleton-loading-pulse loading-container-bar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="recommendation-wrapper" style="display:none">
</div><?php }
}
