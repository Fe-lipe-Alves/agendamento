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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! exports provided: alertar, gera_id */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "alertar", function() { return alertar; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "gera_id", function() { return gera_id; });
var mapa_alertas = new Map();
$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();
  $('#alerta').on('click', '.expandir', function () {
    var alrt = $(this).parents('.alrt');
    alrt.find('.detalhes').slideDown();
    clearTimerAlert(alrt, true);
  }).on('click', '.fechar', function () {
    $(this).parents('.alrt').fadeOut(function () {
      $(this).remove();
    });
  }).on('mouseenter', '.alrt', function () {
    clearTimerAlert($(this));
  }).on('mouseleave', '.alrt', function () {
    setTimerAlert($(this), 5000);
  });
});
/**
 * Gera um ID numérico com o comprimeto informado
 *
 * @param comprimento
 * @returns {number}
 */

function gera_id(comprimento) {
  var randomized = Math.ceil(Math.random() * Math.pow(10, comprimento));
  var digito = Math.ceil(Math.log(randomized));

  while (digito > 10) {
    digito = Math.ceil(Math.log(digito));
  }

  return parseInt(randomized + '' + digito);
} // Adiciona tempo de exibição do alerta


function setTimerAlert(alerta) {
  var tempo = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 10000;
  var timerId = setTimeout(function () {
    if (alerta.data('bloqueado') === true) return;
    alerta.fadeOut();
  }, tempo);
  mapa_alertas.set(alerta.data('id'), timerId);
} // Limpa o tempo de exibição do alerta


function clearTimerAlert(alerta) {
  var permanente = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  var timerId = mapa_alertas.get(alerta.data('id'));
  clearTimeout(timerId);

  if (permanente) {
    alerta.attr('data-bloqueado', 'true');
  }
}
/**
 *  Exibe um alerta no topo da página, logo abaixo do menu. Após 10 segundo o alerta desaparece.
 *
 *  Aceita como primeiro parâmetro a mensagem do alerta e segundo parâmetro o tipo do alerta (danger, alert, success).
 *
 * @param mensagem
 * @param tipo
 * @param detalhes
 */


function alertar(mensagem) {
  var tipo = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "danger";
  var detalhes = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "";
  var id = gera_id(5),
      html = '<div data-id="' + id + '" class="col-12 alrt bg-' + tipo + ' reticencias py-2 display-none">' + '<div class="titulo">' + '<p class="m-0">' + mensagem + '<span class="float-right">' + '<i class="fas fa-chevron-down text-muted expandir mx-2" title="Ver Mais"></i>' + '<i class="fas fa-times text-muted fechar mx-2" title="Remover"></i>' + '</span>' + '</p>' + '</div>' + '<div class="detalhes display-none">' + detalhes + '</div>' + '</div>';
  var alerta = $(html).appendTo('#alerta').fadeIn();
  setTimerAlert(alerta);
}
/**
 * -----------------------------------------------------------------------
 * Exporta as funções para serem importadas nos arquivos onde forem usadas
 * -----------------------------------------------------------------------
 * As funções ficam disponíveis para os outros arquivos js realizar a
 * importação das funções. Assim, não é necessário todos as funções desse
 * arquivo, somente as necessárias para a página carregada
 */




/***/ }),

/***/ "./resources/scss/agenda.scss":
/*!************************************!*\
  !*** ./resources/scss/agenda.scss ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/scss/app.scss":
/*!*********************************!*\
  !*** ./resources/scss/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/scss/login.scss":
/*!***********************************!*\
  !*** ./resources/scss/login.scss ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!**********************************************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/scss/app.scss ./resources/scss/login.scss ./resources/scss/agenda.scss ***!
  \**********************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Users\Engeselt\Documents\Felipe A\Agendamento\Agendamento\resources\js\app.js */"./resources/js/app.js");
__webpack_require__(/*! C:\Users\Engeselt\Documents\Felipe A\Agendamento\Agendamento\resources\scss\app.scss */"./resources/scss/app.scss");
__webpack_require__(/*! C:\Users\Engeselt\Documents\Felipe A\Agendamento\Agendamento\resources\scss\login.scss */"./resources/scss/login.scss");
module.exports = __webpack_require__(/*! C:\Users\Engeselt\Documents\Felipe A\Agendamento\Agendamento\resources\scss\agenda.scss */"./resources/scss/agenda.scss");


/***/ })

/******/ });