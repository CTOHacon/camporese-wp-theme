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

    // === Relevant Content — 3-state select for blocks matching configured prefixes ===

    var RC_PREFIXES = (window.camporeseBlockExtensions && window.camporeseBlockExtensions.relevantContentPrefixes) || ['acf/'];
    var RC_GLOBALS = (window.camporeseBlockExtensions && window.camporeseBlockExtensions.relevantContentGlobals) || [];

    function matchesRelevantContentPrefix(blockName) {
        for (var i = 0; i < RC_PREFIXES.length; i++) {
            if (blockName.indexOf(RC_PREFIXES[i]) === 0) return true;
        }
        return false;
    }

    // 4. Add relevantContentStatus attribute to matching blocks
    addFilter(
        'blocks.registerBlockType',
        'camporese/relevant-content-attribute',
        function (settings, name) {
            if (!matchesRelevantContentPrefix(name)) {
                return settings;
            }

            return Object.assign({}, settings, {
                attributes: Object.assign({}, settings.attributes, {
                    relevantContentStatus: {
                        type: 'string',
                        default: '',
                    },
                }),
            });
        }
    );

    // 5. Add 3-state select control in inspector for matching blocks
    var withRelevantContentControl = createHigherOrderComponent(function (BlockEdit) {
        return function (props) {
            if (!matchesRelevantContentPrefix(props.name)) {
                return el(BlockEdit, props);
            }

            return el(
                Fragment,
                null,
                el(BlockEdit, props),
                el(
                    InspectorControls,
                    null,
                    el(
                        PanelBody,
                        { title: 'Relevant Content', initialOpen: false },
                        el(SelectControl, {
                            label: 'Status',
                            value: props.attributes.relevantContentStatus || '',
                            options: [
                                { value: '', label: 'Initial' },
                                { value: 'needs-content', label: 'Needs Content' },
                                { value: 'filled', label: 'Filled' },
                            ],
                            onChange: function (value) {
                                props.setAttributes({ relevantContentStatus: value });
                            },
                        })
                    )
                )
            );
        };
    }, 'withRelevantContentControl');

    addFilter(
        'editor.BlockEdit',
        'camporese/relevant-content-control',
        withRelevantContentControl
    );

    // 6. Add class to block wrapper in editor — resolves global defaults too
    var withRelevantContentEditorClass = createHigherOrderComponent(function (BlockListBlock) {
        return function (props) {
            var status = props.attributes.relevantContentStatus;
            var needsClass = false;

            if (status === 'needs-content') {
                needsClass = true;
            } else if (!status || status === '') {
                needsClass = RC_GLOBALS.indexOf(props.name) !== -1;
            }
            // 'filled' — needsClass stays false

            if (!needsClass) {
                return el(BlockListBlock, props);
            }

            var className = [props.className || '', '_needs-relevant-content'].filter(Boolean).join(' ');
            return el(BlockListBlock, Object.assign({}, props, { className: className }));
        };
    }, 'withRelevantContentEditorClass');

    addFilter(
        'editor.BlockListBlock',
        'camporese/relevant-content-editor',
        withRelevantContentEditorClass
    );
})(window.wp);
