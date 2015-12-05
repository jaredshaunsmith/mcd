var jQuery = require('jquery');
var $ = require('jQuery');
var _ = require('Underscore');

var Menu = (function($, _) {
    'use strict';

    var def = function() {

        init.call(this);
    };

    var init = function() {
        this.bind();
    };

    def.prototype = {
        bind : function() {
            var self = this;
            
        }
    };

    return def;
})(jQuery, _);

module.exports = Menu;