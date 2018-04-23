<?php

namespace Bootstrap\Components\ClientComponents;
use Bootstrap\Views\BootstrapView;

trait WrapRow {

    /**
     * @param $content array of other objects
     * @param array $parameters selected_state, variable, onclick, style
     * <code>
     * $array = array(
     * 'rightswipeid' => 'item-id-rightswipe',  // this is a compound of item id & action of swipe right
     * 'leftswipeid'   => 'item-id-leftswipe', // this is a compound of item id & action of swipe left
     * 'onclick' => $onclick, // this must be an object or an array of objects
     * 'id' => 'mycustomid',
     * 'swipe_id' => 'swipeareaid' // refers to swipearea in the view
     * );
     * </code>
     * @param array $styles -- please see the link for more information about parameters [link] Bootstrap\Components\ComponentStyles
     * @since 1.0
     * @return \stdClass
     */

    public function getComponentWrapRow(array $content, array $parameters=array(),array $styles=array()) {
        /** @var BootstrapView $this */

		$obj = new \StdClass;
        $obj->type = 'wrap-row';
        $obj->row_content = $content;

        $obj = $this->attachStyles($obj,$styles);
        $obj = $this->attachParameters($obj,$parameters);

        return $obj;
	}

}