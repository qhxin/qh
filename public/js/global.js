if (!Array.prototype.indexOf)
{
    Array.prototype.indexOf = function(elt /*, from*/)
    {
        var len = this.length >>> 0;
        var from = Number(arguments[1]) || 0;
        from = (from < 0)
            ? Math.ceil(from)
            : Math.floor(from);
        if (from < 0)
            from += len;
        for (; from < len; from++)
        {
            if (from in this &&
                this[from] === elt)
                return from;
        }
        return -1;
    };
}

// 改写jquery.ajax方法，增加mode属性 {abort,queue,sync}
(function($) {
    var ajax = $.ajax,
        pendingRequests = {},
        synced = [],
        syncedData = [],
        ajaxRunning = [];
    $.ajax = function(settings) {
        // create settings for compatibility with ajaxSetup
        settings = jQuery.extend(settings, jQuery.extend({}, jQuery.ajaxSettings, settings));
        var port = settings.port||settings.url;
        switch (settings.mode) {
            case "abort":
                if (pendingRequests[port]) {
                    pendingRequests[port].abort();
                }
                return pendingRequests[port] = ajax.apply(this, arguments);
            case "queue":
                var _old = settings.complete;
                settings.complete = function() {
                    if (_old) {
                        _old.apply(this, arguments);
                    }
                    if (jQuery([ajax]).queue("ajax" + port).length > 0) {
                        jQuery([ajax]).dequeue("ajax" + port);
                    } else {
                        ajaxRunning[port] = false;
                    }
                };
                jQuery([ajax]).queue("ajax" + port, function() {
                    ajax(settings);
                });
                if (jQuery([ajax]).queue("ajax" + port).length == 1 && !ajaxRunning[port]) {
                    ajaxRunning[port] = true;
                    jQuery([ajax]).dequeue("ajax" + port);
                }
                return;
            case "sync":
                var pos = synced.length;
                synced[pos] = {
                    error: settings.error,
                    success: settings.success,
                    complete: settings.complete,
                    done: false
                };
                syncedData[pos] = {
                    error: [],
                    success: [],
                    complete: []
                };
                settings.error = function() { syncedData[pos].error = arguments; };
                settings.success = function() { syncedData[pos].success = arguments; };
                settings.complete = function() {
                    syncedData[pos].complete = arguments;
                    synced[pos].done = true;
                    if (pos == 0 || !synced[pos - 1])
                        for (var i = pos; i < synced.length && synced[i].done; i++) {
                        if (synced[i].error) synced[i].error.apply(jQuery, syncedData[i].error);
                        if (synced[i].success) synced[i].success.apply(jQuery, syncedData[i].success);
                        if (synced[i].complete) synced[i].complete.apply(jQuery, syncedData[i].complete);
                        synced[i] = null;
                        syncedData[i] = null;
                    }
                };
        }
        return ajax.apply(this, arguments);
    };
})(jQuery);

function isEmptyObject(obj) {
	for (var name in obj) {
		return false;
	}
	return true;
}

$(document).ready(function(){
    $('.main').niceScroll({
        cursorborder: "",
        cursorcolor: "#999"
    });
});