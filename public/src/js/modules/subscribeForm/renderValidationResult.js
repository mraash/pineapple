import { modal } from '~modules/alert/errorModal';
import { inputBlock, termsCheckmark, submitButton } from './data/targets';


const form = {
    disallowSending() {
        inputBlock.target.classList.add(inputBlock.classes.canNotSend);
        submitButton.target.classList.add(submitButton.classes.disabled);
        submitButton.target.setAttribute('tabindex', -1);
    },

    allowSending() {
        inputBlock.target.classList.remove(inputBlock.classes.canNotSend);
        submitButton.target.classList.remove(submitButton.classes.disabled);
        submitButton.target.setAttribute('tabindex', 0);
    },
};

const email = {
    setAsInvalid() {
        inputBlock.target.classList.add(inputBlock.classes.invalidEmail);
    },

    setAsValid() {
        inputBlock.target.classList.remove(inputBlock.classes.invalidEmail);
    },
};

const terms = {
    setAsInvalid() {
        termsCheckmark.target.classList.add(termsCheckmark.classes.invalid);
    },

    setAsValid() {
        termsCheckmark.target.classList.remove(termsCheckmark.classes.invalid);
    },
};


const renderInvalidResult = (subject, message) => {
    form.disallowSending();
    email.setAsValid();
    terms.setAsValid();

    if (subject === 'email') {
        email.setAsInvalid();
    }
    else if (subject === 'terms') {
        terms.setAsInvalid();
    }

    modal.print(message);
};

const renderValidResult = (needToHideError) => {
    form.allowSending();
    email.setAsValid();
    terms.setAsValid();

    if (needToHideError) {
        modal.hide();
    }
};

export const render = {
    invalidResult: renderInvalidResult,
    validResult: renderValidResult,
};
