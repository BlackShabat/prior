((blocks, i18n, element) => {
    const el = element.createElement;

    blocks.registerBlockType('prior/hello', {
        title: i18n.__('Prior hello world', 'prior'),
        category: 'layout',
        save: () => el(
            'p', {}, 'Hello World - frontend'
        ),
        edit: () => el(
            'p', {}, 'Hello World - backend'
        ),
        styles: [
            {
                name: 'full-width',
                label: i18n.__( 'Full width' ),
                isDefault: true
            }
        ]
    });
})(
    window.wp.blocks,
    window.wp.i18n,
    window.wp.element
);