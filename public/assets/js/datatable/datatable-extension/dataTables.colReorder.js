/*!
 ColReorder 1.4.1
 ©2010-2017 SpryMedia Ltd - datatables.net/license
*/
(function (f) {
    "function" === typeof define && define.amd
        ? define(["jquery", "datatables.net"], function (o) {
              return f(o, window, document);
          })
        : "object" === typeof exports
        ? (module.exports = function (o, l) {
              o || (o = window);
              if (!l || !l.fn.dataTable) l = require("datatables.net")(o, l).$;
              return f(l, o, o.document);
          })
        : f(jQuery, window, document);
})(function (f, o, l, r) {
    function q(a) {
        for (var b = [], c = 0, e = a.length; c < e; c++) b[a[c]] = c;
        return b;
    }
    function p(a, b, c) {
        b = a.splice(b, 1)[0];
        a.splice(c, 0, b);
    }
    function s(a, b, c) {
        for (var e = [], f = 0, d = a.childNodes.length; f < d; f++)
            1 == a.childNodes[f].nodeType && e.push(a.childNodes[f]);
        b = e[b];
        null !== c ? a.insertBefore(b, e[c]) : a.appendChild(b);
    }
    var t = f.fn.dataTable;
    f.fn.dataTableExt.oApi.fnColReorder = function (a, b, c, e, g) {
        var d,
            h,
            j,
            m,
            i,
            l = a.aoColumns.length,
            k;
        i = function (a, b, d) {
            if (a[b] && "function" !== typeof a[b]) {
                var c = a[b].split("."),
                    e = c.shift();
                isNaN(1 * e) || (a[b] = d[1 * e] + "." + c.join("."));
            }
        };
        if (b != c)
            if (0 > b || b >= l)
                this.oApi._fnLog(
                    a,
                    1,
                    "ColReorder 'from' index is out of bounds: " + b
                );
            else if (0 > c || c >= l)
                this.oApi._fnLog(
                    a,
                    1,
                    "ColReorder 'to' index is out of bounds: " + c
                );
            else {
                j = [];
                d = 0;
                for (h = l; d < h; d++) j[d] = d;
                p(j, b, c);
                var n = q(j);
                d = 0;
                for (h = a.aaSorting.length; d < h; d++)
                    a.aaSorting[d][0] = n[a.aaSorting[d][0]];
                if (null !== a.aaSortingFixed) {
                    d = 0;
                    for (h = a.aaSortingFixed.length; d < h; d++)
                        a.aaSortingFixed[d][0] = n[a.aaSortingFixed[d][0]];
                }
                d = 0;
                for (h = l; d < h; d++) {
                    k = a.aoColumns[d];
                    j = 0;
                    for (m = k.aDataSort.length; j < m; j++)
                        k.aDataSort[j] = n[k.aDataSort[j]];
                    k.idx = n[k.idx];
                }
                f.each(a.aLastSort, function (b, c) {
                    a.aLastSort[b].src = n[c.src];
                });
                d = 0;
                for (h = l; d < h; d++)
                    (k = a.aoColumns[d]),
                        "number" == typeof k.mData
                            ? (k.mData = n[k.mData])
                            : f.isPlainObject(k.mData) &&
                              (i(k.mData, "_", n),
                              i(k.mData, "filter", n),
                              i(k.mData, "sort", n),
                              i(k.mData, "type", n));
                if (a.aoColumns[b].bVisible) {
                    i = this.oApi._fnColumnIndexToVisible(a, b);
                    m = null;
                    for (d = c < b ? c : c + 1; null === m && d < l; )
                        (m = this.oApi._fnColumnIndexToVisible(a, d)), d++;
                    j = a.nTHead.getElementsByTagName("tr");
                    d = 0;
                    for (h = j.length; d < h; d++) s(j[d], i, m);
                    if (null !== a.nTFoot) {
                        j = a.nTFoot.getElementsByTagName("tr");
                        d = 0;
                        for (h = j.length; d < h; d++) s(j[d], i, m);
                    }
                    d = 0;
                    for (h = a.aoData.length; d < h; d++)
                        null !== a.aoData[d].nTr && s(a.aoData[d].nTr, i, m);
                }
                p(a.aoColumns, b, c);
                d = 0;
                for (h = l; d < h; d++) a.oApi._fnColumnOptions(a, d, {});
                p(a.aoPreSearchCols, b, c);
                d = 0;
                for (h = a.aoData.length; d < h; d++) {
                    m = a.aoData[d];
                    if ((k = m.anCells)) {
                        p(k, b, c);
                        j = 0;
                        for (i = k.length; j < i; j++)
                            k[j] &&
                                k[j]._DT_CellIndex &&
                                (k[j]._DT_CellIndex.column = j);
                    }
                    "dom" !== m.src && f.isArray(m._aData) && p(m._aData, b, c);
                }
                d = 0;
                for (h = a.aoHeader.length; d < h; d++) p(a.aoHeader[d], b, c);
                if (null !== a.aoFooter) {
                    d = 0;
                    for (h = a.aoFooter.length; d < h; d++)
                        p(a.aoFooter[d], b, c);
                }
                (g || g === r) && f.fn.dataTable.Api(a).rows().invalidate();
                d = 0;
                for (h = l; d < h; d++)
                    f(a.aoColumns[d].nTh).off("click.DT"),
                        this.oApi._fnSortAttachListener(
                            a,
                            a.aoColumns[d].nTh,
                            d
                        );
                f(a.oInstance).trigger("column-reorder.dt", [
                    a,
                    {
                        from: b,
                        to: c,
                        mapping: n,
                        drop: e,
                        iFrom: b,
                        iTo: c,
                        aiInvertMapping: n,
                    },
                ]);
            }
    };
    var i = function (a, b) {
        var c = new f.fn.dataTable.Api(a).settings()[0];
        if (c._colReorder) return c._colReorder;
        !0 === b && (b = {});
        var e = f.fn.dataTable.camelToHungarian;
        e && (e(i.defaults, i.defaults, !0), e(i.defaults, b || {}));
        this.s = {
            dt: null,
            init: f.extend(!0, {}, i.defaults, b),
            fixed: 0,
            fixedRight: 0,
            reorderCallback: null,
            mouse: {
                startX: -1,
                startY: -1,
                offsetX: -1,
                offsetY: -1,
                target: -1,
                targetIndex: -1,
                fromIndex: -1,
            },
            aoTargets: [],
        };
        this.dom = { drag: null, pointer: null };
        this.s.dt = c;
        this.s.dt._colReorder = this;
        this._fnConstruct();
        return this;
    };
    f.extend(i.prototype, {
        fnReset: function () {
            this._fnOrderColumns(this.fnOrder());
            return this;
        },
        fnGetCurrentOrder: function () {
            return this.fnOrder();
        },
        fnOrder: function (a, b) {
            var c = [],
                e,
                g,
                d = this.s.dt.aoColumns;
            if (a === r) {
                e = 0;
                for (g = d.length; e < g; e++)
                    c.push(d[e]._ColReorder_iOrigCol);
                return c;
            }
            if (b) {
                d = this.fnOrder();
                e = 0;
                for (g = a.length; e < g; e++) c.push(f.inArray(a[e], d));
                a = c;
            }
            this._fnOrderColumns(q(a));
            return this;
        },
        fnTranspose: function (a, b) {
            b || (b = "toCurrent");
            var c = this.fnOrder(),
                e = this.s.dt.aoColumns;
            return "toCurrent" === b
                ? !f.isArray(a)
                    ? f.inArray(a, c)
                    : f.map(a, function (a) {
                          return f.inArray(a, c);
                      })
                : !f.isArray(a)
                ? e[a]._ColReorder_iOrigCol
                : f.map(a, function (a) {
                      return e[a]._ColReorder_iOrigCol;
                  });
        },
        _fnConstruct: function () {
            var a = this,
                b = this.s.dt.aoColumns.length,
                c = this.s.dt.nTable,
                e;
            this.s.init.iFixedColumns &&
                (this.s.fixed = this.s.init.iFixedColumns);
            this.s.init.iFixedColumnsLeft &&
                (this.s.fixed = this.s.init.iFixedColumnsLeft);
            this.s.fixedRight = this.s.init.iFixedColumnsRight
                ? this.s.init.iFixedColumnsRight
                : 0;
            this.s.init.fnReorderCallback &&
                (this.s.reorderCallback = this.s.init.fnReorderCallback);
            for (e = 0; e < b; e++)
                e > this.s.fixed - 1 &&
                    e < b - this.s.fixedRight &&
                    this._fnMouseListener(e, this.s.dt.aoColumns[e].nTh),
                    (this.s.dt.aoColumns[e]._ColReorder_iOrigCol = e);
            this.s.dt.oApi._fnCallbackReg(
                this.s.dt,
                "aoStateSaveParams",
                function (b, c) {
                    a._fnStateSave.call(a, c);
                },
                "ColReorder_State"
            );
            var g = null;
            this.s.init.aiOrder && (g = this.s.init.aiOrder.slice());
            this.s.dt.oLoadedState &&
                "undefined" != typeof this.s.dt.oLoadedState.ColReorder &&
                this.s.dt.oLoadedState.ColReorder.length ==
                    this.s.dt.aoColumns.length &&
                (g = this.s.dt.oLoadedState.ColReorder);
            if (g)
                if (a.s.dt._bInitComplete)
                    (b = q(g)), a._fnOrderColumns.call(a, b);
                else {
                    var d = !1;
                    f(c).on("draw.dt.colReorder", function () {
                        if (!a.s.dt._bInitComplete && !d) {
                            d = true;
                            var b = q(g);
                            a._fnOrderColumns.call(a, b);
                        }
                    });
                }
            else this._fnSetColumnIndexes();
            f(c).on("destroy.dt.colReorder", function () {
                f(c).off("destroy.dt.colReorder draw.dt.colReorder");
                f(a.s.dt.nTHead).find("*").off(".ColReorder");
                f.each(a.s.dt.aoColumns, function (a, b) {
                    f(b.nTh).removeAttr("data-column-index");
                });
                a.s.dt._colReorder = null;
                a.s = null;
            });
        },
        _fnOrderColumns: function (a) {
            var b = !1;
            if (a.length != this.s.dt.aoColumns.length)
                this.s.dt.oInstance.oApi._fnLog(
                    this.s.dt,
                    1,
                    "ColReorder - array reorder does not match known number of columns. Skipping."
                );
            else {
                for (var c = 0, e = a.length; c < e; c++) {
                    var g = f.inArray(c, a);
                    c != g &&
                        (p(a, g, c),
                        this.s.dt.oInstance.fnColReorder(g, c, !0, !1),
                        (b = !0));
                }
                f.fn.dataTable.Api(this.s.dt).rows().invalidate();
                this._fnSetColumnIndexes();
                b &&
                    (("" !== this.s.dt.oScroll.sX ||
                        "" !== this.s.dt.oScroll.sY) &&
                        this.s.dt.oInstance.fnAdjustColumnSizing(!1),
                    this.s.dt.oInstance.oApi._fnSaveState(this.s.dt),
                    null !== this.s.reorderCallback &&
                        this.s.reorderCallback.call(this));
            }
        },
        _fnStateSave: function (a) {
            var b,
                c,
                e,
                g = this.s.dt.aoColumns;
            a.ColReorder = [];
            if (a.aaSorting) {
                for (b = 0; b < a.aaSorting.length; b++)
                    a.aaSorting[b][0] =
                        g[a.aaSorting[b][0]]._ColReorder_iOrigCol;
                var d = f.extend(!0, [], a.aoSearchCols);
                b = 0;
                for (c = g.length; b < c; b++)
                    (e = g[b]._ColReorder_iOrigCol),
                        (a.aoSearchCols[e] = d[b]),
                        (a.abVisCols[e] = g[b].bVisible),
                        a.ColReorder.push(e);
            } else if (a.order) {
                for (b = 0; b < a.order.length; b++)
                    a.order[b][0] = g[a.order[b][0]]._ColReorder_iOrigCol;
                d = f.extend(!0, [], a.columns);
                b = 0;
                for (c = g.length; b < c; b++)
                    (e = g[b]._ColReorder_iOrigCol),
                        (a.columns[e] = d[b]),
                        a.ColReorder.push(e);
            }
        },
        _fnMouseListener: function (a, b) {
            var c = this;
            f(b)
                .on("mousedown.ColReorder", function (a) {
                    c._fnMouseDown.call(c, a, b);
                })
                .on("touchstart.ColReorder", function (a) {
                    c._fnMouseDown.call(c, a, b);
                });
        },
        _fnMouseDown: function (a, b) {
            var c = this,
                e = f(a.target).closest("th, td").offset(),
                g = parseInt(f(b).attr("data-column-index"), 10);
            g !== r &&
                ((this.s.mouse.startX = this._fnCursorPosition(a, "pageX")),
                (this.s.mouse.startY = this._fnCursorPosition(a, "pageY")),
                (this.s.mouse.offsetX =
                    this._fnCursorPosition(a, "pageX") - e.left),
                (this.s.mouse.offsetY =
                    this._fnCursorPosition(a, "pageY") - e.top),
                (this.s.mouse.target = this.s.dt.aoColumns[g].nTh),
                (this.s.mouse.targetIndex = g),
                (this.s.mouse.fromIndex = g),
                this._fnRegions(),
                f(l)
                    .on(
                        "mousemove.ColReorder touchmove.ColReorder",
                        function (a) {
                            c._fnMouseMove.call(c, a);
                        }
                    )
                    .on("mouseup.ColReorder touchend.ColReorder", function (a) {
                        c._fnMouseUp.call(c, a);
                    }));
        },
        _fnMouseMove: function (a) {
            if (null === this.dom.drag) {
                if (
                    5 >
                    Math.pow(
                        Math.pow(
                            this._fnCursorPosition(a, "pageX") -
                                this.s.mouse.startX,
                            2
                        ) +
                            Math.pow(
                                this._fnCursorPosition(a, "pageY") -
                                    this.s.mouse.startY,
                                2
                            ),
                        0.5
                    )
                )
                    return;
                this._fnCreateDragNode();
            }
            this.dom.drag.css({
                left: this._fnCursorPosition(a, "pageX") - this.s.mouse.offsetX,
                top: this._fnCursorPosition(a, "pageY") - this.s.mouse.offsetY,
            });
            for (
                var b = !1,
                    c = this.s.mouse.toIndex,
                    e = 1,
                    f = this.s.aoTargets.length;
                e < f;
                e++
            )
                if (
                    this._fnCursorPosition(a, "pageX") <
                    this.s.aoTargets[e - 1].x +
                        (this.s.aoTargets[e].x - this.s.aoTargets[e - 1].x) / 2
                ) {
                    this.dom.pointer.css("left", this.s.aoTargets[e - 1].x);
                    this.s.mouse.toIndex = this.s.aoTargets[e - 1].to;
                    b = !0;
                    break;
                }
            b ||
                (this.dom.pointer.css(
                    "left",
                    this.s.aoTargets[this.s.aoTargets.length - 1].x
                ),
                (this.s.mouse.toIndex =
                    this.s.aoTargets[this.s.aoTargets.length - 1].to));
            this.s.init.bRealtime &&
                c !== this.s.mouse.toIndex &&
                (this.s.dt.oInstance.fnColReorder(
                    this.s.mouse.fromIndex,
                    this.s.mouse.toIndex,
                    !1
                ),
                (this.s.mouse.fromIndex = this.s.mouse.toIndex),
                this._fnRegions());
        },
        _fnMouseUp: function () {
            f(l).off(".ColReorder");
            null !== this.dom.drag &&
                (this.dom.drag.remove(),
                this.dom.pointer.remove(),
                (this.dom.drag = null),
                (this.dom.pointer = null),
                this.s.dt.oInstance.fnColReorder(
                    this.s.mouse.fromIndex,
                    this.s.mouse.toIndex,
                    !0
                ),
                this._fnSetColumnIndexes(),
                ("" !== this.s.dt.oScroll.sX || "" !== this.s.dt.oScroll.sY) &&
                    this.s.dt.oInstance.fnAdjustColumnSizing(!1),
                this.s.dt.oInstance.oApi._fnSaveState(this.s.dt),
                null !== this.s.reorderCallback &&
                    this.s.reorderCallback.call(this));
        },
        _fnRegions: function () {
            var a = this.s.dt.aoColumns;
            this.s.aoTargets.splice(0, this.s.aoTargets.length);
            this.s.aoTargets.push({
                x: f(this.s.dt.nTable).offset().left,
                to: 0,
            });
            for (
                var b = 0, c = this.s.aoTargets[0].x, e = 0, g = a.length;
                e < g;
                e++
            )
                e != this.s.mouse.fromIndex && b++,
                    a[e].bVisible &&
                        "none" !== a[e].nTh.style.display &&
                        ((c += f(a[e].nTh).outerWidth()),
                        this.s.aoTargets.push({ x: c, to: b }));
            0 !== this.s.fixedRight &&
                this.s.aoTargets.splice(
                    this.s.aoTargets.length - this.s.fixedRight
                );
            0 !== this.s.fixed && this.s.aoTargets.splice(0, this.s.fixed);
        },
        _fnCreateDragNode: function () {
            var a = "" !== this.s.dt.oScroll.sX || "" !== this.s.dt.oScroll.sY,
                b = this.s.dt.aoColumns[this.s.mouse.targetIndex].nTh,
                c = b.parentNode,
                e = c.parentNode,
                g = e.parentNode,
                d = f(b).clone();
            this.dom.drag = f(g.cloneNode(!1))
                .addClass("DTCR_clonedTable")
                .append(
                    f(e.cloneNode(!1)).append(f(c.cloneNode(!1)).append(d[0]))
                )
                .css({
                    position: "absolute",
                    top: 0,
                    left: 0,
                    width: f(b).outerWidth(),
                    height: f(b).outerHeight(),
                })
                .appendTo("body");
            this.dom.pointer = f("<div></div>")
                .addClass("DTCR_pointer")
                .css({
                    position: "absolute",
                    top: a
                        ? f(
                              "div.dataTables_scroll",
                              this.s.dt.nTableWrapper
                          ).offset().top
                        : f(this.s.dt.nTable).offset().top,
                    height: a
                        ? f(
                              "div.dataTables_scroll",
                              this.s.dt.nTableWrapper
                          ).height()
                        : f(this.s.dt.nTable).height(),
                })
                .appendTo("body");
        },
        _fnSetColumnIndexes: function () {
            f.each(this.s.dt.aoColumns, function (a, b) {
                f(b.nTh).attr("data-column-index", a);
            });
        },
        _fnCursorPosition: function (a, b) {
            return -1 !== a.type.indexOf("touch")
                ? a.originalEvent.touches[0][b]
                : a[b];
        },
    });
    i.defaults = {
        aiOrder: null,
        bRealtime: !0,
        iFixedColumnsLeft: 0,
        iFixedColumnsRight: 0,
        fnReorderCallback: null,
    };
    i.version = "1.4.1";
    f.fn.dataTable.ColReorder = i;
    f.fn.DataTable.ColReorder = i;
    "function" == typeof f.fn.dataTable &&
    "function" == typeof f.fn.dataTableExt.fnVersionCheck &&
    f.fn.dataTableExt.fnVersionCheck("1.10.8")
        ? f.fn.dataTableExt.aoFeatures.push({
              fnInit: function (a) {
                  var b = a.oInstance;
                  a._colReorder
                      ? b.oApi._fnLog(
                            a,
                            1,
                            "ColReorder attempted to initialise twice. Ignoring second"
                        )
                      : ((b = a.oInit),
                        new i(a, b.colReorder || b.oColReorder || {}));
                  return null;
              },
              cFeature: "R",
              sFeature: "ColReorder",
          })
        : alert(
              "Warning: ColReorder requires DataTables 1.10.8 or greater - www.datatables.net/download"
          );
    f(l).on("preInit.dt.colReorder", function (a, b) {
        if ("dt" === a.namespace) {
            var c = b.oInit.colReorder,
                e = t.defaults.colReorder;
            if (c || e) (e = f.extend({}, c, e)), !1 !== c && new i(b, e);
        }
    });
    f.fn.dataTable.Api.register("colReorder.reset()", function () {
        return this.iterator("table", function (a) {
            a._colReorder.fnReset();
        });
    });
    f.fn.dataTable.Api.register("colReorder.order()", function (a, b) {
        return a
            ? this.iterator("table", function (c) {
                  c._colReorder.fnOrder(a, b);
              })
            : this.context.length
            ? this.context[0]._colReorder.fnOrder()
            : null;
    });
    f.fn.dataTable.Api.register("colReorder.transpose()", function (a, b) {
        return this.context.length && this.context[0]._colReorder
            ? this.context[0]._colReorder.fnTranspose(a, b)
            : a;
    });
    f.fn.dataTable.Api.register("colReorder.move()", function (a, b, c, e) {
        this.context.length &&
            this.context[0]._colReorder.s.dt.oInstance.fnColReorder(a, b, c, e);
        return this;
    });
    return i;
});
