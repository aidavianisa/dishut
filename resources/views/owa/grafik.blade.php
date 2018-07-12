@extends('layouts.app_adminlte')

@section('title', 'Data Table Pengunjung OWA')

@section('content')

<?php 
// dd($data);
 ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Grafik Objek Wisata Alam
        <small>it all starts here</small>
      </h1>
      <br>
    </section>
      <!-- Pengunjung -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pengunjung <?= $now ?></span>
                <?php foreach ($total as $key) {?>
                <span class="info-box-number"><?= number_format((double)$key['pengunjungs'], 0, ',', '.') ?> orang</span>
                <?php } ?>
                <span class="progress-description">
                  <b><?= number_format((double)$persen_pengunjungs, 2, '.', '') ?></b>% meningkat
                </span>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Penerimaan <?= $now ?></span>
              <?php foreach ($total as $key) {?>
                <span class="info-box-number">Rp <?= number_format((double)$key['penerimaans'], 0, ',', '.') ?></span>
              <?php } ?>
              <span class="progress-description">
                <b><?= number_format((double)$persen_penerimaans, 2, ',', '.') ?></b>% meningkat
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Prediksi <br>Pengunjung <?= $now+1 ?></span>
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
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Prediksi <br>Penerimaan <?= $now+1 ?></span>
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

      <!-- Coba ramal bulan -->
      <?= number_format((double)$key['pengunjungs'], 0, ',', '.') ?>
      <?= number_format((double)$ramal_pengunjung1, 0, ',', '.') ?>

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Pengunjung Objek Wisata Alam</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <form method="PUT" action="/owa/grafik" class="col-md-2" accept-charset="utf-8">
                <select name="years" onchange="this.form.submit()">
                  <option value='0'>Pilih Tahun</option>
                  <option value='2012'>2012</option>
                  <option value='2013'>2013</option>
                  <option value='2014'>2014</option>
                  <option value='2015'>2015</option>
                  <option value="2016">2016</option>
                  <option value="2017">2017</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                </select>
              </form>
                <!-- {{ Form::open(array('url' => '/owa', 'method' => 'get')) }}
                    <?php 
                    date_default_timezone_set("Asia/Jakarta");
                    $tanggal = date('Y');
                    echo Form::selectRange('tahun', 2012, 2025, $tanggal); ?>
                {{ Form::close() }} -->
              <div id="container" style="min-width: auto; height: auto; margin: 0 auto"></div>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- Penerimaan -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Penerimaan Objek Wisata Alam</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="container1" style="min-width: auto; height: auto; margin: 0 auto"></div>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
<script type="text/javascript">
   Highcharts.chart('container', {
              title: {
                text: 'Data Pengunjung Objek Wisata Alam <?= $now ?>'
              },
              chart: {
                  type: 'column'
              },
              xAxis : {
                  categories: [
                    'Jan','Feb','Mar','Apr','Mei','Juni','Juli','Ags','Sep','Okt','Nov','Des'
                  ]
              },
              yAxis: {
                title: {
                  text: 'Jumlah Kasus'
                }
              },

              series: [
              <?php foreach ($data as $key) { ?>
                {
                  name: '<?= $key['lokasi_owas'] ?>',
                  data: [
                    <?php
                    $list= [];
                    foreach ($key['data_owa'] as $item) {
                      if(empty($item)){
                        break;
                      }
                      else{
                        $i = $item->bulan;
                        $list[$i] = $item->pengunjungs;
                      }
                    }
                    for($i=1;$i<=12;$i++){
                      if(!empty($list[$i])){
                        echo $list[$i].',';
                      }
                      else{ echo "0".','; }
                    }
                    ?>
                  ]
                },
              <?php } ?>
              ],

              responsive: {
                  rules: [{
                      condition: {
                          maxWidth: 500
                      },
                      chartOptions: {
                          legend: {
                              align: 'center',
                              verticalAlign: 'bottom',
                              layout: 'horizontal'
                          },
                          yAxis: {
                              labels: {
                                  align: 'left',
                                  x: 0,
                                  y: -5
                              },
                              title: {
                                  text: null
                              }
                          },
                          subtitle: {
                              text: null
                          },
                          credits: {
                              enabled: false
                          }
                      }
                  }]
              }
            });

   Highcharts.chart('container1', {
              title: {
                text: 'Data Penerimaan Objek Wisata Alam <?= $now ?>'
              },
              chart: {
                  type: 'column'
              },
              xAxis : {
                  categories: [
                    'Jan','Feb','Mar','Apr','Mei','Juni','Juli','Ags','Sep','Okt','Nov','Des'
                  ]
              },
              yAxis: {
                title: {
                  text: 'Jumlah Kasus'
                }
              },

              series: [
              <?php foreach ($data as $key) { ?>
                {
                  name: '<?= $key['lokasi_owas'] ?>',
                  data: [
                    <?php
                    $list= [];
                    foreach ($key['data_owa'] as $item) {
                      if(empty($item)){
                        break;
                      }
                      else{
                        $i = $item->bulan;
                        $list[$i] = $item->penerimaans;
                      }
                    }
                    for($i=1;$i<=12;$i++){
                      if(!empty($list[$i])){
                        echo $list[$i].',';
                      }
                      else{ echo "0".','; }
                    }
                    ?>
                  ]
                },
              <?php } ?>
              ],

              responsive: {
                  rules: [{
                      condition: {
                          maxWidth: 500
                      },
                      chartOptions: {
                          legend: {
                              align: 'center',
                              verticalAlign: 'bottom',
                              layout: 'horizontal'
                          },
                          yAxis: {
                              labels: {
                                  align: 'left',
                                  x: 0,
                                  y: -5
                              },
                              title: {
                                  text: null
                              }
                          },
                          subtitle: {
                              text: null
                          },
                          credits: {
                              enabled: false
                          }
                      }
                  }]
              }
            });
    </script>
    
@endsection
