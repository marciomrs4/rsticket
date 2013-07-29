/**
 * maxlength( length ): M�ximo de caracteres
rangelength( range ): Faz com que o elemento requer um intervalo de valores dado
max( value ): Valor m�ximo permitido
url( ): URL v�lida
date( ): Data v�lida
dateISO( ): Data ISO v�lida
number( ): Campo num�rico
digits( ): S� aceita d�gitos
creditcard( ): Um n�mero de cart�o de cr�dito
equalTo( other ): igual � um determinado valor
 */

var $valida = jQuery.noConflict();


var usuario  = 'Utilizador';
var problema = 'Servi�o';
var ramal = 'Extens�o';
var senha = 'Palavra-passe';

/*
var usuario  = 'Usu�rio';
var problema = 'Problema';
var ramal = 'Ramal';
var senha = 'Senha';
*/

$valida(document).ready( function() 
{
	
	$valida("#meuproblema").validate({
		/* REGRAS DE VALIDA��O DO FORMUL�RIO */
		rules:{
			pro_descricao:{
				required: true, /* Campo obrigat�rio */
				minlength: 5    /* No m�nimo 5 caracteres */
			},
			dep_codigo_problema:{
				required: true
			}
		},
		/* DEFINI��O DAS MENSAGENS DE ERRO */
		messages:{
			pro_descricao:{
				required: "Preencha o campo <u>" +problema+ "</u>",
				minlength: "O campo <u>" +problema+ "</u> deve conter no m�nimo 5 caracteres"
			},
			dep_codigo_problema:{
				required: "Campo Departamento � Obrigadorio"
			}
		}
	});

	$valida("#projeto").validate({

		rules:{
			pro_titulo:{
				required: true, /* Campo obrigat�rio */
				minlength: 5    /* No m�nimo 5 caracteres */
			},
			pro_descricao:{
				required: true
			}
		},
		messages:{
			pro_titulo:{
				required: "Preencha o campo <u>Titulo</u>",
				minlength: "O campo <u>Projeto</u> deve conter no m�nimo 5 caracteres"
			},
			pro_descricao:{
				required: "Campo Descri��o do projeto � Obrigadorio"
			}
		}
	});
	
		/*Inicio de valida��o do formul�rio de solicitacao*/
		$valida("#solicitacao").validate({
			/* REGRAS DE VALIDA��O DO FORMUL�RIO */
			rules:{
				dep_codigo:{
					required: true
				},
				pro_codigo:{
					required: true
				},
				sol_descricao_solicitacao:{
					required: true,
					minlength: 20
				}
			},
			/* DEFINI��O DAS MENSAGENS DE ERRO */
			messages:{
				dep_codigo:{
					required: "O campo departamento � obrigat�rio"
				},
				pro_codigo:{
					required: "O campo " +problema+ " � obrigat�rio"
				},
				sol_descricao_solicitacao:{
					required: "O campo Descri��o do " +problema+ " � obrigat�rio",
					minlength: "O campo Descri��o do " +problema+ " precisa de ao menos 20 caracteres"
				}
			}
		});
		/*Fim de valida��o do formul�rio de solicitacao*/
			
	
})(jQuery);