"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, "_invoke", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, "_invoke", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var methodName = context.method, method = delegate.iterator[methodName]; if (undefined === method) return context.delegate = null, "throw" === methodName && delegate.iterator.return && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method) || "return" !== methodName && (context.method = "throw", context.arg = new TypeError("The iterator does not provide a '" + methodName + "' method")), ContinueSentinel; var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) keys.push(key); return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, catch: function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }
jQuery(function ($) {
  // Vars

  var select = $('.posts_filter_top');
  var filterTermsWrapper = $('.posts_filter_bottom');
  var categories = $('.post_categories');
  var filterPanel = $('.posts_filters_panel');
  var visualElementDelete = '.filter_panel_e_delete';
  var postsWrapper = $(".posts_grid_inner");
  var loadMoreButton = $(".load-more-filter");
  var loader = $('.loader-wrapper');
  var reset = $('.blog_reset');
  var controller = null;
  var init = function init() {
    visualPanel();
  };
  var popup = function popup(e) {
    var current = $(e.currentTarget);
    if (current.hasClass('open')) {
      current.removeClass('open');
      current.next(filterTermsWrapper).slideUp('fast', 'linear');
    } else {
      current.addClass('open');
      current.next(filterTermsWrapper).slideDown('fast', 'linear');
    }
  };
  var filter = function filter(e) {
    var currentTarget = $(e.currentTarget);
    var checked = currentTarget.prop('checked');
    var ID = currentTarget.val();
    var currentUrl = window.location.href;
    var url = new URL(currentUrl);

    // Add param to url

    if (checked === true) {
      urlApi(ID);
    } else {
      urlApi(ID, false);
    }

    // Request data 

    filterApi();

    // Add visual panel elem

    visualPanel();
  };
  var filterApi = /*#__PURE__*/function () {
    var _ref = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
      var loadMore,
        offset,
        signal,
        currentUrl,
        url,
        allParams,
        data,
        request,
        posts,
        _offset,
        total,
        _args = arguments;
      return _regeneratorRuntime().wrap(function _callee$(_context) {
        while (1) switch (_context.prev = _context.next) {
          case 0:
            loadMore = _args.length > 0 && _args[0] !== undefined ? _args[0] : false;
            offset = _args.length > 1 && _args[1] !== undefined ? _args[1] : null;
            if (controller) {
              controller.abort();
            }
            controller = new AbortController();
            signal = controller.signal;
            currentUrl = window.location.href;
            url = new URL(currentUrl);
            allParams = url.searchParams.get('cats');
            data = new FormData();
            if (allParams !== null) data.append('params', allParams);
            if (loadMore == true && offset !== null) {
              data.append('offset', offset);
            }
            data.append('nonce', theme.nonce);
            data.append('action', 'blog_filter');

            // Loader 

            loader.show();
            _context.next = 16;
            return fetch(theme.ajaxUrl, {
              method: "POST",
              body: data,
              signal: signal
            });
          case 16:
            request = _context.sent;
            if (request.ok) {
              _context.next = 19;
              break;
            }
            throw new Error("HTTP error! status: ".concat(request.status));
          case 19:
            _context.next = 21;
            return request.json();
          case 21:
            posts = _context.sent;
            controller = null;
            loader.hide();
            if (posts) {
              if (posts.status === 1) {
                if (loadMore !== true) postsWrapper.html('');
                postsWrapper.append(posts.html);

                // Update offset

                if (loadMore === true) {
                  _offset = postsWrapper.children().length;
                  url.searchParams.set('offset', _offset);
                  history.pushState({}, "", url);
                }
              } else {
                if (loadMore === false) {
                  // No results

                  postsWrapper.html("");
                  postsWrapper.html('<p class="filter_no_results"> No results for the given terms. </p>');
                }
              }
            }

            // Hide Load More When Needed
            total = postsWrapper.children().length;
            if (total >= posts.total) {
              loadMoreButton.addClass('hidden');
            } else {
              loadMoreButton.removeClass('hidden');
            }
          case 27:
          case "end":
            return _context.stop();
        }
      }, _callee);
    }));
    return function filterApi() {
      return _ref.apply(this, arguments);
    };
  }();
  var urlApi = function urlApi(cat) {
    var append = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
    var currentUrl = window.location.href;
    var url = new URL(currentUrl);
    url.searchParams.delete('offset');
    if (append === true) {
      var oldParams = url.searchParams.get('cats');
      if (oldParams !== null) {
        var newParams = oldParams.split('-');
        if (newParams.includes(cat) === false) newParams.push(cat);
        url.searchParams.set('cats', newParams.join('-'));
      } else {
        url.searchParams.set('cats', cat);
      }
    } else {
      var allParams = url.searchParams.get('cats');
      if (allParams !== null) {
        var allParamsSplit = allParams.split('-');
        if (allParamsSplit.includes(cat)) {
          var indexToDelete = allParamsSplit.indexOf(cat);
          allParamsSplit.splice(indexToDelete, 1);
          if (allParamsSplit.length) {
            url.searchParams.set('cats', allParamsSplit.join('-'));
          } else {
            url.searchParams.delete('cats');
          }
        }
      }
    }
    history.pushState({}, "", url);
  };
  var loadMoreApi = function loadMoreApi(e) {
    e.preventDefault();
    var offset = postsWrapper.children().length;
    filterApi(true, offset);
  };
  var visualPanel = function visualPanel() {
    filterPanel.html('');
    var currentUrl = window.location.href;
    var url = new URL(currentUrl);
    var allParams = url.searchParams.get('cats');
    if (allParams !== null) {
      var allParamsSplit = allParams.split('-');
      allParamsSplit.map(function (catID) {
        var visualElem = $("\n                <div> <span class=\"filter_panel_e_delete\">&#10005;</span></div>");
        visualElem.addClass('filter_panel_e');
        var checkbox = $('#' + catID + '');
        visualElem.attr('data-term-id', checkbox.val());
        visualElem.prepend($('label[for="' + checkbox.val() + '"]').text());
        filterPanel.append(visualElem);
      });

      // Reset button

      reset.show();
    } else {
      reset.hide();
    }
  };
  var visualPanelDelete = function visualPanelDelete(e) {
    var current = $(e.currentTarget);
    var currentID = current.closest('.filter_panel_e').data('term-id');
    $("#" + currentID + "").trigger('click');
  };

  // Events

  select.on('click', popup);
  categories.on('change', filter);
  $('body').on('click', visualElementDelete, visualPanelDelete);
  loadMoreButton.on("click", loadMoreApi);
  init();
});