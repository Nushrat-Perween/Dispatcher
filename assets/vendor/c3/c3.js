/**
 * C3 charts page
 */
(function() {
  'use strict';

  /******** Chart 1 ********/


  var chart = c3.generate({
    data: {
                          x:'x',
      columns: [
        ['x', '2015-04-01', '2015-04-01', '2015-04-01', '2015-04-01', '2015-05-01', '2015-06-01', '2015-07-01', '2015-08-01', '2015-09-01'],
        ['sample', 30, 20, 50, 40, 100, 200, 250, 200, 300],
        ['data2', 30, 200, 100, 400, 150, 250, 50, 100, 250],
        ['data3', 50, 20, 10, 40, 15, 25, 50, 30, 40]
      ]
    },
                          
      axis : {
      x:{
      type : 'timeseries',
      tick : {
      format : function (x) {
      var month = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
      return (month[x.getMonth()]);
      }
      }
      }
      }
  });


/*var chart = c3.generate({
  bindto: '#chart',
  data: {
    x: 'x',
    columns: [
      ['x', '2013-01-01', '2013-02-01', '2013-03-01', '2013-04-01', '2013-05-01', '2013-06-01', '2013-07-01', '2013-08-01', '2013-09-01', '2013-10-01', '2013-11-01', '2013-12-01'],
      ['2014', 130, 120, 150, 140, 160, 150, 130, 120, 150, 140, 160, 150]
    ],
    type: 'bar'
  },
  axis: {
    x: {
      type: 'timeseries',
      tick: {
        format: function(x) {
          var month = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];

          return (month[x.getMonth()]);
        },
        fit: false
      }
    }
  }
});*/


  /******** Chart 2 ********/

  c3.generate({
    bindto: '#chart2',
    data: {
      columns: [
        ['data1', 30, 200, 100, 400, 150, 250, 50, 100, 250],
        ['data2', 130, 100, 140, 200, 150, 50, 120, 80, 60]
      ],
      type: 'bar'
    },
    bar: {
      width: {
        ratio: 0.5
      }
    }
  });
})();
