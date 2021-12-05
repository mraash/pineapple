export const inputBlock = {
    target: document.querySelector('.formTab-InputBlock'),
    classes: {
        invalidEmail: 'formTab-InputBlock--hasInvalidEmail',
        canNotSend: 'formTab-InputBlock--canNotSend',
    },
};

export const emailInput = {
    target: document.querySelector('#subscriber-email'),
};

export const termsCheckbox = {
    target: document.querySelector('#subscriber-terms-condition'),
};

export const termsCheckmark = {
    target: document.querySelector('.Checkbox__checkmark'),
    classes: {
        invalid: 'Checkbox__checkmark--error',
    },
};

export const submitButton = {
    target: document.querySelector('#submit-subscription'),
    classes: {
        disabled: 'formTab-InputBlock__submit--disabled',
    },
};
