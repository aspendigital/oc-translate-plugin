/*
 * Add a locale switcher to Static Page form
 */
+function ($) { "use strict";

    var MasterLocaleSwitcher = function(element, options) {
        var $el = $(element),
            $tab = $el.closest('.tab-pane'),
            $toolbar = $tab.find('div.form-buttons')

        // Ensure that repeated field loads won't result in duplicate elements
        if ($toolbar.data('hasSwitcher')) {
            return;
        }

        $el.on('click', 'a[data-master-locale-switch]', function() {
            $tab.find('[data-switch-locale="'+$(this).data('master-locale-switch')+'"]').click()
        });

        // Move to form toolbar
        $toolbar.data('hasSwitcher', true);
        $toolbar.append($el.show())
    }

    MasterLocaleSwitcher.DEFAULTS = {}

    var old = $.fn.masterLocaleSwitcher

    $.fn.masterLocaleSwitcher = function (option) {
        var args = Array.prototype.slice.call(arguments, 1), result
        this.each(function () {
            var $this   = $(this)
            var data    = $this.data('oc.masterlocaleswitcher')
            var options = $.extend({}, MasterLocaleSwitcher.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('oc.masterlocaleswitcher', (data = new MasterLocaleSwitcher(this, options)))
            if (typeof option == 'string') result = data[option].apply(data, args)
            if (typeof result != 'undefined') return false
        })

        return result ? result : this
    }

    $.fn.masterLocaleSwitcher.Constructor = MasterLocaleSwitcher

    $.fn.masterLocaleSwitcher.noConflict = function () {
        $.fn.masterLocaleSwitcher = old
        return this
    }

    $(document).render(function () {
        $('[data-control="master-locale-switcher"]').masterLocaleSwitcher()
    })

}(window.jQuery);