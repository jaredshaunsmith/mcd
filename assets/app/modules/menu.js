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
            });

             $('.product').each(function() {

             })
        },

        bind : function() {
            var self = this;

            $('.menu-item a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    self.scrollMe($(this).attr('data-top'));
                    setTimeout(function(context) {
                        self.setToActive($(context).parent());
                    }, 350, this);
                });
            });

            $('.scroller').on('scroll', function() {

            });
            this.sticks();

            $('.menu-toggle').on('click', function() {
                self.toggle();
            });

            if(mcd.isMobile) {
                $('.menu-item a').each(function() {
                    $(this).on('click', function() {
                        self.toggle();
                    });
                });
            }

            mcd.intercom.listen('mobile', function() {
                 $('.menu-item a').each(function() {
                    $(this).on('click', function() {
                        self.toggle();
                    });
                });
            })
            
        },
        scrollMe : function(where) {
            // if(!mcd.isMobile) {
                $('.scroller').animate({'scrollTop' : where }, 300);
            // } else {
            //     $('.scroller').animate({'scrollTop' : where - ($(window).outerHeight() - $('.scroller').offset().top)}, 300);
            // }
        },

        sticks : function() {
            var self = this;
            var s = $('.scroller'),
                menuTop = $('.main-menu').offset().top,
                oH = s.outerHeight(true) - menuTop,
                top = $(window).outerHeight(true) - menuTop,
                left = $('.product').offset().left,
                length = $('.product').length,
                w, o, e, divider;

            if(mcd.isMobile) {
                menuTop = s.offset().top - 2;
            }

            $('.scroller').on('scroll', function() {
                w = s.scrollTop();
                e = $('.content').offset().top - menuTop;
                divider = e / length;

                if(e <= 0) {
                    $('.product').each(function() {
                        var o = $(this).offset().top - menuTop;
                        var menuItem = $('a[href="#' + $(this).attr('id') + '"]').parent();
                        if(o <= 0) {

                            $('.product-name', this).addClass('is-fixed').css({'position': 'fixed', 'top': menuTop, 'left': left, 'background': 'white', 'width' : ($(this).outerWidth(true)), 'padding': '2rem'});
                            $('.product-description', this).css('margin-top', $('.product-name', this).outerHeight());
                            if(!menuItem.hasClass('is-active')) {
                                self.setToActive(menuItem);
                            }
                            $('.menu-list .after .inner').css('height', (Math.abs(o) / $(this).outerHeight(true)) * 100 + '%');
                        } else {
                            $('.product-name', this).removeClass('is-fixed').css({'position': 'relative', 'top': 'auto', 'left': 'auto', 'width':'auto','padding':'0px'});
                            $('.product-description', this).css('margin-top', 'auto');
                        }
                    })
                } else {
                    $('.menu-list .after').css({'opacity': 0, 'height': 0});
                    self.setToActive(false);
                    $('.product-name', $('.product').first()).removeClass('is-fixed').css({'position': 'relative', 'top': 'auto', 'left': 'auto', 'width':'auto','padding':'0px'});
                    $('.product-description', $('.product').first()).css('margin-top', 'auto');
                }
            });
        },

        setToActive : function(which) {
            $('.menu-item').each(function() {
                $(this).removeClass('is-active');

            });
            if(which != false) {
                which.addClass('is-active');
                $('.menu-list .after').css({'top': which.position().top, 'opacity': '1', 'height': which.height()});
            }
        },

        toggle: function() {
            $('.main-menu').toggleClass('is-active');
        }

    };

    return def;
})(jQuery, _);

module.exports = Menu;