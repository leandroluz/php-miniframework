<?php

/* 
* classe TFilter
* essa classe provê uma interface para definição de filtros de seleção
*/

class TFilter extends TExpression
{
    private $variable; // variável
    private $operator; // operador
    private $value; //valor

    /* 
    * método __construct()
    * instancia um novo filtro
    * @param $variable = variável
    * @param $operator = operador 
    */

    public function __construct($variable, $operator, $value)
    {
        // armazena as propriedades
        $this->variable = $variable;
        $this->operator = $operator;

        // transforma o valor de acordo com certas regras
        // antes de atribuir à propriedade $this->value

        $this->value = $this->transform($value);
    }

    /*
    * método transform()
    * recebe um valor e faz as modificações necessárias
    * para ser interpretado pelo banco de dados
    * podendo ser um integer/string/boolean ou array
    * @param $value = valor a ser atribuido
    */

    private function transform($value)
    {
        // caso seja um array
        if(is_array($value))
        {
            // percorre os valores
            foreach ($value as $x)
            {
                // se for um inteiro
                if (is_integer($x))
                {
                    $foo[]=$x;
                }
                else if (is_string($x))
                {
                    // se for uma string adiciona aspas
                    $foo[]="'$x'";
                }
            }
            // converte a array em string separada por ","
            $result = '(' . implode(',', $foo) . ')';
        }

        // caso seja uma string
        if (is_string($value))
        {
            // adiciona aspas
            $result = "'$value'";
        }

        // caso seja um valor nulo
        else if(is_null($value))
        {
            $result = 'NULL';
        }

        // caso seja um valor boleano
        else if (is_bool($value))
        {
            // armazena true ou false
            $result = $value ? 'TRUE' : 'FALSE';
        }
        else
        {
            $result = $value;
        }
        // retorna o valor
        return $result;
    }

    /*
    * método dump()
    * retorno o filtro em forma de expressão
    */
    public function dump()
    {
        return "{$this->variable} {$this->operator} {$this->value}";
    }
}
