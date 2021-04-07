<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;

class Paginador extends Model{
    

    public function obtenerNumeroDePaginas($aElementos){

        // establecemos numeros de productos por pagina
        $this->numeroDeProductosPorPagina = 9; 
        /* contamos la cantidad de elementos a paginar dentro del array de elementos
         y lo dividimos por el numero de elementos por pagina que necesitamos */
        $numeroDePaginas = count($aElementos)/$this->numeroDeProductosPorPagina;
        // redondeamos hacia arriba el numero de paginas que necesitamos
        $this->numeroDePaginas = ceil($numeroDePaginas);
        return $this->numeroDePaginas; 

    }


    public function paginar($aElementos,$paginaActual){

        // determinamos cual es la pagina actual
        // primero preguntamos si vino algo por request(botonera de paginas)
        // si = pagina actual = imput que viene de la botonera
        // no = pagina actual = 0; 
        
        $this->paginaActual = $paginaActual;


        /* cortamos el array de elementos en funcion del numero de pagina solicitada.
         La funcion array_slice recibe tres parametros: el array a cortar, la posicion
         desde la que se realizara el corte (inclusive) y el numero de posiciones a cortar*/
        $this->aElementos = array_slice($aElementos, $this->paginaActual * $this->numeroDeProductosPorPagina, $this->numeroDeProductosPorPagina);
        
        return $this->aElementos; 
    }
        

    

}