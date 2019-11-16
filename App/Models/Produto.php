<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 O propio Eloquent fez o mapeamento e retornou os dados da tabela
 pra isso é preciso sempre colocar o nome da classe em singular no banco de dados em plural
 Ex: usuarios -> Usuario
 carrinhos -> carrinho
 carrinhos_compras -> CarrinhoCompra
 */
class Produto extends Model
{
	//informa quais campos podem ser preenchidos e  salvos no db (sem isso da erro - é medida de segurança do Eloquent\Model)
	protected $fillable = [
		'titulo', 'descricao', 'preco', 'fabricante', 'updated_at', 'created_at'
	];

}

?>