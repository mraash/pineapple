const $target    = document.querySelector('.ErrorModal');
const $textInput = $target.querySelector('.ErrorModal__text');

const classes = {
    visible: 'ErrorModal--visible',
    enabled: 'ErrorModal--enabled',
};

export const modal = {
    print(text) {
        $textInput.innerText = text;
        $target.classList.add(classes.enabled);
        $target.ontransitionend = null;

        // Wait for the styles of the .enabled class to be applied to
        //   the element.
        setTimeout(() => {
            $target.classList.add(classes.visible);
        }, 50);
    },

    hide() {
        $target.classList.remove(classes.visible);

        $target.ontransitionend = () => {
            $textInput.innerText = '';
            $target.classList.remove(classes.enabled);
        };
    },

    isActive() {
        return $target.classList.contains(classes.visible);
    },
};
