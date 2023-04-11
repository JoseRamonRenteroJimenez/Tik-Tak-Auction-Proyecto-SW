<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Portada';

$contenidoPrincipal=<<<EOS

<header>
  <nav>
    <ul>
EOS; 
$contadorcategorias=0;
$categorias = es\ucm\fdi\aw\subastas\Categorias::listarCategorias();
$subastas= es\ucm\fdi\aw\subastas\Subasta::listarSubastas("");

/*foreach($categorias as $categoria2) { */ 
  for($contadorcategorias;$contadorcategorias<10;$contadorcategorias++){
$contenidoPrincipal .=<<<EOS
     <li><a href="/sw/practica3/vistaSubastaObjeto.php?barra=&categoria={$categorias[$contadorcategorias]->getId()}">{$categorias[$contadorcategorias]->getNombre()}</a> </li>
     EOS;
  }
$contenidoPrincipal .=<<<EOS
      <li class="dropdown">
        <a href="#">Más categorías</a>
        <ul class="dropdown-content">
  EOS;  
  for($contadorcategorias;$contadorcategorias<count($categorias);$contadorcategorias++){
        $contenidoPrincipal .=<<<EOS
        <li><a href="/sw/practica3/vistaSubastaObjeto.php?barra=&categoria={$categorias[$contadorcategorias]->getId()}">{$categorias[$contadorcategorias]->getNombre()}</a> </li>
        EOS;
  }       
  

$contenidoPrincipal .=<<<EOS
                  </ul>
          </li>
        </ul>
      </nav>
    </header>
    <section>
    <div class="carousel-container">
      <div class="slides">
        <div class="slide">
          <img src="img1.jpg" alt="Imagen 1">
          <h3>Título de la imagen 1</h3>
        </div>
        <div class="slide">
          <img src="img2.jpg" alt="Imagen 2">
          <h3>Título de la imagen 2</h3>
        </div>
        <div class="slide">
          <img src="img3.jpg" alt="Imagen 3">
          <h3>Título de la imagen 3</h3>
        </div>
      </div>
      <button class="prev-btn">Anterior</button>
      <button class="next-btn">Siguiente</button>
    </div>
    <div id="carrusel">
    </section>
    <section>
      <h2>Subastas destacadas</h2>
      <ul class="listasdestacadas">

  EOS;
      for($contador=0;$contador<7;$contador++) {  

        $contenidoPrincipal .=<<<EOS
            <li>
              <div class="listasdestacadas-image">
                <img src="auction-1.jpg" alt="Subasta 1">
              </div>
              <div class="listasdestacadas-title">
                <h3><a href="/sw/practica3/vistaSubastaObjeto.php?barra=&categoria={$subastas[$contador]->getIdSubasta()}">{$subastas[$contador]->getTitulo()}</a></h3>
              </div>
            </li>
      EOS;
    }
  $contenidoPrincipal .="  </ul></section> <section>  <h2>Categorias destacadas</h2> <ul class='listasdestacadas'>";

for($contador=0;$contador<7;$contador++) {  

    $contenidoPrincipal .=<<<EOS
        <li>
          <div class="listasdestacadas-image">
            <img src="Categoria-1.jpg" alt="Categorias">
          </div>
          <div class="listasdestacadas-title">
            <h3><a href="/sw/practica3/vistaSubastaObjeto.php?barra=&categoria={$categorias[$contador]->getId()}">{$categorias[$contador]->getNombre()}</a></h3>
          </div>
        </li>
  EOS;
}
      $contenidoPrincipal .= "</ul> </section>";
    


$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaInicio.php', $params);