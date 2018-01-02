<?php

namespace Bootstrap\Components\AppzioUiKit\Articles;

trait uiKitArticleItem {

	private $height_propertion = 5.5;

    public function uiKitArticleItem( $article, $category_data ){

	    $stack = array(
		    '1.jpg', '2.png', '3.jpg', '4.jpg',
	    );

	    $rand = rand( 0, 3 );
	    $image = $stack[$rand];

	    $onclick = $this->getOnclickOpenAction('article',false,
		    array(
			    'id' => $article->id,
			    'sync_open' => 1,
			    'back_button' => 1
		    ));

        return $this->getComponentRow(array(
	        $this->getComponentColumn(array(
		        $this->getComponentImage($image, array(
			        'imgwidth' => '400',
			        'imgheight' => '400',
			        'lazy' => 1,
			        'priority' => 9,
		        ), array(
			        'width' => '400',
			        'height' => '400',
			        'crop' => 'yes',
		        ))
	        ), array(), array(
		        'width' => '35%',
		        'height' => $this->screen_height / $this->height_propertion,
	        )),
	        $this->getComponentColumn(array(
		        $this->getComponentText($article->title, array(), array(
		        	'font-size' => '21',
		        	'font-weight' => 'bold',
		        	'margin' => '0 0 0 0',
		        )),
		        $this->getComponentRow(array(
			        $this->getComponentText(strtoupper($category_data->title), array(), array(
				        'color' => '#777d81',
				        'font-size' => '13',
				        'margin' => '5 0 0 0',
			        )),
		        )),
		        $this->getComponentRow(array(
			        $this->getComponentText(strtoupper(date('F j, Y', strtotime($article->article_date))), array(), array(
				        'color' => '#777d81',
				        'font-size' => '11',
				        'margin' => '5 0 0 0',
			        )),
		        ))
	        ), array(), array(
		        'width' => 'auto',
		        'height' => $this->screen_height / $this->height_propertion,
		        'padding' => '10 10 0 10',
	        )),
        ), array(
	        'onclick' => $onclick,
        ), array(
	        'margin' => '0 15 0 15',
	        'width' => 'auto',
	        'height' => $this->screen_height / $this->height_propertion,
        ));
    }

}