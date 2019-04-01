<?php

use Queulat\Metabox;
use Queulat\Forms\Node_Factory;
use Queulat\Forms\Element\Input_Url;
use Queulat\Forms\Element\WP_Editor;
use Queulat\Forms\Element\Input_Text;
use Queulat\Forms\Element\WP_Media;


class Team_Metabox extends Metabox
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
                    'name' => 'position',
                    'label' => 'Position',
                    'attributes' => [
                        'class'    => 'regular-text',
                    ]
                ]
            ),
            Node_Factory::make(
                Input_Text::class,
                [
                    'name' => 'email',
                    'label' => 'Email',
                    'attributes' => [
                        'class'    => 'regular-text',
                        'type'     => 'email'
                    ]
                ]
            )
        ];
    }
    public function sanitize_data(array $data): array
    {
        $sanitized = [];
        foreach ($data as $key => $val) {
            switch ($key) {
                case 'position':
                    $sanitized[$key] = sanitize_text_field($val);
                break;
                case 'email':
                    $sanitized[$key] = sanitize_email($val);
                    break;
            }
        }
        return $sanitized;
    }
}

new Team_Metabox('team', 'Member data', 'cc_chteam', ['context' => 'normal']);
