<?php

namespace Potherca\Scanner\Identifier;

use PhpParser\Node;
use Potherca\Scanner\Identity;
use Potherca\Scanner\Node\NodeValue;

interface IdentifierInterface/* extends SupportsNodeInterface*/
{
    //////////////////////////// SETTERS AND GETTERS \\\\\\\\\\\\\\\\\\\\\\\\\\\
    /**
     * Provides a list of all the NodeTypes the identifier identifies
     *
     * @return array
     */
    public function getSupportedNodeTypes();

    public function getSupportedIdentities();

    //////////////////////////////// PUBLIC API \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

    /**
     * Create an Identifier object.
     *
     * The constructor is passed an array of options. It is each Identifier's
     * own responsibility to retrieve relevant options from the given array.
     *
     * @param array $options
     * @param NodeValue $nodeValue
     */
    public function __construct(array $options, NodeValue $nodeValue);

    /**
     * @param Node $node The Node to identify
     * @param array $options Any extra options to pass to the identifier
     *
     * @return Identity The identity of the given node
     */
    public function identify(Node $node, array $options = []);

    /**
     * Returns the textual value of a subject.
     *
     * The subject can be any type (scalar, array, object, resource)
     *
     * @param mixed $subject
     *
     * @return string
     */
    public function getValue($subject);

    /**
     * Validates if a given node type is supported.
     *
     * @param string $nodeType
     *
     * @return bool Whether or not a certain Node Type is supported
     */
    public function supportsNodeType($nodeType);
}

/*EOF*/
