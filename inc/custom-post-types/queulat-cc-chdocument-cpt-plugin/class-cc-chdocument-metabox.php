<?php

use Queulat\Metabox;
use Queulat\Forms\Node_Factory;
use Queulat\Forms\Element\Input_Url;
use Queulat\Forms\Element\WP_Editor;
use Queulat\Forms\Element\Input_Text;
use Queulat\Forms\Element\WP_Media;


class Document_Metabox extends Metabox
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
                    'name' => 'name',
                    'label' => 'Document name',
                    'attributes' => [
                        'class'    => 'regular-text',
                        'required' => 'required'
                    ]
                ]
            ),
            Node_Factory::make(
                Input_Text::class,
                [
                    'name' => 'date',
                    'label' => 'Publication Date',
                    'attributes' => [
                        'class'    => 'regular-text',
                        'required' => 'required',
                        'type'     => 'date'
                    ]
                ]
            ),
            Node_Factory::make(
                Input_Text::class,
                [
                    'name' => 'author',
                    'label' => 'Document name',
                    'attributes' => [
                        'class'    => 'regular-text',
                        'required' => 'required'
                    ]
                ]
            ),
            Node_Factory::make(
                WP_Media::class,
                [
                    'name' => 'download',
                    'label' => 'Download file'
				]
			),

        ];
    }
    public function sanitize_data(array $data): array
    {
        $sanitized = [];
        foreach ($data as $key => $val) {
            switch ($key) {
                case 'name':
                case 'author':
                    $sanitized[$key] = sanitize_text_field($val);
                    break;
                case 'date':
                    $dtstart = DateTime::createFromFormat('Y-m-d', $val);
                    if ($dtstart instanceof \DateTime) {
                        $sanitized[$key] = $dtstart->format('Y-m-d');
                    }
                    break;
                case 'download':
                    $sanitized[$key ] = $val ;
                break;
                
            }
        }
        return $sanitized;
    }
}

new Document_Metabox('download', 'Document related data', 'cc_chdocument', ['context' => 'normal']);
