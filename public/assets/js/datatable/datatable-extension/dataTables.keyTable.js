/*!
 KeyTable 2.3.2
 ©2009-2017 SpryMedia Ltd - datatables.net/license
*/
(function (f) {
    "function" === typeof define && define.amd
        ? define(["jquery", "datatables.net"], function (k) {
              return f(k, window, document);
          })
        : "object" === typeof exports
        ? (module.exports = function (k, h) {
              k || (k = window);
              if (!h || !h.fn.dataTable) h = require("datatables.net")(k, h).$;
              return f(h, k, k.document);
          })
        : f(jQuery, window, document);
})(function (f, k, h, o) {
    var l = f.fn.dataTable,
        n = function (a, b) {
            if (!l.versionCheck || !l.versionCheck("1.10.8"))
                throw "KeyTable requires DataTables 1.10.8 or newer";
            this.c = f.extend(!0, {}, l.defaults.keyTable, n.defaults, b);
            this.s = {
                dt: new l.Api(a),
                enable: !0,
                focusDraw: !1,
                waitingForDraw: !1,
                lastFocus: null,
            };
            this.dom = {};
            var c = this.s.dt.settings()[0],
                d = c.keytable;
            if (d) return d;
            c.keytable = this;
            this._constructor();
        };
    f.extend(n.prototype, {
        blur: function () {
            this._blur();
        },
        enable: function (a) {
            this.s.enable = a;
        },
        focus: function (a, b) {
            this._focus(this.s.dt.cell(a, b));
        },
        focused: function (a) {
            if (!this.s.lastFocus) return !1;
            var b = this.s.lastFocus.cell.index();
            return a.row === b.row && a.column === b.column;
        },
        _constructor: function () {
            this._tabInput();
            var a = this,
                b = this.s.dt,
                c = f(b.table().node());
            "static" === c.css("position") && c.css("position", "relative");
            f(b.table().body()).on("click.keyTable", "th, td", function (c) {
                if (!1 !== a.s.enable) {
                    var d = b.cell(this);
                    d.any() && a._focus(d, null, !1, c);
                }
            });
            f(h).on("keydown.keyTable", function (b) {
                a._key(b);
            });
            if (this.c.blurable)
                f(h).on("mousedown.keyTable", function (c) {
                    f(c.target).parents(".dataTables_filter").length &&
                        a._blur();
                    f(c.target).parents().filter(b.table().container())
                        .length ||
                        f(c.target).parents("div.DTE").length ||
                        f(c.target).parents("div.editor-datetime").length ||
                        f(c.target).parents().filter(".DTFC_Cloned").length ||
                        a._blur();
                });
            if (this.c.editor) {
                var d = this.c.editor;
                d.on("open.keyTableMain", function (b, c) {
                    "inline" !== c &&
                        a.s.enable &&
                        (a.enable(!1),
                        d.one("close.keyTable", function () {
                            a.enable(!0);
                        }));
                });
                if (this.c.editOnFocus)
                    b.on(
                        "key-focus.keyTable key-refocus.keyTable",
                        function (b, c, d, e) {
                            a._editor(null, e);
                        }
                    );
                b.on("key.keyTable", function (b, c, d, e, f) {
                    a._editor(d, f);
                });
            }
            if (b.settings()[0].oFeatures.bStateSave)
                b.on("stateSaveParams.keyTable", function (b, c, d) {
                    d.keyTable = a.s.lastFocus
                        ? a.s.lastFocus.cell.index()
                        : null;
                });
            b.on("draw.keyTable", function (c) {
                if (!a.s.focusDraw) {
                    var d = a.s.lastFocus;
                    if (d && d.node && f(d.node).closest("body") === h.body) {
                        var d = a.s.lastFocus.relative,
                            e = b.page.info(),
                            j = d.row + e.start;
                        0 !== e.recordsDisplay &&
                            (j >= e.recordsDisplay &&
                                (j = e.recordsDisplay - 1),
                            a._focus(j, d.column, !0, c));
                    }
                }
            });
            b.on("destroy.keyTable", function () {
                b.off(".keyTable");
                f(b.table().body()).off("click.keyTable", "th, td");
                f(h.body).off("keydown.keyTable").off("click.keyTable");
            });
            var e = b.state.loaded();
            if (e && e.keyTable)
                b.one("init", function () {
                    var a = b.cell(e.keyTable);
                    a.any() && a.focus();
                });
            else this.c.focus && b.cell(this.c.focus).focus();
        },
        _blur: function () {
            if (this.s.enable && this.s.lastFocus) {
                var a = this.s.lastFocus.cell;
                f(a.node()).removeClass(this.c.className);
                this.s.lastFocus = null;
                this._updateFixedColumns(a.index().column);
                this._emitEvent("key-blur", [this.s.dt, a]);
            }
        },
        _clipboardCopy: function () {
            var a = this.s.dt;
            if (
                this.s.lastFocus &&
                k.getSelection &&
                !k.getSelection().toString()
            ) {
                var b = this.s.lastFocus.cell.render("display"),
                    c = f("<div/>").css({
                        height: 1,
                        width: 1,
                        overflow: "hidden",
                        position: "fixed",
                        top: 0,
                        left: 0,
                    }),
                    b = f("<textarea readonly/>").val(b).appendTo(c);
                try {
                    c.appendTo(a.table().container()),
                        b[0].focus(),
                        b[0].select(),
                        h.execCommand("copy");
                } catch (d) {}
                c.remove();
            }
        },
        _columns: function () {
            var a = this.s.dt,
                b = a.columns(this.c.columns).indexes(),
                c = [];
            a.columns(":visible").every(function (a) {
                -1 !== b.indexOf(a) && c.push(a);
            });
            return c;
        },
        _editor: function (a, b) {
            var c = this,
                d = this.s.dt,
                e = this.c.editor;
            !f("div.DTE", this.s.lastFocus.cell.node()).length &&
                16 !== a &&
                (b.stopPropagation(),
                13 === a && b.preventDefault(),
                e
                    .one("open.keyTable", function () {
                        e.off("cancelOpen.keyTable");
                        c.c.editAutoSelect &&
                            f(
                                "div.DTE_Field_InputControl input, div.DTE_Field_InputControl textarea"
                            ).select();
                        d.keys.enable(c.c.editorKeys);
                        d.one("key-blur.editor", function () {
                            e.displayed() && e.submit();
                        });
                        e.one("close", function () {
                            d.keys.enable(!0);
                            d.off("key-blur.editor");
                        });
                    })
                    .one("cancelOpen.keyTable", function () {
                        e.off("open.keyTable");
                    })
                    .inline(this.s.lastFocus.cell.index()));
        },
        _emitEvent: function (a, b) {
            this.s.dt.iterator("table", function (c) {
                f(c.nTable).triggerHandler(a, b);
            });
        },
        _focus: function (a, b, c, d) {
            var e = this,
                m = this.s.dt,
                g = m.page.info(),
                i = this.s.lastFocus;
            d || (d = null);
            if (this.s.enable) {
                if ("number" !== typeof a) {
                    var j = a.index(),
                        b = j.column,
                        a = m
                            .rows({ filter: "applied", order: "applied" })
                            .indexes()
                            .indexOf(j.row);
                    g.serverSide && (a += g.start);
                }
                if (-1 !== g.length && (a < g.start || a >= g.start + g.length))
                    (this.s.focusDraw = !0),
                        (this.s.waitingForDraw = !0),
                        m
                            .one("draw", function () {
                                e.s.focusDraw = !1;
                                e.s.waitingForDraw = !1;
                                e._focus(a, b, o, d);
                            })
                            .page(Math.floor(a / g.length))
                            .draw(!1);
                else if (-1 !== f.inArray(b, this._columns())) {
                    g.serverSide && (a -= g.start);
                    g = m
                        .cells(null, b, { search: "applied", order: "applied" })
                        .flatten();
                    g = m.cell(g[a]);
                    if (i) {
                        if (i.node === g.node()) {
                            this._emitEvent("key-refocus", [
                                this.s.dt,
                                g,
                                d || null,
                            ]);
                            return;
                        }
                        this._blur();
                    }
                    i = f(g.node());
                    i.addClass(this.c.className);
                    this._updateFixedColumns(b);
                    if (c === o || !0 === c)
                        this._scroll(f(k), f(h.body), i, "offset"),
                            (c = m.table().body().parentNode),
                            c !== m.table().header().parentNode &&
                                ((c = f(c.parentNode)),
                                this._scroll(c, c, i, "position"));
                    this.s.lastFocus = {
                        cell: g,
                        node: g.node(),
                        relative: {
                            row: m
                                .rows({ page: "current" })
                                .indexes()
                                .indexOf(g.index().row),
                            column: g.index().column,
                        },
                    };
                    this._emitEvent("key-focus", [this.s.dt, g, d || null]);
                    m.state.save();
                }
            }
        },
        _key: function (a) {
            if (this.s.waitingForDraw) a.preventDefault();
            else {
                var b = this.s.enable,
                    c = !0 === b || "navigation-only" === b;
                if (b)
                    if (a.ctrlKey && 67 === a.keyCode) this._clipboardCopy();
                    else if (
                        !(
                            0 === a.keyCode ||
                            a.ctrlKey ||
                            a.metaKey ||
                            a.altKey
                        ) &&
                        this.s.lastFocus
                    ) {
                        var d = this.s.dt;
                        if (
                            !(
                                this.c.keys &&
                                -1 === f.inArray(a.keyCode, this.c.keys)
                            )
                        )
                            switch (a.keyCode) {
                                case 9:
                                    this._shift(
                                        a,
                                        a.shiftKey ? "left" : "right",
                                        !0
                                    );
                                    break;
                                case 27:
                                    this.s.blurable && !0 === b && this._blur();
                                    break;
                                case 33:
                                case 34:
                                    c &&
                                        (a.preventDefault(),
                                        d
                                            .page(
                                                33 === a.keyCode
                                                    ? "previous"
                                                    : "next"
                                            )
                                            .draw(!1));
                                    break;
                                case 35:
                                case 36:
                                    c &&
                                        (a.preventDefault(),
                                        (b = d
                                            .cells({ page: "current" })
                                            .indexes()),
                                        (c = this._columns()),
                                        this._focus(
                                            d.cell(
                                                b[
                                                    35 === a.keyCode
                                                        ? b.length - 1
                                                        : c[0]
                                                ]
                                            ),
                                            null,
                                            !0,
                                            a
                                        ));
                                    break;
                                case 37:
                                    c && this._shift(a, "left");
                                    break;
                                case 38:
                                    c && this._shift(a, "up");
                                    break;
                                case 39:
                                    c && this._shift(a, "right");
                                    break;
                                case 40:
                                    c && this._shift(a, "down");
                                    break;
                                default:
                                    !0 === b &&
                                        this._emitEvent("key", [
                                            d,
                                            a.keyCode,
                                            this.s.lastFocus.cell,
                                            a,
                                        ]);
                            }
                    }
            }
        },
        _scroll: function (a, b, c, d) {
            var e = c[d](),
                f = c.outerHeight(),
                g = c.outerWidth(),
                i = b.scrollTop(),
                j = b.scrollLeft(),
                h = a.height(),
                a = a.width();
            "position" === d &&
                (e.top += parseInt(c.closest("table").css("top"), 10));
            e.top < i && b.scrollTop(e.top);
            e.left < j && b.scrollLeft(e.left);
            e.top + f > i + h && f < h && b.scrollTop(e.top + f - h);
            e.left + g > j + a && g < a && b.scrollLeft(e.left + g - a);
        },
        _shift: function (a, b, c) {
            var d = this.s.dt,
                e = d.page.info(),
                h = e.recordsDisplay,
                g = this.s.lastFocus.cell,
                i = this._columns();
            if (g) {
                var j = d
                    .rows({ filter: "applied", order: "applied" })
                    .indexes()
                    .indexOf(g.index().row);
                e.serverSide && (j += e.start);
                d = d.columns(i).indexes().indexOf(g.index().column);
                e = i[d];
                "right" === b
                    ? d >= i.length - 1
                        ? (j++, (e = i[0]))
                        : (e = i[d + 1])
                    : "left" === b
                    ? 0 === d
                        ? (j--, (e = i[i.length - 1]))
                        : (e = i[d - 1])
                    : "up" === b
                    ? j--
                    : "down" === b && j++;
                0 <= j && j < h && -1 !== f.inArray(e, i)
                    ? (a.preventDefault(), this._focus(j, e, !0, a))
                    : !c || !this.c.blurable
                    ? a.preventDefault()
                    : this._blur();
            }
        },
        _tabInput: function () {
            var a = this,
                b = this.s.dt,
                c =
                    null !== this.c.tabIndex
                        ? this.c.tabIndex
                        : b.settings()[0].iTabIndex;
            if (-1 != c)
                f('<div><input type="text" tabindex="' + c + '"/></div>')
                    .css({
                        position: "absolute",
                        height: 1,
                        width: 0,
                        overflow: "hidden",
                    })
                    .insertBefore(b.table().node())
                    .children()
                    .on("focus", function (c) {
                        b.cell(":eq(0)", { page: "current" }).any() &&
                            a._focus(
                                b.cell(":eq(0)", "0:visible", {
                                    page: "current",
                                }),
                                null,
                                !0,
                                c
                            );
                    });
        },
        _updateFixedColumns: function (a) {
            var b = this.s.dt,
                c = b.settings()[0];
            if (c._oFixedColumns) {
                var d = c.aoColumns.length - c._oFixedColumns.s.iRightColumns;
                (a < c._oFixedColumns.s.iLeftColumns || a >= d) &&
                    b.fixedColumns().update();
            }
        },
    });
    n.defaults = {
        blurable: !0,
        className: "focus",
        columns: "",
        editor: null,
        editorKeys: "navigation-only",
        editAutoSelect: !0,
        editOnFocus: !1,
        focus: null,
        keys: null,
        tabIndex: null,
    };
    n.version = "2.3.2";
    f.fn.dataTable.KeyTable = n;
    f.fn.DataTable.KeyTable = n;
    l.Api.register("cell.blur()", function () {
        return this.iterator("table", function (a) {
            a.keytable && a.keytable.blur();
        });
    });
    l.Api.register("cell().focus()", function () {
        return this.iterator("cell", function (a, b, c) {
            a.keytable && a.keytable.focus(b, c);
        });
    });
    l.Api.register("keys.disable()", function () {
        return this.iterator("table", function (a) {
            a.keytable && a.keytable.enable(!1);
        });
    });
    l.Api.register("keys.enable()", function (a) {
        return this.iterator("table", function (b) {
            b.keytable && b.keytable.enable(a === o ? !0 : a);
        });
    });
    l.ext.selector.cell.push(function (a, b, c) {
        var b = b.focused,
            a = a.keytable,
            d = [];
        if (!a || b === o) return c;
        for (var e = 0, f = c.length; e < f; e++)
            ((!0 === b && a.focused(c[e])) || (!1 === b && !a.focused(c[e]))) &&
                d.push(c[e]);
        return d;
    });
    f(h).on("preInit.dt.dtk", function (a, b) {
        if ("dt" === a.namespace) {
            var c = b.oInit.keys,
                d = l.defaults.keys;
            if (c || d) (d = f.extend({}, d, c)), !1 !== c && new n(b, d);
        }
    });
    return n;
});
