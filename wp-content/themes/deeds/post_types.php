<?php

$options = array();


$options['cs_team'] = array(
								'labels' => array(__('Member', 'wp_deeds'), __('Member', 'wp_deeds')),
								'slug' => 'pastores',
								'label_args' => array('menu_name' => __('Team', 'wp_deeds')),
								'supports' => array( 'title', 'editor' , 'thumbnail'),
								'label' => __('Member', 'wp_deeds'),
								'args'=>array('menu_icon'=>'dashicons-businessman' , 'taxonomies'=>array('team_category'))
							);

$options['cs_sermons'] = array(
								'labels' => array(__('Sermon', 'wp_deeds'), __('Sermon', 'wp_deeds')),
								'slug' => 'palavra-apostolica',
								'label_args' => array('menu_name' => __('Sermons', 'wp_deeds')),
								'supports' => array( 'title' , 'editor' , 'thumbnail' ),
								'label' => __('Sermon', 'wp_deeds'),
								'args'=>array('menu_icon'=>'dashicons-megaphone' , 'taxonomies'=>array('team_category'))
							);
							
$options['cs_events'] = array(
								'labels' => array(__('Event', 'wp_deeds'), __('Event', 'wp_deeds')),
								'slug' => 'agenda',
								'label_args' => array('menu_name' => __('Event', 'wp_deeds')),
								'supports' => array( 'title' , 'editor' , 'thumbnail'),
								'label' => __('Event', 'wp_deeds'),
								'args'=>array('menu_icon'=>'dashicons-analytics' , 'taxonomies'=>array('events_category'))
							);
							
$options['cs_gallery'] = array(
								'labels' => array(__('Gallery', 'wp_deeds'), __('Gallery', 'wp_deeds')),
								'slug' => 'galeria',
								'label_args' => array('menu_name' => __('Gallery', 'wp_deeds')),
								'supports' => array( 'title' , 'thumbnail'),
								'label' => __('Gallery', 'wp_deeds'),
								'args'=>array('menu_icon'=>'dashicons-images-alt2' )
							);
$options['cs_church'] = array(
								'labels' => array(__('Church', 'wp_deeds'), __('Church', 'wp_deeds')),
								'slug' => 'igrejas-filhas',
								'label_args' => array('menu_name' => __('Church', 'wp_deeds')),
								'supports' => array( 'title' , 'editor' , 'thumbnail'),
								'label' => __('Church', 'wp_deeds'),
								'args'=>array('menu_icon'=>'dashicons-share-alt' , 'taxonomies'=>array('church_category'))
							);
$options['cs_ministry'] = array(
								'labels' => array(__('Ministry', 'wp_deeds'), __('Ministry', 'wp_deeds')),
								'slug' => 'ministerio',
								'label_args' => array('menu_name' => __('Ministry', 'wp_deeds')),
								'supports' => array( 'title' , 'editor' , 'thumbnail'),
								'label' => __('Ministry', 'wp_deeds'),
								'args'=>array('menu_icon'=>'dashicons-testimonial' , 'taxonomies'=>array('ministry_category'))
							);												
