 <div class="content-view">
    <h6 class="m-b-1">Job Report</h6>
      <div class="c3chart">
       	<div class="c3chart2" id="chart2"></div>
      </div>
</div>
 <script src="<?php echo base_url();?>assets/vendor/d3/d3.min.js" charset="utf-8"></script>
    <script src="<?php echo base_url();?>assets/vendor/c3/c3.min.js"></script>
    <script>
    /**
     * C3 charts page
     */
    (function() {
      'use strict';


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
            ['Sucess', 30, 200, 100, 400, 150, 250, 50, 100, 250,30, 200, 100],
            ['Cancel', 130, 100, 140, 200, 150, 50, 120, 80, 60,30, 200, 100]
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

    </script>