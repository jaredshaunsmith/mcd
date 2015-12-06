var jQuery = require('jquery');
var $ = require('jQuery');
var _ = require('Underscore');

var Menu = (function($, _) {
    'use strict';

    var def = function() {

        init.call(this);
    };

    var init = function() {
        setTimeout(function(self) {
            self.setup();
            self.bind();
        }, 1200, this);
        
    };

    def.prototype = {
        setup: function() {
             $('.menu-item a').each(function(i) {
                $(this).attr('data-top', $($(this).attr('href')).position().top + $(window).outerHeight());
            })
        },

        bind : function() {
            var self = this;

            $('.menu-item a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    self.scrollMe($(this).attr('data-top'));
                });
            });

            $('.scroller').on('scroll', function() {

            });
            this.sticks();
            
        },
        scrollMe : function(where) {
            $('.scroller').animate({'scrollTop' : where }, 300);
        },

        sticks : function() {
            var s = $('.scroller'),
                menuTop = $('.main-menu').offset().top,
                top = $(window).outerHeight(true) - menuTop,
                left = $('.product').offset().left,
                h = s.outerHeight(true),
                cEl = $('.product'),
                hitH = cEl.outerHeight(true),
                hitTop = cEl.offset().top,
                w, hitValue, e;

            $('.scroller').on('scroll', function() {
                w = s.scrollTop();
                e = $('.content').offset().top - menuTop;

                if(e <= 0) {
                    // console.log('start sticking');
                    $('.product').each(function() {
                        var o = $(this).offset().top - menuTop;
                        console.log(o);
                        if(o <= 0) {
                            $('.product-name', this).css({'position': 'fixed', 'top': menuTop, 'left': left, 'background': 'white', 'width' : $(this).outerWidth(true), 'padding': '2rem'});
                            $('.product-description', this).css('margin-top', $('.product-name', this).outerHeight());
                        } else {
                            $('.product-name', this).css({'position': 'relative', 'top': 'auto', 'left': 'auto', 'width':'auto','padding':'0px'});
                            $('.product-description', this).css('margin-top', 'auto');
                        }
                    })
                } else {
                    // console.log('stop sticking');
                    $('.product-name', $('.product').first()).css({'position': 'relative', 'top': 'auto', 'left': 'auto', 'width':'auto','padding':'0px'});
                    $('.product-description', $('.product').first()).css('margin-top', 'auto');
                }

                // console.log(w, e, top)

                // // character containers
                // if(w >= top) {
                //     console.log('stuck');
                // } else {
                //     console.log('unstuck');
                //     // $('.scroller').css({'padding-top' : '0px'});
                // }
            });
        }

    };

    return def;
})(jQuery, _);

module.exports = Menu;