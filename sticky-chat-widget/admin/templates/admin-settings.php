<?php
/**
 * The widget setting functionality of the plugin.
 *
 * @author  : Ginger Plugins <gingerplugins@gmail.com>
 * @license : GPL2
 * */

defined('ABSPATH') or die('Direct Access is not allowed');

$getSelectedChannels = get_post_meta($postId, "selected_channels", true);
$widgetStatus        = get_post_meta($postId, "widget_status", true);
$widgetStatus        = isset($widgetStatus) && !empty($widgetStatus) ? $widgetStatus : "yes";
$icons = Ginger_Social_Icons::svg_icons();
?>
<div style="display: none">
    <?php
    $embedded_message = "";
    $settings         = [
        'media_buttons'    => false,
        'wpautop'          => false,
        'drag_drop_upload' => false,
        'textarea_name'    => 'chat_editor_channel',
        'textarea_rows'    => 4,
        'quicktags'        => false,
        'tinymce'          => [
            'toolbar1' => 'bold, italic, underline',
            'toolbar2' => '',
            'toolbar3' => '',
        ],
    ];
    wp_editor($embedded_message, "chat_editor_channel", $settings);
    ?>
</div>
<div class="scw-settings">
    <form action="<?php echo esc_url(admin_url("admin-ajax.php")) ?>" method="post" id="ginger_sb_form" autocomplete="off">
        <div class="sticky top-0 left-0 z-5000 bg-white w-full py-2.5 border-b border-b-slate-200 px-2.5 widget-sticky-header @container">
            <div class="max-w-6xl mx-auto flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="rounded-full w-12 h-12 @max-[480px]:w-10 @max-[480px]:h-10 relative flex items-center justify-center step-ratio-box">
                        <div class="w-10 h-10 @max-[480px]:w-8 @max-[480px]:h-8 bg-indigo-100 rounded-full flex items-center justify-center text-sm border-3 border-solid border-white @max-[480px]:text-xs">
                            <span class="header-step-number">1</span>/4
                        </div>
                    </div>
                    <span class="header-step-text hidden @min-[481px]:block!"><?php esc_html_e("Social Channels", "sticky-chat-widget") ?></span>
                    <span class="header-step-text-hidden hidden @max-[480px]:block!"><?php esc_html_e("Channels", "sticky-chat-widget") ?></span>
                </div>
                <div class="flex gap-2">
                    <button class="rounded border border-solid border-slate-200 px-5 @max-[400px]:px-3 py-1.5 duration-300 ease-linear transition text-gray-700 hover:bg-gray-100 bg-gray-200 text-gray-400 cursor-no-drop back-button back-next-btn" type="button">
                        <span class="hidden @min-[481px]:block!"><?php esc_html_e("Back", "sticky-chat-widget") ?></span>
                        <span class="hidden @max-[480px]:block!"><?php Ginger_Social_Icons::load_and_sanitize_svg($icons['prev']); ?></span>
                    </button>
                    <button class="flex items-center gap-0.5 justify-center rounded border border-solid border-slate-200 px-5 @max-[400px]:px-3 py-1.5 duration-300 ease-linear transition hover:bg-gray-100 bg-gray-200 text-gray-400 cursor-no-drop next-button back-next-btn active" type="button">
                        <span class="hidden @min-[481px]:block!"><?php esc_html_e("Next", "sticky-chat-widget") ?></span>
                        <span class="hidden @max-[480px]:block!"><?php Ginger_Social_Icons::load_and_sanitize_svg($icons['next']); ?></span>
                    </button>
                    <div class="relative widget-save-btn">
                        <button class="relative rounded border border-solid border-indigo-600 bg-indigo-600 cursor-pointer text-white duration-300 ease-linear hover:bg-indigo-700 transition flex items-center save-changes submitButton preview-button" type="submit" data-attr="preview-button">
                            <span class="btn-text px-5 py-1.5 border-r border-solid border-r-[#6d65f5] hidden @min-[523px]:block!"><?php esc_html_e('Save Changes', 'sticky-chat-widget') ?></span>
                            <span class="@max-[523px]:block! hidden btn-text px-5 py-1.5 border-r border-solid border-r-[#6d65f5]"><?php esc_html_e('Save', 'sticky-chat-widget') ?></span>
                            <span class="more-save-option p-1.5"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M6 9L12 15L18 9" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/> </svg></span>
                        </button>
                        <button type="submit" class="save-view-btn absolute right-0 top-full w-max py-1.5 px-3 h-fit rounded bg-white shadow-md cursor-pointer translate-y-[5px] hidden"><?php esc_html_e("Save and View Dashboard", "sticky-chat-widget") ?></button>
                    </div>
<!--                    <span class="scw-loader"><span class="dashicons dashicons-update"></span></span>-->
                </div>
            </div>
        </div>
        <div class="max-w-6xl mx-auto mt-[15px] flex w-[96%] gap-1 widget-sidebar @container">
            <div class="flex-1/4 widget-sidebar-step">
                <a href="#channel-settings" class="flex w-full items-center gap-2.5 just p-3 hover:bg-white rounded-lg active" data-step="1">
                    <div class="w-8 h-8 border-2 rounded-full text-center border-slate-200 text-[#3c434a] step-number">1</div>
                    <div class="text-[#3c434a] step-text lg:block! hidden"><?php esc_html_e("Select Channels", "sticky-chat-widget") ?></div>
                    <div class="text-[#3c434a] step-text lg:hidden md:block @max-[560px]:hidden"><?php esc_html_e("Channels", "sticky-chat-widget") ?></div>
                    <div class="h-0.5 flex flex-1 w-auto bg-slate-200 step-line"></div>
                </a>
            </div>
            <div class="flex-1/4 widget-sidebar-step">
                <a href="#icon-settings" class="flex w-full items-center gap-2.5 just p-3 hover:bg-white rounded-lg" data-step="2">
                    <div class="w-8 h-8 border-2 rounded-full text-center border-slate-200 text-[#3c434a] step-number">2</div>
                    <div class="text-[#3c434a] step-text lg:block! hidden"><?php esc_html_e("Customize Widget", "sticky-chat-widget") ?></div>
                    <div class="text-[#3c434a] step-text lg:hidden md:block @max-[560px]:hidden"><?php esc_html_e("Customize", "sticky-chat-widget") ?></div>
                    <div class="h-0.5 flex flex-1 w-auto bg-slate-200 step-line"></div>
                </a>
            </div>
            <div class="flex-1/4 widget-sidebar-step">
                <a href="#triggers-settings" class="flex w-full items-center gap-2.5 just p-3 hover:bg-white rounded-lg" data-step="3">
                    <div class="w-8 h-8 border-2 rounded-full text-center border-slate-200 text-[#3c434a] step-number">3</div>
                    <div class="text-[#3c434a] step-text @max-[560px]:hidden"><?php esc_html_e("Triggers", "sticky-chat-widget") ?></div>
                    <div class="h-0.5 flex flex-1 w-auto bg-slate-200 step-line"></div>
                </a>
            </div>
            <div class="flex-1/4 widget-sidebar-step">
                <a href="#targeting-settings" class="flex w-full items-center gap-2.5 just p-3 hover:bg-white rounded-lg" data-step="4">
                    <div class="w-8 h-8 border-2 rounded-full text-center border-slate-200 text-[#3c434a] step-number">4</div>
                    <div class="text-[#3c434a] step-text @max-[560px]:hidden"><?php esc_html_e("Targeting", "sticky-chat-widget") ?></div>
                    <div class="h-0.5 flex flex-1 w-auto bg-slate-200 step-line"></div>
                </a>
            </div>
        </div>
        <div class="widget-settings !max-w-6xl">
            <div class="widget-setting">
                <?php
                require_once dirname(__FILE__)."/social-channels.php";
                require_once dirname(__FILE__)."/customize-widget-button.php";
                require_once dirname(__FILE__)."/triggers.php";
                require_once dirname(__FILE__)."/time-and-page-rules.php";
                ?>
            </div>
            <input type="hidden" name="gsb_selected_channels" id="gsb_selected_channels" value="<?php echo esc_attr($getSelectedChannels); ?>" />
            <input type="hidden" name="action" value="save_gsb_buttons_setting" />
            <input type="hidden" id="button_setting_nonce" name="nonce" value="<?php echo esc_attr(wp_create_nonce("save_gsb_buttons_setting".esc_attr($postId))) ?>" />
            <input type="hidden" id="button_setting_id" name="setting_id" value="<?php echo esc_attr($postId) ?>" />
            <input type="hidden" id="check_widget_status" name="widget_status" value="<?php echo esc_attr($widgetStatus) ?>">
            <input type="hidden" id="save_btn_type" name="save_btn_type" value="save-btn">

            <div class="widget-preview">
                <?php require_once dirname(__FILE__)."/widget-preview.php"; ?>
            </div>

            <!-- Inline CSS -->
            <div class="inline-style"></div>
        </div>
        <div class="form-confirmation gp-modal" tabindex="-1">
            <div class="gp-modal-bg"></div>
            <div class="gp-modal-container small">
                <div class="gp-modal-content">
                    <div class="gp-modal-data">
                        <div class="gp-modal-header">
                            <?php esc_html_e("Sticky Chat Widget is disabled", 'sticky-chat-widget') ?>
                        </div>
                        <div class="gp-modal-body">
                            <p><?php esc_html_e("Sticky Chat Widget is currently disabled.", 'sticky-chat-widget') ?></p>
                            <p><?php esc_html_e("Would you like to show it on your website?", 'sticky-chat-widget') ?></p>
                        </div>
                        <div class="gp-modal-footer text-center">
                            <button type="button" class="primary-btn save-confirm-btn"><?php esc_html_e("Yes, enable and save it", "sticky-chat-widget"); ?></button>
                            <button type="button" class="secondary-btn hide-gp-modal no-confirm-btn"><?php esc_html_e("No, just save changes", "sticky-chat-widget"); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
    <div class="sticky-preview-button">
        <button type="button" class="preview-btn"><?php esc_html_e("Preview", "sticky-chat-widget") ?></button>
    </div>
<?php require_once dirname(__FILE__)."/premium-features.php"; ?>
<?php require_once dirname(__FILE__)."/common.php";
