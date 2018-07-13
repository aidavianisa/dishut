@extends('layouts.app_adminlte')

@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>it all starts here</small>
      </h1>
    </section>
  <!-- Main content -->
    <section class="content">
      <div class="callout callout-success">
        <h4>Selamat Datang di aplikasi Manajemen Balai Pengelola Dinas Kehutanan Jawa Timur</h4>
        <p>Disini Anda bisa mengelola data Pemasukan dan Pengunjung Objek Wisata Alam, Luas Lahan Kritis, Luas Kebakaran, dan tempat Objek Wisata Alam</p>
      </div>

      <!-- Info boxes Pengunjung-->
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-teal-active color-palette"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pengunjung <?= $tahun ?></span>
              <span class="info-box-text">Objek Wisata Alam</span>
              <?php foreach ($total as $key) {?>
                <span class="info-box-number"><?= number_format((double)$key['pengunjungs'], 0, ',', '.') ?> <small> orang</small></span>
              <?php } ?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-teal color-palette"><?= number_format((double)$persen_pengunjungs, 0, '.', '') ?>%</span>

            <div class="info-box-content">
              <span class="progress-description">Peningkatan dari</span>
              <span class="info-box-text">Pengunjung <?= $tahun-1 ?></span>
              <?php foreach ($total_lama as $key) {?>
                <span class="info-box-number"><?= number_format((double)$key['pengunjungs'], 0, ',', '.') ?> <small> orang</small></span>
              <?php } ?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-teal disabled color-palette"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Prediksi Pengunjung <?= $now+1 ?></span>
              <span class="info-box-number"><?= number_format((double)$ramal_pengunjung, 0, ',', '.') ?> orang</span>
              <span class="progress-description">
                <b><?= number_format((double)$err_pengunjung, 2, ',', '.') ?></b>% perubahan
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Info boxes Penerimaan-->
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow-active color-palette"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Penerimaan <?= $tahun ?></span>
              <span class="info-box-text">Objek Wisata Alam</span>
              <?php foreach ($total as $key) {?>
                <span class="info-box-number"><small>Rp</small><?= number_format((double)$key['penerimaans'], 0, ',', '.') ?></span>
              <?php } ?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow color-palette"><?= number_format((double)$persen_penerimaans, 0, '.', '') ?>%</i></span>

            <div class="info-box-content">
              <span class="progress-description">Peningkatan dari</span>
              <span class="info-box-text">Penerimaan <?= $tahun-1 ?></span>
              <?php foreach ($total_lama as $key) {?>
                <span class="info-box-number"><small>Rp</small><?= number_format((double)$key['penerimaans'], 0, ',', '.') ?></span>
              <?php } ?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow disabled color-palette"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Prediksi Penerimaan <?= $now+1 ?></span>
              <span class="info-box-number">Rp <?= number_format((double)$ramal_penerimaan, 0, ',', '.') ?></span>
              <span class="progress-description">
                <b><?= number_format((double)$err_penerimaan, 2, ',', '.') ?></b>% perubahan
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Luas Hutan</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body center">
                <div class="chart-responsive">
                  <div id="container" style="min-width: auto; height: auto; margin: 0 auto"></div>
                </div>
                <!-- ./chart-responsive -->
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="box box-default" style="height: auto;">
            <div class="box-header with-border">
              <h3 class="box-title">Luas Balai Pengelola</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body center">
                <div class="chart-responsive">
                  <div id="container1" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                </div>
                <!-- ./chart-responsive -->
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
      </div>
      

      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Lokasi Balai Pengelola Objek Wisata Alam</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div style="width: auto; height: 500px;">
                {!! Mapper::render() !!}
              </div>
              <div class="box-footer">
                <div class="row">
                  <div class="col-sm-4 col-xs-4">
                    <div class="description-block border-right">
                      <img src="{{ asset('images/marker_hijau.png') }}">
                      <span class="info-box-text">Pemasukan terendah</span>
                      <?php foreach ($data as $key) {?>
                        <span>Rp <?= number_format((double)$key['penerimaan_rendah'], 0, ',', '.') ?>,-</span>
                      <?php } ?>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-xs-4">
                    <div class="description-block border-right">
                      <img src="{{ asset('images/marker_kuning.png') }}">
                      <span class="info-box-text">Antara tertinggi dan terendah</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-xs-4">
                    <div class="description-block border-right">
                      <img src="{{ asset('images/marker_merah.png') }}">
                      <span class="info-box-text">Pemasukan Tertinggi</span>
                      <?php foreach ($data as $key) {?>
                        <span>Rp <?= number_format((double)$key['penerimaan_tinggi'], 0, ',', '.') ?>,-</span>
                      <?php } ?>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                <!-- /.row -->
            </div>
            <!-- /.box-footer -->
            </div>
            <!-- /.box-body -->
          </div>
    </section>
  <!-- /.content -->

  <script>
    // Luas Hutan
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Luas Hutan'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br><small>{point.y:.f} ha</small>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Hutan',
            colorByPoint: true,
            data : [
                <?php foreach ($hutan as $key) { ?>
                  {
                    name : '<?= $key['jenis_hutan'] ?>',
                    y : <?= $key['luas'] ?>
                  },
                <?php } ?>
            ]
        }]
    });

    //Luas Balai
    Highcharts.chart('container1', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Stacked bar chart'
    },
    xAxis: {
        // categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas', 'Duren']
        categories : [
          <?php foreach ($balai as $key) { ?>
            '<?=  $key['nama_balai']?>',
          <?php } ?>
        ]
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Luas (ha)'
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    series: [{
        name: 'Luas Kebakaran',
        //data: [5000, 3000, 4000, 7000, 2000, 1000]
        data: [
          <?php foreach ($balai as $key) { ?>
            <?=  $key['luas_kebakaran']?>,
          <?php } ?>
        ]
    }, {
        name: 'Luas Lahan Kritis',
        //data: [2000, 2000, 3000, 2000, 1000, 2000]
        data: [
          <?php foreach ($balai as $key) { ?>
            <?=  $key['luas_lahan_kritis']?>,
          <?php } ?>
        ]
    }, {
        name: 'Luas Wilayah',
        // data: [3, 4, 4, 2, 5, 4]
        data: [
          <?php foreach ($balai as $key) { ?>
            <?=  $key['luas_wilayah']?>,
          <?php } ?>
        ]
    }]
});
  </script>
@endsection
