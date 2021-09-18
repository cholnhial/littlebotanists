/***
 *  An idea from https://www.charistheo.io/blog/2021/02/restart-a-css-animation-with-javascript/
 *
 *
 * @param element
 */
function restartAnimation(element, animateClasses) {
    $(element).removeClass(animateClasses);
// trigger a DOM reflow
    $(element).width();
    $(element).addClass(animateClasses);
}