function updatedInput(e) {
    const container = getAncestorElementByAttr(
        e.target,
        "updateInputContainer"
    );

    const resetBtn = container.querySelector("[reset]");

    if (e.target.value !== e.target.dataset.original) {
        resetBtn.classList.remove("hidden");
    } else {
        resetBtn.classList.add("hidden");
    }
}

function resetInputOriginalValue(e) {
    const container = getAncestorElementByAttr(
        e.target,
        "updateInputContainer"
    );

    const input = container.querySelector("input");

    input.value = input.dataset.original;
    e.target.classList.add("hidden");
}

/**
 *
 * @param {HTMLElement} currentElement
 * @param {string} attribute
 * @returns {HTMLElement}
 */
function getAncestorElementByAttr(currentElement, attribute) {
    let ancestorElement = currentElement;

    while (true) {
        if (ancestorElement.hasAttribute(attribute)) {
            return ancestorElement;
        }
        ancestorElement = ancestorElement.parentElement;
    }
}

window.updatedInput = updatedInput;
window.resetInputOriginalValue = resetInputOriginalValue;
window.getAncestorElementByAttr = getAncestorElementByAttr;
