<div class="col-md-12">
            <div class="mt-2">
              <div class="row py-2 ">
                  <div class="col-6 col-md-8 ">
                      <h3 class="text-muted px-1">Dashboard</h3>
                      <h5 class="text-info px-1">Tahun <?php echo $tahun; ?></h5>
                  </div>
                  <div class="col-6 col-md-4">
                      <div class="d-flex flex-row-reverse bd-highlight">
                          <form class="form-inline" action="<?php  echo base_url('Rekap/dashboard'); ?>" method="get">
                              <div class="form-group">
                                  <input type="text" required name="tahun" class="form-control" placeholder="<?php echo $tahun; ?>">
                                  <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
            <div class=" py-2 px-2 " >
            <div class="row">
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Peminjaman</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">100</div>
                      </div>
                  </div>
                </div>
              </div>
            </div>

         

            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ruangan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php foreach($jumlahRuangan as $u){ echo $u->jumRuangan; }?></div>
                      </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

        
          <div class="row">
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Jumlah Peminjaman</h6>
                  <div  class="dropdown  no-arrow">
                  </div>
                </div>
                
                <div class="card-body">
                  <div class=""  style="width: 800px; height: 400px;">
                    <div id="columnchart_material" style="width: 650px; height: 400px;"></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Status Peminjaman</h6>
                  <div class="dropdown  no-arrow">
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2"  style="height:400px;">
                  <div id="chart_div"></div>
                  </div>
                  <div class="mt-4 text-center small">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

      




<script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Setuju', <?php foreach($peminjamanSetujuPertahun as $u){ echo $u->jumPeminjamanSetujuPertahun; }?>],
          ['Tolak', <?php foreach($peminjamanGagalPertahun as $u){ echo $u->jumPeminjamanGagalPertahun; }?>],
          ['Belum Diproses', <?php foreach($peminjamanPendingPertahun as $u){ echo $u->jumPeminjamanPendingPertahun; }?>]
        ]);
        // Set chart options
        var options = {'title':'Status Peminjaman',
                       'width':300,
                       'height':200};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>


<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Bulan', 'Total Peminjaman', 'Tolak', 'Terkirim', 'Setuju'],
          ['Jan', 200, 40, 10, 97],
          ['Feb', 170, 60, 25, 100],
          ['Mar', 160, 10, 16, 130],
          ['Apr', 160, 20, 15, 101],
          ['Mei', 120, 30, 7, 89],
          ['Jun', 120, 50, 11, 69],
          ['Jul', 100, 40, 30, 89],
          ['Agu', 130, 20, 20, 78],
          ['Sep', 125, 20, 30, 80],
          ['Okt', 170, 50, 35, 111],
          ['Nov', 130, 20, 30, 80],
          ['Des', 130, 10, 20, 100]
        ]);

        var options = {
          chart: {
            title: 'Grafik Peminjaman',
            subtitle: 'Perbandingan status peminjaman dalam perbulan',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>



