export class MouseFocus{
    constructor(){
        // Initially add the using mouse class, because most people do.
        document.documentElement.classList.add('using-mouse');
        // Let the document know when the mouse is being used
        document.body.addEventListener('mousedown', function () {
            document.documentElement.classList.add('using-mouse');
        });
        // Re-enable focus styling when Tab is pressed
        document.body.addEventListener('keydown', function (event) {
            if (event.keyCode === 9) {
                document.documentElement.classList.remove('using-mouse');
            }
        });
    }
}
