<?php include 'fungsi/fungsi_kurs_bca.php '; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kurs BCA</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <h3><font color="white"><marquee direction="left" scrollamount="3">Data diambil dari situs resmi Bank BCA <!-- <a>http://www.bca.co.id/id/kurs-sukubunga/kurs_counter_bca/kurs_counter_bca_landing.jsp</a>--></marquee></font></h3>
            <!-- Collect the nav links, forms, and other content for toggling -->
           
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>Kurs BCA</h1>

                <hr>

                <!-- Date/Time -->
                <?php 
                    include 'config/db_connect.php';

                    $queries = "SELECT DISTINCT rec_upd FROM valuta_asing ";
                    $kurs = $con->prepare($queries);
                    $kurs->execute();

                    $valuta = $con->prepare($queries);
                    $valuta->execute();

                    if($kurs->rowCount() > 0)
                    {
                        while ($row = $kurs->fetch(PDO::FETCH_ASSOC)) 
                        {
                          extract($row);?>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $rec_upd;?></p>
                <?php
                        }
                    }
                    ?>
                <hr>

                <!-- Preview Image -->
                <img src="img/Bank_Central_Asia.jpg" class="img-responsive" >         

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                 <!-- Side Widget Well -->
                <div class="well">
                    <h4>Mata Kuliah</h4>
                    <p>Sistem Informasi Terdistribusi</p>
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>NAMA</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">FAFILIA MASROFIN</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">13/344681/SV/03196</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Blog Search Well -->
                <div class="well" >
                    <h4>Pencarian Mata Uang</h4>
                	<form method="post" action="index.php?op=search">
         				<div class="input-group">
	                        <input type="text" name="key" class="form-control">
	                        <span class="input-group-btn">
	                            <button class="btn btn-default" type="submit">
	                                <span class="glyphicon glyphicon-search"></span>
	                        </button>
	                        </span>
	                    </div>
     				 </form>
                    <!-- /.input-group -->
                </div>

            </div>

        </div>
        <!-- /.row -->

         <!-- Content Row -->
         <hr>


        <div class="row">
            <div class="col-md-4">
                <h2>Informasi Kurs</h2>
                 <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Mata Uang</th>
                        <th>Jual</th>
                        <th>Beli</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 

                    $queries = "SELECT mata_uang, jual, beli FROM valuta_asing ";
                    $kurs = $con->prepare($queries);
                    $kurs->execute();

                    $valuta = $con->prepare($queries);
                    $valuta->execute();

                    if($kurs->rowCount() > 0)
                    {
                        while ($row = $kurs->fetch(PDO::FETCH_ASSOC)) 
                        {
                          extract($row);?>
                      <tr>
                        <td><?php echo $mata_uang;?></td>
                        <td><?php echo $jual;?></td>
                        <td><?php echo $beli;?></td>
                     <?php
                        }
                    }
                    ?>
                      </tr>
                    </tbody>
                  </table>
            </div>

            <!-- /.col-md-4 -->
            <div class="col-md-4">
                <h2>Hitung Selisih</h2>                
                
                <form method="POST">
                    <div class="row">
                        <div class="col-md-4">
                          <label for="sel1">Mata Uang</label>
                          <select class="form-control" id="sel1" name="a">
                            <?php 
                            $queries = "SELECT mata_uang, jual FROM valuta_asing ";
                            $kurs = $con->prepare($queries);
                            $kurs->execute();

                            $valuta = $con->prepare($queries);
                            $valuta->execute();

                            if($kurs->rowCount() > 0)
                            {
                                while ($row = $kurs->fetch(PDO::FETCH_ASSOC)) 
                                {
                                  extract($row);?>
                                  <?php echo " <option value='$jual'>{$mata_uang}</option>" ?>
                           <?php
                                }
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label for="sel1">Mata Uang</label>
                          <select class="form-control" id="sel1" name="b">
                            <?php 
                            $queries = "SELECT mata_uang, jual FROM valuta_asing ";
                            $kurs = $con->prepare($queries);
                            $kurs->execute();

                            $valuta = $con->prepare($queries);
                            $valuta->execute();

                            if($kurs->rowCount() > 0)
                            {
                                while ($row = $kurs->fetch(PDO::FETCH_ASSOC)) 
                                {
                                  extract($row);?>
                                  <?php echo " <option value='$mata_uang".'-'."$jual'>{$mata_uang}</option>" ?>
                           <?php
                                }
                            }
                            ?>
                          </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="sel1">Hitung Selisih</label>
                            <input type="submit" class="btn btn-primary" value="Hitung">
                        </div>
                        <?php
                            error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

                            $a = "";
                            $a = $_POST['a'];
                            $b = $_POST['b'];
                            $selisih = $a - $b;
                        ?>
                        <div class="col-md-12">
                        </br>
                                <label>Hasil Selisih</label>
                                <input class="form-control" name='title' placeholder=" Enter Text " value="<?php echo $selisih?>" readonly>
                            </div>
                        
                    </div>
                </form>

            </div>
            <!-- /.col-md-4 -->
            <div class="col-md-4">
            <h2>Hasil Pencarian</h2>
                <?php
                // proses pencarian data
                if (isset($_GET['op']))
                {
                    if ($_GET['op'] == 'search')
                    {
                        require_once('nusoap-0.9.5/lib/nusoap.php');
                        // baca keyword pencarian dari form
                        $key = $_POST['key'];

                        // instansiasi obyek untuk class nusoap client, arahkan URL ke script server.php di server A
                        $client = new nusoap_client('http://localhost/KursBCA/server.php?wsdl');

                        // proses call method 'search' dengan parameter key di script server.php yang ada di server A
                        $result = $client->call('search', array('key' => $key));

                        // jika data hasil pencarian ($result) ada, maka tampilkan
                        if (is_array($result))
                        {
                            echo "<table class=\"table table-hover\">";
                            echo "<tr><th>Mata Uang</th><th>Jual</th><th>Beli</th></tr>";
                            foreach($result as $data)
                            {
                                echo "<tr><td>".$data['mata_uang']."</td><td>".$data['jual']."</td><td>".$data['beli']."</td></tr>";
                            }
                            echo "</table>";
                            // menampilkan jumlah data hasil pencarian
                            echo "<p>Ditemukan ".count($result)." data terkait kata kunci '".$key."'</p>";
                        }
                        else echo "<p>Data tidak ditemukan</p>";
                    }
                }
                ?>

            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <center><p><b>Komputer & Sistem Informasi </b></br><a href="">Universitas Gadjah Mada</a></p></center>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>