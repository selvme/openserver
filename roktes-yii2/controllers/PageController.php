<?php

namespace app\controllers;

use app\modules\for_page\models\DbPage;
use Imagine\Image\ManipulatorInterface;
use Yii;
use yii\helpers\BaseStringHelper;
use yii\helpers\Url;
use app\modules\for_category\models\DbCategory;
use app\modules\for_img\models\DbImg;
use app\modules\for_scan\models\DbScan;
use app\modules\for_menu\Choice_Menu;
use yii\data\Pagination;
use yii\imagine\BaseImage;

class PageController extends MainController
{
	public function actionIndex(){
	    $page = new DbPage();
	    $cat = new DbCategory();
		$slider_data = $page->find()
                        ->where(['status' => 1,
                                'is_spec_offer' => 1])
                        ->select("id, url, title, have_img, spec_offer_price, spec_offer_content")
                        ->asArray()
                        ->all();
		$unit_catalog = $cat->getNameAll();
		$unit_project = $page->find()
                        ->where(['type'=>5])
                        ->orderby(['date'=>SORT_DESC])
                        ->limit(3)
                        ->select('id, url, title, description, have_img, city, date')
                        ->asArray()
                        ->all();
		for ($i=0; $i < count($slider_data); $i++){
            if($slider_data[$i]['have_img'] == 1){
                $slider_data[$i] += DbImg::findImgById($slider_data[$i]['id']);
            }
        }
		for ($i=0; $i < count($unit_project); $i++){
            if($unit_project[$i]['have_img'] == 1){
                $unit_project[$i] += DbImg::findImgById($unit_project[$i]['id']);
                $unit_project[$i] += DbScan::findScanById($unit_project[$i]['id']);
            }
        }
		for ($i=0; $i<count($unit_catalog); $i++) {
			$unit_catalog[$i]['child'] = $page->getAllItemsByCategory($i+1);
		}
		return $this->render('front', [
			'slider_data' => $slider_data,
			'unit_catalog' => $unit_catalog,
			'unit_project' => $unit_project,
		]);
	}

	public function actionCategory(){
        $url = $this->clearUrl(Url::current());
		$category = new DbCategory();

        $category = $category->findByUrl($url);
		$items = $category->getAllPrPreview($category->id);

		$this->view->params['breadcrumbs'][] =  [
                                    'label' => 'Каталог',
                                    'url' => Url::home(true) . 'catalog'
                                 ];
        $this->view->params['breadcrumbs'][] =  [
                                    'label' => $category['title']
                                 ];
		return $this->render('category', [
			'category' => $category,
			'items' => $items,
		]);
	}

	public function actionCatalog(){
	    $category = new DbCategory();
		$unit_catalog = $category->getNameAll();
		$child = new DbPage();

		for ($i=0; $i<count($unit_catalog); $i++) {
			$unit_catalog[$i]['child'] = $child->getAllItemsByCategory($i+1);
		}

		$this->view->params['breadcrumbs'][] =  [
                                    'label' => 'Каталог'
                                 ];
		return $this->render('catalog', [
			'unit_catalog' => $unit_catalog,
		]);
	}

	public function actionProduct(){
        $url = $this->clearUrl(Url::current());
		$product = DbPage::find()->where(['url' => $url])->one();
		$is_ch = $product->getTypeName()->one()->name == "products" ? true : false;
		$cat = $product->getCategoryName()->one();
        $thumbs = [];
        $images = [];
        if ($product->have_img){
            $images = $product->getImages()->orderBy(['weight' => SORT_DESC])->all();
            $thumbs = $product->getImages()->orderBy(['weight' => SORT_DESC])->all();
            foreach ($images as $img){
                $dir = Yii::getAlias('@web') . "temp/" . $product->id . "_" . BaseStringHelper::basename($img->path_to_img);
                if (!file_exists($dir)){
                    BaseImage::watermark($img->path_to_img, Yii::getAlias('@web') . "image/watermark_mini.png")->save($dir);
                    $img->path_to_img = $dir;
                }else{
                    $img->path_to_img = $dir;
                }
            }
            foreach ($thumbs as $th){
                $dir = Yii::getAlias('@web') . "thumbs/" . $product->id . "_thumb_" .BaseStringHelper::basename($th->path_to_img);
                if (!file_exists($dir)){
                    BaseImage::thumbnail($th->path_to_img, 100, 100 , ManipulatorInterface::THUMBNAIL_INSET)->save($dir);
                    $th->path_to_img = $dir;
                }else{
                    $th->path_to_img = $dir;
                }
            }
        }
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Каталог',
            'url' => Url::home(true) . 'catalog'
        ];
        $this->view->params['breadcrumbs'][] =  [
            'label' => $cat->title,
            'url' => Url::home(true) . $cat->url
        ];
        $this->view->params['breadcrumbs'][] =  [
            'label' => $product->title
        ];
		return $this->render('product', [
			'product' => $product,
            'images' => $images,
            'thumbs' => $thumbs,
            'main_ch' => $is_ch ? $product->getMainCharacteristics()->all() : [],
            'add_ch' => $is_ch ? $product->getAddCharacteristics()->all() : [],
		]);
	}

	public function actionUslugi(){
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Услуги'
        ];
		return $this->render('uslugi', [
		]);
	}

	public function actionSpecialOffer(){
	    $page = new DbPage();
		$spec = $page->find()
            ->where(['status' => 1,
                'is_spec_offer' => 1])
            ->select("id, url, title, have_img, spec_offer_price, spec_offer_content")
            ->asArray()
            ->all();
		for ($i=0; $i < count($spec); $i++){
            if($spec[$i]['have_img'] == 1){
                $spec[$i] += DbImg::findImgById($spec[$i]['id']);
            }
        }
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Акции'
        ];
		return $this->render('special-offer', [
			'spec' => $spec,
		]);
	}

	public function actionReviews(){
		$query = DbPage::find()
                        ->where(['type'=>5])
                        ->orderby(['date'=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
        $pages->pageSizeParam = false;
        $pages->forcePageParam = false;
        $projects = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->select('id, url, title, description, have_img, city, date')
            ->asArray()
            ->all();
		for ($i=0; $i < count($projects); $i++){
            if($projects[$i]['have_img'] == 1){
                $projects[$i] += DbImg::findImgById($projects[$i]['id']);
                $projects[$i] += DbScan::findScanById($projects[$i]['id']);
            }
        }
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Клиенты и отзывы'
        ];
		return $this->render('reviews', [
			'projects' => $projects,
			'pages' => $pages,
		]);
	}

	public function actionSinglerev(){
        $url = $this->clearUrl(Url::current());
		$project = DbPage::find()->where(['url' => $url])->one();
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Клиенты и отзывы',
            'url' => Url::home(true) . 'reviews'
        ];
        $this->view->params['breadcrumbs'][] =  [
            'label' => $project->title
        ];
		return $this->render('singleReview', [
			'project' => $project,
			'scan' => $project->have_scan ? $project->getScan()->one() : [],
			'images' => $project->have_img ? $project->getImages()->all() : [],
		]);
	}

	public function actionFinansovayaPodderzhka(){
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Лизинг'
        ];
		return $this->render('finansovaya-podderzhka', [
			'meta_title' => 'Финансовая поддержка компании "РОКТЭС"',
		]);
	}

	public function actionChelindlizing(){
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Лизинг',
            'url' => Url::home(true) . 'finansovaya-podderzhka'
        ];
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'ЧелиндЛизинг'
        ];

		return $this->render('chelindlizing', [
			'meta_title' => 'ЧелиндЛизинг | "РОКТЭС"',
		]);
	}

	public function actionOKompanii0(){
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'О компании'
        ];
		return $this->render('o-kompanii-0', [
			'meta_title' => 'Вся информация о компании "РОКТЭС"',
		]);
	}

	public function actionContacts(){
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Контакты'
        ];
		return $this->render('contacts', [
			'meta_title' => 'Контактная информация компании "РОКТЭС"',
		]);
	}

	public function actionNashiPreimushchestva(){
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'О компании',
            'url' => Url::home(true) . 'o-kompanii-0'
        ];
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Наши преимущества'
        ];
		return $this->render('advantages', [
		]);
	}

	public function actionIstoriya(){
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'О компании',
            'url' => Url::home(true) . 'o-kompanii-0'
        ];
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'История'
        ];
		return $this->render('history', [
			'meta_title' => 'История развития компании | "РОКТЭС"',
		]);
	}

	public function actionPersonal(){
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'О компании',
            'url' => Url::home(true) . 'o-kompanii-0'
        ];
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Наш персонал'
        ];
		return $this->render('personal', [
			'meta_title' => 'Персонал работающий в компании "РОКТЭС"',
		]);
	}

	public function actionNews(){
		$query = DbPage::find()
                        ->where(['type'=>4])
                        ->orderby(['date'=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 12]);
        $pages->pageSizeParam = false;
        $pages->forcePageParam = false;
        $news = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->select('id, url, title, description, content, have_img, date')
            ->asArray()
            ->all();
		for ($i=0; count($news) > $i; $i++){
            if($news[$i]['have_img']){
                $news[$i] += ['image' => DbImg::findImgById($news[$i]['id'])];
                if (isset($news[$i]['image'])){
                    $dir = Yii::getAlias('@web') . "thumbs/" . $news[$i]['id'] . "_thumb_" .BaseStringHelper::basename($news[$i]["image"]['path_to_img']);
                    if (!file_exists($dir)){
                        BaseImage::thumbnail($news[$i]['image']['path_to_img'], 200, 150 , ManipulatorInterface::THUMBNAIL_INSET)->save($dir);
                        $news[$i]['image']['path_to_img'] = $dir;
                    }else{
                        $news[$i]['image']['path_to_img'] = $dir;
                    }
                }
            }
        }
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'О компании',
            'url' => Url::home(true) . 'o-kompanii-0'
        ];
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Новости'
        ];
		return $this->render('news', [
			'meta_title' => 'Интересные новости компании "РОКТЭС"',
			'pages' => $pages,
			'news' => $news,
		]);
	}

	public function actionSinglenews(){
        $url = $this->clearUrl(Url::current());
		$new = DbPage::find()->where(['url' => $url])->one();
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'О компании',
            'url' => Url::home(true) . 'o-kompanii-0'
        ];
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Новости',
            'url' => Url::home(true) . 'news'
        ];
        $this->view->params['breadcrumbs'][] =  [
            'label' => $new->title
        ];
		return $this->render('singlenews', [
			'meta_title' => $new->title,
			'new' => $new,
            'images' => $new->have_img ? $new->getImages()->all() : [],
		]);
	}

	public function actionArticles(){
		$query = DbPage::find()
                        ->where(['type'=>3])
                        ->orderby(['id'=>SORT_ASC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
        $pages->pageSizeParam = false;
        $pages->forcePageParam = false;
        $articles = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->select('id, url, title, content, have_img')
            ->asArray()
            ->all();
		for ($i=0; $i < count($articles); $i++){
            if($articles[$i]['have_img'] == 1){
                $articles[$i] += DbImg::findImgById($articles[$i]['id']);
            }
        }
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'О компании',
            'url' => Url::home(true) . 'o-kompanii-0'
        ];
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Статьи'
        ];
        return $this->render('articles', [
			'meta_title' => 'Статьи на сайте компании "РОКТЭС"',
			'pages' => $pages,
			'articles' => $articles,
		]);
	}

	public function actionSingleart(){
		$url = $this->clearUrl(Url::current());
		$art = DbPage::find()->where(['url' => $url])->one();
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'О компании',
            'url' => Url::home(true) . 'o-kompanii-0'
        ];
        $this->view->params['breadcrumbs'][] =  [
            'label' => 'Статьи',
            'url' => Url::home(true) . 'articles'
        ];
        $this->view->params['breadcrumbs'][] =  [
            'label' => $art->title
        ];
		return $this->render('singleart', [
			'art' => $art,
		]);
	}

	public function actionSitemap(){
		$map = Choice_Menu::viewMenuItems('main', 1);
//        $category = new DbCategory();
//        $page = new DbPage();
//		for ($i=0; count($map) > $i; $i++){
//		    if (isset($map[$i]['items'])){
//		        for ($j=0; count($map[$i]['items']) > $j; $j++){
//		            $catId = $category->findByUrl($map[$i][$j]['url']);
//		            $items = $page->getAllItemsByCategory($catId->id);
//                    $map[$i][$j][] = ['items' => $items];
//                }
//            }
//        }
		return $this->render('sitemap', [
			'map' => $map,
		]);
	}
}
