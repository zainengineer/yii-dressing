<?php
Yii::import('bootstrap.widgets.TbNavbar');

/**
 * Class Navbar
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-dressing
 * @license http://www.gnu.org/copyleft/gpl.html
 *
 * @package dressing.widgets
 */
class YdNavbar extends TbNavbar
{
    /**
     * @var array navigation items that cannot be collapsed.
     */
    public $constantItems = array();

    /**
     * Runs the widget.
     */
    public function run()
    {
        $this->htmlOptions['id'] = $this->id;
        $this->brandOptions['id'] = 'brand';

        $containerCssClass = $this->fluid ? 'container-fluid' : 'container';

        echo CHtml::openTag('div', $this->htmlOptions);
        echo '<div class="navbar-inner"><div class="' . trim($containerCssClass) . '">';

        if ($this->collapse) {
            echo '<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">';
            echo '<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>';
            echo '</a>';
        }

        foreach ($this->constantItems as $item) {
            if (is_string($item))
                echo $item;
            else {
                if (isset($item['class'])) {
                    $className = $item['class'];
                    unset($item['class']);

                    $this->controller->widget($className, $item);
                }
            }
        }

        if ($this->brand !== false)
            echo CHtml::openTag('a', $this->brandOptions) . $this->brand . '</a>';

        if ($this->collapse)
            echo '<div class="nav-collapse">';

        foreach ($this->items as $item) {
            if (is_string($item))
                echo $item;
            else {
                if (isset($item['class'])) {
                    $className = $item['class'];
                    unset($item['class']);

                    $this->controller->widget($className, $item);
                }
            }
        }

        if ($this->collapse)
            echo '</div>';

        echo '</div></div></div>';
    }
}
