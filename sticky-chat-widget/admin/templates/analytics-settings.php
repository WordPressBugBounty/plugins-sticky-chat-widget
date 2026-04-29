<?php
/**
 * Google analytics for widget functionality of the plugin.
 *
 * @author  : Ginger Plugins <gingerplugins@gmail.com>
 * @license : GPL2
 * */
defined('ABSPATH') or die('Direct Access is not allowed');
?>

<?php
$inputValue = get_post_meta($postId, "google_analytics", true);
$inputValue = empty($inputValue) ? "no" : $inputValue;
?>

<div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-5! py-4!">
        <h3 class="text-lg! font-semibold! text-slate-900!"><?php esc_html_e("Tracking", "sticky-chat-widget") ?></h3>
        <p class="mt-1! text-sm! text-slate-500"><?php esc_html_e("Enable analytics integrations and monitor widget performance.", "sticky-chat-widget") ?></p>
    </div>
    <div class="p-5!">
        <div class="space-y-4! analytics-settings">
            <div class="flex items-center justify-between rounded-xl border border-slate-200 px-4! py-3!">
                <div class="flex items-center gap-1">
                    <span class="text-base font-medium"><?php esc_html_e("Google Analytics", "sticky-chat-widget") ?></span>
                    <?php if (!empty($disabled)) { ?>
                        <a class="upgrade-link in-block" href="javascript:;" target="_blank" data-ginger-tooltip="Upgrade to Pro" data-ginger-tooltip-location="top"><?php Ginger_Social_Icons::load_and_sanitize_svg($icons['pro']); ?></a>
                    <?php } ?>
                </div>
                <div class="gp-form-input d-flex">
                    <span class="dashboard-switch in-flex on-off">
                        <input type="hidden" name="gsb_google_analytics" value="no">
                        <input type="checkbox" id="gsb_google_analytics" name="gsb_google_analytics" <?php echo esc_attr($disabled) ?> value="yes" class="sr-only" <?php checked($inputValue, "yes") ?>>
                        <label for="gsb_google_analytics"></label>
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between rounded-xl border border-slate-200 px-4! py-3!">
                <div class="flex items-center gap-1">
                    <span class="text-base font-medium"><?php esc_html_e("Widget analytics", "sticky-chat-widget") ?></span>
                    <?php if (!empty($disabled)) { ?>
                        <a class="upgrade-link in-block" href="javascript:;" target="_blank" data-ginger-tooltip="Upgrade to Pro" data-ginger-tooltip-location="top"><?php Ginger_Social_Icons::load_and_sanitize_svg($icons['pro']); ?></a>
                    <?php } ?>
                    <a href="<?php echo esc_url(admin_url("admin.php?page=sticky-chat-widget-analytics")) ?>" target="_blank" class="view-widget-analytics">View widget analytics <span class="dashicons dashicons-external"></span></a>
                </div>
                <div class="gp-form-input d-flex">
                    <span class="dashboard-switch in-flex on-off">
                        <input type="hidden" name="widget_settings[widget_analytics]" value="no">
                        <input type="checkbox" id="gsb_widget_analytics" name="widget_settings[widget_analytics]" <?php echo esc_attr($disabled) ?> value="yes" class="sr-only" <?php checked($widgetSettings['widget_analytics'], "yes") ?>>
                        <label for="gsb_widget_analytics"></label>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>