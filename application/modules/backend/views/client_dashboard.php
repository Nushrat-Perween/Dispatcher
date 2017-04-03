	 <link rel="stylesheet" href="<?php echo asset_url();?>vendor/c3/c3.min.css">	
		 <div class="content-view">
            <div class="row">
               
              <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> 100</span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                 Total Job
                  </div>
                </div>
              </div>
               <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> 100</span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                 New  Job
                  </div>
                </div>
              </div>
           		 <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> 100</span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                 Pending Client
                  </div>
                </div>
              </div>
           	<div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> 100</span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                Complited Job
                  </div>
                </div>
              </div>
               <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card card-block ">
                  <h5 class="m-b-0 v-align-middle text-overflow">
					<span class="small pull-xs-right tag bg-success p-y-0 p-x-xs" style="line-height: 24px;">
						<span ><i class="material-icons " aria-hidden="true">
                      group
                    </i></span>
                    </span>
                    <span> 100</span>
                  </h5>
                  <div class="small text-overflow text-muted">
                    &nbsp
                  </div>
                  <div class="small text-overflow">
                Cancell Job
                  </div>
                </div>
              </div>
            </div>
             <div class="m-b-2">
              <h6 class="m-b-1">Line series</h6>
              <div class="c3chart">
                <div class="c3chart1" id="chart"></div>
              </div>
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

      /******** Chart 1 ********/
    var chart = c3.generate({
        data: {
          columns: [
            ['New', 30, 200, 100, 400, 150, 250, 50, 100, 250],
            ['Pending', 50, 20, 10, 40, 15, 25, 50, 30, 40],
    		['Cancell', 0, 20, 10, 300, 15, 25, 50, 30, 0]
          ]
        }
      });
      
    var chart = c3.generate({
        data: {
            x: 'x',
            columns: [
                ['x', '2010-01-01', '2011-02-01', '2012-03-01', '2013-04-01', '2014-05-01', '2015-06-01'],
                ['Pending', 30, 200, 100, 400, 150, 250],
    			 ['Cancell', 50, 20, 10, 40, 15, 25, 50, 30, 40],
    			['Complited', 0, 20, 10, 300, 15, 25, 50, 30, 0]
            ]
        },
        axis : {
            x : {
                type : 'timeseries',
                tick: {
                    format: function (x) { 
    				var month = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];
    				return (month[x.getMonth()]); }
                  //format: '%Y' // format string is also available for timeseries data
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

    </script>