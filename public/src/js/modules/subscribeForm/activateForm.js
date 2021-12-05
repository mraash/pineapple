import { api } from '~modules/api';
import { modal } from '~modules/alert/errorModal';

import { emailInput, termsCheckbox, submitButton } from './data/targets';

import { getValidationResult } from './getValidationResult';
import { render } from './renderValidationResult';
import { showGratitude } from './showGratitude';


export const activateForm = () => {
    submitButton.target.addEventListener('click', onSubmit);
};


let canSend = true;
let validatedIn;

function onSubmit(event) {
    event.preventDefault();

    if (!canSend) {
        return;
    }

    validatedIn = 'BUTTON';

    const isValid = validateForm();

    if (!isValid) {
        canSend = false;
        emailInput.target.addEventListener('input', onInput);
        termsCheckbox.target.addEventListener('change', onInput);

        return;
    }

    const emailValue = emailInput.target.value;
    const termsValue = termsCheckbox.target.checked;

    api.subscribers.add(emailValue, termsValue)
        .then(() => {
            if (modal.isActive()) {
                modal.hide();
            }

            showGratitude();
        })
        .catch((err) => {
            modal.print(
                'Ops!\n' +
                'An error occurred on the server\n' +
                '(details can be viewed in the console)'
            );

            console.log(err);
        });
}

function onInput() {
    validatedIn = 'INPUT';

    const isValid = validateForm();

    if (isValid) {
        canSend = true;
        emailInput.target.removeEventListener('input', onInput);
        termsCheckbox.target.removeEventListener('change', onInput);
    }
}


function validateForm() {
    const emailValue = emailInput.target.value;
    const termsValue = termsCheckbox.target.checked;

    const result = getValidationResult(emailValue, termsValue);

    if (!result.isValid) {
        render.invalidResult(result.err.subject, result.err.message);
    }
    else {
        render.validResult(validatedIn === 'INPUT');
    }

    return result.isValid;
}
