var _self =
        "undefined" != typeof window
            ? window
            : "undefined" != typeof WorkerGlobalScope &&
              self instanceof WorkerGlobalScope
            ? self
            : {},
    Prism = (function () {
        var e = /\blang(?:uage)?-(\w+)\b/i,
            t = 0,
            a = (_self.Prism = {
                util: {
                    encode: function (e) {
                        return e instanceof n
                            ? new n(e.type, a.util.encode(e.content), e.alias)
                            : "Array" === a.util.type(e)
                            ? e.map(a.util.encode)
                            : e
                                  .replace(/&/g, "&amp;")
                                  .replace(/</g, "&lt;")
                                  .replace(/\u00a0/g, " ");
                    },
                    type: function (e) {
                        return Object.prototype.toString
                            .call(e)
                            .match(/\[object (\w+)\]/)[1];
                    },
                    objId: function (e) {
                        return (
                            e.__id ||
                                Object.defineProperty(e, "__id", {
                                    value: ++t,
                                }),
                            e.__id
                        );
                    },
                    clone: function (e) {
                        var t = a.util.type(e);
                        switch (t) {
                            case "Object":
                                var n = {};
                                for (var r in e)
                                    e.hasOwnProperty(r) &&
                                        (n[r] = a.util.clone(e[r]));
                                return n;
                            case "Array":
                                return (
                                    e.map &&
                                    e.map(function (e) {
                                        return a.util.clone(e);
                                    })
                                );
                        }
                        return e;
                    },
                },
                languages: {
                    extend: function (e, t) {
                        var n = a.util.clone(a.languages[e]);
                        for (var r in t) n[r] = t[r];
                        return n;
                    },
                    insertBefore: function (e, t, n, r) {
                        r = r || a.languages;
                        var i = r[e];
                        if (2 == arguments.length) {
                            n = arguments[1];
                            for (var s in n)
                                n.hasOwnProperty(s) && (i[s] = n[s]);
                            return i;
                        }
                        var l = {};
                        for (var o in i)
                            if (i.hasOwnProperty(o)) {
                                if (o == t)
                                    for (var s in n)
                                        n.hasOwnProperty(s) && (l[s] = n[s]);
                                l[o] = i[o];
                            }
                        return (
                            a.languages.DFS(a.languages, function (t, a) {
                                a === r[e] && t != e && (this[t] = l);
                            }),
                            (r[e] = l)
                        );
                    },
                    DFS: function (e, t, n, r) {
                        r = r || {};
                        for (var i in e)
                            e.hasOwnProperty(i) &&
                                (t.call(e, i, e[i], n || i),
                                "Object" !== a.util.type(e[i]) ||
                                r[a.util.objId(e[i])]
                                    ? "Array" !== a.util.type(e[i]) ||
                                      r[a.util.objId(e[i])] ||
                                      ((r[a.util.objId(e[i])] = !0),
                                      a.languages.DFS(e[i], t, i, r))
                                    : ((r[a.util.objId(e[i])] = !0),
                                      a.languages.DFS(e[i], t, null, r)));
                    },
                },
                plugins: {},
                highlightAll: function (e, t) {
                    var n = {
                        callback: t,
                        selector:
                            'code[class*="language-"], [class*="language-"] code, code[class*="lang-"], [class*="lang-"] code',
                    };
                    a.hooks.run("before-highlightall", n);
                    for (
                        var r,
                            i =
                                n.elements ||
                                document.querySelectorAll(n.selector),
                            s = 0;
                        (r = i[s++]);

                    )
                        a.highlightElement(r, e === !0, n.callback);
                },
                highlightElement: function (t, n, r) {
                    for (var i, s, l = t; l && !e.test(l.className); )
                        l = l.parentNode;
                    l &&
                        ((i = (l.className.match(e) || [
                            ,
                            "",
                        ])[1].toLowerCase()),
                        (s = a.languages[i])),
                        (t.className =
                            t.className.replace(e, "").replace(/\s+/g, " ") +
                            " language-" +
                            i),
                        (l = t.parentNode),
                        /pre/i.test(l.nodeName) &&
                            (l.className =
                                l.className
                                    .replace(e, "")
                                    .replace(/\s+/g, " ") +
                                " language-" +
                                i);
                    var o = t.textContent,
                        u = { element: t, language: i, grammar: s, code: o };
                    if (
                        (a.hooks.run("before-sanity-check", u),
                        !u.code || !u.grammar)
                    )
                        return (
                            u.code && (u.element.textContent = u.code),
                            void a.hooks.run("complete", u)
                        );
                    if (
                        (a.hooks.run("before-highlight", u), n && _self.Worker)
                    ) {
                        var g = new Worker(a.filename);
                        (g.onmessage = function (e) {
                            (u.highlightedCode = e.data),
                                a.hooks.run("before-insert", u),
                                (u.element.innerHTML = u.highlightedCode),
                                r && r.call(u.element),
                                a.hooks.run("after-highlight", u),
                                a.hooks.run("complete", u);
                        }),
                            g.postMessage(
                                JSON.stringify({
                                    language: u.language,
                                    code: u.code,
                                    immediateClose: !0,
                                })
                            );
                    } else
                        (u.highlightedCode = a.highlight(
                            u.code,
                            u.grammar,
                            u.language
                        )),
                            a.hooks.run("before-insert", u),
                            (u.element.innerHTML = u.highlightedCode),
                            r && r.call(t),
                            a.hooks.run("after-highlight", u),
                            a.hooks.run("complete", u);
                },
                highlight: function (e, t, r) {
                    var i = a.tokenize(e, t);
                    return n.stringify(a.util.encode(i), r);
                },
                tokenize: function (e, t, n) {
                    var r = a.Token,
                        i = [e],
                        s = t.rest;
                    if (s) {
                        for (var l in s) t[l] = s[l];
                        delete t.rest;
                    }
                    e: for (var l in t)
                        if (t.hasOwnProperty(l) && t[l]) {
                            var o = t[l];
                            o = "Array" === a.util.type(o) ? o : [o];
                            for (var u = 0; u < o.length; ++u) {
                                var g = o[u],
                                    c = g.inside,
                                    p = !!g.lookbehind,
                                    d = !!g.greedy,
                                    m = 0,
                                    h = g.alias;
                                if (d && !g.pattern.global) {
                                    var f = g.pattern
                                        .toString()
                                        .match(/[imuy]*$/)[0];
                                    g.pattern = RegExp(
                                        g.pattern.source,
                                        f + "g"
                                    );
                                }
                                g = g.pattern || g;
                                for (
                                    var y = 0, b = 0;
                                    y < i.length;
                                    b += i[y].length, ++y
                                ) {
                                    var v = i[y];
                                    if (i.length > e.length) break e;
                                    if (!(v instanceof r)) {
                                        g.lastIndex = 0;
                                        var w = g.exec(v),
                                            k = 1;
                                        if (!w && d && y != i.length - 1) {
                                            if (
                                                ((g.lastIndex = b),
                                                (w = g.exec(e)),
                                                !w)
                                            )
                                                break;
                                            for (
                                                var P =
                                                        w.index +
                                                        (p ? w[1].length : 0),
                                                    x = w.index + w[0].length,
                                                    A = y,
                                                    j = b,
                                                    _ = i.length;
                                                A < _ && j < x;
                                                ++A
                                            )
                                                (j += i[A].length),
                                                    P >= j && (++y, (b = j));
                                            if (
                                                i[y] instanceof r ||
                                                i[A - 1].greedy
                                            )
                                                continue;
                                            (k = A - y),
                                                (v = e.slice(b, j)),
                                                (w.index -= b);
                                        }
                                        if (w) {
                                            p && (m = w[1].length);
                                            var P = w.index + m,
                                                w = w[0].slice(m),
                                                x = P + w.length,
                                                C = v.slice(0, P),
                                                E = v.slice(x),
                                                N = [y, k];
                                            C && N.push(C);
                                            var S = new r(
                                                l,
                                                c ? a.tokenize(w, c) : w,
                                                h,
                                                w,
                                                d
                                            );
                                            N.push(S),
                                                E && N.push(E),
                                                Array.prototype.splice.apply(
                                                    i,
                                                    N
                                                );
                                        }
                                    }
                                }
                            }
                        }
                    return i;
                },
                hooks: {
                    all: {},
                    add: function (e, t) {
                        var n = a.hooks.all;
                        (n[e] = n[e] || []), n[e].push(t);
                    },
                    run: function (e, t) {
                        var n = a.hooks.all[e];
                        if (n && n.length)
                            for (var r, i = 0; (r = n[i++]); ) r(t);
                    },
                },
            }),
            n = (a.Token = function (e, t, a, n, r) {
                (this.type = e),
                    (this.content = t),
                    (this.alias = a),
                    (this.length = 0 | (n || "").length),
                    (this.greedy = !!r);
            });
        if (
            ((n.stringify = function (e, t, r) {
                if ("string" == typeof e) return e;
                if ("Array" === a.util.type(e))
                    return e
                        .map(function (a) {
                            return n.stringify(a, t, e);
                        })
                        .join("");
                var i = {
                    type: e.type,
                    content: n.stringify(e.content, t, r),
                    tag: "span",
                    classes: ["token", e.type],
                    attributes: {},
                    language: t,
                    parent: r,
                };
                if (
                    ("comment" == i.type && (i.attributes.spellcheck = "true"),
                    e.alias)
                ) {
                    var s =
                        "Array" === a.util.type(e.alias) ? e.alias : [e.alias];
                    Array.prototype.push.apply(i.classes, s);
                }
                a.hooks.run("wrap", i);
                var l = Object.keys(i.attributes)
                    .map(function (e) {
                        return (
                            e +
                            '="' +
                            (i.attributes[e] || "").replace(/"/g, "&quot;") +
                            '"'
                        );
                    })
                    .join(" ");
                return (
                    "<" +
                    i.tag +
                    ' class="' +
                    i.classes.join(" ") +
                    '"' +
                    (l ? " " + l : "") +
                    ">" +
                    i.content +
                    "</" +
                    i.tag +
                    ">"
                );
            }),
            !_self.document)
        )
            return _self.addEventListener
                ? (_self.addEventListener(
                      "message",
                      function (e) {
                          var t = JSON.parse(e.data),
                              n = t.language,
                              r = t.code,
                              i = t.immediateClose;
                          _self.postMessage(a.highlight(r, a.languages[n], n)),
                              i && _self.close();
                      },
                      !1
                  ),
                  _self.Prism)
                : _self.Prism;
        var r =
            document.currentScript ||
            [].slice.call(document.getElementsByTagName("script")).pop();
        return (
            r &&
                ((a.filename = r.src),
                document.addEventListener &&
                    !r.hasAttribute("data-manual") &&
                    ("loading" !== document.readyState
                        ? window.requestAnimationFrame
                            ? window.requestAnimationFrame(a.highlightAll)
                            : window.setTimeout(a.highlightAll, 16)
                        : document.addEventListener(
                              "DOMContentLoaded",
                              a.highlightAll
                          ))),
            _self.Prism
        );
    })();
"undefined" != typeof module && module.exports && (module.exports = Prism),
    "undefined" != typeof global && (global.Prism = Prism),
    (Prism.languages.markup = {
        comment: /<!--[\w\W]*?-->/,
        prolog: /<\?[\w\W]+?\?>/,
        doctype: /<!DOCTYPE[\w\W]+?>/i,
        cdata: /<!\[CDATA\[[\w\W]*?]]>/i,
        tag: {
            pattern:
                /<\/?(?!\d)[^\s>\/=$<]+(?:\s+[^\s>\/=]+(?:=(?:("|')(?:\\\1|\\?(?!\1)[\w\W])*\1|[^\s'">=]+))?)*\s*\/?>/i,
            inside: {
                tag: {
                    pattern: /^<\/?[^\s>\/]+/i,
                    inside: { punctuation: /^<\/?/, namespace: /^[^\s>\/:]+:/ },
                },
                "attr-value": {
                    pattern: /=(?:('|")[\w\W]*?(\1)|[^\s>]+)/i,
                    inside: { punctuation: /[=>"']/ },
                },
                punctuation: /\/?>/,
                "attr-name": {
                    pattern: /[^\s>\/]+/,
                    inside: { namespace: /^[^\s>\/:]+:/ },
                },
            },
        },
        entity: /&#?[\da-z]{1,8};/i,
    }),
    Prism.hooks.add("wrap", function (e) {
        "entity" === e.type &&
            (e.attributes.title = e.content.replace(/&amp;/, "&"));
    }),
    (Prism.languages.xml = Prism.languages.markup),
    (Prism.languages.html = Prism.languages.markup),
    (Prism.languages.mathml = Prism.languages.markup),
    (Prism.languages.svg = Prism.languages.markup),
    (Prism.languages.css = {
        comment: /\/\*[\w\W]*?\*\//,
        atrule: {
            pattern: /@[\w-]+?.*?(;|(?=\s*\{))/i,
            inside: { rule: /@[\w-]+/ },
        },
        url: /url\((?:(["'])(\\(?:\r\n|[\w\W])|(?!\1)[^\\\r\n])*\1|.*?)\)/i,
        selector: /[^\{\}\s][^\{\};]*?(?=\s*\{)/,
        string: {
            pattern: /("|')(\\(?:\r\n|[\w\W])|(?!\1)[^\\\r\n])*\1/,
            greedy: !0,
        },
        property: /(\b|\B)[\w-]+(?=\s*:)/i,
        important: /\B!important\b/i,
        function: /[-a-z0-9]+(?=\()/i,
        punctuation: /[(){};:]/,
    }),
    (Prism.languages.css.atrule.inside.rest = Prism.util.clone(
        Prism.languages.css
    )),
    Prism.languages.markup &&
        (Prism.languages.insertBefore("markup", "tag", {
            style: {
                pattern: /(<style[\w\W]*?>)[\w\W]*?(?=<\/style>)/i,
                lookbehind: !0,
                inside: Prism.languages.css,
                alias: "language-css",
            },
        }),
        Prism.languages.insertBefore(
            "inside",
            "attr-value",
            {
                "style-attr": {
                    pattern: /\s*style=("|').*?\1/i,
                    inside: {
                        "attr-name": {
                            pattern: /^\s*style/i,
                            inside: Prism.languages.markup.tag.inside,
                        },
                        punctuation: /^\s*=\s*['"]|['"]\s*$/,
                        "attr-value": {
                            pattern: /.+/i,
                            inside: Prism.languages.css,
                        },
                    },
                    alias: "language-css",
                },
            },
            Prism.languages.markup.tag
        )),
    (Prism.languages.clike = {
        comment: [
            { pattern: /(^|[^\\])\/\*[\w\W]*?\*\//, lookbehind: !0 },
            { pattern: /(^|[^\\:])\/\/.*/, lookbehind: !0 },
        ],
        string: {
            pattern: /(["'])(\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1/,
            greedy: !0,
        },
        "class-name": {
            pattern:
                /((?:\b(?:class|interface|extends|implements|trait|instanceof|new)\s+)|(?:catch\s+\())[a-z0-9_\.\\]+/i,
            lookbehind: !0,
            inside: { punctuation: /(\.|\\)/ },
        },
        keyword:
            /\b(if|else|while|do|for|return|in|instanceof|function|new|try|throw|catch|finally|null|break|continue)\b/,
        boolean: /\b(true|false)\b/,
        function: /[a-z0-9_]+(?=\()/i,
        number: /\b-?(?:0x[\da-f]+|\d*\.?\d+(?:e[+-]?\d+)?)\b/i,
        operator: /--?|\+\+?|!=?=?|<=?|>=?|==?=?|&&?|\|\|?|\?|\*|\/|~|\^|%/,
        punctuation: /[{}[\];(),.:]/,
    }),
    (Prism.languages.javascript = Prism.languages.extend("clike", {
        keyword:
            /\b(as|async|await|break|case|catch|class|const|continue|debugger|default|delete|do|else|enum|export|extends|finally|for|from|function|get|if|implements|import|in|instanceof|interface|let|new|null|of|package|private|protected|public|return|set|static|super|switch|this|throw|try|typeof|var|void|while|with|yield)\b/,
        number: /\b-?(0x[\dA-Fa-f]+|0b[01]+|0o[0-7]+|\d*\.?\d+([Ee][+-]?\d+)?|NaN|Infinity)\b/,
        function: /[_$a-zA-Z\xA0-\uFFFF][_$a-zA-Z0-9\xA0-\uFFFF]*(?=\()/i,
        operator:
            /--?|\+\+?|!=?=?|<=?|>=?|==?=?|&&?|\|\|?|\?|\*\*?|\/|~|\^|%|\.{3}/,
    })),
    Prism.languages.insertBefore("javascript", "keyword", {
        regex: {
            pattern:
                /(^|[^\/])\/(?!\/)(\[.+?]|\\.|[^\/\\\r\n])+\/[gimyu]{0,5}(?=\s*($|[\r\n,.;})]))/,
            lookbehind: !0,
            greedy: !0,
        },
    }),
    Prism.languages.insertBefore("javascript", "string", {
        "template-string": {
            pattern: /`(?:\\\\|\\?[^\\])*?`/,
            greedy: !0,
            inside: {
                interpolation: {
                    pattern: /\$\{[^}]+\}/,
                    inside: {
                        "interpolation-punctuation": {
                            pattern: /^\$\{|\}$/,
                            alias: "punctuation",
                        },
                        rest: Prism.languages.javascript,
                    },
                },
                string: /[\s\S]+/,
            },
        },
    }),
    Prism.languages.markup &&
        Prism.languages.insertBefore("markup", "tag", {
            script: {
                pattern: /(<script[\w\W]*?>)[\w\W]*?(?=<\/script>)/i,
                lookbehind: !0,
                inside: Prism.languages.javascript,
                alias: "language-javascript",
            },
        }),
    (Prism.languages.js = Prism.languages.javascript),
    (function () {
        "undefined" != typeof self &&
            self.Prism &&
            self.document &&
            document.querySelector &&
            ((self.Prism.fileHighlight = function () {
                var e = {
                    js: "javascript",
                    py: "python",
                    rb: "ruby",
                    ps1: "powershell",
                    psm1: "powershell",
                    sh: "bash",
                    bat: "batch",
                    h: "c",
                    tex: "latex",
                };
                Array.prototype.forEach &&
                    Array.prototype.slice
                        .call(document.querySelectorAll("pre[data-src]"))
                        .forEach(function (t) {
                            for (
                                var a,
                                    n = t.getAttribute("data-src"),
                                    r = t,
                                    i = /\blang(?:uage)?-(?!\*)(\w+)\b/i;
                                r && !i.test(r.className);

                            )
                                r = r.parentNode;
                            if (
                                (r && (a = (t.className.match(i) || [, ""])[1]),
                                !a)
                            ) {
                                var s = (n.match(/\.(\w+)$/) || [, ""])[1];
                                a = e[s] || s;
                            }
                            var l = document.createElement("code");
                            (l.className = "language-" + a),
                                (t.textContent = ""),
                                (l.textContent = "Loading…"),
                                t.appendChild(l);
                            var o = new XMLHttpRequest();
                            o.open("GET", n, !0),
                                (o.onreadystatechange = function () {
                                    4 == o.readyState &&
                                        (o.status < 400 && o.responseText
                                            ? ((l.textContent = o.responseText),
                                              Prism.highlightElement(l))
                                            : o.status >= 400
                                            ? (l.textContent =
                                                  "✖ Error " +
                                                  o.status +
                                                  " while fetching file: " +
                                                  o.statusText)
                                            : (l.textContent =
                                                  "✖ Error: File does not exist or is empty"));
                                }),
                                o.send(null);
                        });
            }),
            document.addEventListener(
                "DOMContentLoaded",
                self.Prism.fileHighlight
            ));
    })();
