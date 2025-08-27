/**
 * Custom Gutenberg Blocks
 * 
 * @package Demarchelier
 */

const { registerBlockType } = wp.blocks;
const { createElement } = wp.element;
const { InspectorControls, MediaUpload, RichText } = wp.blockEditor;
const { PanelBody, Button, TextControl, TextareaControl } = wp.components;
const { __ } = wp.i18n;

// Hero Section Block
registerBlockType('demarchelier/hero-section', {
    title: __('Hero Section', 'demarchelier'),
    description: __('A hero section with background images and content.', 'demarchelier'),
    category: 'demarchelier',
    icon: 'align-wide',
    supports: {
        align: ['full'],
    },
    attributes: {
        title: {
            type: 'string',
            default: 'Classic French Bistro'
        },
        subtitle: {
            type: 'string',
            default: 'Serving authentic French fare since 1978 — from Manhattan to Greenport Village'
        },
        backgroundImages: {
            type: 'array',
            default: []
        },
        buttonText: {
            type: 'string',
            default: 'Book a Table'
        },
        buttonUrl: {
            type: 'string',
            default: 'https://resy.com/cities/greenport-ny/venues/demarchelier-bistro'
        }
    },
    
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { title, subtitle, backgroundImages, buttonText, buttonUrl } = attributes;
        
        return createElement('div', { className: 'hero-section-block' },
            createElement('div', { className: 'hero-preview' },
                createElement('div', { className: 'hero-bg-preview' },
                    backgroundImages.map((image, index) => 
                        createElement('div', {
                            key: index,
                            className: `hero-bg ${index === 0 ? 'active' : ''}`,
                            style: { backgroundImage: `url(${image.url})` }
                        })
                    )
                ),
                createElement('div', { className: 'hero-content-preview' },
                    createElement(RichText, {
                        tagName: 'h1',
                        value: title,
                        onChange: (value) => setAttributes({ title: value }),
                        placeholder: __('Enter hero title...', 'demarchelier')
                    }),
                    createElement(RichText, {
                        tagName: 'p',
                        className: 'sub',
                        value: subtitle,
                        onChange: (value) => setAttributes({ subtitle: value }),
                        placeholder: __('Enter hero subtitle...', 'demarchelier')
                    }),
                    createElement('a', {
                        className: 'btn book',
                        href: buttonUrl,
                        target: '_blank',
                        rel: 'noopener'
                    }, buttonText)
                )
            ),
            createElement(InspectorControls, {},
                createElement(PanelBody, { title: __('Hero Settings', 'demarchelier') },
                    createElement(TextControl, {
                        label: __('Button Text', 'demarchelier'),
                        value: buttonText,
                        onChange: (value) => setAttributes({ buttonText: value })
                    }),
                    createElement(TextControl, {
                        label: __('Button URL', 'demarchelier'),
                        value: buttonUrl,
                        onChange: (value) => setAttributes({ buttonUrl: value })
                    }),
                    createElement(MediaUpload, {
                        onSelect: (images) => {
                            const urls = images.map(img => ({
                                id: img.id,
                                url: img.url,
                                alt: img.alt
                            }));
                            setAttributes({ backgroundImages: urls });
                        },
                        allowedTypes: ['image'],
                        multiple: true,
                        value: backgroundImages.map(img => img.id),
                        render: ({ open }) => 
                            createElement(Button, {
                                onClick: open,
                                isPrimary: true
                            }, __('Select Background Images', 'demarchelier'))
                    })
                )
            )
        );
    },
    
    save: function() {
        return null; // Use PHP render callback
    }
});

// About Section Block
registerBlockType('demarchelier/about-section', {
    title: __('About Section', 'demarchelier'),
    description: __('An about section with image and content.', 'demarchelier'),
    category: 'demarchelier',
    icon: 'info',
    attributes: {
        title: {
            type: 'string',
            default: 'About'
        },
        content: {
            type: 'string',
            default: 'Since 1978 we have served classic French bistro fare with a warm, family atmosphere.'
        },
        image: {
            type: 'object',
            default: {}
        },
        address: {
            type: 'string',
            default: '471 Main Street, Greenport NY'
        }
    },
    
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { title, content, image, address } = attributes;
        
        return createElement('div', { className: 'about-section-block' },
            createElement('div', { className: 'about-preview' },
                createElement('div', { className: 'about-image-preview' },
                    image.url ? 
                        createElement('img', { src: image.url, alt: image.alt }) :
                        createElement('div', { className: 'placeholder-image' }, __('Select Image', 'demarchelier'))
                ),
                createElement('div', { className: 'about-content-preview' },
                    createElement(RichText, {
                        tagName: 'h2',
                        className: 'outlined-heading',
                        value: title,
                        onChange: (value) => setAttributes({ title: value }),
                        placeholder: __('Enter section title...', 'demarchelier')
                    }),
                    createElement(RichText, {
                        tagName: 'div',
                        value: content,
                        onChange: (value) => setAttributes({ content: value }),
                        placeholder: __('Enter about content...', 'demarchelier')
                    }),
                    createElement('div', { className: 'divider' }),
                    createElement(RichText, {
                        tagName: 'p',
                        className: 'accent',
                        value: address,
                        onChange: (value) => setAttributes({ address: value }),
                        placeholder: __('Enter address...', 'demarchelier')
                    })
                )
            ),
            createElement(InspectorControls, {},
                createElement(PanelBody, { title: __('About Settings', 'demarchelier') },
                    createElement(MediaUpload, {
                        onSelect: (img) => setAttributes({ 
                            image: { id: img.id, url: img.url, alt: img.alt }
                        }),
                        allowedTypes: ['image'],
                        value: image.id,
                        render: ({ open }) => 
                            createElement(Button, {
                                onClick: open,
                                isPrimary: true
                            }, __('Select Image', 'demarchelier'))
                    })
                )
            )
        );
    },
    
    save: function() {
        return null; // Use PHP render callback
    }
});

// Menu Section Block
registerBlockType('demarchelier/menu-section', {
    title: __('Menu Section', 'demarchelier'),
    description: __('A menu highlights section.', 'demarchelier'),
    category: 'demarchelier',
    icon: 'food',
    attributes: {
        title: {
            type: 'string',
            default: 'Menu Highlights'
        },
        menuItems: {
            type: 'array',
            default: [
                'Duck Confit with gratin dauphinois',
                'Steak Frites with bordelaise',
                'Steak Tartare with pommes dauphine',
                'Chicken Paillard with mesclun salad',
                'Roasted Salmon with beurre blanc',
                'Calf Liver Bordelaise with mashed potatoes',
                'Onion Soup Gratinée',
                'Crème Brûlée'
            ]
        },
        buttonText: {
            type: 'string',
            default: 'Download full menu (PDF)'
        },
        buttonUrl: {
            type: 'string',
            default: '/menu.pdf'
        }
    },
    
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { title, menuItems, buttonText, buttonUrl } = attributes;
        
        const updateMenuItem = (index, value) => {
            const newItems = [...menuItems];
            newItems[index] = value;
            setAttributes({ menuItems: newItems });
        };
        
        const addMenuItem = () => {
            setAttributes({ menuItems: [...menuItems, ''] });
        };
        
        const removeMenuItem = (index) => {
            const newItems = menuItems.filter((_, i) => i !== index);
            setAttributes({ menuItems: newItems });
        };
        
        return createElement('div', { className: 'menu-section-block' },
            createElement('div', { className: 'menu-preview' },
                createElement(RichText, {
                    tagName: 'h2',
                    className: 'outlined-heading',
                    value: title,
                    onChange: (value) => setAttributes({ title: value }),
                    placeholder: __('Enter section title...', 'demarchelier')
                }),
                createElement('ul', { className: 'menu-items-preview' },
                    menuItems.map((item, index) => 
                        createElement('li', { key: index },
                            createElement('input', {
                                type: 'text',
                                value: item,
                                onChange: (e) => updateMenuItem(index, e.target.value),
                                placeholder: __('Enter menu item...', 'demarchelier')
                            }),
                            createElement(Button, {
                                isDestructive: true,
                                isSmall: true,
                                onClick: () => removeMenuItem(index)
                            }, __('Remove', 'demarchelier'))
                        )
                    )
                ),
                createElement(Button, {
                    isPrimary: true,
                    onClick: addMenuItem
                }, __('Add Menu Item', 'demarchelier')),
                createElement('a', {
                    className: 'btn',
                    href: buttonUrl
                }, buttonText)
            ),
            createElement(InspectorControls, {},
                createElement(PanelBody, { title: __('Menu Settings', 'demarchelier') },
                    createElement(TextControl, {
                        label: __('Button Text', 'demarchelier'),
                        value: buttonText,
                        onChange: (value) => setAttributes({ buttonText: value })
                    }),
                    createElement(TextControl, {
                        label: __('Button URL', 'demarchelier'),
                        value: buttonUrl,
                        onChange: (value) => setAttributes({ buttonUrl: value })
                    })
                )
            )
        );
    },
    
    save: function() {
        return null; // Use PHP render callback
    }
});

// Gallery Section Block
registerBlockType('demarchelier/gallery-section', {
    title: __('Gallery Section', 'demarchelier'),
    description: __('A gallery section with images and content.', 'demarchelier'),
    category: 'demarchelier',
    icon: 'format-gallery',
    attributes: {
        title: {
            type: 'string',
            default: 'Gallery'
        },
        description: {
            type: 'string',
            default: 'Explore artwork from our family collection and the late Eric Demarchelier.'
        },
        buttonText: {
            type: 'string',
            default: 'Visit gallery site'
        },
        buttonUrl: {
            type: 'string',
            default: 'https://www.ericdemarchelier.com/shop-art'
        },
        images: {
            type: 'array',
            default: []
        }
    },
    
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { title, description, buttonText, buttonUrl, images } = attributes;
        
        return createElement('div', { className: 'gallery-section-block' },
            createElement('div', { className: 'gallery-preview' },
                createElement('div', { className: 'gallery-content-preview' },
                    createElement(RichText, {
                        tagName: 'h2',
                        className: 'outlined-heading',
                        value: title,
                        onChange: (value) => setAttributes({ title: value }),
                        placeholder: __('Enter section title...', 'demarchelier')
                    }),
                    createElement(RichText, {
                        tagName: 'p',
                        value: description,
                        onChange: (value) => setAttributes({ description: value }),
                        placeholder: __('Enter description...', 'demarchelier')
                    }),
                    createElement('a', {
                        className: 'btn',
                        href: buttonUrl
                    }, buttonText)
                ),
                createElement('div', { className: 'gallery-images-preview' },
                    images.map((image, index) => 
                        createElement('img', {
                            key: index,
                            src: image.url,
                            alt: image.alt
                        })
                    )
                )
            ),
            createElement(InspectorControls, {},
                createElement(PanelBody, { title: __('Gallery Settings', 'demarchelier') },
                    createElement(TextControl, {
                        label: __('Button Text', 'demarchelier'),
                        value: buttonText,
                        onChange: (value) => setAttributes({ buttonText: value })
                    }),
                    createElement(TextControl, {
                        label: __('Button URL', 'demarchelier'),
                        value: buttonUrl,
                        onChange: (value) => setAttributes({ buttonUrl: value })
                    }),
                    createElement(MediaUpload, {
                        onSelect: (selectedImages) => {
                            const urls = selectedImages.map(img => ({
                                id: img.id,
                                url: img.url,
                                alt: img.alt
                            }));
                            setAttributes({ images: urls });
                        },
                        allowedTypes: ['image'],
                        multiple: true,
                        value: images.map(img => img.id),
                        render: ({ open }) => 
                            createElement(Button, {
                                onClick: open,
                                isPrimary: true
                            }, __('Select Gallery Images', 'demarchelier'))
                    })
                )
            )
        );
    },
    
    save: function() {
        return null; // Use PHP render callback
    }
});

// Contact Section Block
registerBlockType('demarchelier/contact-section', {
    title: __('Contact Section', 'demarchelier'),
    description: __('A contact form section.', 'demarchelier'),
    category: 'demarchelier',
    icon: 'email',
    attributes: {
        title: {
            type: 'string',
            default: 'Sign Up'
        },
        description: {
            type: 'string',
            default: 'Receive information about events, artwork, dinner specials, and everything Demarchelier.'
        },
        buttonText: {
            type: 'string',
            default: 'Send a message'
        }
    },
    
    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { title, description, buttonText } = attributes;
        
        return createElement('div', { className: 'contact-section-block' },
            createElement('div', { className: 'contact-preview' },
                createElement('div', { className: 'contact-content-preview' },
                    createElement(RichText, {
                        tagName: 'h2',
                        className: 'outlined-heading',
                        value: title,
                        onChange: (value) => setAttributes({ title: value }),
                        placeholder: __('Enter section title...', 'demarchelier')
                    }),
                    createElement(RichText, {
                        tagName: 'p',
                        value: description,
                        onChange: (value) => setAttributes({ description: value }),
                        placeholder: __('Enter description...', 'demarchelier')
                    })
                ),
                createElement('div', { className: 'contact-form-preview' },
                    createElement('div', { className: 'form-group' },
                        createElement('label', {}, __('Full name', 'demarchelier'), ' *'),
                        createElement('input', { type: 'text', placeholder: __('Enter full name...', 'demarchelier') })
                    ),
                    createElement('div', { className: 'form-group' },
                        createElement('label', {}, __('Email', 'demarchelier')),
                        createElement('input', { type: 'email', placeholder: __('Enter email...', 'demarchelier') })
                    ),
                    createElement('div', { className: 'form-group' },
                        createElement('label', {}, __('Subject', 'demarchelier')),
                        createElement('input', { type: 'text', placeholder: __('Enter subject...', 'demarchelier') })
                    ),
                    createElement('div', { className: 'form-group' },
                        createElement('label', {}, __('Comment', 'demarchelier')),
                        createElement('textarea', { placeholder: __('Enter comment...', 'demarchelier') })
                    ),
                    createElement('button', { className: 'btn book' }, buttonText)
                )
            ),
            createElement(InspectorControls, {},
                createElement(PanelBody, { title: __('Contact Settings', 'demarchelier') },
                    createElement(TextControl, {
                        label: __('Button Text', 'demarchelier'),
                        value: buttonText,
                        onChange: (value) => setAttributes({ buttonText: value })
                    })
                )
            )
        );
    },
    
    save: function() {
        return null; // Use PHP render callback
    }
}); 