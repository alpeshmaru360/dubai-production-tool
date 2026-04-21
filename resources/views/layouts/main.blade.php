<!DOCTYPE html>
<html lang="en-US" class="no-js scheme_default">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <title>Dubai production tool</title>
    <link rel="icon" href="{{asset('sales_manager/uploads/clipart1724450.png')}}" type="image/x-icon">
    <meta name='robots' content='max-image-preview:large' />
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="WIP Tracker" />
    <meta property="og:description" content="" />
    <!-- <meta property="og:image" content="{{asset('sales_manager/uploads/2023/12/Salehiya-Launch-pad-v4-02.jpg')}}" /> -->
    <meta property="og:image" content="{{asset('sales_manager/uploads/logo/wilo_logo.png')}}" />

    <link property="stylesheet" rel='stylesheet' id='trx_addons-icons-css' href="{{asset('sales_manager/plugins/trx_addons/css/font-icons/css/trx_addons_icons.css')}}" media='all' />

    <link property="stylesheet" rel='stylesheet' id='alliance-fontello-css' href="{{asset('sales_manager/themes/alliance/skins/default/css/font-icons/css/fontello.css')}}" media='all' />

    <link property="stylesheet" rel='stylesheet' id='wp-block-library-css' href="{{asset('sales_manager/includes/style.min.css')}}" media='all' />


    <link property="stylesheet" rel='stylesheet' id='elementor-post-3160-css' href="{{asset('sales_manager/uploads/elementor/css/post-3160.css')}}" media='all' />

    <link property="stylesheet" rel='stylesheet' id='elementor-post-5327-css' href="{{asset('sales_manager/uploads/elementor/css/post-5327.css')}}" media='all' />

    <link property="stylesheet" rel='stylesheet' id='elementor-icons-shared-0-css' href="{{asset('sales_manager/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css')}}" media='all' />

    <link property="stylesheet" rel='stylesheet' id='alliance-style-css' href="{{asset('sales_manager/themes/alliance/style.css')}}" media='all' />

    <link property="stylesheet" rel='stylesheet' id='elementor-frontend-css' href="{{asset('sales_manager/uploads/elementor/css/custom-frontend.min.css')}}" media='all' />

    <link property="stylesheet" rel='stylesheet' id='elementor-post-8649-css' href="{{asset('sales_manager/uploads/elementor/css/post-8649.css')}}" media='all' />

    <link property="stylesheet" rel='stylesheet' id='trx_addons-css' href="{{asset('sales_manager/plugins/trx_addons/css/__styles.css')}}" media='all' />

    <link property="stylesheet" rel='stylesheet' id='trx_addons-sc_content-responsive-css' href="{{asset('sales_manager/plugins/trx_addons/components/shortcodes/content/content.responsive.css')}}" media='(max-width:1439px)' />

    <link property="stylesheet" rel='stylesheet' id='trx_addons-animations-css' href="{{asset('sales_manager/plugins/trx_addons/css/trx_addons.animations.css')}}" media='all' />

    <link property="stylesheet" rel='stylesheet' id='alliance-plugins-css' href="{{asset('sales_manager/themes/alliance/skins/default/css/__plugins.css')}}" media='all' />

    <link property="stylesheet" rel='stylesheet' id='alliance-custom-css' href="{{asset('sales_manager/themes/alliance/skins/default/css/__custom.css')}}" media='all' />

    <link property="stylesheet" rel='stylesheet' id='alliance-child-css' href="{{asset('sales_manager/themes/alliance-child/style.css')}}" media='all' />

    <link property="stylesheet" rel='stylesheet' id='trx_addons-responsive-css' href="{{asset('sales_manager/plugins/trx_addons/css/__responsive.css')}}" media='(max-width:1439px)' />

    <link property="stylesheet" rel='stylesheet' id='alliance-responsive-css' href="{{asset('sales_manager/themes/alliance/skins/default/css/__responsive.css')}}" media='(max-width:1679px)' />

    <link property="stylesheet" rel='stylesheet' id='alliance-skin-custom-css-default-css' href="{{asset('sales_manager/themes/alliance/skins/default/css/extra-style.css')}}" media='all' />

    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <script src="{{asset('sales_manager/wp-includes/js/jquery/jquery.min.js')}}" id="jquery-core-js"></script>

    <link rel="stylesheet" href="{{asset('css/admin_css1.css')}}">
    <!-- Font Awesome -->
    <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <!-- iCheck -->
    <link href="{{ asset('css/tabs/dubai_production.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet" />
    <!-- JQVMap -->
    <link href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet" />
    <!-- Theme style -->
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet" />
    <!-- overlayScrollbars -->
    <link href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}" rel="stylesheet" />
    <!-- Daterange picker -->
    <link href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <!-- summernote -->
    <link href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}" rel="stylesheet" />
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- Custom admin styling -->
    <link href="{{ asset('css/role.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
</head>

@php
$role = '';
@endphp
@if(Auth::check())
@if(Auth::user()->role == "Sales Manager")
@php $role = "Sales Manager"; @endphp
@else
@php $role = "Other"; @endphp
@endif
@endif

@php
    $role_user = Auth::user()->role;
@endphp
<body class="home-page bp-legacy home page-template-default page page-id-8649 logged-in wp-custom-logo pmpro-body-has-access preloader frontpage allow_lazy_load skin_default page_content_blocks menu_mobile_is_opened show_page_title debug_off scheme_default blog_mode_front body_style_wide  is_stream blog_style_excerpt_2 sidebar_hide expand_content trx_addons_present header_type_custom header_style_header-custom-3160 header_position_default menu_side_present no_layout fixed_blocks_sticky elementor-default elementor-kit-141 elementor-page elementor-page-8649 no-js {{$role == 'Other' ? 'menu_side_left' : ''}}">
    <div id="page_preloader">
        <div class="preloader_wrap preloader_square">
            <div class="preloader_square1"></div>
            <div class="preloader_square2"></div>
        </div>
    </div>
    <div class="body_wrap">
        <div class="page_wrap">
            <a class="alliance_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="1">Skip to content</a>
            <a class="alliance_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="1">Skip to footer</a>

            <header class="top_panel top_panel_custom top_panel_custom_3160 top_panel_custom_header				 without_bg_image">
                <div data-elementor-type="cpt_layouts" data-elementor-id="3160" class="elementor elementor-3160">
                    <section class="elementor-section elementor-top-section elementor-element elementor-section-content-middle sc_layouts_row sc_layouts_row_type_narrow sc_layouts_row_fixed sc_layouts_row_fixed_always elementor-section-stretched elementor-section-height-min-height elementor-section-full_width header_section elementor-section-height-default elementor-section-items-middle sc_fly_static {{$role == 'Other' ? 'elementor-element-559c821' : 'elementor-element-559c822'}}"
                        data-id="559c821" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;}">
                        <div class="elementor-container elementor-column-gap-no">
                            <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-595190e sc_layouts_hide_on_mobile sc-tablet_layouts_column_align_left sc_layouts_column sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static sc_hideonmobile"
                                data-id="595190e" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="sc_layouts_item elementor-element elementor-element-9e5daa3 header_logo_img sc_fly_static elementor-widget elementor-widget-image" data-id="9e5daa3" data-element_type="widget" data-widget_type="image.default">
                                        <div class="elementor-widget-container">
                                            @if($role_user == "Admin")
                                            <a href="{{ route('AdminDashboard') }}" class="wilo_logo">
                                                <img
                                                    width="418"
                                                    height="224"
                                                    src="{{ asset('sales_manager/uploads/logo/wilo_logo.png') }}"
                                                    class="lazyload_inited attachment-full size-full wp-image-10301"
                                                    alt=""
                                                    sizes="(max-width: 600px) 100vw, 418px" />
                                            </a>
                                            @else
                                            <a href="{{ route('SaleManagerDashboard') }}" class="wilo_logo">
                                                <img
                                                    width="418"
                                                    height="224"
                                                    src="{{ asset('sales_manager/uploads/logo/wilo_logo.png') }}"
                                                    class="lazyload_inited attachment-full size-full wp-image-10301"
                                                    alt=""
                                                    sizes="(max-width: 600px) 100vw, 418px" />
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-66 elementor-top-column elementor-element elementor-element-6175f6b sc_layouts_column_align_right sc_layouts_column sc-mobile_content_align_inherit sc-tablet_layouts_column_align_right sc_layouts_column sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static"
                                data-id="6175f6b" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="sc_layouts_item elementor-element elementor-element-85d476b elementor-view-default sc_fly_static elementor-widget elementor-widget-icon" data-id="85d476b" data-element_type="widget" data-widget_type="icon.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-icon-wrapper">
                                                <div class="elementor-icon">
                                                    <i aria-hidden="true" class="far fa-bell"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sc_layouts_item elementor-element elementor-element-4ca1688 sc_layouts_hide_on_wide sc_layouts_hide_on_desktop sc_layouts_hide_on_notebook sc_layouts_hide_on_tablet elementor-hidden-desktop elementor-hidden-tablet elementor-hidden-mobile sc_layouts_hide_on_mobile sc_fly_static elementor-widget elementor-widget-trx_sc_layouts_search"
                                        data-id="4ca1688" data-element_type="widget" data-widget_type="trx_sc_layouts_search.default">
                                        <div class="elementor-widget-container">
                                            <div class="sc_layouts_search hide_on_wide hide_on_desktop hide_on_notebook hide_on_tablet hide_on_mobile">
                                                <div class="search_wrap search_style_fullscreen layouts_search">
                                                    <div class="search_form_wrap">
                                                        <form role="search" method="get" class="search_form" action="">
                                                            <input type="hidden" value="" name="post_types">
                                                            <input type="text" class="search_field" placeholder="Start typing to search..." data-mobile-placeholder="Search" value="" name="s">
                                                            <button type="submit" class="search_submit trx_addons_icon-search" aria-label="Start search"></button>
                                                            <a class="search_close trx_addons_icon-delete"></a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sc_layouts_item elementor-element elementor-element-3450e55 sc_fly_static elementor-widget elementor-widget-trx_sc_layouts_login" data-id="3450e55" data-element_type="widget" data-widget_type="trx_sc_layouts_login.default">
                                        <div class="elementor-widget-container">
                                            <div class="sc_layouts_login sc_layouts_menu sc_layouts_menu_default">
                                                <ul class="sc_layouts_login_menu sc_layouts_dropdown sc_layouts_menu_nav sc_layouts_menu_no_collapse">
                                                    <li class="menu-item menu-item-has-children">
                                                        <a href="#" class="trx_addons_login_link">
                                                            <span class="sc_layouts_item_avatar">
                                                                <img loading="lazy" src="//www.gravatar.com/avatar/d8cf79024bacbe53359e1865935f7cef?s=50&#038;r=g&#038;d=mm" class="avatar user-1-avatar avatar-50 photo" width="50" height="50" alt="Profile picture of user" />
                                                            </span>
                                                            <span class="sc_layouts_item_details sc_layouts_login_details">
                                                                <span class="sc_layouts_item_details_line1 sc_layouts_iconed_text_line1"></span>
                                                                <span class="sc_layouts_item_details_line2 sc_layouts_iconed_text_line2">

                                                                    Welcome
                                                                    {{-- {{Auth::user()->name}} --}}
                                                                </span>
                                                            </span>
                                                        </a>
                                                        <ul>
                                                            <li class="menu-item trx_addons_icon-wpforms"><a href=""><span>New post</span></a></li>
                                                            <li class="menu-item menu-delimiter"></li>
                                                            <li class="menu-item trx_addons_icon-cog"><a href=""><span>My profile</span></a></li>
                                                            <li class="menu-item menu-delimiter"></li>
                                                            <li class="menu-item d-flex justify-content-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="logout_svg"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                                                                </svg>
                                                                <a href="{{route('Logout')}}"><span>Logout</span></a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </header>
            @if($role == 'Other')
            @include('partials.menu')
            @endif


            <div class="main_section bg-white m-4 ml-4 pt-1 pb-3">
                {{-- <h3 class="ml-4 pt-4 text-bold text-left text-uppercase">{{$page_title}}</h3> --}}
                <!-- <hr class="mx-4" /> -->
                @yield('content')
                {{-- @if($page_title != "" && $page_title != "Sales Manager")
                @endif --}}
            </div>

            <!-- <footer class="footer_wrap footer_custom footer_custom_5327 footer_custom_footer-simple">
                <div class="" style="text-align: center;">
                    <a href="" target="_blank">WIP Tracker</a>© 2024. All Rights Reserved. Developed By
                    <a href="" target="_blank" rel="noopener">360 INC</a>
                </div>
            </footer> -->
        </div>
    </div>

    <a href="#" class="trx_addons_scroll_to_top trx_addons_icon-up" title="Scroll to top"><span class="trx_addons_scroll_progress trx_addons_scroll_progress_type_round"></span></a>

    <script defer="defer" src="{{asset('sales_manager/plugins/buddypress-media/lib/media-element/wp-mediaelement.min.js')}}" id="rt-mediaelement-wp-js"></script>

    <script defer="defer" src="{{asset('sales_manager/plugins/buddypress-media/app/assets/js/vendors/emoji-picker.js')}}" id="rtmedia-emoji-picker-js"></script>

    <script id="rtmedia-main-js-extra">
        var rtmedia_bp = {
            "bp_template_pack": "legacy"
        };
        var RTMedia_Main_JS = {
            "media_delete_confirmation": "Are you sure you want to delete this media?",
            "rtmedia_ajaxurl": "{{asset('sales_manager\/admin-ajax.php')}}",
            "media_delete_success": "Media file deleted successfully."
        };
        var rtmedia_main_js_strings = {
            "rtmedia_albums": "Albums",
            "privacy_update_success": "Privacy updated successfully.",
            "privacy_update_error": "Couldn't change privacy, please try again."
        };
        var rtmedia_media_size_config = {
            "photo": {
                "thumb": {
                    "width": "150",
                    "height": "150",
                    "crop": "1"
                },
                "medium": {
                    "width": "0",
                    "height": "0",
                    "crop": "0"
                },
                "large": {
                    "width": "0",
                    "height": "0",
                    "crop": "0"
                }
            },
            "video": {
                "activity_media": {
                    "width": "0",
                    "height": "0"
                },
                "single_media": {
                    "width": "0",
                    "height": "0"
                }
            },
            "music": {
                "activity_media": {
                    "width": "0"
                },
                "single_media": {
                    "width": "0"
                }
            },
            "featured": {
                "default": {
                    "width": "100",
                    "height": "100",
                    "crop": "1"
                }
            }
        };
        var rtmedia_main = {
            "rtmedia_ajax_url": "{{asset('sales_manager\/admin-ajax.php')}}",
            "rtmedia_media_slug": "media",
            "rtmedia_lightbox_enabled": "1",
            "rtmedia_direct_upload_enabled": "0",
            "rtmedia_gallery_reload_on_upload": "1",
            "rtmedia_empty_activity_msg": "Please enter some content to post.",
            "rtmedia_empty_comment_msg": "Empty comment is not allowed.",
            "rtmedia_media_delete_confirmation": "Are you sure you want to delete this media?",
            "rtmedia_media_comment_delete_confirmation": "Are you sure you want to delete this comment?",
            "rtmedia_album_delete_confirmation": "Are you sure you want to delete this Album?",
            "rtmedia_drop_media_msg": "Drop files here",
            "rtmedia_album_created_msg": " album created successfully.",
            "rtmedia_something_wrong_msg": "Something went wrong. Please try again.",
            "rtmedia_empty_album_name_msg": "Enter an album name.",
            "rtmedia_max_file_msg": "Max file Size Limit: ",
            "rtmedia_allowed_file_formats": "Allowed File Formats",
            "rtmedia_select_all_visible": "Select All Visible",
            "rtmedia_unselect_all_visible": "Unselect All Visible",
            "rtmedia_no_media_selected": "Please select some media.",
            "rtmedia_selected_media_delete_confirmation": "Are you sure you want to delete the selected media?",
            "rtmedia_selected_media_move_confirmation": "Are you sure you want to move the selected media?",
            "rtmedia_waiting_msg": "Waiting",
            "rtmedia_uploaded_msg": "Uploaded",
            "rtmedia_uploading_msg": "Uploading",
            "rtmedia_upload_failed_msg": "Failed",
            "rtmedia_close": "Close",
            "rtmedia_edit": "Edit",
            "rtmedia_delete": "Delete",
            "rtmedia_edit_media": "Edit Media",
            "rtmedia_remove_from_queue": "Remove from queue",
            "rtmedia_add_more_files_msg": "Add more files",
            "rtmedia_file_extension_error_msg": "File not supported",
            "rtmedia_more": "more",
            "rtmedia_less": "less",
            "rtmedia_read_more": "Read more",
            "rtmedia__show_less": "Show less",
            "rtmedia_activity_text_with_attachment": "disable",
            "rtmedia_delete_uploaded_media": "This media is uploaded. Are you sure you want to delete this media?",
            "rtm_wp_version": "6.6.2",
            "rtmedia_masonry_layout": "false",
            "rtmedia_disable_media_in_commented_media": "1",
            "rtmedia_disable_media_in_commented_media_text": "Adding media in Comments is not allowed"
        };
    </script>

    <script defer="defer" src="{{asset('sales_manager/plugins/buddypress-media/app/assets/js/rtmedia.min.js')}}" id="rtmedia-main-js"></script>
    <script src="{{asset('sales_manager/plugins/buddypress-media/app/assets/js/rtMedia.backbone.js')}}" id="rtmedia-backbone-js"></script>
    <script defer="defer" src="{{asset('sales_manager/plugins/bp-activity-shortcode/assets/js/bpas-loadmore.js')}}" id="bpas-loadmore-js-js"></script>

    <script defer="defer" src="{{asset('sales_manager/includes/js/comment-reply.min.js')}}" id="comment-reply-js" async data-wp-strategy="async"></script>

    <script defer="defer" src="{{asset('sales_manager/plugins/popup-builder/public/js/Popup.js')}}" id="Popup.js-js"></script>
    <script defer="defer" src="{{asset('sales_manager/plugins/popup-builder/public/js/PopupConfig.js')}}" id="PopupConfig.js-js"></script>

    <script defer="defer" src="{{asset('sales_manager/plugins/popup-builder/public/js/PopupBuilder.js')}}" id="PopupBuilder.js-js"></script>
    <script defer="defer" src="{{asset('sales_manager/plugins/trx_addons/js/magnific/jquery.magnific-popup.min.js')}}" id="magnific-popup-js"></script>
    <script defer="defer" src="{{asset('sales_manager/plugins/wpo365-login/apps/dist/pintra-redirect.js')}}" id="pintraredirectjs-js" async></script>
    <script src="{{asset('sales_manager/includes/js/jquery/ui/core.min.js')}}" id="jquery-ui-core-js"></script>
    <script defer="defer" src="{{asset('sales_manager/includes/js/jquery/ui/mouse.min.js')}}" id="jquery-ui-mouse-js"></script>
    <script defer="defer" src="{{asset('sales_manager/includes/js/jquery/ui/draggable.min.js')}}" id="jquery-ui-draggable-js"></script>
    <script src="{{asset('sales_manager/plugins/elementor/assets/lib/backbone/backbone.marionette.min.js')}}" id="backbone-marionette-js"></script>
    <script src="{{asset('sales_manager/plugins/elementor/assets/lib/backbone/backbone.radio.min.js')}}" id="backbone-radio-js"></script>
    <script src="{{asset('sales_manager/plugins/elementor/assets/js/common-modules.min.js')}}" id="elementor-common-modules-js"></script>

    <script src="{{asset('sales_manager/plugins/elementor/assets/js/web-cli.min.js')}}" id="elementor-web-cli-js"></script>
    <script src="{{asset('sales_manager/plugins/elementor/assets/lib/dialog/dialog.min.js')}}" id="elementor-dialog-js"></script>

    <script defer="defer" src="{{asset('sales_manager/wp-includes/js/api-request.min.js')}}" id="wp-api-request-js"></script>

    <script src="{{asset('sales_manager/plugins/elementor/assets/js/dev-tools.min.js')}}" id="elementor-dev-tools-js"></script>
    <script src="{{asset('sales_manager/wp-includes/js/dist/hooks.min.js')}}" id="wp-hooks-js"></script>
    <script src="{{asset('sales_manager/wp-includes/js/dist/i18n.min.js')}}" id="wp-i18n-js"></script>
    <script id="wp-i18n-js-after">
        wp.i18n.setLocaleData({
            'text direction\u0004ltr': ['ltr']
        });
    </script>

    <script src="{{asset('sales_manager/plugins/elementor/assets/js/common.min.js')}}" id="elementor-common-js"></script>
    <script src="{{asset('sales_manager/plugins/elementor/assets/js/app-loader.min.js')}}" id="elementor-app-loader-js"></script>
    <script defer="defer" src="{{asset('sales_manager/plugins/m-chart-highcharts-library/components/external/highcharts/highcharts.js')}}" id="highcharts-js"></script>

    <script defer="defer" src="{{asset('sales_manager/plugins/trx_addons/js/__scripts.js')}}" id="trx_addons-js"></script>

    <script defer="defer" src="{{asset('sales_manager/plugins/trx_addons/components/cpt/layouts/shortcodes/menu/superfish.min.js')}}" id="superfish-js"></script>

    <script src="{{asset('sales_manager/plugins/trx_addons/js/tweenmax/tweenmax.min.js')}}" id="tweenmax-js"></script>

    <script defer="defer" src="{{asset('sales_manager/plugins/buddypress-media/lib/media-element/mediaelement-and-player.min.js')}}" id="rt-mediaelement-js"></script>

    <script defer="defer" src="{{asset('sales_manager/plugins/buddypress-media/lib/touchswipe/jquery.touchSwipe.min.js')}}" id="rtmedia-touchswipe-js"></script>

    <script defer="defer" src="{{asset('sales_manager/themes/alliance/js/__scripts.js')}}" id="alliance-init-js"></script>

    <script defer="defer" src="{{asset('sales_manager/wp-includes/js/mediaelement/mediaelement-and-player.min.js')}}" id="mediaelement-core-js"></script>

    <script defer="defer" src="{{asset('sales_manager/wp-includes/js/mediaelement/mediaelement-migrate.min.js')}}" id="mediaelement-migrate-js"></script>

    <script id="mediaelement-js-extra">
        var _wpmejsSettings = {
            "pluginPath": "\/wp-includes\/js\/mediaelement\/",
            "classPrefix": "mejs-",
            "stretching": "responsive",
            "audioShortcodeLibrary": "mediaelement",
            "videoShortcodeLibrary": "mediaelement"
        };
    </script>
    <script defer="defer" src="{{asset('sales_manager/wp-includes/js/mediaelement/wp-mediaelement.min.js')}}" id="wp-mediaelement-js"></script>
    <script defer="defer" src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js" id="splide-slider-js"></script>
    <script src="{{asset('sales_manager/plugins/elementor/assets/js/webpack.runtime.min.js')}}" id="elementor-webpack-runtime-js"></script>
    <script src="{{asset('sales_manager/plugins/elementor/assets/js/frontend-modules.min.js')}}" id="elementor-frontend-modules-js"></script>
    <script src="{{asset('sales_manager/plugins/elementor/assets/lib/waypoints/waypoints.min.js')}}" id="elementor-waypoints-js"></script>
    <script id="elementor-frontend-js-before">
        var elementorFrontendConfig = {
            "environmentMode": {
                "edit": false,
                "wpPreview": false,
                "isScriptDebug": false
            },
            "i18n": {
                "shareOnFacebook": "Share on Facebook",
                "shareOnTwitter": "Share on Twitter",
                "pinIt": "Pin it",
                "download": "Download",
                "downloadImage": "Download image",
                "fullscreen": "Fullscreen",
                "zoom": "Zoom",
                "share": "Share",
                "playVideo": "Play Video",
                "previous": "Previous",
                "next": "Next",
                "close": "Close",
                "a11yCarouselWrapperAriaLabel": "Carousel | Horizontal scrolling: Arrow Left & Right",
                "a11yCarouselPrevSlideMessage": "Previous slide",
                "a11yCarouselNextSlideMessage": "Next slide",
                "a11yCarouselFirstSlideMessage": "This is the first slide",
                "a11yCarouselLastSlideMessage": "This is the last slide",
                "a11yCarouselPaginationBulletMessage": "Go to slide"
            },
            "is_rtl": false,
            "breakpoints": {
                "xs": 0,
                "sm": 480,
                "md": 768,
                "lg": 1280,
                "xl": 1440,
                "xxl": 1600
            },
            "responsive": {
                "breakpoints": {
                    "mobile": {
                        "label": "Mobile Portrait",
                        "value": 767,
                        "default_value": 767,
                        "direction": "max",
                        "is_enabled": true
                    },
                    "mobile_extra": {
                        "label": "Mobile Landscape",
                        "value": 880,
                        "default_value": 880,
                        "direction": "max",
                        "is_enabled": false
                    },
                    "tablet": {
                        "label": "Tablet Portrait",
                        "value": 1279,
                        "default_value": 1024,
                        "direction": "max",
                        "is_enabled": true
                    },
                    "tablet_extra": {
                        "label": "Tablet Landscape",
                        "value": 1200,
                        "default_value": 1200,
                        "direction": "max",
                        "is_enabled": false
                    },
                    "laptop": {
                        "label": "Laptop",
                        "value": 1366,
                        "default_value": 1366,
                        "direction": "max",
                        "is_enabled": false
                    },
                    "widescreen": {
                        "label": "Widescreen",
                        "value": 2400,
                        "default_value": 2400,
                        "direction": "min",
                        "is_enabled": false
                    }
                }
            },
            "version": "3.16.4",
            "is_static": false,
            "experimentalFeatures": {
                "e_dom_optimization": true,
                "e_optimized_assets_loading": true,
                "additional_custom_breakpoints": true,
                "landing-pages": true
            },
            "urls": {
                "assets": "/sales_manager\/plugins\/elementor\/assets\/"
            },
            "swiperClass": "swiper-container",
            "settings": {
                "page": [],
                "editorPreferences": []
            },
            "kit": {
                "stretched_section_container": ".page_wrap",
                "viewport_tablet": 1279,
                "active_breakpoints": ["viewport_mobile", "viewport_tablet"],
                "global_image_lightbox": "yes",
                "lightbox_enable_counter": "yes",
                "lightbox_enable_fullscreen": "yes",
                "lightbox_enable_zoom": "yes",
                "lightbox_enable_share": "yes",
                "lightbox_title_src": "title",
                "lightbox_description_src": "description"
            },
            "post": {
                "id": 8649,
                "title": "salehiya",
                "excerpt": "",
                "featuredImage": false
            },
            "user": {
                "roles": ["administrator", "bbp_keymaster"]
            }
        };
    </script>
    <script src="{{asset('sales_manager/plugins/elementor/assets/js/frontend.min.js')}}" id="elementor-frontend-js"></script>

    <script src="{{asset('sales_manager/plugins/elementor/assets/js/elementor-admin-bar.min.js')}}" id="elementor-admin-bar-js"></script>

    <script defer="defer" src="{{asset('sales_manager/wp-includes/js/hoverintent-js.min.js')}}" id="hoverintent-js-js"></script>
    <script defer="defer" src="{{asset('sales_manager/wp-includes/js/admin-bar.min.js')}}" id="admin-bar-js"></script>
    <div id="sitewide-notice" class="admin-bar-off"></div>
    <script>
        jQuery(document).ready(function() {
            jQuery('.menu_mobile.menu_mobile_narrow').removeClass('is_opened');
            // jQuery('.menu_mobile.menu_mobile_narrow .menu_mobile_nav_area ul li a span').text('');
            jQuery.ajax({
                url: "{{asset('sales_manager\/admin-ajax.php')}}",
                type: 'POST',
                data: {
                    action: 'sso_dashboard_count',
                    // Add any data you want to send to the server
                },
                success: function(response) {
                    response = jQuery.parseJSON(response);
                    var inbox_count = 0;
                    var pending_request_count = 0;
                    var po_approval_count = 0;
                    if (response.success == 1) {
                        po_approval_count = response.data.po_approval_count;
                        inbox_count = response.data.inbox_count;
                        pending_request_count = response.data.pending_request_count;
                    }
                    jQuery(".po-approval").html(po_approval_count);
                    jQuery(".my_inbox_count").html(inbox_count);
                    jQuery(".my_pending_count").html(pending_request_count);
                }
            });
            // Floating Contact Widget Trigger
            jQuery(".salehiya-floating-icon").on("mouseenter", function() {
                jQuery(this).closest(".salehiya-floating-contact-wrap").addClass("hover")
            });
            jQuery(".salehiya-floating-contact-wrap").on("mouseleave", function() {
                jQuery(this).removeClass("hover");
            });
            var $swiperContainer = jQuery(".swiper-js-container");

            function init($this) {
                var $el = $this.find('.swiper-container'),
                    pagination = $this.find('.swiper-pagination'),
                    navNext = $this.find('.swiper-button-next'),
                    navPrev = $this.find('.swiper-button-prev'),
                    paginationType = $el.data('swiper-pagination-type') ? $el.data('swiper-pagination-type') : 'bullets';
                var $swiper = new Swiper($el, {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    loop: true,
                    autoplay: {
                        delay: 4000,
                    },
                    breakpoints: {
                        767: {
                            slidesPerView: 1
                        },
                        1024: {
                            slidesPerView: 1
                        },
                        1270: {
                            slidesPerView: 1
                        }
                    },
                    pagination: {
                        el: pagination,
                        clickable: true,
                        type: paginationType,
                    },
                    navigation: {
                        nextEl: navNext,
                        prevEl: navPrev,
                    }
                });
                //     var swiper = new Swiper(".swiper-container", {
                //     pagination: {
                //         el: ".swiper-pagination",
                //         dynamicBullets: true,
                //     },
                // });

            }
            $swiperContainer.each(function(i, Slider) {
                init(jQuery(Slider));
            });
            new Splide('#first-slider', {
                type: 'loop',
                perPage: 1,
                autoHeight: true,
                arrows: false,
                autoplay: true,
                interval: 3000, // How long to display each slide
                pauseOnHover: false, // must be false
                pauseOnFocus: false, // must be false
                resetProgress: false
            }).mount();

            // Open the modal when the button is clicked
            jQuery('.open_popup').on('click', function() {
                jQuery.magnificPopup.open({
                    items: {
                        src: '#modalContent'
                    }
                    // type: 'inline'
                });
            });

            // Close the modal when the close button is clicked
            jQuery(document).on('click', '.mfp-close', function() {
                jQuery.magnificPopup.close();
            });

        });
    </script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Datatable -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

    <!-- Main.js -->
    <script src="{{ asset('js/main.js') }}"></script>

    @yield('scripts')
</body>

</html>