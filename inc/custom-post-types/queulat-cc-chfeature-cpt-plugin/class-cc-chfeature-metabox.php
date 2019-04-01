<?php

use Queulat\Metabox;
use Queulat\Forms\Node_Factory;
use Queulat\Forms\Element\Input_Url;
use Queulat\Forms\Element\WP_Editor;
use Queulat\Forms\Element\Input_Text;
use Queulat\Forms\Element\Input_Checkbox;
use Queulat\Forms\Element\Select;
use Queulat\Forms\Element\WP_Media;


class Feature_Metabox extends Metabox
{
    public function __construct($id = '', $title = '', $post_type = '', array $args = array())
    {
        parent::__construct($id, $title, $post_type, $args);
    }
    public function get_fields(): array
    {
        return [
            Node_Factory::make(
                Input_Text::class,
                [
                    'name' => 'subtitle',
                    'label' => 'Subtitle',
                    'attributes' => [
                        'class'    => 'regular-text',
                    ]
                ]
            ),
            Node_Factory::make(
                WP_Editor::class,
                [
                    'name' => 'long_text',
                    'label' => 'Description',
                    'attributes' => [
                        'class'    => 'widefat',
                    ],
                    'properties' => [
                        'media_buttons'    => false,
                        'drag_drop_upload' => false,
                        'textarea_rows'    => 10,
					]
                ]
            ),
            Node_Factory::make(
                Input_Text::class,
                [
                    'name' => 'video_url',
                    'label' => 'Video Url',
                    'attributes' => [
                        'class'    => 'regular-text',
                        'type' => 'url'
                    ],
                    'properties' => [
                        'description' => 'Video url (Youtube or vimeo) to enable this feature you should select the related style option'
                    ]
                ]
            ),
            Node_Factory::make(
                Input_Text::class,
                [
                    'name' => 'button_text',
                    'label' => 'Button text',
                    'attributes' => [
                        'class'    => 'regular-text',
                    ]
                ]
            ),
            Node_Factory::make(
                Input_Text::class,
                [
                    'name' => 'button_url',
                    'label' => 'Button Url',
                    'attributes' => [
                        'class'    => 'regular-text',
                        'type' => 'url'
                    ]
                ]
            ),
            Node_Factory::make(
                Select::class,
                [
                    'name' => 'style',
                    'label' => 'Style / Layout',
                    'attributes' => [
                        'class' => 'widefat'
                    ],
                    'properties' => [
                        'description' => 'Style of featured element',
                    ],
                    'options' => array(
                        '1' => 'Featured Image as background',
                        '2' => '2 columns: Image -> text',
                        '3' => '2 columns: text -> image'
                    )
                ]
            ),
        ];
    }
    public function sanitize_data(array $data): array
    {
        $sanitized = [];
        foreach ($data as $key => $val) {
            switch ($key) {
                case 'subtitle':
                case 'button_text':
                    $sanitized[$key] = sanitize_text_field($val);
                    break;
                case 'long_text' :
                    $sanitized[$key] = wp_kses_post($val);
                break;
                case 'button_url':
                case 'video_url':
                    $sanitized[$key] = esc_url_raw($val);
                break;
                case 'style':
                    $sanitized[$key] = $val;
                break;
            }
        }
        return $sanitized;
    }
}

new Feature_Metabox('feature', 'Feature element data', 'cc_chfeature', ['context' => 'normal']);
