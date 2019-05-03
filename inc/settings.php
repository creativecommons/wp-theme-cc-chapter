

<?php 
use Queulat\Forms\Element\Div;
use Queulat\Forms\Element\Form;
use Queulat\Forms\Node_Factory;
use Queulat\Forms\Element\WP_Nonce;
use Queulat\Forms\Element\WP_Media;
use Queulat\Forms\Element\Input_Url;
use Queulat\Forms\Element\WP_Editor;
use Queulat\Forms\Element\Input_Text;
use Queulat\Forms\Element\Input;
use Queulat\Forms\Element\Select;

class ThemeSettings
{
    private $flash;
    public $settings;
    public function __construct()
    {
        $this->init();
        $this->flash = array('updated' => __('Settings saved', 'cc-chapters'), 'error' => __('There was a problem saving your settings', 'cc-chapters'));
        $this->settings = get_option('site_theme_settings');
    }
    public function init()
    {
        add_action('admin_menu', array($this, 'addAdminMenu'));
        add_action('admin_init', array($this, 'saveSettings'));
    }
    public function addAdminMenu()
    {
        add_submenu_page('index.php', _x('Custom settings', 'site settings title', 'cc-chapters'), _x('Custom settings', 'site settings menu', 'cc-chapters'), 'edit_theme_options', 'cc-chapters-site-settings', array($this, 'adminMenuScreen'));
    }
    public function adminMenuScreen()
    {
        echo '<div class="wrap">';
        screen_icon('index');
        echo '<h2>' . _x('Custom Settings', 'site settings title', 'cc-chapters') . '</h2>';
        if (!empty($_GET['msg']) && isset($this->flash[$_GET['msg']])) :
            echo '<div class="updated">';
        echo '<p>' . $this->flash[$_GET['msg']] . '</p>';
        echo '</div>';
        endif;
        $data = get_option('site_theme_settings');
        echo '<h4>Front page settings</h4>';
        $form = Node_Factory::make(
                Form::class,
                [
                    'attributes' => [
                        'class' => 'form',
                        'id' => 'site-settings',
                        'method' => 'POST'
                    ],
                    'children' => [
                        Node_Factory::make(
                            WP_Editor::class,
                            [
                                'name' => 'footer-content',
                                'label' => 'Footer Content',
                                'value' => (!empty($data['footer-content'])) ? $data['footer-content'] : '',
                                'attributes' => [
                                    'class' => 'widefat'
                                ],
                                'properties' => [
                                    'description' => 'Write your footer content',
                                    'media_buttons' => true,
                                    'drag_drop_upload' => false,
                                    'textarea_rows' => 5
                                ]
                            ]
                        ),
                        Node_Factory::make(
                            Select::class,
                            [
                                'name' => 'sidebar-1-background',
                                'label' => 'Sidebar 1 background color',
                                'value' => (!empty($data['sidebar-1-background'])) ? $data['sidebar-1-background'] : '',
                                'attributes' => [
                                    'class' => 'widefat'
                                ],
                                'options' => array(
                                    ''          => 'White',
                                    'blue'      => 'Blue',
                                    'yellow'    => 'Yellow',
                                    'gray'      => 'Gray'
                                )
                            ]
                        ),
                        Node_Factory::make(
                            Select::class,
                            [
                                'name' => 'sidebar-2-background',
                                'label' => 'Sidebar 2 background color',
                                'value' => (!empty($data['sidebar-2-background'])) ? $data['sidebar-2-background'] : '',
                                'attributes' => [
                                    'class' => 'widefat'
                                ],
                                'options' => array(
                                    ''          => 'White',
                                    'blue'      => 'Blue',
                                    'yellow'    => 'Yellow',
                                    'gray'      => 'Gray'
                                )
                            ]
                        ),
                        Node_Factory::make(
                            Select::class,
                            [
                                'name' => 'sidebar-3-background',
                                'label' => 'Sidebar 3 background color',
                                'value' => (!empty($data['sidebar-3-background'])) ? $data['sidebar-3-background'] : '',
                                'attributes' => [
                                    'class' => 'widefat'
                                ],
                                'options' => array(
                                    ''          => 'White',
                                    'blue'      => 'Blue',
                                    'yellow'    => 'Yellow',
                                    'gray'      => 'Gray'
                                )
                            ]
                        ),
                        Node_Factory::make(
                            Select::class,
                            [
                                'name' => 'sidebar-4-background',
                                'label' => 'Sidebar 4 background color',
                                'value' => (!empty($data['sidebar-4-background'])) ? $data['sidebar-4-background'] : '',
                                'attributes' => [
                                    'class' => 'widefat'
                                ],
                                'options' => array(
                                    ''          => 'White',
                                    'blue'      => 'Blue',
                                    'yellow'    => 'Yellow',
                                    'gray'      => 'Gray'
                                )
                            ]
                        ),
                        Node_Factory::make(
                            Select::class,
                            [
                                'name' => 'sidebar-5-background',
                                'label' => 'Sidebar 5 background color',
                                'value' => (!empty($data['sidebar-5-background'])) ? $data['sidebar-5-background'] : '',
                                'attributes' => [
                                    'class' => 'widefat'
                                ],
                                'options' => array(
                                    ''          => 'White',
                                    'blue'      => 'Blue',
                                    'yellow'    => 'Yellow',
                                    'gray'      => 'Gray'
                                )
                            ]
                        ),
                        Node_Factory::make(
                            WP_Nonce::class,
                            [
                                'properties' => [
                                    'name' => '_site_settings_nonce',
                                    'action' => 'update_site_settings'
                                ]
                            ]
                        ),
                        Node_Factory::make(
                            Input::class,
                            [
                                'value' => 'Submit',
                                'attributes' => [
                                    'type' => 'submit',
                                    'class' => 'button button-primary button-large'
                                ],
                            ]
                        ),
                        Node_Factory::make(
                            Input::class,
                            [
                                'name' => 'action',
                                'value' => 'update_site_settings',
                                'attributes' => [
                                    'type' => 'hidden'
                                ],
                            ]
                        )
                    ]
                ]  
            );
            echo $form;
    }
    public function saveSettings()
    {
        // echo '<pre>'; print_r($_POST); echo '</pre>';
        // die();
        if (empty($_POST['action'])) return;
        if ($_POST['action'] !== 'update_site_settings') return;
        if (!wp_verify_nonce($_POST['_site_settings_nonce'], 'update_site_settings')) wp_die(_x("You are not supposed to do that", 'site settings error', 'cc-chapters'));
        if (!current_user_can('edit_theme_options')) wp_die(_x("You are not allowed to edit this options", 'site settings error', 'cc-chapters'));
        $fields = array(
            'footer-content',
            'sidebar-1-background',
            'sidebar-2-background',
            'sidebar-3-background',
            'sidebar-4-background',
            'sidebar-5-background',
        );
        $raw_post = stripslashes_deep($_POST);
        $data = array_intersect_key($raw_post, array_combine($fields, $fields));
        update_option('site_theme_settings', $data);
        wp_redirect(admin_url('admin.php?page=cc-chapters-site-settings&msg=updated', 303));
        exit;
    }
}
$_set = new ThemeSettings;

