/**
 * maxlength( length ): Máximo de caracteres
rangelength( range ): Faz com que o elemento requer um intervalo de valores dado
max( value ): Valor máximo permitido
url( ): URL válida
date( ): Data válida
dateISO( ): Data ISO válida
number( ): Campo numérico
digits( ): Só aceita dígitos
creditcard( ): Um número de cartão de crédito
equalTo( other ): igual à um determinado valor
 */

var $valida = jQuery.noConflict();

$valida(document).ready( function() 
{
	$valida("#meuproblema").validate({
		/* REGRAS DE VALIDAÇÃO DO FORMULÁRIO */
		rules:{
			pro_descricao:{
				required: true, /* Campo obrigatório */
				minlength: 5    /* No mínimo 5 caracteres */
			},
			dep_codigo_problema:{
				required: true
			}
		},
		/* DEFINIÇÃO DAS MENSAGENS DE ERRO */
		messages:{
			pro_descricao:{
				required: "Preencha o campo <u>Problema</u>",
				minlength: "O campo <u>Problema</u> deve conter no mínimo 5 caracteres"
			},
			dep_codigo_problema:{
				required: "Campo Departamento é Obrigadorio"
			}
		}
	});

	$valida("#projeto").validate({

		rules:{
			pro_titulo:{
				required: true, /* Campo obrigatório */
				minlength: 5    /* No mínimo 5 caracteres */
			},
			pro_descricao:{
				required: true
			}
		},

		messages:{
			pro_titulo:{
				required: "Preencha o campo <u>Titulo</u>",
				minlength: "O campo <u>Projeto</u> deve conter no mínimo 5 caracteres"
			},
			pro_descricao:{
				required: "Campo Descrição do projeto é Obrigadorio"
			}
		}
	});

	/*Inicio de validação do formulário de solicitacao*/
	$valida("#solicitacao").validate({

		rules:{
			dep_codigo:{
				required: true
			},
			pro_codigo:{
				required: true
			},

			sol_descricao_solicitacao:{ 
				required: true,
				minlength: 10

			}
		},

		messages:{
			dep_codigo:{
				required: "O campo Departamento é obrigatório"
			},
			pro_codigo:{
				required: "O Campo Problema é obrigatório"
			},

			sol_descricao_solicitacao:{ 
				required: "A Descrição do Chamado é obrigatório",
				minlength: "O campo Descrição deve ter ao menos 10 caracteres"

			}
		}
	});	
	/*Fim de validação do formulário de solicitacao*/

})(jQuery);