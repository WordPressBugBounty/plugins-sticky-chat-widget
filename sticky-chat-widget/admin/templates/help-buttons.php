<?php
$isHidden = get_option("sticky-chat-widget_review_box_status");

include_once dirname(__FILE__) . "/review-popup.php";
?>

<style>
    .help-panel {
        position: fixed;
        bottom: 32px;
        right: 32px;
        z-index: 1000;
    }
    .help-button {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 100%);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        animation: pulse-subtle 3s infinite;
    }
    .help-button:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.35);
    }
    .help-button.active {
        transform: rotate(45deg);
        background: linear-gradient(135deg, #7C3AED 0%, #8B5CF6 100%);
    }
    @keyframes pulse-subtle {
        0%, 100% {
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.25);
        }
        50% {
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4), 0 0 0 8px rgba(139, 92, 246, 0.1);
        }
    }
    .help-menu {
        position: absolute;
        bottom: 72px;
        right: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .help-menu.active {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .help-menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
        min-width: 180px;
        transform: translateY(20px);
        opacity: 0;
    }
    .help-menu.active .help-menu-item {
        transform: translateY(0);
        opacity: 1;
    }
    .help-menu.active .help-menu-item:nth-child(1) {
        transition-delay: 0.05s;
    }
    .help-menu.active .help-menu-item:nth-child(2) {
        transition-delay: 0.1s;
    }
    .help-menu.active .help-menu-item:nth-child(3) {
        transition-delay: 0.15s;
    }
    .help-menu.active .help-menu-item:nth-child(4) {
        transition-delay: 0.2s;
    }
    .help-menu.active .help-menu-item:nth-child(5) {
        transition-delay: 0.25s;
    }
    .help-menu-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }
    .help-menu-item.pro {
        background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 100%);
        color: white;
    }
    .help-menu-item.pro:hover {
        background: linear-gradient(135deg, #7C3AED 0%, #8B5CF6 100%);
    }
    .help-menu-item.support {
        border-left: 3px solid #3B82F6;
    }
    .help-menu-item.contact {
        border-left: 3px solid #10B981;
    }
    .help-menu-item.help-center {
        border-left: 3px solid #6366F1;
    }
    .help-menu-item.review {
        border-left: 3px solid #F59E0B;
    }
    .help-icon {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .help-text {
        font-size: 14px;
        font-weight: 500;
    }
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    .modal {
        background: white;
        border-radius: 16px;
        padding: 32px;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        transform: scale(0.9) translateY(20px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        position: relative;
    }

    .modal::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        width: 0%;
        background: linear-gradient(90deg, #8B5CF6, #A78BFA);
        transition: width 5s linear;
        z-index: 10;
    }
    .modal.auto-dismiss::after {
        width: 100%;
    }
    .modal-overlay.active .modal {
        transform: scale(1) translateY(0);
    }

    .modal-overlay.active .modal {
        transform: scale(1) translateY(0);
    }
    .form-group {
        margin-bottom: 24px;
    }
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
    }
    .form-input {
        width: 100%;
        padding: 10px !important;
        border: 1px solid #D1D5DB !important;
        border-radius: 8px !important;
        font-size: 14px;
        line-height: 1 !important;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-input:focus {
        outline: none !important;
        border-color: #8B5CF6 !important;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1) !important;
    }
    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }
    button:focus-visible {
        outline: none;
    }
    .help-tooltip {
        position: absolute;
        bottom: 0.75rem;
        right: 4.5rem;
        background: #ffffff;
        color: #101828;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.8125rem;
        font-weight: 500;
        white-space: nowrap;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        opacity: 0;
        visibility: hidden;
        transform: translateX(10px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .help-tooltip::after {
        content: '';
        position: absolute;
        top: 50%;
        right: -6px;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 6px solid #ffffff;
        border-top: 6px solid transparent;
        border-bottom: 6px solid transparent;
    }
    .help-tooltip.show {
        opacity: 1;
        visibility: visible;
        transform: translateX(0);
    }
    body.rtl .help-panel {
        right: auto;
        left: 32px;
    }
    body.rtl .help-tooltip {
        right: auto;
        left: 4.5rem;
    }
    body.rtl .help-tooltip::after {
        right: auto;
        left: -6px;
        transform: translateY(-50%) rotate(180deg);
    }
    body.rtl .help-menu {
        right: auto;
        left: 0;
    }
    body.rtl .help-menu-item.support {
        border-right: 3px solid #3B82F6;
        border-left: none;
    }
    body.rtl .help-menu-item.contact {
        border-right: 3px solid #10B981;
        border-left: none;
    }
    body.rtl .help-menu-item.help-center {
        border-right: 3px solid #6366F1;
        border-left: none;
    }
    body.rtl .help-menu-item.review {
        border-right: 3px solid #F59E0B;
        border-left: none;
    }
    @media (max-width: 768px) {
        .help-button {
            width: 48px;
            height: 48px;
        }

        .help-menu-item {
            padding: 12px 14px;
            min-width: 160px;
        }

        .help-text {
            font-size: 13px;
        }

        .help-panel {
            bottom: 16px;
            right: 16px;
        }
    }
</style>
<div class="help-panel">
    <div class="help-tooltip show" id="helpTooltip">Need Help?</div>
    <div class="help-menu" id="helpMenu">
        <a href="<?php echo esc_url(admin_url("admin.php?page=sticky-chat-widget-upgrade-to-pro")) ?>" target="_blank" class="help-menu-item pro text-white!">
            <div class="help-icon">
                <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M2.33008 13.5H15.6551V14.8333H2.33008V13.5ZM2.33008 4.16665L5.66133 6.49998L8.99258 2.16665L12.3238 6.49998L15.6551 4.16665V12.1666H2.33008V4.16665ZM3.66258 6.72665V10.8333H14.3226V6.72665L12.044 8.32665L8.99258 4.35331L5.94115 8.32665L3.66258 6.72665Z" fill="white"/> </svg>
            </div>
            <span class="help-text"><?php esc_html_e("Upgrade to Pro", "sticky-chat-widget") ?></span>
        </a>
        <a href="https://wordpress.org/support/plugin/sticky-chat-widget/" target="_blank" class="help-menu-item support text-gray-900!">
            <div class="help-icon">
                <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M8.99258 3.49998C8.02429 3.49998 7.12708 3.74442 6.30093 4.23331C5.50143 4.70442 4.86627 5.33998 4.39545 6.13998C3.90687 6.96665 3.66258 7.86442 3.66258 8.83331H5.66133C5.90118 8.83331 6.12326 8.89331 6.32758 9.01331C6.53189 9.13331 6.69402 9.29554 6.81394 9.49998C6.93387 9.70442 6.99383 9.92665 6.99383 10.1666V13.5C6.99383 13.74 6.93387 13.9622 6.81394 14.1666C6.69402 14.3711 6.53189 14.5333 6.32758 14.6533C6.12326 14.7733 5.90118 14.8333 5.66133 14.8333H3.66258C3.42273 14.8333 3.20064 14.7733 2.99633 14.6533C2.79201 14.5333 2.62989 14.3711 2.50997 14.1666C2.39004 13.9622 2.33008 13.74 2.33008 13.5V8.83331C2.33008 7.92665 2.5033 7.05998 2.84975 6.23331C3.18732 5.4422 3.6648 4.73776 4.28219 4.11998C4.89958 3.5022 5.60359 3.02442 6.3942 2.68665C7.22035 2.33998 8.08648 2.16665 8.99258 2.16665C9.89868 2.16665 10.7648 2.33998 11.591 2.68665C12.3816 3.02442 13.0856 3.5022 13.703 4.11998C14.3204 4.73776 14.7978 5.4422 15.1354 6.23331C15.4819 7.05998 15.6551 7.92665 15.6551 8.83331V13.5C15.6551 13.74 15.5951 13.9622 15.4752 14.1666C15.3553 14.3711 15.1931 14.5333 14.9888 14.6533C14.7845 14.7733 14.5624 14.8333 14.3226 14.8333H12.3238C12.084 14.8333 11.8619 14.7733 11.6576 14.6533C11.4533 14.5333 11.2911 14.3711 11.1712 14.1666C11.0513 13.9622 10.9913 13.74 10.9913 13.5V10.1666C10.9913 9.92665 11.0513 9.70442 11.1712 9.49998C11.2911 9.29554 11.4533 9.13331 11.6576 9.01331C11.8619 8.89331 12.084 8.83331 12.3238 8.83331H14.3226C14.3226 7.86442 14.0783 6.96665 13.5897 6.13998C13.1189 5.33998 12.4837 4.70442 11.6842 4.23331C10.8581 3.74442 9.96086 3.49998 8.99258 3.49998ZM3.66258 10.1666V13.5H5.66133V10.1666H3.66258ZM12.3238 10.1666V13.5H14.3226V10.1666H12.3238Z" fill="#2563EB"/> </svg>
            </div>
            <span class="help-text"><?php esc_html_e("Get Support", "sticky-chat-widget") ?></span>
        </a>
        <div class="help-menu-item contact" id="contactUsBtn">
            <div class="help-icon">
                <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M2.99633 2.5H14.9888C15.1754 2.5 15.3331 2.56444 15.4619 2.69333C15.5907 2.82222 15.6551 2.98 15.6551 3.16667V13.8333C15.6551 14.02 15.5907 14.1778 15.4619 14.3067C15.3331 14.4356 15.1754 14.5 14.9888 14.5H2.99633C2.80978 14.5 2.6521 14.4356 2.52329 14.3067C2.39448 14.1778 2.33008 14.02 2.33008 13.8333V3.16667C2.33008 2.98 2.39448 2.82222 2.52329 2.69333C2.6521 2.56444 2.80978 2.5 2.99633 2.5ZM14.3226 5.32667L9.04588 10.06L3.66258 5.31333V13.1667H14.3226V5.32667ZM4.00903 3.83333L9.03255 8.27333L13.9895 3.83333H4.00903Z" fill="#16A34A"/> </svg>
            </div>
            <span class="help-text"><?php esc_html_e("Contact Us", "sticky-chat-widget") ?></span>
        </div>
        <a href="https://www.gingerplugins.com/knowledge-base/sticky-chat-widget/" target="_blank" class="help-menu-item help-center text-gray-900!">
            <div class="help-icon">
                <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M9.65883 13.8334V15.1667H8.32633V13.8334H2.99633C2.80978 13.8334 2.6521 13.7689 2.52329 13.64C2.39448 13.5111 2.33008 13.3534 2.33008 13.1667V2.50002C2.33008 2.31335 2.39448 2.15558 2.52329 2.02669C2.6521 1.8978 2.80978 1.83335 2.99633 1.83335H6.99383C7.3847 1.83335 7.75335 1.91335 8.0998 2.07335C8.44625 2.23335 8.74384 2.45558 8.99258 2.74002C9.24131 2.45558 9.5389 2.23335 9.88535 2.07335C10.2318 1.91335 10.6005 1.83335 10.9913 1.83335H14.9888C15.1754 1.83335 15.3331 1.8978 15.4619 2.02669C15.5907 2.15558 15.6551 2.31335 15.6551 2.50002V13.1667C15.6551 13.3534 15.5907 13.5111 15.4619 13.64C15.3331 13.7689 15.1754 13.8334 14.9888 13.8334H9.65883ZM14.3226 12.5V3.16669H10.9913C10.7515 3.16669 10.5294 3.22669 10.3251 3.34669C10.1208 3.46669 9.95864 3.62891 9.83872 3.83335C9.71879 4.0378 9.65883 4.26002 9.65883 4.50002V12.5H14.3226ZM8.32633 12.5V4.50002C8.32633 4.26002 8.26637 4.0378 8.14644 3.83335C8.02652 3.62891 7.86439 3.46669 7.66008 3.34669C7.45576 3.22669 7.23368 3.16669 6.99383 3.16669H3.66258V12.5H8.32633Z" fill="#4F46E5"/> </svg>
            </div>
            <span class="help-text"><?php esc_html_e("Help Center", "sticky-chat-widget") ?></span>
        </a>
        <?php if($isHidden === false) { ?>
        <div class="help-menu-item review" id="reviewBtn">
            <div class="help-icon">
                <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M8.99139 13.1L4.28766 15.74L5.34034 10.4467L1.38281 6.79332L6.73946 6.15332L8.99139 1.25999L11.2433 6.15332L16.6 6.79332L12.6424 10.4467L13.6951 15.74L8.99139 13.1ZM8.99139 11.58L11.8163 13.1667L11.19 9.97999L13.5752 7.77999L10.3505 7.39332L8.99139 4.44666L7.63224 7.39332L4.40759 7.77999L6.79276 9.97999L6.16649 13.1667L8.99139 11.58Z" fill="#CA8A04"/> </svg>
            </div>
            <span class="help-text"><?php esc_html_e("Leave a Review", "sticky-chat-widget") ?></span>
        </div>
        <?php } ?>
    </div>
    <div class="help-button" id="helpButton">
        <svg width="28" height="28" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10.9914 18.3802C9.85836 18.3802 8.77529 18.1635 7.74222 17.7302C6.75358 17.308 5.87324 16.7107 5.10121 15.9385C4.32918 15.1663 3.73211 14.2857 3.30999 13.2969C2.87677 12.2635 2.66016 11.1802 2.66016 10.0469C2.66016 8.91352 2.87677 7.83019 3.30999 6.79686C3.73211 5.80797 4.32918 4.92741 5.10121 4.15519C5.87324 3.38297 6.75358 2.78574 7.74222 2.36352C8.77529 1.93019 9.85836 1.71352 10.9914 1.71352C12.1245 1.71352 13.2075 1.93019 14.2406 2.36352C15.2292 2.78574 16.1096 3.38297 16.8816 4.15519C17.6536 4.92741 18.2507 5.80797 18.6728 6.79686C19.106 7.83019 19.3227 8.91352 19.3227 10.0469C19.3227 11.1802 19.106 12.2635 18.6728 13.2969C18.2507 14.2857 17.6536 15.1663 16.8816 15.9385C16.1096 16.7107 15.2292 17.308 14.2406 17.7302C13.2075 18.1635 12.1245 18.3802 10.9914 18.3802ZM10.9914 16.7135C12.2022 16.7135 13.3242 16.408 14.3572 15.7969C15.357 15.208 16.1512 14.4135 16.74 13.4135C17.3509 12.3802 17.6564 11.258 17.6564 10.0469C17.6564 8.83574 17.3509 7.71352 16.74 6.68019C16.1512 5.68019 15.357 4.88574 14.3572 4.29686C13.3242 3.68574 12.2022 3.38019 10.9914 3.38019C9.7806 3.38019 8.65866 3.68574 7.62558 4.29686C6.62583 4.88574 5.83159 5.68019 5.24284 6.68019C4.63189 7.71352 4.32641 8.83574 4.32641 10.0469C4.32641 11.258 4.63189 12.3802 5.24284 13.4135C5.83159 14.4135 6.62583 15.208 7.62558 15.7969C8.65866 16.408 9.7806 16.7135 10.9914 16.7135ZM10.1583 12.5469H11.8245V14.2135H10.1583V12.5469ZM11.8245 11.1802V11.7135H10.1583V10.4635C10.1583 10.2302 10.2388 10.033 10.3999 9.87186C10.561 9.71074 10.7581 9.63019 10.9914 9.63019C11.3358 9.63019 11.6301 9.50797 11.8745 9.26352C12.1189 9.01908 12.2411 8.72463 12.2411 8.38019C12.2411 8.03574 12.1189 7.7413 11.8745 7.49686C11.6301 7.25241 11.3358 7.13019 10.9914 7.13019C10.6915 7.13019 10.4277 7.22463 10.1999 7.41352C9.97222 7.60241 9.82503 7.8413 9.75838 8.13019L8.12546 7.81352C8.21432 7.36908 8.39761 6.96908 8.67532 6.61352C8.95303 6.25797 9.29183 5.97741 9.69173 5.77186C10.0916 5.5663 10.5249 5.46352 10.9914 5.46352C11.5246 5.46352 12.0134 5.59408 12.4577 5.85519C12.902 6.1163 13.2547 6.46908 13.5158 6.91352C13.7768 7.35797 13.9073 7.84686 13.9073 8.38019C13.9073 9.03574 13.7129 9.61908 13.3242 10.1302C12.9354 10.6413 12.4355 10.9913 11.8245 11.1802Z" fill="white"/> </svg>
    </div>
</div>
<div class="modal-overlay" id="contactModal">
    <div class="modal">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl! font-semibold! text-gray-900! my-0!"><?php esc_html_e("Contact Us", "sticky-chat-widget") ?></h2>
            <button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors cursor-pointer" id="closeContactModal">
                <svg width="24" height="24" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M8.99907 7.05334L12.2903 3.76001L13.2364 4.70667L9.94514 8.00001L13.2364 11.2933L12.2903 12.24L8.99907 8.94667L5.70779 12.24L4.76172 11.2933L8.05299 8.00001L4.76172 4.70667L5.70779 3.76001L8.99907 7.05334Z" fill="#9CA3AF"/> </svg>
            </button>
        </div>
        <div class="ajax-response"></div>
        <form action="" method="post" id="help_form_new" autocomplete="off">
            <?php
            $userId    = get_current_user_id();
            $userData  = get_user_by("id",  $userId);
            $userEmail = isset($userData->data->user_email) ? $userData->data->user_email : "";
            $name      = isset($userData->data->user_nicename) ? $userData->data->user_nicename : "";
            ?>
            <div class="form-group">
                <label class="form-label" for="name"><?php esc_html_e("Name *", "sticky-chat-widget") ?></label>
                <input type="text" id="name" name="name" class="form-input is-required" value="<?php echo esc_attr($name) ?>" data-label="<?php esc_html_e("Name", 'sticky-chat-widget') ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="email"><?php esc_html_e("Email Address *", "sticky-chat-widget") ?></label>
                <input type="text" id="email" name="email" class="form-input is-required is-email" value="<?php echo esc_attr($userEmail) ?>" data-label="<?php esc_html_e("Email", 'sticky-chat-widget') ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="message"><?php esc_html_e("Message *", "sticky-chat-widget") ?></label>
                <textarea id="message" name="message" class="form-input form-textarea is-required" placeholder="Please describe your inquiry or feedback..." data-label="<?php esc_html_e("Message", 'sticky-chat-widget') ?>"></textarea>
            </div>
            <div class="flex gap-3 justify-end">
                <button type="button" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors whitespace-nowrap cursor-pointer" id="cancelContact">
                    <?php esc_html_e("Cancel", "sticky-chat-widget") ?>
                </button>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-purple-500 text-white rounded-lg cursor-pointer hover:from-purple-700 hover:to-purple-600 transition-all whitespace-nowrap flex items-center gap-1.5 disabled:bg-gray-300 disabled:cursor-not-allowed contact-us-save-button">
                    <span><?php esc_html_e("Send Message" , "sticky-chat-widget") ?></span>
                    <svg class="ginger-ajax-loader" id="ajax-loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                        <circle cx="50" cy="50" r="32" stroke-width="8" stroke="#ffffff" stroke-dasharray="50.26548245743669 50.26548245743669" fill="none" stroke-linecap="round" transform="rotate(273.5 50 50)">
                            <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
                        </circle>
                    </svg>
                </button>
                <input type="hidden" name="nonce" value="<?php echo esc_attr(wp_create_nonce($this->slug."ajax-contact-form")) ?>" />
                <input type="hidden" name="action" value="<?php echo esc_attr("contact_ginger_form_scw") ?>" />
            </div>
        </form>
        <div id="contactSuccess" class="hidden">
            <div class="text-center py-8">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10.8795 15.18L20.0795 5.97999L21.4795 7.39999L10.8795 18.02L4.51953 11.64L5.91953 10.24L10.8795 15.18Z" fill="#16A34A"/> </svg>
                </div>
                <h3 class="text-lg! font-semibold! text-gray-900! mb-2! mt-0!"><?php esc_html_e("Message Sent!", "sticky-chat-widget") ?></h3>
                <p class="text-gray-600! text-base! my-0!"><?php esc_html_e("Thank you for contacting us. We'll get back to you within 24 hours.", "sticky-chat-widget") ?></p>
            </div>
        </div>
    </div>
</div>

<script>

    jQuery(document).ready(function($) {
        let isMenuOpen = false;

        const $helpButton = $("#helpButton");
        const $helpMenu = $("#helpMenu");
        const $contactModal = $("#contactModal");

        // Toggle Help Menu
        $(document).on("click", "#helpButton", function (e) {
            e.stopPropagation();
            isMenuOpen = !isMenuOpen;
            $helpButton.toggleClass("active", isMenuOpen);
            $helpMenu.toggleClass("active", isMenuOpen);
            if($(".help-button").hasClass("active")){
                $(".help-tooltip").removeClass("show");
            } else {
                $(".help-tooltip").addClass("show");
            }
        });

        $(document).on("click", "body", function () {
            $(".help-tooltip").addClass("show");
        });

        // Close help menu on outside click
        $(document).on("click", function (event) {
            const $helpPanel = $(".help-panel");
            if (!$helpPanel.is(event.target) && $helpPanel.has(event.target).length === 0 && isMenuOpen) {
                isMenuOpen = false;
                $helpButton.removeClass("active");
                $helpMenu.removeClass("active");
            }
        });

        // Menu item click handler
        $(document).on("click", ".help-menu-item", function () {
            const text = $(this).find(".help-text").text();

            if (this.id !== "contactUsBtn") {
                isMenuOpen = false;
                $helpButton.removeClass("active");
                $helpMenu.removeClass("active");
            }
        });

        // Open modal
        $(document).on("click", "#contactUsBtn", function (e) {
            e.stopPropagation();
            $contactModal.addClass("active");
            $("body").css("overflow", "hidden");
        });

        // Close modal
        $(document).on("click", "#closeContactModal, #cancelContact", function () {
            $contactModal.removeClass("active");
            $("body").css("overflow", "auto");
        });

        // Close modal on outside click
        $(document).on("click", "#contactModal", function (event) {
            if ($(event.target).is($contactModal)) {
                $contactModal.removeClass("active");
                $("body").css("overflow", "auto");
            }
        });

        $(document).on("click", "#reviewBtn", function (e){
            e.stopPropagation();
            $("#rating-popup").addClass("active");
        });

        $(document).on("submit", "#help_form_new", function(e){
            errorCounter = 0;
            $(this).find(".ginger-error-message").remove();
            $(this).find(".ginger-input-error").removeClass("ginger-input-error");
            $(this).find(".is-required").each(function(){
                if($(this).val() == "" || $(this).val() == "0") {
                    tempString = $(this).attr("data-label");
                    errorMessage = BUTTON_SETTINGS.required_message;
                    errorMessage = errorMessage.replace("%s", tempString);
                    $(this).after("<span class='ginger-error-message'>"+errorMessage+"</span>");
                    $(this).addClass("ginger-input-error");
                    errorCounter++;
                }
            });

            if(errorCounter == 0) {
                $("#ajax-loader").addClass("active");
                $(".contact-us-save-button").attr("disabled", true);
                $.ajax({
                    url: BUTTON_SETTINGS.ajax_url,
                    data: $("#help_form_new").serialize(),
                    type: 'post',
                    success: function(response) {
                        $("#ajax-loader").removeClass("active");
                        $(".contact-us-save-button").attr("disabled", false);
                        response = $.parseJSON(response);
                        if(response.errors.length > 0) {
                            for(var i=0; i<response.errors.length; i++) {
                                $("#"+response.errors[i]['key']).addClass("ginger-input-error");
                                $("#"+response.errors[i]['key']).after("<span class='ginger-error-message'>"+response.errors[i]['message']+"</span>");
                            }
                        } else if(response.status == 0) {
                            $(".ajax-response").html(response.message);
                            $(".ajax-response").addClass("error").removeClass("success").show();
                        } else if(response.status == 1) {
                            $("#help_form_new").addClass("hidden");
                            $("#contactSuccess").removeClass("hidden");
                            $(".modal").addClass("auto-dismiss");
                            setTimeout(() => {
                                $contactModal.removeClass("active");
                                $("#contactSuccess").addClass("hidden");
                                $("#help_form_new").trigger("reset");
                                $(".modal").removeClass("auto-dismiss");
                            }, 5000);

                        }
                    }
                })
            } else {
                $(this).find(".ginger-input-error:first").focus();
            }
            return false;
        });

    });

</script>