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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/js/index.page.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/js/index.page.js":
/*!******************************!*\
  !*** ./src/js/index.page.js ***!
  \******************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _libs_responsiveParent__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./libs/responsiveParent */ "./src/js/libs/responsiveParent/index.js");
/* harmony import */ var _libs_customCheckbox__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./libs/customCheckbox */ "./src/js/libs/customCheckbox/index.js");
/* harmony import */ var _modules_subscribeForm__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/subscribeForm */ "./src/js/modules/subscribeForm/index.js");



window.addEventListener('load', function () {
  Object(_libs_responsiveParent__WEBPACK_IMPORTED_MODULE_0__["activateParent"])({
    childSelector: '.formTab-InputBlock__submit',
    parentSelector: '.formTab-InputBlock',
    parentClasses: {
      onChildHover: 'formTab-InputBlock--hasSubmitHover'
    }
  });
  Object(_libs_customCheckbox__WEBPACK_IMPORTED_MODULE_1__["addKeyboardBehavior"])({
    inputSelector: '.Checkbox__input',
    checkmarkSelector: '.Checkbox__checkmark'
  });
  Object(_modules_subscribeForm__WEBPACK_IMPORTED_MODULE_2__["activateForm"])();
});

/***/ }),

/***/ "./src/js/libs/customCheckbox/addKeyboardBehavior.js":
/*!***********************************************************!*\
  !*** ./src/js/libs/customCheckbox/addKeyboardBehavior.js ***!
  \***********************************************************/
/*! exports provided: addKeyboardBehavior */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "addKeyboardBehavior", function() { return addKeyboardBehavior; });
var ENTER_KEYS_CODE = 13;
var addKeyboardBehavior = function addKeyboardBehavior(_ref) {
  var inputSelector = _ref.inputSelector,
      checkmarkSelector = _ref.checkmarkSelector;
  var $input = document.querySelector(inputSelector);
  var $checkmark = document.querySelector(checkmarkSelector);
  $input.setAttribute('tabindex', -1);

  if (!$checkmark.hasAttribute('tabindex')) {
    $checkmark.setAttribute('tabindex', 0);
  }

  $checkmark.addEventListener('keypress', function (event) {
    if (event.keyCode !== ENTER_KEYS_CODE) {
      return;
    } // $input.checked = !$input.checked will not call onchange and
    //   oninput listenres, so I used .click()


    $input.click();
  });
};

/***/ }),

/***/ "./src/js/libs/customCheckbox/index.js":
/*!*********************************************!*\
  !*** ./src/js/libs/customCheckbox/index.js ***!
  \*********************************************/
/*! exports provided: addKeyboardBehavior */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _addKeyboardBehavior__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./addKeyboardBehavior */ "./src/js/libs/customCheckbox/addKeyboardBehavior.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "addKeyboardBehavior", function() { return _addKeyboardBehavior__WEBPACK_IMPORTED_MODULE_0__["addKeyboardBehavior"]; });



/***/ }),

/***/ "./src/js/libs/responsiveParent/activateParent.js":
/*!********************************************************!*\
  !*** ./src/js/libs/responsiveParent/activateParent.js ***!
  \********************************************************/
/*! exports provided: activateParent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "activateParent", function() { return activateParent; });
var activateParent = function activateParent(options) {
  var childSelector = options.childSelector,
      parentSelector = options.parentSelector,
      parentClasses = options.parentClasses;
  var onHoverClass = parentClasses === null || parentClasses === void 0 ? void 0 : parentClasses.onChildHover;
  var $child = document.querySelector(childSelector);
  var $parent = document.querySelector(parentSelector);

  if (onHoverClass) {
    $child.addEventListener('mouseover', function () {
      $parent.classList.add(onHoverClass);
    });
    $child.addEventListener('mouseout', function () {
      $parent.classList.remove(onHoverClass);
    });
  }
};

/***/ }),

/***/ "./src/js/libs/responsiveParent/index.js":
/*!***********************************************!*\
  !*** ./src/js/libs/responsiveParent/index.js ***!
  \***********************************************/
/*! exports provided: activateParent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _activateParent__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./activateParent */ "./src/js/libs/responsiveParent/activateParent.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "activateParent", function() { return _activateParent__WEBPACK_IMPORTED_MODULE_0__["activateParent"]; });



/***/ }),

/***/ "./src/js/modules/alert/errorModal.js":
/*!********************************************!*\
  !*** ./src/js/modules/alert/errorModal.js ***!
  \********************************************/
/*! exports provided: modal */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "modal", function() { return modal; });
var $target = document.querySelector('.ErrorModal');
var $textInput = $target.querySelector('.ErrorModal__text');
var classes = {
  visible: 'ErrorModal--visible',
  enabled: 'ErrorModal--enabled'
};
var modal = {
  print: function print(text) {
    $textInput.innerText = text;
    $target.classList.add(classes.enabled);
    $target.ontransitionend = null; // Wait for the styles of the .enabled class to be applied to
    //   the element.

    setTimeout(function () {
      $target.classList.add(classes.visible);
    }, 50);
  },
  hide: function hide() {
    $target.classList.remove(classes.visible);

    $target.ontransitionend = function () {
      $textInput.innerText = '';
      $target.classList.remove(classes.enabled);
    };
  },
  isActive: function isActive() {
    return $target.classList.contains(classes.visible);
  }
};

/***/ }),

/***/ "./src/js/modules/api/apiRequests.js":
/*!*******************************************!*\
  !*** ./src/js/modules/api/apiRequests.js ***!
  \*******************************************/
/*! exports provided: apiRequests */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "apiRequests", function() { return apiRequests; });
var URI_PREFIX = '/user-ajax';
var apiRequests = {
  post: function post(uri, params) {
    var fullUri = "".concat(URI_PREFIX).concat(uri);
    var bodyParams = JSON.stringify(params);
    return new Promise(function (resolve, reject) {
      var xhr = getStandardXmlHttpRequest(resolve, reject);
      xhr.open('POST', fullUri);
      xhr.send(bodyParams);
    });
  }
}; // All request types will have XMLHttpRequest with same settings
//   so I moved it into a separate function

function getStandardXmlHttpRequest(successCallback, failedCallback) {
  var xhr = new XMLHttpRequest();
  xhr.responseType = 'json';

  xhr.onload = function () {
    var _xhr$response;

    if (((_xhr$response = xhr.response) === null || _xhr$response === void 0 ? void 0 : _xhr$response.success) === true) {
      successCallback({
        httpStatus: xhr.status,
        response: xhr.response
      });
    } else {
      failedCallback({
        httpStatus: xhr.status,
        response: xhr.response
      });
    }
  };

  xhr.onerror = function () {
    failedCallback();
  };

  return xhr;
}

/***/ }),

/***/ "./src/js/modules/api/index.js":
/*!*************************************!*\
  !*** ./src/js/modules/api/index.js ***!
  \*************************************/
/*! exports provided: api */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "api", function() { return api; });
/* harmony import */ var _subscribers_subscribers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./subscribers/subscribers */ "./src/js/modules/api/subscribers/subscribers.js");

var api = {
  subscribers: _subscribers_subscribers__WEBPACK_IMPORTED_MODULE_0__["subscribers"]
};

/***/ }),

/***/ "./src/js/modules/api/subscribers/subscribers.js":
/*!*******************************************************!*\
  !*** ./src/js/modules/api/subscribers/subscribers.js ***!
  \*******************************************************/
/*! exports provided: subscribers */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "subscribers", function() { return subscribers; });
/* harmony import */ var _apiRequests__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../apiRequests */ "./src/js/modules/api/apiRequests.js");

var subscribers = {
  add: function add(email, isTermcAccept) {
    var params = {
      email: email,
      is_terms_accept: isTermcAccept
    };
    return new Promise(function (resolve, reject) {
      _apiRequests__WEBPACK_IMPORTED_MODULE_0__["apiRequests"].post('/subscribers/add', params).then(function (response) {
        return resolve(response);
      }).catch(function (err) {
        return reject(err);
      });
    });
  }
};

/***/ }),

/***/ "./src/js/modules/subscribeForm/activateForm.js":
/*!******************************************************!*\
  !*** ./src/js/modules/subscribeForm/activateForm.js ***!
  \******************************************************/
/*! exports provided: activateForm */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "activateForm", function() { return activateForm; });
/* harmony import */ var _modules_api__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ~modules/api */ "./src/js/modules/api/index.js");
/* harmony import */ var _modules_alert_errorModal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ~modules/alert/errorModal */ "./src/js/modules/alert/errorModal.js");
/* harmony import */ var _data_targets__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./data/targets */ "./src/js/modules/subscribeForm/data/targets.js");
/* harmony import */ var _getValidationResult__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./getValidationResult */ "./src/js/modules/subscribeForm/getValidationResult.js");
/* harmony import */ var _renderValidationResult__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./renderValidationResult */ "./src/js/modules/subscribeForm/renderValidationResult.js");
/* harmony import */ var _showGratitude__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./showGratitude */ "./src/js/modules/subscribeForm/showGratitude.js");






var activateForm = function activateForm() {
  _data_targets__WEBPACK_IMPORTED_MODULE_2__["submitButton"].target.addEventListener('click', onSubmit);
};
var canSend = true;
var validatedIn;

function onSubmit(event) {
  event.preventDefault();

  if (!canSend) {
    return;
  }

  validatedIn = 'BUTTON';
  var isValid = validateForm();

  if (!isValid) {
    canSend = false;
    _data_targets__WEBPACK_IMPORTED_MODULE_2__["emailInput"].target.addEventListener('input', onInput);
    _data_targets__WEBPACK_IMPORTED_MODULE_2__["termsCheckbox"].target.addEventListener('change', onInput);
    return;
  }

  var emailValue = _data_targets__WEBPACK_IMPORTED_MODULE_2__["emailInput"].target.value;
  var termsValue = _data_targets__WEBPACK_IMPORTED_MODULE_2__["termsCheckbox"].target.checked;
  _modules_api__WEBPACK_IMPORTED_MODULE_0__["api"].subscribers.add(emailValue, termsValue).then(function () {
    if (_modules_alert_errorModal__WEBPACK_IMPORTED_MODULE_1__["modal"].isActive()) {
      _modules_alert_errorModal__WEBPACK_IMPORTED_MODULE_1__["modal"].hide();
    }

    Object(_showGratitude__WEBPACK_IMPORTED_MODULE_5__["showGratitude"])();
  }).catch(function (err) {
    _modules_alert_errorModal__WEBPACK_IMPORTED_MODULE_1__["modal"].print('Ops!\n' + 'An error occurred on the server\n' + '(details can be viewed in the console)');
    console.log(err);
  });
}

function onInput() {
  validatedIn = 'INPUT';
  var isValid = validateForm();

  if (isValid) {
    canSend = true;
    _data_targets__WEBPACK_IMPORTED_MODULE_2__["emailInput"].target.removeEventListener('input', onInput);
    _data_targets__WEBPACK_IMPORTED_MODULE_2__["termsCheckbox"].target.removeEventListener('change', onInput);
  }
}

function validateForm() {
  var emailValue = _data_targets__WEBPACK_IMPORTED_MODULE_2__["emailInput"].target.value;
  var termsValue = _data_targets__WEBPACK_IMPORTED_MODULE_2__["termsCheckbox"].target.checked;
  var result = Object(_getValidationResult__WEBPACK_IMPORTED_MODULE_3__["getValidationResult"])(emailValue, termsValue);

  if (!result.isValid) {
    _renderValidationResult__WEBPACK_IMPORTED_MODULE_4__["render"].invalidResult(result.err.subject, result.err.message);
  } else {
    _renderValidationResult__WEBPACK_IMPORTED_MODULE_4__["render"].validResult(validatedIn === 'INPUT');
  }

  return result.isValid;
}

/***/ }),

/***/ "./src/js/modules/subscribeForm/data/errorMessages.js":
/*!************************************************************!*\
  !*** ./src/js/modules/subscribeForm/data/errorMessages.js ***!
  \************************************************************/
/*! exports provided: messages */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "messages", function() { return messages; });
var messages = {
  empty: 'Email address is required',
  invalid: 'Please provide a valid e-mail address',
  unchecked: 'You must accept the terms and conditions',
  colombia: 'We are not accepting subscriptions from Colombia emails'
};

/***/ }),

/***/ "./src/js/modules/subscribeForm/data/targets.js":
/*!******************************************************!*\
  !*** ./src/js/modules/subscribeForm/data/targets.js ***!
  \******************************************************/
/*! exports provided: inputBlock, emailInput, termsCheckbox, termsCheckmark, submitButton */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "inputBlock", function() { return inputBlock; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "emailInput", function() { return emailInput; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "termsCheckbox", function() { return termsCheckbox; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "termsCheckmark", function() { return termsCheckmark; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "submitButton", function() { return submitButton; });
var inputBlock = {
  target: document.querySelector('.formTab-InputBlock'),
  classes: {
    invalidEmail: 'formTab-InputBlock--hasInvalidEmail',
    canNotSend: 'formTab-InputBlock--canNotSend'
  }
};
var emailInput = {
  target: document.querySelector('#subscriber-email')
};
var termsCheckbox = {
  target: document.querySelector('#subscriber-terms-condition')
};
var termsCheckmark = {
  target: document.querySelector('.Checkbox__checkmark'),
  classes: {
    invalid: 'Checkbox__checkmark--error'
  }
};
var submitButton = {
  target: document.querySelector('#submit-subscription'),
  classes: {
    disabled: 'formTab-InputBlock__submit--disabled'
  }
};

/***/ }),

/***/ "./src/js/modules/subscribeForm/getValidationResult.js":
/*!*************************************************************!*\
  !*** ./src/js/modules/subscribeForm/getValidationResult.js ***!
  \*************************************************************/
/*! exports provided: getValidationResult */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getValidationResult", function() { return getValidationResult; });
/* harmony import */ var _data_errorMessages__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./data/errorMessages */ "./src/js/modules/subscribeForm/data/errorMessages.js");

var getValidationResult = function getValidationResult(emailValue, termsValue) {
  if (isEmailEmpty(emailValue)) {
    return buildValidationObject(false, 'email', _data_errorMessages__WEBPACK_IMPORTED_MODULE_0__["messages"].empty);
  }

  if (!isEmailValid(emailValue)) {
    return buildValidationObject(false, 'email', _data_errorMessages__WEBPACK_IMPORTED_MODULE_0__["messages"].invalid);
  }

  if (isEmailFromColombia(emailValue)) {
    return buildValidationObject(false, 'email', _data_errorMessages__WEBPACK_IMPORTED_MODULE_0__["messages"].colombia);
  }

  if (!isTermsChecked(termsValue)) {
    return buildValidationObject(false, 'terms', _data_errorMessages__WEBPACK_IMPORTED_MODULE_0__["messages"].unchecked);
  }

  return buildValidationObject(true);
};

function buildValidationObject(isValid) {
  var subject = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  var message = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
  return {
    isValid: isValid,
    err: {
      message: message,
      subject: subject
    }
  };
}

function isEmailEmpty(value) {
  return value.trim() === ''; // return false;
}

function isEmailValid(value) {
  return value.match(/^[^@]{2,}@[^@]{2,}\.[^@]{2,5}$/); // return value.match(/^.{3,}$/);
  // return true;
}

function isEmailFromColombia(value) {
  return value.match(/\.co$/); // return false;
}

function isTermsChecked(value) {
  return value; // return true;
}

/***/ }),

/***/ "./src/js/modules/subscribeForm/index.js":
/*!***********************************************!*\
  !*** ./src/js/modules/subscribeForm/index.js ***!
  \***********************************************/
/*! exports provided: activateForm */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _activateForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./activateForm */ "./src/js/modules/subscribeForm/activateForm.js");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "activateForm", function() { return _activateForm__WEBPACK_IMPORTED_MODULE_0__["activateForm"]; });



/***/ }),

/***/ "./src/js/modules/subscribeForm/renderValidationResult.js":
/*!****************************************************************!*\
  !*** ./src/js/modules/subscribeForm/renderValidationResult.js ***!
  \****************************************************************/
/*! exports provided: render */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony import */ var _modules_alert_errorModal__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ~modules/alert/errorModal */ "./src/js/modules/alert/errorModal.js");
/* harmony import */ var _data_targets__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./data/targets */ "./src/js/modules/subscribeForm/data/targets.js");


var form = {
  disallowSending: function disallowSending() {
    _data_targets__WEBPACK_IMPORTED_MODULE_1__["inputBlock"].target.classList.add(_data_targets__WEBPACK_IMPORTED_MODULE_1__["inputBlock"].classes.canNotSend);
    _data_targets__WEBPACK_IMPORTED_MODULE_1__["submitButton"].target.classList.add(_data_targets__WEBPACK_IMPORTED_MODULE_1__["submitButton"].classes.disabled);
    _data_targets__WEBPACK_IMPORTED_MODULE_1__["submitButton"].target.setAttribute('tabindex', -1);
  },
  allowSending: function allowSending() {
    _data_targets__WEBPACK_IMPORTED_MODULE_1__["inputBlock"].target.classList.remove(_data_targets__WEBPACK_IMPORTED_MODULE_1__["inputBlock"].classes.canNotSend);
    _data_targets__WEBPACK_IMPORTED_MODULE_1__["submitButton"].target.classList.remove(_data_targets__WEBPACK_IMPORTED_MODULE_1__["submitButton"].classes.disabled);
    _data_targets__WEBPACK_IMPORTED_MODULE_1__["submitButton"].target.setAttribute('tabindex', 0);
  }
};
var email = {
  setAsInvalid: function setAsInvalid() {
    _data_targets__WEBPACK_IMPORTED_MODULE_1__["inputBlock"].target.classList.add(_data_targets__WEBPACK_IMPORTED_MODULE_1__["inputBlock"].classes.invalidEmail);
  },
  setAsValid: function setAsValid() {
    _data_targets__WEBPACK_IMPORTED_MODULE_1__["inputBlock"].target.classList.remove(_data_targets__WEBPACK_IMPORTED_MODULE_1__["inputBlock"].classes.invalidEmail);
  }
};
var terms = {
  setAsInvalid: function setAsInvalid() {
    _data_targets__WEBPACK_IMPORTED_MODULE_1__["termsCheckmark"].target.classList.add(_data_targets__WEBPACK_IMPORTED_MODULE_1__["termsCheckmark"].classes.invalid);
  },
  setAsValid: function setAsValid() {
    _data_targets__WEBPACK_IMPORTED_MODULE_1__["termsCheckmark"].target.classList.remove(_data_targets__WEBPACK_IMPORTED_MODULE_1__["termsCheckmark"].classes.invalid);
  }
};

var renderInvalidResult = function renderInvalidResult(subject, message) {
  form.disallowSending();
  email.setAsValid();
  terms.setAsValid();

  if (subject === 'email') {
    email.setAsInvalid();
  } else if (subject === 'terms') {
    terms.setAsInvalid();
  }

  _modules_alert_errorModal__WEBPACK_IMPORTED_MODULE_0__["modal"].print(message);
};

var renderValidResult = function renderValidResult(needToHideError) {
  form.allowSending();
  email.setAsValid();
  terms.setAsValid();

  if (needToHideError) {
    _modules_alert_errorModal__WEBPACK_IMPORTED_MODULE_0__["modal"].hide();
  }
};

var render = {
  invalidResult: renderInvalidResult,
  validResult: renderValidResult
};

/***/ }),

/***/ "./src/js/modules/subscribeForm/showGratitude.js":
/*!*******************************************************!*\
  !*** ./src/js/modules/subscribeForm/showGratitude.js ***!
  \*******************************************************/
/*! exports provided: showGratitude */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "showGratitude", function() { return showGratitude; });
var $tabsWrapp = document.querySelector('.Main__tabs');
var $form = document.querySelector('.Main__Tab--form');
var $thanks = document.querySelector('.Main__Tab--thanks');
var socials = document.querySelectorAll('.Socials__Item');
var classes = {
  form: {
    hidden: 'Main__Tab--hiddenInRight',
    disabled: 'Main__Tab--disabled'
  },
  thanks: {
    hidden: 'Main__Tab--hiddenInLeft',
    disabled: 'Main__Tab--disabled'
  }
};
var formStyles = window.getComputedStyle($form);
var formTransition = parseFloat(formStyles.transitionDuration) * 1000;
var SOCIALS_DELAY = formTransition * 0.5;
var THANKS_DELAY = formTransition * 0.75;
var isOnceShown = false;
var showGratitude = function showGratitude() {
  if (isOnceShown) {
    return;
  }

  isOnceShown = true;
  $thanks.classList.remove(classes.thanks.disabled);

  $form.ontransitionend = function (event) {
    if (event.propertyName === 'opacity') {
      $form.ontransitionend = null;
      $form.classList.add(classes.form.disabled);
    }
  };

  var formHeight = $form.offsetHeight;
  var thanksHeight = $thanks.offsetHeight;
  var socialsTopMargin = formHeight - thanksHeight; // .hidden will set position absolute

  $tabsWrapp.style.height = "".concat(formHeight, "px");
  $form.classList.add(classes.form.hidden);
  setTimeout(function () {
    $thanks.classList.remove(classes.thanks.hidden);
  }, THANKS_DELAY);
  setTimeout(function () {
    $tabsWrapp.style.height = "".concat(thanksHeight, "px");
    socials.forEach(function (item) {
      item.style.transition = 'none';
      item.style.marginTop = "".concat(socialsTopMargin, "px");
    }); // Wait for social media to get margin-top style

    setTimeout(function () {
      socials.forEach(function (item) {
        item.style.transition = '';
        item.style.marginTop = '';
      });
    }, 30); // Remove height style when all animations are complete

    setTimeout(function () {
      $tabsWrapp.style.height = '';
    }, 2000);
  }, SOCIALS_DELAY);
};

/***/ })

/******/ });
//# sourceMappingURL=index.bundle.js.map