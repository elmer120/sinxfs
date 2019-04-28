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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/table_form.js":
/*!************************************!*\
  !*** ./resources/js/table_form.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * crea tabella con tabulator.js 
 * @param columns_config configurazione colonne
 */
window.create_table = function create_table(columns_config) {
  //definisco la tabella
  table = new Tabulator("#table", {
    layout: "fitColumns",
    //colonne si restringono attorno ai dati, il restante spazio è vuoto ma sempre una "tabella"
    responsiveLayout: "collapse",
    //le colonne si impilano quando non c'è abb spazio
    placeholder: "No Data Available",
    //quando non ci sono dati
    pagination: "local",
    //imposto la paginazione
    paginationSize: 20,
    //per ogni pagina mostro n righe
    selectable: 1,
    //righe selezionabili
    rowSelected: row_selected,
    //callback riga selezionata
    rowDeselected: row_deselected,
    //callback riga deselezionata
    rowSelectionChanged: row_selection_changed,
    //callback al cambio selezione riga
    tooltips: true,
    columnVertAlign: "bottom",
    columns: columns_config
  });
};
/** carica i dati in tabella con ajax
 * @param  {} url url ajax
 * @param  {} token token laravel
 */


window.load_table = function load_table(url, token) {
  //carico i dati in tabella via ajax
  var ajaxConfig = {
    method: "POST",
    //set request type to Position
    headers: {
      'X-CSRF-Token': token
    }
  };
  table.setData(url, {}, ajaxConfig);
};
/** 
* Ricerca una stringa nella tabella 
* @param {string} str da ricercare
*/


window.search = function search(str) {
  var filters = [];
  var columns = table.getColumns();
  var search = str;
  columns.forEach(function (column) {
    if (column.getField() != undefined) {
      filters.push({
        field: column.getField(),
        type: "like",
        value: search
      });
    }
  });
  table.setFilter([filters]);
};
/**
 * reset form
 * @return {null} nothing
 */


window.form_reset = function form_reset() {
  //pulisco gli input del form
  $("#form")[0].reset(); //rimuovo gli eventuali campi nascosti degli id

  $('input[type=hidden]').remove(); //rimuovo i danger

  $(":input").removeClass('uk-form-danger'); //riabilito il btn submit

  $('#btn_submit').attr('disabled', false);
  console.log('Reset form ok');
};
/**
 * @param  {boolean} state true per disabilitare
 */


window.btn_disable = function btn_disable(state) {
  //disabilito i pulsanti
  $('#btn_modifica').attr('disabled', state);
  $('#btn_elimina').attr('disabled', state);
  $('#btn_visualizza').attr('disabled', state);
  $('#btn_stampa').attr('disabled', state);
};

/***/ }),

/***/ 1:
/*!******************************************!*\
  !*** multi ./resources/js/table_form.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\xammp7.2\htdocs\app\sinxfs\resources\js\table_form.js */"./resources/js/table_form.js");


/***/ })

/******/ });