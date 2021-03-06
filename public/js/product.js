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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/vanilla-masker/lib/vanilla-masker.js":
/*!***********************************************************!*\
  !*** ./node_modules/vanilla-masker/lib/vanilla-masker.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;(function(root, factory) {
  if (true) {
    !(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
				__WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}
}(this, function() {
  var DIGIT = "9",
      ALPHA = "A",
      ALPHANUM = "S",
      BY_PASS_KEYS = [9, 16, 17, 18, 36, 37, 38, 39, 40, 91, 92, 93],
      isAllowedKeyCode = function(keyCode) {
        for (var i = 0, len = BY_PASS_KEYS.length; i < len; i++) {
          if (keyCode == BY_PASS_KEYS[i]) {
            return false;
          }
        }
        return true;
      },
      mergeMoneyOptions = function(opts) {
        opts = opts || {};
        opts = {
          delimiter: opts.delimiter || ".",
          lastOutput: opts.lastOutput,
          precision: opts.hasOwnProperty("precision") ? opts.precision : 2,
          separator: opts.separator || ",",
          showSignal: opts.showSignal,
          suffixUnit: opts.suffixUnit && (" " + opts.suffixUnit.replace(/[\s]/g,'')) || "",
          unit: opts.unit && (opts.unit.replace(/[\s]/g,'') + " ") || "",
          zeroCents: opts.zeroCents
        };
        opts.moneyPrecision = opts.zeroCents ? 0 : opts.precision;
        return opts;
      },
      // Fill wildcards past index in output with placeholder
      addPlaceholdersToOutput = function(output, index, placeholder) {
        for (; index < output.length; index++) {
          if(output[index] === DIGIT || output[index] === ALPHA || output[index] === ALPHANUM) {
            output[index] = placeholder;
          }
        }
        return output;
      }
  ;

  var VanillaMasker = function(elements) {
    this.elements = elements;
  };

  VanillaMasker.prototype.unbindElementToMask = function() {
    for (var i = 0, len = this.elements.length; i < len; i++) {
      this.elements[i].lastOutput = "";
      this.elements[i].onkeyup = false;
      this.elements[i].onkeydown = false;

      if (this.elements[i].value.length) {
        this.elements[i].value = this.elements[i].value.replace(/\D/g, '');
      }
    }
  };

  VanillaMasker.prototype.bindElementToMask = function(maskFunction) {
    var that = this,
        onType = function(e) {
          e = e || window.event;
          var source = e.target || e.srcElement;

          if (isAllowedKeyCode(e.keyCode)) {
            setTimeout(function() {
              that.opts.lastOutput = source.lastOutput;
              source.value = VMasker[maskFunction](source.value, that.opts);
              source.lastOutput = source.value;
              if (source.setSelectionRange && that.opts.suffixUnit) {
                source.setSelectionRange(source.value.length, (source.value.length - that.opts.suffixUnit.length));
              }
            }, 0);
          }
        }
    ;
    for (var i = 0, len = this.elements.length; i < len; i++) {
      this.elements[i].lastOutput = "";
      this.elements[i].onkeyup = onType;
      if (this.elements[i].value.length) {
        this.elements[i].value = VMasker[maskFunction](this.elements[i].value, this.opts);
      }
    }
  };

  VanillaMasker.prototype.maskMoney = function(opts) {
    this.opts = mergeMoneyOptions(opts);
    this.bindElementToMask("toMoney");
  };

  VanillaMasker.prototype.maskNumber = function() {
    this.opts = {};
    this.bindElementToMask("toNumber");
  };
  
  VanillaMasker.prototype.maskAlphaNum = function() {
    this.opts = {};
    this.bindElementToMask("toAlphaNumeric");
  };

  VanillaMasker.prototype.maskPattern = function(pattern) {
    this.opts = {pattern: pattern};
    this.bindElementToMask("toPattern");
  };

  VanillaMasker.prototype.unMask = function() {
    this.unbindElementToMask();
  };

  var VMasker = function(el) {
    if (!el) {
      throw new Error("VanillaMasker: There is no element to bind.");
    }
    var elements = ("length" in el) ? (el.length ? el : []) : [el];
    return new VanillaMasker(elements);
  };

  VMasker.toMoney = function(value, opts) {
    opts = mergeMoneyOptions(opts);
    if (opts.zeroCents) {
      opts.lastOutput = opts.lastOutput || "";
      var zeroMatcher = ("("+ opts.separator +"[0]{0,"+ opts.precision +"})"),
          zeroRegExp = new RegExp(zeroMatcher, "g"),
          digitsLength = value.toString().replace(/[\D]/g, "").length || 0,
          lastDigitLength = opts.lastOutput.toString().replace(/[\D]/g, "").length || 0
      ;
      value = value.toString().replace(zeroRegExp, "");
      if (digitsLength < lastDigitLength) {
        value = value.slice(0, value.length - 1);
      }
    }
    var number = value.toString().replace(/[\D]/g, ""),
        clearDelimiter = new RegExp("^(0|\\"+ opts.delimiter +")"),
        clearSeparator = new RegExp("(\\"+ opts.separator +")$"),
        money = number.substr(0, number.length - opts.moneyPrecision),
        masked = money.substr(0, money.length % 3),
        cents = new Array(opts.precision + 1).join("0")
    ;
    money = money.substr(money.length % 3, money.length);
    for (var i = 0, len = money.length; i < len; i++) {
      if (i % 3 === 0) {
        masked += opts.delimiter;
      }
      masked += money[i];
    }
    masked = masked.replace(clearDelimiter, "");
    masked = masked.length ? masked : "0";
    var signal = "";
    if(opts.showSignal === true) {
      signal = value < 0 || (value.startsWith && value.startsWith('-')) ? "-" :  "";
    }
    if (!opts.zeroCents) {
      var beginCents = number.length - opts.precision,
          centsValue = number.substr(beginCents, opts.precision),
          centsLength = centsValue.length,
          centsSliced = (opts.precision > centsLength) ? opts.precision : centsLength
      ;
      cents = (cents + centsValue).slice(-centsSliced);
    }
    var output = opts.unit + signal + masked + opts.separator + cents;
    return output.replace(clearSeparator, "") + opts.suffixUnit;
  };

  VMasker.toPattern = function(value, opts) {
    var pattern = (typeof opts === 'object' ? opts.pattern : opts),
        patternChars = pattern.replace(/\W/g, ''),
        output = pattern.split(""),
        values = value.toString().replace(/\W/g, ""),
        charsValues = values.replace(/\W/g, ''),
        index = 0,
        i,
        outputLength = output.length,
        placeholder = (typeof opts === 'object' ? opts.placeholder : undefined)
    ;
    
    for (i = 0; i < outputLength; i++) {
      // Reached the end of input
      if (index >= values.length) {
        if (patternChars.length == charsValues.length) {
          return output.join("");
        }
        else if ((placeholder !== undefined) && (patternChars.length > charsValues.length)) {
          return addPlaceholdersToOutput(output, i, placeholder).join("");
        }
        else {
          break;
        }
      }
      // Remaining chars in input
      else{
        if ((output[i] === DIGIT && values[index].match(/[0-9]/)) ||
            (output[i] === ALPHA && values[index].match(/[a-zA-Z]/)) ||
            (output[i] === ALPHANUM && values[index].match(/[0-9a-zA-Z]/))) {
          output[i] = values[index++];
        } else if (output[i] === DIGIT || output[i] === ALPHA || output[i] === ALPHANUM) {
          if(placeholder !== undefined){
            return addPlaceholdersToOutput(output, i, placeholder).join("");
          }
          else{
            return output.slice(0, i).join("");
          }
        }
      }
    }
    return output.join("").substr(0, i);
  };

  VMasker.toNumber = function(value) {
    return value.toString().replace(/(?!^-)[^0-9]/g, "");
  };
  
  VMasker.toAlphaNumeric = function(value) {
    return value.toString().replace(/[^a-z0-9 ]+/i, "");
  };

  return VMasker;
}));


/***/ }),

/***/ "./resources/js/product.js":
/*!*********************************!*\
  !*** ./resources/js/product.js ***!
  \*********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vanilla_masker__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vanilla-masker */ "./node_modules/vanilla-masker/lib/vanilla-masker.js");
/* harmony import */ var vanilla_masker__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vanilla_masker__WEBPACK_IMPORTED_MODULE_0__);


var toFloat = function toFloat(num) {
  var dotPos = num.indexOf('.');
  var commaPos = num.indexOf(',');
  var sep;
  if (dotPos < 0) dotPos = 0;
  if (commaPos < 0) commaPos = 0;
  if (dotPos > commaPos && dotPos) sep = dotPos;else {
    if (commaPos > dotPos && commaPos) sep = commaPos;else sep = false;
  }
  if (sep == false) return parseFloat(num.replace(/[^\d]/g, ""));
  return parseFloat(num.substr(0, sep).replace(/[^\d]/g, "") + '.' + num.substr(sep + 1, num.length).replace(/[^0-9]/, ""));
};

$(document).ready(function () {
  //money mask
  var moneyInput = document.querySelectorAll(".data-money");
  vanilla_masker__WEBPACK_IMPORTED_MODULE_0___default()(moneyInput).maskMoney({
    precision: 2,
    separator: ',',
    delimiter: '.',
    unit: '',
    zeroCents: false
  }); // percent mask

  var percentInput = document.querySelectorAll(".data-percent");
  vanilla_masker__WEBPACK_IMPORTED_MODULE_0___default()(percentInput).maskMoney({
    precision: 2,
    suffixUnit: '',
    zeroCents: false
  }); // kilogram masker

  var kiloInput = document.querySelectorAll(".data-kilo");
  vanilla_masker__WEBPACK_IMPORTED_MODULE_0___default()(kiloInput).maskMoney({
    precision: 3,
    separator: ',',
    delimiter: ',',
    suffixUnit: '',
    zeroCents: false
  }); //vars - Elements IDs

  var preco_unitario;
  var quantidade;
  var preco_compra;
  var preco_custo;
  var preco_venda;
  var lucro;
  var icms;
  var ipi;
  var qtd_fracionada;
  $('#preco_unitario, #preco_unitario_edit').bind('keyup', function (event) {
    if (event.currentTarget.id == 'preco_unitario') {
      preco_unitario = document.getElementById('preco_unitario');
      quantidade = document.getElementById('quantidade');
      preco_compra = document.getElementById('preco_compra');
      preco_custo = document.getElementById('preco_custo');
      preco_venda = document.getElementById('preco_venda');
      lucro = document.getElementById('lucro');
      icms = document.getElementById('icms');
      ipi = document.getElementById('ipi');
      qtd_fracionada = document.getElementById('qtd_fracionada');
      calcs();
    }

    if (event.currentTarget.id == 'preco_unitario_edit') {
      preco_unitario = document.getElementById('preco_unitario_edit');
      quantidade = document.getElementById('quantidade_edit');
      preco_compra = document.getElementById('preco_compra_edit');
      preco_custo = document.getElementById('preco_custo_edit');
      preco_venda = document.getElementById('preco_venda_edit');
      lucro = document.getElementById('lucro_edit');
      icms = document.getElementById('icms_edit');
      ipi = document.getElementById('ipi_edit');
      qtd_fracionada = document.getElementById('qtd_fracionada_edit');
      calcs();
    }
  });

  var calcs = function calcs() {
    //calculate the price of the weigth
    preco_unitario.addEventListener("blur", function (event) {
      var preco_compraTotal = toFloat(quantidade.value) * toFloat(preco_unitario.value);
      var preco_compraTotalFracionada = toFloat(qtd_fracionada.value) * toFloat(preco_unitario.value);

      if (preco_compraTotalFracionada != 0) {
        preco_compra.value = vanilla_masker__WEBPACK_IMPORTED_MODULE_0___default.a.toMoney(preco_compraTotalFracionada.toFixed(2));
      } else {
        preco_compra.value = vanilla_masker__WEBPACK_IMPORTED_MODULE_0___default.a.toMoney(preco_compraTotal.toFixed(2));
      }

      preco_unitario.value == '0,00' ? preco_compra.focus() : ipi.focus();
    }, true); //preço compra

    preco_compra.addEventListener('blur', function (event) {
      var un = toFloat(preco_compra.value) / toFloat(quantidade.value);

      if (preco_unitario.value == '0,00') {
        preco_unitario.value = vanilla_masker__WEBPACK_IMPORTED_MODULE_0___default.a.toMoney(un.toFixed(2));
      }
    }); //calculate the price of taxes

    icms.addEventListener("blur", function (event) {
      var total_percent = (toFloat(ipi.value) + toFloat(icms.value)) / 100;
      var total_taxes = toFloat(preco_compra.value) * total_percent;
      var preco_custo_with_taxes = parseFloat(total_taxes.toFixed(2)) + toFloat(preco_compra.value);
      preco_custo.value = vanilla_masker__WEBPACK_IMPORTED_MODULE_0___default.a.toMoney(preco_custo_with_taxes.toFixed(2));
    }, true); //calculate the price of the profit

    lucro.addEventListener("blur", function (event) {
      var percent = toFloat(lucro.value) / 100;
      var preco_ventaTotal = percent * toFloat(preco_custo.value);
      var precoFinal = toFloat(preco_custo.value) + parseFloat(preco_ventaTotal.toFixed(2));
      preco_venda.value = vanilla_masker__WEBPACK_IMPORTED_MODULE_0___default.a.toMoney(precoFinal.toFixed(2));
    }, true);
  };
});

/***/ }),

/***/ 2:
/*!***************************************!*\
  !*** multi ./resources/js/product.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vitorh/Documents/projects/acos_galan/resources/js/product.js */"./resources/js/product.js");


/***/ })

/******/ });