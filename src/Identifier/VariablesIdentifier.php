<?php

namespace Potherca\Scanner\Identifier;

use PhpParser\Node;
use Potherca\Scanner\Exception\NotYetImplementedException;
use Potherca\Scanner\Identity;
use Potherca\Scanner\Node\NodeValue;
use Potherca\Scanner\Node\NodeType;

class VariablesIdentifier implements IdentifierInterface
{
    ////////////////////////////// CLASS PROPERTIES \\\\\\\\\\\\\\\\\\\\\\\\\\\\
    /** @var NodeValue */
    private $nodeValue;

    private static $internalVariables = [
        '$_COOKIE',
        '$_ENV',
        '$_FILES',
        '$_GET',
        '$_POST',
        '$_REQUEST',
        '$_SERVER',
        '$argc',
        '$argv',
        '$this',
    ];

    //////////////////////////// SETTERS AND GETTERS \\\\\\\\\\\\\\\\\\\\\\\\\\\
    final public function getSupportedNodeTypes()
    {
        return [
            NodeType::EXPR_VARIABLE,
        ];
    }

    //////////////////////////////// PUBLIC API \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    final public function __construct(array $options, NodeValue $nodeValue)
    {
        $this->nodeValue = $nodeValue;
        // Nothing to do with options
    }

    /**
     * @param Node $node The Node to identify
     *
     * @return Identity
     *
     * @throws NotYetImplementedException
     */
    public function identify(Node $node)
    {
        $identity = Identity\IdentityType::NONE;

        $value = $this->getValue($node);

        if (in_array($value, self::$internalVariables, true)) {
            $identity = Identity\IdentityType::USAGE_INTERNAL_VARIABLE;
        }

        return new Identity([$identity], $value);
    }

    final public function getValue($subject)
    {
        return $this->nodeValue->getValue($subject);
    }
}

/*EOF*/