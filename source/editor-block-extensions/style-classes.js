(function (wp) {
    const { addFilter } = wp.hooks;
    const { createElement: el, Fragment } = wp.element;
    const { createHigherOrderComponent } = wp.compose;
    const { InspectorControls } = wp.blockEditor;
    const { PanelBody, ToggleControl, SelectControl } = wp.components;

    const TARGET_BLOCKS = ['core/paragraph', 'core/heading', 'core/separator'];

    // 1. Add custom attributes to paragraph and heading blocks
    addFilter(
        'blocks.registerBlockType',
        'camporese/custom-class-attributes',
        function (settings, name) {
            if (!TARGET_BLOCKS.includes(name)) {
                return settings;
            }

            return Object.assign({}, settings, {
                attributes: Object.assign({}, settings.attributes, {
                    hasAccentClass: {
                        type: 'boolean',
                        default: false,
                    },
                    hasOpacityClass: {
                        type: 'boolean',
                        default: false,
                    },
                    marginBottom: {
                        type: 'string',
                        default: '',
                    },
                }),
            });
        }
    );

    // 2. Add toggle controls in the block inspector sidebar
    var withCustomClassControls = createHigherOrderComponent(function (BlockEdit) {
        return function (props) {
            if (!TARGET_BLOCKS.includes(props.name)) {
                return el(BlockEdit, props);
            }

            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            return el(
                Fragment,
                null,
                el(BlockEdit, props),
                el(
                    InspectorControls,
                    null,
                    el(
                        PanelBody,
                        { title: 'Style Classes', initialOpen: true },
                        el(ToggleControl, {
                            label: 'Accent',
                            checked: !!attributes.hasAccentClass,
                            onChange: function (value) {
                                setAttributes({ hasAccentClass: value });
                            },
                        }),
                        el(ToggleControl, {
                            label: 'Opacity',
                            checked: !!attributes.hasOpacityClass,
                            onChange: function (value) {
                                setAttributes({ hasOpacityClass: value });
                            },
                        }),
                        el(SelectControl, {
                            label: 'Margin Bottom',
                            value: attributes.marginBottom || '',
                            options: (window.camporeseBlockExtensions && window.camporeseBlockExtensions.marginOptions) || [{ value: '', label: 'Initial' }],
                            onChange: function (value) {
                                setAttributes({ marginBottom: value });
                            },
                        })
                    )
                )
            );
        };
    }, 'withCustomClassControls');

    addFilter(
        'editor.BlockEdit',
        'camporese/custom-class-controls',
        withCustomClassControls
    );

    // 3. Add classes to the block wrapper in the editor preview
    var withCustomClassEditor = createHigherOrderComponent(function (BlockListBlock) {
        return function (props) {
            if (!TARGET_BLOCKS.includes(props.name)) {
                return el(BlockListBlock, props);
            }

            var classes = [];
            if (props.attributes.hasAccentClass) classes.push('_is-accent');
            if (props.attributes.hasOpacityClass) classes.push('_has-opacity');
            if (props.attributes.marginBottom) classes.push(props.attributes.marginBottom);

            if (classes.length) {
                var className = [props.className || '', classes.join(' ')].filter(Boolean).join(' ');
                return el(BlockListBlock, Object.assign({}, props, { className: className }));
            }

            return el(BlockListBlock, props);
        };
    }, 'withCustomClassEditor');

    addFilter(
        'editor.BlockListBlock',
        'camporese/custom-class-editor',
        withCustomClassEditor
    );

})(window.wp);
