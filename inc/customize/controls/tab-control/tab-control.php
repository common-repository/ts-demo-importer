<?php

/** Control Tab */
class ts_demo_importer_Tab_Control extends WP_Customize_Control {

    public $type = 'ts-demo-importer-tab';
    public $buttons = '';

    public function __construct($manager, $id, $args = array()) {
        parent::__construct($manager, $id, $args);
    }

    public function enqueue(){

        wp_enqueue_script( 'tab-control-js', TS_DEMO_IMPOTER_URL . 'inc/customize/controls/tab-control/tab-control.js', array( 'jquery' ), TS_DEMO_IMPOTER, true );
        wp_enqueue_style( 'tab-control-css', TS_DEMO_IMPOTER_URL. 'inc/customize/controls/tab-control/tab-control.css', array(), TS_DEMO_IMPOTER );
    }



    public function to_json() {
        parent::to_json();
        $first = true;
        $formatted_buttons = array();
        $all_fields = array();
        foreach ($this->buttons as $button) {
            //$fields = array();
            $active = isset($button['active']) ? $button['active'] : false;
            if ($active && $first) {
                $first = false;
            } elseif ($active && !$first) {
                $active = false;
            }

            $formatted_buttons[] = array(
                'name' => $button['name'],
                'icon' => isset($button['icon']) ? $button['icon'] : '',
                'fields' => $button['fields'],
                'active' => $active,
            );
            $all_fields = array_merge($all_fields, $button['fields']);
        }
        $this->json['buttons'] = $formatted_buttons;
        $this->json['fields'] = $all_fields;
    }

    public function content_template() {
        ?>
        <div class="bmp-customizer-tab-wrap">
            <# if ( data.buttons ) { #>
            <div class="bmp-customizer-tabs">
                <# for (tab in data.buttons) { #>
                <a href="#" class="bmp-customizer-tab <# if ( data.buttons[tab].active ) { #> active <# } #>" data-tab="{{ tab }}">
                    <# if ( data.buttons[tab].icon ) { #>
                    <span class="{{ data.buttons[tab].icon }}"></span>
                    <# } #>
                    {{ data.buttons[tab].name }}
                </a>
                <# } #>
            </div>
            <# } #>
        </div>
        <?php
    }

}
