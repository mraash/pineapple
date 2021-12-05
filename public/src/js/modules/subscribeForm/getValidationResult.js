import { messages } from './data/errorMessages';

export const getValidationResult = (emailValue, termsValue) => {
    if (isEmailEmpty(emailValue)) {
        return buildValidationObject(false, 'email', messages.empty);
    }

    if (!isEmailValid(emailValue)) {
        return buildValidationObject(false, 'email', messages.invalid);
    }

    if (isEmailFromColombia(emailValue)) {
        return buildValidationObject(false, 'email', messages.colombia);
    }

    if (!isTermsChecked(termsValue)) {
        return buildValidationObject(false, 'terms', messages.unchecked);
    }

    return buildValidationObject(true);
};


function buildValidationObject(isValid, subject = false, message = false) {
    return {
        isValid,
        err: {
            message,
            subject,
        },
    };
}


function isEmailEmpty(value) {
    return value.trim() === '';
    // return false;
}

function isEmailValid(value) {
    return value.match(/^[^@]{2,}@[^@]{2,}\.[^@]{2,5}$/);
    // return value.match(/^.{3,}$/);
    // return true;
}

function isEmailFromColombia(value) {
    return value.match(/\.co$/);
    // return false;
}

function isTermsChecked(value) {
    return value;
    // return true;
}
