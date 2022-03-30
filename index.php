<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Javascrip -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- hoja de estilos -->
    <link rel="stylesheet" href="./css/styles.css">
    <!-- título de página -->
    <title>Título de la página</title>
    <!-- ícono de pàgina -->
    <!-- fuentes -->
</head>

<body>
<?php
    if (file_exists('./xml/encartelera.xml')){
        $films = simplexml_load_file('./xml/encartelera.xml');
    } else {
        exit('Error abriendo cartelera.xml');
    }
?>
<!-- Navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href=".">Inicio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- items -->
                        <?php
                            $aux=[];
                            foreach($films->film as $film){
                                if(!in_array((string)$film['cine'],$aux)){
                                echo '<li class="nav-item">';
                                if (isset($_GET['cine'])&&$_GET['cine']==(string)$film['cine']){
                                    echo '<a class="nav-link active" aria-current="page" href="?cine='.$film['cine'].'">'.$film['cine'].'</a>';
                                }else{
                                    echo '<a class="nav-link" aria-current="page" href="?cine='.$film['cine'].'">'.$film['cine'].'</a>';
                                }
                                echo '</li>';
                                array_push($aux,(string)$film['cine']);
                                }
                            }
                        ?>
                    </ul>
                </div>
    </div>
</nav>
<!-- End Navbar -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/foto1.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/foto2.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/foto3.jpeg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- End carousel -->
<div class="row-c">
    <div class="column-1">
        <table class="table table-dark table-striped">
            <?php
                echo '<tr class="table-secondary">
                     <th>Pelicula</th>
                     <th class="sacar">Descripción</th>
                     <th>Tema</th>
                     </tr>';
                if (isset($_GET['cine'])){
                    foreach($films->film as $film){
                        if ($_GET['cine']==$film['cine']){
                        echo '<tr class="table-success">';
                        echo '<td>'.$film->title. '</td>';
                        // imprimir el contenido del atributo 'tema'
                        echo '<td class="sacar">'.$film->description.'</td>';
                        echo '<td>'.$film->description['tema']. '</td>';
                        echo '</tr>';
                        }
                    }
                } else{
                    foreach($films->film as $film){
                        echo '<tr class="table-success">';
                        echo '<td>'.$film->title.'</td>';
                        echo '<td class="sacar">'.$film->description.'</td>';
                        echo '<td>'.$film->description['tema'].'</td>';
                        echo '</tr>';
                    }
                }
            ?>
            </table>
        </div>
    </div>

</body>

</html>