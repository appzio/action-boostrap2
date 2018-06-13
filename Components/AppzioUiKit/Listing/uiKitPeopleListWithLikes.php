<?php

namespace Bootstrap\Components\AppzioUiKit\Listing;
use Bootstrap\Views\BootstrapView;

trait uiKitPeopleListWithLikes
{

    public function uiKitPeopleListWithLikes(array $content, array $parameters=array(),array $styles=array()) {

        $rows = array();

        foreach($content as $user){
            $rows[] = $this->getUserRowListingWithLikes($user,$parameters);
        }

        if ($rows) {
            return $this->getComponentColumn($rows);
        }

        return $this->getComponentText('{#no_users_found_at_the_monent#}', array('style' => 'jm_notification_text'));
    }

    public function getUserRowListingWithLikes($user,$parameters){

        if(!isset($user['play_id'])){
            return $this->getComponentText('');
        }

        $tab = isset($parameters['tab']) ? $parameters['tab'] : 1;

        $id = $user['play_id'];
        $profilepic = isset($user['profilepic']) ? $user['profilepic'] : 'anonymous-person.png';
        $firstname = isset($user['firstname']) ? $user['firstname'] : '{#anonymous#}';
        $age = isset($user['age']) ? $user['age'] : false;

        $text_column_width = $this->screen_width - 170;

        if($age){
            $firstname .= ', '.$age;
        }

        $row[] = $this->getComponentImage($profilepic,[
            'style' => 'uikit_ukp_profilepic',
            'imgwidth' => '300',
            'priority' => '9',
            'onclick' => $this->uiKitOpenProfile($id)],[]);

        $name[] = $this->getComponentText($firstname,[
            'style' => 'uikit_ukp_name',
            'onclick' => $this->uiKitOpenProfile($id)]);

        if(isset($parameters['extra_icon']) AND isset($user['instagram_username']) AND $user['instagram_username']){
            $onclick = $this->getOnclickOpenUrl('https://instagram.com/'.$user['instagram_username']);
            $name[] = $this->getComponentImage($parameters['extra_icon'],[
                'style' => 'uikit_ukp_extraicon',
                'onclick' => $onclick]);
        }

        $row[] = $this->getComponentColumn($name,[],['width' => $text_column_width]);

        $icons = array();

        if(isset($parameters['icon_dont_like']) AND $parameters['like_route']){
            $click = $this->getOnclickSubmit($parameters['like_route'].'unlike/'.$user['play_id']);
            $icons[] = $this->getComponentImage($parameters['icon_dont_like'],['style' => 'uikit_ukp_iconpic','onclick' => $click]);
        }

        if(isset($parameters['icon_bookmark']) AND isset($parameters['icon_bookmark_active']) AND $parameters['bookmark_route']){
            $like[] = $this->getOnclickHideElement('unliked'.$id.$tab,['transition' => 'none']);
            $like[] = $this->getOnclickShowElement('liked'.$id.$tab,['transition' => 'none']);
            $like[] = $this->getOnclickSubmit($parameters['bookmark_route'].'bookmark/'.$id,['loader_off' => true]);

            $unlike[] = $this->getOnclickHideElement('liked'.$id.$tab,['transition' => 'none']);
            $unlike[] = $this->getOnclickShowElement('unliked'.$id.$tab,['transition' => 'none']);
            $unlike[] = $this->getOnclickSubmit($parameters['bookmark_route'].'removebookmark/'.$id,['loader_off' => true]);

            if(isset($user['bookmark']) AND $user['bookmark']){
                $icons[] = $this->getComponentImage($parameters['icon_bookmark'],[
                    'style' => 'uikit_ukp_iconpic','onclick' => $like,'id' => 'unliked'.$id.$tab,'visibility' => 'hidden']);
                $icons[] = $this->getComponentImage($parameters['icon_bookmark_active'],[
                    'style' => 'uikit_ukp_iconpic','onclick' => $unlike,'id' => 'liked'.$id.$tab]);
            } else {
                $icons[] = $this->getComponentImage($parameters['icon_bookmark'],[
                    'style' => 'uikit_ukp_iconpic','onclick' => $like,'id' => 'unliked'.$id.$tab]);
                $icons[] = $this->getComponentImage($parameters['icon_bookmark_active'],[
                    'style' => 'uikit_ukp_iconpic','onclick' => $unlike,'id' => 'liked'.$id.$tab,'visibility' => 'hidden']);
            }

        }elseif(isset($parameters['icon_bookmark'])){
            $icons[] = $this->getComponentImage($parameters['icon_bookmark'],['style' => 'uikit_ukp_iconpic']);
        }

        if(isset($parameters['icon_like'])){
            $click = $this->getOnclickSubmit($parameters['like_route'].'like/'.$user['play_id']);
            $icons[] = $this->getComponentImage($parameters['icon_like'],['style' => 'uikit_ukp_iconpic','onclick' => $click]);
        }
        
        $row[] = $this->getComponentRow($icons,[],['float' => 'right','floating' => '1', 'text-align' => 'right']);

        $col[] = $this->getComponentRow($row,[],['padding' => '20 20 10 20','width' => '100%']);
        $col[] = $this->getComponentDivider();

        return $this->getComponentColumn($col,[],[]);

    }

}