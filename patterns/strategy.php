<?php
/*
 * 策略模式 
 * author : adair
 * date : 2019.07.30
 * 策略模式适用于将一组算法移入到一个独立的类型中。
 
 *适用场景：
 * 1、多个类只区别在表现行为不同，可以使用Strategy模式，在运行时动态选择具体要执行的行为。
 * 2、需要在不同情况下使用不同的策略(算法)，或者策略还可能在未来用其它方式来实现。
 * 3、对客户隐藏具体策略(算法)的实现细节，彼此完全独立。
 * 4、客户端必须知道所有的策略类，并自行决定使用哪一个策略类，策略模式只适用于客户端知道所有的算法或行为的情况。
 * 5、策略模式造成很多的策略类，每个具体策略类都会产生一个新类。
 * 有时候可以通过把依赖于环境的状态保存到客户端里面，可以使用享元模式来减少对象的数量。

 *原文：https://blog.csdn.net/jhq0113/article/details/45771863 
*/
 
/**抽象策略角色
 * Interface RotateItem
 */
interface RotateItem
{
    function inertiaRotate();
    function unInertisRotate();
}
 
/**具体策略角色——X产品
 * Class XItem
 */
class XItem implements RotateItem
{
    function inertiaRotate()
    {
        echo "我是X产品，我惯性旋转了。<br/>\n";
    }
 
    function unInertisRotate()
    {
        echo "我是X产品，我非惯性旋转了。<br/>\n\n";
    }
}
 
/**具体策略角色——Y产品
 * Class YItem
 */
class YItem implements RotateItem
{
    function inertiaRotate()
    {
        echo "我是Y产品，我<span style='color: #ff0000;'>不能</span>惯性旋转。<br/>\n";
    }
 
    function unInertisRotate()
    {
        echo "我是Y产品，我非惯性旋转了。<br/>\n\n";
    }
}
 
/**具体策略角色——XY产品
 * Class XYItem
 */
class XYItem implements RotateItem
{
    function inertiaRotate()
    {
        echo "我是XY产品，我惯性旋转。<br/>\n";
    }
 
    function unInertisRotate()
    {
        echo "我是XY产品，我非惯性旋转了。<br/>\n\n";
    }
}
 
class contextStrategy
{
    private $item;
 
    function getItem($item_name)
    {
        try
        {
            $class=new ReflectionClass($item_name);
            $this->item=$class->newInstance();
        }
        catch(ReflectionException $e)
        {
            $this->item="";
        }
    }
 
    function inertiaRotate()
    {
        $this->item->inertiaRotate();
    }
 
    function unInertisRotate()
    {
        $this->item->unInertisRotate();
    }
}

$strategy=new contextStrategy();
 
echo "<span style='color: #ff0000;'>X产品</span><hr/>\n";
$strategy->getItem('XItem');
$strategy->inertiaRotate();
$strategy->unInertisRotate();
 
echo "<span style='color: #ff0000;'>Y产品</span><hr/>\n";
$strategy->getItem('YItem');
$strategy->inertiaRotate();
$strategy->unInertisRotate();
 
echo "<span style='color: #ff0000;'>XY产品</span><hr/>\n";
$strategy->getItem('XYItem');
$strategy->inertiaRotate();

$strategy->unInertisRotate();


/*
rst:
<span style='color: #ff0000;'>X产品</span><hr/>
我是X产品，我惯性旋转了。<br/>
我是X产品，我非惯性旋转了。<br/>

<span style='color: #ff0000;'>Y产品</span><hr/>
我是Y产品，我<span style='color: #ff0000;'>不能</span>惯性旋转。<br/>
我是Y产品，我非惯性旋转了。<br/>

<span style='color: #ff0000;'>XY产品</span><hr/>
我是XY产品，我惯性旋转。<br/>
我是XY产品，我非惯性旋转了。<br/>


*/
