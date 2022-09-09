<?php

namespace ZMT\Theme\DefaultConfig;

class configCssVars extends BuildComponent {

  public $type = 'CssVars';

  function __construct( $key ){

  /**
    * loads only the specific arguments in child config files
    */
    if($key){
      if(method_exists($this, $key)){
        $this->$key();
      }
    }

  }

  /**
    * Here no default function is available, because the modules
    * need no overwritable template
    * ----
    * These colors are used to define gutenberg colors
    * need to be the same as static color vars in uikit-css in assets/css.
    * and in configCssVars
    * and in theme.json
    */
    protected function colors() {

      $this->args['presets'] = 'default';

      $this->args['color_background_default'] = '#fff';
      $this->args['color_background_gradient_default'] = '#fff';
      $this->args['color_background_gradient_deg_default'] = '0deg';
      $this->args['color_background_gradient_colstop_default'] = '0%';
      $this->args['color_background_gradient_colstop2_default'] = '0%';

      $this->args['color_background_muted'] = '#f8f8f8';
      $this->args['color_background_gradient_muted'] = '#f3f3f3';
      $this->args['color_background_gradient_deg_muted'] = '0deg';
      $this->args['color_background_gradient_colstop_muted'] = '0%';
      $this->args['color_background_gradient_colstop2_muted'] = '0%';

      $this->args['color_background_primary'] = '#075c97';
      $this->args['color_background_gradient_primary'] = '#2b77b4';
      $this->args['color_background_gradient_deg_primary'] = '0deg';
      $this->args['color_background_gradient_colstop_primary'] = '0%';
      $this->args['color_background_gradient_colstop2_primary'] = '0%';

      $this->args['color_background_secondary'] = '#253946';
      $this->args['color_background_gradient_secondary'] = '#314C5E';
      $this->args['color_background_gradient_deg_secondary'] = '0deg';
      $this->args['color_background_gradient_colstop_secondary'] = '0%';
      $this->args['color_background_gradient_colstop2_secondary'] = '0%';

      $this->args['background_skewy_default'] = '11deg';
      $this->args['background_skewy_primary'] = '5deg';
      $this->args['background_skewy_secondary'] = '18deg';

      $this->args['color_text_emphasis'] = '#333';
      $this->args['color_text_default'] = '#666';
      $this->args['color_text_muted'] = '#999';
      $this->args['color_text_inverse'] = '#ffffff';

      $this->args['color_text_link'] = '#1e87f0';
      $this->args['color_text_link_hover'] = '#0f6ecd';

      $this->args['color_border'] = '#e5e5e5';

      $this->args['logo_color'] = '#075c97';
      $this->args['logo_color_hover'] = '#075c97';
      $this->args['logo_color_inverse'] = '#ffffff';
      $this->args['logo_color_inverse_hover'] = '#ffffff';

      $this->args['navbar_dropdown_background'] = '#f8f8f8';

      $this->args['color_background_success'] = '#32d296';
      $this->args['color_background_warning'] = '#faa05a';
      $this->args['color_background_danger'] = '#f0506e';
    }
    protected function body() {
      $this->args['presets'] = 'default';
      $this->args['body_font_family'] = '-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji';
      $this->args['body_default_fontsize'] = '16px';
      $this->args['body_default_lineheight'] = '1.5';
      $this->args['body_font_weight'] = 'normal';
      $this->args['body_letter_spacing'] = 'normal';
      $this->args['text_lead_fontsize'] = '1.5rem';
      $this->args['text_lead_lineheight'] = '1.5';
      $this->args['text_large_fontsize'] = '1.5rem';
      $this->args['text_large_lineheight'] = '1.5';
      $this->args['article_meta_fontsize'] = '0.875rem';
      $this->args['article_meta_lineheight'] = '1.4';
      $this->args['text_meta_fontsize'] = '0.875rem';
      $this->args['text_meta_lineheight'] = '1.4';
      $this->args['text_small_fontsize'] = '0.875rem';
      $this->args['text_small_lineheight'] = '1.5';
    }
    protected function heading() {
      $this->args['presets'] = 'default';
      $this->args['heading_font_family'] = '"DejaVu Sans Mono", Menlo, Consolas, "Liberation Mono", Monaco, "Lucida Console", monospace';
      $this->args['heading_text_transform'] = 'none';
      $this->args['heading_font_weight'] = 'normal';
      $this->args['heading_letter_spacing'] = 'normal';
      $this->args['article_title_fontsize'] = '2.625rem';
      $this->args['article_title_lineheight'] = '1.2';
      $this->args['card_title_fontsize'] = '1.5rem';
      $this->args['card_title_lineheight'] = '1.4';
      $this->args['h1_fontsize'] = '2.625rem';
      $this->args['h1_lineheight'] = '1.2';
      $this->args['h2_fontsize'] = '2rem';
      $this->args['h2_lineheight'] = '1.3';
      $this->args['h3_fontsize'] = '1.5rem';
      $this->args['h3_lineheight'] = '1.4';
      $this->args['h4_fontsize'] = '1.25rem';
      $this->args['h4_lineheight'] = '1.4';
      $this->args['h5_fontsize'] = '1rem';
      $this->args['h5_lineheight'] = '1.4';
      $this->args['h6_fontsize'] = '0.875rem';
      $this->args['h6_lineheight'] = '1.4';
      $this->args['heading_2xlarge_fontsize'] = '11rem';
      $this->args['heading_2xlarge_lineheight'] = '1';
      $this->args['heading_xlarge_fontsize'] = '8rem';
      $this->args['heading_xlarge_lineheight'] = '1';
      $this->args['heading_large_fontsize'] = '6rem';
      $this->args['heading_large_lineheight'] = '1.1';
      $this->args['heading_medium_fontsize'] = '4rem';
      $this->args['heading_medium_lineheight'] = '1.1';
      $this->args['heading_small_fontsize'] = '3.25rem';
      $this->args['heading_small_lineheight'] = '1.2';
    }
    protected function logo() {
      $this->args['presets'] = 'default';
      $this->args['logo_fontfamily'] = '-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji';
      $this->args['logo_fontstyle'] = 'normal';
      $this->args['logo_fontsize'] = '16px';
      $this->args['logo_fontweight'] = 'normal';
      $this->args['logo_letterspacing'] = 'normal';
    }
    protected function navbar() {
      $this->args['presets'] = 'default';
      $this->args['navbar_fontfamily'] = '-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji';
      $this->args['navbar_fontstyle'] = 'normal';
      $this->args['navbar_fontsize'] = '16px';
      $this->args['navbar_fontweight'] = 'normal';
      $this->args['navbar_letterspacing'] = 'normal';
      $this->args['navbar_height'] = '80px';
      $this->args['navbar_padding'] = '15px';
    }

}
