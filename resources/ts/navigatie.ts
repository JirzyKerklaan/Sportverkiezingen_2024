    // @ts-nocheck
    /**
     *  Checks scroll position and direction and makes changes
     *  to our page-header
     *
     *  @version v1.0.0
     *  @author Bob Vrijland <b.vrijland@esens.nl>
     */
    export class Navigation{
        constructor(){
            let oldScrollPos = 0;
            let header = document.querySelectorAll('.js-header')[0];

            window.addEventListener('scroll', throttle(onScrollEvent, 50));

            /**
             * Returns true if we are NOT at the top, so we can pin the nav
             * @returns {Boolean} Boolean
             */
            function notAtTop(){
                var currentScrollPos = window.pageYOffset;
                if (currentScrollPos > 10){
                    return true;
                } else {
                    return false;
                }
            }

            /**
             * Handles the scroll event
             * @param {*} event
             */
            function onScrollEvent(event){
                if (notAtTop()){
                    var currentScrollPos = window.pageYOffset;
                    if(oldScrollPos - currentScrollPos < 0){
                        header.classList.add('site-header--pinned');
                        document.body.classList.add('pinned-header');
                    } else if (oldScrollPos - currentScrollPos > 0){
                        header.classList.remove('site-header--pinned');
                        document.body.classList.remove('pinned-header');
                    }
                    oldScrollPos = currentScrollPos;
                }
            }

            /**
             * Throttles an eventlistener
             * @param {*} callback
             * @param {*} interval
             * @returns
             */
            function throttle(callback, interval) {
                let enableCall = true;

                return function(...args) {
                  if (!enableCall) return;

                  enableCall = false;
                  callback.apply(this, args);
                  setTimeout(() => enableCall = true, interval);
                }
              }

        };
    }
