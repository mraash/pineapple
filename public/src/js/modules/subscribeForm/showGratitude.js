const $tabsWrapp = document.querySelector('.Main__tabs');
const $form      = document.querySelector('.Main__Tab--form');
const $thanks    = document.querySelector('.Main__Tab--thanks');
const socials    = document.querySelectorAll('.Socials__Item');

const classes = {
    form: {
        hidden: 'Main__Tab--hiddenInRight',
        disabled: 'Main__Tab--disabled',
    },
    thanks: {
        hidden: 'Main__Tab--hiddenInLeft',
        disabled: 'Main__Tab--disabled',
    },
};


const formStyles     = window.getComputedStyle($form);
const formTransition = parseFloat(formStyles.transitionDuration) * 1000;

const SOCIALS_DELAY = formTransition * 0.5;
const THANKS_DELAY  = formTransition * 0.75;

let isOnceShown = false;


export const showGratitude = () => {
    if (isOnceShown) {
        return;
    }

    isOnceShown = true;

    $thanks.classList.remove(classes.thanks.disabled);

    $form.ontransitionend = (event) => {
        if (event.propertyName === 'opacity') {
            $form.ontransitionend = null;
            $form.classList.add(classes.form.disabled);
        }
    };

    const formHeight   = $form.offsetHeight;
    const thanksHeight = $thanks.offsetHeight;

    const socialsTopMargin = formHeight - thanksHeight;

    // .hidden will set position absolute
    $tabsWrapp.style.height = `${formHeight}px`;
    $form.classList.add(classes.form.hidden);


    setTimeout(() => {
        $thanks.classList.remove(classes.thanks.hidden);
    }, THANKS_DELAY);


    setTimeout(() => {
        $tabsWrapp.style.height = `${thanksHeight}px`;

        socials.forEach(item => {
            item.style.transition = 'none';
            item.style.marginTop = `${socialsTopMargin}px`;
        });

        // Wait for social media to get margin-top style
        setTimeout(() => {
            socials.forEach(item => {
                item.style.transition = '';
                item.style.marginTop = '';
            });
        }, 30);

        // Remove height style when all animations are complete
        setTimeout(() => {
            $tabsWrapp.style.height = '';
        }, 2000);
    }, SOCIALS_DELAY);
};
