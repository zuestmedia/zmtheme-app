<?php

namespace ZMT\Theme;

use ZMT\Theme\Namespaces;

class ThemeJSON {

  function __construct(){

    $this->addToThemeJSON();
    $this->addCSStoHead();

  }

  public function ThemeJSON( $theme_json ){

    $static_theme_json = $theme_json->get_data();

    global $zmtheme;

    if (isset($zmtheme['default_components']->globals->colors->args)){

      $cssvars_colors = $zmtheme['default_components']->globals->colors->args;

      //var_dump($cssvars_colors);

      $palette = array( /* New palette */

        array(
          'name'  => 'Default Color',
          'slug'  => 'default',
          'color' => 'var(--color_background_default, '.$cssvars_colors['color_background_default'].')',
        ),
        array(
          'name'  => 'Default Gradient Color',
          'slug'  => 'default-gradient',
          'color' => 'var(--color_background_gradient_default, '.$cssvars_colors['color_background_gradient_default'].')',
        ),

        array(
          'name'  => 'Muted Color',
          'slug'  => 'muted',
          'color' => 'var(--color_background_muted, '.$cssvars_colors['color_background_muted'].')',
        ),
        array(
          'name'  => 'Muted Gradient Color',
          'slug'  => 'muted-gradient',
          'color' => 'var(--color_background_gradient_muted, '.$cssvars_colors['color_background_gradient_muted'].')',
        ),

        array(
          'name'  => 'Primary Color',
          'slug'  => 'primary',
          'color' => 'var(--color_background_primary, '.$cssvars_colors['color_background_primary'].')',
        ),
        array(
          'name'  => 'Primary Gradient Color',
          'slug'  => 'primary-gradient',
          'color' => 'var(--color_background_gradient_primary, '.$cssvars_colors['color_background_gradient_primary'].')',
        ),

        array(
          'name'  => 'Secondary Color',
          'slug'  => 'secondary',
          'color' => 'var(--color_background_secondary, '.$cssvars_colors['color_background_secondary'].')',
        ),
        array(
          'name'  => 'Secondary Gradient Color',
          'slug'  => 'secondary-gradient',
          'color' => 'var(--color_background_gradient_secondary, '.$cssvars_colors['color_background_gradient_secondary'].')',
        ),

        array(
          'name'  => 'Emphasis Text Color',
          'slug'  => 'emphasis-text',
          'color' => 'var(--color_text_emphasis, '.$cssvars_colors['color_text_emphasis'].')',
        ),
        array(
          'name'  => 'Default Text Color',
          'slug'  => 'default-text',
          'color' => 'var(--color_text_default, '.$cssvars_colors['color_text_default'].')',
        ),
        array(
          'name'  => 'Muted Text Color',
          'slug'  => 'muted-text',
          'color' => 'var(--color_text_muted, '.$cssvars_colors['color_text_muted'].')',
        ),
        array(
          'name'  => 'Inverse Text Color',
          'slug'  => 'inverse-text',
          'color' => 'rgba( var(--color_text_inverse, '.\ZMT\Theme\Helpers::convertHEXtoRGBA($cssvars_colors['color_text_inverse']).'), 1 )',
        ),//SPECIALCASE RGBA!!!

        array(
          'name'  => 'Success Color',
          'slug'  => 'success',
          'color' => 'var(--color_background_success, '.$cssvars_colors['color_background_success'].')',
        ),
        array(
          'name'  => 'Warning Color',
          'slug'  => 'warning',
          'color' => 'var(--color_background_warning, '.$cssvars_colors['color_background_warning'].')',
        ),
        array(
          'name'  => 'Danger Color',
          'slug'  => 'danger',
          'color' => 'var(--color_background_danger, '.$cssvars_colors['color_background_danger'].')',
        ),

        array(
          'name'  => 'Border Color',
          'slug'  => 'border',
          'color' => 'var(--color_border, '.$cssvars_colors['color_border'].')',
        ),

      );

      $static_theme_json['settings']['color']['palette']['theme'] = $palette;

      $gradients = array( /* New gradients */

        array(
          'name'  => 'Default Gradient',
          'slug'  => 'gradient_default',
          'gradient' => 'linear-gradient(var(--color_background_gradient_deg_default, '.$cssvars_colors['color_background_gradient_deg_default'].'),var(--color_background_default, '.$cssvars_colors['color_background_default'].') var(--color_background_gradient_colstop_default, '.$cssvars_colors['color_background_gradient_colstop_default'].'),var(--color_background_gradient_default, '.$cssvars_colors['color_background_gradient_default'].') var(--color_background_gradient_colstop2_default, '.$cssvars_colors['color_background_gradient_colstop2_default'].'))',
        ),

        array(
          'name'  => 'Muted Gradient',
          'slug'  => 'gradient_muted',
          'gradient' => 'linear-gradient(var(--color_background_gradient_deg_muted, '.$cssvars_colors['color_background_gradient_deg_muted'].'),var(--color_background_muted, '.$cssvars_colors['color_background_muted'].') var(--color_background_gradient_colstop_muted, '.$cssvars_colors['color_background_gradient_colstop_muted'].'),var(--color_background_gradient_muted, '.$cssvars_colors['color_background_gradient_muted'].') var(--color_background_gradient_colstop2_muted, '.$cssvars_colors['color_background_gradient_colstop2_muted'].'))',
        ),

        array(
          'name'  => 'Primary Gradient',
          'slug'  => 'gradient_primary',
          'gradient' => 'linear-gradient(var(--color_background_gradient_deg_primary, '.$cssvars_colors['color_background_gradient_deg_primary'].'),var(--color_background_primary, '.$cssvars_colors['color_background_primary'].') var(--color_background_gradient_colstop_primary, '.$cssvars_colors['color_background_gradient_colstop_primary'].'),var(--color_background_gradient_primary, '.$cssvars_colors['color_background_gradient_primary'].') var(--color_background_gradient_colstop2_primary, '.$cssvars_colors['color_background_gradient_colstop2_primary'].'))',
        ),

        array(
          'name'  => 'Secondary Gradient',
          'slug'  => 'gradient_secondary',
          'gradient' => 'linear-gradient(var(--color_background_gradient_deg_secondary, '.$cssvars_colors['color_background_gradient_deg_secondary'].'),var(--color_background_secondary, '.$cssvars_colors['color_background_secondary'].') var(--color_background_gradient_colstop_secondary, '.$cssvars_colors['color_background_gradient_colstop_secondary'].'),var(--color_background_gradient_secondary, '.$cssvars_colors['color_background_gradient_secondary'].') var(--color_background_gradient_colstop2_secondary, '.$cssvars_colors['color_background_gradient_colstop2_secondary'].'))',
        ),


      );

      $static_theme_json['settings']['color']['gradients']['theme'] = $gradients;

    }

    //var_dump($static_theme_json);

    return $theme_json->update_with( $static_theme_json );

  }

  public function CSStoHead(){

    global $zmtheme;

    $css = NULL;

    if (isset($zmtheme['default_components']->globals->colors->args)){

      $cssvars_colors = $zmtheme['default_components']->globals->colors->args;

        $css = '<style>

          .uk-section-default.zmgradient,
          .uk-tile-default.zmgradient,
          .uk-background-default.zmgradient {
            background: linear-gradient(
              var(--color_background_gradient_deg_default, '.esc_attr( $cssvars_colors['color_background_gradient_deg_default'] ).'),
              var(--color_background_default, '.esc_attr( $cssvars_colors['color_background_default'] ).')
              var(--color_background_gradient_colstop_default, '.esc_attr( $cssvars_colors['color_background_gradient_colstop_default'] ).'),
              var(--color_background_gradient_default, '.esc_attr( $cssvars_colors['color_background_gradient_default'] ).')
              var(--color_background_gradient_colstop2_default, '.esc_attr( $cssvars_colors['color_background_gradient_colstop2_default'] ).')
            );
          }
          .uk-section-primary.zmgradient,
          .uk-card-primary.zmgradient,
          .uk-button-primary.zmgradient,
          .uk-tile-primary.zmgradient,
          .uk-background-primary.zmgradient{
            background: linear-gradient(
              var(--color_background_gradient_deg_muted, '.esc_attr( $cssvars_colors['color_background_gradient_deg_muted'] ).'),
              var(--color_background_muted, '.esc_attr( $cssvars_colors['color_background_muted'] ).')
              var(--color_background_gradient_colstop_muted, '.esc_attr( $cssvars_colors['color_background_gradient_colstop_muted'] ).'),
              var(--color_background_gradient_muted, '.esc_attr( $cssvars_colors['color_background_gradient_muted'] ).')
              var(--color_background_gradient_colstop2_muted, '.esc_attr( $cssvars_colors['color_background_gradient_colstop2_muted'] ).')
            );
          }
          .uk-section-secondary.zmgradient,
          .uk-card-secondary.zmgradient,
          .uk-button-secondary.zmgradient,
          .uk-tile-secondary.zmgradient,
          .uk-background-secondary.zmgradient{
            background: linear-gradient(
              var(--color_background_gradient_deg_primary, '.esc_attr( $cssvars_colors['color_background_gradient_deg_primary'] ).'),
              var(--color_background_primary, '.esc_attr( $cssvars_colors['color_background_primary'] ).')
              var(--color_background_gradient_colstop_primary, '.esc_attr( $cssvars_colors['color_background_gradient_colstop_primary'] ).'),
              var(--color_background_gradient_primary, '.esc_attr( $cssvars_colors['color_background_gradient_primary'] ).')
              var(--color_background_gradient_colstop2_primary, '.esc_attr( $cssvars_colors['color_background_gradient_colstop2_primary'] ).')
            );
          }
          .uk-section-muted.zmgradient,
          .uk-card-default.zmgradient,
          .uk-button-default.zmgradient,
          .uk-tile-muted.zmgradient,
          .uk-background-muted.zmgradient{
            background: linear-gradient(
              var(--color_background_gradient_deg_secondary, '.esc_attr( $cssvars_colors['color_background_gradient_deg_secondary'] ).'),
              var(--color_background_secondary, '.esc_attr( $cssvars_colors['color_background_secondary'] ).')
              var(--color_background_gradient_colstop_secondary, '.esc_attr( $cssvars_colors['color_background_gradient_colstop_secondary'] ).'),
              var(--color_background_gradient_secondary, '.esc_attr( $cssvars_colors['color_background_gradient_secondary'] ).')
              var(--color_background_gradient_colstop2_secondary, '.esc_attr( $cssvars_colors['color_background_gradient_colstop2_secondary'] ).')
            );
          }

        </style>';

    }

    echo $css;

  }

  public function addCSStoHead(){

    add_action('wp_head', array( $this, 'CSStoHead' ));//to add in frontend
    add_action('admin_head', array( $this, 'CSStoHead' ));//to add in gutenberg

  }

  public function addToThemeJSON(){

    add_filter( 'wp_theme_json_data_theme', array($this, 'ThemeJSON') );

  }

}
