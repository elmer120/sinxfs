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
    rowSelected: window.rowSelected,
    //callback riga selezionata
    rowDeselected: window.row_deselected,
    //callback riga deselezionata
    rowSelectionChanged: window.row_selection_changed,
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
/*chiamata ajax per popolare i select con le options
* @param {string} id select
* @param {string} url ajax
* @param {string} data dati da inviare
* @param {string} placeholder
* @param {string} campo dell'array da utilizzare
*/


window.get_options = function get_options(id_element, url, placeholder, field) {
  var field_ext = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : null;
  var data = arguments.length > 5 && arguments[5] !== undefined ? arguments[5] : null;

  if ($(id_element).length) {
    $.ajax({
      url: url,
      data: data,
      success: function success(data) {
        $(id_element).html('<option value="" disabled selected>' + placeholder + '</option>');

        for (var i = 0; i < data.length; i++) {
          var id = data[i].id;
          var text = data[i][field];
          field_ext != null ? text += ' ' + data[i][field_ext] : '';
          var option = "<option value='" + id + "'>" + text + "</option>";
          $(id_element).append(option);
        }
      },
      error: function error(data) {
        alert("get_options: Errore nella chiamata ajax!" + data);
      }
    });
  } else {
    alert("L'id " + id_element + " non esiste.");
  }
};
/** chiamata ajax per popolare gli input
* @param {string} attributo name input
* @param {url} url ajax
*/


window.get_input_value = function get_input_value(name_input, url) {
  if ($('input[name="' + name_input + '"]').length) {
    $.ajax({
      url: url,
      data: '',
      success: function success(data) {
        $('input[name="' + name_input + '"]')[0].value = data;
        $('#modal_loading').toggleClass('uk-hidden', true);
      },
      error: function error(data) {
        alert("get_options: Errore nella chiamata ajax!" + data);
      }
    });
  } else {
    alert("L'input con name= " + name_input + " non esiste.");
  }
};
/** alla selezione di un riga
*  @param {object} riga
*/


window.rowSelected = function row_selected(row) {
  //recupero l'id (del database)
  row_selected_id = row.getData()['id'];

  if (row_selected_id != null) {
    //abilito i pulsanti
    btn_disable(false);
  }
};
/** alla deselezione di un riga
*  @param {object} riga
*/


window.row_deselected = function row_deselected(row) {
  row_selected_id = null; //disabilito i pulsanti

  btn_disable(true);
};
/** al cambio selezione di un riga
*  @param {object} data
* @param {object} riga
*/


window.row_selection_changed = function row_selection_changed(data, rows) {
  if (data.length > 0) {
    row_selected_id = data[0].id;
    btn_disable(false);
  }
};
/** chiamata ajax per rimuovere un elemento
*  @param {Number} id id del database
*  @param {String} url url su cui effettuare la chiamata
*/


window.remove = function remove(id, url) {
  $.ajax({
    url: url,
    method: "DELETE",
    data: {
      "id": id
    },
    success: function success(data) {
      //stampo messaggio 
      UIkit.notification({
        message: data,
        status: '',
        pos: 'bottom-center',
        timeout: 3000
      }); //chiudo il modal

      setTimeout(function () {
        UIkit.modal($('#modal')).hide();
        table.setData();
      }, 2000);
    },
    error: function error(data) {
      alert('delete_persona errore chiamata ajax!');
    }
  });
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