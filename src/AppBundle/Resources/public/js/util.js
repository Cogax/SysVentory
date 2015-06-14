function weeksToDate(y,w,d) {
  var days = 2 + d + (w - 1) * 7 - (new Date(y,0,1)).getDay();
  return new Date(y, 0, days);
}