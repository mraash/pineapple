const ENTER_KEYS_CODE = 13;

export const addKeyboardBehavior = ({ inputSelector, checkmarkSelector }) => {
    const $input     = document.querySelector(inputSelector);
    const $checkmark = document.querySelector(checkmarkSelector);


    $input.setAttribute('tabindex', -1);

    if (!$checkmark.hasAttribute('tabindex')) {
        $checkmark.setAttribute('tabindex', 0);
    }


    $checkmark.addEventListener('keypress', (event) => {
        if (event.keyCode !== ENTER_KEYS_CODE) {
            return;
        }

        // $input.checked = !$input.checked will not call onchange and
        //   oninput listenres, so I used .click()
        $input.click();
    });
};
