;(function ($, undefined) {
    
    var subMenu = {

        /**
         * Init method
         */
        init: function () {

            $('.dropdown-submenu a.submenu').hover(function(e){

                /**
                 * Define variable
                 */
                var $this = $(this),
                    menu = $this.closest('.dropdown-menu'),
                    subList = $this.siblings('ul');

                /**
                 * Call method changeCondition
                 */
                subMenu.changeCondition(menu, subList);
                
            });
        },

        /**
         * Checks whether the element contains a class active
         *
         * @param elem
         * @returns {boolean}
         */
        checkActive: function (elem) {
            return elem.hasClass('active');
        },

        /**
         * Change display condition element
         *
         * @param menu
         * @param subList
         */
        changeCondition: function (menu, subList) {

            $.each(menu, function () {
                var list = $(this).find('.dropdown-menu');

                /**
                 * If elem display remove class active
                 */
                if (subMenu.checkActive(list)) {
                    list.removeClass('active');
                }
            });

            /**
             * if menu show remove class active, if not add class active
             */
            subList.toggleClass('active');
        }
    };

    /**
     * Init object subMenu
     */
    subMenu.init();

})(jQuery);