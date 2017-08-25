<?php

namespace Bootstrap\Components\Elements;
use Bootstrap\Views\BootstrapView;

trait ConfirmationDialog {

    /**
     * @param $content string, no support for line feeds
     * @param array $styles 'margin', 'padding', 'orientation', 'background', 'alignment', 'radius', 'opacity',
     * 'orientation', 'height', 'width', 'align', 'crop', 'text-style', 'font-size', 'text-color', 'border-color',
     * 'border-width', 'font-android', 'font-ios', 'background-color', 'background-image', 'background-size',
     * 'color', 'shadow-color', 'shadow-offset', 'shadow-radius', 'vertical-align', 'border-radius', 'text-align',
     * 'lazy', 'floating' (1), 'float' (right | left), 'max-height', 'white-space' (no-wrap), parent_style
     * @param array $parameters selected_state, variable, onclick, style
     * @return \stdClass
     */

    public function getComponentConfirmationDialog($onclick_yes,$div,$text=false){
        /** @var BootstrapComponent $this */

        $out[] = $this->getComponentText('{#are_you_sure#}?',array('style' => 'confirmation_title'));
        $out[] = $this->getComponentText('',array('style' => 'confirmation_divider'));

        $onclick_cancel = $this->getOnclickHideDiv($div);

        if($text){
            $out[] = $this->getComponentSpacer(10);
            $out[] = $this->getComponentText($text,array('style' => 'confirmation_dialogtext'));
        }

        $btn[] = $this->getComponentText('{#cancel#}',array('onclick' =>$onclick_cancel,'style' => 'confirmation_btn'));
        $btn[] = $this->getComponentVerticalSpacer('10');
        $btn[] = $this->getComponentText('{#yes#}',array('onclick' =>$onclick_yes,'style' => 'confirmation_btn'));

        $out[] = $this->getComponentRow($btn,array(),array('text-align' => 'center','margin' => '20 20 10 20'));

        return $this->getComponentColumn($out,array('style' => 'confirmationdialog'));





    }

}