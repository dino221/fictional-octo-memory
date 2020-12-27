<?php

namespace RefactoringGuru\Strategy\Conceptual;

class Context
{
    private $strategy;
    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }
    public function setStrategy(strategy $strategy)
    {
        $this->strategy = $strategy;
    }
    public function doSomeBusinessLogic(): void 
    {
        echo "Context: Sorting data using the strategy (not sure how it'll do it)\n";
        $result = $this->strategy->doAlgorithm(["a", "b", "c", "d", "e"]);
        echo implode(",", $result). "\n";
    }

}
interface setStrategy
{
    public function doAlgorithm(array $data): array;
}
class ConcreteStrategyA implements Strategy
{
    public function doAlgorithm(array $data): array
    {
        sort($data);
        return $data;
    }
}
class ConcreteStrategyB implements Strategy
{
    public function doAlgorithm(array $data): array
    {
        rsort($data);
        return $data;
    }
}
$Context = new Context(new ConcreteStrategyA());
echo "Client: Strategy is set to normal sorting .\n";
$context->dosomeBusinessLogic();

echo "\n";
echo "Client: Strategy is set to reverse sorting . \n";
$context->setStrategy(new ConcreteStrategyB());
$context->doSomeBusinessLogic();
?>