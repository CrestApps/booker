window.dateFormat = 'D/M/YYYY';
window.timeFormat = 'hh:mm:ss A';
window.timeFormatRead = 'LT';
window.dateTimeFormat = window.dateFormat + ' ' + window.timeFormatRead;
window.dateTimeFormatDb = 'YYYY-MM-DD HH:mm:ss';
window.dateFormatDb = 'YYYY-MM-DD';
window.dateTimeFormatForEdit = window.dateFormat + ' ' + window.timeFormat;
window.taxRate = Number(document.head.querySelector('meta[name="local-tax-rate"]').content);