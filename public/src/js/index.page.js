import { activateParent } from './libs/responsiveParent';
import { addKeyboardBehavior } from './libs/customCheckbox';
import { activateForm } from './modules/subscribeForm';


window.addEventListener('load', () => {
    activateParent({
        childSelector: '.formTab-InputBlock__submit',
        parentSelector: '.formTab-InputBlock',
        parentClasses: {
            onChildHover: 'formTab-InputBlock--hasSubmitHover',
        },
    });

    addKeyboardBehavior({
        inputSelector: '.Checkbox__input',
        checkmarkSelector: '.Checkbox__checkmark',
    });

    activateForm();
});
