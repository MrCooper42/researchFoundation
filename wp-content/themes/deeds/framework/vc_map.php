<?php

$maps[] = array(
    "name" => __("Event Calender", 'wp_deeds'),
    "base" => "sh_event_calender",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/Services.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array()
);
$maps[] = array(
    "name" => __("Fancy Services", 'wp_deeds'),
    "base" => "sh_services",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/Services.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Select Service", 'wp_deeds'),
            "param_name" => "number",
            "value" => array_flip(sh_get_services()),
            "description" => __("Select your service to display", 'wp_deeds')
        ),
    )
);
$maps[] = array(
    "name" => __("Simple Services", 'wp_deeds'),
    "base" => "sh_services_without",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/Services.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Select Service", 'wp_deeds'),
            "param_name" => "number",
            "value" => array_flip(sh_get_services()),
            "description" => __("Select your service to display", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Blog Post From Specific Category", 'wp_deeds'),
    "base" => "sh_blog_category",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/blog_post_cat.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Choose category for Blog Post", 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('hide_empty' => false), true)),
            "description" => __("Choose Category for the Blog Post you want to show.", 'wp_deeds')
        ),
    )
);
$maps[] = array(
    "name" => __("Events Carousal", 'wp_deeds'),
    "base" => "sh_events_carousal",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/event.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter number of posts", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Choose category for Events", 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('hide_empty' => false, 'taxonomy' => 'events_category'), true)),
            "description" => __("Choose Category for the Blog Post you want to show.", 'wp_deeds')
        ),
        /* array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Sort By", 'wp_deeds' ),
          "param_name" => "orderby",
          "value" => array_flip( array( 'date' => __( 'Date', 'wp_deeds' ), 'title' => __( 'Title', 'wp_deeds' ), 'name' => __( 'Name', 'wp_deeds' ), 'author' => __( 'Author', 'wp_deeds' ), 'comment_count' => __( 'Comment Count', 'wp_deeds' ), 'random' => __( 'Random', 'wp_deeds' ) ) ),
          "description" => __( "Choose Sorting by.", 'wp_deeds' )
          ), */
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Our Blog Slider", 'wp_deeds'),
    "base" => "sh_our_blog_slider",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/Gallery.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter number of Sermons", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Choose category for Sermons", 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('hide_empty' => false), true)),
            "description" => __("Choose Category for the Sermons you want to show.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sort By", 'wp_deeds'),
            "param_name" => "orderby",
            "value" => array_flip(array('date' => __('Date', 'wp_deeds'), 'title' => __('Title', 'wp_deeds'), 'name' => __('Name', 'wp_deeds'), 'author' => __('Author', 'wp_deeds'), 'comment_count' => __('Comment Count', 'wp_deeds'), 'random' => __('Random', 'wp_deeds'))),
            "description" => __("Choose Sorting by.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Read More Button", 'wp_deeds'),
            "param_name" => "show_readmore",
            "value" => array(__('True', 'wp_deeds') => 'true', __('False', 'wp_deeds') => 'false'),
            "description" => __("Show Read More Button after description", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Content Limit", 'wp_deeds'),
            "param_name" => "limit",
            "description" => __("Enter number of character for description limit", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Slider", 'wp_deeds'),
            "param_name" => "slider",
            "value" => array(__('True', 'wp_deeds') => 'true', __('False', 'wp_deeds') => 'false'),
            "description" => __("Enable this option to make posts slider", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Latest Sermons", 'wp_deeds'),
    "base" => "sh_latest_sermons",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/sermons.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter number of Latest News", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sort By", 'wp_deeds'),
            "param_name" => "orderby",
            "value" => array_flip(array('date' => __('Date', 'wp_deeds'), 'title' => __('Title', 'wp_deeds'), 'name' => __('Name', 'wp_deeds'), 'author' => __('Author', 'wp_deeds'), 'comment_count' => __('Comment Count', 'wp_deeds'), 'random' => __('Random', 'wp_deeds'))),
            "description" => __("Choose Sorting by.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Featured Sermons", 'wp_deeds'),
    "base" => "sh_sermons_wrapper",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/sermons.png",
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Choose Sermon", 'wp_deeds'),
            "param_name" => "sermon",
            "value" => array_flip(sh_get_posts_array('cs_sermons')),
            "description" => __("Choose Sermon to display in this section.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Overlap or Not", 'wp_deeds'),
            "param_name" => "overlp",
            "value" => array('True' => 'overlap', 'False' => 'false'),
            "description" => __("Chose Overlap or Not", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Latest News", 'wp_deeds'),
    "base" => "sh_news_latest",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/latest_news.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter number of Sermons", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Choose category for Sermons", 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('hide_empty' => false), true)),
            "description" => __("Choose Category for the Sermons you want to show.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sort By", 'wp_deeds'),
            "param_name" => "orderby",
            "value" => array_flip(array('date' => __('Date', 'wp_deeds'), 'title' => __('Title', 'wp_deeds'), 'name' => __('Name', 'wp_deeds'), 'author' => __('Author', 'wp_deeds'), 'comment_count' => __('Comment Count', 'wp_deeds'), 'random' => __('Random', 'wp_deeds'))),
            "description" => __("Choose Sorting by.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Our Team", 'wp_deeds'),
    "base" => "sh_meet_our_staff",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/staff.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter number of Sermons", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Choose category", 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('hide_empty' => false, 'taxonomy' => 'team_category'), true)),
            "description" => __("Choose Category for the Sermons you want to show.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sort By", 'wp_deeds'),
            "param_name" => "orderby",
            "value" => array_flip(array('date' => __('Date', 'wp_deeds'), 'title' => __('Title', 'wp_deeds'), 'name' => __('Name', 'wp_deeds'), 'author' => __('Author', 'wp_deeds'), 'comment_count' => __('Comment Count', 'wp_deeds'), 'random' => __('Random', 'wp_deeds'))),
            "description" => __("Choose Sorting by.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Heading", 'wp_deeds'),
    "base" => "sh_heading",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/Heading.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", 'wp_deeds'),
            "param_name" => "title",
            "value" => '',
            "description" => __("Enter Title for This Section.", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sub Title", 'wp_deeds'),
            "param_name" => "sub_title",
            "value" => '',
            "description" => __("Enter Sub Title for This Section.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Heading Style", 'wp_deeds'),
            "param_name" => "heading_style",
            "value" => array(__('Simple', 'wp_deeds') => 'simple', __('Underline', 'wp_deeds') => 'underline'),
            "description" => __("Choose Heading Style.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Simple Donation", 'wp_deeds'),
    "base" => "sh_simple_donation",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/give-us-donation.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", 'wp_deeds'),
            "param_name" => "title",
            "value" => '',
            "description" => __("Enter Title for This Section.", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Video Link", 'wp_deeds'),
            "param_name" => "vid_link",
            "value" => '',
            "description" => __("Enter Video Link.", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Text", 'wp_deeds'),
            "param_name" => "btn_text",
            "value" => '',
            "description" => __("Enter Text to show on Donate Button.", 'wp_deeds')
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "class" => "",
            "heading" => __("Content", 'wp_deeds'),
            "param_name" => "contents",
            "value" => '',
            "description" => __("Enter Content to show in this Section.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Gallery - Masonary", 'wp_deeds'),
    "base" => "sh_gallery_masonary",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/Gallery.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter number of Galleries", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Columns", 'wp_deeds'),
            "param_name" => "columns",
            "value" => array_flip(array('4col' => __('4 Col', 'wp_deeds'), '3col' => __('3 Col', 'wp_deeds'), '2col' => __('2 Col', 'wp_deeds'))),
            "description" => __("Choose Gallery Column.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sort By", 'wp_deeds'),
            "param_name" => "orderby",
            "value" => array_flip(array('date' => __('Date', 'wp_deeds'), 'title' => __('Title', 'wp_deeds'), 'name' => __('Name', 'wp_deeds'), 'author' => __('Author', 'wp_deeds'), 'comment_count' => __('Comment Count', 'wp_deeds'), 'random' => __('Random', 'wp_deeds'))),
            "description" => __("Choose Sorting by.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Gallery - Simple", 'wp_deeds'),
    "base" => "sh_gallery_simple",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/Gallery.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter number of Galleries", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Columns", 'wp_deeds'),
            "param_name" => "columns",
            "value" => array_flip(array('4col' => __('4 Col', 'wp_deeds'), '3col' => __('3 Col', 'wp_deeds'), '2col' => __('2 Col', 'wp_deeds'))),
            "description" => __("Choose Gallery Column.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sort By", 'wp_deeds'),
            "param_name" => "orderby",
            "value" => array_flip(array('date' => __('Date', 'wp_deeds'), 'title' => __('Title', 'wp_deeds'), 'name' => __('Name', 'wp_deeds'), 'author' => __('Author', 'wp_deeds'), 'comment_count' => __('Comment Count', 'wp_deeds'), 'random' => __('Random', 'wp_deeds'))),
            "description" => __("Choose Sorting by.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Columns", 'wp_deeds'),
            "param_name" => "column",
            "value" => array(__('4 Column', 'wp_deeds') => '4col', __('3 Column', 'wp_deeds') => '3col'),
            "description" => __("Choose Number of Columns.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Contact Information", 'wp_deeds'),
    "base" => "sh_contact_information",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/Contact.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", 'wp_deeds'),
            "param_name" => "title",
            "value" => '',
            "description" => __("Enter Title to show in this Section", 'wp_deeds')
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "class" => "",
            "heading" => __("Text", 'wp_deeds'),
            "param_name" => "text",
            "value" => '',
            "description" => __("Enter Text to in this Section", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Linked in", 'wp_deeds'),
            "param_name" => "linkedin",
            "value" => '',
            "description" => __("Enter LinkedIn Profile Link.", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Facebook", 'wp_deeds'),
            "param_name" => "facebook",
            "value" => '',
            "description" => __("Enter Facebook URL.", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Twitter", 'wp_deeds'),
            "param_name" => "twitter",
            "value" => '',
            "description" => __("Enter Twitter URL.", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Google Plus", 'wp_deeds'),
            "param_name" => "gplus",
            "value" => '',
            "description" => __("Enter Google Plus URL.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Contact Form", 'wp_deeds'),
    "base" => "sh_contact_form",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/Contact.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", 'wp_deeds'),
            "param_name" => "title",
            "value" => '',
            "description" => __("Enter the Title to Show on this Contact Form.", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Email", 'wp_deeds'),
            "param_name" => "email",
            "value" => '',
            "description" => __("Enter your email to receive emails", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Site Key", 'wp_deeds'),
            "param_name" => "site_key",
            "value" => '',
            "description" => __("Enter google captcha site key", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Secret Key", 'wp_deeds'),
            "param_name" => "secret_key",
            "value" => '',
            "description" => __("Enter google captcha secret key", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Contact Information Boxes", 'wp_deeds'),
    "base" => "sh_contact_info_boxes",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/Contact.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Address", 'wp_deeds'),
            "param_name" => "address",
            "value" => '',
            "description" => __("Enter Address.", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Phone", 'wp_deeds'),
            "param_name" => "phone",
            "value" => '',
            "description" => __("Enter Phone Number.", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Email", 'wp_deeds'),
            "param_name" => "email",
            "value" => '',
            "description" => __("Enter Email Address.", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Website", 'wp_deeds'),
            "param_name" => "website",
            "value" => '',
            "description" => __("Enter Website URL.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Give Us Donation", 'wp_deeds'),
    "base" => "sh_give_us_donation",
    "show_settings_on_create" => true,
    "icon" => get_template_directory_uri() . "/images/give-us-donation.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
// add params same as with any other content element
        array(
            "type" => "textarea_raw_html",
            "heading" => __("Rotating Title", 'wp_deeds'),
            "param_name" => "rotating_title",
            "description" => __("enter the title", 'wp_deeds'),
            'value' => ''
        ),
        array(
            "type" => "textarea_raw_html",
            "heading" => __("Content", 'wp_deeds'),
            "param_name" => "main_text",
            "description" => __("enter the main text", 'wp_deeds'),
            'value' => ''
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", 'wp_deeds'),
            "param_name" => "title",
            "description" => __("enter the title", 'wp_deeds'),
            'value' => ''
        ),
        array(
            "type" => "textfield",
            "heading" => __("Tagline", 'wp_deeds'),
            "param_name" => "tagline",
            "description" => __("enter the tagline", 'wp_deeds'),
            'value' => ''
        ),
        array(
            "type" => "textfield",
            "heading" => __("Donation Text", 'wp_deeds'),
            "param_name" => "text",
            "description" => __("enter the text to show on donation area", 'wp_deeds'),
            'value' => ''
        ),
        array(
            "type" => "textarea",
            "heading" => __("Privacy Text", 'wp_deeds'),
            "param_name" => "content",
            "description" => __("enter the privacy policy text, you can use html tags", 'wp_deeds'),
            'value' => ''
        ),
        array(
            "type" => "checkbox",
            "heading" => __("Show Links", 'wp_deeds'),
            "param_name" => "links",
            "description" => __("Show or hide sign in / signup links", 'wp_deeds'),
            'value' => array(__("Signin / signup links", 'wp_deeds') => true)
        ),
        array(
            "type" => "checkbox",
            "heading" => __("Detail Link", 'wp_deeds'),
            "param_name" => "detail_link",
            "description" => __("Show or hide detail link", 'wp_deeds'),
            'value' => array(__("Detail Link", 'wp_deeds') => true),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Donate Button Text", 'wp_deeds'),
            "param_name" => "donate_btn_text",
            "description" => __("Enter Button Text for Donation Button", 'wp_deeds'),
            'value' => '',
        ),
        array(
            "type" => "textfield",
            "heading" => __("Detail Link", 'wp_deeds'),
            "param_name" => "detail_link_text",
            "description" => __("Enter Detail Link Button Text", 'wp_deeds'),
            'value' => '',
        ),
        array(
            "type" => "textfield",
            "heading" => __("Detail Link Anchor", 'wp_deeds'),
            "param_name" => "detail_link_anchor",
            "description" => __("Enter Detail Link Anchor", 'wp_deeds'),
            'value' => '',
        ),
    ),
);
$maps[] = array(
    "name" => __("Audio Box", 'wp_deeds'),
    "base" => "sh_audio_box",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/audio.png",
    "params" => array(
        array(
            "type" => "textarea",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sound Cloud Code", 'wp_deeds'),
            "param_name" => "sound_values",
            "value" => '',
            "description" => __("Enter the Sound Cloud audio Code like 561586 with comma seprated", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Latest Events", 'wp_deeds'),
    "base" => "sh_events",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/event.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number of Events", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter the number of Events", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __('Category', 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('post_type' => 'cs_events', 'taxonomy' => 'events_category'), true)),
            "description" => __('Choose Category.', 'wp_deeds')
        ),
        /* array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Sort By", 'wp_deeds' ),
          "param_name" => "orderby",
          "value" => array_flip( array( 'date' => __( 'Date', 'wp_deeds' ), 'title' => __( 'Title', 'wp_deeds' ), 'name' => __( 'Name', 'wp_deeds' ), 'author' => __( 'Author', 'wp_deeds' ), 'comment_count' => __( 'Comment Count', 'wp_deeds' ), 'random' => __( 'Random', 'wp_deeds' ) ) ),
          "description" => __( "Choose Sorting by.", 'wp_deeds' )
          ), */
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order Note: It will sort by event start date", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Daily News Carousel", 'wp_deeds'),
    "base" => "sh_daily_news",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/Gallery.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number of News", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter the number of News", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __('Category', 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('hide_empty' => false), true)),
            "description" => __('Choose Category.', 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sort By", 'wp_deeds'),
            "param_name" => "orderby",
            "value" => array_flip(array('date' => __('Date', 'wp_deeds'), 'title' => __('Title', 'wp_deeds'), 'name' => __('Name', 'wp_deeds'), 'author' => __('Author', 'wp_deeds'), 'comment_count' => __('Comment Count', 'wp_deeds'), 'random' => __('Random', 'wp_deeds'))),
            "description" => __("Choose Sorting by.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Blog List Style", 'wp_deeds'),
    "base" => "sh_blog_listing",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/blog_post_cat.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number of item", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter the number of item", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __('Category', 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('hide_empty' => false), true)),
            "description" => __('Choose Category.', 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sort By", 'wp_deeds'),
            "param_name" => "orderby",
            "value" => array_flip(array('date' => __('Date', 'wp_deeds'), 'title' => __('Title', 'wp_deeds'), 'name' => __('Name', 'wp_deeds'), 'author' => __('Author', 'wp_deeds'), 'comment_count' => __('Comment Count', 'wp_deeds'), 'random' => __('Random', 'wp_deeds'))),
            "description" => __("Choose Sorting by.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("About Us", 'wp_deeds'),
    "base" => "sh_about_us",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/about.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", 'wp_deeds'),
            "param_name" => "title",
            "value" => '',
            "description" => __("Enter the title", 'wp_deeds')
        ),
        array(
            "type" => "textarea_raw_html",
            "holder" => "div",
            "class" => "",
            "heading" => __('Description', 'wp_deeds'),
            "param_name" => "desc",
            "value" => "",
            "description" => __('Enter the description.', 'wp_deeds')
        ),
        array(
            "type" => "attach_images",
            "holder" => "div",
            "class" => "",
            "heading" => __("Images", 'wp_deeds'),
            "param_name" => "gallery",
            "value" => "",
            "description" => __("Select image.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Church Stories", 'wp_deeds'),
    "base" => "sh_church_stories",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/church_s.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number of item", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter the number of item", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __('Category', 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('post_type' => 'cs_church', 'taxonomy' => 'church_category', 'hide_empty' => false), true)),
            "description" => __('Choose Category.', 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sort By", 'wp_deeds'),
            "param_name" => "orderby",
            "value" => array_flip(array('date' => __('Date', 'wp_deeds'), 'title' => __('Title', 'wp_deeds'), 'name' => __('Name', 'wp_deeds'), 'author' => __('Author', 'wp_deeds'), 'comment_count' => __('Comment Count', 'wp_deeds'), 'random' => __('Random', 'wp_deeds'))),
            "description" => __("Choose Sorting by.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Upcoming Event With Video", 'wp_deeds'),
    "base" => "sh_up_event_with_video",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/Gallery.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Heading", 'wp_deeds'),
            "param_name" => "heading",
            "value" => '',
            "description" => __("Enter the heading of this event", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sub Heading", 'wp_deeds'),
            "param_name" => "sub_heading",
            "value" => '',
            "description" => __("Enter the sub heading of this event", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Vimeo Vidoe Code", 'wp_deeds'),
            "param_name" => "vimeo",
            "value" => '',
            "description" => __("Enter the Vimeo vidoe code like 61350461", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __('Event', 'wp_deeds'),
            "param_name" => "event_id",
            "value" => array_flip(sh_get_posts_array('cs_events')),
            "description" => __('select an event to show.', 'wp_deeds')
        ),
    /* array(
      "type" => "dropdown",
      "holder" => "div",
      "class" => "",
      "heading" => __( 'Category', 'wp_deeds' ),
      "param_name" => "cat",
      "value" => sh_get_categories( array( 'post_type' => 'cs_events', 'taxonomy' => 'events_category', 'hide_empty' => false ) ),
      "description" => __( 'Choose Category.', 'wp_deeds' )
      ),
      array(
      "type" => "dropdown",
      "holder" => "div",
      "class" => "",
      "heading" => __( "Sort By", 'wp_deeds' ),
      "param_name" => "orderby",
      "value" => array_flip( array( 'date' => __( 'Date', 'wp_deeds' ), 'title' => __( 'Title', 'wp_deeds' ), 'name' => __( 'Name', 'wp_deeds' ), 'author' => __( 'Author', 'wp_deeds' ), 'comment_count' => __( 'Comment Count', 'wp_deeds' ), 'random' => __( 'Random', 'wp_deeds' ) ) ),
      "description" => __( "Choose Sorting by.", 'wp_deeds' )
      ),
      array(
      "type" => "dropdown",
      "holder" => "div",
      "class" => "",
      "heading" => __( "Sorting Order", 'wp_deeds' ),
      "param_name" => "order",
      "value" => array( __( 'Ascending Order', 'wp_deeds' ) => 'ASC', __( 'Descending Order', 'wp_deeds' ) => 'DESC' ),
      "description" => __( "Choose Sorting Order.", 'wp_deeds' )
      ), */
    )
        )
;
$maps[] = array(
    "name" => __("Upcoming Event with Counter", 'wp_deeds'),
    "base" => "sh_up_event_with_counter",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/Gallery.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter the number of showing events", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __('Event Type', 'wp_deeds'),
            "param_name" => "type",
            "value" => array('simple' => 'Simple', 'carousel' => 'Carousel'),
            "description" => __('Choose Category.', 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __('Category', 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('post_type' => 'cs_events', 'taxonomy' => 'events_category', 'hide_empty' => false), true)),
            "description" => __('Choose Category.', 'wp_deeds')
        ),
        /* array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Sort By", 'wp_deeds' ),
          "param_name" => "orderby",
          "value" => array_flip( array( 'date' => __( 'Date', 'wp_deeds' ), 'title' => __( 'Title', 'wp_deeds' ), 'name' => __( 'Name', 'wp_deeds' ), 'author' => __( 'Author', 'wp_deeds' ), 'comment_count' => __( 'Comment Count', 'wp_deeds' ), 'random' => __( 'Random', 'wp_deeds' ) ) ),
          "description" => __( "Choose Sorting by.", 'wp_deeds' )
          ), */
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order. Note: It will sort by event start date", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Buttons", 'wp_deeds'),
    "base" => "sh_button",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/Button.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Text", 'wp_deeds'),
            "param_name" => "text",
            "value" => '',
            "description" => __("Enter the Button text:", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Link", 'wp_deeds'),
            "param_name" => "btn_link",
            "value" => '',
            "description" => __("Enter the Button Link:", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Style", 'wp_deeds'),
            "param_name" => "btn_style",
            "value" => array_flip(array('gray' => 'Gray', 'red' => 'Red', 'darkblue' => 'Dark Blue', 'brown' => 'Brown', 'darkgray' => 'Dark Gray', 'lightblue' => 'Light Blue', 'black' => 'Black', 'green' => 'Green', 'lemon' => 'Lemon', 'yellow' => 'Yellow', 'blue' => 'Blue', 'purple' => 'Purple', 'yellow2' => 'Yellow 2', 'orange' => 'Orange', 'cyan' => 'Cyan', 'peach' => 'Peach', 'lightpurple' => 'Light Purple', 'lemon2' => 'Lemon 2', 'lightbrown' => 'Light Brown', 'navyblue' => 'Navy Blue', 'seagreen' => 'Seagreen')),
            "description" => __("Select Button Style:", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Inverse", 'wp_deeds'),
            "param_name" => "inverse",
            "value" => array_flip(array('true' => 'True', 'false' => 'false')),
            "description" => __("Select Button Style:", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Twitter Tweets", 'wp_deeds'),
    "base" => "sh_twittes",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/Twitter.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Twitter Username", 'wp_deeds'),
            "param_name" => "tw_user",
            "value" => '',
            "description" => __("Enter the Twitter Username:", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Show Twittes", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter the Twittes Number:", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Welcome Message", 'wp_deeds'),
    "base" => "sh_welcome_msg",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/wel_msg.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Welcome Title", 'wp_deeds'),
            "param_name" => "wel_title",
            "value" => '',
            "description" => __("Enter the Welcome Title:", 'wp_deeds')
        ),
        array(
            "type" => "textarea_raw_html",
            "holder" => "div",
            "class" => "",
            "heading" => __('Welcome Message', 'wp_deeds'),
            "param_name" => "wel_msg",
            "value" => "",
            "description" => __('Enter the welcome message.', 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Text", 'wp_deeds'),
            "param_name" => "btn_txt",
            "value" => '',
            "description" => __("Enter the Button Text:", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Link", 'wp_deeds'),
            "param_name" => "btn_link",
            "value" => '',
            "description" => __("Enter the Button Link:", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Pastors Message", 'wp_deeds'),
    "base" => "sh_pastors_msg",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/pastor.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter the number of show pastors messages:", 'wp_deeds')
        ),
        array(
            "type" => "checkbox",
            "heading" => __("Carousel", 'wp_deeds'),
            "param_name" => "carousel",
            "description" => __("Check to disable carousel for pastors messages listing", 'wp_deeds'),
            'value' => array(__("Disable Carousel", 'wp_deeds') => true),
        ),
    )
);
$maps[] = array(
    "name" => __("Donation Box", 'wp_deeds'),
    "base" => "sh_donation_box",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/give-us-donation.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Heading", 'wp_deeds'),
            "param_name" => "heading",
            "value" => '',
            "description" => __("Enter the heading of this section:", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sub Heading", 'wp_deeds'),
            "param_name" => "sub_heading",
            "value" => '',
            "description" => __("Enter the sub heading of this section:", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Products Carousel", 'wp_deeds'),
    "base" => "sh_products_listing",
    "class" => "",
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/Gallery.png",
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", 'wp_deeds'),
            "param_name" => "title",
            "value" => '',
            "description" => __("Enter Title for this Section.", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sub Title", 'wp_deeds'),
            "param_name" => "sub_title",
            "value" => '',
            "description" => __("Enter sub title for this Section.", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number of Products", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter the number of products", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sort By", 'wp_deeds'),
            "param_name" => "orderby",
            "value" => array_flip(array('date' => __('Date', 'wp_deeds'), 'title' => __('Title', 'wp_deeds'), 'name' => __('Name', 'wp_deeds'), 'author' => __('Author', 'wp_deeds'), 'comment_count' => __('Comment Count', 'wp_deeds'), 'random' => __('Random', 'wp_deeds'))),
            "description" => __("Choose Sorting by.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __('Category', 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(product_cat()),
            "description" => __('Choose Category.', 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order.", 'wp_deeds')
        )
    )
        )
;
$maps[] = array(
    "name" => __("Accordian Block", 'wp_deeds'),
    "base" => "sh_accordian_block",
    "class" => "",
    "as_parent" => array('only' => 'sh_accordian'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "category" => __('Deeds', 'wp_deeds'),
    "icon" => get_template_directory_uri() . "/images/accordian-block.png",
    "params" => array(
// add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Desctiption", 'wp_deeds'),
            "param_name" => "desc",
            "description" => ''
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Accordian", 'wp_deeds'),
    "base" => "sh_accordian",
    "class" => "",
    "content_element" => true,
    "as_child" => array('only' => 'sh_accordian_block'),
    "icon" => get_template_directory_uri() . "/images/accordian-block.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Title", 'wp_deeds'),
            "param_name" => "title",
            "description" => __("Enter the title of the accordian", 'wp_deeds')
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "class" => "",
            "heading" => __('Content', 'wp_deeds'),
            "param_name" => "acc_content",
            'value' => '',
            "description" => __("Enter the Content:", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Blockqoute", 'wp_deeds'),
    "base" => "sh_blockqoute",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/block_quote.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textarea",
            "holder" => "div",
            "class" => "",
            "heading" => __("Content", 'wp_deeds'),
            "param_name" => "block_cont",
            "description" => __("Enter the Content for Blockquote", 'wp_deeds')
        ),
        array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => __("Blockqoute Background", 'wp_deeds'),
            "param_name" => "blockqoute_bg",
            "description" => __("Select image for blockqoute background.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Newsletter", 'wp_deeds'),
    "base" => "sh_newsletter_paralex",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/tops-brands.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Social Median", 'wp_deeds'),
            "param_name" => "sh_ns_media",
            "value" => array('True' => 'true', 'False' => 'false'),
            "description" => __("Show the social media", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Newsletter Link", 'wp_deeds'),
            "param_name" => "newlatter_link",
            "description" => __("Enter the feedburner link like 'sugotech/kyRW'", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Ministry Tabs", 'wp_deeds'),
    "base" => "sh_ministry_tabs",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/heading.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Tab 1 Title", 'wp_deeds'),
            "param_name" => "tab1",
            "value" => "",
            "description" => __("Enter the title of the tab 1", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Select Category 1", 'wp_deeds'),
            "param_name" => "cat1",
            "value" => array_flip(sh_get_categories(array('post_type' => 'cs_ministry', 'taxonomy' => 'ministry_category'), true)),
            "description" => __("Select 1st Tab Category", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Tab 2 Title", 'wp_deeds'),
            "param_name" => "tab2",
            "value" => "",
            "description" => __("Enter the title of the tab 2", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Select Category 2", 'wp_deeds'),
            "param_name" => "cat2",
            "value" => array_flip(sh_get_categories(array('post_type' => 'cs_ministry', 'taxonomy' => 'ministry_category'), true)),
            "description" => __("Select 2st Tab Category", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Tab 3 Title", 'wp_deeds'),
            "param_name" => "tab3",
            "value" => "",
            "description" => __("Enter the title of the tab 3", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Select Category 3", 'wp_deeds'),
            "param_name" => "cat3",
            "value" => array_flip(sh_get_categories(array('post_type' => 'cs_ministry', 'taxonomy' => 'ministry_category'), true)),
            "description" => __("Select 3st Tab Category", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Tab 4 Title", 'wp_deeds'),
            "param_name" => "tab4",
            "value" => "",
            "description" => __("Enter the title of the tab 4", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Select Category 4", 'wp_deeds'),
            "param_name" => "cat4",
            "value" => array_flip(sh_get_categories(array('post_type' => 'cs_ministry', 'taxonomy' => 'ministry_category'), true)),
            "description" => __("Select 4st Tab Category", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Church", 'wp_deeds'),
    "base" => "sh_church",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/Church.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Church Title", 'wp_deeds'),
            "param_name" => "ch_title",
            "description" => __("Enter the title for find church section:", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Text", 'wp_deeds'),
            "param_name" => "ch_txt",
            "description" => __("Enter the Text for find church section:", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Prayer Title", 'wp_deeds'),
            "param_name" => "ch_p_title",
            "description" => __("Enter the title for request your prayer section:", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Text", 'wp_deeds'),
            "param_name" => "ch_p_txt",
            "description" => __("Enter the Text for request your prayer section:", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Meet Me Title", 'wp_deeds'),
            "param_name" => "ch_m_title",
            "description" => __("Enter the title for meet me section:", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Meet Me Text", 'wp_deeds'),
            "param_name" => "ch_m_text",
            "description" => __("Enter the text for meet me section:", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Email", 'wp_deeds'),
            "param_name" => "ch_email",
            "description" => __("Enter the Email:", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Carousel for Events", 'wp_deeds'),
    "base" => "sh_events_carousel",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/blog_carousel.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "bc_number",
            "description" => __("Enter the number of show posts:", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __('Category', 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('post_type' => 'cs_events', 'taxonomy' => 'events_category', 'hide_empty' => false), true)),
            "description" => __('Choose Category.', 'wp_deeds')
        ),
        /* array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Sort By", 'wp_deeds' ),
          "param_name" => "orderby",
          "value" => array_flip( array( 'date' => __( 'Date', 'wp_deeds' ), 'title' => __( 'Title', 'wp_deeds' ), 'name' => __( 'Name', 'wp_deeds' ), 'author' => __( 'Author', 'wp_deeds' ), 'comment_count' => __( 'Comment Count', 'wp_deeds' ), 'random' => __( 'Random', 'wp_deeds' ) ) ),
          "description" => __( "Choose Sorting by. Note: sorting order will not work with this option.", 'wp_deeds' )
          ), */
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order. Note: It will sort by event start date", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Carousel for Church Story", 'wp_deeds'),
    "base" => "sh_church_story_carousel",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/blog_carousel.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "bc_number",
            "description" => __("Enter the number of show posts:", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __('Category', 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('post_type' => 'cs_church', 'taxonomy' => 'church_category', 'hide_empty' => false), true)),
            "description" => __('Choose Category.', 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sort By", 'wp_deeds'),
            "param_name" => "orderby",
            "value" => array_flip(array('date' => __('Date', 'wp_deeds'), 'title' => __('Title', 'wp_deeds'), 'name' => __('Name', 'wp_deeds'), 'author' => __('Author', 'wp_deeds'), 'comment_count' => __('Comment Count', 'wp_deeds'), 'random' => __('Random', 'wp_deeds'))),
            "description" => __("Choose Sorting by.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Survey Box", 'wp_deeds'),
    "base" => "sh_survey_box_paralex",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/survey.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Survey Box Ttitle", 'wp_deeds'),
            "param_name" => "sb_box_title",
            "description" => __("Enter the survey box ttitle:", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Blog Masonary", 'wp_deeds'),
    "base" => "sh_blog_masonry",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/blog_carousel.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "bc_number",
            "description" => __("Enter the number of show posts:", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __('Category', 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('post_type' => 'post', 'hide_empty' => false), true)),
            "description" => __('Choose Category.', 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sort By", 'wp_deeds'),
            "param_name" => "orderby",
            "value" => array_flip(array('date' => __('Date', 'wp_deeds'), 'title' => __('Title', 'wp_deeds'), 'name' => __('Name', 'wp_deeds'), 'author' => __('Author', 'wp_deeds'), 'comment_count' => __('Comment Count', 'wp_deeds'), 'random' => __('Random', 'wp_deeds'))),
            "description" => __("Choose Sorting by.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order.", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __('Button', 'wp_deeds'),
            "param_name" => "showmore_button",
            "value" => array(__('False', 'wp_deeds') => 'false', __('True', 'wp_deeds') => 'true'),
            "description" => __('hide/show watch more blog post button', 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Text", 'wp_deeds'),
            "param_name" => "showmore_button_text",
            "description" => __("Enter text for blog show more posts button:", 'wp_deeds'),
            'dependency' => array(
                'element' => 'showmore_button',
                'value' => array('true')
            ),
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Our Deals", 'wp_deeds'),
    "base" => "sh_our_deals",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/deals_new.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Ttitle", 'wp_deeds'),
            "param_name" => "deal_title",
            "description" => __("Enter the title for this section:", 'wp_deeds')
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "class" => "",
            "heading" => __("Description", 'wp_deeds'),
            "param_name" => "sb_desc",
            "description" => __("Enter the Description for this section:", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Title", 'wp_deeds'),
            "param_name" => "deal_btn_title",
            "description" => __("Enter the button title for this section:", 'wp_deeds')
        ),
        array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => __("Left Deal Image", 'wp_deeds'),
            "param_name" => "sb_lft_img",
            "description" => __("Upload or select the image", 'wp_deeds')
        ),
        array(
            "type" => "attach_image",
            "holder" => "div",
            "class" => "",
            "heading" => __("Right Deal Image", 'wp_deeds'),
            "param_name" => "sb_right_img",
            "description" => __("Upload or select the image", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Product On Sale", 'wp_deeds'),
    "base" => "sh_product_sale",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/sale.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Popular Post", 'wp_deeds'),
            "param_name" => "popular_number",
            "description" => __("Enter the Number for the popular post:", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Recent Post", 'wp_deeds'),
            "param_name" => "recent_number",
            "description" => __("Enter the Number for the Recent post:", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Featured Post", 'wp_deeds'),
            "param_name" => "featured_number",
            "description" => __("Enter the Number for the Featured post:", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Partners", 'wp_deeds'),
    "base" => "sh_partners",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/partner.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "partner_number",
            "value" => array('3' => '3', '6' => '6', '9' => '9'),
            "description" => __("Enter the Number for this section:", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("iconic Services", 'wp_deeds'),
    "base" => "sh_sconic_services",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/iconic_services.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Services", 'wp_deeds'),
            "param_name" => "number",
            "description" => __("Enter Number of Services. Note: (firstly make services in theme option)", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Select Columns", 'wp_deeds'),
            "param_name" => "columns",
            "value" => array(__('2 Column', 'wp_deeds') => '6', __('3 Column', 'wp_deeds') => '4', __('4 Column', 'wp_deeds') => '3'),
            "description" => __("Select Services column", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("iconic Donation Box", 'wp_deeds'),
    "base" => "sh_iconic_donation_box",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/donation_box.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Enter Title", 'wp_deeds'),
            "param_name" => "title",
            "description" => __("Enter the title for this section", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Country Number", 'wp_deeds'),
            "param_name" => "country",
            "description" => __("Enter the number of the country.", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Text", 'wp_deeds'),
            "param_name" => "btn_txt",
            "description" => __("Enter the text of donation button", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Overlap", 'wp_deeds'),
            "param_name" => "overlap",
            "value" => array(__('True', 'wp_deeds') => 'true', __('False', 'wp_deeds') => 'false'),
            "description" => __("Select this option to make this box Overlap.", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Event Carousel With Date", 'wp_deeds'),
    "base" => "sh_event_carousel_date",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/blog_carousel.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Number", 'wp_deeds'),
            "param_name" => "number",
            "value" => '',
            "description" => __("Enter number of posts", 'wp_deeds')
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Choose category for Events", 'wp_deeds'),
            "param_name" => "cat",
            "value" => array_flip(sh_get_categories(array('hide_empty' => false, 'taxonomy' => 'events_category'), true)),
            "description" => __("Choose Category for the Blog Post you want to show.", 'wp_deeds')
        ),
        /* array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Sort By", 'wp_deeds' ),
          "param_name" => "orderby",
          "value" => array_flip( array( 'date' => __( 'Date', 'wp_deeds' ), 'title' => __( 'Title', 'wp_deeds' ), 'name' => __( 'Name', 'wp_deeds' ), 'author' => __( 'Author', 'wp_deeds' ), 'comment_count' => __( 'Comment Count', 'wp_deeds' ), 'random' => __( 'Random', 'wp_deeds' ) ) ),
          "description" => __( "Choose Sorting by.", 'wp_deeds' )
          ), */
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __("Sorting Order", 'wp_deeds'),
            "param_name" => "order",
            "value" => array(__('Ascending Order', 'wp_deeds') => 'ASC', __('Descending Order', 'wp_deeds') => 'DESC'),
            "description" => __("Choose Sorting Order. Note: It will sort by event start date", 'wp_deeds')
        ),
    )
        )
;
$maps[] = array(
    "name" => __("Donation Bar", 'wp_deeds'),
    "base" => "sh_donation_bar",
    "class" => "",
    "icon" => get_template_directory_uri() . "/images/give-us-donation.png",
    "category" => __('Deeds', 'wp_deeds'),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Enter Title", 'wp_deeds'),
            "param_name" => "title",
            "description" => __("Enter the title for this section", 'wp_deeds')
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __("Button Text", 'wp_deeds'),
            "param_name" => "btn_txt",
            "description" => __("Enter the text of donation button", 'wp_deeds')
        ),
    )
);

foreach ($maps as $vc_arr) {

    foreach (sh_set($vc_arr, 'params') as $k => $param) {
        if (sh_set($param, 'holder')) {
            unset($param['holder']);
            $vc_arr['params'][$k] = $param;
        }
        if (sh_set($param, 'type') == 'dropdown') {

            if (array_key_exists('value', $param)) {
                $new_elment = array(__('Please select', 'wp_deeds') . ' ' . strtolower(sh_set($param, 'heading')) => 0);
                $param['value'] = array_merge($new_elment, $param['value']);
                $vc_arr['params'][$k]['value'] = $param['value'];
            }
        }
    }

    vc_map($vc_arr);
}

class WPBakeryShortCode_sh_accordian_block extends WPBakeryShortCodesContainer {
    
}

class WPBakeryShortCode_sh_accordian extends WPBakeryShortCode {
    
}

class WPBakeryShortCode_sh_tab_block extends WPBakeryShortCodesContainer {
    
}

class WPBakeryShortCode_sh_tabs extends WPBakeryShortCode {
    
}

function sh_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
    if ($tag == 'vc_row' || $tag == 'vc_row_inner') {
        $class_string = str_replace('vc_row-fluid', 'my_row-fluid', $class_string); // This will replace "vc_row-fluid" with "my_row-fluid"
    }
    if ($tag == 'vc_column' || $tag == 'vc_column_inner') {
        $class_string = preg_replace('/vc_col-sm-(\d{1,2})/', 'col-md-$1', $class_string); // This will replace "vc_col-sm-%" with "my_col-sm-%"
    }
    return $class_string;
}

// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'sh_custom_css_classes_for_vc_row_and_vc_column', 10, 2);

function vc_theme_vc_row($atts, $content = null) {
    extract(shortcode_atts(
                    array(
        'el_class' => '',
        'bg_image' => '',
        'bg_color' => '',
        'bg_image_repeat' => '',
        'font_color' => '',
        'posts_grid' => '',
        'margin_bottom' => '',
        'css' => '',
        //my custom params
        'miscellaneous' => '',
        'gap' => '',
        'grey_section' => '',
        'padding' => '',
        '_parallax_' => '',
        'parallax_clr' => '',
        'parallax_bg' => '',
        'show_title' => '',
        'col_title' => '',
        'col_sub_title' => '',
        'heading_style' => '',
                    ), $atts)
    );
    $atts['base'] = '';
    wp_enqueue_style('js_composer_front');
    wp_enqueue_script('wpb_composer_front_js');
    wp_enqueue_style('js_composer_custom_css');
    $vc_row = new WPBakeryShortCode_VC_Row($atts);
    $el_class = $vc_row->getExtraClass($el_class);
    $css_class = $el_class;
    if ($css)
        $css_class .= vc_shortcode_custom_css_class($css, ' ') . ' ';
    $style = ''; //$vc_row->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

    $my_class = '';
    if ($miscellaneous == 'true') {
        if ($miscellaneous != 'false' && $gap != 'false') {
            $my_class .= $gap . ' ';
        }
        if ($miscellaneous != 'false' && $padding != 'false') {
            $my_class .= $padding . ' ';
        }
        if ($miscellaneous != 'false' && $grey_section != 'false') {
            $my_class .= $grey_section . ' ';
        }
    }
    if ($_parallax_ != 'false' && $parallax_clr != 'no-layer') {
        $my_class .= $parallax_clr . ' ';
    }
    $my_parallax = '';
    if ($_parallax_ == 'true') {
        if ($parallax_bg):
            $img = wp_get_attachment_image_src($parallax_bg, 'full');
        else:
            $img = array('0' => '');
        endif;
        $my_parallax .= '<div style="background:url(' . $img[0] . ');" class="parallax"></div>';
    }

    $title = '';
    if ($show_title != 'false' && !empty($col_title)):
        $cnv = explode(' ', $col_title, 2);
        if ($heading_style == 'heading_1') {
            $title .= '<div class="title"><span>' . $col_sub_title . '</span><h2>' . sh_set($cnv, '0') . '&nbsp;<span>' . sh_set($cnv, '1') . '</span></h2></div>';
        } else if ($heading_style == 'heading_2') {
            $title .= '<div class="title2"><span>' . $col_sub_title . '</span><h2>' . sh_set($cnv, '0') . '&nbsp;<span>' . sh_set($cnv, '1') . '</span></h2></div>';
        } else if ($heading_style == 'heading_3') {
            $title .= '<div class="title3"><h2>' . sh_set($cnv, '0') . '&nbsp;<span>' . sh_set($cnv, '1') . '</span></h2><p>' . $col_sub_title . '</p></div>';
        } else if ($heading_style == 'heading_4') {
            $title .= '<div class="title4"><h2>' . sh_set($cnv, '0') . '&nbsp;<span>' . sh_set($cnv, '1') . '</span></h2></div>';
        } else if ($heading_style == 'heading_5') {
            $title .= '<div class="title5"><h2><span>' . sh_set($cnv, '0') . '&nbsp;</span>' . sh_set($cnv, '1') . '</h2></div>';
        } else if ($heading_style == 'heading_6') {
            $title .= '<div class="title6"><h2><span>' . sh_set($cnv, '0') . '&nbsp;</span>' . sh_set($cnv, '1') . '</h2></div>';
        } else if ($heading_style == 'heading_7') {
            $title .= '<div class="title7"><h2><span>' . sh_set($cnv, '0') . '&nbsp;</span>' . sh_set($cnv, '1') . '<i>' . $col_sub_title . '</i></h2></div>';
        }
    endif;

    $output = '<section class="' . $css_class . '" ' . $style . ' ><div class="block ' . $my_class . '"> ';
    $output .= '<div class="container">';
    $output .= $my_parallax;
    $output .= '<div class="row">';
    $output .= $title;
    $output .= wpb_js_remove_wpautop($content);
    $output .= '</div></div></div></section>';

    return $output;
}

function vc_theme_vc_column($atts, $content = null) {
    extract(shortcode_atts(
                    array(
        'width' => '1/1',
        'el_class' => '',
        'show_title' => '',
        'col_title' => '',
        'col_sub_title' => '',
        'heading_style' => ''
                    ), $atts)
    );
    $width_col = wpb_translateColumnWidthToSpan($width);
    $width = str_replace('vc_col-sm-', 'col-md-', $width_col . ' column');
    $title = '';
    if ($show_title != 'false' && !empty($col_title)):
        $cnv = explode(' ', $col_title, 2);
        if ($heading_style == 'heading_1') {
            $title .= '<div class="title"><span>' . $col_sub_title . '</span><h2>' . sh_set($cnv, '0') . '&nbsp;<span>' . sh_set($cnv, '1') . '</span></h2></div>';
        } else if ($heading_style == 'heading_2') {
            $title .= '<div class="title2"><span>' . $col_sub_title . '</span><h2>' . sh_set($cnv, '0') . '&nbsp;<span>' . sh_set($cnv, '1') . '</span></h2></div>';
        } else if ($heading_style == 'heading_3') {
            $title .= '<div class="title3"><h2>' . sh_set($cnv, '0') . '&nbsp;<span>' . sh_set($cnv, '1') . '</span></h2><p>' . $col_sub_title . '</p></div>';
        } else if ($heading_style == 'heading_4') {
            $title .= '<div class="title4"><h2>' . sh_set($cnv, '0') . '&nbsp;<span>' . sh_set($cnv, '1') . '</span></h2></div>';
        } else if ($heading_style == 'heading_5') {
            $title .= '<div class="title5"><h2><span>' . sh_set($cnv, '0') . '&nbsp;</span>' . sh_set($cnv, '1') . '</h2></div>';
        } else if ($heading_style == 'heading_6') {
            $title .= '<div class="title6"><h2><span>' . sh_set($cnv, '0') . '&nbsp;</span>' . sh_set($cnv, '1') . '</h2></div>';
        } else if ($heading_style == 'heading_7') {
            $title .= '<div class="title7"><h2><span>' . sh_set($cnv, '0') . '&nbsp;</span>' . sh_set($cnv, '1') . '<i>' . $col_sub_title . '</i></h2></div>';
        }
    endif;

    $el_class = ($el_class) ? ' ' . $el_class : '';
    $output = '<div class="' . $width . ' ' . $el_class . '">';
    $output .= $title;
    $output .= do_shortcode($content);
    $output .= '</div>';

    return $output;
}

//start miscellaneous settings
$miscellaneous = array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Miscellaneous Settings", 'wp_deeds'),
    "param_name" => "miscellaneous",
    "value" => array(__('False', 'wp_deeds') => 'false', __('True', 'wp_deeds') => 'true'),
    "description" => __("Show miscellaneous settings for this section.", 'wp_deeds'),
    'group' => __('Miscellaneous', 'wp_deeds'),
    'weight' => 1,
);

$param = array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Remove Gape", 'wp_deeds'),
    "param_name" => "gap",
    "value" => array(__('False', 'wp_deeds') => 'false', __('True', 'wp_deeds') => 'remove-gap'),
    "description" => __("Remove the Gap from top of the Section.", 'wp_deeds'),
    'group' => __('Miscellaneous', 'wp_deeds'),
    'dependency' => array(
        'element' => 'miscellaneous',
        'value' => array('true')
    ),
);

$padding = array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("No Padding", 'wp_deeds'),
    "param_name" => "padding",
    "value" => array(__('False', 'wp_deeds') => 'false', __('True', 'wp_deeds') => 'no-padding'),
    "description" => __("Remove the Padding from top and bottom of the Section.", 'wp_deeds'),
    'group' => __('Miscellaneous', 'wp_deeds'),
    'dependency' => array(
        'element' => 'miscellaneous',
        'value' => array('true')
    ),
);

$grey_section = array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Gray Section", 'wp_deeds'),
    "param_name" => "grey_section",
    "value" => array('' => '', __('False', 'wp_deeds') => 'false', __('True', 'wp_deeds') => 'gray'),
    "description" => __("Make this section Gray.", 'wp_deeds'),
    'group' => __('Miscellaneous', 'wp_deeds'),
    'dependency' => array(
        'element' => 'miscellaneous',
        'value' => array('true')
    ),
);

// start parallax settings
$parallax = array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Parallax", 'wp_deeds'),
    "param_name" => "_parallax_",
    "value" => array('' => '', __('False', 'wp_deeds') => 'false', __('True', 'wp_deeds') => 'true'),
    "description" => __("Make this section as parallax.", 'wp_deeds'),
    'group' => __('Parallax', 'wp_deeds'),
    'weight' => 2,
);

$parallax_clr = array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Parallax Style", 'wp_deeds'),
    "param_name" => "parallax_clr",
    "value" => array(
        '' => '',
        __('No Layer', 'wp_deeds') => 'no-layer',
        __('Whitish', 'wp_deeds') => 'whitish',
        __('Coloured', 'wp_deeds') => 'coloured',
        __('Blackish', 'wp_deeds') => 'blackish'
    ),
    "description" => __("Chose Style for Parallax.", 'wp_deeds'),
    'group' => __('Parallax', 'wp_deeds'),
    'dependency' => array(
        'element' => '_parallax_',
        'value' => array('true')
    ),
);

$parallax_img = array(
    "type" => "attach_image",
    "class" => "",
    "heading" => __("Parallax Background", 'wp_deeds'),
    "param_name" => "parallax_bg",
    "description" => __("Make this section as parallax.", 'wp_deeds'),
    'group' => __('Parallax', 'wp_deeds'),
    'dependency' => array(
        'element' => '_parallax_',
        'value' => array('true')
    ),
);

// start title settings
$show_title = array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Show title", 'wp_deeds'),
    "param_name" => "show_title",
    "value" => array('' => '', __('False', 'wp_deeds') => 'false', __('True', 'wp_deeds') => 'true'),
    "description" => __("If Shwo title then slect true.", 'wp_deeds'),
    'group' => __('Title Settings', 'wp_deeds'),
);

$title = array(
    "type" => "textfield",
    "class" => "",
    "heading" => __("Enter the Title", 'wp_deeds'),
    "param_name" => "col_title",
    "description" => __("Enter the title of this section.", 'wp_deeds'),
    'group' => __('Title Settings', 'wp_deeds'),
    'dependency' => array(
        'element' => 'show_title',
        'value' => array('true')
    ),
);

$sub_title = array(
    "type" => "textfield",
    "class" => "",
    "heading" => __("Enter the Sub Title", 'wp_deeds'),
    "param_name" => "col_sub_title",
    "description" => __("Enter the sub title of this section.", 'wp_deeds'),
    'group' => __('Title Settings', 'wp_deeds'),
    'dependency' => array(
        'element' => 'show_title',
        'value' => array('true')
    ),
);
$heading = array(
    "type" => "dropdown",
    "class" => "",
    "heading" => __("Select the heading style", 'wp_deeds'),
    "param_name" => "heading_style",
    "value" => array(
        '' => '',
        __('Heading Style 1', 'wp_deeds') => 'heading_1',
        __('Heading Style 2', 'wp_deeds') => 'heading_2',
        __('Heading Style 3', 'wp_deeds') => 'heading_3',
        __('Heading Style 4', 'wp_deeds') => 'heading_4',
        __('Heading Style 5', 'wp_deeds') => 'heading_5',
        __('Heading Style 6', 'wp_deeds') => 'heading_6',
        __('Heading Style 7', 'wp_deeds') => 'heading_7'
    ),
    "description" => __("Select the heading style for this section.", 'wp_deeds'),
    'group' => __('Title Settings', 'wp_deeds'),
    'dependency' => array(
        'element' => 'show_title',
        'value' => array('true')
    ),
);

// add vd column params
vc_add_param('vc_column', $show_title);
vc_add_param('vc_column', $title);
vc_add_param('vc_column', $sub_title);
vc_add_param('vc_column', $heading);

// add vd row params
vc_add_param('vc_row', $show_title);
vc_add_param('vc_row', $title);
vc_add_param('vc_row', $sub_title);
vc_add_param('vc_row', $heading);

vc_add_param('vc_row', $miscellaneous);
vc_add_param('vc_row', $param);
vc_add_param('vc_row', $padding);
vc_add_param('vc_row', $grey_section);

vc_add_param('vc_row', $parallax);
vc_add_param('vc_row', $parallax_clr);
vc_add_param('vc_row', $parallax_img);

vc_remove_param("vc_row", "full_width");
vc_remove_param("vc_row", "parallax");
vc_remove_param("vc_row", "parallax_image");
vc_remove_param("vc_row", "el_id");
