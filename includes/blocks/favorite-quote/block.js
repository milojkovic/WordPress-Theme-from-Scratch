(function (blocks, element, components) {
    var el = element.createElement;
    var TextControl = components.TextControl;

    blocks.registerBlockType('custom/favorite-quote', {
        title: 'Favorite Movie Quote',
        icon: 'format-quote',
        category: 'common',
        attributes: {
            quote: {
                type: 'string',
                default: '',
            },
        },

        //function that renders a block in the editor
        edit: function (props) {
            return el(
                'div',
                {},
                el(TextControl, {
                    label: 'Favorite Quote',
                    value: props.attributes.quote,
                    onChange: function (newQuote) {
                        props.setAttributes({quote: newQuote});
                    },
                    placeholder: 'Enter your favorite movie quote',
                }),
                el(
                    'blockquote',
                    {},
                    props.attributes.quote || 'Your favorite quote will appear here...'
                )
            );
        },

        //Function for dynamic display on the front-end (server-side render)
        save: function () {
            return null; //Dynamic block, saving is done server-side
        },
    });
})(window.wp.blocks, window.wp.element, window.wp.components);
