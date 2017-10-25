<?php

namespace Bootstrap\Components\AppzioUiKit\Buttons;

trait uiKitButtonHollow {

    /**
     * Renders default UIkit button, takes default color from app / branch or action
     * @param $title
     * @param array $parameters
     * @param array $styles
     * @return mixed
     */

    public function uiKitButtonHollow($title, $parameters=array(), $styles=array()){
        $style['parent_style'] = 'uikit_default_btn';
        $style['border-color'] = isset($styles['border-color']) ? $styles['border-color'] : '#656B6F';
        $style['color'] = isset($styles['color']) ? $styles['color'] : '#656B6F';
        return $this->getComponentText($title,$parameters,$style);
    }



}