<?php

namespace Luxifer\DQL\Datetime;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * DateFunction ::= "DAYOFMONTH" "(" ArithmeticPrimary ")"
 * @author Florent Viel <fviel@wanadev.fr>
 */
class DayOfMonth extends FunctionNode
{
    public $dateExpression;

    public function parse(Parser $parser): void
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->dateExpression = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        return 'DAYOFMONTH(' .
            $this->dateExpression->dispatch($sqlWalker) .
        ')'; 
    }
}
