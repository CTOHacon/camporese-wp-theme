</main>
<?php
component_footer();
component_mobile_menu_modal();
component_contact_form_modal();
component_practice_areas_menu_modal();

?>
</body>
<?php

$footer_script = get_field('field_footer_script', 'option');
if ($footer_script) {
    echo $footer_script;
}

wp_footer();
