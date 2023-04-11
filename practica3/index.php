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
    <li>
      <div class="listasdestacadas-image">
        <img src="auction-1.jpg" alt="Subasta 1">
      </div>
      <div class="listasdestacadas-title">
        <h3>Subasta 1</h3>
      </div>
    </li>
    <li>
      <div class="listasdestacadas-image">
        <img src="auction-2.jpg" alt="Subasta 2">
      </div>
      <div class="auction-title">
        <h3>Subasta 2</h3>
      </div>
    </li>
    <li>
      <div class="listasdestacadas-image">
        <img src="auction-3.jpg" alt="Subasta 3">
      </div>
      <div class="listasdestacadas-title">
        <h3>Subasta 3</h3>
      </div>
    </li>
    <!-- Agregue más subastas aquí si es necesario -->
  </ul>
</section>

<section>
  <h2>Categorias destacadas</h2>
  <ul class="listasdestacadas">
    <li>
      <div class="listasdestacadas-image">
        <img src="auction-1.jpg" alt="Subasta 1">
      </div>
      <div class="listasdestacadas-title">
        <h3>Subasta 1</h3>
      </div>
    </li>
    <li>
      <div class="listasdestacadas-image">
        <img src="auction-2.jpg" alt="Subasta 2">
      </div>
      <div class="auction-title">
        <h3>Subasta 2</h3>
      </div>
    </li>
    <li>
      <div class="listasdestacadas-image">
        <img src="auction-3.jpg" alt="Subasta 3">
      </div>
      <div class="listasdestacadas-title">
        <h3>Subasta 3</h3>
      </div>
    </li>
    <!-- Agregue más subastas aquí si es necesario -->
  </ul>
</section>
<p>Guia para probar la aplicacion: </p>

<p>Usuario:particular Contraseña:userpass</p>
<p>El boton de buscar de arriba a la derecha una vez logueado muestra todas las subastas y un boton para pujar que lleva a la pagina de esa subasta y permite pujar</p>
<p>Una vez logueado con un usuario cliclando en mi perfil (Arriba a la derecha) te muestra subastas y opciones para modificarlas, eliminarlas o crear nuevas (de momento no hace
filtrado para que muestre las de su usuario solo)</p>
</div>

EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantillaInicio.php', $params);