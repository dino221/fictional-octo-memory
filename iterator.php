<?php

class AlphabeticalOrder implements \Iterator
{
    private $collection;
    private $position;
    private $reverse = false;
    public function __construct($collection,$reverse = false)
    {
        $this->collection = $collection;
        $this -> reverse = $reverse;
    }

    public function rewind()
    {
        $this->position = $this->reverse ?
            count($this->collection->getItems())-1:0;
    }
    public function current()
    {
        return $this->collection->getItems()[$this->position];
    }
    public function key()
    {
        return $this->position;
    }
    public function next()
    {
        $this->position = $this->position + ($this->reverse ? -1:1);
    }
    public function valid()
    {
        return isset ($this->collection -> getItems()[$this->position]);
    }
}

class WordsCollection implements \IteratorAggregate
{
    private $items = [];
    public function getItems()
    {
        return $this->items;
    }
    public function addItem($item)
    {
        $this->items[] = $item;
    }
    public function getIterator(): getIterator
    {
        return new AlphabeticalOrderIterator ($this, true);
    }
    
}

$collection = new WordsCollection;
$collection -> addItem("First");
$collection -> addItem("Second");
$collection -> addItem("Third");

echo "Straight traversal:\n";
foreach ($collection->getIterator() as $item) {
    echo $item . "\n";
}
echo "\n";
echo "Reverse traversal:\n";
foreach ($collection->getReverseIterator() as $item) {
    echo $item . "\n";
}


