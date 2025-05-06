jQuery(document).ready(function ($) {
    $('.customize-partial-edit-shortcut').on('click', function (e) {
        e.preventDefault();

        const sectionId = $(this).data('section');

        if (typeof parent.wp !== 'undefined' && typeof parent.wp.customize !== 'undefined') {
            parent.wp.customize.section(sectionId, function (section) {
                if (section) {
                    section.focus(); // Scroll to and open the section
                } else {
                    console.warn('Customizer section not found:', sectionId);
                }
            });
        } else {
            console.error('Customizer not available in parent window.');
        }
    });
});
