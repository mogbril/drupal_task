<?php

/**
 * @file
 * Contains \Drupal\products_list\Plugin\Block\ProductListingBlock.
 */

namespace Drupal\products_list\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

/**
 * Provides a 'prodcut listing'.
 *
 * @Block(
 * id = "prodcut_listing",
 * admin_label = @Translation("prodcut listing"),
 * category = @Translation("custom")
 * )
 */
class ProductListingBlock extends BlockBase implements BlockPluginInterface {

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
        return ['label_display' => FALSE];
    }

    /**
     * {@inheritdoc}
     */
    public function build() {

        //only if the current page is the front page
        if (\Drupal::service('path.matcher')->isFrontPage()) {

            $productsIds = \Drupal::entityQuery('node')
                    ->condition('status', 1)
                    ->condition('type', 'product')
                    ->sort('created', 'DESC')
                    ->range(0, 10)
                    ->execute();

            $products = $this->fetchProductFields($productsIds);
            $loggedIn = \Drupal::currentUser()->isAuthenticated();//Check if user is logged in
            
            $renderable = [
                '#theme' => 'products_list',
                '#products' => $products,
                '#logged_in' => $loggedIn,
            ];

            return $renderable;
        }

        return;
    }

    /**
     *  Returns an array populated with product field values.
     */
    public function fetchProductFields($productsIds) {

        //Load all products
        $productsNodes = \Drupal\node\Entity\Node::loadMultiple($productsIds);
        $products = [];

        foreach ($productsNodes as $productNode) {

            $product = new \stdClass();
            $product->link = \Drupal::service('path.alias_manager')->getAliasByPath('/node/' . $productNode->id());
            $product->id = $productNode->id();
            $product->title = $productNode->getTitle();
            $product->image = file_create_url($productNode->field_product_image->entity->getFileUri());
            $product->price = $productNode->get('field_product_price')->getValue()[0]['value'];
            $product->category = $productNode->field_product_category->entity->label();
            $product->brand = $productNode->field_product_brand->entity->label();
            $products[] = $product;
        }

        return $products;
    }

}
