function navbarSubmenu(e) {
    e > 767 && $(".main-navigation .navbar-nav > li.dropdown").hover(function() {
        var t = $(".dropdown-menu", $(this)).offset().left,
            i = $(".dropdown-menu", $(this)).width();
        if (2 * i > e - t ? $(this).children(".dropdown-menu").addClass("leftauto") : $(this).children(".dropdown-menu").removeClass("leftauto"), $(".dropdown", $(this)).length > 0) {
            var s = $(".dropdown-menu", $(this)).width();
            s > e - t - i ? $(this).children(".dropdown-menu").addClass("left-side") : $(this).children(".dropdown-menu").removeClass("left-side")
        }
    })
}

function hoverDropdown(e, t) {
    if (e > 767 && t !== !0) {
        $(".main-navigation .navbar-nav > li.dropdown, .main-navigation li.dropdown > ul > li.dropdown").removeClass("open");
        var i, s = 0;
        $(".main-navigation .navbar-nav > li.dropdown, .main-navigation li.dropdown > ul > li.dropdown").hover(function() {
            var e = $(this);
            i = setTimeout(function() {
                e.addClass("open"), e.find(".dropdown-toggle").addClass("disabled")
            }, s)
        }, function() {
            clearTimeout(i), $(this).removeClass("open"), $(this).find(".dropdown-toggle").removeClass("disabled")
        })
    } else $(".main-navigation .navbar-nav > li.dropdown, .main-navigation li.dropdown > ul > li.dropdown").unbind("mouseenter mouseleave"), $(".main-navigation [data-toggle=dropdown]").not(".binded").addClass("binded").on("click", function(e) {
        e.preventDefault(), e.stopPropagation(), $(this).parent().siblings().removeClass("open"), $(this).parent().siblings().find("[data-toggle=dropdown]").parent().removeClass("open"), $(this).parent().toggleClass("open")
    })
}

function ssc_init() {
    if (document.body) {
        var e = document.body,
            t = document.documentElement,
            i = window.innerHeight,
            s = e.scrollHeight;
        if (ssc_root = document.compatMode.indexOf("CSS") >= 0 ? t : e, ssc_activeElement = e, ssc_initdone = !0, top != self) ssc_frame = !0;
        else if (s > i && (e.offsetHeight <= i || t.offsetHeight <= i) && (ssc_root.style.height = "auto", ssc_root.offsetHeight <= i)) {
            var n = document.createElement("div");
            n.style.clear = "both", e.appendChild(n)
        }
        ssc_fixedback || (e.style.backgroundAttachment = "scroll", t.style.backgroundAttachment = "scroll"), ssc_keyboardsupport && ssc_addEvent("keydown", ssc_keydown)
    }
}

function ssc_scrollArray(e, t, i, s) {
    if (s || (s = 1e3), ssc_directionCheck(t, i), ssc_que.push({
            x: t,
            y: i,
            lastX: 0 > t ? .99 : -.99,
            lastY: 0 > i ? .99 : -.99,
            start: +new Date
        }), !ssc_pending) {
        var n = function() {
            for (var o = +new Date, a = 0, r = 0, l = 0; l < ssc_que.length; l++) {
                var c = ssc_que[l],
                    d = o - c.start,
                    u = d >= ssc_animtime,
                    h = u ? 1 : d / ssc_animtime;
                ssc_pulseAlgorithm && (h = ssc_pulse(h));
                var p = c.x * h - c.lastX >> 0,
                    f = c.y * h - c.lastY >> 0;
                a += p, r += f, c.lastX += p, c.lastY += f, u && (ssc_que.splice(l, 1), l--)
            }
            if (t) {
                var m = e.scrollLeft;
                e.scrollLeft += a, a && e.scrollLeft === m && (t = 0)
            }
            if (i) {
                var v = e.scrollTop;
                e.scrollTop += r, r && e.scrollTop === v && (i = 0)
            }
            t || i || (ssc_que = []), ssc_que.length ? setTimeout(n, s / ssc_framerate + 1) : ssc_pending = !1
        };
        setTimeout(n, 0), ssc_pending = !0
    }
}

function ssc_wheel(e) {
    ssc_initdone || ssc_init();
    var t = e.target,
        i = ssc_overflowingAncestor(t);
    if (!i || e.defaultPrevented || ssc_isNodeName(ssc_activeElement, "embed") || ssc_isNodeName(t, "embed") && /\.pdf/i.test(t.src)) return !0;
    var s = e.wheelDeltaX || 0,
        n = e.wheelDeltaY || 0;
    s || n || (n = e.wheelDelta || 0), Math.abs(s) > 1.2 && (s *= ssc_stepsize / 120), Math.abs(n) > 1.2 && (n *= ssc_stepsize / 120), ssc_scrollArray(i, -s, -n), e.preventDefault()
}

function ssc_keydown(e) {
    var t = e.target,
        i = e.ctrlKey || e.altKey || e.metaKey;
    if (/input|textarea|embed/i.test(t.nodeName) || t.isContentEditable || e.defaultPrevented || i) return !0;
    if (ssc_isNodeName(t, "button") && e.keyCode === ssc_key.spacebar) return !0;
    var s, n = 0,
        o = 0,
        a = ssc_overflowingAncestor(ssc_activeElement),
        r = a.clientHeight;
    switch (a == document.body && (r = window.innerHeight), e.keyCode) {
        case ssc_key.up:
            o = -ssc_arrowscroll;
            break;
        case ssc_key.down:
            o = ssc_arrowscroll;
            break;
        case ssc_key.spacebar:
            s = e.shiftKey ? 1 : -1, o = -s * r * .9;
            break;
        case ssc_key.pageup:
            o = .9 * -r;
            break;
        case ssc_key.pagedown:
            o = .9 * r;
            break;
        case ssc_key.home:
            o = -a.scrollTop;
            break;
        case ssc_key.end:
            var l = a.scrollHeight - a.scrollTop - r;
            o = l > 0 ? l + 10 : 0;
            break;
        case ssc_key.left:
            n = -ssc_arrowscroll;
            break;
        case ssc_key.right:
            n = ssc_arrowscroll;
            break;
        default:
            return !0
    }
    ssc_scrollArray(a, n, o), e.preventDefault()
}

function ssc_mousedown(e) {
    ssc_activeElement = e.target
}

function ssc_setCache(e, t) {
    for (var i = e.length; i--;) ssc_cache[ssc_uniqueID(e[i])] = t;
    return t
}

function ssc_overflowingAncestor(e) {
    var t = [],
        i = ssc_root.scrollHeight;
    do {
        var s = ssc_cache[ssc_uniqueID(e)];
        if (s) return ssc_setCache(t, s);
        if (t.push(e), i === e.scrollHeight) {
            if (!ssc_frame || ssc_root.clientHeight + 10 < i) return ssc_setCache(t, document.body)
        } else if (e.clientHeight + 10 < e.scrollHeight && (overflow = getComputedStyle(e, "").getPropertyValue("overflow"), "scroll" === overflow || "auto" === overflow)) return ssc_setCache(t, e)
    } while (e = e.parentNode)
}

function ssc_addEvent(e, t, i) {
    window.addEventListener(e, t, i || !1)
}

function ssc_removeEvent(e, t, i) {
    window.removeEventListener(e, t, i || !1)
}

function ssc_isNodeName(e, t) {
    return e.nodeName.toLowerCase() === t.toLowerCase()
}

function ssc_directionCheck(e, t) {
    e = e > 0 ? 1 : -1, t = t > 0 ? 1 : -1, ssc_direction.x === e && ssc_direction.y === t || (ssc_direction.x = e, ssc_direction.y = t, ssc_que = [])
}

function ssc_pulse_(e) {
    var t, i, s;
    return e *= ssc_pulseScale, 1 > e ? t = e - (1 - Math.exp(-e)) : (i = Math.exp(-1), e -= 1, s = 1 - Math.exp(-e), t = i + s * (1 - i)), t * ssc_pulseNormalize
}

function ssc_pulse(e) {
    return e >= 1 ? 1 : 0 >= e ? 0 : (1 == ssc_pulseNormalize && (ssc_pulseNormalize /= ssc_pulse_(1)), ssc_pulse_(e))
}

function callPlayer(e, t, i) {
    window.jQuery && e instanceof jQuery && (e = e.get(0).id);
    var s = document.getElementById(e);
    s && "IFRAME" != s.tagName.toUpperCase() && (s = s.getElementsByTagName("iframe")[0]), s && s.contentWindow.postMessage(JSON.stringify({
        event: "command",
        func: t,
        args: i || [],
        id: e
    }), "*")
}
$(document).ready(function() {
        $("#contactForm").submit(function(e) {
            e.preventDefault();
            var t = $(this).serializeArray(),
                i = $(this).attr("action"),
                s = $("#contactFormResponse"),
                n = $("#cfsubmit"),
                o = n.text();
            return n.text("Sending..."), $.ajax({
                url: i,
                type: "POST",
                data: t,
                success: function(e) {
                    s.html(e), n.text(o)
                },
                error: function(e) {
                    alert("Error occurd! Please try again")
                }
            }), !1
        })
    }),
    function() {
        if ($("#funfacts").html()) {
            new Waypoint.Inview({
                element: $("#funfacts")[0],
                enter: function(e) {
                    $(".count.number").each(function() {
                        $(this).prop("Counter", 0).animate({
                            Counter: $(this).text()
                        }, {
                            duration: 3e3,
                            easing: "swing",
                            step: function(e) {
                                $(this).text(Math.ceil(e))
                            }
                        })
                    }), this.destroy()
                }
            })
        }
    }(),
    function() {
        function e() {
            var e = {
                    zoom: 11,
                    scrollwheel: !1,
                    center: new google.maps.LatLng(9.588425, 76.522668),
                    styles: [{
                        featureType: "water",
                        elementType: "geometry",
                        stylers: [{
                            color: "#e9e9e9"
                        }, {
                            lightness: 17
                        }]
                    }, {
                        featureType: "landscape",
                        elementType: "geometry",
                        stylers: [{
                            color: "#f5f5f5"
                        }, {
                            lightness: 20
                        }]
                    }, {
                        featureType: "road.highway",
                        elementType: "geometry.fill",
                        stylers: [{
                            color: "#ffffff"
                        }, {
                            lightness: 17
                        }]
                    }, {
                        featureType: "road.highway",
                        elementType: "geometry.stroke",
                        stylers: [{
                            color: "#ffffff"
                        }, {
                            lightness: 29
                        }, {
                            weight: .2
                        }]
                    }, {
                        featureType: "road.arterial",
                        elementType: "geometry",
                        stylers: [{
                            color: "#ffffff"
                        }, {
                            lightness: 18
                        }]
                    }, {
                        featureType: "road.local",
                        elementType: "geometry",
                        stylers: [{
                            color: "#ffffff"
                        }, {
                            lightness: 16
                        }]
                    }, {
                        featureType: "poi",
                        elementType: "geometry",
                        stylers: [{
                            color: "#f5f5f5"
                        }, {
                            lightness: 21
                        }]
                    }, {
                        featureType: "poi.park",
                        elementType: "geometry",
                        stylers: [{
                            color: "#dedede"
                        }, {
                            lightness: 21
                        }]
                    }, {
                        elementType: "labels.text.stroke",
                        stylers: [{
                            visibility: "on"
                        }, {
                            color: "#ffffff"
                        }, {
                            lightness: 16
                        }]
                    }, {
                        elementType: "labels.text.fill",
                        stylers: [{
                            saturation: 36
                        }, {
                            color: "#333333"
                        }, {
                            lightness: 40
                        }]
                    }, {
                        elementType: "labels.icon",
                        stylers: [{
                            visibility: "off"
                        }]
                    }, {
                        featureType: "transit",
                        elementType: "geometry",
                        stylers: [{
                            color: "#f2f2f2"
                        }, {
                            lightness: 19
                        }]
                    }, {
                        featureType: "administrative",
                        elementType: "geometry.fill",
                        stylers: [{
                            color: "#fefefe"
                        }, {
                            lightness: 20
                        }]
                    }, {
                        featureType: "administrative",
                        elementType: "geometry.stroke",
                        stylers: [{
                            color: "#fefefe"
                        }, {
                            lightness: 17
                        }, {
                            weight: 1.2
                        }]
                    }]
                },
                t = document.getElementById("map"),
                i = new google.maps.Map(t, e);
            new google.maps.Marker({
                position: new google.maps.LatLng(9.588425, 76.522668),
                map: i,
                title: "Patanjali International Institute Of Yoga & Meditation"
            })
        }
        0 != $("#map").length && google && google.maps.event.addDomListener(window, "load", e)
    }();
var $event = $.event,
    $special, resizeTimeout;
$special = $event.special.debouncedresize = {
    setup: function() {
        $(this).on("resize", $special.handler)
    },
    teardown: function() {
        $(this).off("resize", $special.handler)
    },
    handler: function(e, t) {
        var i = this,
            s = arguments,
            n = function() {
                e.type = "debouncedresize", $event.dispatch.apply(i, s)
            };
        resizeTimeout && clearTimeout(resizeTimeout), t ? n() : resizeTimeout = setTimeout(n, $special.threshold)
    },
    threshold: 250
};
var BLANK = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
$.fn.imagesLoaded = function(e) {
    function t() {
        var t = $(l),
            i = $(c);
        n && (c.length ? n.reject(a, t, i) : n.resolve(a)), $.isFunction(e) && e.call(s, a, t, i)
    }

    function i(e, i) {
        e.src !== BLANK && -1 === $.inArray(e, r) && (r.push(e), i ? c.push(e) : l.push(e), $.data(e, "imagesLoaded", {
            isBroken: i,
            src: e.src
        }), o && n.notifyWith($(e), [i, a, $(l), $(c)]), a.length === r.length && (setTimeout(t), a.unbind(".imagesLoaded")))
    }
    var s = this,
        n = $.isFunction($.Deferred) ? $.Deferred() : 0,
        o = $.isFunction(n.notify),
        a = s.find("img").add(s.filter("img")),
        r = [],
        l = [],
        c = [];
    return $.isPlainObject(e) && $.each(e, function(t, i) {
        "callback" === t ? e = i : n && n[t](i)
    }), a.length ? a.bind("load.imagesLoaded error.imagesLoaded", function(e) {
        i(e.target, "error" === e.type)
    }).each(function(e, t) {
        var s = t.src,
            n = $.data(t, "imagesLoaded");
        return n && n.src === s ? void i(t, n.isBroken) : t.complete && void 0 !== t.naturalWidth ? void i(t, 0 === t.naturalWidth || 0 === t.naturalHeight) : void((t.readyState || t.complete) && (t.src = BLANK, t.src = s))
    }) : t(), n ? n.promise(s) : s
};
var Grid = function() {
    function e(e) {
        _ = $.extend(!0, {}, _, e), d.imagesLoaded(function() {
            i(!0), o(), s()
        })
    }

    function t(e) {
        u = u.add(e), e.each(function() {
            var e = $(this);
            e.data({
                offsetTop: e.offset().top,
                height: e.height()
            })
        }), n(e)
    }

    function i(e) {
        u.each(function() {
            var t = $(this);
            t.data("offsetTop", t.offset().top), e && t.data("height", t.height())
        })
    }

    function s() {
        n(u), v.on("debouncedresize", function() {
            f = 0, p = -1, i(), o();
            var e = $.data(this, "preview");
            "undefined" != typeof e && r()
        })
    }

    function n(e) {
        e.on("click", "span.og-close", function() {
            return r(), !1
        }).children("a").on("click", function(e) {
            var t = $(this).parent();
            return h === t.index() ? r() : a(t), !1
        })
    }

    function o() {
        c = {
            width: v.width(),
            height: v.height()
        }
    }

    function a(e) {
        var t = $.data(this, "preview"),
            i = e.data("offsetTop");
        if (f = 0, "undefined" != typeof t) {
            if (p === i) return t.update(e), !1;
            i > p && (f = t.height), r()
        }
        p = i, t = $.data(this, "preview", new l(e)), t.open()
    }

    function r() {
        h = -1;
        var e = $.data(this, "preview");
        e.close(), $.removeData(this, "preview")
    }

    function l(e) {
        this.$item = e, this.expandedIdx = this.$item.index(), this.create(), this.update()
    }
    var c, d = $("#og-grid"),
        u = d.children("li"),
        h = -1,
        p = -1,
        f = 0,
        m = 10,
        v = $(window),
        g = $("html, body"),
        y = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd",
            msTransition: "MSTransitionEnd",
            transition: "transitionend"
        },
        w = y[Modernizr.prefixed("transition")],
        b = Modernizr.csstransitions,
        _ = {
            minHeight: 500,
            speed: 350,
            easing: "ease"
        };
    return l.prototype = {
        create: function() {
            this.$title = $("<h3></h3>"), this.$description = $("<p></p>"), this.$href = $('<a class="btn btn-default" href="#">Visit website</a>'), this.$details = $('<div class="og-details"></div>').append(this.$title, this.$description, this.$href), this.$loading = $('<div class="og-loading"></div>'), this.$fullimage = $('<div class="og-fullimg"></div>').append(this.$loading), this.$closePreview = $('<span class="og-close"></span>'), this.$previewInner = $('<div class="og-expander-inner"></div>').append(this.$closePreview, this.$fullimage, this.$details), this.$previewEl = $('<div class="og-expander"></div>').append(this.$previewInner), this.$item.append(this.getEl()), b && this.setTransition()
        },
        update: function(e) {
            if (e && (this.$item = e), -1 !== h) {
                var t = u.eq(h);
                t.removeClass("og-expanded"), this.$item.addClass("og-expanded"), this.positionPreview()
            }
            h = this.$item.index();
            var i = this.$item.children("a"),
                s = {
                    href: i.attr("href"),
                    largesrc: i.data("largesrc"),
                    title: i.data("title"),
                    description: i.data("description")
                };
            this.$title.html(s.title), this.$description.html(s.description), this.$href.attr("href", s.href);
            var n = this;
            "undefined" != typeof n.$largeImg && n.$largeImg.remove(), n.$fullimage.is(":visible") && (this.$loading.show(), $("<img/>").load(function() {
                var e = $(this);
                e.attr("src") === n.$item.children("a").data("largesrc") && (n.$loading.hide(), n.$fullimage.find("img").remove(), n.$largeImg = e.fadeIn(350), n.$fullimage.append(n.$largeImg))
            }).attr("src", s.largesrc))
        },
        open: function() {
            setTimeout($.proxy(function() {
                this.setHeights(), this.positionPreview()
            }, this), 25)
        },
        close: function() {
            var e = this,
                t = function() {
                    b && $(this).off(w), e.$item.removeClass("og-expanded").css("height", ""), e.$previewEl.remove()
                };
            return setTimeout($.proxy(function() {
                "undefined" != typeof this.$largeImg && this.$largeImg.fadeOut("fast"), this.$previewEl.css("height", 0);
                var e = u.eq(this.expandedIdx);
                e.css("height", e.data("height")).on(w, t), b || t.call()
            }, this), 25), !1
        },
        calcHeight: function() {
            var e = c.height - this.$item.data("height") - m,
                t = c.height;
            e < _.minHeight && (e = _.minHeight, t = _.minHeight + this.$item.data("height") + m), this.height = e, this.itemHeight = t
        },
        setHeights: function() {
            var e = this,
                t = function() {
                    b && e.$item.off(w), e.$item.addClass("og-expanded")
                };
            this.calcHeight(), this.$previewEl.css("height", this.height), this.$item.css("height", this.itemHeight).on(w, t), b || t.call()
        },
        positionPreview: function() {
            var e = this.$item.data("offsetTop"),
                t = this.$previewEl.offset().top - f,
                i = this.height + this.$item.data("height") + m <= c.height ? e : this.height < c.height ? t - (c.height - this.height) : t;
            g.animate({
                scrollTop: i
            }, _.speed)
        },
        setTransition: function() {
            this.$previewEl.css("transition", "height " + _.speed + "ms " + _.easing), this.$item.css("transition", "height " + _.speed + "ms " + _.easing)
        },
        getEl: function() {
            return this.$previewEl
        }
    }, {
        init: e,
        addItems: t
    }
}();
! function(e, t, i) {
    "use strict";
    e.HoverDir = function(t, i) {
        this.$el = e(i), this._init(t)
    }, e.HoverDir.defaults = {
        speed: 300,
        easing: "ease",
        hoverDelay: 0,
        inverse: !1
    }, e.HoverDir.prototype = {
        _init: function(t) {
            this.options = e.extend(!0, {}, e.HoverDir.defaults, t), this.transitionProp = "all " + this.options.speed + "ms " + this.options.easing, this.support = Modernizr.csstransitions, this._loadEvents()
        },
        _loadEvents: function() {
            var t = this;
            this.$el.on("mouseenter.hoverdir, mouseleave.hoverdir", function(i) {
                var s = e(this),
                    n = s.find("div"),
                    o = t._getDir(s, {
                        x: i.pageX,
                        y: i.pageY
                    }),
                    a = t._getStyle(o);
                "mouseenter" === i.type ? (n.hide().css(a.from), clearTimeout(t.tmhover), t.tmhover = setTimeout(function() {
                    n.show(0, function() {
                        var i = e(this);
                        t.support && i.css("transition", t.transitionProp), t._applyAnimation(i, a.to, t.options.speed)
                    })
                }, t.options.hoverDelay)) : (t.support && n.css("transition", t.transitionProp), clearTimeout(t.tmhover), t._applyAnimation(n, a.from, t.options.speed))
            })
        },
        _getDir: function(e, t) {
            var i = e.width(),
                s = e.height(),
                n = (t.x - e.offset().left - i / 2) * (i > s ? s / i : 1),
                o = (t.y - e.offset().top - s / 2) * (s > i ? i / s : 1),
                a = Math.round((Math.atan2(o, n) * (180 / Math.PI) + 180) / 90 + 3) % 4;
            return a
        },
        _getStyle: function(e) {
            var t, i, s = {
                    left: "0px",
                    top: "-100%"
                },
                n = {
                    left: "0px",
                    top: "100%"
                },
                o = {
                    left: "-100%",
                    top: "0px"
                },
                a = {
                    left: "100%",
                    top: "0px"
                },
                r = {
                    top: "0px"
                },
                l = {
                    left: "0px"
                };
            switch (e) {
                case 0:
                    t = this.options.inverse ? n : s, i = r;
                    break;
                case 1:
                    t = this.options.inverse ? o : a, i = l;
                    break;
                case 2:
                    t = this.options.inverse ? s : n, i = r;
                    break;
                case 3:
                    t = this.options.inverse ? a : o, i = l
            }
            return {
                from: t,
                to: i
            }
        },
        _applyAnimation: function(t, i, s) {
            e.fn.applyStyle = this.support ? e.fn.css : e.fn.animate, t.stop().applyStyle(i, e.extend(!0, [], {
                duration: s + "ms"
            }))
        }
    };
    var s = function(e) {
        t.console && t.console.error(e)
    };
    e.fn.hoverdir = function(t) {
        var i = e.data(this, "hoverdir");
        if ("string" == typeof t) {
            var n = Array.prototype.slice.call(arguments, 1);
            this.each(function() {
                return i ? e.isFunction(i[t]) && "_" !== t.charAt(0) ? void i[t].apply(i, n) : void s("no such method '" + t + "' for hoverdir instance") : void s("cannot call methods on hoverdir prior to initialization; attempted to call method '" + t + "'")
            })
        } else this.each(function() {
            i ? i._init() : i = e.data(this, "hoverdir", new e.HoverDir(t, this))
        });
        return i
    }
}(jQuery, window),
function(e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : e("object" == typeof module && module.exports ? require("jquery") : jQuery)
}(function(e) {
    function t(t) {
        var i = {},
            s = /^jQuery\d+$/;
        return e.each(t.attributes, function(e, t) {
            t.specified && !s.test(t.name) && (i[t.name] = t.value)
        }), i
    }

    function i(t, i) {
        var s = this,
            o = e(s);
        if (s.value === o.attr("placeholder") && o.hasClass(h.customClass))
            if (s.value = "", o.removeClass(h.customClass), o.data("placeholder-password")) {
                if (o = o.hide().nextAll('input[type="password"]:first').show().attr("id", o.removeAttr("id").data("placeholder-id")), t === !0) return o[0].value = i, i;
                o.focus()
            } else s == n() && s.select()
    }

    function s(s) {
        var n, o = this,
            a = e(o),
            r = o.id;
        if (s && "blur" === s.type) {
            if (a.hasClass(h.customClass)) return;
            if ("password" === o.type && (n = a.prevAll('input[type="text"]:first'), n.length > 0 && n.is(":visible"))) return
        }
        if ("" === o.value) {
            if ("password" === o.type) {
                if (!a.data("placeholder-textinput")) {
                    try {
                        n = a.clone().prop({
                            type: "text"
                        })
                    } catch (l) {
                        n = e("<input>").attr(e.extend(t(this), {
                            type: "text"
                        }))
                    }
                    n.removeAttr("name").data({
                        "placeholder-enabled": !0,
                        "placeholder-password": a,
                        "placeholder-id": r
                    }).bind("focus.placeholder", i), a.data({
                        "placeholder-textinput": n,
                        "placeholder-id": r
                    }).before(n)
                }
                o.value = "", a = a.removeAttr("id").hide().prevAll('input[type="text"]:first').attr("id", a.data("placeholder-id")).show()
            } else {
                var c = a.data("placeholder-password");
                c && (c[0].value = "", a.attr("id", a.data("placeholder-id")).show().nextAll('input[type="password"]:last').hide().removeAttr("id"))
            }
            a.addClass(h.customClass), a[0].value = a.attr("placeholder")
        } else a.removeClass(h.customClass)
    }

    function n() {
        try {
            return document.activeElement
        } catch (e) {}
    }
    var o, a, r = "[object OperaMini]" === Object.prototype.toString.call(window.operamini),
        l = "placeholder" in document.createElement("input") && !r,
        c = "placeholder" in document.createElement("textarea") && !r,
        d = e.valHooks,
        u = e.propHooks,
        h = {};
    l && c ? (a = e.fn.placeholder = function() {
        return this
    }, a.input = !0, a.textarea = !0) : (a = e.fn.placeholder = function(t) {
        var n = {
            customClass: "placeholder"
        };
        return h = e.extend({}, n, t), this.filter((l ? "textarea" : ":input") + "[placeholder]").not("." + h.customClass).bind({
            "focus.placeholder": i,
            "blur.placeholder": s
        }).data("placeholder-enabled", !0).trigger("blur.placeholder")
    }, a.input = l, a.textarea = c, o = {
        get: function(t) {
            var i = e(t),
                s = i.data("placeholder-password");
            return s ? s[0].value : i.data("placeholder-enabled") && i.hasClass(h.customClass) ? "" : t.value
        },
        set: function(t, o) {
            var a, r, l = e(t);
            return "" !== o && (a = l.data("placeholder-textinput"), r = l.data("placeholder-password"), a ? (i.call(a[0], !0, o) || (t.value = o), a[0].value = o) : r && (i.call(t, !0, o) || (r[0].value = o), t.value = o)), l.data("placeholder-enabled") ? ("" === o ? (t.value = o, t != n() && s.call(t)) : (l.hasClass(h.customClass) && i.call(t), t.value = o), l) : (t.value = o, l)
        }
    }, l || (d.input = o, u.value = o), c || (d.textarea = o, u.value = o), e(function() {
        e(document).delegate("form", "submit.placeholder", function() {
            var t = e("." + h.customClass, this).each(function() {
                i.call(this, !0, "")
            });
            setTimeout(function() {
                t.each(s)
            }, 10)
        })
    }), e(window).bind("beforeunload.placeholder", function() {
        e("." + h.customClass).each(function() {
            this.value = ""
        })
    }))
}), $(document).ready(function() {
        $("#client-carousel").owlCarousel({
            items: 6,
            itemsDesktopSmall: 4,
            itemsTablet: 4,
            itemsMobile: 2,
            autoPlay: !0
        })
    }),
    function() {
        function e() {
            var e = window.navigator.userAgent,
                t = e.indexOf("MSIE ");
            if (t > 0) return parseInt(e.substring(t + 5, e.indexOf(".", t)), 10);
            var i = e.indexOf("Trident/");
            if (i > 0) {
                var s = e.indexOf("rv:");
                return parseInt(e.substring(s + 3, e.indexOf(".", s)), 10)
            }
            var n = e.indexOf("Edge/");
            return n > 0 ? parseInt(e.substring(n + 5, e.indexOf(".", n)), 10) : !1
        }
        e() && $("body").addClass("ie")
    }(),
    function() {
        function e(e) {
            var t = $("#header");
            if (t.length > 0) {
                var i = t.height(),
                    s = $(document).scrollTop();
                if (t.hasClass("home-parallax") && $(e).scrollTop() <= i && t.css("top", .55 * s), t.hasClass("home-fade") && $(e).scrollTop() <= i) {
                    var n = $(".intro"),
                        o = $("#header .color-overlay");
                    o.css("opacity", .3 + s / t.height() * 1), n.css("opacity", 1 - s / t.height() * 1)
                }
            }
        }
        $(window).scroll(function(t) {
            t.preventDefault(), e(this)
        })
    }(),
    function() {
        function e() {
            return $(window).scrollTop() > 0 ? void t.addClass("navbar-solid") : (t.removeClass("navbar-solid"), void $(".navbar-nav > li > a").blur())
        }
        var t = $("#fixedTopNav");
        e(), $(window).scroll(function() {
            e()
        })
    }(), $(document).ready(function() {
        $(".main-navigation a[href*=#]:not([href=#]), .onPageNav").click(function() {
            if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") && location.hostname === this.hostname) {
                var e = $(this.hash);
                if (e = e.length ? e : $("[name=" + this.hash.slice(1) + "]"), e.length) return $(".navbar-collapse.collapse.in").removeClass("in"), $("html,body").animate({
                    scrollTop: e.offset().top - 55
                }, 1e3, function() {}), !1
            }
        }), $("#main-nav-collapse").on("activate.bs.scrollspy", function() {
            $(".navbar-nav > li[class='active'] > a").focus()
        })
    }), $(window).load(function() {
        imagesLoaded("body", function() {
            $(".page-loader div").fadeOut(), $(".page-loader").delay(200).fadeOut("slow")
        })
    });
var navbar = $(".main-navigation"),
    width = Math.max($(window).width(), window.innerWidth),
    mobileTest;
/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && (mobileTest = !0), $(document).on("click", ".navbar-collapse.in", function(e) {
        $(e.target).is("a") && "dropdown-toggle" != $(e.target).attr("class") && $(this).collapse("hide")
    }), navbarSubmenu(width), hoverDropdown(width, mobileTest), $(window).resize(function() {
        var e = Math.max($(window).width(), window.innerWidth);
        hoverDropdown(e, mobileTest)
    }), $(window).scroll(function() {
        var e = $("#totop");
        $(this).scrollTop() > 100 ? e.fadeIn() : e.fadeOut()
    }), $("a[href='#totop']").click(function() {
        return $("html, body").animate({
            scrollTop: 0
        }, "slow"), !1
    }), $(window).load(function() {
        $(".flexslider").flexslider({
            animation: "fade",
            easing: "swing",
            controlNav: !1
        })
    }), $(".rotate").textrotator({
        animation: "fade",
        separator: ",",
        speed: 2e3
    }),
    function() {
        $(function() {
            $("#videoBackground").mb_YTPlayer()
        }), $("#video-play").click(function(e) {
            return e.preventDefault(), $(this).hasClass("fa-play") ? $("#videoBackground").playYTP() : $("#videoBackground").pauseYTP(), $(this).toggleClass("fa-play fa-pause"), !1
        }), $("#video-volume").click(function(e) {
            return e.preventDefault(), $(this).hasClass("fa-volume-off") ? $("#videoBackground").YTPUnmute() : $("#videoBackground").YTPMute(), $(this).toggleClass("fa-volume-off fa-volume-up"), !1
        })
    }(),
    function() {
        Grid.init()
    }(),
    function() {
        if (0 != $("#disqus_thread").length) {
            var e = "reigntemplate";
            ! function() {
                var t = document.createElement("script");
                t.type = "text/javascript", t.async = !0, t.src = "//" + e + ".disqus.com/embed.js", (document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0]).appendChild(t)
            }()
        }
    }(), $(window).load(function() {
        imagesLoaded("body", function() {
            $(".lightbox-gallery").magnificPopup({
                delegate: "a",
                gallery: {
                    enabled: !0
                },
                type: "image",
                zoom: {
                    enabled: !0,
                    duration: 300,
                    opener: function(e) {
                        return e.find("img")
                    }
                }
            })
        })
    }), $(window).load(function() {
        var e = $(".isotope").isotope({
            itemSelector: "li"
        });
        $("#filters").on("click", "button", function() {
            var t = $(this).attr("data-filter");
            e.isotope({
                filter: t
            })
        }), $(".button-group").each(function(e, t) {
            var i = $(t);
            i.on("click", "button", function() {
                i.find(".is-checked").removeClass("is-checked"), $(this).addClass("is-checked")
            })
        }), $(function() {
            $("#da-thumbs").find("> li").each(function() {
                $(this).hoverdir({
                    hoverDelay: 75
                })
            })
        })
    }),
    function() {
        0 != $(".progressbars").length && $(".progressbars").each(function() {
            var e = $(this);
            new Waypoint.Inview({
                element: e,
                enter: function(t) {
                    e.find(".progress-bar").each(function() {
                        $(this).css("width", $(this).attr("aria-valuenow") + "%")
                    })
                }
            })
        })
    }();
var ssc_framerate = 150,
    ssc_animtime = 500,
    ssc_stepsize = 150,
    ssc_pulseAlgorithm = !0,
    ssc_pulseScale = 6,
    ssc_pulseNormalize = 1,
    ssc_keyboardsupport = !0,
    ssc_arrowscroll = 50,
    ssc_frame = !1,
    ssc_direction = {
        x: 0,
        y: 0
    },
    ssc_initdone = !1,
    ssc_fixedback = !0,
    ssc_root = document.documentElement,
    ssc_activeElement, ssc_key = {
        left: 37,
        up: 38,
        right: 39,
        down: 40,
        spacebar: 32,
        pageup: 33,
        pagedown: 34,
        end: 35,
        home: 36
    },
    ssc_que = [],
    ssc_pending = !1,
    ssc_cache = {};
setInterval(function() {
    ssc_cache = {}
}, 1e4);
var ssc_uniqueID = function() {
        var e = 0;
        return function(t) {
            return t.ssc_uniqueID || (t.ssc_uniqueID = e++)
        }
    }(),
    ischrome = /chrome/.test(navigator.userAgent.toLowerCase());
ischrome && (ssc_addEvent("mousedown", ssc_mousedown), ssc_addEvent("mousewheel", ssc_wheel), ssc_addEvent("load", ssc_init)), $("#subscription-form").submit(function(e) {
        e.preventDefault();
        var t = $("#subscription-form"),
            i = $("#subscribe-button"),
            s = $("#subscription-response"),
            n = $("#subscriber-email").val();
        $.ajax({
            type: "POST",
            url: "php/subscribe.php",
            dataType: "json",
            data: {
                email: n
            },
            cache: !1,
            beforeSend: function(e) {
                i.val("Joining...")
            },
            success: function(e) {
                1 == e.sendstatus ? (s.html(e.message), t.fadeOut(500)) : (s.html(e.message), i.val("Join"))
            }
        })
    }),
    function() {
        var e = $("#testimonials-carousel"),
            t = $(".review"),
            i = $("#clientFace");
        e.owlCarousel({
            singleItem: !0,
            autoPlay: !0,
            pagination: !1,
            autoHeight: !0,
            beforeMove: function(s) {
                var n = e.data("owlCarousel"),
                    o = t[n.currentItem];
                o = $(o).data("client-image"), i.css("background-image", "url(" + o + ")")
            }
        }), $(".carosel-wrapper .prev").click(function(t) {
            t.preventDefault(), e.trigger("owl.prev")
        }), $(".carosel-wrapper .next").click(function(t) {
            t.preventDefault(), e.trigger("owl.next")
        })
    }(), $("#playVideo").click(function(e) {
        e.preventDefault(), callPlayer("ytPlayer", "playVideo"), $("#video").hide(), $("#video-container").fadeIn()
    });
