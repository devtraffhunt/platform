// utils/index.js

/**
 * Возвращает целое случайное в [min, max)
 */
function rand(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
  }
  
  /**
   * Перемешивает массив на месте (Fisher–Yates)
   */
  function shuffle(arr) {
    for (let i = arr.length - 1; i > 0; i--) {
      const j = rand(0, i + 1);
      [arr[i], arr[j]] = [arr[j], arr[i]];
    }
    return arr;
  }
  
  /**
   * Форматирует секунды → '0X' или 'XX'
   */
  function TIMES(e) {
    return e < 10 ? '0' + e : '' + e;
  }
  
  module.exports = { rand, shuffle, TIMES };
  