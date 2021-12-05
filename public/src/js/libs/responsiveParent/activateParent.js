export const activateParent = (options) => {
    const { childSelector, parentSelector, parentClasses } = options;

    const onHoverClass = parentClasses?.onChildHover;

    const $child  = document.querySelector(childSelector);
    const $parent = document.querySelector(parentSelector);


    if (onHoverClass) {
        $child.addEventListener('mouseover', () => {
            $parent.classList.add(onHoverClass);
        });

        $child.addEventListener('mouseout', () => {
            $parent.classList.remove(onHoverClass);
        });
    }
};
