<?php

// Defines assoc type to value.
define('ASSOC_NONE', 0);
define('ASSOC_LEFT', 1);
define('ASSOC_RIGHT', 2);

// Setting $operator to an array that defines each operator as a key and sets
// its precedence and associativity.
$operators = array('^' => array(9, ASSOC_RIGHT),
    '*' => array(8, ASSOC_LEFT),
    '/' => array(8, ASSOC_LEFT),
    '+' => array(5, ASSOC_LEFT),
    '-' => array(5, ASSOC_LEFT),
    '(' => array(0, ASSOC_NONE),
    ')' => array(0, ASSOC_NONE));


function precedence($opchar) {
    global $operators;
    return $operators[$opchar][0];
}

function associativity($opchar) {
    global $operators;
    return $operators[$opchar][1];
}

function is_operator($char) {
    global $operators;
    return array_key_exists($char, $operators);
}

function starts_with($haystack, $needle) {
    return !strncmp($haystack, $needle, strlen($needle));
}

function ends_with($haystack, $needle) {
    return substr($haystack, -strlen($needle)) === $needle;
}

function array_peek($stack) {
    return $stack[count($stack) - 1];
}

function postfix($expression) {

    if (!starts_with($expression, '(')) {
        $expression = '('.$expression;
    }

    if (!ends_with($expression, ')')) {
        $expression .= ')';
    }

    $stack = array();
    $output = array();
    $numtoken = '';

    for ($i = 0; $i < strlen($expression); $i++) {
        $char = $expression[$i];

        if (is_operator($char)) {
            if ($numtoken != '') {
                $output[] = $numtoken;
                $numtoken = '';
            }

            if ($char == '(') {
                array_push($stack, $char);
            }
            else if ($char == ')') {
                while (count($stack) > 0 && ($top = array_peek($stack)) != '(') {
                    $output[] = array_pop($stack);
                }

                array_pop($stack);
            }
            else {
                while (count($stack) > 0) {
                    $peek = array_peek($stack);

                    if (associativity($char) == ASSOC_LEFT && precedence($char) <= precedence($peek)
                        || associativity($char) == ASSOC_RIGHT && precedence($char) < precedence($peek)) {
                        $output[] = array_pop($stack);
                    }
                    else {
                        break;
                    }
                }

                array_push($stack, $char);
            }
        }
        else {
            $numtoken .= $char;
        }
    }

    while (count($stack) > 0) {
        if (array_peek($stack) == '(') {
            array_pop($stack);
        }
        else {
            $output[] = array_pop($stack);
        }
    }

    return $output;
}

function postfix_eval($postfix, $variables = array()) {
    $stack = array();

    foreach ($postfix as $token) {
        if (is_operator($token)) {
            $second = array_pop($stack);
            $first = array_pop($stack);

            if ($second == null || $first == null) {

                continue;
            }

            if (!is_numeric($first) && array_key_exists($first, $variables)) {
                $first = $variables[$first];
            }

            if (!is_numeric($second) && array_key_exists($second, $variables)) {
                $second = $variables[$second];
            }



            if ($token == '^') {
                $result = pow($first, $second);
            }
            else {
                $result = eval("return $first $token $second;");
            }

            array_push($stack, $result);
        }
        else {
            if (strlen($token) > 0)
            {
                array_push($stack, $token);
            }
        }
    }

    return array_pop($stack);
}

// Gets equation from JS file, calculates and echos result
if (isset($_GET['equate'])) {
    $expression = $_GET['equate'];
    $postfix = postfix($expression);
    echo('<div id="results">'.$expression);
    echo(' = '.postfix_eval($postfix, array('size' => 121)).'</div>');
}
else {
    if(isset($_GET['equate'])) {
        echo $_GET['equate'];
    } else {
        echo '0';
    }


    

}