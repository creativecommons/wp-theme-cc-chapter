wp.domReady( () => {
	wp.blocks.unregisterBlockStyle( 'core/button', 'default' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );

    wp.blocks.registerBlockStyle( 'core/button', {
		name: 'squared',
		label: 'Squared',
		isDefault: true,
	});
    wp.blocks.registerBlockStyle( 'core/button', {
		name: 'arrow',
		label: 'Arrow',
		isDefault: false,
	});
} );