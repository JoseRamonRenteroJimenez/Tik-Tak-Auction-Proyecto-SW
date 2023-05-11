<?php
namespace es\ucm\fdi\aw\mensajes;

use es\ucm\fdi\aw\Aplicacion;
use es\ucm\fdi\aw\Formulario;

class Chat extends Formulario
{

    public function __construct() {
        parent::__construct('formObjeto', ['enctype' => 'multipart/form-data', 'urlRedireccion' => Aplicacion::getInstance()->resuelve('/index.php')]);
    }
    
    protected function generaCamposFormulario(&$datos)
    {
        $app=Aplicacion::getInstance();
        $emisorId=$app->idUsuario();

        $id_SubastaAso= '';
        $receptorId= '';
        
        $mensaje= '';
        $fecha= '';

        if(isset($_POST['idsubasta'])){
            $id_SubastaAso= $_POST['idsubasta'];
            $receptorId= $_POST['receptor'];
            $tituloproducto= $_POST['tituloproducto'];

                 
        }
        $nombreReceptor ="";
        $nombreReceptor = \es\ucm\fdi\aw\usuarios\Usuario::buscaPorId($receptorId);
        if($nombreReceptor){
            $nombreReceptor = $nombreReceptor->getNombre();
        }else{
            $nombreReceptor =$datos['incoming_id'];
        }
        $subasta =  \es\ucm\fdi\aw\subastas\Subasta::buscaPorId($id_SubastaAso);
        if($subasta){
            $tituloSubasta = $subasta->getTitulo();
        }else{
            $tituloSubasta =$datos['tituloSubasta'];
        }
        
        // Se generan los mensajes de error si existen. (Si se usa EOF js no puede detectar los)     
        
        $html = '<div class="wrapper">';
        $html .= '<section class="chat-area">';
       
        $html .= '<div class="details">';
        $html .= '<span> <p>Destinatario: ' . $nombreReceptor . '</span></p>';
        $html .= '<p>Subasta: ' . $tituloSubasta . '</p>';
        $html .= '</div>';
       
        $html .= '<div class="chat-box" id="chat-box"></div>';
        echo '<form action="#" class="typing-area" id="typing-area">';
        echo'<input type="text" class="incoming_id" id="incoming_id" name="incoming_id" value="' . $receptorId . '" hidden>';
        echo'<input type="text" class="subasta_id" id="subasta_id" name="subasta_id" value="' . $id_SubastaAso . '" hidden>';
        echo'<input type="text" name="message" id="input-field" class="input-field" placeholder="Escribe tu mensaje aquí..." autocomplete="off">';
        echo '<button id="button">Enviar</button>';
        echo'</form>';
        $html .= '</section>';
        $html .= '</div>';
       
       return $html;
    }   

    protected function procesaFormulario(&$datos)
    {
                  
        
    }
}