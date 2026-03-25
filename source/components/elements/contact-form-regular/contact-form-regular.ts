import Component from "~/library/scripts/Components/Component";
import FormState from "~/library/scripts/WpForm/FormState";
import FormField from "../../core/form-field/form-field";

export default class ContactFormRegular extends Component {
    static readonly componentName = "contact-form-regular";

    private action = 'regular_contact_regular_submit';

    public init(): void {
        const form = new FormState(this.el as HTMLFormElement, this.action, FormField.gatherFormFields(this.el as HTMLFormElement));
        form.initSubmitListener();

        const submitButton = this.el.querySelector<HTMLElement>('[type="submit"]');

        const updateSubmitButtonValidity = () => {
            const allValid = Array.from(form.fields.values()).every(field => field.isValid);
            submitButton?.classList.toggle('_valid', allValid);
        };

        form.fields.forEach(field => {
            field.on('isValidChange', updateSubmitButtonValidity);
        });

        updateSubmitButtonValidity();

        form.on('submitStart', () => {
            this.el.classList.add('_loading');
        });
        form.on('submitServerError', () => {
            alert('Error Occurred: ' + JSON.stringify(form.responce.errors.submit));
        });
        form.on('submitEnd', () => {
            this.el.classList.remove('_loading');
        });
    }
}
