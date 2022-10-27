/*!
 AutoFill 2.2.2
 ©2008-2017 SpryMedia Ltd - datatables.net/license
*/
(function (e) {
    "function" === typeof define && define.amd
        ? define(["jquery", "datatables.net"], function (l) {
              return e(l, window, document);
          })
        : "object" === typeof exports
        ? (module.exports = function (l, i) {
              l || (l = window);
              if (!i || !i.fn.dataTable) i = require("datatables.net")(l, i).$;
              return e(i, l, l.document);
          })
        : e(jQuery, window, document);
})(function (e, l, i, q) {
    var k = e.fn.dataTable,
        p = 0,
        j = function (c, b) {
            if (!k.versionCheck || !k.versionCheck("1.10.8"))
                throw "Warning: AutoFill requires DataTables 1.10.8 or greater";
            this.c = e.extend(!0, {}, k.defaults.autoFill, j.defaults, b);
            this.s = {
                dt: new k.Api(c),
                namespace: ".autoFill" + p++,
                scroll: {},
                scrollInterval: null,
                handle: { height: 0, width: 0 },
                enabled: !1,
            };
            this.dom = {
                handle: e('<div class="dt-autofill-handle"/>'),
                select: {
                    top: e('<div class="dt-autofill-select top"/>'),
                    right: e('<div class="dt-autofill-select right"/>'),
                    bottom: e('<div class="dt-autofill-select bottom"/>'),
                    left: e('<div class="dt-autofill-select left"/>'),
                },
                background: e('<div class="dt-autofill-background"/>'),
                list: e(
                    '<div class="dt-autofill-list">' +
                        this.s.dt.i18n("autoFill.info", "") +
                        "<ul/></div>"
                ),
                dtScroll: null,
                offsetParent: null,
            };
            this._constructor();
        };
    e.extend(j.prototype, {
        enabled: function () {
            return this.s.enabled;
        },
        enable: function (c) {
            var b = this;
            if (!1 === c) return this.disable();
            this.s.enabled = !0;
            this._focusListener();
            this.dom.handle.on("mousedown", function (a) {
                b._mousedown(a);
                return !1;
            });
            return this;
        },
        disable: function () {
            this.s.enabled = !1;
            this._focusListenerRemove();
            return this;
        },
        _constructor: function () {
            var c = this,
                b = this.s.dt,
                a = e(
                    "div.dataTables_scrollBody",
                    this.s.dt.table().container()
                );
            b.settings()[0].autoFill = this;
            a.length &&
                ((this.dom.dtScroll = a),
                "static" === a.css("position") &&
                    a.css("position", "relative"));
            !1 !== this.c.enable && this.enable();
            b.on("destroy.autoFill", function () {
                c._focusListenerRemove();
            });
        },
        _attach: function (c) {
            var b = this.s.dt,
                a = b.cell(c).index(),
                d = this.dom.handle,
                f = this.s.handle;
            if (
                !a ||
                -1 === b.columns(this.c.columns).indexes().indexOf(a.column)
            )
                this._detach();
            else {
                this.dom.offsetParent ||
                    (this.dom.offsetParent = e(
                        b.table().node()
                    ).offsetParent());
                if (!f.height || !f.width)
                    d.appendTo("body"),
                        (f.height = d.outerHeight()),
                        (f.width = d.outerWidth());
                b = this._getPosition(c, this.dom.offsetParent);
                this.dom.attachedTo = c;
                d.css({
                    top: b.top + c.offsetHeight - f.height,
                    left: b.left + c.offsetWidth - f.width,
                }).appendTo(this.dom.offsetParent);
            }
        },
        _actionSelector: function (c) {
            var b = this,
                a = this.s.dt,
                d = j.actions,
                f = [];
            e.each(d, function (b, d) {
                d.available(a, c) && f.push(b);
            });
            if (1 === f.length && !1 === this.c.alwaysAsk) {
                var h = d[f[0]].execute(a, c);
                this._update(h, c);
            } else {
                var g = this.dom.list.children("ul").empty();
                f.push("cancel");
                e.each(f, function (f, h) {
                    g.append(
                        e("<li/>")
                            .append(
                                '<div class="dt-autofill-question">' +
                                    d[h].option(a, c) +
                                    "<div>"
                            )
                            .append(
                                e('<div class="dt-autofill-button">').append(
                                    e(
                                        '<button class="' +
                                            j.classes.btn +
                                            '">' +
                                            a.i18n("autoFill.button", "&gt;") +
                                            "</button>"
                                    ).on("click", function () {
                                        var f = d[h].execute(
                                            a,
                                            c,
                                            e(this).closest("li")
                                        );
                                        b._update(f, c);
                                        b.dom.background.remove();
                                        b.dom.list.remove();
                                    })
                                )
                            )
                    );
                });
                this.dom.background.appendTo("body");
                this.dom.list.appendTo("body");
                this.dom.list.css(
                    "margin-top",
                    -1 * (this.dom.list.outerHeight() / 2)
                );
            }
        },
        _detach: function () {
            this.dom.attachedTo = null;
            this.dom.handle.detach();
        },
        _drawSelection: function (c) {
            var b = this.s.dt,
                a = this.s.start,
                d = e(this.dom.start),
                f = e(c),
                h = {
                    row: b
                        .rows({ page: "current" })
                        .nodes()
                        .indexOf(f.parent()[0]),
                    column: f.index(),
                },
                c = b.column.index("toData", h.column);
            if (
                b.cell(f).any() &&
                -1 !== b.columns(this.c.columns).indexes().indexOf(c)
            ) {
                this.s.end = h;
                var g,
                    b = a.row < h.row ? d : f;
                g = a.row < h.row ? f : d;
                c = a.column < h.column ? d : f;
                d = a.column < h.column ? f : d;
                b = this._getPosition(b).top;
                c = this._getPosition(c).left;
                a = this._getPosition(g).top + g.outerHeight() - b;
                d = this._getPosition(d).left + d.outerWidth() - c;
                f = this.dom.select;
                f.top.css({ top: b, left: c, width: d });
                f.left.css({ top: b, left: c, height: a });
                f.bottom.css({ top: b + a, left: c, width: d });
                f.right.css({ top: b, left: c + d, height: a });
            }
        },
        _editor: function (c) {
            var b = this.s.dt,
                a = this.c.editor;
            if (a) {
                for (
                    var d = {}, f = [], e = a.fields(), g = 0, i = c.length;
                    g < i;
                    g++
                )
                    for (var j = 0, l = c[g].length; j < l; j++) {
                        var o = c[g][j],
                            k = b.settings()[0].aoColumns[o.index.column],
                            n = k.editField;
                        if (n === q)
                            for (
                                var k = k.mData, m = 0, p = e.length;
                                m < p;
                                m++
                            ) {
                                var r = a.field(e[m]);
                                if (r.dataSrc() === k) {
                                    n = r.name();
                                    break;
                                }
                            }
                        if (!n)
                            throw "Could not automatically determine field data. Please see https://datatables.net/tn/11";
                        d[n] || (d[n] = {});
                        k = b.row(o.index.row).id();
                        d[n][k] = o.set;
                        f.push(o.index);
                    }
                a.bubble(f, !1).multiSet(d).submit();
            }
        },
        _emitEvent: function (c, b) {
            this.s.dt.iterator("table", function (a) {
                e(a.nTable).triggerHandler(c + ".dt", b);
            });
        },
        _focusListener: function () {
            var c = this,
                b = this.s.dt,
                a = this.s.namespace,
                d =
                    null !== this.c.focus
                        ? this.c.focus
                        : b.init().keys || b.settings()[0].keytable
                        ? "focus"
                        : "hover";
            if ("focus" === d)
                b.on("key-focus.autoFill", function (b, a, d) {
                    c._attach(d.node());
                }).on("key-blur.autoFill", function () {
                    c._detach();
                });
            else if ("click" === d)
                e(b.table().body()).on("click" + a, "td, th", function () {
                    c._attach(this);
                }),
                    e(i.body).on("click" + a, function (a) {
                        e(a.target).parents().filter(b.table().body()).length ||
                            c._detach();
                    });
            else
                e(b.table().body())
                    .on("mouseenter" + a, "td, th", function () {
                        c._attach(this);
                    })
                    .on("mouseleave" + a, function (b) {
                        e(b.relatedTarget).hasClass("dt-autofill-handle") ||
                            c._detach();
                    });
        },
        _focusListenerRemove: function () {
            var c = this.s.dt;
            c.off(".autoFill");
            e(c.table().body()).off(this.s.namespace);
            e(i.body).off(this.s.namespace);
        },
        _getPosition: function (c, b) {
            var a = e(c),
                d,
                f,
                h = 0,
                g = 0;
            b || (b = e(this.s.dt.table().node()).offsetParent());
            do {
                f = a.position();
                d = a.offsetParent();
                h += f.top + d.scrollTop();
                g += f.left + d.scrollLeft();
                if ("body" === a.get(0).nodeName.toLowerCase()) break;
                a = d;
            } while (d.get(0) !== b.get(0));
            return { top: h, left: g };
        },
        _mousedown: function (c) {
            var b = this,
                a = this.s.dt;
            this.dom.start = this.dom.attachedTo;
            this.s.start = {
                row: a
                    .rows({ page: "current" })
                    .nodes()
                    .indexOf(e(this.dom.start).parent()[0]),
                column: e(this.dom.start).index(),
            };
            e(i.body)
                .on("mousemove.autoFill", function (a) {
                    b._mousemove(a);
                })
                .on("mouseup.autoFill", function (a) {
                    b._mouseup(a);
                });
            var d = this.dom.select,
                a = e(a.table().node()).offsetParent();
            d.top.appendTo(a);
            d.left.appendTo(a);
            d.right.appendTo(a);
            d.bottom.appendTo(a);
            this._drawSelection(this.dom.start, c);
            this.dom.handle.css("display", "none");
            c = this.dom.dtScroll;
            this.s.scroll = {
                windowHeight: e(l).height(),
                windowWidth: e(l).width(),
                dtTop: c ? c.offset().top : null,
                dtLeft: c ? c.offset().left : null,
                dtHeight: c ? c.outerHeight() : null,
                dtWidth: c ? c.outerWidth() : null,
            };
        },
        _mousemove: function (c) {
            var b = c.target.nodeName.toLowerCase();
            ("td" !== b && "th" !== b) ||
                (this._drawSelection(c.target, c), this._shiftScroll(c));
        },
        _mouseup: function () {
            e(i.body).off(".autoFill");
            var c = this.s.dt,
                b = this.dom.select;
            b.top.remove();
            b.left.remove();
            b.right.remove();
            b.bottom.remove();
            this.dom.handle.css("display", "block");
            var b = this.s.start,
                a = this.s.end;
            if (!(b.row === a.row && b.column === a.column)) {
                for (
                    var d = this._range(b.row, a.row),
                        b = this._range(b.column, a.column),
                        a = [],
                        f = c.settings()[0],
                        h = f.aoColumns,
                        g = 0;
                    g < d.length;
                    g++
                )
                    a.push(
                        e.map(b, function (a) {
                            var a = c.cell(
                                    ":eq(" + d[g] + ")",
                                    a + ":visible",
                                    { page: "current" }
                                ),
                                b = a.data(),
                                e = a.index(),
                                i = h[e.column].editField;
                            i !== q &&
                                (b = f.oApi._fnGetObjectDataFn(i)(
                                    c.row(e.row).data()
                                ));
                            return {
                                cell: a,
                                data: b,
                                label: a.data(),
                                index: e,
                            };
                        })
                    );
                this._actionSelector(a);
                clearInterval(this.s.scrollInterval);
                this.s.scrollInterval = null;
            }
        },
        _range: function (c, b) {
            var a = [],
                d;
            if (c <= b) for (d = c; d <= b; d++) a.push(d);
            else for (d = c; d >= b; d--) a.push(d);
            return a;
        },
        _shiftScroll: function (c) {
            var b = this,
                a = this.s.scroll,
                d = !1,
                f = c.pageY - i.body.scrollTop,
                e = c.pageX - i.body.scrollLeft,
                g,
                j,
                k,
                l;
            65 > f ? (g = -5) : f > a.windowHeight - 65 && (g = 5);
            65 > e ? (j = -5) : e > a.windowWidth - 65 && (j = 5);
            null !== a.dtTop && c.pageY < a.dtTop + 65
                ? (k = -5)
                : null !== a.dtTop &&
                  c.pageY > a.dtTop + a.dtHeight - 65 &&
                  (k = 5);
            null !== a.dtLeft && c.pageX < a.dtLeft + 65
                ? (l = -5)
                : null !== a.dtLeft &&
                  c.pageX > a.dtLeft + a.dtWidth - 65 &&
                  (l = 5);
            g || j || k || l
                ? ((a.windowVert = g),
                  (a.windowHoriz = j),
                  (a.dtVert = k),
                  (a.dtHoriz = l),
                  (d = !0))
                : this.s.scrollInterval &&
                  (clearInterval(this.s.scrollInterval),
                  (this.s.scrollInterval = null));
            !this.s.scrollInterval &&
                d &&
                (this.s.scrollInterval = setInterval(function () {
                    if (a.windowVert)
                        i.body.scrollTop = i.body.scrollTop + a.windowVert;
                    if (a.windowHoriz)
                        i.body.scrollLeft = i.body.scrollLeft + a.windowHoriz;
                    if (a.dtVert || a.dtHoriz) {
                        var c = b.dom.dtScroll[0];
                        if (a.dtVert) c.scrollTop = c.scrollTop + a.dtVert;
                        if (a.dtHoriz) c.scrollLeft = c.scrollLeft + a.dtHoriz;
                    }
                }, 20));
        },
        _update: function (c, b) {
            if (!1 !== c) {
                var a = this.s.dt,
                    d;
                this._emitEvent("preAutoFill", [a, b]);
                this._editor(b);
                if (null !== this.c.update ? this.c.update : !this.c.editor) {
                    for (var f = 0, e = b.length; f < e; f++)
                        for (var g = 0, i = b[f].length; g < i; g++)
                            (d = b[f][g]), d.cell.data(d.set);
                    a.draw(!1);
                }
                this._emitEvent("autoFill", [a, b]);
            }
        },
    });
    j.actions = {
        increment: {
            available: function (c, b) {
                return e.isNumeric(b[0][0].label);
            },
            option: function (c) {
                return c.i18n(
                    "autoFill.increment",
                    'Increment / decrement each cell by: <input type="number" value="1">'
                );
            },
            execute: function (c, b, a) {
                for (
                    var c = 1 * b[0][0].data,
                        a = 1 * e("input", a).val(),
                        d = 0,
                        f = b.length;
                    d < f;
                    d++
                )
                    for (var h = 0, g = b[d].length; h < g; h++)
                        (b[d][h].set = c), (c += a);
            },
        },
        fill: {
            available: function () {
                return !0;
            },
            option: function (c, b) {
                return c.i18n(
                    "autoFill.fill",
                    "Fill all cells with <i>" + b[0][0].label + "</i>"
                );
            },
            execute: function (c, b) {
                for (var a = b[0][0].data, d = 0, e = b.length; d < e; d++)
                    for (var h = 0, g = b[d].length; h < g; h++)
                        b[d][h].set = a;
            },
        },
        fillHorizontal: {
            available: function (c, b) {
                return 1 < b.length && 1 < b[0].length;
            },
            option: function (c) {
                return c.i18n(
                    "autoFill.fillHorizontal",
                    "Fill cells horizontally"
                );
            },
            execute: function (c, b) {
                for (var a = 0, d = b.length; a < d; a++)
                    for (var e = 0, h = b[a].length; e < h; e++)
                        b[a][e].set = b[a][0].data;
            },
        },
        fillVertical: {
            available: function (c, b) {
                return 1 < b.length && 1 < b[0].length;
            },
            option: function (c) {
                return c.i18n("autoFill.fillVertical", "Fill cells vertically");
            },
            execute: function (c, b) {
                for (var a = 0, d = b.length; a < d; a++)
                    for (var e = 0, h = b[a].length; e < h; e++)
                        b[a][e].set = b[0][e].data;
            },
        },
        cancel: {
            available: function () {
                return !1;
            },
            option: function (c) {
                return c.i18n("autoFill.cancel", "Cancel");
            },
            execute: function () {
                return !1;
            },
        },
    };
    j.version = "2.2.2";
    j.defaults = {
        alwaysAsk: !1,
        focus: null,
        columns: "",
        enable: !0,
        update: null,
        editor: null,
    };
    j.classes = { btn: "btn" };
    var m = e.fn.dataTable.Api;
    m.register("autoFill()", function () {
        return this;
    });
    m.register("autoFill().enabled()", function () {
        var c = this.context[0];
        return c.autoFill ? c.autoFill.enabled() : !1;
    });
    m.register("autoFill().enable()", function (c) {
        return this.iterator("table", function (b) {
            b.autoFill && b.autoFill.enable(c);
        });
    });
    m.register("autoFill().disable()", function () {
        return this.iterator("table", function (c) {
            c.autoFill && c.autoFill.disable();
        });
    });
    e(i).on("preInit.dt.autofill", function (c, b) {
        if ("dt" === c.namespace) {
            var a = b.oInit.autoFill,
                d = k.defaults.autoFill;
            if (a || d) (d = e.extend({}, a, d)), !1 !== a && new j(b, d);
        }
    });
    k.AutoFill = j;
    return (k.AutoFill = j);
});
