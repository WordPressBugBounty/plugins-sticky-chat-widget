<?php
/**
 * Widget status and select social channel and its setting functionality of the plugin.
 *
 * @author  : Ginger Plugins <gingerplugins@gmail.com>
 * @license : GPL2
 * */
defined('ABSPATH') or die('Direct Access is not allowed');
?>
<?php
$selectedChannels = [];
$channels         = get_post_meta($postId, "selected_channels", true);

if (empty($channels)) {
    $selectedChannels = [
        "whatsapp",
        "facebook_messenger",
        "contact_form",
    ];
}

if (!empty($channels)) {
    $channels         = trim($channels);
    $channels         = trim($channels, ",");
    $selectedChannels = explode(",", $channels);
}
?>

<div id="channel-settings" class="setting-tab active">
    <div class="setting-title d-flex">
        <span class="channel-title setting-title-text"><?php esc_html_e("Select Channels", "sticky-chat-widget") ?></span>
        <div class="search-channel-box">
            <input type="text" class="input-search" id="input_channel_search" placeholder="Search...">
        </div>
    </div>
    <div class="social-links" id="social-links-options">
        <ul class="social-buttons">
            <?php
            foreach ($socialIcons as $key => $icon) {
                $class = in_array($icon['label'], $selectedChannels) ? "active" : "";
                ?>
                <li class="social-button social-icon <?php echo esc_attr($class); ?>" id="social-icon-<?php echo esc_attr($icon['label']) ?>" data-social="<?php echo esc_attr($icon['label']) ?>">
                    <a href="javascript:;" class="ssb-btn-<?php echo esc_attr($icon['label']) ?>" data-ginger-tooltip="<?php echo esc_attr($icon['title']) ?>">
                        <span class="gsb-social-icon">
                            <?php Ginger_Social_Icons::load_and_sanitize_svg($icon['icon']); ?>
                        </span>
                    </a>
                    <span class="scw-loader channel-loader"><span class="dashicons dashicons-update"></span></span>
                </li>
            <?php } ?>
            <li class="social-button social-icon add-more-channel" id="show_more_channel">
                <a href="javascript:;" data-ginger-tooltip="Add more channels">
                    <span class="gsb-social-icon">
                        <?php Ginger_Social_Icons::load_and_sanitize_svg($icons['plus']); ?>
                    </span>
                </a>
                <span class="scw-loader channel-loader"><span class="dashicons dashicons-update"></span></span>
            </li>
        </ul>
        <div class="no-channel-found">
            <div><?php esc_html_e("The channel '", "sticky-chat-widget") ?><span class="search_text">search</span><?php esc_html_e("', you are looking for is not available in Sticky Chat Widget.", "sticky-chat-widget") ?></div>
            <div>
                <?php esc_html_e("Please", "sticky-chat-widget") ?>
                <a href="javascript:;" class="open-help-form"><?php esc_html_e("contact us", "sticky-chat-widget") ?></a>
                <?php esc_html_e(", if we can help you 🙂", "sticky-chat-widget"); ?>
            </div>
        </div>
    </div>
    <div class="selected-channels">
        <ul class="selected-button-settings">
            <?php
            if (!empty($selectedChannels)) {
                foreach ($selectedChannels as $channel) {
                    echo self::get_channel_settings($channel, $postId);
                }
            }
            ?>
        </ul>
    </div>
</div>


<div class="gp-modal" id="more_channel_popup">
    <div class="gp-modal-bg"></div>
    <div class="gp-modal-container">
        <div class="gp-modal-content">
            <div class="gp-modal-data">
                <button class="gp-modal-close-btn" type="button">
                    <span class="svg-icon">
                        <?php Ginger_Social_Icons::load_and_sanitize_svg($icons['close']); ?>
                    </span>
                </button>
                <div class="gp-modal-header">
                    <?php esc_html_e("Select Channel", "sticky-chat-widget"); ?>
                </div>
                <div class="gp-modal-body">
                    <ul id="more_channel_list" class="more-channel-list">
                        <?php
                        foreach ($socialIcons as $key => $icon) {
                            if($icon['label'] != 'contact_form' && $icon['label'] != 'custom-link') {
                            ?>
                            <li id="social-icon-<?php echo esc_attr($icon['label']) ?>" data-social="<?php echo esc_attr($icon['label']) ?>">
                                <a href="javascript:;" class="ssb-btn-<?php echo esc_attr($icon['label']) ?>">
                                    <span class="gsb-more-social-icon">
                                        <?php Ginger_Social_Icons::load_and_sanitize_svg($icon['icon']); ?>
                                    </span>
                                    <p><?php echo esc_attr($icon['title']) ?></p>
                                </a>
                                <span class="scw-loader channel-loader"><span class="dashicons dashicons-update"></span></span>
                            </li>
                        <?php } } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>