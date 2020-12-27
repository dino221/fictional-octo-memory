<?php

namespace RefactoringGuru\Observer\Conceptual;

class Subject implements \SplSubject
{
    public $state;
    public $observers;
    public function __construct()
    {
        $this->observers = new \SplSubjectStorage();
    }
    public function attach(\SplObserver $observer): void 
    {
        echo "Subject:Attached an observer.\n";
        $this->observers->attach($observer);
    }
    public function detach (\SplObserver $observer): void
    {
        $this->observers->detach($observer);
        echo "Subject: Detached an observer. \n";
    }
    public function notify(): void 
    {
        echo "In Subject:I'm doing something important.\n";
        $this->state=rand(0, 10);
        echo "SUbject: My state has just changed to: {$this->state}\n";
        $this->notify();
    }

}
class ConcreteObserverA implements \SplObserver
{
    public function update (\SplSubject $subject): void 
    {
        if ($subject->state<3)
        {
            echo "ConcreteObserverA: Reacted to the event.\n";
        }
    }
}
class ConcreteObserverB implements \SplObserver
{
    public function update (\SplSubject $subject): void 
    {
        if ($subject->state ==0 || $subject->state>=2){
            echo "ConcreteObserverB: Reacted to the event. \n";
        }
    }
}
$subject = new Subject();
$o1 = new ConcreteObserverA();
$subject->attach($o1);

$o2 = new ConcreteObserverB();
$subject->attach($o2);

$subject->someBusinessLogic();
$subject->someBusinessLogic();
$subject->detach($o2);
$subject -> someBusinessLogic();

?>




