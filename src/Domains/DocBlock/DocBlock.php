<?php declare(strict_types=1);

namespace Soyhuce\Somake\Domains\DocBlock;

use Illuminate\Support\Collection;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocChildNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\ConstExprParser;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use PHPStan\PhpDocParser\Parser\TypeParser;
use PHPStan\PhpDocParser\ParserConfig;
use ReflectionClass;
use function in_array;

class DocBlock
{
    private PhpDocParser $phpDocParser;

    private Lexer $lexer;

    public function __construct()
    {
        $config = new ParserConfig([]);
        $constExprParser = new ConstExprParser($config);
        $typeParser = new TypeParser($config, $constExprParser);

        $this->lexer = new Lexer($config);
        $this->phpDocParser = new PhpDocParser($config, $typeParser, $constExprParser);
    }

    /**
     * @param class-string $class
     * @param array<string> $types
     * @return Collection<int, DocTag>
     */
    public function getTags(string $class, array $types): Collection
    {
        $phpDoc = $this->getClassDocBlock($class);

        if ($phpDoc === null) {
            return new Collection();
        }

        $docNode = $this->phpDocParser->parse(new TokenIterator($this->lexer->tokenize($phpDoc)));

        return collect($docNode->children)
            ->filter(fn (PhpDocChildNode $node) => $node instanceof PhpDocTagNode)
            ->filter(fn (PhpDocTagNode $node) => in_array($node->name, $types))
            ->map(fn (PhpDocTagNode $node) => new DocTag($node->value->propertyName ?? null, (string) $node->value->type))
            ->values();
    }

    /**
     * @param class-string<object> $class
     */
    private function getClassDocBlock(string $class): ?string
    {
        $block = (new ReflectionClass($class))->getDocComment();

        if ($block === false) {
            return null;
        }

        return $block;
    }
}
