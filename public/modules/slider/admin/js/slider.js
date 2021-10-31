/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 15);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./Modules/Slider/Resources/assets/admin/js/Slide.js":
/*!***********************************************************!*\
  !*** ./Modules/Slider/Resources/assets/admin/js/Slide.js ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"default\", function() { return _default; });\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\nfunction _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if (\"value\" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }\n\nfunction _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }\n\nvar _default = /*#__PURE__*/function () {\n  function _default(data) {\n    _classCallCheck(this, _default);\n\n    this.slidePanelHtml = this.getSlidePanelHtml(data);\n  }\n\n  _createClass(_default, [{\n    key: \"getSlidePanelHtml\",\n    value: function getSlidePanelHtml(data) {\n      data.slide.options = data.slide.options || this.getDefaultOptions();\n\n      var template = _.template($('#slide-template').html());\n\n      return $(template(data));\n    }\n  }, {\n    key: \"getDefaultOptions\",\n    value: function getDefaultOptions() {\n      return {\n        caption_1: {},\n        caption_2: {},\n        direction: 'left',\n        call_to_action: {}\n      };\n    }\n  }, {\n    key: \"render\",\n    value: function render() {\n      this.attachEventListeners();\n      this.showSelectedOptionBlock();\n      return this.slidePanelHtml;\n    }\n  }, {\n    key: \"attachEventListeners\",\n    value: function attachEventListeners() {\n      var _this = this;\n\n      this.slidePanelHtml.find('.delete-slide').on('click', function () {\n        _this.slidePanelHtml.remove();\n      });\n      this.slidePanelHtml.find('.change-option-block').on('change', function (e) {\n        _this.slidePanelHtml.find('.slide-options').hide();\n\n        _this.slidePanelHtml.find(\".\".concat(e.currentTarget.value)).show();\n      });\n    }\n  }, {\n    key: \"showSelectedOptionBlock\",\n    value: function showSelectedOptionBlock() {\n      var _this2 = this;\n\n      setTimeout(function () {\n        _this2.slidePanelHtml.find('.change-option-block').trigger('change');\n      });\n    }\n  }]);\n\n  return _default;\n}();\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9Nb2R1bGVzL1NsaWRlci9SZXNvdXJjZXMvYXNzZXRzL2FkbWluL2pzL1NsaWRlLmpzPzJjMjciXSwibmFtZXMiOlsiZGF0YSIsInNsaWRlUGFuZWxIdG1sIiwiZ2V0U2xpZGVQYW5lbEh0bWwiLCJzbGlkZSIsIm9wdGlvbnMiLCJnZXREZWZhdWx0T3B0aW9ucyIsInRlbXBsYXRlIiwiXyIsIiQiLCJodG1sIiwiY2FwdGlvbl8xIiwiY2FwdGlvbl8yIiwiZGlyZWN0aW9uIiwiY2FsbF90b19hY3Rpb24iLCJhdHRhY2hFdmVudExpc3RlbmVycyIsInNob3dTZWxlY3RlZE9wdGlvbkJsb2NrIiwiZmluZCIsIm9uIiwicmVtb3ZlIiwiZSIsImhpZGUiLCJjdXJyZW50VGFyZ2V0IiwidmFsdWUiLCJzaG93Iiwic2V0VGltZW91dCIsInRyaWdnZXIiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7OztBQUNJLG9CQUFZQSxJQUFaLEVBQWtCO0FBQUE7O0FBQ2QsU0FBS0MsY0FBTCxHQUFzQixLQUFLQyxpQkFBTCxDQUF1QkYsSUFBdkIsQ0FBdEI7QUFDSDs7OztXQUVELDJCQUFrQkEsSUFBbEIsRUFBd0I7QUFDcEJBLFVBQUksQ0FBQ0csS0FBTCxDQUFXQyxPQUFYLEdBQXFCSixJQUFJLENBQUNHLEtBQUwsQ0FBV0MsT0FBWCxJQUFzQixLQUFLQyxpQkFBTCxFQUEzQzs7QUFFQSxVQUFJQyxRQUFRLEdBQUdDLENBQUMsQ0FBQ0QsUUFBRixDQUFXRSxDQUFDLENBQUMsaUJBQUQsQ0FBRCxDQUFxQkMsSUFBckIsRUFBWCxDQUFmOztBQUVBLGFBQU9ELENBQUMsQ0FBQ0YsUUFBUSxDQUFDTixJQUFELENBQVQsQ0FBUjtBQUNIOzs7V0FFRCw2QkFBb0I7QUFDaEIsYUFBTztBQUFFVSxpQkFBUyxFQUFFLEVBQWI7QUFBaUJDLGlCQUFTLEVBQUUsRUFBNUI7QUFBZ0NDLGlCQUFTLEVBQUUsTUFBM0M7QUFBbURDLHNCQUFjLEVBQUU7QUFBbkUsT0FBUDtBQUNIOzs7V0FFRCxrQkFBUztBQUNMLFdBQUtDLG9CQUFMO0FBQ0EsV0FBS0MsdUJBQUw7QUFFQSxhQUFPLEtBQUtkLGNBQVo7QUFDSDs7O1dBRUQsZ0NBQXVCO0FBQUE7O0FBQ25CLFdBQUtBLGNBQUwsQ0FBb0JlLElBQXBCLENBQXlCLGVBQXpCLEVBQTBDQyxFQUExQyxDQUE2QyxPQUE3QyxFQUFzRCxZQUFNO0FBQ3hELGFBQUksQ0FBQ2hCLGNBQUwsQ0FBb0JpQixNQUFwQjtBQUNILE9BRkQ7QUFJQSxXQUFLakIsY0FBTCxDQUFvQmUsSUFBcEIsQ0FBeUIsc0JBQXpCLEVBQWlEQyxFQUFqRCxDQUFvRCxRQUFwRCxFQUE4RCxVQUFDRSxDQUFELEVBQU87QUFDakUsYUFBSSxDQUFDbEIsY0FBTCxDQUFvQmUsSUFBcEIsQ0FBeUIsZ0JBQXpCLEVBQTJDSSxJQUEzQzs7QUFDQSxhQUFJLENBQUNuQixjQUFMLENBQW9CZSxJQUFwQixZQUE2QkcsQ0FBQyxDQUFDRSxhQUFGLENBQWdCQyxLQUE3QyxHQUFzREMsSUFBdEQ7QUFDSCxPQUhEO0FBSUg7OztXQUVELG1DQUEwQjtBQUFBOztBQUN0QkMsZ0JBQVUsQ0FBQyxZQUFNO0FBQ2IsY0FBSSxDQUFDdkIsY0FBTCxDQUFvQmUsSUFBcEIsQ0FBeUIsc0JBQXpCLEVBQWlEUyxPQUFqRCxDQUF5RCxRQUF6RDtBQUNILE9BRlMsQ0FBVjtBQUdIIiwiZmlsZSI6Ii4vTW9kdWxlcy9TbGlkZXIvUmVzb3VyY2VzL2Fzc2V0cy9hZG1pbi9qcy9TbGlkZS5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbImV4cG9ydCBkZWZhdWx0IGNsYXNzIHtcbiAgICBjb25zdHJ1Y3RvcihkYXRhKSB7XG4gICAgICAgIHRoaXMuc2xpZGVQYW5lbEh0bWwgPSB0aGlzLmdldFNsaWRlUGFuZWxIdG1sKGRhdGEpO1xuICAgIH1cblxuICAgIGdldFNsaWRlUGFuZWxIdG1sKGRhdGEpIHtcbiAgICAgICAgZGF0YS5zbGlkZS5vcHRpb25zID0gZGF0YS5zbGlkZS5vcHRpb25zIHx8IHRoaXMuZ2V0RGVmYXVsdE9wdGlvbnMoKTtcblxuICAgICAgICBsZXQgdGVtcGxhdGUgPSBfLnRlbXBsYXRlKCQoJyNzbGlkZS10ZW1wbGF0ZScpLmh0bWwoKSk7XG5cbiAgICAgICAgcmV0dXJuICQodGVtcGxhdGUoZGF0YSkpO1xuICAgIH1cblxuICAgIGdldERlZmF1bHRPcHRpb25zKCkge1xuICAgICAgICByZXR1cm4geyBjYXB0aW9uXzE6IHt9LCBjYXB0aW9uXzI6IHt9LCBkaXJlY3Rpb246ICdsZWZ0JywgY2FsbF90b19hY3Rpb246IHt9IH07XG4gICAgfVxuXG4gICAgcmVuZGVyKCkge1xuICAgICAgICB0aGlzLmF0dGFjaEV2ZW50TGlzdGVuZXJzKCk7XG4gICAgICAgIHRoaXMuc2hvd1NlbGVjdGVkT3B0aW9uQmxvY2soKTtcblxuICAgICAgICByZXR1cm4gdGhpcy5zbGlkZVBhbmVsSHRtbDtcbiAgICB9XG5cbiAgICBhdHRhY2hFdmVudExpc3RlbmVycygpIHtcbiAgICAgICAgdGhpcy5zbGlkZVBhbmVsSHRtbC5maW5kKCcuZGVsZXRlLXNsaWRlJykub24oJ2NsaWNrJywgKCkgPT4ge1xuICAgICAgICAgICAgdGhpcy5zbGlkZVBhbmVsSHRtbC5yZW1vdmUoKTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgdGhpcy5zbGlkZVBhbmVsSHRtbC5maW5kKCcuY2hhbmdlLW9wdGlvbi1ibG9jaycpLm9uKCdjaGFuZ2UnLCAoZSkgPT4ge1xuICAgICAgICAgICAgdGhpcy5zbGlkZVBhbmVsSHRtbC5maW5kKCcuc2xpZGUtb3B0aW9ucycpLmhpZGUoKTtcbiAgICAgICAgICAgIHRoaXMuc2xpZGVQYW5lbEh0bWwuZmluZChgLiR7ZS5jdXJyZW50VGFyZ2V0LnZhbHVlfWApLnNob3coKTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgc2hvd1NlbGVjdGVkT3B0aW9uQmxvY2soKSB7XG4gICAgICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICAgICAgdGhpcy5zbGlkZVBhbmVsSHRtbC5maW5kKCcuY2hhbmdlLW9wdGlvbi1ibG9jaycpLnRyaWdnZXIoJ2NoYW5nZScpO1xuICAgICAgICB9KTtcbiAgICB9XG59XG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./Modules/Slider/Resources/assets/admin/js/Slide.js\n");

/***/ }),

/***/ "./Modules/Slider/Resources/assets/admin/js/Slider.js":
/*!************************************************************!*\
  !*** ./Modules/Slider/Resources/assets/admin/js/Slider.js ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"default\", function() { return _default; });\n/* harmony import */ var _Slide__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Slide */ \"./Modules/Slider/Resources/assets/admin/js/Slide.js\");\nfunction _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== \"undefined\" && o[Symbol.iterator] || o[\"@@iterator\"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === \"number\") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError(\"Invalid attempt to iterate non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it[\"return\"] != null) it[\"return\"](); } finally { if (didErr) throw err; } } }; }\n\nfunction _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === \"string\") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === \"Object\" && o.constructor) n = o.constructor.name; if (n === \"Map\" || n === \"Set\") return Array.from(o); if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }\n\nfunction _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }\n\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\nfunction _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if (\"value\" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }\n\nfunction _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }\n\n\n\nvar _default = /*#__PURE__*/function () {\n  function _default() {\n    _classCallCheck(this, _default);\n\n    this.slideCount = 0;\n    this.addSlides(FleetCart.data['slider.slides']);\n\n    if (this.slideCount === 0) {\n      this.addSlide();\n    }\n\n    this.attachEventListeners();\n    this.makeSlidesSortable();\n  }\n\n  _createClass(_default, [{\n    key: \"addSlides\",\n    value: function addSlides(slides) {\n      var _iterator = _createForOfIteratorHelper(slides),\n          _step;\n\n      try {\n        for (_iterator.s(); !(_step = _iterator.n()).done;) {\n          var attributes = _step.value;\n          this.addSlide(attributes);\n        }\n      } catch (err) {\n        _iterator.e(err);\n      } finally {\n        _iterator.f();\n      }\n    }\n  }, {\n    key: \"addSlide\",\n    value: function addSlide() {\n      var attributes = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};\n      var slide = new _Slide__WEBPACK_IMPORTED_MODULE_0__[\"default\"]({\n        slideNumber: this.slideCount++,\n        slide: attributes\n      });\n      $('#slides-wrapper').append(slide.render());\n    }\n  }, {\n    key: \"attachEventListeners\",\n    value: function attachEventListeners() {\n      var _this = this;\n\n      $('.add-slide').on('click', function () {\n        _this.addSlide();\n      });\n      this.attachImagePickerEventListener();\n    }\n  }, {\n    key: \"attachImagePickerEventListener\",\n    value: function attachImagePickerEventListener() {\n      $('#slides-wrapper').on('click', '.slide-image', function (e) {\n        var picker = new MediaPicker({\n          type: 'image'\n        });\n        picker.on('select', function (file) {\n          var html = \"\\n                    <img src=\\\"\".concat(file.path, \"\\\">\\n                    <input type=\\\"hidden\\\" name=\\\"slides[\").concat(e.currentTarget.dataset.slideNumber, \"][file_id]\\\" value=\\\"\").concat(file.id, \"\\\">\\n                \");\n          $(e.currentTarget).html(html);\n        });\n      });\n    }\n  }, {\n    key: \"makeSlidesSortable\",\n    value: function makeSlidesSortable() {\n      Sortable.create(document.getElementById('slides-wrapper'), {\n        handle: '.slide-drag',\n        animation: 150\n      });\n    }\n  }]);\n\n  return _default;\n}();\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9Nb2R1bGVzL1NsaWRlci9SZXNvdXJjZXMvYXNzZXRzL2FkbWluL2pzL1NsaWRlci5qcz81ZjE0Il0sIm5hbWVzIjpbInNsaWRlQ291bnQiLCJhZGRTbGlkZXMiLCJGbGVldENhcnQiLCJkYXRhIiwiYWRkU2xpZGUiLCJhdHRhY2hFdmVudExpc3RlbmVycyIsIm1ha2VTbGlkZXNTb3J0YWJsZSIsInNsaWRlcyIsImF0dHJpYnV0ZXMiLCJzbGlkZSIsIlNsaWRlIiwic2xpZGVOdW1iZXIiLCIkIiwiYXBwZW5kIiwicmVuZGVyIiwib24iLCJhdHRhY2hJbWFnZVBpY2tlckV2ZW50TGlzdGVuZXIiLCJlIiwicGlja2VyIiwiTWVkaWFQaWNrZXIiLCJ0eXBlIiwiZmlsZSIsImh0bWwiLCJwYXRoIiwiY3VycmVudFRhcmdldCIsImRhdGFzZXQiLCJpZCIsIlNvcnRhYmxlIiwiY3JlYXRlIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsImhhbmRsZSIsImFuaW1hdGlvbiJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7Ozs7O0FBQUE7OztBQUdJLHNCQUFjO0FBQUE7O0FBQ1YsU0FBS0EsVUFBTCxHQUFrQixDQUFsQjtBQUVBLFNBQUtDLFNBQUwsQ0FBZUMsU0FBUyxDQUFDQyxJQUFWLENBQWUsZUFBZixDQUFmOztBQUVBLFFBQUksS0FBS0gsVUFBTCxLQUFvQixDQUF4QixFQUEyQjtBQUN2QixXQUFLSSxRQUFMO0FBQ0g7O0FBRUQsU0FBS0Msb0JBQUw7QUFDQSxTQUFLQyxrQkFBTDtBQUNIOzs7O1dBRUQsbUJBQVVDLE1BQVYsRUFBa0I7QUFBQSxpREFDU0EsTUFEVDtBQUFBOztBQUFBO0FBQ2QsNERBQStCO0FBQUEsY0FBdEJDLFVBQXNCO0FBQzNCLGVBQUtKLFFBQUwsQ0FBY0ksVUFBZDtBQUNIO0FBSGE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUlqQjs7O1dBRUQsb0JBQTBCO0FBQUEsVUFBakJBLFVBQWlCLHVFQUFKLEVBQUk7QUFDdEIsVUFBSUMsS0FBSyxHQUFHLElBQUlDLDhDQUFKLENBQVU7QUFBRUMsbUJBQVcsRUFBRSxLQUFLWCxVQUFMLEVBQWY7QUFBa0NTLGFBQUssRUFBRUQ7QUFBekMsT0FBVixDQUFaO0FBRUFJLE9BQUMsQ0FBQyxpQkFBRCxDQUFELENBQXFCQyxNQUFyQixDQUE0QkosS0FBSyxDQUFDSyxNQUFOLEVBQTVCO0FBQ0g7OztXQUVELGdDQUF1QjtBQUFBOztBQUNuQkYsT0FBQyxDQUFDLFlBQUQsQ0FBRCxDQUFnQkcsRUFBaEIsQ0FBbUIsT0FBbkIsRUFBNEIsWUFBTTtBQUM5QixhQUFJLENBQUNYLFFBQUw7QUFDSCxPQUZEO0FBSUEsV0FBS1ksOEJBQUw7QUFDSDs7O1dBRUQsMENBQWlDO0FBQzdCSixPQUFDLENBQUMsaUJBQUQsQ0FBRCxDQUFxQkcsRUFBckIsQ0FBd0IsT0FBeEIsRUFBaUMsY0FBakMsRUFBaUQsVUFBQ0UsQ0FBRCxFQUFPO0FBQ3BELFlBQUlDLE1BQU0sR0FBRyxJQUFJQyxXQUFKLENBQWdCO0FBQUVDLGNBQUksRUFBRTtBQUFSLFNBQWhCLENBQWI7QUFFQUYsY0FBTSxDQUFDSCxFQUFQLENBQVUsUUFBVixFQUFvQixVQUFDTSxJQUFELEVBQVU7QUFDMUIsY0FBSUMsSUFBSSw4Q0FDUUQsSUFBSSxDQUFDRSxJQURiLDJFQUVnQ04sQ0FBQyxDQUFDTyxhQUFGLENBQWdCQyxPQUFoQixDQUF3QmQsV0FGeEQsa0NBRXlGVSxJQUFJLENBQUNLLEVBRjlGLDBCQUFSO0FBS0FkLFdBQUMsQ0FBQ0ssQ0FBQyxDQUFDTyxhQUFILENBQUQsQ0FBbUJGLElBQW5CLENBQXdCQSxJQUF4QjtBQUNILFNBUEQ7QUFRSCxPQVhEO0FBWUg7OztXQUVELDhCQUFxQjtBQUNqQkssY0FBUSxDQUFDQyxNQUFULENBQWdCQyxRQUFRLENBQUNDLGNBQVQsQ0FBd0IsZ0JBQXhCLENBQWhCLEVBQTJEO0FBQ3ZEQyxjQUFNLEVBQUUsYUFEK0M7QUFFdkRDLGlCQUFTLEVBQUU7QUFGNEMsT0FBM0Q7QUFJSCIsImZpbGUiOiIuL01vZHVsZXMvU2xpZGVyL1Jlc291cmNlcy9hc3NldHMvYWRtaW4vanMvU2xpZGVyLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IFNsaWRlIGZyb20gJy4vU2xpZGUnO1xuXG5leHBvcnQgZGVmYXVsdCBjbGFzcyB7XG4gICAgY29uc3RydWN0b3IoKSB7XG4gICAgICAgIHRoaXMuc2xpZGVDb3VudCA9IDA7XG5cbiAgICAgICAgdGhpcy5hZGRTbGlkZXMoRmxlZXRDYXJ0LmRhdGFbJ3NsaWRlci5zbGlkZXMnXSk7XG5cbiAgICAgICAgaWYgKHRoaXMuc2xpZGVDb3VudCA9PT0gMCkge1xuICAgICAgICAgICAgdGhpcy5hZGRTbGlkZSgpO1xuICAgICAgICB9XG5cbiAgICAgICAgdGhpcy5hdHRhY2hFdmVudExpc3RlbmVycygpO1xuICAgICAgICB0aGlzLm1ha2VTbGlkZXNTb3J0YWJsZSgpO1xuICAgIH1cblxuICAgIGFkZFNsaWRlcyhzbGlkZXMpIHtcbiAgICAgICAgZm9yIChsZXQgYXR0cmlidXRlcyBvZiBzbGlkZXMpIHtcbiAgICAgICAgICAgIHRoaXMuYWRkU2xpZGUoYXR0cmlidXRlcyk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBhZGRTbGlkZShhdHRyaWJ1dGVzID0ge30pIHtcbiAgICAgICAgbGV0IHNsaWRlID0gbmV3IFNsaWRlKHsgc2xpZGVOdW1iZXI6IHRoaXMuc2xpZGVDb3VudCsrLCBzbGlkZTogYXR0cmlidXRlcyB9KTtcblxuICAgICAgICAkKCcjc2xpZGVzLXdyYXBwZXInKS5hcHBlbmQoc2xpZGUucmVuZGVyKCkpO1xuICAgIH1cblxuICAgIGF0dGFjaEV2ZW50TGlzdGVuZXJzKCkge1xuICAgICAgICAkKCcuYWRkLXNsaWRlJykub24oJ2NsaWNrJywgKCkgPT4ge1xuICAgICAgICAgICAgdGhpcy5hZGRTbGlkZSgpO1xuICAgICAgICB9KTtcblxuICAgICAgICB0aGlzLmF0dGFjaEltYWdlUGlja2VyRXZlbnRMaXN0ZW5lcigpO1xuICAgIH1cblxuICAgIGF0dGFjaEltYWdlUGlja2VyRXZlbnRMaXN0ZW5lcigpIHtcbiAgICAgICAgJCgnI3NsaWRlcy13cmFwcGVyJykub24oJ2NsaWNrJywgJy5zbGlkZS1pbWFnZScsIChlKSA9PiB7XG4gICAgICAgICAgICBsZXQgcGlja2VyID0gbmV3IE1lZGlhUGlja2VyKHsgdHlwZTogJ2ltYWdlJyB9KTtcblxuICAgICAgICAgICAgcGlja2VyLm9uKCdzZWxlY3QnLCAoZmlsZSkgPT4ge1xuICAgICAgICAgICAgICAgIGxldCBodG1sID0gYFxuICAgICAgICAgICAgICAgICAgICA8aW1nIHNyYz1cIiR7ZmlsZS5wYXRofVwiPlxuICAgICAgICAgICAgICAgICAgICA8aW5wdXQgdHlwZT1cImhpZGRlblwiIG5hbWU9XCJzbGlkZXNbJHtlLmN1cnJlbnRUYXJnZXQuZGF0YXNldC5zbGlkZU51bWJlcn1dW2ZpbGVfaWRdXCIgdmFsdWU9XCIke2ZpbGUuaWR9XCI+XG4gICAgICAgICAgICAgICAgYDtcblxuICAgICAgICAgICAgICAgICQoZS5jdXJyZW50VGFyZ2V0KS5odG1sKGh0bWwpO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIG1ha2VTbGlkZXNTb3J0YWJsZSgpIHtcbiAgICAgICAgU29ydGFibGUuY3JlYXRlKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzbGlkZXMtd3JhcHBlcicpLCB7XG4gICAgICAgICAgICBoYW5kbGU6ICcuc2xpZGUtZHJhZycsXG4gICAgICAgICAgICBhbmltYXRpb246IDE1MCxcbiAgICAgICAgfSk7XG4gICAgfVxufVxuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./Modules/Slider/Resources/assets/admin/js/Slider.js\n");

/***/ }),

/***/ "./Modules/Slider/Resources/assets/admin/js/main.js":
/*!**********************************************************!*\
  !*** ./Modules/Slider/Resources/assets/admin/js/main.js ***!
  \**********************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _Slider__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Slider */ \"./Modules/Slider/Resources/assets/admin/js/Slider.js\");\n\nnew _Slider__WEBPACK_IMPORTED_MODULE_0__[\"default\"]();\n$('#autoplay').on('change', function (e) {\n  $('.autoplay-speed-field').toggleClass('hide');\n});\nwindow.admin.removeSubmitButtonOffsetOn('#slides');//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9Nb2R1bGVzL1NsaWRlci9SZXNvdXJjZXMvYXNzZXRzL2FkbWluL2pzL21haW4uanM/MGY1NSJdLCJuYW1lcyI6WyJTbGlkZXIiLCIkIiwib24iLCJlIiwidG9nZ2xlQ2xhc3MiLCJ3aW5kb3ciLCJhZG1pbiIsInJlbW92ZVN1Ym1pdEJ1dHRvbk9mZnNldE9uIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUFBO0FBQUE7QUFFQSxJQUFJQSwrQ0FBSjtBQUVBQyxDQUFDLENBQUMsV0FBRCxDQUFELENBQWVDLEVBQWYsQ0FBa0IsUUFBbEIsRUFBNEIsVUFBQ0MsQ0FBRCxFQUFPO0FBQy9CRixHQUFDLENBQUMsdUJBQUQsQ0FBRCxDQUEyQkcsV0FBM0IsQ0FBdUMsTUFBdkM7QUFDSCxDQUZEO0FBSUFDLE1BQU0sQ0FBQ0MsS0FBUCxDQUFhQywwQkFBYixDQUF3QyxTQUF4QyIsImZpbGUiOiIuL01vZHVsZXMvU2xpZGVyL1Jlc291cmNlcy9hc3NldHMvYWRtaW4vanMvbWFpbi5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCBTbGlkZXIgZnJvbSAnLi9TbGlkZXInO1xuXG5uZXcgU2xpZGVyKCk7XG5cbiQoJyNhdXRvcGxheScpLm9uKCdjaGFuZ2UnLCAoZSkgPT4ge1xuICAgICQoJy5hdXRvcGxheS1zcGVlZC1maWVsZCcpLnRvZ2dsZUNsYXNzKCdoaWRlJyk7XG59KTtcblxud2luZG93LmFkbWluLnJlbW92ZVN1Ym1pdEJ1dHRvbk9mZnNldE9uKCcjc2xpZGVzJyk7XG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./Modules/Slider/Resources/assets/admin/js/main.js\n");

/***/ }),

/***/ 15:
/*!****************************************************************!*\
  !*** multi ./Modules/Slider/Resources/assets/admin/js/main.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/izshreyansh/sites/resinera/Modules/Slider/Resources/assets/admin/js/main.js */"./Modules/Slider/Resources/assets/admin/js/main.js");


/***/ })

/******/ });