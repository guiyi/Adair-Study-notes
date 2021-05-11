# Jquery 核心
## - jQuery([selector,[context]])
这个函数接收一个包含CSS选择器到字符串，然后用这个字符串去匹配一组元素。

jQuery的核心功能是通过这个函数实现的。jQuery中的一切都基于这个函数，或者说都是在以某种方式使用这个函数。这个函数最基本的用法就是向它传递一个表达式(通常由CSS选择器组成)，然后根据这个表达式来查找所有匹配的元素。

默认情况下，如果没有指定context参数，$()将在当前的HTML document中查找DOM元素；如果指定了context参数，如一个DOM元素集或jQuery对象，那就会在这个context中查找。在jQuery1.3.2以后，其返回的元素顺序等同于在context中出现的先后顺序。

参考文档中 选择器 部分获取更多的expression参数的CSS语法的信息。


selector,[context]                                      String，Element，/jQuery
    selector:用来查找字符串
    context:作为待查找的 DOM 元素集、文档或 jQuery对象

element                                                 Element
    一个用于封装成jQuery对象的DOM元素

object                                                  object
    一个用于封装成jQuery对象

elementArray                                            Element
    一个用于封装成jQuery对象的DOM元素数组

jQuery object                                           object
    一个用于克隆的jQuery对象

jQuery()
    返回一个空的jQuery对象


## - jQuery([selector,[context]])