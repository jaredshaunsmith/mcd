var $ = require('jQuery'),
    _ = require('Underscore');

var Intercom = require('./lib/intercom.js');
var Menu = require('./menu.js');


// base functions
base = (function($, _ , Intercom) {
    'use strict';

    var def = function(mcd) {
        var mcd = mcd;
        mcd.options = {};

        mcd.intercom = {};
        Intercom.installOn(mcd.intercom);

        // setup touch for mobile
        mcd.options.uAgent = navigator.userAgent;
        mcd.options.interaction = mcd.options.uAgent.match(/(iPad|iPhone|iPod)/g) ? 'touchstart' : 'click';

        window.$ = $;

        init.call(this);
    };

    var init = function() {
        this.checkDimensions();
        this.utils();  
        this.menu();
    };

    def.prototype = { 

        checkDimensions: function() {
            mcd.isDesktop = $(window).width() >= 968;
            mcd.isMobile = $(window).width() <= 967;
            
            if(mcd.isDesktop) {
                mcd.intercom.broadcast('desktop', this);
            }

            if(mcd.isMobile) {
                mcd.intercom.broadcast('mobile', this);
            } 
        },

        utils: function() {
            $(window).on('resize', _.bind(this.checkDimensions, this));

            // Target IE
            if (navigator.userAgent.indexOf('MSIE') >= 0 || navigator.userAgent.indexOf('Trident') >= 0) {
                document.getElementsByTagName("html")[0].className += ' ie';
            }

            // For use within normal web clients 
            var isiPad = navigator.userAgent.match(/iPad/i) != null;

            // For use within iPad developer UIWebView
            // Thanks to Andrew Hedges!
            var ua = navigator.userAgent;
            var isiPad = /iPad/i.test(ua) || /iPhone OS 3_1_2/i.test(ua) || /iPhone OS 3_2_2/i.test(ua);

            var isFirefox = typeof InstallTrigger !== 'undefined';


            if(Function('/*@cc_on return document.documentMode===10@*/')()){ 
                $('html').addClass('ie10');
            }

            if(window.location.hash === '#contact') {
                mcd.contact = true;
            }

            if(isiPad) {
                $('body').addClass('is-ipad');
            }

            if(isFirefox) {
                $('body').addClass('is-ff');
            }
            
        },

        menu: function() {
            new Menu();
        }

    };

    return def;

}).call(this, $, _, Intercom);

module.exports = base; 